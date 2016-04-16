<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    protected $table = "rides";

    protected $fillable = ["title", "seats_available", "departure_city", "departure_state",
        "departure_time", "departure_date", "arrival_city", "arrival_state", "message"];

    public function driver()
    {
        return $this->belongsTo('App\User', 'driver_id');
    }

    public function arrivalState()
    {
        return $this->belongsTo('App\State', 'arrival_state');
    }

    public function departureState()
    {
        return $this->belongsTo('App\State', 'departure_state');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function passengers()
    {
        return $this->hasMany('App\Passenger', 'ride_id', 'id');
    }

    public function favorites()
    {
        return $this->morphMany('App\Favorite', 'favoritable');
    }
}
