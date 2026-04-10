<?php

namespace App\Models;

use Database\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\CustomerPasswordResetNotification;

class Customer extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected static function newFactory(): CustomerFactory
    {
        return CustomerFactory::new();
    }

    protected $guard = 'customer';

    protected $fillable = [
        'user_code', 'user_name', 'user_email', 'password', 'user_mobile', 'user_gender', 'user_address',
    ];

    protected $hidden = [
        'password',
    ];

    public function getEmailForPasswordReset(): string
    {
        return $this->user_email;
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new CustomerPasswordResetNotification($token));
    }
}