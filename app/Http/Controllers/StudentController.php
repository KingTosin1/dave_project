<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Registration;
use App\Models\Grade;

class StudentController extends Controller
{
    public function registerCourses()
    {
        $user = Auth::user();
        $student = $user->student;

        if (!$student) {
            return redirect('/dashboard');
        }

        // Get courses matching student's level
        $courses = Course::where('level', $student->level)->get();

        // Get already registered courses
        $registered = $student->registrations()->pluck('course_id')->toArray();

        return view('student.register', compact('courses', 'registered'));
    }

    public function storeRegistration(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $user = Auth::user();
        $student = $user->student;

        if (!$student) {
            return back()->with('error', 'Student profile not found.');
        }

        // Check if already registered
        $exists = Registration::where('student_id', $student->id)
            ->where('course_id', $request->course_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Already registered for this course.');
        }

        // Check if course level matches student level
        $course = Course::find($request->course_id);
        if ($course->level != $student->level) {
            return back()->with('error', 'Course level does not match your level.');
        }

        Registration::create([
            'student_id' => $student->id,
            'course_id' => $request->course_id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Course registration submitted.');
    }

    public function viewResults()
    {
        $user = Auth::user();
        $student = $user->student;

        $grades = $student->grades()->with('course')->get();
        $gpa = $student->calculateGPA();

        return view('student.results', compact('grades', 'gpa'));
    }

    public function printTranscript()
    {
        $user = Auth::user();
        $student = $user->student;

        $grades = $student->grades()->with('course')->get();
        $gpa = $student->calculateGPA();

        return view('student.transcript', compact('grades', 'gpa', 'student', 'user'));
    }
}
