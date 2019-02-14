@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row" id="bar-info">
		<div class="col-xs-6" id="details">
			<h3>{{ $bar->name }}</h3>
			<p class="beer-rating">{{ $bar->averageBarRating() }}</p>
			<br>
			<a href="http://maps.apple.com/?q={{ $bar->address }}">{{ $bar->address }}</a>
			<br>
			@if($bar->phone != 0)
			<a href="tel:{{$bar->phone}}">{{ $bar->formatPhoneNumber() }}</a>
			@endif
			<br>
			<a href="{{ $bar->website }}">Website</a>
			<br>
			@if(Auth::check())
			@if($bar->owner_id !== null && Auth::user()->id == $bar->owner_id)
			<a class="btn btn-warning" href="{{ action('BarsController@edit', $bar->id) }}">Edit bar info</a>
			@endif
			@endif
			@if(Auth::check())
			<button style="margin-left: auto; margin-right: auto" id="image-upload" type="button" class="btn btn-primary">Upload an image</button>
			@endif

			<div id="dropzone">
				<form action="{{ action('PicturesController@store', $bar->id) }}" method="POST"
					enctype="multipart/form-data" class="dropzone">
					{{ csrf_field() }}
				</form>
			</div>
		</div>
		<div class="col-xs-6" id="photos">
			<div id="carousel" class="carousel slide" data-ride="carousel">
				<!-- Wrapper for slides -->
				<div style="cursor:pointer;" class="carousel-inner carousel-image-container" role="listbox">
					@foreach ($bar->pictures as $index => $picture)
					<div class="item @if($index == 0) {{ 'active' }} @endif">

					<div data-value="{{ $picture->pic_url }}" class="item @if($index == 0) {{ 'active' }} @endif">
						<a href="{{ $picture->pic_url }}" rel="gallery"  class="pirobox_gall">
							<img class="cover" src="{{ $picture->pic_url }}" alt="...">
						</a>
						<div class="carousel-caption">
							<!-- maybe add captions to pictures table? -->
						</div>
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
	<!-- bottom portion -->
	@if (Auth::check())
	<a class="btn btn-default" href="/reviews/create?bar_id={{ $bar->id }}">Write a review</a>
	<a class="btn btn-default" href="/specials/create?bar_id={{ $bar->id }}">Add a special</a>
	<a class="btn btn-default" href="/events/create?bar_id={{ $bar->id }}">Add an event</a>
	@endif
	<div class="row" id="bar-reviews">
		<div class="col-xs-12">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" id="myTabs" role="tablist">
				<li role="presentation" class="active"><a href="#reviews" aria-controls="reviews" role="tab"
					data-toggle="tab">Reviews</a></li>
					<li role="presentation" class=""><a href="#specials" aria-controls="specials" role="tab"
						data-toggle="tab">Specials</a></li>
						<li role="presentation" class=""><a href="#bar-features" aria-controls="bar-features" role="tab"
							data-toggle="tab">Features</a></li>
							<li role="presentation" class=""><a href="#events" aria-controls="events" role="tab"
								data-toggle="tab">Events</a></li>
							</ul>
							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane fade in active" id="reviews">
									<br>
									@foreach ($bar->reviews as $review)
									<div class="row">
										<div class="col-xs-3">
											<img src="{{ $review->user->avatar }}" class="thumbnail responsive" height="60"
											width="60">
											<h5>
												<a href="{{ action('UserController@show', $review->user->id) }}">{{ $review->user->first_name }} {{ $review->user->formatLastName() }}.</a>
											</h5>
											<small>user score</small>
											<p>&nbsp;{{ $review->user->totalUserVotes() }}</p>
											<small>review score</small> 
											<br>
											<div id="{{ $review->id }}">&nbsp;{{ $review->totalVotes() }}</div>
										</div>
										<div class="col-xs-9">
											<h4>{{ $review->title }} <br>
												<small>posted {{ $review->created_at->diffForHumans() }}</small>
											</h4>
											<p class="beer-rating">{!! $review->beerRating() !!}</p>
											<p>{{ $review->content }}</p>
											@if(Auth::check() && (Auth::user()->id != $review->created_by))
											<hr>
											<strong>Was this review helpful?</strong>
											<div class="">
												<button role="button" data-value="{{ $review->id }}" class="btn btn-primary upvote">Yes</button> 
												<button role="button" data-value="{{ $review->id }}" class="btn btn-danger downvote">No</button>
											</div>
											@endif
										</div>
									</div>
									<hr>
									@endforeach
								</div>
								<div role="tabpanel" class="tab-pane fade" id="specials">
									{{--@if(Auth::user())--}}
									{{--<a href="/specials/create?bar_id={{ $bar->id }}">Add a special...</a>--}}
									{{--@endif--}}
									<br>
									@foreach ($bar->specials as $special)
									<div class="row">
										<div class="col-xs-3">
											<h5>
												<a href="{{ action('SpecialsController@show', $special->id) }}">{{ $special->title }}</a>
											</h5>
										</div>
										<div class="col-xs-9">
											<p>{{ $special->content }}</p>
										</div>
									</div>
									<hr>
									@endforeach
								</div>
								<div role="tabpanel" class="tab-pane fade" id="bar-features">
									<br>
									@foreach ($bar->features as $feature)
									{!! $feature->featureIcons() !!}
									@endforeach
								</div>
								<div role="tabpanel" class="tab-pane fade" id="events">
									{{--@if(Auth::user())--}}
									{{--<a href="/events/create?bar_id={{ $bar->id }}">Add an event...</a>--}}
									{{--@endif--}}
									@foreach ($bar->events as $event)
									<br>
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
							</div>
						</div>
					</div>
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
						interval: 4000
					});
					$('#image-upload').click(function () {
						$('#dropzone').slideToggle('slow');
					});
					$('.list-card').click(function() {
						$(location).attr('href', '/events/' + $(this).data('value'));
					});
					$('.item').click(function() {
						$(location).attr('href', $(this).data('value'));
					});
				</script>

				<script type="text/javascript">
					$(document).ready(function() {
						$().piroBox_ext({
							piro_speed : 900,
							bg_alpha : 0.1,
							piro_scroll : true //pirobox always positioned at the center of the page
						});
					});
				</script>
				@include('partials.vote-ajax')
				@stop