<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    protected $fillable = ['code', 'title', 'unit', 'semester', 'level'];

    // Relationship to Registrations
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    // Relationship to LecturerCourses
    public function lecturerCourses(): HasMany
    {
        return $this->hasMany(LecturerCourse::class);
    }

    // Relationship to Grades
    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }
}
