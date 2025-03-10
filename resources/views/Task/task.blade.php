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

<div class="modal fade" id="viewTaskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Task Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
          
            <div class="modal-body">
                <p>Loading...</p>
            </div>
            <div class="card ml-5" style="margin-left: 20px;margin-right:20px;">
                <div class="card-body">
                    <form id="updateTaskStatusForm" method="POST" action="{{route('updatestatus')}}" enctype="multipart/form-data">
                        @csrf
                        {{-- @method('PUT') --}}
                        <div class="mb-3">
                            <label for="taskStatus" class="form-label">Update Task Status</label>
                            <select class="form-select" id="taskStatus" name="status">
                                <option value="completed">Completed</option>
                                <option value="inprogress">In Progress</option>
                                <option value="overdue">Overdue</option>
                                <option value="pending">Pending</option>
                                <option value="upcoming">Upcoming</option>
                            </select>
                        </div>
                        <input type="hidden" class="form-control" id="taskids" name="taskids">

                        <div class="mb-3">
                            <label for="taskAttachment" class="form-label">Attach File (Optional)</label>
                            <input type="file" class="form-control" id="taskAttachment" name="attachment">
                        </div>
                    
                    
                        <button type="submit" class="btn text-white fw-bold" style="background-color:#4dbfba;">Update Status</button>
                    </form>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

  <!-- Add Note Modal -->
<div class="modal fade" id="addNoteModal" tabindex="-1" aria-labelledby="addNoteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNoteLabel">Add/View Notes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Accordion for Previous Notes -->
                <div class="accordion mb-2 max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-4" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                View Your Previous Notes...
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse mb-5" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <ul id="notesList" class="list-group">
                                    <!-- Notes will be inserted here dynamically -->
                                </ul>
                            </div>
                        </div>
                    </div>
                     <!-- New Note Form -->
                <form id="addNoteForm" method="POST" action="{{route('savenote')}}" enctype="application/x-www-form-urlencoded">
                    @csrf
                    <input type="hidden" id="task_id" name="task_id">
                    <div class="mb-3">
                        <label for="note_text mt-2" class="form-label">Your Note:</label>
                        <textarea class="form-control" id="note_text" name="note" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn text-white" style="font-weight: bold;background-color:#4dbfba">Save Note</button>
                </form>
                </div>

               
            </div>
        </div>
    </div>
</div>

<!-- Add Comment Modal -->
<div class="modal fade" id="addCommentModal" tabindex="-1" aria-labelledby="addCommentModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add/View Comments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-4">                

                    <!-- Scrollable Comment Section -->
                    <div class="comment-container" style="max-height: 400px; overflow-y: auto; padding-right: 10px;" id="CommentList">
                    </div>
                    <div class="mt-4">
                        <form id="addCommentForm" method="POST" action="{{route('savecomment')}}" enctype="application/x-www-form-urlencoded">
                        @csrf
                        <input type="hidden" id="taskid" name="taskid">
                        <textarea class="form-control" rows="3" name="comments" id="comments" placeholder="Write a comment..."></textarea>
                        <button type="submit" class="btn  mt-2 text-white" style="font-weight: bold;background-color:#4dbfba">Post Comment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
