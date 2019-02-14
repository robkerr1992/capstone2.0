@extends('layouts.master')

@section('content')
<div class="container">
	<br>
	<div class="row">
		<div class="col-xs-8">
			<a href="{{ $event->event_pic }}">
				<img  class="thumbnail" src="{{$event->event_pic}}" style="height: 40vh;width: 100%;object-fit: cover;object-position: 50% 50%;">
			</a>
		</div>
		<div class="col-xs-4 event-title-info">
			<p class="event-month">{{ $event->date->format('M') }}</p>
			<p class="event-date">{{ $event->date->format('d') }}</p>
			<p class="event-title">{{ $event->title }}</p>
			<div class="event-by">
				<small>submitted by</small>
				<p class="submitted-by"><a href="/users/{{ $event->user->id }}">{{ $event->user->first_name }} {{ $event->user->formatLastName() }}.</a></p>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-8">
			<h2 class="primary-label">Description</h2>
			<p class="event-description">{{ $event->content }}</p>
		</div>
		<div class="col-xs-4">
			<h2 class="primary-label">Date & Time</h2>
			<div class="event-info">
				<p>{{ $event->date->format('F jS, Y') }}</p>
				<p>@ {{ $event->date->format('g:i A') }}</p>
			</div>
			<hr>
			<h2 class="primary-label">Location</h2>
			<div class="event-info">
				<p><a href="/bars/{{ $event->bar_id }}">{{ $event->bar->name }}</a></p>
				<p class="address-phone"><a href="http://maps.apple.com/?q={{ $event->bar->address }}">{{ $event->bar->address }}</a> | <a href="tel:{{ $event->bar->phone }}">{{ $event->bar->formatPhoneNumber() }}</a></p>
			</div>
			<hr>
			@if((Auth::user()) && (Auth::user()->id == $event->created_by))
			<div>
				<a class="btn btn-warning btn-block" href="{{action('EventsController@edit', $event->id) }}">Edit Event</a>
				<form method="POST" action="{{action('EventsController@destroy', $event->id) }}">
					<input type="submit" class="btn btn-danger btn-block" value="Delete">
					{{ method_field('DELETE') }}
					{{ csrf_field() }}
				</form>
			</div>
			@endif
		</div>
	</div>
	<small><a class="btn btn-primary" href="{{ action('EventsController@index') }}">Back to Events</a></small>
</div>
</div>
@stop