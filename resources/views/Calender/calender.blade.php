@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Task Calendar</h3>
    <p class="mb-4 text-danger"><strong>Stay Organized and Track Your Tasks with Ease</strong></p>
    <div class="d-flex me-2 mb-3">
        <select id="viewSelector" class="form-control me-3">
        <option value="dayGridMonth">Month View</option>
        <option value="timeGridWeek">Week View</option>
        <option value="dayGridDay">Day View</option>
    </select>
    <input type="text" id="taskSearch" placeholder="Search Tasks" class="form-control">
    </div>

</div>
<div id="taskModal" class="modal">
    <div class="modal-content">
        <h4 id="modalTitle">Add New Task</h4>
        <form id="taskForm">
            <input type="text" id="taskTitle" placeholder="Task Title">
            <input type="date" id="taskStartDate">
            <input type="date" id="taskEndDate">
            <button type="submit">Save Task</button>
        </form>
    </div>
</div>
<div class="container mt-5 ">
    <div id="calendar"></div>

</div>

  
  
@endsection
