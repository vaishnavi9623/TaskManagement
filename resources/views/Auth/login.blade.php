<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Task Management App</title>
    <!-- Include compiled CSS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="row w-75 shadow-lg p-5 bg-white rounded">
            <!-- Image Column -->
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <img src="{{ asset('images/loginbg.jpg') }}" class="img-fluid w-100" alt="login Logo">
            </div>
    
            <!-- Login Form Column -->
            <div class="col-md-6">
                <div class="card w-100">
                    <div class="card-header text-center">
                        <h2>Task Manager Login</h2>
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="email">Username<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password<span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password">
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="captcha">Please enter the sum of these numbers:
                                    <span class="text-danger" id="captcha-equation">5 + 3</span>
                                    <span class="ms-3">
                                        <i class="fas fa-sync-alt captcha-refresh" style="cursor: pointer;"></i>
                                    </span>
                                </label>
                                <input type="text" class="form-control" id="captcha" name="captcha">
                                <input type="hidden" id="captcha-answer" name="captcha_answer">
                                @error('captcha')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn w-100" style="background-color:#4dbfba ">Login</button>
                        </form>
                    </div>
                    <div class="text-muted text-center footer-text p-3">
                        New to our platform? <a href="#" class="text-decoration-none">Register here!</a>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</body>

</html>
