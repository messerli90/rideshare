<div class="panel panel-default">
    <div class="panel-body ride-filter">
        <form action="{{ url('/rides') }}" method="get">
            <div class="row">
                <div class="col-sm-4">
                    <h3>Where?</h3>

                    <label for="departure_city">Leaving From</label>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" name="departure_city" id="departure_city"
                                       placeholder="Denver"
                                       @if (Auth::guest())
                                       value="{{ Request::get('departure_city') }}"
                                       @else
                                       value="{{ Request::get('departure_city', Auth::user()->home_city) }}"
                                        @endif
                                >
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <select class="form-control" name="departure_state" id="departure_state">
                                    <option value=""> - - </option>
                                    @foreach(App\State::all() as $state)
                                        <option value="{{ $state->id }}"
                                        @if(Auth::guest())
                                            {{ Request::get('departure_state') ==  $state->id ? 'selected' : ''}}>
                                            @else
                                                {{ Request::get('departure_state', Auth::user()->home_state) ==  $state->id ? 'selected' : ''}}>
                                            @endif
                                            {{ $state->code }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <label for="arrival_city">Going to</label>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <input type="text" class="form-control" name="arrival_city" id="arrival_city"
                                       placeholder="Vail" value="{{ Request::get('arrival_city') }}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <select name="arrival_state" id="arrival_state" class="form-control">
                                    <option value=""> - - </option>
                                    @foreach(App\State::all() as $state)
                                        <option value="{{ $state->id }}"
                                                {{ Request::get('arrival_state') ==  $state->id ? 'selected' : ''}}>
                                            {{ $state->code }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <h3>When?</h3>
                    <div class="form-group">
                        <label for="departure_date">Leaving</label>
                        <input type="date" name="departure_date" class="form-control"
                               value="{{ Request::has('departure_date') ? Request::get('departure_date') : \Carbon\Carbon::now()->toDateString() }}">
                    </div>
                </div>
                <div class="col-sm-3">
                    <h3>Who?</h3>
                    <div class="form-group">
                        <label for="seats_available">Seats Needed</label>
                        <select name="seats_available" id="seats_available" class="form-control">
                            @for($i = 1; $i <= 7; $i++)
                                <option value="{{ $i }}" {{ Request::get('seats_available') == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary btn-block">Search Now</button>
                </div>
            </div>
        </form>
    </div>
</div>