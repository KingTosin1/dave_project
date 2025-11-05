<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use App\Models\Registration;
use App\Models\LecturerCourse;
use App\Models\Grade;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return $this->adminDashboard();
        } elseif ($user->role === 'lecturer') {
            return $this->lecturerDashboard();
        } elseif ($user->role === 'student') {
            return $this->studentDashboard();
        }

        return redirect('/login');
    }

    private function adminDashboard()
    {
        // Stats for admin dashboard
        $totalStudents = Student::count();
        $totalLecturers = User::where('role', 'lecturer')->count();
        $totalCourses = Course::count();
        $pendingRegistrations = Registration::where('status', 'pending')->count();

        return view('dashboard', compact('totalStudents', 'totalLecturers', 'totalCourses', 'pendingRegistrations'));
    }

    private function lecturerDashboard()
    {
        $user = Auth::user();
        // Get assigned courses count
        $assignedCourses = LecturerCourse::where('lecturer_id', $user->id)->count();

        return view('dashboard', compact('assignedCourses'));
    }

    private function studentDashboard()
    {
        $user = Auth::user();
        $student = $user->student;

        if (!$student) {
            return view('dashboard');
        }

        // Student stats
        $registeredCourses = $student->registrations()->where('status', 'approved')->count();
        $gpa = $student->calculateGPA();
        $level = $student->level;

        return view('dashboard', compact('registeredCourses', 'gpa', 'level'));
    }
}
