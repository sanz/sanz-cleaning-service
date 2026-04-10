<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'order_id';

    protected $fillable = [
        'order_code', 'client_id', 'user_id', 'service_id', 'item_ids',
        'booking_date', 'address', 'time_slot', 'amount',
    ];
}