<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\UUID;

class Event extends Model
{
    use HasFactory;
    use UUID;

    protected $fillable = [
        'event_title',
        'short_id',
        'id',
        'description',
        'image',
        'thumbnail',
        'event_date',
        'event_time',
        'type_of_event',
        'event_location',
        'event_link',
        'user_id'
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'event_time' => 'datetime'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
