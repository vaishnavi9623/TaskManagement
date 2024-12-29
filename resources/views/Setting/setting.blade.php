@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card rounded shadow-lg">
        <div class="card-body">
            <!-- Attractive Header for Settings -->
            <div class="card-title mb-4 text-center">
                <h2 class="fw-bold text-primary" style="font-size: 32px; letter-spacing: 1px;">Task Manager Settings</h2>
                <hr style="border-top: 2px solid #f39c12; width: 60%; margin: 0 auto;">
            </div>

            <form id="settings-form" action="#" method="POST" enctype="application/x-www-form-urlencoded">
                @csrf
                <!-- Task Priority Settings -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="task-priority" class="form-label fw-bold">Default Task Priority</label>
                        <select class="form-control shadow-sm" id="task-priority" name="task_priority" required style="border: 2px solid #bbb;">
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="default-status" class="form-label fw-bold">Default Task Status</label>
                        <select class="form-control shadow-sm" id="default-status" name="default_status" required style="border: 2px solid #bbb;">
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="on_hold">On Hold</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="status-color" class="form-label fw-bold">Status Color</label>
                        <input type="color" class="form-control shadow-sm" id="status-color" name="status_color" value="#3498db" style="border: 2px solid #bbb;">
                    </div>
                </div>

                <!-- Task Notifications Settings -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="email-notifications" class="form-label fw-bold">Email Notifications</label>
                        <select class="form-control shadow-sm" id="email-notifications" name="email_notifications" required style="border: 2px solid #bbb;">
                            <option value="enabled">Enabled</option>
                            <option value="disabled">Disabled</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="sms-notifications" class="form-label fw-bold">SMS Notifications</label>
                        <select class="form-control shadow-sm" id="sms-notifications" name="sms_notifications" required style="border: 2px solid #bbb;">
                            <option value="enabled">Enabled</option>
                            <option value="disabled">Disabled</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="push-notifications" class="form-label fw-bold">Push Notifications</label>
                        <select class="form-control shadow-sm" id="push-notifications" name="push_notifications" required style="border: 2px solid #bbb;">
                            <option value="enabled">Enabled</option>
                            <option value="disabled">Disabled</option>
                        </select>
                    </div>
                </div>

                <!-- Theme Settings -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="theme-selection" class="form-label fw-bold">Theme Selection</label>
                        <select class="form-control shadow-sm" id="theme-selection" name="theme_selection" required style="border: 2px solid #bbb;">
                            <option value="light">Light</option>
                            <option value="dark">Dark</option>
                            <option value="auto">Auto</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="font-size" class="form-label fw-bold">Font Size</label>
                        <select class="form-control shadow-sm" id="font-size" name="font_size" required style="border: 2px solid #bbb;">
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="language" class="form-label fw-bold">Language</label>
                        <select class="form-control shadow-sm" id="language" name="language" required style="border: 2px solid #bbb;">
                            <option value="en">English</option>
                            <option value="es">Spanish</option>
                            <option value="fr">French</option>
                            <option value="de">German</option>
                        </select>
                    </div>
                </div>
                <!-- Additional Settings -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="default-assignee" class="form-label fw-bold">Default Assignee</label>
                        <select class="form-control shadow-sm" id="default-assignee" name="default_assignee" style="border: 2px solid #bbb;">
                            <option value="user1">User 1</option>
                            <option value="user2">User 2</option>
                            <option value="user3">User 3</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="reminder-settings" class="form-label fw-bold">Reminder Settings</label>
                        <select class="form-control shadow-sm" id="reminder-settings" name="reminder_settings" required style="border: 2px solid #bbb;">
                            <option value="1_day_before">1 Day Before</option>
                            <option value="1_hour_before">1 Hour Before</option>
                            <option value="30_min_before">30 Min Before</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="due-date-config" class="form-label fw-bold">Due Date Configuration</label>
                        <select class="form-control shadow-sm" id="due-date-config" name="due_date_config" required style="border: 2px solid #bbb;">
                            <option value="enable">Enable Default Due Dates</option>
                            <option value="disable">Disable Due Dates</option>
                        </select>
                    </div>
                </div>

                <!-- Account Settings -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="account-deletion" class="form-label fw-bold text-danger">Delete Account</label>
                        <button type="button" class="btn btn-danger w-100" id="account-deletion" style="font-weight: bold;">Delete Account</button>
                    </div>
                    <div class="col-md-4">
                        <label for="change-password" class="form-label fw-bold">Change Password</label>
                        <a href="" class="btn btn-warning w-100" style="font-weight: bold;">Change Password</a>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success px-5 py-2 rounded-pill shadow-lg" id="save-settings-btn" style="font-weight: bold;">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
