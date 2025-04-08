@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Users Overview</h3>
    <p class="mb-4 text-danger fw-bold">Get insights into the user details</p>

    {{-- User Filter Form --}}
    <form method="" action="#" class="row g-3" id="Userfilter-form">
        <p class="fw-bold">Use the filters to find users easily</p>

        <div class="col-md-3">
            <input type="text" name="name"  id="name" class="form-control" placeholder="User Name" value="{{ request('name') }}">
        </div>
        <div class="col-md-3">
            <input type="text" name="designation" id="designation" class="form-control" placeholder="Designation" value="{{ request('designation') }}">
        </div>
        <div class="col-md-3">
            <input type="text" name="department" id="department" class="form-control" placeholder="Department" value="{{ request('department') }}">
        </div>
        <div class="col-md-3">
            {{-- <button type="btn" class="btn btn-primary" id="filterbtn">Filter</button> --}}
            <a href="{{ route('user') }}" class="btn btn-secondary" id="resetFilters">Reset</a>
        </div>
    </form>
</div>

{{-- User Table Section --}}
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('adduser') }}" class="btn btn-sm btn-success">
            <i class="fas fa-plus"></i> Create New Employee
        </a>
    </div>

    <table class="table table-bordered" id="users-table">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Photo</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <p id="no-records" class="text-center text-danger fw-bold" style="display: none;">No records found</p>
    </table>
</div>

{{-- View User Modal --}}
<div class="modal fade" id="viewUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-4">                

                <p>Loading...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Update Password Modal --}}
<div class="modal fade" id="updatePassModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Your Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-4">                

                <form id="updatePasswordForm" method="POST" action="#" data-id="">
                    
                    {{-- <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword" value="password123" required readonly>
                    </div> --}}
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword" required>
                        <small class="form-text text-danger">Must be at least 8 characters long.</small>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword" required>
                        <small id="passwordMatchMessage" class="form-text"></small>
                    </div>
                
           
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                <button type="submit" class="btn text-light" style="background-color:#4dbfba;">Update Password</button>
            </div>
        </form>
            </div>
        </div>
        </div>
    </div>
</div>

@endsection
