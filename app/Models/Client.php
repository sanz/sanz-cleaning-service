<?php

namespace App\Models;

use Database\Factories\ClientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ClientPasswordResetNotification;

class Client extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected static function newFactory(): ClientFactory
    {
        return ClientFactory::new();
    }

    protected $guard = 'client';

    protected $fillable = [
        'client_code', 'client_name', 'client_email', 'password', 'client_mobile', 'client_gender', 'client_address',
    ];

    protected $hidden = [
        'password',
    ];

    public function getEmailForPasswordReset(): string
    {
        return $this->client_email;
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ClientPasswordResetNotification($token));
    }
}