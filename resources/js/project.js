const csrfToken = $('meta[name="csrf-token"]').attr('content');

 //view of projects datatable....
 $('#project-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: { url: '/projects' },
    headers: {
        'X-CSRF-TOKEN': csrfToken
    },
    columns: [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'project_manager', name: 'project_manager' },
        { data: 'assigned_team', name: 'assigned_team' },

        { data: 'start_date', name: 'start_date' },
        { data: 'end_date', name: 'end_date' },
        { 
            data: 'priority', 
            name: 'priority',
            render: function(data) {
                let priority = data.trim().toLowerCase(); 
                let icon = '';
                let priorityClass = '';
        
                if (priority === 'high' || priority === 'critical') {
                    icon = '<i class="fa-solid fa-circle-exclamation me-1"></i>';
                    priorityClass = 'bg-danger text-white';
                } else if (priority === 'medium') {
                    icon = '<i class="fa-solid fa-arrow-up me-1"></i>';
                    priorityClass = 'bg-warning text-white';
                } else {
                    icon = '<i class="fa-solid fa-arrow-down me-1"></i>';
                    priorityClass = 'bg-secondary text-white';
                }
        
                return `<span class="d-inline-flex align-items-center gap-1 px-2 py-1 rounded-pill ${priorityClass}" style="min-width: 100px; font-size: 0.8rem;">
                            ${icon}${data}
                        </span>`;
            }
        },
        { 
            data: 'status', 
            name: 'status',
            render: function(data) {
                let status = data.trim().toLowerCase(); 
                let icon = '';
                let badgeClass = '';
        
                if (status === 'completed') {
                    icon = '<i class="fa-solid fa-check-circle me-1"></i>';
                    badgeClass = 'bg-success text-white';
                } else if (status === 'ongoing') {
                    icon = '<i class="fa-solid fa-spinner me-1"></i>';
                    badgeClass = 'bg-info text-white';
                } else if (status === 'pending') {
                    icon = '<i class="fa-solid fa-circle-xmark me-1"></i>';
                    badgeClass = 'bg-danger text-white';
                }  else if (status === 'on_hold') {
                    icon = '<i class="fa-solid fa-pause-circle	 me-1"></i>';
                    badgeClass = 'bg-secondary text-white';
                } else {
                    icon = '<i class="fa-solid fa-xmark-circle me-1"></i>';
                    badgeClass = 'bg-danger text-white';
                }
        
                return `<span class="d-inline-flex align-items-center gap-1 px-2 py-1 rounded-pill ${badgeClass}" style="min-width: 100px; font-size: 0.8rem;">
                            ${icon}${data}
                        </span>`;
            }
        }
        ,

        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
});  
//to delete projects.....
$(document).on('click', '.deleteproject', function (e) 
{
        e.preventDefault();
        let prjId = $(this).data('id');
        Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `projects/deleteproject/${prjId}`, // URL for the DELETE request
                type : 'DELETE',
                data: {
                    _method: 'DELETE',
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success : function(response){
                    Swal.fire({
                    title: "Deleted!",
                    text: "Your data has been deleted.",
                    icon: "success"
                    });
                    $('#project-table').DataTable().ajax.reload();
                },
                error : function (xhr){
                    Swal.fire('Error!', xhr.responseJSON.message || 'An error occurred while deleting.', 'error');

                }
            });

            
        }
        else{
            Swal.fire('Cancelled', 'The project data is safe.', 'info');
        }
    });
});
// to view all projects in details
$(document).on('click', '.viewproject', function (e) {
    e.preventDefault();
    let projectId = $(this).data('id');
    $('#viewProjectModal').modal('show');

    $.ajax({
        url: `projects/${projectId}`,
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (response) {
            let statusBadge = '';
            
            if (response.status && ['in_progress', 'pending', 'overdue'].includes(response.status.toLowerCase())) {
                let deadlinedate = new Date(response.deadline);
                let currentdate = new Date();
                let delayDays = Math.ceil((currentdate - deadlinedate) / (1000 * 60 * 60 * 24));
                statusBadge = `<span class="badge bg-danger"> ${response.status} - Delayed by ${delayDays} days</span>`;
            } else if (response.status && response.status.toLowerCase() === 'completed') {
                statusBadge = `<span class="badge bg-success">Completed</span>`;
            } else {
                statusBadge = `<span class="badge bg-warning">${response.status}</span>`;
            }
            const manager = response.project_manager;
            const team = response.team;
            //alert(JSON.stringify(response));
            // const managerImage = manager && manager.photo 
            // ? `<img src="/storage/uploads/employees/${manager.photo}" alt="${manager.name}" class="rounded-circle me-2" width="40" height="40"> ${manager.name}`
            // : manager
            //         ? `${manager.name}`
            //         : 'N/A';
            $('#viewProjectModal .modal-body').html(`
                <div class="container">
                    <div class="">
                        <div class="">
                            <h5 class=" mb-3"><i class="bi bi-folder-fill me-2"></i>Project Overview</h5>
                            <div class="row mb-2">
                                <div class="col-md-4 fw-semibold text-muted">Name</div>
                                <div class="col-md-8">${response.name}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4 fw-semibold text-muted">Description</div>
                                <div class="col-md-8">${response.description}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4 fw-semibold text-muted">Start Date/Time</div>
                                <div class="col-md-8">${response.start_date}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4 fw-semibold text-muted">End Date/Time</div>
                                <div class="col-md-8">${response.end_date}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4 fw-semibold text-muted">Priority</div>
                                <div class="col-md-8"><span class="badge bg-primary">${response.priority}</span></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4 fw-semibold text-muted">Client Name</div>
                                <div class="col-md-8">${response.client_name}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4 fw-semibold text-muted">Budget</div>
                                <div class="col-md-8 text-success fw-bold">$${response.budget}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4 fw-semibold text-muted">Project Manager</div>
                                <div class="col-md-8">${manager.name}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4 fw-semibold text-muted">Team</div>
                                <div class="col-md-8">${team.name}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4 fw-semibold text-muted">Status</div>
                                <div class="col-md-8">${statusBadge}</div>
                            </div>
                        </div>
                    </div>
                </div>
            `);
            
            
            $("#projectids").val(projectId);
        },
        error: function (xhr) {
            Swal.fire('error', "Error fetching task details.");
        }
    });
});