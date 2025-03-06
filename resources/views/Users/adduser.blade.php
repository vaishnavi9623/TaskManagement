@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card rounded">
        <div class="card-body">
            <div class="card-title mb-4 text-dark p-2 text-center" style="background-color: #f8f9fa; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div style="display: flex; justify-content: center; align-items: center;">
                    {{-- <i class="fas fa-user" style="font-size: 2rem; color: #007bff; margin-right: 15px;"></i> --}}
                    <span style="font-weight: bold; color: #333;">
                        <h3>Create New Employee</h3>
                    </span>
                </div>
                <hr style="border-top: 2px solid #007bff; width: 50%; margin: 10px auto;">
            </div>
            
            
            <form id="create-employee-form" action="{{route('user.save')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <!-- Employee Name, Email, and Phone -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="employee-name" class="form-label fw-bold" style="color: #333;">Name</label><span class="text-danger fw-bold">*</span>
                        <input type="text" class="form-control" id="name" name="name" style="border: 2px solid #bbb;">
                        @error('name')
                        <div class="text-danger fw-bold"><small>{{$message}}</small></div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="employee-email" class="form-label fw-bold" style="color: #333;">Email</label><span class="text-danger fw-bold">*</span>
                        <input type="email" class="form-control" id="email" name="email"  style="border: 2px solid #bbb;">
                        @error('email')
                        <div class="text-danger fw-bold"><small>{{$message}}</small></div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="employee-phone" class="form-label fw-bold" style="color: #333;">Phone</label><span class="text-danger fw-bold">*</span>
                        <input type="text" class="form-control" id="phone_number" name="phone_number"  style="border: 2px solid #bbb;">
                        @error('phone_number')
                        <div class="text-danger fw-bold"><small>{{$message}}</small></div>
                        @enderror
                    </div>
                </div>

                <!-- Employee Designation, Department, and Position -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="employee-designation" class="form-label fw-bold" style="color: #333;">Designation</label><span class="text-danger fw-bold">*</span>
                        <input type="text" class="form-control" id="designation" name="designation"  style="border: 2px solid #bbb;">
                        @error('designation')
                        <div class="text-danger fw-bold"><small>{{$message}}</small></div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="employee-department" class="form-label fw-bold" style="color: #333;">Department</label><span class="text-danger fw-bold">*</span>
                        <select class="form-control" id="department" name="department"  style="border: 2px solid #bbb;">
                            <option value="hr">HR</option>
                            <option value="development">Development</option>
                            <option value="marketing">Marketing</option>
                            <option value="sales">Sales</option>
                        </select>
                        @error('department')
                        <div class="text-danger fw-bold"><small>{{$message}}</small></div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="employee-position" class="form-label fw-bold" style="color: #333;">Position</label><span class="text-danger fw-bold">*</span>
                        <select class="form-control" id="position" name="position"  style="border: 2px solid #bbb;">
                            <option value="junior">Junior</option>
                            <option value="mid">Mid-level</option>
                            <option value="senior">Senior</option>
                            <option value="manager">Manager</option>
                        </select>
                        @error('position')
                        <div class="text-danger fw-bold"><small>{{$message}}</small></div>
                        @enderror
                    </div>
                </div>

                <!-- Employee Status, Joining Date, and Photo -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="employee-status" class="form-label fw-bold" style="color: #333;">Status</label><span class="text-danger fw-bold">*</span>
                        <select class="form-control" id="status" name="status"  style="border: 2px solid #bbb;">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="on_leave">On Leave</option>
                        </select>
                        @error('status')
                        <div class="text-danger fw-bold"><small>{{$message}}</small></div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="employee-joining-date" class="form-label fw-bold" style="color: #333;">Joining Date</label><span class="text-danger fw-bold">*</span>
                        <input type="date" class="form-control" id="joining-date" name="joining_date"  style="border: 2px solid #bbb;">
                        @error('joining_date')
                        <div class="text-danger fw-bold"><small>{{$message}}</small></div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="employee-photo" class="form-label fw-bold" style="color: #333;">Photo</label><span class="text-danger fw-bold">*</span>
                        <input type="file" class="form-control" id="employee-photo" name="photo" accept="image/*" style="border: 2px solid #bbb;">
                        @error('photo')
                        <div class="text-danger fw-bold"><small>{{$message}}</small></div>
                        @enderror
                    </div>
                </div>

                <!-- Employee Address (Full-width) -->
                <div class="row mb-3">
                    <div class="col-12">
                        <label for="employee-address" class="form-label fw-bold" style="color: #333;">Address</label><span class="text-danger fw-bold">*</span>
                        <textarea class="form-control" id="address" name="address" rows="4"  style="border: 2px solid #bbb;"></textarea>
                        @error('address')
                        <div class="text-danger fw-bold"><small>{{$message}}</small></div>
                        @enderror
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
