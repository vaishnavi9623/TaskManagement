@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded">
        <div class="card-body">
            <div class="card-title mb-4 text-dark p-2 text-center" style="background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div style="display: flex; justify-content: center; align-items: center;">
                    {{-- <i class="fas fa-user" style="font-size: 2rem; color: #007bff; margin-right: 15px;"></i> --}}
                    <span style="font-weight: bold; color: #333;">
                        <h3>Update Task Details</h3>
                        <p class="mb-1 text-danger"><strong>Monitor the current status and track the progress of every task efficiently</strong>
                        </p>

                    </span>
                </div>
                <hr style="border-top: 2px solid #007bff; width: 50%; margin: 10px auto;">
            </div>
            
            <form id="create-task-form" action="{{ route('task.update', $task->id) }}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <!-- Task Title -->
                <div class="row mb-4">
                    <div class="col-12">
                        <label for="task-title" class="form-label fw-bold" style="color: #333; font-size: 1rem;">Title</label>
                        <input type="text" class="form-control" id="title" name="title" style="padding: 10px;border: 2px solid #bbb;" value="{{old('title',$task->name)}}">
                    </div>
                </div>

                <!-- Task Description -->
                <div class="row mb-4">
                    <div class="col-12">
                        <label for="task-description" class="form-label fw-bold" style="color: #333;">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required style="padding: 10px;border: 2px solid #bbb;" >{{old('description',$task->description)}}</textarea>
                    </div>
                </div>

                <!-- Start DateTime -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="start-date" class="form-label fw-bold" style="color: #333;">Start Date</label>
                        <input type="date" class="form-control" id="start-date" name="starttime" value="{{ old('starttime', $task->starttime ?? '') }}" required style="border: 2px solid #bbb;">
                    </div>
                    <!-- End DateTime -->
                    <div class="col-md-4">
                        <label for="end-date" class="form-label fw-bold" style="color: #333;">End Date</label>
                        <input type="date" class="form-control" id="end-date" name="endtime" value="{{old('endtime',$task->endtime ?? '')}}" required style="border: 2px solid #bbb;">
                    </div>
                    <div class="col-md-4">
                        <label for="task-deadline" class="form-label fw-bold" style="color: #333;">Deadline</label>
                        <input type="date" class="form-control" id="task-deadline" name="deadline" value="{{old('deadline',$task->deadline ?? '')}}" required style="border: 2px solid #bbb;">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="task-assignee" class="form-label fw-bold" style="color: #333;">Assignee</label>
                        <select class="form-control" id="task-assignee" name="assign_to" required style="border: 2px solid #bbb;">
                            @foreach ($users as $user)
                               <option value="{{ $user->id }}" {{ $task->assign_to == $user->id ? 'selected' : '' }}>
                               {{ $user->name }}
                               </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="task-category" class="form-label fw-bold" style="color: #333;">Category</label>
                        <select class="form-control" id="task-category" name="category" required style="border: 2px solid #bbb;">
                            <option value="development" {{old('category',$task->category ?? '') == 'development' ? 'selected' :''}}>Development</option>
                            <option value="design" {{old('category',$task->category ?? '') == 'design' ? 'selected' :''}}>Design</option>
                            <option value="testing" {{old('category',$task->category ?? '') == 'testing' ? 'selected' :''}}>Testing</option>
                        </select>
                    </div>
                    
                    <div class="col-md-4">
                        <label for="task-recurring" class="form-label fw-bold" style="color: #333;">Recurring Task</label>
                        <select class="form-control" id="task-recurring" name="recurring_task" required style="border: 2px solid #bbb;">
                            <option value="no" {{old('recurring_task',$task->recurring_task ?? '') == 'no' ? 'selected' :''}}>No</option>
                            <option value="daily" {{old('recurring_task',$task->recurring_task ?? '') == 'daily' ? 'selected' :''}}>Daily</option>
                            <option value="weekly" {{old('recurring_task',$task->recurring_task ?? '') == 'weekly' ? 'selected' :''}}>Weekly</option>
                            <option value="monthly" {{old('recurring_task',$task->recurring_task ?? '') == 'monthly' ? 'selected' :''}}>Monthly</option>
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
                            <option value="low" {{old('priority',$task->priority ?? '') =='low' ? 'selected' : ''}}>Low</option>
                            <option value="medium" {{old('priority',$task->priority ?? '') =='medium' ? 'selected':''}}>Medium</option>
                            <option value="high" {{old('priority',$task->priority ??'') == 'high' ? 'selected':''}}>High</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="status" class="form-label fw-bold" style="color: #333;">Status</label>
                        <select class="form-control" id="status" name="status" required style="border: 2px solid #bbb;">
                            <option value="completed" {{ old('status',$task->status ?? '') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="inprogress" {{ old('status',$task->status ?? '') == 'inprogress' ? 'selected' : '' }}>In Progress</option>
                            <option value="pending" {{ old('status',$task->status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="upcoming" {{ old('status',$task->status ?? '') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>

                            <option value="overdue" {{ old('status',$task->status ?? '') == 'overdue' ? 'selected' : '' }}>Overdue</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <div class="row mb-4">
                            <div class="col-12">
                                <label for="task-notes" class="form-label fw-bold mt-2" style="color: #333;">Sub Tasks</label>
                                <div id="notes-section">
                                    @foreach($task->subTasks as $subTask)
                                        @foreach(explode(',', $subTask->title) as $titlePart)
                                            <div class="input-group mb-3 note-item">
                                                <input type="text" class="form-control" name="subtask[]" value="{{ trim($titlePart) }}" placeholder="Add a note" style="border: 2px solid #bbb;">
                                                <button type="button" class="btn btn-success ms-2 add-note-btn" style="border-radius: 5px;">+</button>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    

                </div>

                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-warning px-4 py-2" id="save-task-btn" style="font-weight: bold; ">Update Task</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
