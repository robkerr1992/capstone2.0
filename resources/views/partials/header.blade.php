<div class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid navigation" id="top">
		<!-- desktop view -->
		<div class="row" id="desktop-nav">
			<div class="col-xs-3">
				<a href="/"><img id="header-logo" src="/img/210hopper-orange.png" alt="Hop on home!"></a>
			</div>
			<div class="col-xs-5">
				<div class="row">
					<div class="form" class="col-xs-12">
						<form method="get" action="/search" class="navbar-form form-inline">
							<div class="form-group">
								<button type="button" class="filter-toggle btn btn-warning">Filter</button>
								<input type="text" class="form-control" name="searchTerm" placeholder="Search">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
							<div class="form-group hidden filter-form">
								<div class="filters">
									<input type="hidden" name="features" class="filters features">
									<label>
										<input type="checkbox" class="filter-value" value="smoking"> Smoking
									</label>
									<label>
										<input type="checkbox" class="filter-value" value="food"> Kitchen
									</label>
									<label>
										<input type="checkbox" class="filter-value" value="pet_friendly"> Pets Allowed
									</label>
									<label>
										<input type="checkbox" class="filter-value" value="live_music"> Live Music
									</label>
									<label>
										<input type="checkbox" class="filter-value" value="tvs"> TVs
									</label>
									<label>
										<input type="checkbox" class="filter-value" value="18+"> 18+
									</label>
									<label>
										<input type="checkbox" class="filter-value" value="patio"> Outside Seating
									</label>
									<label>
										<input type="checkbox" class="filter-value" value="pool"> Pool Tables
									</label>
									<label>
										<input type="checkbox" class="filter-value" value="darts"> Darts
									</label>
									<label>
										<input type="checkbox" class="filter-value" value="games"> Games
									</label>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-xs-4 more-options navbar-right">
				@if (Auth::check())
				Welcome <a href="/users/{{ Auth::user()->id }}">{{ Auth::user()->first_name }}</a>! | <a href="/auth/logout">logout</a>
				@elseif (!Auth::check())
				<a href="/auth/register/" class="btn btn-default">Register</a>
				<a href="/auth/login/" class="btn btn-default">Login</a>
				@endif
				<div class="more-button" id="more-options"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></div>
			</div>
		</div>
		<!-- end desktop view -->
		
		<!-- mobile view -->
		<div class="row" id="search-container">
			<ul class="nav nav-tabs hidden" id="myTabs" role="tablist">
				<li role="presentation" class="active"><a href="#search" aria-controls="reviews" role="tab" data-toggle="tab">Search</a></li>
				<li role="presentation" class=""><a href="#filter" aria-controls="reviews" role="tab" data-toggle="tab" id="filter-tab">Filters</a></li>
			</ul>
			<div class="form" class="col-xs-11">
				<form method="get" action="/search" class="search-form navbar-form form-inline">
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active form-group hidden" id="filter">
							<input type="hidden" name="features" class="filters features">
							<label>
								<input type="checkbox" class="filter-value" value="smoking"> Smoking
							</label>
							<label>
								<input type="checkbox" class="filter-value" value="food"> Kitchen
							</label>
							<label>
								<input type="checkbox" class="filter-value" value="pet_friendly"> Pets Allowed
							</label>
							<label>
								<input type="checkbox" class="filter-value" value="live_music"> Live Music
							</label>
							<label>
								<input type="checkbox" class="filter-value" value="tvs"> TVs
							</label>
							<label>
								<input type="checkbox" class="filter-value" value="18+"> 18+
							</label>
							<label>
								<input type="checkbox" class="filter-value" value="patio"> Outside Seating
							</label>
							<label>
								<input type="checkbox" class="filter-value" value="pool"> Pool Tables
							</label>
							<label>
								<input type="checkbox" class="filter-value" value="darts"> Darts
							</label>
							<label>
								<input type="checkbox" class="filter-value" value="games"> Games
							</label>
							<button type="submit" class="btn btn-primary pull-right">Submit</button>
						</div>
						<div role="tabpanel" class="tab-pane fade in active form-group hidden" id="search">
							<input type="text" class="form-control" name="searchTerm" placeholder="Search">
							<button type="submit" class="btn btn-primary pull-right">Submit</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-xs-6 mobile-login navbar-right pull-right">
				@if (Auth::check())
				Welcome <a href="/users/{{ Auth::user()->id }}">{{ Auth::user()->first_name }}</a>! | <a href="/auth/logout">logout</a>
				@elseif (!Auth::check())
				<a href="/auth/register/" class="btn btn-default">Register</a>
				<a href="/auth/login/" class="btn btn-default">Login</a>
				@endif
			</div>
		</div>
	</div>
</div>
