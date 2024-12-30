@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Users Overview </h3>
    <p class="mb-4 text-danger"><strong>Get insights into the user details</strong></p>
    {{-- <div class="d-flex">
    <div class="card me-3 border-0">
        <div class="card-body">
            Total Users
            <p>1000</p>
          </div>
    </div>
    <div class="card border-0 me-3">
        <div class="card-body">
            Active Users
            <p>56</p>
          </div>
    </div>
    <div class="card border-0 me-3">
        <div class="card-body">
                In-Active Users 
        
        <p>456</p>
        </div>
    </div>
    </div> --}} 
</div>
{{-- <p>678</p> --}}
<div class="container mt-5 ">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('adduser') }}">
            <button id="create-task-btn" class="btn btn-sm btn-success text-end">
                <i id="create-task-icon" class="fas fa-plus"></i> Create New Employee
            </button>
        </a>
        
        
    </div>   
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                {{-- <th>Category</th>
                <th>Priority</th>
                <th>DeadLine</th> --}}
                <th>Designation</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>


<div class="modal" tabindex="-1" id="viewUserModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">User Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  
  
  
@endsection
