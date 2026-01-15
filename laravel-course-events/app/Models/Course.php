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
        'lecturer_id',     
        'organization_id', 
        'location_id',     
    ];

    protected $casts = [
        'start_date' => 'date',
    ];

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}