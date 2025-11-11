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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
        }

        .register-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }

        .register-header h2 {
            margin: 0;
            font-weight: 600;
        }

        .register-header p {
            margin: 5px 0 0 0;
            opacity: 0.9;
            font-size: 14px;
        }

        .register-body {
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

        .btn-register {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 20px;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.3);
        }

        .register-footer {
            text-align: center;
            padding: 20px 25px;
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
        }

        .register-footer a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
        }

        .register-footer a:hover {
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
    <div class="register-container">
                    <div class="register-header">
                        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" class="mb-3" style="width: 3rem; height: 3rem; fill: #ffffff;">
                            <circle cx="50" cy="50" r="45" fill="#ffffff" stroke="#4f46e5" stroke-width="2"/>
                            <path d="M25 35 L50 20 L75 35 L75 65 L50 80 L25 65 Z" fill="none" stroke="#4f46e5" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M35 45 L50 38 L65 45" fill="none" stroke="#4f46e5" stroke-width="2" stroke-linecap="round"/>
                            <circle cx="50" cy="55" r="8" fill="none" stroke="#4f46e5" stroke-width="2"/>
                            <path d="M42 55 L58 55" fill="none" stroke="#4f46e5" stroke-width="2" stroke-linecap="round"/>
                            <path d="M50 47 L50 63" fill="none" stroke="#4f46e5" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        <h2>Join Course Registration System</h2>
                        <p>Create your account</p>
                    </div>

        <div class="register-body">
            <div class="alert alert-info" role="alert">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Registration Not Available</strong><br>
                User registration is managed by the system administrator. Please contact the administrator to create your account.
            </div>

            <div class="text-center">
                <a href="{{ route('login') }}" class="btn btn-primary">
                    <i class="fas fa-sign-in-alt me-2"></i>Go to Login
                </a>
            </div>
        </div>

        <div class="register-footer">
            <a href="{{ route('login') }}">Already have an account? Sign in</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
