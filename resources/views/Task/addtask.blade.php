@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded">
        <div class="card-body">
            <div class="card-title mb-4 text-white p-1 text-center" style="background-color: #ff9100; border-radius: 5px;">
                <h2>Create New Task</h2>
            </div>
            <form id="create-task-form" action="{{route('task.save')}}" enctype="application/x-www-form-urlencoded" method="POST">
                @csrf
                <!-- Task Title -->
                <div class="row mb-4">
                    <div class="col-12">
                        <label for="task-title" class="form-label fw-bold" style="color: #333; font-size: 1rem;">Title</label>
                        <input type="text" class="form-control shadow-sm" id="title" name="title" required style="border-radius: 10px; padding: 10px;">
                    </div>
                </div>

                <!-- Task Description -->
                <div class="row mb-4">
                    <div class="col-12">
                        <label for="task-description" class="form-label fw-bold" style="color: #333;">Description</label>
                        <textarea class="form-control shadow-sm" id="description" name="description" rows="4" required style="border-radius: 10px; padding: 10px;"></textarea>
                    </div>
                </div>

                <!-- Start DateTime -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="start-date" class="form-label fw-bold" style="color: #333;">Start Date</label>
                        <input type="date" class="form-control shadow-sm" id="start-date" name="starttime" required style="border-radius: 10px;">
                    </div>
                    <!-- End DateTime -->
                    <div class="col-md-4">
                        <label for="end-date" class="form-label fw-bold" style="color: #333;">End Date</label>
                        <input type="date" class="form-control shadow-sm" id="end-date" name="endtime" required style="border-radius: 10px;">
                    </div>
                    <div class="col-md-4">
                        <label for="task-deadline" class="form-label fw-bold" style="color: #333;">Deadline</label>
                        <input type="date" class="form-control shadow-sm" id="task-deadline" name="deadline" required style="border-radius: 10px;">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="task-assignee" class="form-label fw-bold" style="color: #333;">Assignee</label>
                        <select class="form-control shadow-sm" id="task-assignee" name="assign_to" required style="border-radius: 10px;">
                            <option value="1">User 1</option>
                            <option value="2">User 2</option>
                            <option value="3">User 3</option>
                        </select>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="task-category" class="form-label fw-bold" style="color: #333;">Category</label>
                        <select class="form-control shadow-sm" id="task-category" name="category" required style="border-radius: 10px;">
                            <option value="development">Development</option>
                            <option value="design">Design</option>
                            <option value="testing">Testing</option>
                        </select>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="task-recurring" class="form-label fw-bold" style="color: #333;">Recurring Task</label>
                        <select class="form-control shadow-sm" id="task-recurring" name="recurring_task" required style="border-radius: 10px;">
                            <option value="no">No</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="task-attachments" class="form-label fw-bold" style="color: #333;">Attachments</label>
                        <input type="file" class="form-control shadow-sm" id="task-attachments" name="attachement" multiple>
                    </div>
                    <!-- Priority -->
                    <div class="col-md-4">
                        <label for="task-priority" class="form-label fw-bold" style="color: #333;">Priority</label>
                        <select class="form-control shadow-sm" id="task-priority" name="priority" required style="border-radius: 10px;">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="task-category" class="form-label fw-bold" style="color: #333;">Status</label>
                        <select class="form-control shadow-sm" id="status" name="status" required style="border-radius: 10px;">
                            <option value="completed">completed</option>
                            <option value="inprogress">inprogress</option>
                            <option value="overdue">overdue</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-warning shadow-sm px-4 py-2" id="save-task-btn" style="font-weight: bold; border-radius: 10px;">Save Task</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
