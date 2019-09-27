<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Franchise extends Model
{
    //
    protected $fillable = [
        'case_number',
        'operator_id',
        'business_address',
        'date_granted',
        'expiry_date',
        'deno',
        'authorize_units',
        'route_name',
        'remarks',
        'id',
    ];
}
