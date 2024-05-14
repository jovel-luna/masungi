@extends('web.master')

@section('content')

<section class="page-innerFrame bg-white trail-fr1 frame1">
	<div class="page-container">
		<div class="width--90 margin-a">
			<div class="page-innerFrame__title align-c">
				<h5 class="slideUp">Experiences</h5>
				<h1 class="slideUp">{{ $trail->renderExperience() }}</h1>
			</div>
			<div class="trail-fr1__bannerCon">
				<div class="trail-fr1__ImgCon slideUp" style="background-image: url({{ $trail->fullpath }})"></div>
				{{-- COMPONENT_FOR_TRAILS --}}
				<div class="trail-fr1__textCon width--90 fadeIn">
					<div class="trail-fr1__ftrList inlineBlock-parent">
						<div class="trail-fr1__svgCon align-t">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10 0C4.486 0 0 4.486 0 10C0 15.514 4.486 20 10 20C15.514 20 20 15.514 20 10C20 4.486 15.514 0 10 0ZM10 17.8722C5.65933 17.8722 2.12762 14.3409 
							2.12762 10C2.12762 5.65912 5.65933 2.12783 10 2.12783C14.3407 2.12783 17.8724 5.65912 17.8724 10C17.8724 14.3409 14.3407 17.8722 10 17.8722Z" fill="#675F3A"/>
							<path d="M15.2116 9.6912H10.7176V4.28774C10.7176 3.83303 10.3489 3.46436 9.89418 3.46436C9.43947 3.46436 9.0708 3.83303 9.0708 4.28774V10.5146C9.0708 10.9693 9.43947 11.338 9.89418 11.338H15.2116C15.6663 11.338 16.035 10.9693 16.035 10.5146C16.035 10.0599 15.6663 9.6912 15.2116 9.6912Z" fill="#675F3A"/>
							</svg>
						</div>
						<div class="trail-fr1__ftrTextCon">
							<h6 class="type-gray bold">Duration</h6>
							<h6>{{ $trail->estimated_duration }}</h6>
						</div>
					</div>
					<div class="trail-fr1__ftrList inlineBlock-parent">
						<div class="trail-fr1__svgCon align-t">
							<svg width="31" height="21" viewBox="0 0 31 21" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M22.3605 6.94211L22.361 6.94291L29.6527 18.6096C29.7671 18.7927 29.8304 19.0031 29.836 19.2189C29.8415 19.4347 29.7891 19.6481 29.6843 19.8368C29.5794 20.0255 29.4259 20.1827 29.2398 20.292C29.0536 20.4013 28.8415 20.4588 28.6256 20.4583H28.6251H2.37599C2.16471 20.4569 1.95749 20.4002 1.77498 20.2937C1.59231 20.1872 1.4408 20.0345 1.3356 19.851C1.23041 19.6675 1.17522 19.4597 1.17554 19.2482C1.17586 19.0369 1.23159 18.8293 1.33717 18.6463C1.33726 18.6461 1.33735 18.646 1.33744 18.6458L11.5443 1.1484C11.5444 1.14816 11.5446 1.14792 11.5447 1.14768C11.6517 0.967689 11.8036 0.818581 11.9855 0.714973C12.1677 0.611226 12.3738 0.556671 12.5834 0.556671C12.7931 0.556671 12.9992 0.611226 13.1813 0.714973C13.3634 0.818661 13.5154 0.967921 13.6224 1.1481C13.6225 1.1482 13.6225 1.1483 13.6226 1.1484L18.42 9.31413L18.6309 9.67313L18.8486 9.31822L20.3063 6.94211C20.3065 6.94191 20.3066 6.94172 20.3067 6.94152C20.4151 6.76693 20.5661 6.62284 20.7457 6.52289C20.9254 6.42282 21.1277 6.3703 21.3334 6.3703C21.5391 6.3703 21.7415 6.42282 21.9212 6.52289C22.1009 6.62295 22.2521 6.76725 22.3605 6.94211ZM13.2397 18.0417H13.3788L13.4522 17.9234L17.0688 12.0901L17.1482 11.962L17.072 11.8319L12.7991 4.54026L12.5831 4.17169L12.3676 4.54051L4.69676 17.6655L4.47692 18.0417H4.9126H13.2397ZM16.4563 17.6567L16.2094 18.0417H16.6668H26.0001H26.4516L26.212 17.659L21.5453 10.2069L21.328 9.8599L21.1186 10.2117L19.6624 12.6581L16.4563 17.6567Z" fill="#675F3A" stroke="white" stroke-width="0.5"/>
							</svg>
						</div>
						<div class="trail-fr1__ftrTextCon">
							<h6 class="type-gray bold">Terrain</h6>
							<h6>{{ $trail->terrain }}</h6>
						</div>
					</div>
					<div class="trail-fr1__ftrList inlineBlock-parent">
						<div class="trail-fr1__svgCon align-t">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M17.0711 12.9289C15.9819 11.8398 14.6855 11.0335 13.2711 10.5454C14.786 9.50199 15.7812 7.75578 15.7812 5.78125C15.7812 2.59348 13.1878 0 10 0C6.81223 0 4.21875 2.59348 4.21875 5.78125C4.21875 7.75578 5.21402 9.50199 6.72898 10.5454C5.31453 11.0335 4.01813 11.8398 2.92895 12.9289C1.0402 14.8177 0 17.3289 0 20H1.5625C1.5625 15.3475 5.34754 11.5625 10 11.5625C14.6525 11.5625 18.4375 15.3475 18.4375 20H20C20 17.3289 18.9598 14.8177 17.0711 12.9289ZM10 10C7.67379 10 5.78125 8.1075 5.78125 5.78125C5.78125 3.455 7.67379 1.5625 10 1.5625C12.3262 1.5625 14.2188 3.455 14.2188 5.78125C14.2188 8.1075 12.3262 10 10 10Z" fill="#675F3A"/>
							</svg>
						</div>
						<div class="trail-fr1__ftrTextCon">
							<h6 class="type-gray bold">Age group</h6>
							<h6>{{ $trail->age_group }} - up</h6>
						</div>
					</div>
					<div class="trail-fr1__ftrList inlineBlock-parent">
						<div class="trail-fr1__svgCon align-t">
							<svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M16.4243 7.27333H15.1469C15.1897 6.97612 15.2122 6.67248 15.2122 6.36364C15.2122 6.05521 15.1897 5.75194 15.1471 5.45515H16.4243C16.9264 5.45515 17.3334 5.04812 17.3334 4.54606C17.3334 4.044 16.9264 3.63697 16.4243 3.63697H14.5976C13.5746 1.48861 11.3823 0 8.84857 0C8.83596 0 8.82335 0.000242424 8.81081 0.000787879H3.39869C3.39711 0.000787879 3.3956 0.000545455 3.39402 0.000545455C2.89196 0.000545455 2.48493 0.407576 2.48493 0.909636V0.909879V3.63697H1.57584C1.07378 3.63697 0.666748 4.044 0.666748 4.54606C0.666748 5.04812 1.07378 5.45515 1.57584 5.45515H2.48493V7.27333H1.57584C1.07378 7.27333 0.666748 7.68036 0.666748 8.18242C0.666748 8.68448 1.07378 9.09152 1.57584 9.09152H2.48493V11.8182V19.0909C2.48493 19.593 2.89196 20 3.39402 20C3.89608 20 4.30311 19.593 4.30311 19.0909V12.7273H8.84857C11.3818 12.7273 13.5738 11.2392 14.5971 9.09152H16.4243C16.9264 9.09152 17.3334 8.68448 17.3334 8.18242C17.3334 7.68036 16.9264 7.27333 16.4243 7.27333ZM4.30311 1.81897H8.84857C8.86008 1.81897 8.8716 1.81879 8.88299 1.8183C10.3531 1.82927 11.6589 2.54194 12.4826 3.63697H4.30311V1.81897ZM4.30311 5.45515H13.3027C13.3625 5.74879 13.394 6.05261 13.394 6.36364C13.394 6.67509 13.3624 6.97927 13.3024 7.27333H4.30311V5.45515ZM8.84857 10.9091H4.30311V9.09152H12.482C11.6518 10.1944 10.3322 10.9091 8.84857 10.9091Z" fill="#675F3A"/>
							</svg>
						</div>
						<div class="trail-fr1__ftrTextCon">
							<h6 class="type-gray bold">Conservation Fees</h6>
							<h6>Php {{ $trail->weekday_fee }}/guest on weekdays</h6>
							<h6>Php {{ $trail->weekend_fee }}/guest on weekends</h6>
						</div>
					</div>
				</div>
				{{-- END_COMPONENT_FOR_TRAILS --}}
			</div>
		</div>
	</div>
</section>
<section class="page-frame bg-white trail-fr2 page-lastFrame">
	<trail-selection 
		contact-us-url="{{ route('web.contactus') }}"
		:trail="{{ $trail }}"
		:trail-stops="{{ $trail->trailStops }}"
	></trail-selection>
</section>
<section class="page-frame bg-white trail-fr3">
	<div class="page-container page-general align-c">
		<a href="{{ route('web.reservation') }}"><h2 class="slideUp">Request to Visit</h2></a>
		<a href="{{ route('web.reservation') }}"><button class="button type-1 fadeIn"><span>Request to Visit</span><img src="../images/images/icons/arrow.png"></button></a>
	</div>
	<div class="page__bgOverlay"></div>
	<div class="trail-fr3__bgCon" style="background-image: url('images/images/About-Us1.png')"></div>
</section>

@endsection