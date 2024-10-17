<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class EventRegistration extends Model
{
    use HasFactory;
    use UUID;

    protected $fillable = [
        'name',
        'email',
        'phoneno',
        'message',
        'event_id',
        'type'
    ];

    public function event(){
        return $this->belongsTo(Event::class);
    }
}
