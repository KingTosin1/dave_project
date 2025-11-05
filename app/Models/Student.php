<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = ['user_id', 'matric_no', 'department', 'level'];

    // Relationship to User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to Registrations
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    // Relationship to Grades
    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }

    // Calculate GPA for the student
    public function calculateGPA()
    {
        $grades = $this->grades()->with('course')->get();
        if ($grades->isEmpty()) return 0;

        $totalPoints = 0;
        $totalUnits = 0;

        foreach ($grades as $grade) {
            $totalPoints += $grade->points * $grade->course->unit;
            $totalUnits += $grade->course->unit;
        }

        return $totalUnits > 0 ? round($totalPoints / $totalUnits, 2) : 0;
    }

    // Calculate CGPA for the student (same as GPA for simplicity)
    public function calculateCGPA()
    {
        return $this->calculateGPA();
    }
}
