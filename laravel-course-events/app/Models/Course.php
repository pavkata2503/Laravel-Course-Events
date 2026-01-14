<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'start_date',
        'duration_hours',
        'description',
        'lecturer_id',     // Външен ключ
        'organization_id', // Външен ключ
        'location_id',     // Външен ключ
    ];

    // Casting: казваме на Laravel, че това поле е дата, за да работим по-лесно с него
    protected $casts = [
        'start_date' => 'date',
    ];

    // Връзка: Курсът принадлежи на един Преподавател
    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    // Връзка: Курсът принадлежи на една Организация
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    // Връзка: Курсът се провежда на едно Място
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}