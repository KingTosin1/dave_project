<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3"><i class="fas fa-clipboard-list me-2 text-primary"></i>Course Registrations</h1>
                    <div class="stats-card">
                        <div class="stat-number">{{ $registrations->count() }}</div>
                        <div class="stat-label">Total Registrations</div>
                    </div>
                </div>

                <!-- Stats Row -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card card-hover text-white bg-gradient-success">
                            <div class="card-body text-center">
                                <i class="fas fa-check-circle fa-2x mb-2"></i>
                                <h5 class="card-title">{{ $registrations->where('status', 'approved')->count() }}</h5>
                                <p class="card-text">Approved</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-hover text-white bg-gradient-warning">
                            <div class="card-body text-center">
                                <i class="fas fa-clock fa-2x mb-2"></i>
                                <h5 class="card-title">{{ $registrations->where('status', 'pending')->count() }}</h5>
                                <p class="card-text">Pending</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-hover text-white bg-gradient-info">
                            <div class="card-body text-center">
                                <i class="fas fa-users fa-2x mb-2"></i>
                                <h5 class="card-title">{{ $registrations->unique('student_id')->count() }}</h5>
                                <p class="card-text">Active Students</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Registration Activities</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-user me-1"></i>Student</th>
                                        <th><i class="fas fa-id-card me-1"></i>Matric No</th>
                                        <th><i class="fas fa-book me-1"></i>Course</th>
                                        <th><i class="fas fa-calendar me-1"></i>Registered Date</th>
                                        <th><i class="fas fa-info-circle me-1"></i>Status</th>
                                        <th><i class="fas fa-cogs me-1"></i>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registrations as $registration)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-primary text-white me-2">
                                                    {{ strtoupper(substr($registration->student->user->name, 0, 1)) }}
                                                </div>
                                                {{ $registration->student->user->name }}
                                            </div>
                                        </td>
                                        <td><code>{{ $registration->student->matric_no }}</code></td>
                                        <td>
                                            <strong>{{ $registration->course->code }}</strong><br>
                                            <small class="text-muted">{{ $registration->course->title }}</small>
                                        </td>
                                        <td>{{ $registration->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $registration->status === 'approved' ? 'success' : ($registration->status === 'pending' ? 'warning' : 'secondary') }} fs-6">
                                                <i class="fas fa-{{ $registration->status === 'approved' ? 'check' : ($registration->status === 'pending' ? 'clock' : 'times') }} me-1"></i>
                                                {{ ucfirst($registration->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($registration->status === 'pending')
                                                <div class="btn-group" role="group">
                                                    <form method="POST" action="{{ route('admin.registrations.approve', $registration) }}" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success" title="Approve Registration">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                    <form method="POST" action="{{ route('admin.registrations.reject', $registration) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to reject this registration?')" title="Reject Registration">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="text-muted">
                                                    <i class="fas fa-check-circle text-success me-1"></i>
                                                    {{ ucfirst($registration->status) }}
                                                </span>
                                            @endif
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
        .bg-gradient-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }
        .bg-gradient-warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .bg-gradient-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
    </style>
</x-app-layout>
