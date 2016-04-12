@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('rides.partials.filter')
        </div>
        <div class="col-md-9">
            <div class="row">
                @foreach($rides as $ride)
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <a href="{{ url('/rides/' . $ride->id) }}">{{ $ride->title }}</a>
                            </div>
                            <div class="panel-body">
                                <p>{{ $ride->departure_city }} -> {{ $ride->arrival_city }}</p>
                                <p>Posted {{ $ride->created_at->toFormattedDateString() }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    {!! $rides->links() !!}
                </div>
            </div>
        </div>
    </div>
@stop