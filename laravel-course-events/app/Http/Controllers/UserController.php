<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Показва списък с всички потребители
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Показва формата за нов потребител
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Записва новия потребител в базата
     */
    public function store(Request $request)
    {
        // 1. Валидация
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Създаване
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Криптиране на паролата
            'is_admin' => $request->has('is_admin'),     // Ако чекбоксът е отметнат -> true (1)
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Потребителят е добавен успешно!');
    }

    /**
     * Изтрива потребител
     */
    public function destroy(User $user)
    {
        // Предпазна мярка: Не позволявай да изтриеш себе си, докато си логнат!
        if (auth()->id() == $user->id) {
            return back()->with('error', 'Не може да изтриете собствения си акаунт!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Потребителят е изтрит.');
    }
}