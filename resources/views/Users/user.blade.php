@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Users Overview </h3>
    <p class="mb-4 text-danger"><strong>Get insights into the user details</strong></p>
   
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


  
  
@endsection
