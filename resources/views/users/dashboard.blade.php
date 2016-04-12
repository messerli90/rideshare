@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <h1>{{ $user->name }}</h1>
    </div>

    {{-- If user doesn't have a complete profile show message--}}
    @if(!$user->profileComplete())
        <div class="alert alert-warning">
            <h4>Your profile is not ready to start making posts</h4>
            <p><a href="{{ url('/dashboard/edit') }}">Update your Profile</a></p>
        </div>
    @else
        <p><a href="{{ url('/dashboard/edit') }}">Update your Profile</a></p>
    @endif

    <div class="row">
        <div class="col-md-6">
            <h4>Driving</h4>
            @foreach($user->ridesAsDriver as $ride)
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="/rides/{{ $ride->id }}">{{ $ride->title }}</a>
                    </li>
                </ul>
            @endforeach
        </div>
        <div class="col-md-6">
            <h4>Passenger</h4>
            @foreach($user->ridesAsPassenger as $passenger)
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="/rides/{{ $passenger->ride->id }}">{{ $passenger->ride->title }}</a>
                    </li>
                </ul>
            @endforeach
        </div>
    </div>
@stop