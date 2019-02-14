@extends('layouts.master')
@section('content')
<div class="container">
	<br>
	<div class="row">
		<div class="col-xs-8">
			<div id="carousel{{ $gameplan->id }}" class="carousel slide gameplan-list-carousel" data-ride="carousel">
				<!-- Wrapper for slides -->
				<div class="carousel-inner carousel-image-container events-slider" role="listbox">
					@foreach($gameplan->bars as $index => $gpbar)
					<div data-value="{{ $gpbar->bar->id }}"
						class="item @if($index == 0) {{ 'active' }} @endif">
						<div class="carousel-caption">
							<h2>{{ $gpbar->bar->name }}</h2>
							<p>{{ $index+1 }}</p>
						</div>
						<img class="cover"
						src="{{ $gpbar->bar->pictures->first()->pic_url or '' }}"
						alt="{{ $gpbar->bar->name }}">
					</div>
					@endforeach
				</div>
				<!-- Controls -->
				<a class="left carousel-control" href="#carousel{{ $gameplan->id }}" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#carousel{{ $gameplan->id }}" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
		<div class="col-xs-4">
			<p class="event-month">{{ $gameplan->date->format('M') }}</p>
			<p class="event-date">{{ $gameplan->date->format('d') }}</p>
			<p class="event-title">{{ $gameplan->title }}</p>
			<div class="event-by">
				<small>submitted by</small>
				<p class="submitted-by"><a href="/users/{{ $gameplan->author->id }}">{{ $gameplan->author->first_name }} {{ $gameplan->author->formatLastName() }}.</a></p>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-8">
			<h2 class="primary-label">Description</h2>
			<p class="event-description">{{ $gameplan->description }}</p>
		</div>
		<div class="col-xs-4">
			<h2 class="primary-label">Date & Time</h2>
			<div class="event-info">
				<p>{{ $gameplan->date->format('F jS, Y') }}</p>
				<p>@ {{ $gameplan->time->format('g:i A') }}</p>
			</div>
			<hr>
			<h2 class="primary-label">Hoppers</h2>
			<div class="event-info">
				@foreach($gameplan->hoppers as $hopper)
					<p>{{$hopper->user->first_name . ' ' . $hopper->user->formatLastName() . '.'}}</p>
				@endforeach
			</div>
			@if(Auth::user()->id != $gameplan->author->id)
			<a class="btn btn-warning" href="addHopper/{{ $gameplan->id }}">Join Gameplan</a>
				<hr>
			@endif
			@if((Auth::user()) && (Auth::user()->id == $gameplan->author_id))
			<div>
				<a class="btn btn-warning btn-block" href="{{action('GameplansController@edit', $gameplan->id) }}">Edit Event</a>
				<form method="POST" action="{{action('GameplansController@destroy', $gameplan->id) }}">
					<input type="submit" class="btn btn-danger btn-block" value="Delete">
					{{ method_field('DELETE') }}
					{{ csrf_field() }}
				</form>
			</div>
			@endif
		</div>
	</div>
	<small><a class="btn btn-primary" href="{{ action('GameplansController@index') }}">Back to Gameplans</a></small>
</div>
</div>
@stop