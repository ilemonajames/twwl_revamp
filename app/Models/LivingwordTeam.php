<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class LivingwordTeam extends Model
{
    use HasFactory;
    use UUID;

    protected $fillable = [
        'full_name',
        'role',
        'about',
        'email',
        'phoneno',
        'image',
        'facebook',
        'instagram',
        'likedin',
        'user_id',
    ];
}
