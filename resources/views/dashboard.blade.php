<x-app-layout>
    <style>
        .welcome-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }
        .welcome-icon {
            font-size: 4rem;
            opacity: 0.8;
        }
        .stat-card {
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .stat-icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .bg-gradient-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }
        .bg-gradient-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .bg-gradient-warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .action-card {
            border: none;
            border-radius: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .action-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }
        .action-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }
        .action-stats .badge {
            font-size: 0.75rem;
            padding: 5px 10px;
        }
        .activity-item {
            padding: 8px 0;
            border-bottom: 1px solid #f8f9fa;
            display: flex;
            align-items: center;
        }
        .activity-item:last-child {
            border-bottom: none;
        }
        .btn-custom {
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,123,255,0.3);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-4">Dashboard</h1>

                @if(auth()->user()->role === 'admin')
                    <!-- Admin Dashboard -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="welcome-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h2 class="mb-1"><i class="fas fa-crown me-2 text-warning"></i>Welcome back, Administrator {{ auth()->user()->name }}!</h2>
                                        <p class="mb-0 text-muted">Manage the entire system with full administrative control</p>
                                    </div>
                                    <div class="welcome-icon">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Row -->
                    <div class="row mb-4">
                        <div class="col-md-3 mb-4">
                            <div class="card stat-card text-white bg-gradient-primary">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4 class="card-title mb-1">{{ \App\Models\Student::count() }}</h4>
                                            <p class="card-text mb-0">Total Students</p>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height: 4px;">
                                        <div class="progress-bar" style="width: {{ \App\Models\Student::count() > 0 ? '100' : '0' }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card stat-card text-white bg-gradient-success">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4 class="card-title mb-1">{{ \App\Models\User::where('role', 'lecturer')->count() }}</h4>
                                            <p class="card-text mb-0">Total Lecturers</p>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-chalkboard-teacher"></i>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height: 4px;">
                                        <div class="progress-bar" style="width: 75%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card stat-card text-white bg-gradient-info">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4 class="card-title mb-1">{{ \App\Models\Course::count() }}</h4>
                                            <p class="card-text mb-0">Total Courses</p>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-book"></i>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height: 4px;">
                                        <div class="progress-bar" style="width: 60%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card stat-card text-white bg-gradient-warning">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4 class="card-title mb-1">{{ \App\Models\Registration::where('status', 'approved')->count() }}</h4>
                                            <p class="card-text mb-0">Approved Registrations</p>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-clipboard-check"></i>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height: 4px;">
                                        <div class="progress-bar" style="width: 85%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions Row -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h4 class="mb-3"><i class="fas fa-bolt me-2 text-warning"></i>Quick Actions</h4>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-lg-3 mb-4">
                            <div class="card action-card h-100">
                                <div class="card-body text-center">
                                    <div class="action-icon bg-primary mb-3">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <h6 class="card-title mb-2">Student Management</h6>
                                    <p class="card-text text-muted small">Add, edit, and manage students</p>
                                    <a href="{{ route('admin.students.index') }}" class="btn btn-primary btn-custom btn-sm">
                                        <i class="fas fa-users me-1"></i>Manage Students
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 mb-4">
                            <div class="card action-card h-100">
                                <div class="card-body text-center">
                                    <div class="action-icon bg-success mb-3">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                    <h6 class="card-title mb-2">Lecturer Management</h6>
                                    <p class="card-text text-muted small">Manage lecturer accounts</p>
                                    <a href="{{ route('admin.lecturers.index') }}" class="btn btn-success btn-custom btn-sm">
                                        <i class="fas fa-chalkboard-teacher me-1"></i>Manage Lecturers
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 mb-4">
                            <div class="card action-card h-100">
                                <div class="card-body text-center">
                                    <div class="action-icon bg-info mb-3">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <h6 class="card-title mb-2">Course Management</h6>
                                    <p class="card-text text-muted small">Create and manage courses</p>
                                    <a href="{{ route('admin.courses.index') }}" class="btn btn-info btn-custom btn-sm">
                                        <i class="fas fa-book me-1"></i>Manage Courses
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 mb-4">
                            <div class="card action-card h-100">
                                <div class="card-body text-center">
                                    <div class="action-icon bg-warning mb-3">
                                        <i class="fas fa-clipboard-check"></i>
                                    </div>
                                    <h6 class="card-title mb-2">Registration Management</h6>
                                    <p class="card-text text-muted small">Approve course registrations</p>
                                    <a href="{{ route('admin.registrations.index') }}" class="btn btn-warning btn-custom btn-sm">
                                        <i class="fas fa-clipboard-check me-1"></i>Manage Registrations
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Actions Row -->
                    <div class="row mb-4">
                        <div class="col-lg-6 mb-4">
                            <div class="card action-card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="action-icon bg-primary">
                                            <i class="fas fa-user-plus"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h5 class="card-title mb-1">Course Assignments</h5>
                                            <p class="card-text text-muted">Assign lecturers to courses</p>
                                        </div>
                                    </div>
                                    <div class="action-stats mb-3">
                                        <span class="badge bg-primary">{{ \App\Models\LecturerCourse::count() }} Assignments</span>
                                        <span class="badge bg-success ms-2">{{ \App\Models\Course::whereDoesntHave('lecturerCourses')->count() }} Unassigned</span>
                                    </div>
                                    <a href="{{ route('admin.assign_courses') }}" class="btn btn-primary btn-custom w-100">
                                        <i class="fas fa-user-plus me-2"></i>Assign Courses
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <div class="card action-card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="action-icon bg-success">
                                            <i class="fas fa-chart-bar"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h5 class="card-title mb-1">System Results</h5>
                                            <p class="card-text text-muted">View overall student results</p>
                                        </div>
                                    </div>
                                    <div class="action-stats mb-3">
                                        <span class="badge bg-info">{{ \App\Models\Grade::count() }} Grades</span>
                                        <span class="badge bg-warning ms-2">{{ \App\Models\Grade::where('score', '>=', 70)->count() }} A Grades</span>
                                    </div>
                                    <a href="{{ route('admin.results') }}" class="btn btn-success btn-custom w-100">
                                        <i class="fas fa-chart-bar me-2"></i>View Results
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="fas fa-history me-2 text-info"></i>Recent Activity</h5>
                                </div>
                                <div class="card-body">
                                    <div class="activity-item">
                                        <i class="fas fa-circle text-success me-2"></i>
                                        <span>Admin dashboard accessed - {{ now()->format('M d, Y H:i') }}</span>
                                    </div>
                                    <div class="activity-item">
                                        <i class="fas fa-circle text-primary me-2"></i>
                                        <span>{{ \App\Models\Student::count() }} students, {{ \App\Models\User::where('role', 'lecturer')->count() }} lecturers, {{ \App\Models\Course::count() }} courses in system</span>
                                    </div>
                                    <div class="activity-item">
                                        <i class="fas fa-circle text-warning me-2"></i>
                                        <span>{{ \App\Models\Registration::where('status', 'pending')->count() }} pending registrations awaiting approval</span>
                                    </div>
                                    <div class="activity-item">
                                        <i class="fas fa-circle text-info me-2"></i>
                                        <span>System ready for administrative operations</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif(auth()->user()->role === 'lecturer')
                    <!-- Lecturer Dashboard -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="welcome-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h2 class="mb-1"><i class="fas fa-chalkboard-teacher me-2 text-primary"></i>Welcome back, {{ auth()->user()->name }}!</h2>
                                        <p class="mb-0 text-muted">Manage your courses and student grades efficiently</p>
                                    </div>
                                    <div class="welcome-icon">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Row -->
                    <div class="row mb-4">
                        <div class="col-md-3 mb-4">
                            <div class="card stat-card text-white bg-gradient-primary">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4 class="card-title mb-1">{{ auth()->user()->lecturerCourses()->count() }}</h4>
                                            <p class="card-text mb-0">Assigned Courses</p>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-book"></i>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height: 4px;">
                                        <div class="progress-bar" style="width: {{ auth()->user()->lecturerCourses()->count() > 0 ? '100' : '0' }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card stat-card text-white bg-gradient-success">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4 class="card-title mb-1">{{ auth()->user()->lecturerCourses()->with('course.registrations')->get()->sum(fn($lc) => $lc->course->registrations()->where('status', 'approved')->count()) }}</h4>
                                            <p class="card-text mb-0">Total Students</p>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height: 4px;">
                                        <div class="progress-bar" style="width: 75%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card stat-card text-white bg-gradient-info">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4 class="card-title mb-1">{{ \App\Models\Grade::whereHas('course', fn($q) => $q->whereHas('lecturerCourses', fn($q2) => $q2->where('lecturer_id', auth()->id())))->count() }}</h4>
                                            <p class="card-text mb-0">Grades Uploaded</p>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-upload"></i>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height: 4px;">
                                        <div class="progress-bar" style="width: 60%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card stat-card text-white bg-gradient-warning">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h4 class="card-title mb-1">{{ auth()->user()->lecturerCourses()->whereHas('course', fn($q) => $q->where('semester', now()->month <= 6 ? 'First' : 'Second'))->count() }}</h4>
                                            <p class="card-text mb-0">Current Semester</p>
                                        </div>
                                        <div class="stat-icon">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                    <div class="progress mt-2" style="height: 4px;">
                                        <div class="progress-bar" style="width: 85%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions Row -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h4 class="mb-3"><i class="fas fa-bolt me-2 text-warning"></i>Quick Actions</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card action-card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="action-icon bg-primary">
                                            <i class="fas fa-book-open"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h5 class="card-title mb-1">Course Management</h5>
                                            <p class="card-text text-muted">View and manage your assigned courses</p>
                                        </div>
                                    </div>
                                    <div class="action-stats mb-3">
                                        <span class="badge bg-primary">{{ auth()->user()->lecturerCourses()->count() }} Courses</span>
                                        <span class="badge bg-success ms-2">{{ auth()->user()->lecturerCourses()->with('course.registrations')->get()->sum(fn($lc) => $lc->course->registrations()->where('status', 'approved')->count()) }} Students</span>
                                    </div>
                                    <a href="{{ route('lecturer.courses') }}" class="btn btn-primary btn-custom w-100">
                                        <i class="fas fa-eye me-2"></i>View My Courses
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <div class="card action-card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="action-icon bg-success">
                                            <i class="fas fa-upload"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h5 class="card-title mb-1">Grade Management</h5>
                                            <p class="card-text text-muted">Upload and edit student marks</p>
                                        </div>
                                    </div>
                                    <div class="action-stats mb-3">
                                        <span class="badge bg-info">{{ \App\Models\Grade::whereHas('course', fn($q) => $q->whereHas('lecturerCourses', fn($q2) => $q2->where('lecturer_id', auth()->id())))->count() }} Grades</span>
                                        <span class="badge bg-warning ms-2">{{ auth()->user()->lecturerCourses()->count() - \App\Models\Grade::whereHas('course', fn($q) => $q->whereHas('lecturerCourses', fn($q2) => $q2->where('lecturer_id', auth()->id())))->distinct('course_id')->count() }} Pending</span>
                                    </div>
                                    <a href="{{ route('lecturer.courses') }}" class="btn btn-success btn-custom w-100">
                                        <i class="fas fa-edit me-2"></i>Manage Grades
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0"><i class="fas fa-history me-2 text-info"></i>Recent Activity</h5>
                                </div>
                                <div class="card-body">
                                    <div class="activity-item">
                                        <i class="fas fa-circle text-success me-2"></i>
                                        <span>Dashboard accessed - {{ now()->format('M d, Y H:i') }}</span>
                                    </div>
                                    @if(auth()->user()->lecturerCourses()->count() > 0)
                                    <div class="activity-item">
                                        <i class="fas fa-circle text-primary me-2"></i>
                                        <span>{{ auth()->user()->lecturerCourses()->count() }} courses currently assigned</span>
                                    </div>
                                    @endif
                                    <div class="activity-item">
                                        <i class="fas fa-circle text-warning me-2"></i>
                                        <span>Ready to upload grades for current semester</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @elseif(auth()->user()->role === 'student')
                    <!-- Student Dashboard -->
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card card-hover text-white bg-primary">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ auth()->user()->student->calculateGPA() ?? 'N/A' }}</h5>
                                    <p class="card-text">Current GPA</p>
                                    <i class="fas fa-graduation-cap fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card card-hover text-white bg-success">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ auth()->user()->student->registrations()->where('status', 'approved')->count() }}</h5>
                                    <p class="card-text">Registered Courses</p>
                                    <i class="fas fa-book-open fa-2x"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card card-hover text-white bg-info">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ auth()->user()->student->level }}</h5>
                                    <p class="card-text">Current Level</p>
                                    <i class="fas fa-layer-group fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card card-hover">
                                <div class="card-body">
                                    <h5 class="card-title">Course Registration</h5>
                                    <p class="card-text">Register for available courses</p>
                                    <a href="{{ route('student.register') }}" class="btn btn-primary btn-custom">Register Courses</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card card-hover">
                                <div class="card-body">
                                    <h5 class="card-title">View Results</h5>
                                    <p class="card-text">Check your grades and GPA</p>
                                    <a href="{{ route('student.results') }}" class="btn btn-success btn-custom">View Results</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
