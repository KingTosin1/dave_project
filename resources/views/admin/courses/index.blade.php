<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Header Section -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
                    <div class="mb-3 mb-md-0">
                        <h1 class="h3 mb-1"><i class="fas fa-book me-2 text-primary"></i>Manage Courses</h1>
                        <p class="text-muted mb-0">Manage course offerings and curriculum</p>
                    </div>
                    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary btn-custom btn-lg">
                        <i class="fas fa-plus me-2"></i>Add New Course
                    </a>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card stat-card text-white bg-gradient-primary">
                            <div class="card-body text-center">
                                <i class="fas fa-book fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ $courses->count() }}</h4>
                                <p class="card-text mb-0">Total Courses</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card stat-card text-white bg-gradient-success">
                            <div class="card-body text-center">
                                <i class="fas fa-calculator fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ $courses->sum('unit') }}</h4>
                                <p class="card-text mb-0">Total Units</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card stat-card text-white bg-gradient-info">
                            <div class="card-body text-center">
                                <i class="fas fa-layer-group fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ $courses->unique('level')->count() }}</h4>
                                <p class="card-text mb-0">Levels Offered</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card stat-card text-white bg-gradient-warning">
                            <div class="card-body text-center">
                                <i class="fas fa-clock fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ $courses->where('semester', 'First')->count() }}</h4>
                                <p class="card-text mb-0">First Semester</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Courses Table -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Courses List</h5>
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
                                        <th><i class="fas fa-users me-1"></i>Enrolled</th>
                                        <th><i class="fas fa-cogs me-1"></i>Actions</th>
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
                                            <span class="badge bg-primary">
                                                <i class="fas fa-users me-1"></i>
                                                {{ $course->registrations()->count() }}
                                            </span>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this course?')" title="Delete Course">
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
        }
    </style>
</x-app-layout>
