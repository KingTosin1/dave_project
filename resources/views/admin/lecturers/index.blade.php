<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Header Section -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
                    <div class="mb-3 mb-md-0">
                        <h1 class="h3 mb-1"><i class="fas fa-chalkboard-teacher me-2 text-primary"></i>Manage Lecturers</h1>
                        <p class="text-muted mb-0">Manage lecturer accounts and course assignments</p>
                    </div>
                    <a href="{{ route('admin.lecturers.create') }}" class="btn btn-primary btn-custom btn-lg">
                        <i class="fas fa-plus me-2"></i>Add New Lecturer
                    </a>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="card stat-card text-white bg-gradient-primary">
                            <div class="card-body text-center">
                                <i class="fas fa-chalkboard-teacher fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ $lecturers->count() }}</h4>
                                <p class="card-text mb-0">Total Lecturers</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card stat-card text-white bg-gradient-success">
                            <div class="card-body text-center">
                                <i class="fas fa-book fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ $lecturers->sum(fn($l) => $l->lecturerCourses()->count()) }}</h4>
                                <p class="card-text mb-0">Total Course Assignments</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card stat-card text-white bg-gradient-info">
                            <div class="card-body text-center">
                                <i class="fas fa-chart-line fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ round($lecturers->avg(fn($l) => $l->lecturerCourses()->count()), 1) }}</h4>
                                <p class="card-text mb-0">Avg Courses per Lecturer</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lecturers Table -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Lecturers List</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="fas fa-user me-1"></i>Name</th>
                                        <th><i class="fas fa-envelope me-1"></i>Email</th>
                                        <th><i class="fas fa-book me-1"></i>Assigned Courses</th>
                                        <th><i class="fas fa-calendar me-1"></i>Joined Date</th>
                                        <th><i class="fas fa-cogs me-1"></i>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lecturers as $lecturer)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-success text-white me-2">
                                                    {{ strtoupper(substr($lecturer->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="fw-bold">{{ $lecturer->name }}</div>
                                                    <small class="text-muted">Lecturer</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $lecturer->email }}</td>
                                        <td>
                                            <span class="badge bg-primary fs-6">
                                                <i class="fas fa-book me-1"></i>
                                                {{ $lecturer->lecturerCourses()->count() }} Course{{ $lecturer->lecturerCourses()->count() !== 1 ? 's' : '' }}
                                            </span>
                                        </td>
                                        <td>{{ $lecturer->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('admin.lecturers.destroy', $lecturer) }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this lecturer?')" title="Delete Lecturer">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
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
