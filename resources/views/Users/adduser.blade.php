@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card rounded">
        <div class="card-body">
            <div class="card-title mb-4 text-dark p-1 text-center">
                <h3>Create New Employee</h3><hr>
            </div>
            <form id="create-employee-form" action="{{route('user.save')}}" enctype="application/x-www-form-urlencoded" method="POST">
                @csrf
                <!-- Employee Name, Email, and Phone -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="employee-name" class="form-label fw-bold" style="color: #333;">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required style="border: 2px solid #bbb;">
                    </div>
                    <div class="col-md-4">
                        <label for="employee-email" class="form-label fw-bold" style="color: #333;">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required style="border: 2px solid #bbb;">
                    </div>
                    <div class="col-md-4">
                        <label for="employee-phone" class="form-label fw-bold" style="color: #333;">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required style="border: 2px solid #bbb;">
                    </div>
                </div>

                <!-- Employee Designation, Department, and Position -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="employee-designation" class="form-label fw-bold" style="color: #333;">Designation</label>
                        <input type="text" class="form-control" id="designation" name="designation" required style="border: 2px solid #bbb;">
                    </div>
                    <div class="col-md-4">
                        <label for="employee-department" class="form-label fw-bold" style="color: #333;">Department</label>
                        <select class="form-control" id="employee-department" name="department" required style="border: 2px solid #bbb;">
                            <option value="hr">HR</option>
                            <option value="development">Development</option>
                            <option value="marketing">Marketing</option>
                            <option value="sales">Sales</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="employee-position" class="form-label fw-bold" style="color: #333;">Position</label>
                        <select class="form-control" id="employee-position" name="position" required style="border: 2px solid #bbb;">
                            <option value="junior">Junior</option>
                            <option value="mid">Mid-level</option>
                            <option value="senior">Senior</option>
                            <option value="manager">Manager</option>
                        </select>
                    </div>
                </div>

                <!-- Employee Status, Joining Date, and Photo -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="employee-status" class="form-label fw-bold" style="color: #333;">Status</label>
                        <select class="form-control" id="employee-status" name="status" required style="border: 2px solid #bbb;">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="on_leave">On Leave</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="employee-joining-date" class="form-label fw-bold" style="color: #333;">Joining Date</label>
                        <input type="date" class="form-control" id="joining-date" name="joining_date" required style="border: 2px solid #bbb;">
                    </div>
                    <div class="col-md-4">
                        <label for="employee-photo" class="form-label fw-bold" style="color: #333;">Photo</label>
                        <input type="file" class="form-control" id="employee-photo" name="photo" accept="image/*" style="border: 2px solid #bbb;">
                    </div>
                </div>

                <!-- Employee Address (Full-width) -->
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="employee-address" class="form-label fw-bold" style="color: #333;">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="4" required style="border: 2px solid #bbb;"></textarea>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-warning px-4 py-2" id="save-employee-btn" style="font-weight: bold; border-radius: 10px;">Save Employee</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
