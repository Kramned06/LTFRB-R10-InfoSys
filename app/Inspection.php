<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    //
    protected $fillable = [
        'sticker_number',
        'tradename',
        'year_model',
        'case_number',
        'motor_number', //////
        'chassis_number', //////
        'plate_number', //////
        'operator_name',
        'remarks',
    ];
}
