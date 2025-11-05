<div class="col-md-3 col-lg-2 d-md-block sidebar-modern collapse">
    <div class="position-sticky pt-3">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center px-3 py-3 mb-4">
            <div class="d-flex align-items-center">
                <div class="logo-circle bg-gradient-primary text-white me-2">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div>
                    <h6 class="text-white mb-0 fw-bold">Course System</h6>
                    <small class="text-light opacity-75">{{ ucfirst(auth()->user()->role) }}</small>
                </div>
            </div>
            <button class="btn btn-sm btn-outline-light d-md-none rounded-circle" type="button" data-bs-toggle="collapse" data-bs-target=".sidebar-modern" aria-label="Close sidebar">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- User Info Card -->
        <div class="user-card mx-3 mb-4">
            <div class="d-flex align-items-center">
                <div class="avatar-circle bg-gradient-info text-white me-3">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="flex-grow-1">
                    <div class="fw-bold text-white small">{{ auth()->user()->name }}</div>
                    <div class="text-light small opacity-75">{{ auth()->user()->email }}</div>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <ul class="nav flex-column px-2">
            <!-- Dashboard -->
            <li class="nav-item mb-2">
                <a class="nav-link-modern {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <div class="nav-icon">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    <span class="nav-text">Dashboard</span>
                    @if(request()->routeIs('dashboard'))
                        <div class="active-indicator"></div>
                    @endif
                </a>
            </li>

            @if(auth()->user()->role === 'admin')
                <!-- Admin Menu Items -->
                <li class="nav-section mb-2">
                    <small class="nav-section-title text-light opacity-75 px-3">Management</small>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link-modern {{ request()->routeIs('admin.students.*') ? 'active' : '' }}" href="{{ route('admin.students.index') }}">
                        <div class="nav-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="nav-text">Students</span>
                        @if(request()->routeIs('admin.students.*'))
                            <div class="active-indicator"></div>
                        @endif
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link-modern {{ request()->routeIs('admin.lecturers.*') ? 'active' : '' }}" href="{{ route('admin.lecturers.index') }}">
                        <div class="nav-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <span class="nav-text">Lecturers</span>
                        @if(request()->routeIs('admin.lecturers.*'))
                            <div class="active-indicator"></div>
                        @endif
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link-modern {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}" href="{{ route('admin.courses.index') }}">
                        <div class="nav-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <span class="nav-text">Courses</span>
                        @if(request()->routeIs('admin.courses.*'))
                            <div class="active-indicator"></div>
                        @endif
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link-modern {{ request()->routeIs('admin.registrations.*') ? 'active' : '' }}" href="{{ route('admin.registrations.index') }}">
                        <div class="nav-icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <span class="nav-text">Registrations</span>
                        @if(request()->routeIs('admin.registrations.*'))
                            <div class="active-indicator"></div>
                        @endif
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link-modern {{ request()->routeIs('admin.assign_courses') ? 'active' : '' }}" href="{{ route('admin.assign_courses') }}">
                        <div class="nav-icon">
                            <i class="fas fa-link"></i>
                        </div>
                        <span class="nav-text">Assign Courses</span>
                        @if(request()->routeIs('admin.assign_courses'))
                            <div class="active-indicator"></div>
                        @endif
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link-modern {{ request()->routeIs('admin.results') ? 'active' : '' }}" href="{{ route('admin.results') }}">
                        <div class="nav-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <span class="nav-text">Results</span>
                        @if(request()->routeIs('admin.results'))
                            <div class="active-indicator"></div>
                        @endif
                    </a>
                </li>
            @elseif(auth()->user()->role === 'lecturer')
                <!-- Lecturer Menu Items -->
                <li class="nav-section mb-2">
                    <small class="nav-section-title text-light opacity-75 px-3">Teaching</small>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link-modern {{ request()->routeIs('lecturer.courses') || request()->routeIs('lecturer.upload_marks') || request()->routeIs('lecturer.edit_marks') ? 'active' : '' }}" href="{{ route('lecturer.courses') }}">
                        <div class="nav-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <span class="nav-text">My Courses</span>
                        @if(request()->routeIs('lecturer.courses') || request()->routeIs('lecturer.upload_marks') || request()->routeIs('lecturer.edit_marks'))
                            <div class="active-indicator"></div>
                        @endif
                    </a>
                </li>
            @elseif(auth()->user()->role === 'student')
                <!-- Student Menu Items -->
                <li class="nav-section mb-2">
                    <small class="nav-section-title text-light opacity-75 px-3">Academic</small>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link-modern {{ request()->routeIs('student.register') ? 'active' : '' }}" href="{{ route('student.register') }}">
                        <div class="nav-icon">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <span class="nav-text">Register Courses</span>
                        @if(request()->routeIs('student.register'))
                            <div class="active-indicator"></div>
                        @endif
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link-modern {{ request()->routeIs('student.results') ? 'active' : '' }}" href="{{ route('student.results') }}">
                        <div class="nav-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <span class="nav-text">My Results</span>
                        @if(request()->routeIs('student.results'))
                            <div class="active-indicator"></div>
                        @endif
                    </a>
                </li>
                <li class="nav-item mb-1">
                    <a class="nav-link-modern {{ request()->routeIs('student.transcript') ? 'active' : '' }}" href="{{ route('student.transcript') }}">
                        <div class="nav-icon">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <span class="nav-text">Transcript</span>
                        @if(request()->routeIs('student.transcript'))
                            <div class="active-indicator"></div>
                        @endif
                    </a>
                </li>
            @endif

            <!-- Logout Section -->
            <li class="nav-item mt-4">
                <div class="logout-section">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn w-100">
                            <div class="nav-icon">
                                <i class="fas fa-sign-out-alt"></i>
                            </div>
                            <span class="nav-text">Logout</span>
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>

    <style>
        .sidebar-modern {
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            min-height: 100vh;
        }

        .logo-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .bg-gradient-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .user-card {
            background: rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 12px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .avatar-circle {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }

        .nav-link-modern {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            margin: 0 8px;
            border-radius: 10px;
            text-decoration: none;
            color: rgba(255,255,255,0.8) !important;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link-modern:hover {
            background: rgba(255,255,255,0.1);
            color: white !important;
            transform: translateX(5px);
        }

        .nav-link-modern.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .nav-icon {
            width: 20px;
            text-align: center;
            margin-right: 12px;
            font-size: 16px;
        }

        .nav-text {
            flex-grow: 1;
            font-weight: 500;
        }

        .active-indicator {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 60%;
            background: white;
            border-radius: 2px 0 0 2px;
        }

        .nav-section-title {
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 10px;
        }

        .logout-section {
            padding: 8px;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            border: none;
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #c0392b 0%, #a93226 100%);
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }

        @media (max-width: 768px) {
            .sidebar-modern {
                position: fixed;
                top: 0;
                left: 0;
                z-index: 1050;
                width: 280px;
                transition: transform 0.3s ease-in-out;
            }

            .sidebar-modern:not(.show) {
                transform: translateX(-100%);
            }

            .sidebar-modern.show {
                transform: translateX(0);
            }

            .user-card {
                padding: 8px;
            }

            .avatar-circle {
                width: 30px;
                height: 30px;
                font-size: 12px;
            }

            .nav-link-modern {
                padding: 10px 12px;
            }

            .nav-icon {
                margin-right: 10px;
                font-size: 14px;
            }
        }
    </style>
</div>
