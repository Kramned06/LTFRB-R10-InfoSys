<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $fillable = [
        'franchise_id',
        'unit_id',
        'plate_picture',
        'remarks',
        'created_at',
        'id',
    ];

    public static function withFranchisesAndUnits()
    {
        return \DB::table('notifications')
            ->leftJoin('franchises', 'franchises.id', '=', 'notifications.franchise_id')
            ->leftJoin('units', 'units.id', '=', 'notifications.unit_id')
            ->select('franchises.id as fid', 'franchises.case_number', 'franchises.authorize_units', 'franchises.deno', 'franchises.route_name', 'franchises.expiry_date', 'franchises.date_granted', 'units.id as uid', 'units.plate_number', 'units.motor_number', 'units.chassis_number', 'units.make', 'notifications.id', 'notifications.remarks', 'notifications.created_at', 'notifications.plate_picture')
            ->orderBy('notifications.created_at', 'desc')
            // ->paginate(20);
            ->get();
    }
}
