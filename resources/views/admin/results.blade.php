<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Header Section -->
                <div class="mb-4">
                    <h1 class="h3 mb-1"><i class="fas fa-chart-bar me-2 text-primary"></i>All Student Results</h1>
                    <p class="text-muted mb-0">View and manage all student grades and academic performance</p>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card stat-card text-white bg-gradient-primary">
                            <div class="card-body text-center">
                                <i class="fas fa-users fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ $grades->unique('student_id')->count() }}</h4>
                                <p class="card-text mb-0">Students with Results</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card stat-card text-white bg-gradient-success">
                            <div class="card-body text-center">
                                <i class="fas fa-book fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ $grades->count() }}</h4>
                                <p class="card-text mb-0">Total Grades</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card stat-card text-white bg-gradient-info">
                            <div class="card-body text-center">
                                <i class="fas fa-trophy fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ $grades->where('grade', 'A')->count() }}</h4>
                                <p class="card-text mb-0">A Grades</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card stat-card text-white bg-gradient-warning">
                            <div class="card-body text-center">
                                <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ $grades->where('grade', 'F')->count() }}</h4>
                                <p class="card-text mb-0">F Grades</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Results Table -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Student Results Overview</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="fas fa-user me-1"></i>Student</th>
                                        <th><i class="fas fa-id-card me-1"></i>Matric No</th>
                                        <th><i class="fas fa-book me-1"></i>Course</th>
                                        <th><i class="fas fa-calculator me-1"></i>Score</th>
                                        <th><i class="fas fa-graduation-cap me-1"></i>Grade</th>
                                        <th><i class="fas fa-star me-1"></i>Points</th>
                                        <th><i class="fas fa-calendar me-1"></i>Recorded Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($grades as $grade)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-primary text-white me-2">
                                                    {{ strtoupper(substr($grade->student->user->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="fw-bold">{{ $grade->student->user->name }}</div>
                                                    <small class="text-muted">{{ $grade->student->department }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <code class="bg-light px-2 py-1 rounded">{{ $grade->student->matric_no }}</code>
                                        </td>
                                        <td>
                                            <div>
                                                <div class="fw-bold">{{ $grade->course->title }}</div>
                                                <small class="text-muted">{{ $grade->course->code }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary fs-6">{{ $grade->score }}%</span>
                                        </td>
                                        <td>
                                            <span class="badge fs-6
                                                @if($grade->grade === 'A') bg-success
                                                @elseif($grade->grade === 'B') bg-primary
                                                @elseif($grade->grade === 'C') bg-info
                                                @elseif($grade->grade === 'D') bg-warning
                                                @else bg-danger
                                                @endif">
                                                <i class="fas fa-graduation-cap me-1"></i>{{ $grade->grade }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark fw-bold">{{ $grade->points }}</span>
                                        </td>
                                        <td>{{ $grade->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
        .bg-gradient-warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
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
            .avatar-circle {
                width: 30px;
                height: 30px;
                font-size: 12px;
            }
        }
    </style>
</x-app-layout>
