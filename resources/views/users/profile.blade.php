@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3">
            sidebar
        </div>
        <div class="col-md-9">
            <h2>{{ $user->name }}</h2>
        </div>
    </div>
@stop