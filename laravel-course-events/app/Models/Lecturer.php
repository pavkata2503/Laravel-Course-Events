<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'photo_path', // Пътят към снимката в storage папката
    ];

    // Връзка: Един преподавател може да води много курсове
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}