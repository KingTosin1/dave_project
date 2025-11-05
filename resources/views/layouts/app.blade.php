<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Course Registration System') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <!-- Global Custom CSS -->
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --sidebar-gradient: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            --navbar-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
        }

        .main-content {
            background: transparent;
            min-height: 100vh;
        }

        .card-modern {
            border-radius: 15px;
            border: none;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            backdrop-filter: blur(10px);
            background: rgba(255,255,255,0.95);
            transition: all 0.3s ease;
        }

        .card-modern:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 45px rgba(0,0,0,0.15);
        }

        .btn-custom {
            border-radius: 25px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .btn-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-custom:hover::before {
            left: 100%;
        }

        .form-control-modern {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 16px;
            transition: all 0.3s ease;
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(10px);
        }

        .form-control-modern:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            background: white;
        }

        .table-modern {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .table-modern thead th {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 15px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.85rem;
        }

        .table-modern tbody tr {
            transition: all 0.3s ease;
        }

        .table-modern tbody tr:hover {
            background: rgba(102, 126, 234, 0.05);
            transform: scale(1.01);
        }

        .badge-modern {
            border-radius: 20px;
            padding: 6px 12px;
            font-weight: 500;
            font-size: 0.75rem;
        }

        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 16px;
            background: var(--primary-gradient);
            color: white;
        }

        .stat-card {
            background: var(--primary-gradient);
            border-radius: 15px;
            padding: 20px;
            color: white;
            text-align: center;
            transition: all 0.3s ease;
            border: none;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.3);
        }

        .stat-card .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
            opacity: 0.9;
        }

        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-card .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 0;
            margin: -20px -20px 30px -20px;
            border-radius: 0 0 30px 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .page-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .breadcrumb-modern {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 8px 16px;
            backdrop-filter: blur(10px);
        }

        .breadcrumb-modern .breadcrumb-item a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
        }

        .breadcrumb-modern .breadcrumb-item.active {
            color: white;
            font-weight: 500;
        }

        /* Mobile sidebar overlay */
        @media (max-width: 991.98px) {
            .sidebar-modern {
                position: fixed;
                top: 0;
                left: 0;
                width: 280px !important;
                z-index: 1050;
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }
            .sidebar-modern.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0 !important;
            }
            /* Overlay when sidebar is open */
            .sidebar-overlay-modern {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1040;
                display: none;
                backdrop-filter: blur(5px);
            }
            .sidebar-overlay-modern.show {
                display: block;
            }
        }

        /* Loading animation */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-gradient);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }

            .stat-card {
                margin-bottom: 20px;
            }

            .table-responsive {
                border-radius: 10px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay-modern" id="sidebarOverlay"></div>

    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <!-- Topbar -->
                @include('layouts.topbar')

                <!-- Page Content -->
                <main class="p-3 p-md-4">
                    @if(session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: '{{ session("success") }}',
                                timer: 3000,
                                showConfirmButton: false,
                                toast: true,
                                position: 'top-end',
                                background: '#28a745',
                                color: 'white'
                            });
                        </script>
                    @endif

                    @if(session('error'))
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: '{{ session("error") }}',
                                timer: 3000,
                                showConfirmButton: false,
                                toast: true,
                                position: 'top-end',
                                background: '#dc3545',
                                color: 'white'
                            });
                        </script>
                    @endif

                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTables with modern styling
            $('.datatable').DataTable({
                responsive: true,
                pageLength: 10,
                language: {
                    search: "",
                    searchPlaceholder: "Search records...",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    paginate: {
                        first: "«",
                        last: "»",
                        next: "›",
                        previous: "‹"
                    }
                },
                initComplete: function() {
                    // Add modern styling to DataTables elements
                    $('.dataTables_wrapper .dataTables_filter input').addClass('form-control-modern');
                    $('.dataTables_wrapper .dataTables_length select').addClass('form-control-modern');
                    $('.dataTables_wrapper .dataTables_info').addClass('text-muted small');
                    $('.dataTables_wrapper .dataTables_paginate .paginate_button').addClass('btn btn-outline-primary btn-sm mx-1');
                    $('.dataTables_wrapper .dataTables_paginate .paginate_button.current').addClass('btn-primary').removeClass('btn-outline-primary');
                }
            });

            // Mobile sidebar functionality
            function toggleSidebar() {
                $('.sidebar-modern').toggleClass('show');
                $('.sidebar-overlay-modern').toggleClass('show');
            }

            // Toggle sidebar on menu button click
            $('[data-bs-toggle="collapse"][data-bs-target=".sidebar-modern"]').on('click', function(e) {
                e.preventDefault();
                toggleSidebar();
            });

            // Close sidebar when clicking overlay
            $('.sidebar-overlay-modern').on('click', function() {
                toggleSidebar();
            });

            // Close sidebar when clicking close button in sidebar
            $('.sidebar-modern .btn[data-bs-toggle="collapse"]').on('click', function(e) {
                e.preventDefault();
                toggleSidebar();
            });

            // Close sidebar when clicking on nav links (mobile only)
            if ($(window).width() < 992) {
                $('.sidebar-modern .nav-link-modern').on('click', function() {
                    toggleSidebar();
                });
            }

            // Add loading states to forms
            $('form').on('submit', function() {
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();
                submitBtn.prop('disabled', true).html('<span class="loading-spinner me-2"></span>Processing...');

                // Re-enable after 10 seconds as fallback
                setTimeout(() => {
                    submitBtn.prop('disabled', false).html(originalText);
                }, 10000);
            });

            // Smooth scrolling for anchor links
            $('a[href^="#"]').on('click', function(event) {
                const target = $($(this).attr('href'));
                if (target.length) {
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 500);
                }
            });

            // Add fade-in animation to cards
            $('.card-modern').each(function(index) {
                $(this).css('opacity', '0').delay(index * 100).animate({opacity: '1'}, 500);
            });

            // Enhanced tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl, {
                    delay: { show: 300, hide: 100 }
                });
            });
        });

        // Global error handler
        window.addEventListener('error', function(e) {
            console.error('Global error:', e.error);
        });

        // Service worker registration (if needed)
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                // navigator.serviceWorker.register('/sw.js');
            });
        }
    </script>
</body>
</html>
