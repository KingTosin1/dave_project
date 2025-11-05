<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Transcript - {{ $student->matric_no }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .transcript-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            padding: 40px;
            margin: 0 auto;
            max-width: 1200px;
        }
        .transcript-header {
            text-align: center;
            margin-bottom: 40px;
            border-bottom: 3px solid #667eea;
            padding-bottom: 20px;
        }
        .transcript-header h2 {
            color: #333;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .transcript-header h4 {
            color: #667eea;
            font-weight: 500;
        }
        .student-info {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .student-info .row {
            align-items: center;
        }
        .student-info strong {
            font-weight: 600;
        }
        .gpa-card {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            font-size: 1.2em;
            font-weight: 600;
        }
        .transcript-table {
            margin-top: 30px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .transcript-table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .transcript-table th {
            font-weight: 600;
            border: none;
            padding: 15px;
        }
        .transcript-table td {
            padding: 12px 15px;
            border: none;
            vertical-align: middle;
        }
        .transcript-table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .transcript-table tbody tr:hover {
            background-color: #e9ecef;
            transform: scale(1.01);
            transition: all 0.2s ease;
        }
        .grade-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9em;
        }
        .grade-A { background: #28a745; color: white; }
        .grade-B { background: #17a2b8; color: white; }
        .grade-C { background: #ffc107; color: black; }
        .grade-D { background: #fd7e14; color: white; }
        .grade-E { background: #dc3545; color: white; }
        .grade-F { background: #6c757d; color: white; }
        .action-buttons {
            text-align: center;
            margin-top: 40px;
        }
        .btn-custom {
            border-radius: 25px;
            padding: 10px 30px;
            font-weight: 600;
            margin: 0 10px;
            transition: all 0.3s ease;
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .btn-secondary-custom {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            border: none;
        }
        .btn-secondary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(240, 147, 251, 0.4);
        }
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; font-size: 12px; padding: 0; }
            .transcript-container { box-shadow: none; padding: 20px; }
            .student-info { background: #f8f9fa !important; color: black !important; }
            .gpa-card { background: #e9ecef !important; color: black !important; }
        }
        @media (max-width: 768px) {
            .transcript-container { padding: 20px; }
            .student-info .row { text-align: center; }
            .student-info .col-md-6 { margin-bottom: 10px; }
        }
    </style>
</head>
<body>
    <div class="transcript-container">
        <div class="transcript-header">
            <h2><i class="fas fa-graduation-cap me-2"></i>Academic Transcript</h2>
            <h4>Course Registration & Result Processing System</h4>
        </div>

        <div class="student-info">
            <div class="row">
                <div class="col-md-6">
                    <i class="fas fa-user me-2"></i><strong>Name:</strong> {{ $user->name }}<br>
                    <i class="fas fa-id-card me-2"></i><strong>Matric No:</strong> {{ $student->matric_no }}<br>
                    <i class="fas fa-building me-2"></i><strong>Department:</strong> {{ $student->department }}<br>
                    <i class="fas fa-layer-group me-2"></i><strong>Level:</strong> {{ $student->level }}
                </div>
                <div class="col-md-6 text-end">
                    <i class="fas fa-calendar me-2"></i><strong>Date:</strong> {{ date('d/m/Y') }}<br>
                    <div class="gpa-card mt-2">
                        <i class="fas fa-chart-line me-2"></i>GPA: {{ $gpa ?? 'N/A' }}
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-bordered transcript-table">
            <thead>
                <tr>
                    <th><i class="fas fa-code me-1"></i>Course Code</th>
                    <th><i class="fas fa-book me-1"></i>Course Title</th>
                    <th><i class="fas fa-clock me-1"></i>Unit</th>
                    <th><i class="fas fa-percentage me-1"></i>Score</th>
                    <th><i class="fas fa-award me-1"></i>Grade</th>
                    <th><i class="fas fa-star me-1"></i>Points</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grades as $grade)
                <tr>
                    <td><strong>{{ $grade->course->code }}</strong></td>
                    <td>{{ $grade->course->title }}</td>
                    <td><span class="badge bg-info">{{ $grade->course->unit }}</span></td>
                    <td><strong>{{ $grade->score }}</strong></td>
                    <td>
                        <span class="grade-badge grade-{{ $grade->grade }}">
                            {{ $grade->grade }}
                        </span>
                    </td>
                    <td><strong>{{ $grade->points }}</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="action-buttons no-print">
            <button onclick="window.print()" class="btn btn-custom btn-primary-custom">
                <i class="fas fa-print me-2"></i>Print Transcript
            </button>
            <a href="{{ route('student.results') }}" class="btn btn-custom btn-secondary-custom">
                <i class="fas fa-arrow-left me-2"></i>Back to Results
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
