@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card rounded shadow-lg">
        <div class="card-body">
            <div class="card-title mb-4 text-dark p-1 text-center">
                <h3>Create New Project</h3><hr>
            </div>
            <form id="create-project-form" action="#" enctype="application/x-www-form-urlencoded" method="POST">
                @csrf
                <!-- Project Name, Description, and Start Date -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="project-name" class="form-label fw-bold">Project Name</label>
                        <input type="text" class="form-control " id="project-name" name="name" required placeholder="Enter project name" style="border: 2px solid #bbb;">
                    </div>
                    <div class="col-md-4">
                        <label for="project-description" class="form-label fw-bold">Description</label>
                        <input type="text" class="form-control " id="project-description" name="description" required placeholder="Enter project description" style="border: 2px solid #bbb;">
                    </div>
                    <div class="col-md-4">
                        <label for="project-start-date" class="form-label fw-bold">Start Date</label>
                        <input type="date" class="form-control " id="project-start-date" name="start_date" required style="border: 2px solid #bbb;">
                    </div>
                </div>

                <!-- Project Deadline, Status, and Priority -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="project-deadline" class="form-label fw-bold">Deadline</label>
                        <input type="date" class="form-control " id="project-deadline" name="deadline" required style="border: 2px solid #bbb;">
                    </div>
                    <div class="col-md-4">
                        <label for="project-status" class="form-label fw-bold">Status</label>
                        <select class="form-control " id="project-status" name="status" required style="border: 2px solid #bbb;"> 
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="on_hold">On Hold</option>
                            <option value="not_started">Not Started</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="project-priority" class="form-label fw-bold">Priority</label>
                        <select class="form-control " id="project-priority" name="priority" required style="border: 2px solid #bbb;">
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                </div>

                <!-- Client, Budget, and Estimated Completion Time -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="project-client" class="form-label fw-bold">Client</label>
                        <input type="text" class="form-control " id="project-client" name="client" required placeholder="Enter client name" style="border: 2px solid #bbb;">
                    </div>
                    <div class="col-md-4">
                        <label for="project-budget" class="form-label fw-bold">Budget</label>
                        <input type="number" class="form-control " id="project-budget" name="budget" required placeholder="Enter project budget" style="border: 2px solid #bbb;">
                    </div>
                    <div class="col-md-4">
                        <label for="project-estimated-completion" class="form-label fw-bold">Estimated Completion Time</label>
                        <input type="text" class="form-control " id="project-estimated-completion" name="estimated_completion" required placeholder="Enter estimated completion time" style="border: 2px solid #bbb;">
                    </div>
                </div>

                <!-- Assigned Manager, Assigned Team, and Project Logo -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="project-manager" class="form-label fw-bold">Assigned Manager</label>
                        <input type="text" class="form-control " id="project-manager" name="manager" required placeholder="Enter manager name" style="border: 2px solid #bbb;">
                    </div>
                    <div class="col-md-4">
                        <label for="project-assigned-team" class="form-label fw-bold">Assigned Team</label>
                        <input type="text" class="form-control " id="project-assigned-team" name="assigned_team" required placeholder="Enter team name" style="border: 2px solid #bbb;">
                    </div>
                    <div class="col-md-4">
                        <label for="project-logo" class="form-label fw-bold">Project Logo</label>
                        <input type="file" class="form-control " id="project-logo" name="logo" accept="image/*" style="border: 2px solid #bbb;">
                    </div>
                </div>

               

                <div class="text-center">
                    <button type="submit" class="btn btn-warning px-5 py-2 rounded-pill shadow-lg" id="save-project-btn" style="font-weight: bold;">Save Project</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
