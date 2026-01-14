<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'description',
    ];

    // Връзка: Една организация може да организира много курсове
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}