@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-3">
			<img class="img img-thumbnail" src="{{ $user->avatar }}" height="150" width="150">
		</div>
		<div class="col-xs-6">
			<h2>{{ $user->first_name }} {{ $user->formatLastName() }}.</h2>
			Hopper since {{ $user->created_at->format('F Y') }}
			@if(Auth::check() && (Auth::user()->id == $user->id))
			<div>
				<a class="btn btn-default" href="{{ action('UserController@edit', $user->id) }}">Change your info</a>
			</div>
			@endif
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-3">
			<h4>Total user score</h4>
			<div class="event-date">{{ $user->totalUserVotes() }}</div>
		</div>
		<div class="col-xs-9">
			<h3>Reviews</h3>
			<hr>
			@foreach ($user->reviews as $review)
			<div class="row">
				<div class="col-xs-2">
					<img src="{{ $review->bar->pictures->first()->pic_url or '' }}" class="thumbnail responsive" height="65" width="65">
				</div>
				<div class="col-xs-10">
					<a href="/bars/{{ $review->bar_id }}"><strong>{{ $review->bar->name }}</strong></a>
					<div class="user-page-review-info">{{ $review->bar->type }}</div>
					<a href="http://maps.apple.com/?q={{ $review->bar->address }}">{{ $review->bar->address }}</a>
					<br>
					<p class="beer-rating">{!! $review->beerRating() !!}</p> &nbsp; {{ $review->created_at->format('d/m/Y') }}
				</div>
			</div>
			<div>
				{{ $review->content }}
			</div>
			@if(Auth::check() && (Auth::user()->id != $user->id))
			<strong>Was this review helpful?</strong>
			<button role="button" data-value="{{ $review->id }}" class="btn btn-primary upvote">Yes</button> <button role="button" data-value="{{ $review->id }}" class="btn btn-danger downvote">No</button>
			<br> 
			<small>review score</small> 
			<br>
			<div id="{{ $review->id }}">{{ $review->totalVotes() }}</div>
			@endif
			<hr>
			@endforeach
		</div>
	</div>
</div>
@stop
@section('scripts')
@include('partials.vote-ajax')
@stop
