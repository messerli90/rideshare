@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>{{ $user->name }} <small>Update your profile</small></h2>

            <hr>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <h4>Errors:</h4>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ action('UsersController@update') }}" method="post">
                {{ csrf_field() }}
                {{ method_field('put') }}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="home_city">Home City</label>
                            <input type="text" name="home_city" id="home_city" class="form-control"
                                   placeholder="Denver" value="{{ $user->home_city }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="home_state">Home State</label>
                            <select name="home_state" id="home_state" class="form-control">
                                <option value="">Select One</option>
                                @foreach(App\State::orderBy('name', 'asc')->get() as $state)
                                    <option value="{{ $state->id }}"
                                            {{ $user->home_state == $state->id ? 'selected' : '' }}>
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="tel" class="form-control" name="phone_number" id="phone_number"
                                   value="{{ $user->phone_number }}" placeholder="201-867-5309">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Update Profile!">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop