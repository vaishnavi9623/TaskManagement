@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card rounded shadow-lg">
        <div class="card-body">
            <!-- Attractive Header for Notification Management -->
            <div class="card-title mb-4 text-center">
                <h2 class="fw-bold text-primary" style="font-size: 32px; letter-spacing: 1px;">Notification Management</h2>
                <hr style="border-top: 2px solid #f39c12; width: 60%; margin: 0 auto;">
            </div>

            <!-- Tabs for Managing Notifications -->
            <ul class="nav nav-pills mb-4" id="notificationTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="sent-notifications-tab" data-bs-toggle="pill" href="#sent-notifications" role="tab" aria-controls="sent-notifications" aria-selected="true">Sent Notifications</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="to-be-sent-tab" data-bs-toggle="pill" href="#to-be-sent" role="tab" aria-controls="to-be-sent" aria-selected="false">Pending Notifications</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="schedule-notifications-tab" data-bs-toggle="pill" href="#schedule-notifications" role="tab" aria-controls="schedule-notifications" aria-selected="false">Schedule Notifications</a>
                </li>
            </ul>

            <div class="tab-content" id="notificationTabsContent">
                <!-- Sent Notifications Tab -->
                <div class="tab-pane fade show active" id="sent-notifications" role="tabpanel" aria-labelledby="sent-notifications-tab">
                    <h4 class="text-center mb-3">Sent Notifications</h4>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Recipient</th>
                                <th>Notification Type</th>
                                <th>Date Sent</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example rows, these can be dynamically generated from the database -->
                            <tr>
                                <td>1</td>
                                <td>John Doe</td>
                                <td>Email</td>
                                <td>2024-12-26 10:15 AM</td>
                                <td><span class="badge bg-success">Sent</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jane Smith</td>
                                <td>SMS</td>
                                <td>2024-12-26 11:00 AM</td>
                                <td><span class="badge bg-success">Sent</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pending Notifications Tab -->
                <div class="tab-pane fade" id="to-be-sent" role="tabpanel" aria-labelledby="to-be-sent-tab">
                    <h4 class="text-center mb-3">Pending Notifications</h4>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Recipient</th>
                                <th>Notification Type</th>
                                <th>Scheduled Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example rows, these can be dynamically generated from the database -->
                            <tr>
                                <td>1</td>
                                <td>Mike Johnson</td>
                                <td>Email</td>
                                <td>2024-12-26 2:00 PM</td>
                                <td><button class="btn btn-warning btn-sm" onclick="rescheduleNotification(1)">Reschedule</button></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Emily Brown</td>
                                <td>Push</td>
                                <td>2024-12-26 3:00 PM</td>
                                <td><button class="btn btn-warning btn-sm" onclick="rescheduleNotification(2)">Reschedule</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Scheduled Notifications Tab -->
                <div class="tab-pane fade" id="schedule-notifications" role="tabpanel" aria-labelledby="schedule-notifications-tab">
                    <h4 class="text-center mb-3">Schedule Notifications</h4>
                    <form id="schedule-notifications-form" action="#" method="POST" enctype="application/x-www-form-urlencoded">
                        @csrf
                        <!-- Notification Settings -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label for="recipient" class="form-label fw-bold">Recipient</label>
                                <input type="text" class="form-control shadow-sm" id="recipient" name="recipient" required placeholder="Recipient's Name" style="border: 2px solid #bbb;">
                            </div>
                            <div class="col-md-4">
                                <label for="notification-type" class="form-label fw-bold">Notification Type</label>
                                <select class="form-control shadow-sm" id="notification-type" name="notification_type" required style="border: 2px solid #bbb;">
                                    <option value="email">Email</option>
                                    <option value="sms">SMS</option>
                                    <option value="push">Push</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="scheduled-time" class="form-label fw-bold">Scheduled Time</label>
                                <input type="datetime-local" class="form-control shadow-sm" id="scheduled-time" name="scheduled_time" required style="border: 2px solid #bbb;">
                            </div>
                        </div>
                        
                        <!-- Message Content -->
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="message-content" class="form-label fw-bold">Message Content</label>
                                <textarea class="form-control shadow-sm" id="message-content" name="message_content" required rows="4" placeholder="Enter message content" style="border: 2px solid #bbb;"></textarea>
                            </div>
                        </div>

                        <!-- Save Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success px-5 py-2 rounded-pill shadow-lg" id="schedule-notification-btn" style="font-weight: bold;">Schedule Notification</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Example function to handle rescheduling notifications
    function rescheduleNotification(id) {
        alert('Rescheduling notification with ID: ' + id);
    }
</script>
@endsection
