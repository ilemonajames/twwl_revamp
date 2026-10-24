<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use UUID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'surname',
        'othernames',
        'phoneno',
        'user_type',
        'status',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'enrolment_required' => 'boolean',
        'enrolment_selected_at' => 'datetime',
        'password_setup_required' => 'boolean',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function preferredService() { return $this->belongsTo(Service::class, 'preferred_service_id'); }
    public function preferredProgram() { return $this->belongsTo(Program::class, 'preferred_program_id'); }

    public function sendPasswordResetNotification($token): void
    {
        if ($this->password_setup_required) {
            $this->notify(new \App\Notifications\SetUpPassword($token));
            return;
        }
        $this->notify(new \Illuminate\Auth\Notifications\ResetPassword($token));
    }
}
