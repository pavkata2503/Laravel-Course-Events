<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LecturerController extends Controller
{
    // Показва списък с преподаватели
    public function index()
    {
        $lecturers = Lecturer::all();
        return view('admin.lecturers.index', compact('lecturers'));
    }

    // Форма за добавяне
    public function create()
    {
        return view('admin.lecturers.create');
    }

    // Запазване (с качване на снимка)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'photo' => 'nullable|image|max:2048', // Макс 2MB, само картинки
        ]);

        $data = $request->only(['name', 'email', 'phone']);

        // Логика за качване на файл
        if ($request->hasFile('photo')) {
            // Запазваме файла в папка "lecturers" в "public" диска
            $path = $request->file('photo')->store('lecturers', 'public');
            $data['photo_path'] = $path;
        }

        Lecturer::create($data);

        return redirect()->route('admin.lecturers.index')->with('success', 'Преподавателят е добавен!');
    }

    // Форма за редакция
    public function edit(Lecturer $lecturer)
    {
        return view('admin.lecturers.edit', compact('lecturer'));
    }

    // Обновяване (със смяна на снимка)
    public function update(Request $request, Lecturer $lecturer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'phone']);

        if ($request->hasFile('photo')) {
            // 1. Изтриваме старата снимка, ако има такава
            if ($lecturer->photo_path) {
                Storage::disk('public')->delete($lecturer->photo_path);
            }
            
            // 2. Качваме новата
            $path = $request->file('photo')->store('lecturers', 'public');
            $data['photo_path'] = $path;
        }

        $lecturer->update($data);

        return redirect()->route('admin.lecturers.index')->with('success', 'Данните са обновени!');
    }

    // Изтриване
    public function destroy(Lecturer $lecturer)
    {
        // Изтриваме и снимката от диска, за да не пълним сървъра с боклук
        if ($lecturer->photo_path) {
            Storage::disk('public')->delete($lecturer->photo_path);
        }

        $lecturer->delete();
        return redirect()->route('admin.lecturers.index')->with('success', 'Преподавателят е изтрит!');
    }
}