<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class CountryState extends Model
{
    //
    protected $table = 'country_states';
    protected $fillable = ['code','name'];

    public function states(){
        $country_id = Input::get('id');

        return CountryState::where('country_id', $country_id)->get();
    }
}
