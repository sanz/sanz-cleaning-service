<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCatalog extends Model
{
    use SoftDeletes;

    protected $table = 'service_catalogs';

    protected $fillable = ['service_name', 'service_category', 'service_description', 'service_image'];
}
