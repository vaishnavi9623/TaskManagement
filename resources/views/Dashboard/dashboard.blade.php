    @extends('layouts.app')

    @section('content')

    <div class="container mt-5">
        <!-- Dashboard Header -->
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="fw-bold" style="color: #0D1B2A; font-size: 2.5rem;">Dashboard Overview</h1>
                <p class="text-muted" style="font-size: 1.2rem;">Get insights into your tasks, projects, and performance.</p>
            </div>
        </div>

        <!-- Cards Section -->
        <div class="row mt-4">
            <!-- Card 1: Total Tasks -->
            <div class="col-md-3 mb-4">
                <div class="card custom-card text-center">
                    <div class="card-body">
                        <i class="fas fa-tasks fs-2 mb-3" style="color: #1EAE98;"></i>
                        <h5 class="fw-bold" style="color: #0D1B2A;">Total Tasks</h5>
                        <h3 class="fw-bold" style="color: #1EAE98;">200</h3>
                        <p class="text-muted">Assigned Tasks</p>
                        <a href="#" class="btn btn-outline-success w-100 rounded-pill">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Card 2: Completed Projects -->
            <div class="col-md-3 mb-4">
                <div class="card custom-card text-center">
                    <div class="card-body">
                        <i class="fas fa-project-diagram fs-2 mb-3" style="color: #FF7A5A;"></i>
                        <h5 class="fw-bold" style="color: #0D1B2A;">Completed Projects</h5>
                        <h3 class="fw-bold" style="color: #FF7A5A;">150</h3>
                        <p class="text-muted">Completed Projects</p>
                        <a href="#" class="btn btn-outline-danger w-100 rounded-pill">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Card 3: Active Users -->
            <div class="col-md-3 mb-4">
                <div class="card custom-card text-center">
                    <div class="card-body">
                        <i class="fas fa-users fs-2 mb-3" style="color: #735DFF;"></i>
                        <h5 class="fw-bold" style="color: #0D1B2A;">Active Users</h5>
                        <h3 class="fw-bold" style="color: #735DFF;">3,200</h3>
                        <p class="text-muted">Users Engaged</p>
                        <a href="#" class="btn btn-outline-primary w-100 rounded-pill">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Card 4: Revenue -->
            <div class="col-md-3 mb-4">
                <div class="card custom-card text-center">
                    <div class="card-body">
                        <i class="fas fa-dollar-sign fs-2 mb-3" style="color: #FFC107;"></i>
                        <h5 class="fw-bold" style="color: #0D1B2A;">Revenue</h5>
                        <h3 class="fw-bold" style="color: #FFC107;">$45,000</h3>
                        <p class="text-muted">This Month</p>
                        <a href="#" class="btn btn-outline-warning w-100 rounded-pill">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Card 5: Pending Approvals -->
            <div class="col-md-3 mb-4">
                <div class="card custom-card text-center">
                    <div class="card-body">
                        <i class="fas fa-clock fs-2 mb-3" style="color: #FF9A3C;"></i>
                        <h5 class="fw-bold" style="color: #0D1B2A;">Pending Approvals</h5>
                        <h3 class="fw-bold" style="color: #FF9A3C;">50</h3>
                        <p class="text-muted">Requests Pending</p>
                        <a href="#" class="btn btn-outline-warning w-100 rounded-pill">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Card 6: Support Tickets -->
            <div class="col-md-3 mb-4">
                <div class="card custom-card text-center">
                    <div class="card-body">
                        <i class="fas fa-headset fs-2 mb-3" style="color: #1E90FF;"></i>
                        <h5 class="fw-bold" style="color: #0D1B2A;">Support Tickets</h5>
                        <h3 class="fw-bold" style="color: #1E90FF;">120</h3>
                        <p class="text-muted">Open Tickets</p>
                        <a href="#" class="btn btn-outline-primary w-100 rounded-pill">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Card 7: Productivity -->
            <div class="col-md-3 mb-4">
                <div class="card custom-card text-center">
                    <div class="card-body">
                        <i class="fas fa-chart-line fs-2 mb-3" style="color: #28A745;"></i>
                        <h5 class="fw-bold" style="color: #0D1B2A;">Productivity</h5>
                        <h3 class="fw-bold" style="color: #28A745;">85%</h3>
                        <p class="text-muted">Efficiency Level</p>
                        <a href="#" class="btn btn-outline-success w-100 rounded-pill">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Card 8: Notifications -->
            <div class="col-md-3 mb-4">
                <div class="card custom-card text-center">
                    <div class="card-body">
                        <i class="fas fa-bell fs-2 mb-3" style="color: #FF4560;"></i>
                        <h5 class="fw-bold" style="color: #0D1B2A;">Notifications</h5>
                        <h3 class="fw-bold" style="color: #FF4560;">35</h3>
                        <p class="text-muted">Unread Alerts</p>
                        <a href="#" class="btn btn-outline-danger w-100 rounded-pill">View Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
    