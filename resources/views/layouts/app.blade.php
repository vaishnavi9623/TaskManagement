<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Dashboard') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            overflow-x: hidden;
            font-family: 'Arial', sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 56px;
            background-color: #2C3E50;
            width: 250px;
            transition: width 0.2s;
            z-index: 2;
        }
        .sidebar.collapsed {
            width: 60px;
        }
        .sidebar .nav-link {
            color: #ffffff;
        }
        .sidebar .nav-link:hover {
            background-color: #ff9100;
            opacity: 0.8;
        }
        .sidebar .nav-link i {
            width: 24px;
        }
        .main-content {
            margin-left: 250px;
            transition: margin-left 0.2s;
        }
        .main-content.collapsed {
            margin-left: 60px;
        }
        .footer {
            position: relative;
            bottom: 0;
            width: 100%;
            padding: 20px 0;
            background-color: #f8f9fa;
        }
        .card {
            margin-bottom: 20px;
        }
        .card-body
        {
            /* background-color: #d4ddee; */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .bg-orange {
            background-color: #343a40;
            color: white;
        }
        .btn-orange {
            background-color: #343a40;
            color: white;
        }
        .btn-orange:hover {
            background-color: #e68a00;
        }
        .navbar-toggler-icon {
            color: #343a40;
        }
        .bg-danger {
            background-color: #ff3ca6 !important;
        }
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #dee2e6;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        [data-theme="light"] {
            --bg-color: #ffffff;
            --text-color: #000000;
        }

        [data-theme="dark"] {
            --bg-color: #121212;
            --text-color: #ffffff;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
        }
    </style>
</head>
<body data-theme="{{ session('theme', 'light') }}">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard')}}" title="Dashboard">
                    <i class="fas fa-tasks"></i> <span class="d-none d-md-inline">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user') }}" title="Users">
                    <i class="fas fa-users"></i> <span class="d-none d-md-inline">Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('task') }}" title="Task">
                    <i class="fas fa-list-check"></i> <span class="d-none d-md-inline">Task</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('project') }}" title="Projects">
                    <i class="fas fa-project-diagram"></i> <span class="d-none d-md-inline">Projects</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('teams')}}" title="Team">
                    <i class="fas fa-users"></i> <span class="d-none d-md-inline">Team</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('time-track')}}" title="Time Tracking">
                    <i class="fas fa-clock"></i> <span class="d-none d-md-inline">Time Tracking</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('calendar')}}" title="Calendar">
                    <i class="fas fa-calendar-alt"></i> <span class="d-none d-md-inline">Calendar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('reports')}}" title="Reports">
                    <i class="fas fa-chart-line"></i> <span class="d-none d-md-inline">Reports</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('notification')}}" title="Notifications">
                    <i class="fas fa-bell"></i> <span class="d-none d-md-inline">Notifications</span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{route('setting')}}" title="Settings">
                    <i class="fas fa-cog"></i> <span class="d-none d-md-inline">Settings</span>
                </a>
            </li> --}}
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="settingsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-cog"></i> <span class="d-none d-md-inline">Settings</span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                    <li><a class="dropdown-item" href="{{ route('setting') }}">General Settings</a></li>
                    <li><a class="dropdown-item" href="{{ route('setting.notifications') }}">Notification Settings</a></li>
                    <li><a class="dropdown-item" href="#">User Preferences</a></li>
                    <li><a class="dropdown-item" href="#">System Settings</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" title="Logout">
                    <i class="fa-solid fa-right-to-bracket"></i><span class="d-none d-md-inline">Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color:#d4ddee">
            
            <button class="navbar-toggler" type="button" id="toggleSidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
            
        <!-- Logo or Title -->
        <a class="navbar-brand ms-3" href="#" style="font-weight: bold !important; font-size: 20px !important; color: #000 !important; text-decoration: none !important;">
            Task Manager
        </a>


        {{-- <a class="navbar-brand ms-3" href="#">
            <img src="{{ asset('images/logo.png') }}" alt="Task Manager" style="height: 20px;">
        </a> --}}
        <!-- Search Bar -->
        <form class="d-inline-block ms-auto" style="width: 300px;margin-left:100px;">
            <input class="form-control form-control-sm" style="margin-left:100px;" type="search" placeholder="Search..." aria-label="Search">
        </form>

        

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-4" href="#"><i class="fa-solid fa-right-to-bracket"></i></a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Content Section -->
        <div class="container-fluid pt-5">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="footer mt-auto py-3 bg-light">
            <div class="container text-center">
                <span class="text-muted">© 2024 {{ config('app.name', 'My Dashboard') }}. All rights reserved.</span>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Sidebar Toggle Functionality
            document.getElementById('toggleSidebar').addEventListener('click', function() {
                const sidebar = document.getElementById('sidebar');
                const mainContent = document.getElementById('main-content');
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('collapsed');
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('[title]').tooltip();

            $(document).on('click', '.viewTask', function (e) {
                e.preventDefault();
                let taskId = $(this).data('id');
                $('#viewTaskModal').modal('show');
                $.ajax({
                    url : `tasks/${taskId}`,
                    type : 'GET',
                    data: {
                            _method: 'GET',
                            _token: '{{ csrf_token() }}'
                        },
                    success : function (response)
                    {
                        let statusBadge = '';
                        
                        if(response.status.toLowerCase() === 'inprogress' || response.status.toLowerCase() === 'pending' || response.status.toLowerCase() === 'overdue' ){
                            let deadlinedate = new Date(response.deadline);
                            let currentdate =  new Date();
                            let delayDays = Math.ceil((currentdate - deadlinedate) / (1000 * 60 * 60 * 24));
                            statusBadge = `<span class="badge bg-danger"> ${response.status} - Delayed by ${delayDays} days</span>`;
                        }
                        else if(response.status.toLowerCase() === 'completed'){
                            statusBadge = `<span class="badge bg-success">Completed</span>`;
                        }
                        else
                        {
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
                                    <div class="col-4"><strong>DeadLine:</strong></div>
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
                    },
                    error:function(xhr)
                    {
                        Swal.fire('error',"Error fetching task details.");

                    }
                });
            });

            $(document).on('click', '.viewUser', function (e) {
                e.preventDefault();
                let userId = $(this).data('id');
                $('#viewUserModal').modal('show');
                $.ajax({
                    url : `user/${userId}`,
                    type : 'GET',
                    data: {
                            _method: 'GET',
                            _token: '{{ csrf_token() }}'
                        },
                    success : function (response)
                    {
                        $('#viewUserModal .modal-body').html(`
                            <div class="container">
                                <div class="row mb-2">
                                    <div class="col-4"><strong>Name:</strong></div>
                                    <div class="col-8">${response.name}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4"><strong>Email:</strong></div>
                                    <div class="col-8">${response.email}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4"><strong>Phone Number:</strong></div>
                                    <div class="col-8">${response.phone_number}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4"><strong>Designation:</strong></div>
                                    <div class="col-8">${response.designation}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4"><strong>Department:</strong></div>
                                    <div class="col-8">${response.department}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4"><strong>Position:</strong></div>
                                    <div class="col-8">${response.position}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4"><strong>Status:</strong></div>
                                    <div class="col-8">${response.status}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4"><strong>Joining Date:</strong></div>
                                    <div class="col-8">${response.joining_date}</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4"><strong>Address:</strong></div>
                                    <div class="col-8">${response.address}</div>
                                </div>
                            </div>
                        `);
                    },
                    error:function(xhr)
                    {
                        Swal.fire('error',"Error fetching user details.");

                    }
                });
            });
            ;
            $(document).on('click','.updatepassword',function(e){
                e.preventDefault();
                let userId = $(this).data('id');
                $('#updatePasswordForm').attr('data-id', userId); // Assign user ID to form
                $('#updatePassModal').modal('show'); // Show modal
            });

            $(document).on('submit', '#updatePasswordForm', function (e) {
                e.preventDefault(); 
                let userId = $(this).data('id');
                let password = $('#newPassword').val();
                let confirmPassword = $('#confirmPassword').val();

                if(password.length < 8){
                    Swal.fire('Error !','Password must be at least 8 character long','error');
                    return;
                }
                if(password != confirmPassword){
                    Swal.fire('Error !','Passwords do not match!','error');
                    return;
                }
                $.ajax({
                        url: `user/updatepass/${userId}`, // URL for the DELETE request
                        type : 'POST',
                        data: {
                            _method: 'POST',
                            _token: '{{ csrf_token() }}',
                            password:password,
                            confirmPassword:confirmPassword,
                        },
                        success : function(response){
                            console.log(response)
                            Swal.fire('Success !','Password updated successfully.','success');
                            $('#users-table').DataTable().ajax.reload();
                            // Close the modal
                            $('#updatePassModal').modal('hide');
                            // Reset the form
                            $('#updatePasswordForm')[0].reset();
                        },
                        error : function (xhr){
                            Swal.fire('Error!', xhr.responseJSON.message || 'An error occurred while updating.', 'error');

                        }
                    });
            });

            $(document).on('click','.addnote',function(e){
                e.preventDefault();
                let userId = $(this).data('id');
                $('#addNoteModal').modal('show');
            });
            
            var status = window.location.pathname.split('/').pop();
            if (status === 'task') {
                status = null;
            }
            $('#tasks-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('task', ['status' => '']) }}' + (status ? '/' + status : ''),
                    data: function(d) {}
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'category', name: 'category' },
                    { data: 'priority', name: 'priority' },
                    { data: 'deadline', name: 'deadline' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('user') }}',
                    data: function(d) {}
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'designation', name: 'designation' },
                    { data: 'department', name: 'department' },
                    { data: 'photo', name: 'photo', orderable: false, searchable: false },
                    { data: 'status', name: 'status' ,
                        render: function(data,type,row){
                            let badgeClass = (data.toLowerCase === 'active') ? "bg-success text-white rounded-circle" : "bg-success rounded-circle text-white";
        return `<span class="px-3 py-1 rounded-full rounded-circle ${badgeClass}">${data}</span>`;
                        }
                    },

                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            $('#project-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('project') }}',
                    data: function(d) {}
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'project_manager', name: 'project_manager' },
                    { data: 'assigned_team', name: 'assigned_team' },

                    { data: 'start_date', name: 'start_date' },
                    { data: 'end_date', name: 'end_date' },
                    { data: 'priority', name: 'priority' },
                    { data: 'status', name: 'status' ,
                        render: function(data,type,row){
                            let badgeClass = (data === 'active')?"bg-green-500 text-white" : "bg-red-500 text-white";
        return `<span class="px-3 py-1 rounded-full ${badgeClass}">${data}</span>`;
                        }
                    },

                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
           
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        themeSystem: 'standard', // Use the default theme
        events: '/calendar/events', // Replace with your route to fetch events
        eventColor: '#e67e22', // Default event color (orange)
        eventTextColor: 'white', // White text on events

        });
   
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: '/calendar/events', // Route for fetching tasks
        });

        calendar.render();


        $('#viewSelector').change(function() {
            var selectedView = $(this).val();
            calendar.changeView(selectedView);
        });
        
        calendar.on('eventClick', function(info) {
            const eventDetails = info.event;
            alert('Task: ' + eventDetails.title + '\nStart: ' + eventDetails.start);
        });

        $('#taskSearch').on('input', function() {
            const query = $(this).val().toLowerCase();
            // Filter events by title or description
            const filteredEvents = events.filter(event => event.title.toLowerCase().includes(query));
            calendar.removeAllEvents();
            calendar.addEventSource(filteredEvents);
        });

    });
    document.addEventListener('DOMContentLoaded', () => {
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            setTimeout(() => {
                successAlert.remove();
            }, 3000); // 3000 ms = 3 seconds
        }
    });
    
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
                        url: `user/deleteuser/${userId}`, // URL for the DELETE request
                        type : 'DELETE',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        success : function(response){
                            Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                            });
                            $('#users-table').DataTable().ajax.reload();
                        },
                        error : function (xhr){
                            Swal.fire('Error!', xhr.responseJSON.message || 'An error occurred while deleting.', 'error');

                        }
                    });

                    
                }
                else{
                    Swal.fire('Cancelled', 'The user is safe.', 'info');
                }
                });
            });
            $("#Userfilter-form input").on("keyup", function () {
            // alert(345678)
            let rowconut = 0 ;
            let name = $("#name").val().toLowerCase();
            let designation = $("#designation").val().toLowerCase();
            let department = $("#department").val().toLowerCase();

            $("#users-table tbody tr").filter(function () {
                let row = $(this);
                let nameMatch = row.find("td:eq(1)").text().toLowerCase().includes(name);
                let designationMatch = row.find("td:eq(3)").text().toLowerCase().includes(designation);
                let departmentMatch = row.find("td:eq(4)").text().toLowerCase().includes(department);

                if (nameMatch && designationMatch && departmentMatch) {
                    row.show();
                    rowconut++;
                } else {
                    row.hide();
                }
            });
            if(rowconut == 0){$("#no-records").show();}
            else{$("#no-records").hide();}
        });

        $("#resetFilters").click(function () {
            $("#Userfilter-form input").val("");
            $("#users-table tbody tr").show();
        });
            $(document).on('click', '.deletetask', function (e) {
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
                        url: `task/deletetask/${userId}`, // URL for the DELETE request
                        type : 'DELETE',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
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
            // document.getElementById('theme-switcher').addEventListener('change', function() {
            //     let theme = this.value;

            //     fetch("{{ route('theme.switch') }}", {
            //         method: "POST",
            //         headers: {
            //             "X-CSRF-TOKEN": "{{ csrf_token() }}",
            //             "Content-Type": "application/json"
            //         },
            //         body: JSON.stringify({ theme: theme })
            //     }).then(response => response.json())
            //     .then(data => {
            //         if (data.success) {
            //             document.documentElement.setAttribute("data-theme", theme); // Change theme
            //         }
            //     });
            // });
        
   
    </script>
    
</body>
</html>
