@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card rounded shadow-lg">
        <div class="card-body">
            <!-- Attractive Header for Notification Settings -->
            <div class="card-title mb-4 text-center">
                <h2 class="fw-bold text-primary" style="font-size: 32px; letter-spacing: 1px;">Notification Settings</h2>
                <hr style="border-top: 2px solid #f39c12; width: 60%; margin: 0 auto;">
            </div>

            <form id="notification-settings-form" action="#" method="POST" enctype="application/x-www-form-urlencoded">
                @csrf
                <!-- Notification Channels Settings -->
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

                <!-- Default Template Settings -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="default-email-template" class="form-label fw-bold">Default Email Template</label>
                        <textarea class="form-control shadow-sm" id="default-email-template" name="default_email_template" rows="4" required style="border: 2px solid #bbb;" placeholder="Enter default email template content"></textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="default-sms-template" class="form-label fw-bold">Default SMS Template</label>
                        <textarea class="form-control shadow-sm" id="default-sms-template" name="default_sms_template" rows="4" required style="border: 2px solid #bbb;" placeholder="Enter default SMS template content"></textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="default-push-template" class="form-label fw-bold">Default Push Template</label>
                        <textarea class="form-control shadow-sm" id="default-push-template" name="default_push_template" rows="4" required style="border: 2px solid #bbb;" placeholder="Enter default push notification template content"></textarea>
                    </div>
                </div>

                <!-- Notification Frequency -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label for="email-frequency" class="form-label fw-bold">Email Frequency</label>
                        <select class="form-control shadow-sm" id="email-frequency" name="email_frequency" required style="border: 2px solid #bbb;">
                            <option value="immediate">Immediate</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="sms-frequency" class="form-label fw-bold">SMS Frequency</label>
                        <select class="form-control shadow-sm" id="sms-frequency" name="sms_frequency" required style="border: 2px solid #bbb;">
                            <option value="immediate">Immediate</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="push-frequency" class="form-label fw-bold">Push Frequency</label>
                        <select class="form-control shadow-sm" id="push-frequency" name="push_frequency" required style="border: 2px solid #bbb;">
                            <option value="immediate">Immediate</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                        </select>
                    </div>
                </div>

                <!-- Save Settings Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success px-5 py-2 rounded-pill shadow-lg" id="save-notification-settings-btn" style="font-weight: bold;">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
