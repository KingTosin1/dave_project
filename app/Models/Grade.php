<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grade extends Model
{
    protected $fillable = ['student_id', 'course_id', 'score', 'grade', 'points'];

    // Relationship to Student
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    // Relationship to Course
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    // Calculate grade and points based on score
    public static function calculateGrade($score)
    {
        if ($score >= 70) return ['grade' => 'A', 'points' => 5.00];
        if ($score >= 60) return ['grade' => 'B', 'points' => 4.00];
        if ($score >= 50) return ['grade' => 'C', 'points' => 3.00];
        if ($score >= 45) return ['grade' => 'D', 'points' => 2.00];
        if ($score >= 40) return ['grade' => 'E', 'points' => 1.00];
        return ['grade' => 'F', 'points' => 0.00];
    }
}
