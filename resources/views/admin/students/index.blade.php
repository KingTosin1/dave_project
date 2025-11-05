<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Header Section -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
                    <div class="mb-3 mb-md-0">
                        <h1 class="h3 mb-1"><i class="fas fa-users me-2 text-primary"></i>Manage Students</h1>
                        <p class="text-muted mb-0">Manage student accounts and information</p>
                    </div>
                    <a href="{{ route('admin.students.create') }}" class="btn btn-primary btn-custom btn-lg">
                        <i class="fas fa-plus me-2"></i>Add New Student
                    </a>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card stat-card text-white bg-gradient-primary">
                            <div class="card-body text-center">
                                <i class="fas fa-users fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ $students->count() }}</h4>
                                <p class="card-text mb-0">Total Students</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card stat-card text-white bg-gradient-success">
                            <div class="card-body text-center">
                                <i class="fas fa-graduation-cap fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ $students->where('level', 100)->count() }}</h4>
                                <p class="card-text mb-0">100 Level</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card stat-card text-white bg-gradient-info">
                            <div class="card-body text-center">
                                <i class="fas fa-university fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ $students->where('level', 200)->count() }}</h4>
                                <p class="card-text mb-0">200 Level</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card stat-card text-white bg-gradient-warning">
                            <div class="card-body text-center">
                                <i class="fas fa-crown fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ $students->where('level', '>=', 300)->count() }}</h4>
                                <p class="card-text mb-0">300+ Level</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Students Table -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Students List</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="fas fa-id-card me-1"></i>Matric No</th>
                                        <th><i class="fas fa-user me-1"></i>Name</th>
                                        <th><i class="fas fa-envelope me-1"></i>Email</th>
                                        <th><i class="fas fa-building me-1"></i>Department</th>
                                        <th><i class="fas fa-layer-group me-1"></i>Level</th>
                                        <th><i class="fas fa-cogs me-1"></i>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                        <td>
                                            <code class="bg-light px-2 py-1 rounded">{{ $student->matric_no }}</code>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-primary text-white me-2">
                                                    {{ strtoupper(substr($student->user->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="fw-bold">{{ $student->user->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $student->user->email }}</td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $student->department }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $student->level }} Level</span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.students.edit', $student) }}" class="btn btn-sm btn-warning" title="Edit Student">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST" action="{{ route('admin.students.destroy', $student) }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this student?')" title="Delete Student">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
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
        .btn-group .btn {
            margin-right: 2px;
        }
        .btn-group .btn:last-child {
            margin-right: 0;
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
