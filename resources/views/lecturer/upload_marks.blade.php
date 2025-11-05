<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Header Section -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
                    <div class="mb-3 mb-md-0">
                        <h1 class="h3 mb-1"><i class="fas fa-upload me-2 text-primary"></i>Upload Marks</h1>
                        <p class="text-muted mb-0">{{ $course->code }} - {{ $course->title }}</p>
                    </div>
                    <a href="{{ route('lecturer.courses') }}" class="btn btn-secondary btn-custom btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Back to Courses
                    </a>
                </div>

                <!-- Course Info Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Course Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="text-center">
                                    <i class="fas fa-hashtag fa-2x text-primary mb-2"></i>
                                    <div class="fw-bold">{{ $course->code }}</div>
                                    <small class="text-muted">Course Code</small>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="text-center">
                                    <i class="fas fa-calculator fa-2x text-success mb-2"></i>
                                    <div class="fw-bold">{{ $course->unit }} Unit{{ $course->unit > 1 ? 's' : '' }}</div>
                                    <small class="text-muted">Credit Units</small>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="text-center">
                                    <i class="fas fa-users fa-2x text-info mb-2"></i>
                                    <div class="fw-bold">{{ $registrations->count() }}</div>
                                    <small class="text-muted">Enrolled Students</small>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="text-center">
                                    <i class="fas fa-layer-group fa-2x text-warning mb-2"></i>
                                    <div class="fw-bold">{{ $course->level }} Level</div>
                                    <small class="text-muted">Academic Level</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Marks Upload Form -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Enter Student Scores</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('lecturer.store_marks', $course) }}" id="marksForm">
                            @csrf

                            <div class="table-responsive">
                                <table class="table table-striped datatable">
                                    <thead class="table-dark">
                                        <tr>
                                            <th><i class="fas fa-id-card me-1"></i>Matric No</th>
                                            <th><i class="fas fa-user me-1"></i>Student Name</th>
                                            <th><i class="fas fa-percentage me-1"></i>Score (0-100)</th>
                                            <th><i class="fas fa-graduation-cap me-1"></i>Grade</th>
                                            <th><i class="fas fa-star me-1"></i>Points</th>
                                            <th><i class="fas fa-check-circle me-1"></i>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($registrations as $registration)
                                        <tr>
                                            <td>
                                                <code class="bg-light px-2 py-1 rounded">{{ $registration->student->matric_no }}</code>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle bg-primary text-white me-2">
                                                        {{ strtoupper(substr($registration->student->user->name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold">{{ $registration->student->user->name }}</div>
                                                        <small class="text-muted">{{ $registration->student->department }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control score-input" name="scores[{{ $registration->student->id }}]" min="0" max="100" placeholder="Enter score" required>
                                            </td>
                                            <td>
                                                <span id="grade-{{ $registration->student->id }}" class="badge bg-secondary">--</span>
                                            </td>
                                            <td>
                                                <span id="points-{{ $registration->student->id }}" class="badge bg-light text-dark">--</span>
                                            </td>
                                            <td>
                                                <span id="status-{{ $registration->student->id }}" class="badge bg-warning">
                                                    <i class="fas fa-clock me-1"></i>Pending
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="confirmSubmission" required>
                                    <label class="form-check-label" for="confirmSubmission">
                                        <i class="fas fa-check-circle text-success me-1"></i>
                                        I confirm that all scores are accurate and ready for submission
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-custom btn-lg" id="submitBtn" disabled>
                                    <i class="fas fa-save me-2"></i>Save All Marks
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Grading Scale Reference -->
                <div class="card mt-4 border-info">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Grading Scale Reference</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-2">
                                <div class="grade-ref bg-success text-white p-2 rounded mb-1">70-100</div>
                                <small>A (5 points)</small>
                            </div>
                            <div class="col-2">
                                <div class="grade-ref bg-primary text-white p-2 rounded mb-1">60-69</div>
                                <small>B (4 points)</small>
                            </div>
                            <div class="col-2">
                                <div class="grade-ref bg-info text-white p-2 rounded mb-1">50-59</div>
                                <small>C (3 points)</small>
                            </div>
                            <div class="col-2">
                                <div class="grade-ref bg-warning text-dark p-2 rounded mb-1">45-49</div>
                                <small>D (2 points)</small>
                            </div>
                            <div class="col-2">
                                <div class="grade-ref bg-secondary text-white p-2 rounded mb-1">40-44</div>
                                <small>E (1 point)</small>
                            </div>
                            <div class="col-2">
                                <div class="grade-ref bg-danger text-white p-2 rounded mb-1">0-39</div>
                                <small>F (0 points)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
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
        .score-input {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            transition: border-color 0.3s ease;
        }
        .score-input:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
        .grade-ref {
            font-weight: bold;
            font-size: 0.9em;
        }
        @media (max-width: 768px) {
            .avatar-circle {
                width: 30px;
                height: 30px;
                font-size: 12px;
            }
            .table-responsive {
                font-size: 0.9rem;
            }
            .grade-ref {
                padding: 0.5rem !important;
                font-size: 0.8em;
            }
        }
    </style>

    <script>
        function calculateGrade(score) {
            if (score >= 70) return { grade: 'A', points: 5, color: 'success' };
            if (score >= 60) return { grade: 'B', points: 4, color: 'primary' };
            if (score >= 50) return { grade: 'C', points: 3, color: 'info' };
            if (score >= 45) return { grade: 'D', points: 2, color: 'warning' };
            if (score >= 40) return { grade: 'E', points: 1, color: 'secondary' };
            return { grade: 'F', points: 0, color: 'danger' };
        }

        function updateSubmitButton() {
            const inputs = document.querySelectorAll('.score-input');
            const checkbox = document.getElementById('confirmSubmission');
            const submitBtn = document.getElementById('submitBtn');

            const allFilled = Array.from(inputs).every(input => input.value.trim() !== '');
            submitBtn.disabled = !(allFilled && checkbox.checked);
        }

        document.querySelectorAll('.score-input').forEach(input => {
            input.addEventListener('input', function() {
                const studentId = this.name.match(/\[(\d+)\]/)[1];
                const score = parseInt(this.value) || 0;
                const result = calculateGrade(score);

                const gradeElement = document.getElementById(`grade-${studentId}`);
                const pointsElement = document.getElementById(`points-${studentId}`);
                const statusElement = document.getElementById(`status-${studentId}`);

                gradeElement.textContent = result.grade;
                gradeElement.className = `badge bg-${result.color}`;

                pointsElement.textContent = result.points;

                if (this.value.trim() !== '') {
                    statusElement.innerHTML = '<i class="fas fa-check-circle me-1"></i>Ready';
                    statusElement.className = 'badge bg-success';
                } else {
                    statusElement.innerHTML = '<i class="fas fa-clock me-1"></i>Pending';
                    statusElement.className = 'badge bg-warning';
                }

                updateSubmitButton();
            });
        });

        document.getElementById('confirmSubmission').addEventListener('change', updateSubmitButton);

        // Initialize submit button state
        updateSubmitButton();
    </script>
</x-app-layout>
