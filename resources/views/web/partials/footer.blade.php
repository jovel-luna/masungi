<footer>
	<div class="page-frame">
		<div class="page-container">
			<div class="width--90 ftr__topCon margin-a">
				<div class="ftr__col ftr__leftCon">
					<img src="/images/images/icons/logoText.png">
					<p><a href="https://www.waze.com/ul?ll=14.59384260%2C121.31752540&navigate=yes" target="_blank">Kilometer 47, Marcos Highway, Baras, Rizal, Philippines, 1970</a></p>
					<br>
					{{-- <p class="type-4"><span><a href="tel:+63 908 888 70 02" target="_blank">+63 908 888 70 02</a></span> | <span><a href="tel:+63 995 186 99 11" target="_blank">+63 995 186 99 11</a></span></p> --}}
					{{-- Removed globe number --}}
					<p class="type-4"><span><a href="tel:+63 908 888 70 02" target="_blank">+63 908 888 70 02</a></span></p>
					<p class="type-4">(8:00 AM - 5:00 PM Tuesdays to Sundays)</p>
					<br>
					<p><a href="mailto:trail@masungigeoreserve.com" target="_blank">trail@masungigeoreserve.com</a></p>
				</div
				><div class="ftr__col ftr__midCon">
					<h6 class="to-mob type-4">Quick Links</h6>
					<ul>
						<li class="to-mob"><h6 class="type-4">Quick Links</h6></li>
						<li class="to-mob"><br></li>
						<li><a class="ftr__link" href="{{ route('web.about') }}">About Us</a></li>
						<li><a class="ftr__link" href="{{ route('web.georeserve') }}">Georeserve Policies</a></li>
						<li><a class="ftr__link" href="{{ route('web.news') }}">News</a></li>

					@foreach($pdflinks as $pdflink)
							<li>
							<a href="{{ $pdflink->renderFilePath('document_path') }}" target="_blank"><li class="nav-subLink">{{ $pdflink->name }}</li></a>
					@endforeach
						<li><a class="ftr__link" href="{{ route('web.beyondMasungi') }}">Beyond Masungi</a></li>
						<li><a class="ftr__link" href="{{ route('web.contactus') }}">Contact Us</a></li>
						<li class="mb-5"><a class="ftr__link" href="{{ route('web.gettingHere') }}">Destination</a></li><br>

					@foreach($trails as $trail)
							<a href="{{ route('web.trails', [$trail->id, $trail->name]) }}"><li class="nav-subLink">{{ $trail->name }}</li></a>
							{{-- <a href="{{ route('web.trails', [$trail->id, $trail->name]) }}"><li class="nav-subLink">{{ $trail->renderExperience() }}</li></a> --}}
					@endforeach

						@foreach($events as $event)					
						<a href="{{ route('web.events', [$event->id, $event->name]) }}">
						<li class="nav-subLink">{{ $event->name }}</li>
						@endforeach

  						<li><a class="ftr__link" href="{{ route('web.weddings') }}">Weddings</a></li>
						<li><a class="ftr__link" href="{{ route('web.terms') }}">COVID-19 Safety</a></li>
						<li><a class="ftr__link" href="{{ route('web.privacy') }}">Privacy Policy</a></li>
					</ul>
				</div
				><div class="ftr__col ftr__rightCon">
					<newsletter-form
						store-url="{{ route('web.home.newsletters') }}"
					></newsletter-form>
					<div class="ftr__ssCon">
						<h6 class="type-4">Let's stay Connected</h6>
						<ul class="inlineBlock-parent">
							<li><a href="https://www.facebook.com/masungigeoreserve" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="https://twitter.com/MasungiGeo" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li><a href="https://www.instagram.com/masungigeoreserve/" target="_blank"><i class="fab fa-instagram"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="ftr__botCon align-c">
		<p class="type-4">&copy;MasungiGeoreserve{{ now()->year }}</p>
	</div>
</footer>