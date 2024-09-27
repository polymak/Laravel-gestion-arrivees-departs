<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'arrival_time',
        'departure_time',
        'date',
    ];

    // Indique à Laravel que ces attributs doivent être traités comme des dates
    protected $dates = [
        'date',
    ];

    protected $casts = [
        'arrival_time' => 'datetime:H:i',
        'departure_time' => 'datetime:H:i',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
