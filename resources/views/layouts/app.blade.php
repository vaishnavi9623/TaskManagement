<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Dashboard') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

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
            background-color: #343a40;
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
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#" title="Dashboard">
                    <i class="fas fa-tasks"></i> <span class="d-none d-md-inline">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" title="Users">
                    <i class="fas fa-user"></i> <span class="d-none d-md-inline">Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('task') }}" title="Task">
                    <i class="fas fa-list-check"></i> <span class="d-none d-md-inline">Task</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" title="Projects">
                    <i class="fas fa-project-diagram"></i> <span class="d-none d-md-inline">Projects</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" title="Team">
                    <i class="fas fa-users"></i> <span class="d-none d-md-inline">Team</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" title="Time Tracking">
                    <i class="fas fa-clock"></i> <span class="d-none d-md-inline">Time Tracking</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" title="Calendar">
                    <i class="fas fa-calendar-alt"></i> <span class="d-none d-md-inline">Calendar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" title="Reports">
                    <i class="fas fa-chart-line"></i> <span class="d-none d-md-inline">Reports</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" title="Notifications">
                    <i class="fas fa-bell"></i> <span class="d-none d-md-inline">Notifications</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" title="Settings">
                    <i class="fas fa-cog"></i> <span class="d-none d-md-inline">Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" title="Logout">
                    <i class="fas fa-sign-out-alt"></i> <span class="d-none d-md-inline">Logout</span>
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
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
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
            // $('#create-task-btn').click(function(){
            //     $('#taskmodel').modal('show');
            // });

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
                    { data: 'status', name: 'status' },
                    { data: 'category', name: 'category' },
                    { data: 'priority', name: 'priority' },
                    { data: 'deadline', name: 'deadline' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            
        });
        
        
    </script>
</body>
</html>
