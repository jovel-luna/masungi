<header class="position-fixed fixed-top desktop @if($checker->route->areOnRoutes(['web.home'])) changeHeader @endif" >
	<nav class="navbar navbar-expand-lg">
		<a class="navbar-brand" href="{{ route('web.home') }}">
			<img src="/images/images/icons/logo.png" class="rounded">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		
			<ul class="navbar-nav mx-auto">
				<li class="nav-item">
					<a class="nav-link" href="{{ route('web.home') }}">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link">Destination</a>
					<ul class="nav-sub">
						<a href="{{ route('web.about') }}"><li class="nav-subLink">About Us</li></a>
						<a href="{{ route('web.gettingHere') }}"><li class="nav-subLink">Getting Here</li></a>
						<a href="{{ route('web.theArea') }}"><li class="nav-subLink">The Area</li></a>
						<a href="{{ route('web.travelInformation') }}"><li class="nav-subLink">Travel Information</li></a>
					</ul>
				</li>
				<li class="nav-item">
					<a class="nav-link">Experience</a>
					<ul class="nav-sub">
						@foreach($trails as $trail)
					
						<a href="{{ route('web.trails', [$trail->id, $trail->name]) }}">
						<li class="nav-subLink">{{ $trail->name }}</li>
						{{-- <li class="nav-subLink">{{ $trail->renderExperience() }}</li> --}}
						@endforeach
						</a>
						{{-- <a href="{{ route('web.familyTrail') }}"><li class="nav-subLink">Family Trail</li></a>
						<a href="{{ route('web.legacyTrail') }}"><li class="nav-subLink">Legacy Trail</li></a>
						<a href="{{ route('web.dining') }}"><li class="nav-subLink">Dining</li></a> --}}
						<a href="{{ route('web.beyondMasungi') }}"><li class="nav-subLink">Beyond Masungi</li></a>
					</ul>
				</li>
				<li class="nav-item">
					<a class="nav-link">Events</a>
					<ul class="nav-sub">
						@foreach($events as $event)					
						<a href="{{ route('web.events', [$event->id, $event->name]) }}">
						<li class="nav-subLink">{{ $event->name }}</li>
						@endforeach
						</a>

						{{-- <a href="{{ route('web.companyEvents') }}"><li class="nav-subLink">Company Events</li></a> --}}
						{{-- <a href="{{ route('web.schoolVisits') }}"><li class="nav-subLink">School Visits</li></a> --}}
						<a href="{{ route('web.weddings') }}"><li class="nav-subLink">Weddings</li></a>

						{{-- <a href="{{ route('web.birdWatching') }}"><li class="nav-subLink">Bird Watching</li></a> --}}
					</ul>
				</li>
				<li class="nav-item">
					<a class="nav-link to-mob" href="{{ route('web.georeserve') }}">Georeserve Policies</a>
				</li>
				<li class="nav-item">
					<a class="nav-link to-mob" href="{{ route('web.contactus') }}">Contact Us</a>
				</li>
				<li class="nav-item">
					<a class="nav-link">More</a>
					<ul class="nav-sub">
						<a href="{{ route('web.georeserve') }}" class="to-mob"><li class="nav-subLink">Georeserve Policies</li></a>
						<a href="{{ route('web.contactus') }}" class="to-mob"><li class="nav-subLink">Contact Us</li></a>
						<a href="{{ route('web.gallery') }}"><li class="nav-subLink">Gallery</li></a>
						<a href="{{ route('web.projects') }}"><li class="nav-subLink">Projects & Collaborators</li></a>
						<a href="{{ route('web.research') }}"><li class="nav-subLink">Research</li></a>
						<a href="{{ route('web.informationKits') }}"><li class="nav-subLink">Information Kits</li></a>
						<a href="{{ route('web.news') }}"><li class="nav-subLink">News</li></a>
					</ul>
				</li>
				<li class="nav-item booking">
					<a href="{{ route('web.reservation') }}"><button class="button type-1 no-icon"><span>Request to Visit</span></button></a>
				</li>
			</ul>
		</div>
		
		<div class="nav-booking">
			<a href="{{ route('web.reservation') }}"><button class="button type-1 no-icon"><span>Request to Visit</span></button></a>
		</div>
	</nav>
</header>
