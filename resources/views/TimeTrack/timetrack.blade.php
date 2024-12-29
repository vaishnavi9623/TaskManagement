@extends('layouts.app') <!-- Assuming a layout file exists -->

@section('title', 'Time Tracking')

@section('content')
<div class="container mt-5">
    <h3>Time Tracking</h3>
    <p class="mb-4 text-danger"><strong>Boost Productivity, Improve Planning, and Achieve Your Goals Efficiently</strong></p>
    <!-- Task List with Time Tracking -->
     <!-- Add Time Log -->
     <div class="card mt-4">
        <div class="card-header">
            <h4>Add Time Log</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="#"> <!-- Update route name -->
                @csrf
                <div class="form-group mb-3">
                    <label for="task">Task</label>
                    <select name="task_id" id="task" class="form-control" required>
                        <option value="">Select Task</option>
                        <!-- Dynamic Options -->
                        <option value="1">Design Homepage</option>
                        <option value="2">Develop API</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="start_time">Start Time</label>
                    <input type="datetime-local" name="start_time" id="start_time" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label for="end_time">End Time</label>
                    <input type="datetime-local" name="end_time" id="end_time" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Add Log</button>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Tasks and Time Logs</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Task Name</th>
                        <th>Assigned To</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Total Time Spent</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example Rows (dynamic content will come here) -->
                    <tr>
                        <td>Design Homepage</td>
                        <td>John Doe</td>
                        <td>09:00 AM</td>
                        <td>11:30 AM</td>
                        <td>2 hours 30 minutes</td>
                        <td>
                            <button class="btn btn-sm btn-primary">Edit</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Develop API</td>
                        <td>Jane Smith</td>
                        <td>10:00 AM</td>
                        <td>03:00 PM</td>
                        <td>5 hours</td>
                        <td>
                            <button class="btn btn-sm btn-primary">Edit</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

   
</div>
@endsection
