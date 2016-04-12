@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>{{ $ride->title }}</h2>
            <p>{{ $ride->departure_city }} -> {{ $ride->arrival_city }}</p>
            @if(Auth::check() && $ride->driver_id == Auth::user()->id)
                <p><a href="{{ url('/rides/'.$ride->id.'/edit') }}">Edit</a></p>
                <p><a href="{{ url('/rides/'.$ride->id.'/delete') }}">Delete</a></p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h3>Comments</h3>
            <hr>
            @if(!count($ride->comments))
                <p>No comments, yet</p>
            @endif
            @foreach($ride->comments as $comment)
                <div class="media">
                    <div class="media-left">
                        <img src="http://placehold.it/64x64" alt="avatar" class="media-object">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{ $comment->author->name }}</h4>
                        <p>{{ $comment->message }}</p>
                    </div>
                </div>
            @endforeach
            <hr>
            <form action="{{ url('/rides/'.$ride->id.'/comment') }}" method="post" class="form">
                {{ csrf_field() }}
                <input type="hidden" name="ride_id" value="{{ $ride->id }}">
                <div class="form-group">
                    <textarea name="message" id="message" cols="30" rows="6" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Send">
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <h3>Passengers <a href="/rides/{{ $ride->id }}/add-passenger" class="btn btn-primary pull-right">Reserve Spot</a></h3>

            <hr>
            @if(!count($ride->passengers))
                <p>No passengers, yet</p>
            @endif
            @foreach($ride->passengers as $passenger)
                <div class="media">
                    <img src="http://placehold.it/64x64" alt="avatar" class="media-object">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">{{ $passenger->passenger->name }}</h4>
                </div>
            @endforeach
        </div>
    </div>
@stop