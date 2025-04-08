@extends('layouts.app')

@section('content')
    
    <div class="container mt-4">
        <h3>Team Management Overview</h3>
        <p class="mb-4 text-danger"><strong>Get insights into the status and progress of all teams</strong></p>
        <form method="GET" action="#" class="row g-3" id="filter-form">
            <p class="fw-bold">Use the filters to find teams easily</p>
    
            <div class="col-sm-2">
                <input type="text" name="team_name" class="form-control" placeholder="Team Name" value="{{ request('team_name') }}">
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
                <a href="#" class="btn btn-secondary">Reset</a>
            </div>
        </form>
    </div>

    <div class="container mt-5">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('addteam') }}">
                <button class="btn btn-sm btn-success">
                    <i class="fas fa-plus"></i> Create New Team
                </button>
            </a>
        </div>
        
        <table class="table table-bordered" id="teams-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Team Name</th>
                    <th>Description</th>
                    <th>Members</th>
                    <th>Lead</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
           
        </table>
    </div>
{{-- View Teams Model --}}
<div class="modal fade" id="viewTeamModal" tabindex="-1" aria-labelledby="teamModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="teamModalLabel">Teams Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
