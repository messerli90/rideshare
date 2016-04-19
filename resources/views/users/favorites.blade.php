@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h2>Favorite Rides</h2>
            @foreach($user->favorites as $favorites)
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="/rides/{{ $favorites->ride->id }}">{{ $favorites->ride->title }}</a>
                    </li>
                </ul>
            @endforeach
        </div>
    </div>
@stop