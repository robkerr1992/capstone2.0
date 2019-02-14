<!DOCTYPE html>
<html lang="en">
<head>
	<title>210 Hopper</title>
	<!-- apple icons -->
	<link rel="apple-touch-icon" href="apple-icon-60x60.png" />
	<link rel="apple-touch-icon" sizes="76x76" href="apple-icon-76x76.png" />
	<link rel="apple-touch-icon" sizes="120x120" href="apple-icon-120x120.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="apple-icon-152x152.png" />

	<link rel="shortcut icon" type="text/css" href="/img/210hopper-kangaroo-black.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Master CSS -->
	<link rel="stylesheet" href="/css/master.css">
	<!-- Dropzone.js -->
	<script src="/js/dropzone.js"></script>
	<link rel="stylesheet" href="/css/dropzone.css">
	<link rel="stylesheet" href="/css/basic.css">
	<!-- FontAwesome -->
	<script src="https://use.fontawesome.com/2bcd30c787.js"></script>
	<!-- Pirobox -->
	<link rel="stylesheet" type="text/css" href="css_pirobox/style_1/style.css"/>
	<script type="text/javascript" src="js/pirobox_extended.js"></script>
</head>
<body>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Header -->
	@include('partials.header')
	<!-- end Header -->
	@if (session()->has('SUCCESS_MESSAGE'))
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{ session('SUCCESS_MESSAGE') }}
	</div>
	@endif
	@if (session()->has('ERROR_MESSAGE'))
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{ session('ERROR_MESSAGE') }}
	</div>
	@endif
	<!-- side nav -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-3 side-nav pull-right" id="side-nav">
				<div class="sidenav-content">
					<li id="sidenav-bars">Bars</li>
					<ul id="more-bars">
						<li><a href="" class="nearby">Nearby</a></li>
						<li><a href="/discover">Discover</a></li>
						<li><a href="/bars">Top Rated</a></li>
						@if(Auth::check())
						<li><a href="/bars/create">List a Bar</a></li>
						@endif
					</ul>
					@if(Auth::check())
					<li id="sidenav-gameplans">Gameplans</li>
					<ul id="more-gameplans">
						<li><a href="/gameplans">Browse Gameplans</a></li>
						<li><a href="/gameplans/create">Create a Gameplan</a></li>
					</ul>
					@endif
					<li id="sidenav-events">Events</li>
					<li id="sidenav-specials">Specials</li>
					<li id="sidenav-recent">Recent Activity</li>
					<li id="sidenav-about">About Us</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- end side nav -->
<!-- views will appear here --> 
@yield('content')
<!-- bottom navigation -->
<div class="bottom-nav-spacer">
</div>
<div class="container-fluid">
	<div class="row">
		<div class="btn-group btn-group-justified navigation" id="bottom" role="group" aria-label="navigation">
			<a href=""  class="nearby btn btn-default nav-nearby" role="group" aria-label="nearby">
				<i class="fa fa-location-arrow fa-2x" aria-hidden="true"></i>
				<br>
				<span id="nav-text">Nearby</span>
			</a>
			<a href="" class="btn btn-default nav-search search" role="group" aria-label="search">
				<i class="fa fa-search fa-2x" aria-hidden="true"></i>
				<br>
				<span id="nav-text">Search</span>
			</a>
			<a href="/" class="btn btn-default nav-home" role="group" aria-label="home">
				<img id="home-king" src="/img/210hopper-kangaroo.png">
			</a>
			<a href="/recent" class="btn btn-default nav-activity" role="group" aria-label="activity">
				<i class="fa fa-bolt fa-2x" aria-hidden="true"></i>
				<br>
				<span id="nav-text">Activity</span>
			</a>
			<a href="" id="more" class="btn btn-default nav-more" role="group" aria-label="more">
				<i class="fa fa-bars fa-2x" aria-hidden="true"></i>
				<br>
				<span id="nav-text">More</span>
			</a>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-3 bottom-more-nav" id="bottom-more-nav">
			<div class="bottomnav-content">
				<div class="pull-right" id="close-more">×</div>
				<li id="bottomnav-bars">Bars</li>
				<ul id="bottom-more-bars">
					<li><a href="/discover">Discover</a></li>
					<li><a href="/bars">Top Rated</a></li>
					@if(Auth::check())
					<li><a href="/bars/create">List a Bar</a></li>
					@endif
				</ul>
				@if(Auth::check())
				<li id="bottomnav-gameplans">Gameplans</li>
				<ul id="bottom-more-gameplans">
					<li><a href="/gameplans">Browse Gameplans</a></li>
					<li><a href="/gameplans/create">Create a Gameplan</a></li>
				</ul>
				@endif
				<li id="bottomnav-events">Events</li>
				<li id="bottomnav-specials">Specials</li>
				<li id="bottomnav-about">About Us</li>
			</ul>
		</div>
	</div>
</div>

</div>
<!-- Latest compiled and minified BS JavaScript -->
<script   src="https://code.jquery.com/jquery-2.2.4.min.js"   integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
@yield('scripts')
<script>
	{{--asks for location on nearby button click and then sends user to nearby page--}}
	$('.nearby').click(function(e) {
		e.preventDefault();
		var startPos;
		var lat;
		var lon;
		var windowLocation = 'http://210hopper.com/nearby/';
		var geoOptions = {
			timeout: 10 * 1000,
			maximumAge: 5 * 60 * 1000
		};
		var geoSuccess = function(position) {
			startPos = position;
				// document.getElementById('startLat').innerHTML = startPos.coords.latitude;
				// document.getElementById('startLon').innerHTML = startPos.coords.longitude;
				lat = startPos.coords.latitude;
				lon = startPos.coords.longitude;
				console.log(lat, lon);
				windowLocation = windowLocation + lat + '/' + lon;
				window.location.href = windowLocation;
//				$('#nearby').attr('href', '/nearby/' + lat + '/' + lon);

				// latLongObject = new google.maps.LatLng(lat,lon);
			};

			var geoError = function(error) {
				console.log('Error occurred. Error code: ' + error.code);
				// error.code can be:
				//   0: unknown error
				//   1: permission denied
				//   2: position unavailable (error response from location provider)
				//   3: timed out
			};
			navigator.geolocation.getCurrentPosition(geoSuccess, geoError, geoOptions);
		});

	{{-- search button toggle--}}
	$('.search').click(function(e){
		e.preventDefault();
		if($('#myTabs').hasClass('hidden')){

			$('#myTabs').removeClass('hidden');
			$('#search').removeClass('hidden');
			$('.search-form').slideToggle();
		} else {
			$('#myTabs').addClass('hidden');
			$('.search-form').slideToggle();
		}
	});

	// desktop search
	$('.filter-toggle').click(function(){
		$('.filter-form').removeClass('hidden');
		$('.filters').slideToggle();
	})

	{{-- search tab search bar toggle--}}
	$('#search').click(function(e){
		$('#search').removeClass('hidden');
		$('#filter').addClass('hidden');
	});
	{{-- filter button show hidden feature list--}}
	$('#filter-tab').click(function(){
		$('#filter').removeClass('hidden');
	});


		// bottom more-nav
		var animating = false;
		var up = false;
		$('#more').click(function(e) {
			e.preventDefault();
			if (!animating && !up) {
				animating = true;
				$('#bottom-more-nav').animate({
					'height' : '250px'
				}, 500, function() {
					animating = false;
					up = true;
				});
			};
		});
		$('#close-more').click(function(e) {
			e.preventDefault();
			if (!animating && up) {
				$('#bottom-more-nav').animate({
					'height' : '0'
				}, 500, function() {
					animating = false;
					up = false;
				});
			}
		});
		$('#bottomnav-bars').click(function() {
			$('#bottom-more-bars').slideToggle();
			$('#bottomnav-bars').toggleClass('active')
		});
		$('#bottomnav-events').click(function() {
			$(location).attr('href', '/events');
		});
		$('#bottomnav-specials').click(function() {
			$(location).attr('href', '/specials');
		});
		$('#bottomnav-recent').click(function() {
			$(location).attr('href', '/recent');
		});
		$('#bottomnav-gameplans').click(function() {
			$('#bottom-more-gameplans').slideToggle();
			$('#bottomnav-gameplans').toggleClass('active')
		});

		// desktop side-nav
		var opened = false;
		$('#more-options').click(function() {
			if (!animating && !opened) {
				animating = true;
				$('#side-nav').animate({
					'width' : '250px'
				}, 500, function() {
					animating = false;
					opened = true;
				});
			} else {
				animating = true;
				$('#side-nav').animate({
					'width' : '0'
				}, 500, function() {
					animating = false;
					opened = false;
				});
			}
		});
		$('#sidenav-bars').click(function() {
			$('#more-bars').slideToggle();
			$('#sidenav-bars').toggleClass('active')
		});
		$('#sidenav-events').click(function() {
			$(location).attr('href', '/events');
		});
		$('#sidenav-specials').click(function() {
			$(location).attr('href', '/specials');
		});
		$('#sidenav-recent').click(function() {
			$(location).attr('href', '/recent');
		});
		$('#sidenav-gameplans').click(function() {
			$('#more-gameplans').slideToggle();
			$('#sidenav-gameplans').toggleClass('active')
		});

	</script>
	<script>
		{{--add features for search to hidden input--}}
		$(".form").submit(function (e) {
			var features = [];
			var featuresInput = $('.features');
			$('input[type="checkbox"]:checked').each(function (index, element) {
				features.push($(element).val());
			});
			featuresInput.val(features);
		});

//		$("#searchform").submit(function (e) {
//			var features = [];
//			var featuresInput = $('#searchfeatures');
//			$('input[type="checkbox"]:checked').each(function (index, element) {
//				features.push($(element).val());
//			});
//			featuresInput.val(features);
//		});

{{--same thing for create a bar--}}
//		$("#barform").submit(function (e) {
//            var features = [];
//            var featuresInput = $('#barfeatures');
//            $('input[type="checkbox"]:checked').each(function (index, element) {
//                features.push($(element).val());
//            });
//            featuresInput.val(features);
//        });

{{--and for edit a bar....--}}
//		$("#bareditform").submit(function (e) {
//			var features = [];
//			var featuresInput = $('#baredit');
//			$('input[type="checkbox"]:checked').each(function (index, element) {
//				features.push($(element).val());
//			});
//			featuresInput.val(features);
//		});

</script>
<script>
	{{--add bars for gameplans to hidden input--}}
	$("#gameplanForm").submit(function (e) {
		var bars = [];
		var barsInput = $('#hidden-bar-input');
		$('.barSelect').each(function (index, element) {
			bars.push($(element).val());
		});
		barsInput.val(bars);
	});
	var barSelectGuts = $('#moreStopsDiv').html();
	$('#moreStopsButton').click(function(e){
		e.preventDefault();
		var previousForm = $('#moreStopsDiv').html();
		$('#moreStopsDiv').html(previousForm + barSelectGuts);
//		console.log(barSelectGuts);

})

</script>
<script>
	$('#myTabs a').click(function (e) {
		e.preventDefault()
		$(this).tab('show')
	});
	$('#myTabs a:first').tab('show');
</script>
</body>
</html>
