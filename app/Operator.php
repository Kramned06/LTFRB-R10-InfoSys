<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    protected $fillable = [
        'firstname',
        'middlename',
        'surname',
        'street',
        'city',
        'barangay',
        'state',
        'country',
        'post_code',
        'email',
        'contact_number',
        'contact_number_two',
        'remarks',
        'id'
    ];

}
