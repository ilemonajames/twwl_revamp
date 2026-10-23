<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentAttempt extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    protected $casts = ['amount_minor' => 'integer'];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
