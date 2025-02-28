@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded">
        <div class="card-body">
            <div class="card-title mb-4 text-dark p-2 text-center" style="background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div style="display: flex; justify-content: center; align-items: center;">
                    <span style="font-weight: bold; color: #333;">
                        <h3>Create New Task</h3>
                        <p class="mb-1 text-danger"><strong>Monitor the current status and track the progress of every task efficiently</strong></p>
                    </span>
                </div>
                <hr style="border-top: 2px solid #007bff; width: 50%; margin: 10px auto;">
            </div>
            
            <form id="create-task-form" action="{{route('task.save')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <!-- Task Title -->
                <div class="row mb-4">
                    <div class="col-12">
                        <label for="task-title" class="form-label fw-bold" style="color: #333; font-size: 1rem;">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required style="padding: 10px;border: 2px solid #bbb;">
                        @error('title')
                        <div class="text-danger fw-bold"><small>{{$message}}</small></div>
                        @enderror
                    </div>
                </div>

                <!-- Task Description -->
                <div class="row mb-4">
                    <div class="col-12">
                        <label for="task-description" class="form-label fw-bold" style="color: #333;">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required style="padding: 10px;border: 2px solid #bbb;"></textarea>
                    </div>
                </div>

                <!-- Start DateTime -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="start-date" class="form-label fw-bold" style="color: #333;">Start Date</label>
                        <input type="date" class="form-control" id="start-date" name="starttime" required style="border: 2px solid #bbb;">
                    </div>
                    <!-- End DateTime -->
                    <div class="col-md-4">
                        <label for="end-date" class="form-label fw-bold" style="color: #333;">End Date</label>
                        <input type="date" class="form-control" id="end-date" name="endtime" required style="border: 2px solid #bbb;">
                    </div>
                    <div class="col-md-4">
                        <label for="task-deadline" class="form-label fw-bold" style="color: #333;">Deadline</label>
                        <input type="date" class="form-control" id="task-deadline" name="deadline" required style="border: 2px solid #bbb;">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="task-assignee" class="form-label fw-bold" style="color: #333;">Assignee</label>
                        <select class="form-control" id="task-assignee" name="assign_to" required style="border: 2px solid #bbb;">
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="task-category" class="form-label fw-bold" style="color: #333;">Category</label>
                        <select class="form-control" id="task-category" name="category" required style="border: 2px solid #bbb;">
                            <option value="development">Development</option>
                            <option value="design">Design</option>
                            <option value="testing">Testing</option>
                        </select>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="task-recurring" class="form-label fw-bold" style="color: #333;">Recurring Task</label>
                        <select class="form-control" id="task-recurring" name="recurring_task" required style="border: 2px solid #bbb;">
                            <option value="no">No</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                        </select>
                    </div>
                </div>

               
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="task-attachments" class="form-label fw-bold" style="color: #333;">Attachments</label>
                        <input type="file" class="form-control" id="task-attachments" name="attachement" multiple style="border: 2px solid #bbb;">
                    </div>
                    <!-- Priority -->
                    <div class="col-md-4">
                        <label for="task-priority" class="form-label fw-bold" style="color: #333;">Priority</label>
                        <select class="form-control" id="task-priority" name="priority" required style="border: 2px solid #bbb;">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="status" class="form-label fw-bold" style="color: #333;">Status</label>
                        <select class="form-control" id="status" name="status" required style="border: 2px solid #bbb;">
                            <option value="completed">Completed</option>
                            <option value="inprogress">In Progress</option>
                            <option value="overdue">Overdue</option>
                            <option value="pending">Pending</option>
                            <option value="upcoming">Upcoming</option>

                        </select>
                    </div>
                </div>
            <!-- Notes Section -->
            <div class=" mb-4 ">
                <div class="row mb-4">
                    <div class="col-12">
                        <label for="task-notes" class="form-label fw-bold" style="color: #333;">Sub Tasks</label>
                        <div id="notes-section">
                            <div class="input-group mb-3 note-item">
                                <input type="text" class="form-control " name="subtask[]" placeholder="Add a note" style="border: 2px solid #bbb;">
                                <button type="button" class="btn btn-success ms-2" id="add-note-btn" style="border-radius: 5px;">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-warning px-4 py-2" id="save-task-btn" style="font-weight: bold;">Save Task</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('add-note-btn').addEventListener('click', function () {
        const notesSection = document.getElementById('notes-section');
        const noteItem = document.createElement('div');
        noteItem.classList.add('input-group', 'mb-3', 'note-item');
        noteItem.innerHTML = `
            <input type="text" class="form-control" name="subtask[]" placeholder="Add a note" style="border: 2px solid #bbb;">
            <button type="button" class="btn btn-danger remove-note-btn ms-2" style="border-radius: 5px;">-</button>
        `;
        notesSection.appendChild(noteItem);

        noteItem.querySelector('.remove-note-btn').addEventListener('click', function () {
            noteItem.remove();
        });
    });
</script>

@endsection
