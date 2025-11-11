<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Course System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
        }

        .contributors-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
        }

        .contributors-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .contributors-header h4 {
            margin: 0;
            font-weight: 600;
        }

        .contributors-body {
            padding: 20px;
        }

        .contributors-list {
            list-style: none;
            padding: 0;
        }

        .contributors-list li {
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e5e7eb;
        }

        .contributors-list li:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .contributor-name {
            font-weight: 600;
            color: #1f2937;
        }

        .contributor-matric {
            font-size: 14px;
            color: #6b7280;
            margin-top: 2px;
        }

        .login-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .login-header h2 {
            margin: 0;
            font-weight: 600;
        }

        .login-header p {
            margin: 5px 0 0 0;
            opacity: 0.9;
            font-size: 14px;
        }

        .login-body {
            padding: 30px 25px;
        }

        .form-floating {
            margin-bottom: 20px;
        }

        .form-floating label {
            color: #6b7280;
            font-weight: 500;
        }

        .form-control {
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-check {
            margin-bottom: 20px;
        }

        .form-check-input:checked {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }

        .btn-login {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 20px;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.3);
        }

        .login-footer {
            text-align: center;
            padding: 20px 25px;
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
        }

        .login-footer a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-start">
            <div class="col-md-7 col-12">
                <div class="login-container">
                    <div class="login-header">
                        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" class="mb-3" style="width: 3rem; height: 3rem; fill: #ffffff;">
                            <circle cx="50" cy="50" r="45" fill="#ffffff" stroke="#4f46e5" stroke-width="2"/>
                            <path d="M25 35 L50 20 L75 35 L75 65 L50 80 L25 65 Z" fill="none" stroke="#4f46e5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M35 45 L50 38 L65 45" fill="none" stroke="#4f46e5" stroke-width="2" stroke-linecap="round"/>
                            <circle cx="50" cy="55" r="8" fill="none" stroke="#4f46e5" stroke-width="2"/>
                            <path d="M42 55 L58 55" fill="none" stroke="#4f46e5" stroke-width="2" stroke-linecap="round"/>
                            <path d="M50 47 L50 63" fill="none" stroke="#4f46e5" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        <h2>Course Registration System</h2>
                        <p>Sign in to your account</p>
                    </div>

                    <div class="login-body">
                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="form-floating">
                                <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email Address">
                                <label for="email">Email Address</label>
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-floating">
                                <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="Password">
                                <label for="password">Password</label>
                                @error('password')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="form-check">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                <label for="remember_me" class="form-check-label">Remember me</label>
                            </div>

                            <button type="submit" class="btn btn-login">
                                <i class="fas fa-sign-in-alt me-2"></i>Sign In
                            </button>
                        </form>
                    </div>

                    <div class="login-footer">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Forgot your password?</a>
                        @endif
                        <p class="mt-2 mb-0">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
                    </div>
                </div>
            </div>

            <div class="col-md-5 col-12 mt-4 mt-md-0">
                <div class="contributors-card">
                    <div class="contributors-header">
                        <h4>Project Contributors</h4>
                    </div>
                    <div class="contributors-body">
                        <ul class="contributors-list">
                            <li>
                                <div class="contributor-name">Ikati Tanitoluwa David</div>
                                <div class="contributor-matric">23/105/01/P/0123</div>
                            </li>
                            <li>
                                <div class="contributor-name">Erinle Rofiat Omowunmi</div>
                                <div class="contributor-matric">23/105/01/P/0100</div>
                            </li>
                            <li>
                                <div class="contributor-name">Akinyemi Abisola Janet</div>
                                <div class="contributor-matric">23/105/01/P/0078</div>
                            </li>
                            <li>
                                <div class="contributor-name">Jimoh Quadri Akorede</div>
                                <div class="contributor-matric">23/105/01/P/0052</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
