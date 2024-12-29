@extends('layouts.app')

@section('title', 'Task Manager Reports')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Task Manager Reports</h1>

    <!-- Filters Section (Static Filters) -->
    <div class="card mb-4">
        <div class="card-body">
            <form id="reportFilters">
                <div class="row">
                    <div class="col-md-3">
                        <label for="dateRange">Date Range</label>
                        <input type="text" class="form-control" id="dateRange" placeholder="Select date range" value="01 Jan 2024 - 31 Jan 2024">
                    </div>
                    <div class="col-md-3">
                        <label for="taskOwner">Task Owner</label>
                        <select class="form-control" id="taskOwner">
                            <option value="">All</option>
                            <option value="1">John Doe</option>
                            <option value="2">Jane Smith</option>
                            <option value="3">David Lee</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="taskStatus">Status</label>
                        <select class="form-control" id="taskStatus">
                            <option value="">All</option>
                            <option value="Completed">Completed</option>
                            <option value="Pending">Pending</option>
                            <option value="Overdue">Overdue</option>
                        </select>
                    </div>
                    <div class="col-md-3 align-self-end">
                        <button type="button" class="btn btn-primary" id="applyFilters">Apply Filters</button>
                        <button type="button" class="btn btn-success" id="exportReport">Export</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Insights Section (Static Insights with New Color Scheme) -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card text-white bg-dark">
                <div class="card-body">
                    <h5 class="card-title">Monthly Performance</h5>
                    <p>85% of tasks were completed on time in January 2024.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Top Performer</h5>
                    <p>Jane Smith completed 60 tasks this month with 98% on-time delivery.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section (Updated Data for Static Charts) -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Task Status Distribution</div>
                <div class="card-body">
                    <canvas id="taskStatusChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Task Trends</div>
                <div class="card-body">
                    <canvas id="taskTrendsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Task Reports Table (Static Data) -->
    <div class="card mb-4">
        <div class="card-header">Task Report</div>
        <div class="card-body">
            <table class="table table-bordered" id="taskReportTable">
                <thead>
                    <tr>
                        <th>Task Name</th>
                        <th>Assigned To</th>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Design Landing Page</td>
                        <td>John Doe</td>
                        <td>Completed</td>
                        <td>01 Jan 2024</td>
                        <td>10 Jan 2024</td>
                        <td><button class="btn btn-sm btn-info">View</button></td>
                    </tr>
                    <tr>
                        <td>Develop API for Login</td>
                        <td>Jane Smith</td>
                        <td>Pending</td>
                        <td>05 Jan 2024</td>
                        <td>15 Jan 2024</td>
                        <td><button class="btn btn-sm btn-info">View</button></td>
                    </tr>
                    <tr>
                        <td>Test Payment Gateway</td>
                        <td>David Lee</td>
                        <td>Overdue</td>
                        <td>10 Jan 2024</td>
                        <td>20 Jan 2024</td>
                        <td><button class="btn btn-sm btn-info">View</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Project Reports Table (Static Data) -->
    <div class="card mb-4">
        <div class="card-header">Project Report</div>
        <div class="card-body">
            <table class="table table-bordered" id="projectReportTable">
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Assigned To</th>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Website Redesign</td>
                        <td>John Doe</td>
                        <td>Completed</td>
                        <td>01 Dec 2023</td>
                        <td>10 Jan 2024</td>
                    </tr>
                    <tr>
                        <td>App Development</td>
                        <td>Jane Smith</td>
                        <td>In Progress</td>
                        <td>10 Jan 2024</td>
                        <td>30 Mar 2024</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- User Reports Table (Static Data) -->
    <div class="card mb-4">
        <div class="card-header">User Activity Report</div>
        <div class="card-body">
            <table class="table table-bordered" id="userReportTable">
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Total Tasks</th>
                        <th>Completed Tasks</th>
                        <th>Pending Tasks</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>John Doe</td>
                        <td>50</td>
                        <td>48</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>Jane Smith</td>
                        <td>30</td>
                        <td>25</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td>David Lee</td>
                        <td>40</td>
                        <td>38</td>
                        <td>2</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Static Data for Task Status Distribution (Updated with More Realistic Data)
        new Chart(document.getElementById('taskStatusChart'), {
            type: 'pie',
            data: {
                labels: ['Completed', 'Pending', 'Overdue', 'In Progress', 'On Hold'],
                datasets: [{
                    data: [55, 25, 10, 5, 5],  // Static data representing task distribution
                    backgroundColor: ['#28a745', '#ffc107', '#dc3545', '#17a2b8', '#6c757d'],  // Custom color palette
                }]
            }
        });

        // Static Data for Task Trends (Updated with More Realistic Data)
        new Chart(document.getElementById('taskTrendsChart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'], // Static months
                datasets: [{
                    label: 'Tasks Completed',
                    data: [120, 150, 180, 200, 250],  // Static task completion data showing growth
                    fill: false,
                    borderColor: '#28a745',  // Green for completed tasks
                    tension: 0.1
                },
                {
                    label: 'Tasks Pending',
                    data: [60, 50, 40, 30, 20],  // Static task pending data showing reduction
                    fill: false,
                    borderColor: '#ffc107',  // Yellow for pending tasks
                    tension: 0.1
                }]
            }
        });
    });
</script>
@endsection
