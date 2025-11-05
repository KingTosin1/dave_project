<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Header Section -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
                    <div class="mb-3 mb-md-0">
                        <h1 class="h3 mb-1"><i class="fas fa-edit me-2 text-primary"></i>Edit Marks</h1>
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
                                    <div class="fw-bold">{{ $grades->count() }}</div>
                                    <small class="text-muted">Graded Students</small>
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

                <!-- Edit Marks Form -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Update Student Scores</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('lecturer.update_marks', $course) }}" id="editMarksForm">
                            @csrf
                            @method('PUT')

                            <div class="alert alert-info" role="alert">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>Note:</strong> Changes will be saved immediately. Make sure all scores are accurate before updating.
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped datatable">
                                    <thead class="table-dark">
                                        <tr>
                                            <th><i class="fas fa-id-card me-1"></i>Matric No</th>
                                            <th><i class="fas fa-user me-1"></i>Student Name</th>
                                            <th><i class="fas fa-history me-1"></i>Current Score</th>
                                            <th><i class="fas fa-edit me-1"></i>New Score (0-100)</th>
                                            <th><i class="fas fa-graduation-cap me-1"></i>Grade</th>
                                            <th><i class="fas fa-star me-1"></i>Points</th>
                                            <th><i class="fas fa-exchange-alt me-1"></i>Change</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($grades as $grade)
                                        <tr>
                                            <td>
                                                <code class="bg-light px-2 py-1 rounded">{{ $grade->student->matric_no }}</code>
                                            </td>
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
                                                <span class="badge bg-secondary fs-6">{{ $grade->score }}%</span>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control score-input" name="scores[{{ $grade->student->id }}]" value="{{ $grade->score }}" min="0" max="100" required data-original="{{ $grade->score }}">
                                            </td>
                                            <td>
                                                <span id="grade-{{ $grade->student->id }}" class="badge bg-{{ $grade->grade === 'F' ? 'danger' : 'success' }}">{{ $grade->grade }}</span>
                                            </td>
                                            <td>
                                                <span id="points-{{ $grade->student->id }}" class="badge bg-light text-dark fw-bold">{{ $grade->points }}</span>
                                            </td>
                                            <td>
                                                <span id="change-{{ $grade->student->id }}" class="badge bg-secondary">
                                                    <i class="fas fa-minus me-1"></i>No Change
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="confirmUpdate" required>
                                    <label class="form-check-label" for="confirmUpdate">
                                        <i class="fas fa-check-circle text-success me-1"></i>
                                        I confirm that all updated scores are accurate
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-custom btn-lg" id="updateBtn" disabled>
                                    <i class="fas fa-save me-2"></i>Update All Marks
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
        .score-input.changed {
            border-color: #ffc107;
            background-color: #fff3cd;
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
            const checkbox = document.getElementById('confirmUpdate');
            const updateBtn = document.getElementById('updateBtn');
            updateBtn.disabled = !checkbox.checked;
        }

        document.querySelectorAll('.score-input').forEach(input => {
            input.addEventListener('input', function() {
                const studentId = this.name.match(/\[(\d+)\]/)[1];
                const score = parseInt(this.value) || 0;
                const originalScore = parseInt(this.dataset.original) || 0;
                const result = calculateGrade(score);

                const gradeElement = document.getElementById(`grade-${studentId}`);
                const pointsElement = document.getElementById(`points-${studentId}`);
                const changeElement = document.getElementById(`change-${studentId}`);

                gradeElement.textContent = result.grade;
                gradeElement.className = `badge bg-${result.color}`;

                pointsElement.textContent = result.points;

                // Highlight changes
                if (score !== originalScore) {
                    this.classList.add('changed');
                    const diff = score - originalScore;
                    const icon = diff > 0 ? 'fa-arrow-up text-success' : 'fa-arrow-down text-danger';
                    changeElement.innerHTML = `<i class="fas ${icon} me-1"></i>${Math.abs(diff)}`;
                    changeElement.className = `badge ${diff > 0 ? 'bg-success' : 'bg-danger'}`;
                } else {
                    this.classList.remove('changed');
                    changeElement.innerHTML = '<i class="fas fa-minus me-1"></i>No Change';
                    changeElement.className = 'badge bg-secondary';
                }

                updateSubmitButton();
            });
        });

        document.getElementById('confirmUpdate').addEventListener('change', updateSubmitButton);

        // Initialize submit button state
        updateSubmitButton();
    </script>
</x-app-layout>
