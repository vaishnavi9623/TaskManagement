// Ensure CSRF token is included in AJAX requests
const csrfToken = $('meta[name="csrf-token"]').attr('content');

// to view all task in details
$(document).on('click', '.viewTask', function (e) {
    e.preventDefault();
    let taskId = $(this).data('id');
    $('#viewTaskModal').modal('show');

    $.ajax({
        url: `tasks/${taskId}`,
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: function (response) {
            let statusBadge = '';
            
            if (response.status && ['inprogress', 'pending', 'overdue'].includes(response.status.toLowerCase())) {
                let deadlinedate = new Date(response.deadline);
                let currentdate = new Date();
                let delayDays = Math.ceil((currentdate - deadlinedate) / (1000 * 60 * 60 * 24));
                statusBadge = `<span class="badge bg-danger"> ${response.status} - Delayed by ${delayDays} days</span>`;
            } else if (response.status && response.status.toLowerCase() === 'completed') {
                statusBadge = `<span class="badge bg-success">Completed</span>`;
            } else {
                statusBadge = `<span class="badge bg-warning">${response.status}</span>`;
            }

            $('#viewTaskModal .modal-body').html(`
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-4"><strong>Name:</strong></div>
                        <div class="col-8">${response.name}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4"><strong>Description:</strong></div>
                        <div class="col-8">${response.description}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4"><strong>Start Date/Time:</strong></div>
                        <div class="col-8">${response.starttime}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4"><strong>End Date/Time:</strong></div>
                        <div class="col-8">${response.endtime}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4"><strong>Category:</strong></div>
                        <div class="col-8">${response.category}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4"><strong>Priority:</strong></div>
                        <div class="col-8">${response.priority}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4"><strong>Deadline:</strong></div>
                        <div class="col-8">${response.deadline}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4"><strong>Recurring Task:</strong></div>
                        <div class="col-8">${response.recurring_task}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4"><strong>Status:</strong></div>
                        <div class="col-8">${statusBadge}</div>
                    </div>
                </div>
            `);
            
            $("#taskids").val(taskId);
        },
        error: function (xhr) {
            Swal.fire('error', "Error fetching task details.");
        }
    });
});

//function for time...
function timeAgo(dateString) {
    let date = new Date(dateString);
    let seconds = Math.floor((new Date() - date) / 1000);
    let intervals = {
        year: 31536000,
        month: 2592000,
        week: 604800,
        day: 86400,
        hour: 3600,
        minute: 60,
    };

    for (let unit in intervals) {
        let interval = Math.floor(seconds / intervals[unit]);
        if (interval > 1) {
            return interval + " " + unit + "s ago";
        } else if (interval === 1) {
            return interval + " " + unit + " ago";
        }
    }
    return "Just now";
}
// Opens the notes modal on click of add note button
$(document).on('click', '.addnote', function (e) {
    e.preventDefault();
    let taskId = $(this).data('task-id');
    let UserId = $(this).data('user-id');

    $('#addNoteModal').modal('show');
    $("#notesList").html('<li class="list-group-item">Loading notes...</li>');
    $.ajax({
        url:"task/get-task-notes/"+taskId,
        type:"GET",
        data:{user_id:UserId},
        success: function(response){
            $("#notesList").empty(); // Clear previous notes

            if (response.length > 0) {
                response.forEach(function (note) {
                    $("#notesList").append(
                        `<li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">${note.user_name}</div>
                                <p class="mb-1">${note.note}</p>
                            </div>
                            <small class="text-muted">${timeAgo(note.created_at)}</small>
                        </li>`
                    );
                });
                $("#task_id").val(taskId);
            } else {
                $("#notesList").html('<li class="list-group-item">No notes found.</li>');
            }
    
            console.log(response);
        },
        error: function () {
            $("#notesList").html('<li class="list-group-item text-danger">Error fetching notes.</li>');
        }
    });
});
// Opens the comment modal on click of add comment button
$(document).on('click', '.addcomment', function (e) {
    $("#CommentList").html("Loading...");
    e.preventDefault();
    let taskId = $(this).data('id');
    $('#addCommentModal').modal('show');
    $.ajax({
        url: "task/get-task-comments/" + taskId,
        type: "GET",
        // data: { user_id: UserId },
        success: function (response) {
            $("#CommentList").empty(); // Clear previous comments
            
            console.log(response);
            if (response.length > 0) {
                response.forEach(function (comment) {
                    let userImage = "{{ asset('images/user.png') }}"; 
                    $("#CommentList").append(
                        `<div class="border-bottom pb-3 mb-3">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <p class="fw-semibold mb-1">${comment.user_name} 
                                            <small class="text-muted">(${timeAgo(comment.created_at)})</small>
                                        </p>
                                        <p class="mb-0">${comment.comments}</p>
                                    </div>
                                </div>
                               
                            </div>
                        </div>`
                    );
                });
                $("#taskid").val(taskId);

            } else {
                $("#CommentList").html('<li class="list-group-item text-center text-muted">No comments found.</li>');
            }
        },
        error: function () {
            $("#CommentList").html('<li class="list-group-item text-danger text-center">Error fetching comments.</li>');
        }
    });    
});

// View of task datatable
var status = window.location.pathname.split('/').pop();
if (status === 'task') {
    status = null;
}

// Ensure `taskRoute` is defined in the Blade file
$('#tasks-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: typeof taskRoute !== 'undefined' ? taskRoute + (status ? '/' + status : '') : '',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        data: function (d) {}
    },
    columns: [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'description', name: 'description' },
        { data: 'category', name: 'category' },
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
        { data: 'deadline', name: 'deadline' },
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
                } else if (status === 'in_progress') {
                    icon = '<i class="fa-solid fa-spinner me-1"></i>';
                    badgeClass = 'bg-info text-white';
                } else {
                    icon = '<i class="fa-solid fa-xmark-circle me-1"></i>';
                    badgeClass = 'bg-danger text-white';
                }
        
                return `<span class="d-inline-flex align-items-center gap-1 px-2 py-1 rounded-pill ${badgeClass}" style="min-width: 100px; font-size: 0.8rem;">
                            ${icon}${data}
                        </span>`;
            }
        },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
});
 //to remove readonly of comments on edit....
 $(document).on('click', '.editComment', function (e) 
 {
     alert('clicked on edit')
     $('#comment').prop('readonly',false).focus();
 });
 $(document).on('blur', '#comment', function (e) 
 {
     alert('on blur');
     $('#comment').prop('readonly',true).focus();

 });
//to delete task.....
$(document).on('click', '.deletetask', function (e) 
{
        e.preventDefault();
        let taskId = $(this).data('id');
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
                url: `task/deletetask/${taskId}`, // URL for the DELETE request
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
                    text: "Your file has been deleted.",
                    icon: "success"
                    });
                    $('#tasks-table').DataTable().ajax.reload();
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