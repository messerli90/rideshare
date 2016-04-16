<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'home_city', 'home_state', 'phone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Rides that the user is the driver of
     *
     * @return Collection
     */
    public function ridesAsDriver()
    {
        return $this->hasMany('App\Ride', 'driver_id');
    }

    /**
     * Rides that the user is a passanger of
     *
     */
    public function ridesAsPassenger()
    {
        return $this->hasMany('App\Passenger', 'passenger_id', 'id');
    }

    /**
     * Check profile completion
     *
     * @return Bool
     */
    public function profileComplete()
    {
        return ($this->home_city && $this->home_state && $this->phone_number);
    }

    /**
     * Get Comments authored by User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function authoredComments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get Favorites
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function favorites()
    {
        return $this->morphMany('App\Favorite', 'favoritable');
    }
}
