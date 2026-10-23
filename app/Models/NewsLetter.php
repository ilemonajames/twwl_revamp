<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    use HasFactory;
    use UUID;

    protected $fillable = [
        'title',
        'image',
        'description',
        'file',
        'user_id',
    ];
}
