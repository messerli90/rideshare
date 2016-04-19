<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Passenger;
use App\Ride;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rides = Ride::with('driver')
            ->where(function($query) use ($request){
                if ($request->get('departure_city'))
                {
                    $query->where('departure_city', 'like', '%'.$request->get('departure_city').'%');
                }
            })
            ->where(function($query) use ($request){
                if ($request->get('departure_state'))
                {
                    $query->where('departure_state', $request->get('departure_state'));
                }
            })
            ->where(function($query) use ($request){
                if ($request->get('arrival_city'))
                {
                    $query->where('arrival_city', 'like', '%'.$request->get('arrival_city').'%');
                }
            })
            ->where(function($query) use ($request){
                if ($request->get('arrival_state'))
                {
                    $query->where('arrival_state', $request->get('arrival_state'));
                }
            })
            ->where(function($query) use ($request) {
                if ($request->get('seats_available')) {
                    $query->where('seats_available', '>=',$request->get('seats_available'));
                }
            })
            ->where(function($query) use ($request) {
                if ($request->get('departure_date')) {
                    $query->where('departure_date', $request->get('departure_date'));
                }
            })
            ->where('departure_date', '>', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('rides.index')->withRides($rides)->with(['success'=> 'blahblah']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('rides.create')->withUser($user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Requests\StoreRideRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StoreRideRequest $request)
    {
        // TODO: Check Limit to see if creating another ride is allowed

        // Validate
        $this->validate($request, [
            'title'             => 'required',
            'seats_available'   => 'required|numeric',
            'departure_city'    => 'required|alpha',
            'departure_state'   => 'required',
            'departure_date'    => 'required|date',
            'departure_time'    => 'required',
            'arrival_city'      => 'required|alpha',
            'arrival_state'     => 'required',
            'message'           => 'required'
        ]);

        // Get Auth User
        $user = Auth::user();

        // Create Ride
        $ride = new Ride([
            'title'             => $request->get('title'),
            'seats_available'   => $request->get('seats_available'),
            'departure_city'    => $request->get('departure_city'),
            'departure_state'   => $request->get('departure_state'),
            'departure_time'    => $request->get('departure_time'),
            'departure_date'    => $request->get('departure_date'),
            'arrival_city'      => $request->get('arrival_city'),
            'arrival_state'     => $request->get('arrival_state'),
            'message'           => $request->get('message')
        ]);

        $user->ridesAsDriver()->save($ride);

        return redirect()->action('RidesController@show', ['ride' => $ride]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Ride  $ride
     * @return \Illuminate\Http\Response
     */
    public function show(Ride $ride)
    {
        return response()->view('rides.show', ['ride' => $ride]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Ride $ride
     * @return \Illuminate\Http\Response
     */
    public function edit(Ride $ride)
    {
        // TODO: Authenticate user

        $driver = $ride->driver;

        return response()->view('rides.edit', ['ride' => $ride]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Ride $ride
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ride $ride)
    {
        // TODO: Authenticate user

        // Validate
        $this->validate($request, [
            'title'             => 'required',
            'seats_available'   => 'required|numeric',
            'departure_city'    => 'required|alpha',
            'departure_state'   => 'required',
            'departure_date'    => 'required|date',
            'departure_time'    => 'required',
            'arrival_city'      => 'required|alpha',
            'arrival_state'     => 'required',
            'message'           => 'required'
        ]);

        // Update Ride
        $ride->update([
            'title'             => $request->get('title'),
            'seats_available'   => $request->get('seats_available'),
            'departure_city'    => $request->get('departure_city'),
            'departure_state'   => $request->get('departure_state'),
            'departure_date'    => $request->get('departure_date'),
            'departure_time'    => $request->get('departure_time'),
            'arrival_city'      => $request->get('arrival_city'),
            'arrival_state'     => $request->get('arrival_state'),
            'message'           => $request->get('message')
        ]);

        return redirect()->action('RidesController@show', ['ride' => $ride]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Ride $ride
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ride $ride)
    {
        // TODO: Authenticate user

        // Remove resource
        $ride->delete();

        return redirect()->action('RidesController@index');
    }

    /**
     * Add Comment to Ride
     *
     * @param Ride $ride
     * @param Request $request
     * @return mixed
     */
    public function comment(Ride $ride, Request $request)
    {
        // Validate
        $this->validate($request, [
            'message'           => 'required'
        ]);

        // Create comment
        Comment::create([
            'commentable_id'    => $ride->id,
            'commentable_type'  => 'App\Ride',
            'message'           => $request->get('message'),
            'user_id'           => Auth::user()->id
        ]);

        return back();
    }

    public function addPassenger(Ride $ride)
    {
        $user = Auth::user();

        // TODO: Make request first

        // TODO:  Do not allow driver to reserve spot -> return with error message
        if ($user->id == $ride->driver->id)
            return back();

        // TODO: Do not allow passenger to reserve two spots -> return error message
        if (count($ride->passengers()->where('passenger_id', $user->id)->get()))
            return back();

        // TODO: Check availability


        // Create Passenger
        Passenger::create([
            'passenger_id'  => $user->id,
            'ride_id'       => $ride->id
        ]);

        return back();
    }
}
