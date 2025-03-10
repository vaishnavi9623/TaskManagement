// Ensure CSRF token is set globally for all AJAX requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// View user details
$(document).on('click', '.viewUser', function (e) {
    e.preventDefault();
    let userId = $(this).data('id');
    $('#viewUserModal').modal('show');

    $.ajax({
        url: `/user/${userId}`,
        type: 'GET',
        success: function (response) {
            $('#viewUserModal .modal-body').html(`
                <div class="container">
                    <div class="row mb-2"><div class="col-4"><strong>Name:</strong></div><div class="col-8">${response.name}</div></div>
                    <div class="row mb-2"><div class="col-4"><strong>Email:</strong></div><div class="col-8">${response.email}</div></div>
                    <div class="row mb-2"><div class="col-4"><strong>Phone:</strong></div><div class="col-8">${response.phone_number}</div></div>
                    <div class="row mb-2"><div class="col-4"><strong>Designation:</strong></div><div class="col-8">${response.designation}</div></div>
                    <div class="row mb-2"><div class="col-4"><strong>Department:</strong></div><div class="col-8">${response.department}</div></div>
                    <div class="row mb-2"><div class="col-4"><strong>Position:</strong></div><div class="col-8">${response.position}</div></div>
                    <div class="row mb-2"><div class="col-4"><strong>Status:</strong></div><div class="col-8">${response.status}</div></div>
                    <div class="row mb-2"><div class="col-4"><strong>Joining Date:</strong></div><div class="col-8">${response.joining_date}</div></div>
                    <div class="row mb-2"><div class="col-4"><strong>Address:</strong></div><div class="col-8">${response.address}</div></div>
                </div>
            `);
        },
        error: function () {
            Swal.fire('Error', "Error fetching user details.", 'error');
        }
    });
});

// Open update password modal
$(document).on('click', '.updatepassword', function (e) {
    e.preventDefault();
    let userId = $(this).data('id');
    $('#updatePasswordForm').attr('data-id', userId);
    $('#updatePassModal').modal('show');
});

// Update password
$(document).on('submit', '#updatePasswordForm', function (e) {
    e.preventDefault();
    
    let userId = $(this).attr('data-id');
    let password = $('#newPassword').val();
    let confirmPassword = $('#confirmPassword').val();

    if (password.length < 8) {
        Swal.fire('Error!', 'Password must be at least 8 characters long', 'error');
        return;
    }
    if (password !== confirmPassword) {
        Swal.fire('Error!', 'Passwords do not match!', 'error');
        return;
    }

    $.ajax({
        url: `/user/updatepass/${userId}`,
        type: 'POST',
        data: { password, confirmPassword },
        success: function () {
            Swal.fire('Success!', 'Password updated successfully.', 'success');
            $('#users-table').DataTable().ajax.reload();
            $('#updatePassModal').modal('hide');
            $('#updatePasswordForm')[0].reset();
        },
        error: function (xhr) {
            Swal.fire('Error!', xhr.responseJSON?.message || 'An error occurred.', 'error');
        }
    });
});

// Initialize users DataTable
$('#users-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: { url: '/user' },
    columns: [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'designation', name: 'designation' },
        { data: 'department', name: 'department' },
        { data: 'photo', name: 'photo', orderable: false, searchable: false },
        { 
            data: 'status', 
            name: 'status',
            render: function (data) {
                let badgeClass = data.toLowerCase() === 'active' ? "bg-success text-white rounded-circle" : "bg-danger text-white rounded-circle";
                return `<span class="px-3 py-1 rounded-full ${badgeClass}">${data}</span>`;
            }
        },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
});

// Delete user
$(document).on('click', '.deleteuser', function (e) {
    e.preventDefault();
    let userId = $(this).data('id');

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
                url: `/user/deleteuser/${userId}`,
                type: 'DELETE',
                success: function () {
                    Swal.fire('Deleted!', 'User has been deleted.', 'success');
                    $('#users-table').DataTable().ajax.reload();
                },
                error: function (xhr) {
                    Swal.fire('Error!', xhr.responseJSON?.message || 'An error occurred.', 'error');
                }
            });
        } else {
            Swal.fire('Cancelled', 'The user is safe.', 'info');
        }
    });
});

// Filter users
$("#Userfilter-form input").on("keyup", function () {
    let rowCount = 0;
    let name = $("#name").val().toLowerCase();
    let designation = $("#designation").val().toLowerCase();
    let department = $("#department").val().toLowerCase();

    $("#users-table tbody tr").each(function () {
        let row = $(this);
        let nameMatch = row.find("td:eq(1)").text().toLowerCase().includes(name);
        let designationMatch = row.find("td:eq(3)").text().toLowerCase().includes(designation);
        let departmentMatch = row.find("td:eq(4)").text().toLowerCase().includes(department);

        if (nameMatch && designationMatch && departmentMatch) {
            row.show();
            rowCount++;
        } else {
            row.hide();
        }
    });

    $("#no-records").toggle(rowCount === 0);
});

// Reset filters
$("#resetFilters").click(function () {
    $("#Userfilter-form input").val("");
    $("#users-table tbody tr").show();
});

 function toggleChat() {
     var chatWindow = document.getElementById("chat-window");
     chatWindow.classList.toggle("open");
 }
 function showTooltip() {
     document.getElementById("chat-tooltip").style.display = "block";
 }

 function hideTooltip() {
     ocument.getElementById("chat-tooltip").style.display = "none";
 }