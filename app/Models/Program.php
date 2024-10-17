<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Program extends Model
{
    use HasFactory;
    use UUID;

    protected $fillable = [
        'program_image',
        'program_title',
        'program_description',
        'price'
    ];

    public function fees(){
        return $this->hasMany(ProgramFee::class);
    }
}
