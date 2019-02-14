@extends('layouts.master')

@section('content')
@if(Auth::check())
<div class="row">
	<div class="col-xs-8 col-xs-offset-2">
		<h4 class="modal-title">Create a bar</h4>
		<form class="form" method="POST" action="{{ action('BarsController@store') }}">
			{{ csrf_field() }}
			<div class="form-group">
				<input type="text" class="form-control" name="name" id="name" placeholder="Bar name">
				@include('forms.error', ['field' => 'name'])
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="address" id="address" placeholder="Bar address">
				@include('forms.error', ['field' => 'address'])
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="phone" id="phone" placeholder="Phone number">
				@include('forms.error', ['field' => 'phone'])
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="website" id="website" placeholder="Bar website">
				@include('forms.error', ['field' => 'website'])
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="email" id="email" placeholder="Bar email">
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
			<div class="" >
				<input type="hidden" name="features" class="filters features">
				<label>
					<input type="checkbox" class="filter-value" value="smoking"> Smoking
				</label>
				<label>
					<input type="checkbox" class="filter-value" value="food"> Kitchen
				</label>
				<label>
					<input type="checkbox" class="filter-value" value="pet_friendly"> Pets Allowed
				</label>
				{{--<label>--}}
					{{--<input type="checkbox" class="filter-value" value="bikes"> Bike Racks--}}
				{{--</label>--}}
				<label>
					<input type="checkbox" class="filter-value" value="live_music"> Live Music
				</label>
				{{--<label>--}}
					{{--<input type="checkbox" class="filter-value" value="reservations"> Reservations Needed--}}
				{{--</label>--}}
				<label>
					<input type="checkbox" class="filter-value" value="tvs"> TVs
				</label>
				<label>
					<input type="checkbox" class="filter-value" value="18+"> 18+
				</label>
				{{--<label>--}}
					{{--<input type="checkbox" class="filter-value" value="kids"> Kids Allowed--}}
				{{--</label>--}}
				<label>
					<input type="checkbox" class="filter-value" value="patio"> Outdoor Seating
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
			<button type="submit" class ="btn btn-primary pull-right">Create</button>
		</form>
	</div>
</div>
@else
<div hidden>{!! redirect('auth/login') !!}</div>
@endif
@stop