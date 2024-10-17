<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Service extends Model
{
    use HasFactory;
    use UUID;

    protected $fillable = [
        'price',
        'service_icon',
        'service_image',
        'service_title',
        'service_description',
        'price'
    ];
}
