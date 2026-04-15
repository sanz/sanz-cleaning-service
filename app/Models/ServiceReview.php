<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceReview extends Model
{
    use HasFactory;

    protected $primaryKey = 'ro_id';

    protected $fillable = [
        'service_id', 'user_id', 'response_rating', 'service_rating',
        'communication_rating', 'price_rating', 'title', 'feedback', 'image',
    ];
}
