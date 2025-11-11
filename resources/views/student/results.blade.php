<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Header Section -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
                    <div class="mb-3 mb-md-0">
                        <h1 class="h3 mb-1"><i class="fas fa-chart-line me-2 text-primary"></i>My Results</h1>
                        <p class="text-muted mb-0">View your academic performance and grades</p>
                    </div>
                    <a href="{{ route('student.transcript') }}" class="btn btn-primary btn-custom btn-lg">
                        <i class="fas fa-file-pdf me-2"></i>Print Transcript
                    </a>
                </div>

                <!-- Performance Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card stat-card text-white bg-gradient-primary">
                            <div class="card-body text-center">
                                <i class="fas fa-graduation-cap fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ auth()->user()->student ? auth()->user()->student->calculateGPA() : 'N/A' }}</h4>
                                <p class="card-text mb-0">Current GPA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card stat-card text-white bg-gradient-success">
                            <div class="card-body text-center">
                                <i class="fas fa-trophy fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ auth()->user()->student->calculateCGPA() ?? 'N/A' }}</h4>
                                <p class="card-text mb-0">Cumulative GPA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card stat-card text-white bg-gradient-info">
                            <div class="card-body text-center">
                                <i class="fas fa-book fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ $grades->count() }}</h4>
                                <p class="card-text mb-0">Courses Completed</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card stat-card text-white bg-gradient-warning">
                            <div class="card-body text-center">
                                <i class="fas fa-star fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ $grades->where('grade', 'A')->count() }}</h4>
                                <p class="card-text mb-0">A Grades</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Results Table -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Course Results</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="fas fa-hashtag me-1"></i>Course Code</th>
                                        <th><i class="fas fa-book me-1"></i>Course Title</th>
                                        <th><i class="fas fa-calculator me-1"></i>Unit</th>
                                        <th><i class="fas fa-percentage me-1"></i>Score</th>
                                        <th><i class="fas fa-graduation-cap me-1"></i>Grade</th>
                                        <th><i class="fas fa-star me-1"></i>Points</th>
                                        <th><i class="fas fa-calendar me-1"></i>Semester</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($grades as $grade)
                                    <tr>
                                        <td>
                                            <code class="bg-light px-2 py-1 rounded">{{ $grade->course->code }}</code>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $grade->course->title }}</div>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">{{ $grade->course->unit }} Unit{{ $grade->course->unit > 1 ? 's' : '' }}</span>
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
                                        <td>
                                            <span class="badge bg-info">{{ $grade->course->semester }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Performance Insights -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card border-success">
                            <div class="card-header bg-success text-white">
                                <h6 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Grade Distribution</h6>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-3">
                                        <div class="grade-circle bg-success">{{ $grades->where('grade', 'A')->count() }}</div>
                                        <small>A</small>
                                    </div>
                                    <div class="col-3">
                                        <div class="grade-circle bg-primary">{{ $grades->where('grade', 'B')->count() }}</div>
                                        <small>B</small>
                                    </div>
                                    <div class="col-3">
                                        <div class="grade-circle bg-info">{{ $grades->where('grade', 'C')->count() }}</div>
                                        <small>C</small>
                                    </div>
                                    <div class="col-3">
                                        <div class="grade-circle bg-warning">{{ $grades->where('grade', 'D')->count() }}</div>
                                        <small>D</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-info">
                            <div class="card-header bg-info text-white">
                                <h6 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Academic Tips</h6>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Maintain consistent study habits</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Seek help when needed</li>
                                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Balance coursework load</li>
                                    <li class="mb-0"><i class="fas fa-check-circle text-success me-2"></i>Review feedback regularly</li>
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
        .grade-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
            margin: 0 auto 5px;
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
            .grade-circle {
                width: 40px;
                height: 40px;
                font-size: 14px;
            }
            .table-responsive {
                font-size: 0.9rem;
            }
        }
    </style>
</x-app-layout>
