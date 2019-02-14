@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row" id="bar-reviews">
		<div class="col-xs-12">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" id="myTabs" role="tablist">
				<li role="presentation" class="active"><a href="#reviews" aria-controls="reviews" role="tab"
					data-toggle="tab">Bars</a></li>
					<li role="presentation" class=""><a href="#events" aria-controls="specials" role="tab"
						data-toggle="tab">Events</a></li>
						<li role="presentation" class=""><a href="#specials" aria-controls="events" role="tab"
							data-toggle="tab">Specials</a></li>
							<li role="presentation" class=""><a href="#gameplans" aria-controls="events" role="tab"
								data-toggle="tab">Gameplans</a></li>
							</ul>
							<!-- Tab panes -->
							<div class="tab-content">
								<!-- bars -->
								<div role="tabpanel" class="tab-pane fade in active" id="reviews">
									<br>
									@foreach ($recent['bars'] as $bar)
									<div data-value="{{ $bar->id }}" class="row list-card bar">
										<div class="col-xs-5 list-card-image">
											<img class="pull-left" src="{{ $bar->pictures->first()->pic_url or "" }}" style="height: 22vh;width: 100%;object-fit: cover;object-position: 50% 50%;">
										</div>
										<div class="col-xs-7">
											<h2>{{ $bar->name}}</h2>
											<p><a href="http://maps.apple.com/?q={{ $bar->address }}"><strong>{{ $bar->address}}</strong></a>
												<br>
												@if($bar->phone != 0)
												<a href="tel:{{ $bar->phone }}">{{ $bar->formatPhoneNumber() }}</a></p>
												@endif
												@if ($bar->averageBarRating() != null)
												<p class="beer-rating">{!! $bar->averageBarRating() !!}</p>
												@else
												No ratings yet
												@endif
											</div>
										</div>
										@endforeach
									</div>
									<!-- events -->
									<div role="tabpanel" class="tab-pane fade" id="events">
										<br>
										@foreach ($recent['events'] as $event)
										<div data-value="{{ $event->id }}" class="row list-card event">
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
									<!-- specials -->
									<div role="tabpanel" class="tab-pane fade" id="specials">
										<br>
										@foreach ($recent['specials'] as $special)
										<div data-value="{{ $special->id }}" class="row list-card special">
											<div class="col-xs-6">
												<h4>{{ $special->title }}</h4>
												{{ substr($special->content, 0, 25) }}...
											</div>
											<div class="col-xs-6">
												<h4>@ <a href="/bars/{{ $special->bar->id }}">{{ $special->bar->name }}</a></h4>
											</div>
										</div>
										@endforeach
									</div>
									<!-- gameplans -->
									<div role="tabpanel" class="tab-pane fade" id="gameplans">
										@foreach($recent['gameplans'] as $gameplan)
										<div class="row">
											<table class="table table-condensed col-xs-12">
												<h3><a href="{{ action('GameplansController@show', $gameplan->id) }}">Gameplan
													for {{ $gameplan->date }}</a></h3>
													<h4>Hop-Stops:</h4>
													<div class="row">
														<div class="col-xs-8 col-xs-offset-2" id="photos">
															<div id="carousel" class="carousel slide" data-ride="carousel">
																<!-- Wrapper for slides -->
																<div class="carousel-inner carousel-image-container events-slider"
																role="listbox">
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
															<a class="left carousel-control" href="#carousel" role="button"
															data-slide="prev">
															<span class="glyphicon glyphicon-chevron-left"
															aria-hidden="true"></span>
															<span class="sr-only">Previous</span>
														</a>
														<a class="right carousel-control" href="#carousel" role="button"
														data-slide="next">
														<span class="glyphicon glyphicon-chevron-right"
														aria-hidden="true"></span>
														<span class="sr-only">Next</span>
													</a>
												</div>
											</div>
										</div>
										<h4>Hoppers:</h4>
										@foreach($gameplan->hoppers as $hopper)
										<h5>{{ $hopper->user->first_name . ' ' . $hopper->user->formatLastName() }}</h5>
										@endforeach
										@if((Auth::user()) && (Auth::user()->id == $gameplan->author_id))
										<div>
											<a class="btn btn-success"
											href="{{action('GameplansController@edit', $gameplan->id) }}">Edit
											Gameplan</a>
											<form method="POST"
											action="{{action('GameplansController@destroy', $gameplan->id) }}">
											<input type="submit" class="btn btn-danger" value="Delete Event">
											{{ method_field('DELETE') }}
											{{ csrf_field() }}
										</form>
									</div>
									@endif
								</table>
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
		$('.bar').click(function() {
				$(location).attr('href', '/bars/' + $(this).data('value'));
			});
		$('.event').click(function() {
				$(location).attr('href', '/events/' + $(this).data('value'));
			});
		$('.special').click(function() {
				$(location).attr('href', '/specials/' + $(this).data('value'));
			});
		</script>
		@stop