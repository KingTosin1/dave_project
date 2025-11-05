<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Header Section -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
                    <div class="mb-3 mb-md-0">
                        <h1 class="h3 mb-1"><i class="fas fa-clipboard-list me-2 text-primary"></i>Course Registration</h1>
                        <p class="text-muted mb-0">Select and register for available courses</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="badge bg-info me-2">
                            <i class="fas fa-calendar me-1"></i>{{ now()->format('F Y') }}
                        </span>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="card stat-card text-white bg-gradient-primary">
                            <div class="card-body text-center">
                                <i class="fas fa-book fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ $courses->count() }}</h4>
                                <p class="card-text mb-0">Available Courses</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card stat-card text-white bg-gradient-success">
                            <div class="card-body text-center">
                                <i class="fas fa-check-circle fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ auth()->user()->student->registrations()->count() }}</h4>
                                <p class="card-text mb-0">Registered Courses</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card stat-card text-white bg-gradient-info">
                            <div class="card-body text-center">
                                <i class="fas fa-calculator fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ auth()->user()->student->registrations()->join('courses', 'registrations.course_id', '=', 'courses.id')->sum('courses.unit') }}</h4>
                                <p class="card-text mb-0">Total Units</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Registration Table -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Available Courses</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="fas fa-hashtag me-1"></i>Code</th>
                                        <th><i class="fas fa-book me-1"></i>Title</th>
                                        <th><i class="fas fa-calculator me-1"></i>Unit</th>
                                        <th><i class="fas fa-calendar-alt me-1"></i>Semester</th>
                                        <th><i class="fas fa-layer-group me-1"></i>Level</th>
                                        <th><i class="fas fa-cogs me-1"></i>Status</th>
                                        <th><i class="fas fa-bolt me-1"></i>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($courses as $course)
                                    <tr>
                                        <td>
                                            <code class="bg-light px-2 py-1 rounded">{{ $course->code }}</code>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $course->title }}</div>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">{{ $course->unit }} Unit{{ $course->unit > 1 ? 's' : '' }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $course->semester }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $course->level }} Level</span>
                                        </td>
                                        <td>
                                            @if($course->registrations()->where('student_id', auth()->user()->student->id)->exists())
                                                <span class="badge bg-success">
                                                    <i class="fas fa-check-circle me-1"></i>Registered
                                                </span>
                                            @else
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-clock me-1"></i>Available
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($course->registrations()->where('student_id', auth()->user()->student->id)->exists())
                                                <button class="btn btn-sm btn-success" disabled>
                                                    <i class="fas fa-check me-1"></i>Registered
                                                </button>
                                            @else
                                                <form method="POST" action="{{ route('student.store_registration') }}" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                    <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Are you sure you want to register for this course?')">
                                                        <i class="fas fa-plus me-1"></i>Register
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Registration Guidelines -->
                <div class="card mt-4 border-info">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Registration Guidelines</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6><i class="fas fa-check text-success me-2"></i>Do's:</h6>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-check text-success me-2"></i>Register for courses in your level</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Check course prerequisites</li>
                                    <li><i class="fas fa-check text-success me-2"></i>Review total unit load</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6><i class="fas fa-times text-danger me-2"></i>Don'ts:</h6>
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-times text-danger me-2"></i>Register for courses already taken</li>
                                    <li><i class="fas fa-times text-danger me-2"></i>Exceed maximum unit load</li>
                                    <li><i class="fas fa-times text-danger me-2"></i>Skip required courses</li>
                                </ul>
                            </div>
                        </div>
                    </div>
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
        .stat-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .card-header {
            border-radius: 15px 15px 0 0 !important;
            border: none;
        }
        @media (max-width: 768px) {
            .stat-card .card-body {
                padding: 1rem;
            }
            .stat-card .fa-2x {
                font-size: 1.5rem !important;
            }
            .table-responsive {
                font-size: 0.9rem;
            }
        }
    </style>
</x-app-layout>
