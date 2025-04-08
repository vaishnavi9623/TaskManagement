$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#teams-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: { url: '/team' },
    columns: [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'description', name: 'description' },
        { data: 'members', name: 'members' },
        { data: 'lead', name: 'lead' },
        { 
            data: 'status', 
            name: 'status',
            render: function(data) {
                let status = data.trim().toLowerCase(); 
                let icon = '';
                let badgeClass = '';
        
                if (status === 'active') {
                    icon = '<i class="fa-solid fa-circle-check me-1"></i>'; // ✅ green check circle
                    badgeClass = 'bg-success text-white';
                 } else {
                    icon = '<i class="fa-solid fa-circle-xmark me-1"></i>'; // ❌ red cross circle
                    badgeClass = 'bg-secondary text-white';
                }
        
                return `<span class="d-inline-flex align-items-center gap-1 px-2 py-1 rounded-pill ${badgeClass}" style="min-width: 100px; font-size: 0.8rem;">
                            ${icon}${data}
                        </span>`;
            }
        },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
});

$(document).on('click', '.viewTeam', function (e) {
    e.preventDefault();
    let teamId = $(this).data('id');
    $('#viewTeamModal').modal('show');
    $.ajax({
        url: `team/${teamId}`,
        type: 'GET',
        success: function (response) {
            console.log('response',response);
            let res = typeof response === 'string' ? JSON.parse(response) : response;
            $('#viewTeamModal .modal-body').html(`
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-4"><strong>Name:</strong></div>
                        <div class="col-8">${res.name}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4"><strong>Description:</strong></div>
                        <div class="col-8">${res.description}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4"><strong>lead:</strong></div>
                        <div class="col-8">${res.lead}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4"><strong>Members:</strong></div>
                        <div class="col-8">${res.members}</div>
                    </div>
                    
                </div>
            `);
            
            $("#teamId").val(teamId);
        },
        error: function (xhr) {
            Swal.fire('error', "Error fetching team details.");
        }
    });
});

//to delete team.....
$(document).on('click', '.deleteTeam', function (e) 
{
        e.preventDefault();
        let teamId = $(this).data('id');
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
                url: `team/deleteteam/${teamId}`, // URL for the DELETE request
                type : 'DELETE',
                data: {
                    _method: 'DELETE',
                },
               
                success : function(response){
                    Swal.fire({
                    title: "Deleted!",
                    text: "Your data has been deleted.",
                    icon: "success"
                    });
                    $('#teams-table').DataTable().ajax.reload();
                },
                error : function (xhr){
                    Swal.fire('Error!', xhr.responseJSON.message || 'An error occurred while deleting.', 'error');

                }
            });

            
        }
        else{
            Swal.fire('Cancelled', 'The task data is safe.', 'info');
        }
    });
});