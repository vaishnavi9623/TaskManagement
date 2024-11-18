@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Task Overview </h3>
    <p class="mb-4 text-danger"><strong>Get insights into the status and progress of all tasks</strong></p>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link  {{ request()->is('') ? 'active' : '' }}" aria-current="page" href="{{ route('task') }}">All</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  {{ request()->is('task/assigned') ? 'active' : '' }}" href="{{ route('task', ['status' => 'assigned']) }}">Assigned</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  {{ request()->is('task/pending') ? 'active' : '' }}" href="{{ route('task', ['status' => 'pending']) }}">Pending</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  {{ request()->is('task/completed') ? 'active' : '' }}" href="{{ route('task', ['status' => 'completed']) }}">Completed</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  {{ request()->is('task/overdue') ? 'active' : '' }}" href="{{ route('task', ['status' => 'overdue']) }}">Overdue</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  {{ request()->is('task/upcoming') ? 'active' : '' }}" href="{{ route('task', ['status' => 'upcoming']) }}">Upcoming</a>
        </li>
    </ul>
</div>

<div class="container mt-5 ">
    <div class="d-flex justify-content-end mb-2">
    <button id="create-task-btn " class="btn btn-sm btn-success text-end">
        <i id="create-task-icon" class="fas fa-plus"></i> Create New Task
    </button> 
    </div>   
    <table class="table table-bordered" id="tasks-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        {{-- <tbody>
            @if(isset($tasks) && $tasks->count() > 0)
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->status }}</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm">View</a>
                            <a href="#" class="btn btn-warning btn-sm">Edit</a>
                            <form action="#" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">No tasks available</td>
                </tr>
            @endif
        </tbody> --}}
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var status = window.location.pathname.split('/').pop();
        if (status === 'task') {
            status = null; 
        }
        $('#tasks-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('task', ['status' => '']) }}' + (status ? '/' + status : ''),
                data: function (d) {
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'description', name: 'description' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
    </script>
@endsection
