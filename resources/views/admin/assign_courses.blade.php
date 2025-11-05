<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Header Section -->
                <div class="mb-4">
                    <h1 class="h3 mb-1"><i class="fas fa-link me-2 text-primary"></i>Assign Courses to Lecturers</h1>
                    <p class="text-muted mb-0">Assign courses to lecturers for teaching responsibilities</p>
                </div>

                <!-- Assignment Form -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Create New Assignment</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.store_assignment') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="lecturer_id" class="form-label fw-bold">
                                        <i class="fas fa-chalkboard-teacher me-1 text-primary"></i>Select Lecturer
                                    </label>
                                    <select class="form-select form-select-lg" id="lecturer_id" name="lecturer_id" required>
                                        <option value="">Choose Lecturer</option>
                                        @foreach($lecturers as $lecturer)
                                            <option value="{{ $lecturer->id }}">
                                                <i class="fas fa-user me-2"></i>{{ $lecturer->name }} ({{ $lecturer->lecturerCourses()->count() }} courses assigned)
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('lecturer_id') <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="course_id" class="form-label fw-bold">
                                        <i class="fas fa-book me-1 text-primary"></i>Select Course
                                    </label>
                                    <select class="form-select form-select-lg" id="course_id" name="course_id" required>
                                        <option value="">Choose Course</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}">
                                                {{ $course->code }} - {{ $course->title }} ({{ $course->unit }} unit{{ $course->unit > 1 ? 's' : '' }}, {{ $course->level }} Level)
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('course_id') <div class="text-danger mt-1"><i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary btn-custom btn-lg">
                                    <i class="fas fa-link me-2"></i>Assign Course
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="card stat-card text-white bg-gradient-primary">
                            <div class="card-body text-center">
                                <i class="fas fa-chalkboard-teacher fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ $lecturers->count() }}</h4>
                                <p class="card-text mb-0">Available Lecturers</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card stat-card text-white bg-gradient-success">
                            <div class="card-body text-center">
                                <i class="fas fa-book fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ $courses->count() }}</h4>
                                <p class="card-text mb-0">Available Courses</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card stat-card text-white bg-gradient-info">
                            <div class="card-body text-center">
                                <i class="fas fa-link fa-2x mb-2"></i>
                                <h4 class="card-title mb-1">{{ $assignments->count() }}</h4>
                                <p class="card-text mb-0">Current Assignments</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Current Assignments Table -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Current Assignments</h5>
                        <span class="badge bg-primary">{{ $assignments->count() }} assignments</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                                <thead class="table-dark">
                                    <tr>
                                        <th><i class="fas fa-chalkboard-teacher me-1"></i>Lecturer</th>
                                        <th><i class="fas fa-book me-1"></i>Course</th>
                                        <th><i class="fas fa-hashtag me-1"></i>Course Code</th>
                                        <th><i class="fas fa-layer-group me-1"></i>Level</th>
                                        <th><i class="fas fa-calendar me-1"></i>Assigned Date</th>
                                        <th><i class="fas fa-cogs me-1"></i>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($assignments as $assignment)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-success text-white me-2">
                                                    {{ strtoupper(substr($assignment->user->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="fw-bold">{{ $assignment->user->name }}</div>
                                                    <small class="text-muted">{{ $assignment->user->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $assignment->course->title }}</div>
                                        </td>
                                        <td>
                                            <code class="bg-light px-2 py-1 rounded">{{ $assignment->course->code }}</code>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $assignment->course->level }} Level</span>
                                        </td>
                                        <td>{{ $assignment->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <form method="POST" action="{{ route('admin.remove_assignment', $assignment) }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to remove this assignment?')" title="Remove Assignment">
                                                    <i class="fas fa-unlink me-1"></i>Remove
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
        .form-select {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            transition: border-color 0.3s ease;
        }
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
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
