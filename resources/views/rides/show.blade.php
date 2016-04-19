@extends('layouts.app')

@section('content')
    <div class="row" id="show-ride">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-body">
                    <img src="{{ $ride->driver->avatar }}" alt="" class="" style="width: 100%;">
                </div>
                <div class="panel-footer">
                    <h3 style="margin-top: 10px; text-align: center;">{{ $ride->driver->name }}</h3>
                </div>
            </div>


            <div class="links">
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{ url('/rides/'.$ride->id.'/add-passenger') }}">
                            <i class="fa fa-heart fa-fw"></i> Add to Favorites</a>
                    </li>
                    <li class="list-group-item"><a href="{{ url('/rides/'.$ride->id.'/add-passenger') }}">
                            <i class="fa fa-check fa-fw"></i> Request Spot</a>
                    </li>
                </ul>

                @if(Auth::check() && $ride->driver_id == Auth::user()->id)
                <h4 class="meta-title">Settings</h4>
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{ url('/rides/'.$ride->id.'/edit') }}"><i class="fa fa-fw fa-pencil-square-o"></i> Edit</a></li>
                    <li class="list-group-item"><a href="{{ url('/rides/'.$ride->id.'/delete') }}"><i class="fa fa-fw fa-trash-o"></i> Delete</a></li>
                </ul>
                @endif
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-9">
                    <h2>{{ $ride->title }}</h2>
                    <p>Ride from <strong>{{ $ride->departure_city }}, {{ $ride->departureState->code }}</strong> to
                        <strong>{{ $ride->arrival_city }}, {{ $ride->arrivalState->code }}</strong></p>
                    <p>{{ $ride->message }}</p>

                    <hr>

                    <h4>Comments</h4>
                    @if(!count($ride->comments))
                        <p>No comments, yet</p>
                    @endif
                    @foreach($ride->comments as $comment)
                        <div class="media">
                            <div class="media-left">
                                <img src="http://placehold.it/64x64" alt="avatar" class="media-object">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="{{ url('/users/'.$comment->author->id) }}">{{ $comment->author->name }}</a></h4>
                                <p>{{ $comment->message }}</p>
                            </div>
                        </div>
                    @endforeach

                    <form action="{{ url('/rides/'.$ride->id.'/comment') }}" method="post" class="form">
                        {{ csrf_field() }}
                        <input type="hidden" name="ride_id" value="{{ $ride->id }}">
                        <div class="form-group">
                            <textarea name="message" id="message" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Send">
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                    <h4>Passengers</h4>
                    @if(!count($ride->passengers))
                        <p>No passengers, yet</p>
                    @endif
                    @foreach($ride->passengers as $passenger)
                        <div class="media">
                            <img src="http://placehold.it/64x64" alt="avatar" class="media-object">
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><a href="{{ url('/users/'.$passenger->passenger->id) }}">{{ $passenger->passenger->name }}</a></h4>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <hr>

@stop

@section('scripts')
    <!-- Vue.js JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.10/vue.min.js"></script>

    <script>
        new Vue({
            el: '#show-ride',

            data: {
                rideId: '{{ $ride->id }}'
            },

            ready: function() {
                this.$http.get('/api/v1/rides/{{$ride->id}}/is-passenger', function(data) {
                    console.dir(data);
                })
            }
        })
    </script>
@stop