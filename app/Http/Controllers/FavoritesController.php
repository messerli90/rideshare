<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Ride;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('users.favorites', ['user' => $user]);
    }

    public function addRide(Ride $ride)
    {
        $user = Auth::user();

        // Check if Favorite already exists
        $existing_favorite_count = $user->favorites()->where('ride_id', $ride->id)->count();

        if ($existing_favorite_count) {
            return back()->with(['fail'=> 'blahblah']); // TODO: add fail message
        }

        $favorite = new Favorite();

        $favorite->user_id = $user->id;
        $favorite->ride_id = $ride->id;
        $favorite->save();

        return back()->with(['success'=> 'blahblah']); // TODO: add success message
    }
}
