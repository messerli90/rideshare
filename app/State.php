<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    /**
     * Do not require timestamps on states table
     *
     * @var bool
     */
    public $timestamps = false;

    public function departingRides()
    {
        return $this->hasMany('App\Ride', 'departure_state', 'id');
    }

    public function arrivingRides()
    {
        return $this->hasMany('App\Ride', 'arrival_state', 'id');
    }
}
