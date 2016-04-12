<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    protected $fillable = ["passenger_id", "ride_id"];

    public function ride()
    {
        return $this->belongsTo('App\Ride');
    }

    public function passenger()
    {
        return $this->belongsTo('App\User', 'passenger_id');
    }
}
