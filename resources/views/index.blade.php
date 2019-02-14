@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row index-header">
		<h1>&nbsp;{{ Carbon\Carbon::now('America/Chicago')->formatLocalized('%A') }}  <small>{{ Carbon\Carbon::now('America/Chicago')->formatLocalized('%B %d, %Y') }}&nbsp;</small></h1>
	</div>
</div>
<div class="container content">
	<hr>
	<div class="row">
		<div class="col-xs-12" id="photos">
			<h2>Upcoming Events</h2>
			<div id="carousel" class="carousel slide" data-ride="carousel">
				<!-- Wrapper for slides -->
				<div class="carousel-inner carousel-image-container events-slider" role="listbox">
					@foreach ($upcomingEvents as $index => $event)
					<div data-value="{{ $event->id }}" class="item @if($index == 0) {{ 'active' }} @endif">
						<div class="carousel-caption">
							<h2>{{ $event->title }}</h2>
							<p>{{ $event->date->format('m/j/Y @ g:i A') }}</p>
						</div>
						<img class="cover" src="{{ $event->event_pic }}" alt="{{ $event->title }}">
					</div>
					@endforeach
				</div>
				<!-- Controls -->
				<a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#carousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<h2>Highest Rated Bars</h2>
	</div>
	@foreach ($highestRated as $sortedBar)
	<div data-value="{{ $sortedBar->id }}" class="row thisBar list-card">
		<div class="col-xs-5 list-card-image">
			<img class="pull-left" src="{{ $sortedBar->pictures->first()->pic_url or '' }}" style="height: 22vh;width: 100%;object-fit: cover;object-position: 50% 50%;">
		</div>
		<div class="col-xs-7 top-bars">
			<h2>{{ $sortedBar->name}}</h2>
			<p><a href="http://maps.apple.com/?q={{ $sortedBar->address }}"><strong>{{ $sortedBar->address}}</strong></a>
				<br>
				@if($sortedBar->phone != 0)
				<a href="tel:{{ $sortedBar->phone }}">{{ $sortedBar->formatPhoneNumber() }}</a></p>
				@endif
				@if ($sortedBar->averageBarRating() != null)
				<p class="beer-rating">{!! $sortedBar->averageBarRating() !!}</p> &nbsp; {{ count($sortedBar->reviews) }} reviews
				@else
				no ratings yet
				@endif
			</div>
		</div>
		@endforeach
	</div>
	@stop
	@section('scripts')
	<script>
		$('#myTabs a').click(function (e) {
			e.preventDefault()
			$(this).tab('show')
		});
		$('#myTabs a:first').tab('show');
		$('.carousel').carousel({
			interval: 4500
		});
		$('.item').click(function (e) {
			var $eventId = $(this).data('value');
			$(location).attr('href', '/events/' + $eventId);
		});
		$('.thisBar').click(function () {
			$(location).attr('href', '/bars/' + $(this).data('value'));
		});
	</script>
	@stop