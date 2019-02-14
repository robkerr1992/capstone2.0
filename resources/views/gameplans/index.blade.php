@extends('layouts.master')

@section('content')
{{--<div></div>--}}
<div class="gameplan-header" id="header" style="background-image:url('/img/gobletsedit.jpg'); background-position: center center; background-repeat: no-repeat; background-size: 100%;width:auto;">
</div>
<div class="container">
	<div class="row">
		<div class="col-xs-2 col-xs-offset-5"><br>
			<a class="btn btn-warning" href="gameplans/create">Create Gameplan</a>
		</div>
	</div>
	<hr>
	<br>
	<h3 class="h3-list-title">Recently added Gameplans</h3>
	<br>
	@foreach($gameplans as $gameplanindex => $gameplan)
	<div data-value="{{ $gameplan->id }}" class="list-card">
		<div class="row">
			<div class="col-xs-8 col-xs-offset-1">
				<h3>{{ $gameplan->title }}</h3>
				<p class="event-month">{{ $gameplan->date->format('M') }}</p>
				<p class="event-date">{{ $gameplan->date->format('d') }}</p>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-8 col-xs-offset-2" id="photos">
				<div id="carousel{{ $gameplanindex }}" class="carousel slide gameplan-list-carousel" data-ride="carousel">
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
					<a class="left carousel-control" href="#carousel{{ $gameplanindex }}" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#carousel{{ $gameplanindex }}" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6 col-xs-offset-1">
				<h4>Hoppers:</h4>
				@foreach($gameplan->hoppers as $hopper)
				<h5>{{ $hopper->user->first_name . ' ' . $hopper->user->formatLastName() }}</h5>
			</div>
		</div>
	</div>
	@endforeach
	@endforeach
</div>
{!! $gameplans->render() !!}
@stop
@section('scripts')
<script>
	$('.carousel').carousel({
		interval: 4000
	});
	$('.item').click(function (e) {
		var $barId = $(this).data('value');
		$(location).attr('href', '/bars/' + $barId);
	});
	$('.list-card').click(function () {
		$(location).attr('href', '/gameplans/' + $(this).data('value'));
	});
</script>
@stop