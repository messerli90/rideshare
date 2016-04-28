@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-2">
            <img src="{{ $user->avatar }}" alt="" class="img-thumbnail" style="width: 100%;">
        </div>
        <div class="col-md-7">
            <h1>{{ $user->name }}</h1>
        </div>
        <div class="col-md-3">
            <ul class="list-group">
                <li class="list-group-item"><a href="{{ url('/dashboard/edit') }}">Update your Profile</a></li>
            </ul>
        </div>
    </div>

    {{-- If user doesn't have a complete profile show message--}}
    @if(!$user->profileComplete())
        <div class="alert alert-warning">
            <h4>Your profile is not ready to start making posts</h4>
            <p><a href="{{ url('/dashboard/edit') }}">Update your Profile</a></p>
        </div>
    @endif

    <hr>
    <div class="row">
        <div class="col-md-6">
            <h4>Driving</h4>
            <ul class="list-group">
                @foreach($user->ridesAsDriver as $ride)
                    <div class="card card--small" data-action="go-to" data-id="{{ $ride->id }}">
                        @include('rides.partials.card')
                    </div>
                @endforeach
            </ul>
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