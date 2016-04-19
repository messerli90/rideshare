@extends('layouts.app')

@section('content')
    @include('rides.partials.filter')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                @foreach($rides as $ride)
                    <div class="col-md-4">
                        @include('rides.partials.card')
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
    <script>
        $('[data-action="go-to"]').click(function(){
            var id = $(this).attr('data-id');
            window.location = "http://rideshare.dev/rides/" + id;
        });
    </script>
@stop