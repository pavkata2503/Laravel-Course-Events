<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LecturerController extends Controller
{
    public function index()
    {
        $lecturers = Lecturer::all();
        return view('admin.lecturers.index', compact('lecturers'));
    }

    public function create()
    {
        return view('admin.lecturers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'photo' => 'nullable|image|max:2048', 
        ]);

        $data = $request->only(['name', 'email', 'phone']);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('lecturers', 'public');
            $data['photo_path'] = $path;
        }

        Lecturer::create($data);

        return redirect()->route('admin.lecturers.index')->with('success', 'Преподавателят е добавен!');
    }

    public function edit(Lecturer $lecturer)
    {
        return view('admin.lecturers.edit', compact('lecturer'));
    }

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
            if ($lecturer->photo_path) {
                Storage::disk('public')->delete($lecturer->photo_path);
            }
            
            $path = $request->file('photo')->store('lecturers', 'public');
            $data['photo_path'] = $path;
        }

        $lecturer->update($data);

        return redirect()->route('admin.lecturers.index')->with('success', 'Данните са обновени!');
    }

    public function destroy(Lecturer $lecturer)
    {
        if ($lecturer->photo_path) {
            Storage::disk('public')->delete($lecturer->photo_path);
        }

        $lecturer->delete();
        return redirect()->route('admin.lecturers.index')->with('success', 'Преподавателят е изтрит!');
    }
}