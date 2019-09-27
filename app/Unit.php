<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'franchise_id',
        'motor_number',
        'chassis_number',
        'year_confirmed',
        'make',
        'plate_number',
        'remarks',
        'id',
    ];

}
