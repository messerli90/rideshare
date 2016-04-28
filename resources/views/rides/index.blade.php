@extends('layouts.app')

@section('content')
    @include('rides.partials.filter')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                @if(count($rides) == 0)
                    <div class="col-md-12">
                        <p class="text-center text-info">No rides found, try expanding your search.</p>
                    </div>

                @endif
                @foreach($rides as $ride)
                    <div class="col-md-4">
                        <div class="card card--big" data-action="go-to" data-id="{{ $ride->id }}">
                            @include('rides.partials.card')
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

@section('scripts')

@stop