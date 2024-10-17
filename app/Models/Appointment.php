<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable  =[
        'service_id',
        'program_id',
        'appointment_date',
        'appointment_time',
        'user_id',
        'status',
    ];

    protected $casts = [
        'appointment_date' => 'date',
    ];

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function program(){
        return $this->belongsTo(Program::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
