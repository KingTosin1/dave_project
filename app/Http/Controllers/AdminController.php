<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use App\Models\LecturerCourse;
use App\Models\Registration;

class AdminController extends Controller
{
    // Students CRUD
    public function studentsIndex()
    {
        $students = Student::with('user')->get();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'matric_no' => 'required|unique:students',
            'department' => 'required|string',
            'level' => 'required|integer|min:100|max:400',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
        ]);

        Student::create([
            'user_id' => $user->id,
            'matric_no' => $request->matric_no,
            'department' => $request->department,
            'level' => $request->level,
        ]);

        return redirect('/admin/students')->with('success', 'Student created successfully.');
    }

    public function createStudent()
    {
        return view('admin.students.create');
    }

    public function storeStudent(Request $request)
    {
        return $this->store($request);
    }

    public function edit($id)
    {
        $student = Student::with('user')->findOrFail($id);
        return view('admin.students.edit', compact('student'));
    }

    public function editStudent($id)
    {
        return $this->edit($id);
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->user_id,
            'matric_no' => 'required|unique:students,matric_no,' . $id,
            'department' => 'required|string',
            'level' => 'required|integer|min:100|max:400',
        ]);

        $student->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $student->update([
            'matric_no' => $request->matric_no,
            'department' => $request->department,
            'level' => $request->level,
        ]);

        return redirect('/admin/students')->with('success', 'Student updated successfully.');
    }

    public function updateStudent(Request $request, $id)
    {
        return $this->update($request, $id);
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->user->delete();
        $student->delete();

        return redirect('/admin/students')->with('success', 'Student deleted successfully.');
    }

    // Lecturers CRUD
    public function lecturers()
    {
        $lecturers = User::where('role', 'lecturer')->get();
        return view('admin.lecturers.index', compact('lecturers'));
    }

    public function createLecturer()
    {
        return view('admin.lecturers.create');
    }

    public function storeLecturer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'lecturer',
        ]);

        return redirect('/admin/lecturers')->with('success', 'Lecturer created successfully.');
    }

    public function deleteLecturer($id)
    {
        $lecturer = User::findOrFail($id);
        $lecturer->delete();

        return redirect('/admin/lecturers')->with('success', 'Lecturer deleted successfully.');
    }

    // Courses CRUD
    public function courses()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    public function show($id)
    {
        // Not used but required for resource controller
        return redirect()->route('admin.students.index');
    }

    public function createCourse()
    {
        return view('admin.courses.create');
    }

    public function createCourses()
    {
        return view('admin.courses.create');
    }

    public function storeCourses(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:courses',
            'title' => 'required|string',
            'unit' => 'required|integer|min:1',
            'semester' => 'required|string',
            'level' => 'required|integer|min:100|max:400',
        ]);

        Course::create($request->all());

        return redirect('/admin/courses')->with('success', 'Course created successfully.');
    }

    public function storeCourse(Request $request)
    {
        return $this->storeCourses($request);
    }

    public function editCourses($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.courses.edit', compact('course'));
    }

    public function editCourse($id)
    {
        return $this->editCourses($id);
    }

    public function updateCourses(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $request->validate([
            'code' => 'required|unique:courses,code,' . $id,
            'title' => 'required|string',
            'unit' => 'required|integer|min:1',
            'semester' => 'required|string',
            'level' => 'required|integer|min:100|max:400',
        ]);

        $course->update($request->all());

        return redirect('/admin/courses')->with('success', 'Course updated successfully.');
    }

    public function updateCourse(Request $request, $id)
    {
        return $this->updateCourses($request, $id);
    }

    public function deleteCourse($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect('/admin/courses')->with('success', 'Course deleted successfully.');
    }

    // Approve Registrations
    public function registrations()
    {
        $registrations = Registration::with('student.user', 'course')->orderBy('created_at', 'desc')->get();
        return view('admin.registrations.index', compact('registrations'));
    }

    public function approveRegistration($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->update(['status' => 'approved']);

        return back()->with('success', 'Registration approved.');
    }

    public function rejectRegistration($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();

        return back()->with('success', 'Registration rejected.');
    }

    // Assign Courses to Lecturers
    public function assignCourses()
    {
        $lecturers = User::where('role', 'lecturer')->get();
        $courses = Course::all();
        $assignments = LecturerCourse::with('user', 'course')->get();

        return view('admin.assign_courses', compact('lecturers', 'courses', 'assignments'));
    }

    public function storeAssignment(Request $request)
    {
        $request->validate([
            'lecturer_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        LecturerCourse::firstOrCreate([
            'lecturer_id' => $request->lecturer_id,
            'course_id' => $request->course_id,
        ]);

        return back()->with('success', 'Course assigned to lecturer.');
    }

    public function removeAssignment($id)
    {
        $assignment = LecturerCourse::findOrFail($id);
        $assignment->delete();

        return back()->with('success', 'Assignment removed.');
    }

    // View All Results
    public function results()
    {
        $grades = \App\Models\Grade::with('student.user', 'course')->get();
        return view('admin.results', compact('grades'));
    }
}
