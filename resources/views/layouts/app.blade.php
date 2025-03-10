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
    @vite(['resources/css/app.css', 'resources/js/task.js', 'resources/js/user.js'])

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        var taskRoute = "{{ route('task', ['status' => '']) }}";
    </script>
    <style>
      
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
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color:#4dbfba">
            
            <button class="navbar-toggler" type="button" id="toggleSidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
            
        <!-- Logo or Title -->
        <a class="navbar-brand ms-3 text-white fw-bold" href="#" style="font-weight: bold !important; font-size: 20px !important; text-decoration: none !important;">
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
                        <a class="nav-link text-white" href="#">Logout</a>
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
        <div id="chat-icon" onclick="toggleChat()">
            <img src="{{ asset('images/chat.jpg') }}" alt="Chat Icon" width="75" height="50">
            <span id="chat-tooltip">Chat with Team</span>

        </div>

        <div id="chat-window">
            <div id="chat-messages"></div>
            <input type="text" id="chat-input" placeholder="Type a message..." />
            <button id="chat-send" onclick="sendMessage()">Send</button>
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

            //view of projects datatable....
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
        //Calender view...
        document.addEventListener('DOMContentLoaded', function() 
        {
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
        //to remove any alert...
        document.addEventListener('DOMContentLoaded', () => {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.remove();
                }, 3000); // 3000 ms = 3 seconds
            }
        });
        
        
    

            
    </script>
    
</body>
</html>
