@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2">
            <h4 class="modal-title">Update bar information</h4>
            <form class="form" method="POST" action="{{ action('BarsController@update', $bar->id) }}">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="text" class="form-control" name="name" id="name" value="{{ $bar->name }}" placeholder="Bar name">
                    @include('forms.error', ['field' => 'name'])
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="address" id="address" value="{{ $bar->address }}" placeholder="Bar address">
                    @include('forms.error', ['field' => 'address'])
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="phone" id="phone" value="{{ $bar->phone }}" placeholder="Phone number">
                    @include('forms.error', ['field' => 'phone'])
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="website" id="website" value= "{{ $bar->website }}" placeholder="Bar website">
                    @include('forms.error', ['field' => 'website'])
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="email" id="email" value="{{ $bar->email }}" placeholder="Bar email">
                    @include('forms.error', ['field' => 'email'])
                </div>
                {{--<select name="type" id="type">--}}
                    {{--<option value="">Bar type...</option>--}}
                    {{--<option value="pub">Pub</option>--}}
                    {{--<option value="dive">Dive</option>--}}
                    {{--<option value="club">Club</option>--}}
                    {{--<option value="sports">Sports</option>--}}
                    {{--<option value="karaoke">Karaoke</option>--}}
                    {{--<option value="rock">Rock</option>--}}
                    {{--<option value="jazz">Jazz</option>--}}
                    {{--<option value="taproom">Taproom</option>--}}
                    {{--<option value="cocktail">Cocktail</option>--}}
                {{--</select>--}}
                <div role="tabpanel" class="tab-pane fade in active form-group" id="filter">
                    <input type="hidden" name="features" class="filters features">
                    <label>
                        <input type="checkbox" class="filter-value" value="smoking"> Smoking
                    </label>
                    <label>
                        <input type="checkbox" class="filter-value" value="food"> Kitchen
                    </label>
                    <label>
                        <input type="checkbox" class="filter-value" value="pet_friendly"> Pets
                    </label>
                    {{--<label>--}}
                        {{--<input type="checkbox" class="filter-value" value="bikes"> Bike Racks--}}
                    {{--</label>--}}
                    <label>
                        <input type="checkbox" class="filter-value" value="live_music"> Live Music
                    </label>
                    {{--<label>--}}
                        {{--<input type="checkbox" class="filter-value" value="reservations"> Reservations--}}
                    {{--</label>--}}
                    <label>
                        <input type="checkbox" class="filter-value" value="tvs"> TVs
                    </label>
                    <label>
                        <input type="checkbox" class="filter-value" value="18+"> 18+
                    </label>
                    {{--<label>--}}
                        {{--<input type="checkbox" class="filter-value" value="kids"> Kids--}}
                    {{--</label>--}}
                    <label>
                        <input type="checkbox" class="filter-value" value="patio"> Patio
                    </label>
                    <label>
                        <input type="checkbox" class="filter-value" value="pool"> Pool Tables
                    </label>
                    <label>
                        <input type="checkbox" class="filter-value" value="darts"> Darts
                    </label>
                    <label>
                        <input type="checkbox" class="filter-value" value="games"> Games
                    </label>
                </div>
                @include('forms.error', ['field' => 'type'])
                <button type="submit" class ="btn btn-primary pull-right">Update</button>
            </form>
        </div>
    </div>
@stop