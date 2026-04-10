<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $primaryKey = 'service_id';

    protected $fillable = [
        'client_id', 'service_catalog_id', 'name', 'experience',
        'description', 'phone', 'email', 'website', 'facebook',
        'twitter', 'linkedin', 'photo', 'document_number', 'document_image',
        'available_days', 'available_time', 'state', 'city', 'address',
        'pincode', 'item_ids',
    ];
}
