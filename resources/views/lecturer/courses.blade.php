<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Header Section -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 mb-1"><i class="fas fa-chalkboard-teacher me-2 text-primary"></i>My Assigned Courses</h1>
                        <p class="text-muted mb-0">Manage your course assignments and student marks</p>
                    </div>
                    <div class="stats-card">
                        <div class="stat-number">{{ $courses->count() }}</div>
                        <div class="stat-label">Total Courses</div>
                    </div>
                </div>

                <!-- Stats Row -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card card-hover text-white bg-gradient-primary">
                            <div class="card-body text-center">
                                <i class="fas fa-book fa-2x mb-2"></i>
                                <h5 class="card-title">{{ $courses->count() }}</h5>
                                <p class="card-text">Assigned Courses</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-hover text-white bg-gradient-success">
                            <div class="card-body text-center">
                                <i class="fas fa-users fa-2x mb-2"></i>
                                <h5 class="card-title">{{ $courses->sum(fn($c) => $c->course->registrations()->where('status', 'approved')->count()) }}</h5>
                                <p class="card-text">Total Students</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-hover text-white bg-gradient-info">
                            <div class="card-body text-center">
                                <i class="fas fa-clock fa-2x mb-2"></i>
                                <h5 class="card-title">{{ $courses->where('course.semester', 'First')->count() + $courses->where('course.semester', 'Second')->count() }}</h5>
                                <p class="card-text">Active Semesters</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Courses Grid -->
                <div class="row">
                    @forelse($courses as $course)
                    <div class="col-lg-6 col-xl-4 mb-4">
                        <div class="card course-card h-100">
                            <div class="card-header bg-gradient-primary text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-graduation-cap me-2"></i>{{ $course->course->code }}
                                    </h5>
                                    <span class="badge bg-light text-primary">{{ $course->course->level }}</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <h6 class="card-subtitle mb-3 text-muted">{{ $course->course->title }}</h6>

                                <div class="course-details mb-3">
                                    <div class="detail-row">
                                        <i class="fas fa-weight-hanging text-warning me-2"></i>
                                        <span><strong>Units:</strong> {{ $course->course->unit }}</span>
                                    </div>
                                    <div class="detail-row">
                                        <i class="fas fa-calendar-alt text-info me-2"></i>
                                        <span><strong>Semester:</strong> {{ $course->course->semester }}</span>
                                    </div>
                                    <div class="detail-row">
                                        <i class="fas fa-users text-success me-2"></i>
                                        <span><strong>Students:</strong> {{ $course->course->registrations()->where('status', 'approved')->count() }}</span>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <a href="{{ route('lecturer.upload_marks', $course->course->id) }}" class="btn btn-primary btn-custom">
                                        <i class="fas fa-upload me-2"></i>Upload Marks
                                    </a>
                                    <a href="{{ route('lecturer.edit_marks', ['courseId' => $course->course->id]) }}" class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-edit me-1"></i>Edit Marks
                                    </a>
                                </div>
                            </div>
                            <div class="card-footer bg-light">
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Click to manage student grades
                                </small>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="card text-center">
                            <div class="card-body py-5">
                                <i class="fas fa-chalkboard-teacher fa-4x text-muted mb-3"></i>
                                <h4 class="text-muted">No Courses Assigned</h4>
                                <p class="text-muted">You haven't been assigned any courses yet. Please contact the administrator.</p>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .bg-gradient-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }
        .bg-gradient-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .course-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            text-align: center;
        }
        .stat-number {
            font-size: 2em;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .stat-label {
            font-size: 0.9em;
            opacity: 0.9;
        }
        .detail-row {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }
        .detail-row span {
            font-size: 0.9em;
        }
        .btn-custom {
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,123,255,0.3);
        }
    </style>
</x-app-layout>
