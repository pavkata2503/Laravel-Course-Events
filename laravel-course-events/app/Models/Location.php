<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_name',
    ];

    // Връзка: Едно населено място може да има много проведени курсове там
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}