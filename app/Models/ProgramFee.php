<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'session_fees',
        'program_id',
        'service_id',
        'consultation_fees',
        'program_fees',
        'duration'
    ];


    public function program (){
        return $this->belongsTo(Program::class);
    }

    public function service (){
        return $this->belongsTo(Service::class);
    }
}
