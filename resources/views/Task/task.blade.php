@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Task Overview </h3>
    <p class="mb-4 text-danger"><strong>Get insights into the status and progress of all tasks</strong></p>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link  {{ request()->is('task') ? 'active' : '' }}" aria-current="page" href="{{ route('task') }}">All</a>
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
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('addtask') }}">
            <button id="create-task-btn" class="btn btn-sm btn-success text-end">
                <i id="create-task-icon" class="fas fa-plus"></i> Create New Task
            </button>
        </a>
        
        
    </div>   
    <table class="table table-bordered" id="tasks-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Priority</th>
                <th>DeadLine</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>


  
  
@endsection
