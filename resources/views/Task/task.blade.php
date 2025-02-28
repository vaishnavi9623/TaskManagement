@extends('layouts.app')

@section('content')
    
    <div class="container mt-4">
        <h3>Task Overview </h3>
    <p class="mb-4 text-danger"><strong>Get insights into the status and progress of all tasks</strong></p>
        <form method="GET" action="#" class="row g-3" id="filter-form">
            <p class="fw-bold">Use the filters to find tasks easily</p>
    
            <div class="col-sm-2">
                <input type="text" name="employee_name" class="form-control" placeholder="Employee Name" value="{{ request('employee_name') }}">
            </div>
            <div class="col-sm-2">
                <select name="priority" class="form-control">
                    <option value="">Select Priority</option>
                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>
            <div class="col-sm-2">
                <select name="status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="overdue" {{ request('status') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                </select>
            </div>
            <div class="col-sm-2">
                <select name="category" class="form-control">
                    <option value="">Select Category</option>
                    <option value="development" {{ request('category') == 'development' ? 'selected' : '' }}>Development</option>
                    <option value="design" {{ request('category') == 'design' ? 'selected' : '' }}>Design</option>
                    <option value="testing" {{ request('category') == 'testing' ? 'selected' : '' }}>Testing</option>
                </select>
            </div>
            
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('task') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>
    <div class="container mt-5">

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link  {{ request()->is('task') ? 'active' : '' }}" aria-current="page" href="{{ route('task') }}">All</a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link  {{ request()->is('task/assigned') ? 'active' : '' }}" href="{{ route('task', ['status' => 'assigned']) }}">Assigned</a>
        </li> --}}
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

<div class="modal" tabindex="-1" id="viewTaskModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Task Details</h5>
          <button type="button"  class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Loading...</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  
  
@endsection
