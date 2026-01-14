<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Location;
use App\Models\Organization;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Показва списък с всички курсове + Търсачка
     */
    public function index(Request $request)
    {
        // 1. Започваме заявката
        // Използваме 'with', за да заредим свързаните данни предварително (Eager Loading)
        // Това прави сайта много по-бърз, защото прави 1 заявка вместо 50.
        $query = Course::with(['lecturer', 'organization', 'location']);

        // 2. Филтриране (Търсене) според условието

        // А) Търсене по Име на курс
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // Б) Търсене по Дата на провеждане
        if ($request->filled('start_date')) {
            $query->whereDate('start_date', $request->start_date);
        }

        // В) Търсене по Преподавател (ID от падащо меню)
        if ($request->filled('lecturer_id')) {
            $query->where('lecturer_id', $request->lecturer_id);
        }

        // Г) Търсене по Организация (ID от падащо меню)
        if ($request->filled('organization_id')) {
            $query->where('organization_id', $request->organization_id);
        }

        // 3. Сортиране (по най-новите) и Пагинация (по 10 на страница)
        $courses = $query->orderBy('start_date', 'desc')->paginate(10)->withQueryString();

        // 4. Трябват ни списъци за падащите менюта във филтъра
        $lecturers = Lecturer::all();
        $organizations = Organization::all();

        return view('admin.courses.index', compact('courses', 'lecturers', 'organizations'));
    }

    /**
     * Показва формата за създаване на нов курс
     */
    public function create()
    {
        // Трябва да подадем данните за падащите менюта (select options)
        $lecturers = Lecturer::all();
        $organizations = Organization::all();
        $locations = Location::all();

        return view('admin.courses.create', compact('lecturers', 'organizations', 'locations'));
    }

    /**
     * Записва новия курс в базата
     */
    public function store(Request $request)
    {
        // Валидация на данните
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'duration_hours' => 'required|integer|min:1',
            'lecturer_id' => 'required|exists:lecturers,id',
            'organization_id' => 'required|exists:organizations,id',
            'location_id' => 'required|exists:locations,id',
            'description' => 'nullable|string',
        ]);

        // Създаване
        Course::create($request->all());

        return redirect()->route('admin.courses.index')
            ->with('success', 'Курсът е добавен успешно!');
    }

    /**
     * Показва формата за редакция
     */
    public function edit(Course $course)
    {
        // Отново ни трябват списъците за падащите менюта
        $lecturers = Lecturer::all();
        $organizations = Organization::all();
        $locations = Location::all();

        return view('admin.courses.edit', compact('course', 'lecturers', 'organizations', 'locations'));
    }

    /**
     * Обновява курса в базата
     */
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

    /**
     * Изтрива курс
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Курсът е изтрит!');
    }
}