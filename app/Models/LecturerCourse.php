<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LecturerCourse extends Model
{
    protected $fillable = ['lecturer_id', 'course_id'];

    // Relationship to User (Lecturer)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    public function lecturer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    // Relationship to Course
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
