@extends('layouts.master')

@section('content')
<div class="container">
	<h3 class="h3-list-title">Search Results</h3>
	<hr>
	@foreach ($bars as $index => $bar)
	<div data-value="{{ $bar->id }}" class="row thisBar list-card">
		<div class="col-xs-5 list-card-image">
			<img class="pull-left" src="{{ $bar->pictures->first()->pic_url or '' }}" style="height: 22vh;width: 100%;object-fit: cover;object-position: 50% 50%;">
		</div>
		<div class="col-xs-7">
			<h2>{{ $bar->name }}</h2>
			<p><a href="http://maps.apple.com/?q={{ $bar->address }}"><strong>{{ $bar->address}}</strong></a>
				<br>
				@if($bar->phone != 0)
				<a href="tel:{{ $bar->phone }}">{{ $bar->formatPhoneNumber() }}</a></p>
				@endif
				<div class="row">
					@if ($bar->averageBarRating() != null)
					<div class="col-xs-6">
						<p class="beer-rating">{!! $bar->averageBarRating() !!}</p>
					</div>
					@else
					no ratings yet
					@endif
					@if (isset($distance[$index]) && $distance[$index] != null)
					<div class="col-xs-6 pull-right">
						{{ substr($distance[$index], 0, 5) }} mi away
					</div>
					@endif
				</div>
			</div>
		</div>
		@endforeach
	</div>
	@stop
	@section('scripts')
	<script type="text/javascript">
		$('.thisBar').click(function () {
			$(location).attr('href', '/bars/' + $(this).data('value'));
		});
	</script>
	@stop