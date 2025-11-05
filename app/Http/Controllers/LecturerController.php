<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LecturerCourse;
use App\Models\Registration;
use App\Models\Grade;

class LecturerController extends Controller
{
    public function assignedCourses()
    {
        $user = Auth::user();
        $courses = LecturerCourse::where('lecturer_id', $user->id)->with('course')->get();

        return view('lecturer.courses', compact('courses'));
    }

    public function uploadMarks($courseId)
    {
        $user = Auth::user();

        // Check if lecturer is assigned to this course
        $lecturerCourse = LecturerCourse::where('lecturer_id', $user->id)
            ->where('course_id', $courseId)
            ->with('course')
            ->first();

        if (!$lecturerCourse) {
            return redirect('/lecturer/courses')->with('error', 'Not assigned to this course.');
        }

        // Get approved registrations for this course
        $registrations = Registration::where('course_id', $courseId)
            ->where('status', 'approved')
            ->with('student.user')
            ->get();

        $course = $lecturerCourse->course;

        return view('lecturer.upload_marks', compact('registrations', 'course'));
    }

    public function storeMarks(Request $request, $courseId)
    {
        $request->validate([
            'scores' => 'required|array',
            'scores.*' => 'required|numeric|min:0|max:100',
        ]);

        $user = Auth::user();

        // Check if lecturer is assigned to this course
        $lecturerCourse = LecturerCourse::where('lecturer_id', $user->id)
            ->where('course_id', $courseId)
            ->first();

        if (!$lecturerCourse) {
            return back()->with('error', 'Not assigned to this course.');
        }

        // Get approved registrations for this course
        $registrations = Registration::where('course_id', $courseId)
            ->where('status', 'approved')
            ->get();

        foreach ($request->scores as $studentId => $score) {
            $gradeData = Grade::calculateGrade($score);

            Grade::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'course_id' => $courseId,
                ],
                [
                    'score' => $score,
                    'grade' => $gradeData['grade'],
                    'points' => $gradeData['points'],
                ]
            );
        }

        return back()->with('success', 'Marks uploaded successfully.');
    }

    public function editMarks($courseId)
    {
        $user = Auth::user();

        // Check if lecturer is assigned to this course
        $lecturerCourse = LecturerCourse::where('lecturer_id', $user->id)
            ->where('course_id', $courseId)
            ->with('course')
            ->first();

        if (!$lecturerCourse) {
            return redirect('/lecturer/courses')->with('error', 'Not assigned to this course.');
        }

        // Get grades for this course
        $grades = Grade::where('course_id', $courseId)
            ->with('student.user')
            ->get();

        $course = $lecturerCourse->course;

        return view('lecturer.edit_marks', compact('grades', 'course'));
    }

    public function updateMarks(Request $request, $courseId)
    {
        $request->validate([
            'scores' => 'required|array',
            'scores.*' => 'required|numeric|min:0|max:100',
        ]);

        $user = Auth::user();

        // Check if lecturer is assigned to this course
        $lecturerCourse = LecturerCourse::where('lecturer_id', $user->id)
            ->where('course_id', $courseId)
            ->first();

        if (!$lecturerCourse) {
            return back()->with('error', 'Not assigned to this course.');
        }

        foreach ($request->scores as $studentId => $score) {
            $gradeData = Grade::calculateGrade($score);

            Grade::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'course_id' => $courseId,
                ],
                [
                    'score' => $score,
                    'grade' => $gradeData['grade'],
                    'points' => $gradeData['points'],
                ]
            );
        }

        return back()->with('success', 'Marks updated successfully.');
    }
}
