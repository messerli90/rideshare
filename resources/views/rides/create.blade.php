@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-sm-12 col-md-offset-2">
            <h2>Create a Ride</h2>

            <hr>

            <form action="{{ url('/rides') }}" class="form" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label class="control-label" for="title">Title</label>
                            <input type="text" name="title" id="title" placeholder="Some catchy title"
                                   class="form-control" value="{{ old('title') }}">
                            <span class="help-block">{{ $errors->first('title', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('departure_city') ? ' has-error' : '' }}">
                            <label class="control-label" for="departure_city">Departure City</label>
                            <input type="text" class="form-control" name="departure_city" id="departure_city"
                                   placeholder="Denver" value="{{ old('departure_city', $user->home_city) }}">
                            <span class="help-block">{{ $errors->first('departure_city', ':message') }}</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('departure_state') ? ' has-error' : '' }}">
                            <label class="control-label" for="departure_state">Departure State</label>
                            <select class="form-control" name="departure_state" id="departure_state">
                                <option value="">Select One</option>
                                @foreach(App\State::all() as $state)
                                <option value="{{ $state->id }}"
                                        {{ $user->home_state ==  $state->id ? 'selected' : ''}}>
                                    {{ $state->name }}
                                </option>
                                @endforeach
                            </select>
                            <span class="help-block">{{ $errors->first('departure_state', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('departure_date') ? ' has-error' : '' }}">
                            <label class="control-label" for="departure_date">Departure Date</label>
                            <input type="date" name="departure_date" id="departure_date" class="form-control"
                                   value="{{ old('departure_date', \Carbon\Carbon::now()->toDateString()) }}">
                            <span class="help-block">{{ $errors->first('departure_date', ':message') }}</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('departure_time') ? ' has-error' : '' }}">
                            <label class="control-label" for="departure_time">Departure Time</label>
                            <input type="time" name="departure_time" id="departure_time" class="form-control"
                                   value="{{ old('departure_time') }}">
                            <span class="help-block">{{ $errors->first('departure_time', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('arrival_city') ? ' has-error' : '' }}">
                            <label class="control-label" for="arrival_city">Arrival City</label>
                            <input type="text" class="form-control" name="arrival_city" id="arrival_city"
                                   placeholder="Vail" value="{{ old('arrival_city') }}">
                            <span class="help-block">{{ $errors->first('arrival_city', ':message') }}</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('arrival_state') ? ' has-error' : '' }}">
                            <label class="control-label" for="arrival_state">Arrival State</label>
                            <select name="arrival_state" id="arrival_state" class="form-control">
                                <option value="">Select One</option>
                                @foreach(App\State::all() as $state)
                                    <option value="{{ $state->id }}"
                                            {{ $user->home_state ==  $state->id ? 'selected' : ''}}>
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="help-block">{{ $errors->first('arrival_state', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('seats_available') ? ' has-error' : '' }}">
                            <label class="control-label" for="seats_available">Seats Available</label>
                            <select name="seats_available" id="seats_available" class="form-control">
                                @for($i = 1; $i <= 7; $i++)
                                    <option value="{{ $i }}" {{ old('seats_available') == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            <span class="help-block">{{ $errors->first('seats_available', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group {{ $errors->has('message') ? ' has-error' : '' }}">
                            <label class="control-label" for="message">Message to your Passengers</label>
                            <textarea name="message" id="message" cols="30" rows="10"
                                      class="form-control"
                                      placeholder="Pet friendly? What do you expect in return for this ride? Gas Money, Lunch, Cash?"
                            >{{ old('message') }}</textarea>
                            <span class="help-block">{{ $errors->first('message', ':message') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Create Ride!">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop