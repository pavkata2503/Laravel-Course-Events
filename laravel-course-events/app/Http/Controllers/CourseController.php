<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Location;
use App\Models\Organization;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::with(['lecturer', 'organization', 'location']);

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('start_date')) {
            $query->whereDate('start_date', $request->start_date);
        }

        if ($request->filled('lecturer_id')) {
            $query->where('lecturer_id', $request->lecturer_id);
        }

        if ($request->filled('organization_id')) {
            $query->where('organization_id', $request->organization_id);
        }

        $courses = $query->orderBy('start_date', 'desc')->paginate(10)->withQueryString();

        $lecturers = Lecturer::all();
        $organizations = Organization::all();

        return view('admin.courses.index', compact('courses', 'lecturers', 'organizations'));
    }

    public function create()
    {
        $lecturers = Lecturer::all();
        $organizations = Organization::all();
        $locations = Location::all();

        return view('admin.courses.create', compact('lecturers', 'organizations', 'locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'duration_hours' => 'required|integer|min:1',
            'lecturer_id' => 'required|exists:lecturers,id',
            'organization_id' => 'required|exists:organizations,id',
            'location_id' => 'required|exists:locations,id',
            'description' => 'nullable|string',
        ]);

        Course::create($request->all());

        return redirect()->route('admin.courses.index')
            ->with('success', 'Курсът е добавен успешно!');
    }

    public function edit(Course $course)
    {
        
        $lecturers = Lecturer::all();
        $organizations = Organization::all();
        $locations = Location::all();

        return view('admin.courses.edit', compact('course', 'lecturers', 'organizations', 'locations'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'duration_hours' => 'required|integer|min:1',
            'lecturer_id' => 'required|exists:lecturers,id',
            'organization_id' => 'required|exists:organizations,id',
            'location_id' => 'required|exists:locations,id',
            'description' => 'nullable|string',
        ]);

        $course->update($request->all());

        return redirect()->route('admin.courses.index')
            ->with('success', 'Курсът е обновен успешно!');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Курсът е изтрит!');
    }
}