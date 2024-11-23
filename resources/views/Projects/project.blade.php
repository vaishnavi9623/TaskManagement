@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Projects Overview </h3>
    <p class="mb-4 text-danger"><strong>Get insights into the user details</strong></p>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link  {{ request()->is('project') ? 'active' : '' }}" aria-current="page" href="{{ route('project') }}">All</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  {{ request()->is('project/assigned') ? 'active' : '' }}" href="{{ route('project', ['status' => 'assigned']) }}">Assigned</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  {{ request()->is('project/pending') ? 'active' : '' }}" href="{{ route('project', ['status' => 'pending']) }}">Pending</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  {{ request()->is('project/completed') ? 'active' : '' }}" href="{{ route('project', ['status' => 'completed']) }}">Completed</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  {{ request()->is('project/overdue') ? 'active' : '' }}" href="{{ route('project', ['status' => 'overdue']) }}">Overdue</a>
        </li>
        <li class="nav-item">
            <a class="nav-link  {{ request()->is('project/upcoming') ? 'active' : '' }}" href="{{ route('task', ['status' => 'upcoming']) }}">Upcoming</a>
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
        <a href="#">
            <button id="create-task-btn" class="btn btn-sm btn-success text-end">
                <i id="create-task-icon" class="fas fa-plus"></i> Create New Projects
            </button>
        </a>
        
        
    </div>   
    <table class="table table-bordered" id="project-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Project Manager</th>
                <th>Assigned Team</th>
                <th>Start date</th>
                <th>End date</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>

 
@endsection
