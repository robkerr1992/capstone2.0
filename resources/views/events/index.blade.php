@extends('layouts.master')

@section('content')
<div class="container">
<h3 class="h3-list-title">Upcoming Events</h3>
<hr>
	@foreach ($upcomingEvents as $index => $event)
	<div data-value="{{ $event->id }}" class="row list-card">
		<div class="col-xs-5 list-card-image">
			<img class="pull-left" src="{{$event->event_pic}}" style="height: 20vh;width: 100%;object-fit: cover;object-position: 50% 50%;">
		</div>
		<div class="col-xs-7">
			<div class="event-info">
				<p class="event-month">{{ $event->date->format('M j g:i A') }}</p>
			</div>
			<h4>{{ $event->title }}</h4>
			<hr>
			<p>@ <a href="/bars/{{ $event->bar_id }}" style="font-size:15px;font-weight:normal;">{{ $event->bar->name }}</a></p>
			</div>
		</div>
		@endforeach
	</div>
	{{--{!! $events->render() !!}--}}
	@stop
	@section('scripts')
	<script>
	$('.list-card').click(function() {
		$(location).attr('href', '/events/' + $(this).data('value'));
	})
	</script>
	@stop