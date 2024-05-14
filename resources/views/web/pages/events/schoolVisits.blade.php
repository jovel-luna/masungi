@extends('web.master')

@section('content')

<section class="page-innerFrame bg-white event-fr1 frame1">
	<div class="page-container">
		<div class="width--90 margin-a">
			<div class="page-innerFrame__title align-c">
				<h5 class="slideUp">{{ $pageItems['frame_1_title'] }}</h5>
				<h1 class="slideUp">{{ $pageItems['frame_1_subtitle'] }}</h1>
			</div>
			<div class="page-general width--80 margin-a fadeIn">
				<p>{!! $pageItems['frame_1_content_one']!!}</p>

			</div>
		</div>
	</div>
</section>
<section class="page-frame bg-white event-fr2 trail-fr1 school-fr2">
	<div class="page-container">
		<div class="margin-a width--80 event__tabParent fadeIn">
			<div class="event__tabList active">
				<p>Discovery Trail</p>
			</div>
			<div class="event__tabList">
				<p>Legacy Trail</p>
			</div>
			<div class="event__tabList">
				<p>Family Trail</p>
			</div>
			<div class="event__tabList">
				<p>Young Explorers Trail</p>
			</div>
			<div class="to-mob">
				<select class="select">
					<option>Discovery Trail</option>
					<option>Legacy Trail</option>
					<option>Family Trail</option>
					<option>Young Explorers Trail</option>
				</select>
			</div>
		</div>
	</div>
	<div class="event__tabChild">
		{{-- DISCOVERIES --}}
		<div class="event-fr2__sliderCon slide__options active">
			<div class="event-fr2__slider2Con active">
				{{-- COMPONENT_SLIDER_LIST --}}
				
				@foreach($discoveriescarousel as $discoveriescarousel)
				<div class="event-fr2__sliderList">
					<div class="event-fr2__ImgCon slideUp" style="background-image: url('{{ $discoveriescarousel['image_path'] }}')"></div>
				</div>
				@endforeach

				{{-- END_COMPONENT_SLIDER_LIST --}}
			</div>
			<div class="trail-fr1__bannerCon fadeIn">
				@foreach($discoveries as $discovery)
					<div class="trail-fr1__textCon width--90">
						<div class="trail-fr1__ftrList inlineBlock-parent">
							<div class="trail-fr1__svgCon align-t">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M10 0C4.486 0 0 4.486 0 10C0 15.514 4.486 20 10 20C15.514 20 20 15.514 20 10C20 4.486 15.514 0 10 0ZM10 17.8722C5.65933 17.8722 2.12762 14.3409 2.12762 10C2.12762 5.65912 5.65933 2.12783 10 2.12783C14.3407 2.12783 17.8724 5.65912 17.8724 10C17.8724 14.3409 14.3407 17.8722 10 17.8722Z" fill="#675F3A"/>
								<path d="M15.2116 9.6912H10.7176V4.28774C10.7176 3.83303 10.3489 3.46436 9.89418 3.46436C9.43947 3.46436 9.0708 3.83303 9.0708 4.28774V10.5146C9.0708 10.9693 9.43947 11.338 9.89418 11.338H15.2116C15.6663 11.338 16.035 10.9693 16.035 10.5146C16.035 10.0599 15.6663 9.6912 15.2116 9.6912Z" fill="#675F3A"/>
								</svg>
							</div>
							<div class="trail-fr1__ftrTextCon">
								<h6 class="type-gray bold">Duration</h6>
								<h6>{{ $discovery['duration'] }}</h6>
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
								<h6>{{ $discovery['age_group'] }}</h6>
							</div>
						</div>
						<div class="trail-fr1__ftrList inlineBlock-parent">
							<div class="trail-fr1__svgCon align-t">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M17.0711 12.9289C15.9819 11.8398 14.6855 11.0335 13.2711 10.5454C14.786 9.50199 15.7812 7.75578 15.7812 5.78125C15.7812 2.59348 13.1878 0 10 0C6.81223 0 4.21875 2.59348 4.21875 5.78125C4.21875 7.75578 5.21402 9.50199 6.72898 10.5454C5.31453 11.0335 4.01813 11.8398 2.92895 12.9289C1.0402 14.8177 0 17.3289 0 20H1.5625C1.5625 15.3475 5.34754 11.5625 10 11.5625C14.6525 11.5625 18.4375 15.3475 18.4375 20H20C20 17.3289 18.9598 14.8177 17.0711 12.9289ZM10 10C7.67379 10 5.78125 8.1075 5.78125 5.78125C5.78125 3.455 7.67379 1.5625 10 1.5625C12.3262 1.5625 14.2188 3.455 14.2188 5.78125C14.2188 8.1075 12.3262 10 10 10Z" fill="#675F3A"/>
								</svg>
							</div>
							<div class="trail-fr1__ftrTextCon">
								<h6 class="type-gray bold">Participants / Groups</h6>
								<h6>{{ $discovery['participants'] }}</h6>
							</div>
						</div>
					</div>
					<div class="page-container page-frame">
						<div class="margin-a width--70 page-general align-c school-fr2__infoCon fadeIn">
							<h2>{{ $discovery['name'] }}</h2>
							<p>{!! $discovery['description'] !!}</p>
							<br>
							<h5>Conservation Fees:</h5>
							<p>{!! $discovery['conservation_fees'] !!}</p>
						</div>
					</div>
				@endforeach
			</div>
		</div>

		{{-- LEGACIES --}}
		<div class="event-fr2__sliderCon slide__options active">
			<div class="event-fr2__slider2Con active">
				@foreach($legaciescarousel as $legaciescarousel)
				<div class="event-fr2__sliderList">
					<div class="event-fr2__ImgCon slideUp" style="background-image: url('{{ $legaciescarousel['image_path'] }}')"></div>
				</div>
				@endforeach
			</div>
			<div class="trail-fr1__bannerCon fadeIn">
				@foreach($legacies as $legacy)
					<div class="trail-fr1__textCon width--90">
						<div class="trail-fr1__ftrList inlineBlock-parent">
							<div class="trail-fr1__svgCon align-t">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M10 0C4.486 0 0 4.486 0 10C0 15.514 4.486 20 10 20C15.514 20 20 15.514 20 10C20 4.486 15.514 0 10 0ZM10 17.8722C5.65933 17.8722 2.12762 14.3409 2.12762 10C2.12762 5.65912 5.65933 2.12783 10 2.12783C14.3407 2.12783 17.8724 5.65912 17.8724 10C17.8724 14.3409 14.3407 17.8722 10 17.8722Z" fill="#675F3A"/>
								<path d="M15.2116 9.6912H10.7176V4.28774C10.7176 3.83303 10.3489 3.46436 9.89418 3.46436C9.43947 3.46436 9.0708 3.83303 9.0708 4.28774V10.5146C9.0708 10.9693 9.43947 11.338 9.89418 11.338H15.2116C15.6663 11.338 16.035 10.9693 16.035 10.5146C16.035 10.0599 15.6663 9.6912 15.2116 9.6912Z" fill="#675F3A"/>
								</svg>
							</div>
							<div class="trail-fr1__ftrTextCon">
								<h6 class="type-gray bold">Duration</h6>
								<h6> {{ $legacy['duration'] }} </h6>
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
								<h6>{{ $legacy['age_group'] }}</h6>
							</div>
						</div>

						<div class="trail-fr1__ftrList inlineBlock-parent">
							<div class="trail-fr1__svgCon align-t">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M17.0711 12.9289C15.9819 11.8398 14.6855 11.0335 13.2711 10.5454C14.786 9.50199 15.7812 7.75578 15.7812 5.78125C15.7812 2.59348 13.1878 0 10 0C6.81223 0 4.21875 2.59348 4.21875 5.78125C4.21875 7.75578 5.21402 9.50199 6.72898 10.5454C5.31453 11.0335 4.01813 11.8398 2.92895 12.9289C1.0402 14.8177 0 17.3289 0 20H1.5625C1.5625 15.3475 5.34754 11.5625 10 11.5625C14.6525 11.5625 18.4375 15.3475 18.4375 20H20C20 17.3289 18.9598 14.8177 17.0711 12.9289ZM10 10C7.67379 10 5.78125 8.1075 5.78125 5.78125C5.78125 3.455 7.67379 1.5625 10 1.5625C12.3262 1.5625 14.2188 3.455 14.2188 5.78125C14.2188 8.1075 12.3262 10 10 10Z" fill="#675F3A"/>
								</svg>
							</div>
							<div class="trail-fr1__ftrTextCon">
								<h6 class="type-gray bold"> Participants / Group </h6>
								<h6>{{ $legacy['participants'] }}</h6>
							</div>
						</div>
					</div>
					<div class="page-container page-frame">
						<div class="margin-a width--70 page-general align-c school-fr2__infoCon fadeIn">
							<h2>{{ $legacy['name'] }}</h2>
							<p>{!! $legacy['description'] !!}</p>
							<br>
							<h5>Conservation Fees:</h5>
							<p>{!! $legacy['conservation_fees'] !!}</p>
						</div>
					</div>		
				@endforeach
			</div>
		</div>

		{{-- FAMILIES --}}
		<div class="event-fr2__sliderCon slide__options active">
			<div class="event-fr2__slider2Con active">
				@foreach($familiescarousel as $familiescarousel)
				<div class="event-fr2__sliderList">
					<div class="event-fr2__ImgCon slideUp" style="background-image: url('{{ $familiescarousel['image_path'] }}')"></div>
				</div>
				@endforeach
			</div>
			<div class="trail-fr1__bannerCon fadeIn">
				@foreach($families as $family)
					<div class="trail-fr1__textCon width--90">
						<div class="trail-fr1__ftrList inlineBlock-parent">
							<div class="trail-fr1__svgCon align-t">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M10 0C4.486 0 0 4.486 0 10C0 15.514 4.486 20 10 20C15.514 20 20 15.514 20 10C20 4.486 15.514 0 10 0ZM10 17.8722C5.65933 17.8722 2.12762 14.3409 2.12762 10C2.12762 5.65912 5.65933 2.12783 10 2.12783C14.3407 2.12783 17.8724 5.65912 17.8724 10C17.8724 14.3409 14.3407 17.8722 10 17.8722Z" fill="#675F3A"/>
								<path d="M15.2116 9.6912H10.7176V4.28774C10.7176 3.83303 10.3489 3.46436 9.89418 3.46436C9.43947 3.46436 9.0708 3.83303 9.0708 4.28774V10.5146C9.0708 10.9693 9.43947 11.338 9.89418 11.338H15.2116C15.6663 11.338 16.035 10.9693 16.035 10.5146C16.035 10.0599 15.6663 9.6912 15.2116 9.6912Z" fill="#675F3A"/>
								</svg>
							</div>
							<div class="trail-fr1__ftrTextCon">
								<h6 class="type-gray bold">Duration</h6>
								<h6>{{ $family['duration'] }}</h6>
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
								<h6>{{ $family['age_group'] }}</h6>
							</div>
						</div>
						<div class="trail-fr1__ftrList inlineBlock-parent">
							<div class="trail-fr1__svgCon align-t">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M17.0711 12.9289C15.9819 11.8398 14.6855 11.0335 13.2711 10.5454C14.786 9.50199 15.7812 7.75578 15.7812 5.78125C15.7812 2.59348 13.1878 0 10 0C6.81223 0 4.21875 2.59348 4.21875 5.78125C4.21875 7.75578 5.21402 9.50199 6.72898 10.5454C5.31453 11.0335 4.01813 11.8398 2.92895 12.9289C1.0402 14.8177 0 17.3289 0 20H1.5625C1.5625 15.3475 5.34754 11.5625 10 11.5625C14.6525 11.5625 18.4375 15.3475 18.4375 20H20C20 17.3289 18.9598 14.8177 17.0711 12.9289ZM10 10C7.67379 10 5.78125 8.1075 5.78125 5.78125C5.78125 3.455 7.67379 1.5625 10 1.5625C12.3262 1.5625 14.2188 3.455 14.2188 5.78125C14.2188 8.1075 12.3262 10 10 10Z" fill="#675F3A"/>
								</svg>
							</div>
							<div class="trail-fr1__ftrTextCon">
								<h6 class="type-gray bold">Participants / Groups</h6>
								<h6>{{ $family['participants'] }}</h6>
							</div>
						</div>
					</div>
					<div class="page-container page-frame">
						<div class="margin-a width--70 page-general align-c school-fr2__infoCon fadeIn">
							<h2>{{ $family['name'] }}</h2>
							<p>{!! $family['description'] !!}</p>
							<br>
							<h5>Conservation Fees:</h5>
							<p>{!! $family['conservation_fees'] !!}</p>
						</div>
					</div>
				@endforeach
			</div>
		</div>

		{{-- YOUNGS --}}
		<div class="event-fr2__sliderCon slide__options active">
			<div class="event-fr2__slider2Con active">
			@foreach($youngscarousel as $youngscarousel)
				<div class="event-fr2__sliderList">
					<div class="event-fr2__ImgCon slideUp" style="background-image: url('{{ $youngscarousel['image_path'] }}')"></div>
				</div>
				@endforeach
			</div>
			<div class="trail-fr1__bannerCon fadeIn">
				@foreach($youngs as $young)
					<div class="trail-fr1__textCon width--90">
						<div class="trail-fr1__ftrList inlineBlock-parent">
							<div class="trail-fr1__svgCon align-t">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M10 0C4.486 0 0 4.486 0 10C0 15.514 4.486 20 10 20C15.514 20 20 15.514 20 10C20 4.486 15.514 0 10 0ZM10 17.8722C5.65933 17.8722 2.12762 14.3409 2.12762 10C2.12762 5.65912 5.65933 2.12783 10 2.12783C14.3407 2.12783 17.8724 5.65912 17.8724 10C17.8724 14.3409 14.3407 17.8722 10 17.8722Z" fill="#675F3A"/>
								<path d="M15.2116 9.6912H10.7176V4.28774C10.7176 3.83303 10.3489 3.46436 9.89418 3.46436C9.43947 3.46436 9.0708 3.83303 9.0708 4.28774V10.5146C9.0708 10.9693 9.43947 11.338 9.89418 11.338H15.2116C15.6663 11.338 16.035 10.9693 16.035 10.5146C16.035 10.0599 15.6663 9.6912 15.2116 9.6912Z" fill="#675F3A"/>
								</svg>
							</div>
							<div class="trail-fr1__ftrTextCon">
								<h6 class="type-gray bold">Duration</h6>
								<h6> {{ $young['duration'] }} </h6>
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
								<h6>{{ $young['age_group'] }}</h6>
							</div>
						</div>

						<div class="trail-fr1__ftrList inlineBlock-parent">
							<div class="trail-fr1__svgCon align-t">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M17.0711 12.9289C15.9819 11.8398 14.6855 11.0335 13.2711 10.5454C14.786 9.50199 15.7812 7.75578 15.7812 5.78125C15.7812 2.59348 13.1878 0 10 0C6.81223 0 4.21875 2.59348 4.21875 5.78125C4.21875 7.75578 5.21402 9.50199 6.72898 10.5454C5.31453 11.0335 4.01813 11.8398 2.92895 12.9289C1.0402 14.8177 0 17.3289 0 20H1.5625C1.5625 15.3475 5.34754 11.5625 10 11.5625C14.6525 11.5625 18.4375 15.3475 18.4375 20H20C20 17.3289 18.9598 14.8177 17.0711 12.9289ZM10 10C7.67379 10 5.78125 8.1075 5.78125 5.78125C5.78125 3.455 7.67379 1.5625 10 1.5625C12.3262 1.5625 14.2188 3.455 14.2188 5.78125C14.2188 8.1075 12.3262 10 10 10Z" fill="#675F3A"/>
								</svg>
							</div>
							<div class="trail-fr1__ftrTextCon">
								<h6 class="type-gray bold"> Participants / Group </h6>
								<h6>{{ $young['participants'] }}</h6>
							</div>
						</div>
					</div>
					<div class="page-container page-frame">
						<div class="margin-a width--70 page-general align-c school-fr2__infoCon fadeIn">
							<h2>{{ $young['name'] }}</h2>
							<p>{!! $young['description'] !!}</p>
							<br>
							<h5>Conservation Fees:</h5>
							<p>{!! $young['conservation_fees'] !!}</p>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
		{{-- END_DELETE_ME --}}

	{{-- <div class="page-container">
		<div class="margin-a width--70 page-general align-c school-fr2__infoCon fadeIn">
			<h2>Young Explorers Discovery Trail</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			<br>
			<h5>Conservation Fees:</h5>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
		</div>
	</div> --}}
</section>
<section class="page-frame bg-dullWhite event-fr3 fadeIn">
	<div class="page-container inlineBlock-parent align-c">
		<a href="http://www.africau.edu/images/default/sample.pdf" target="blank"><button class="button type-1 s-margin-lr"><span>School Visits Brochure</span><img src="../images/images/icons/arrow.png"></button></a>
		<a href="http://www.africau.edu/images/default/sample.pdf" target="blank"><button class="button type-1 s-margin-lr"><span>Events and Meeting Spaces</span><img src="../images/images/icons/arrow.png"></button></a>
	</div>
</section>
<section class="page-frame event-fr4 school-fr4">
	<div class="page-container">
		<div class="page-general width--90 margin-a m-margin-b align-c">
			<h2 class="slideUp">Contact Us</h2>
			<p class="fadeIn">Kindly supply the following information and our Partnerships Officers will get back to you.</p>
		</div>
		<div class="page-general width--90 margin-a">
			<school-visit-form
				store-url="{{ route('web.inquiry.school-inquiry') }}"
				:trails="{{ $trails }}"
			></school-visit-form>
		</div>
	</div>
</section>
<section class="page-frame event-fr5 page-lastFrame">
	<div class="page-container">
		<div class="page-general width--90 margin-a align-c">
			<h2 class="slideUp">Previous Guests</h2>
			<div class="inlineBlock-parent l-margin-t event-fr5__logoCon">
		@foreach($previousguests as $previousguest)	
				{{-- TO_BE_DEV_pa_delete_ng_logos_public/images/images_thanks --}}
				<img src="{{ $previousguest['image_path'] }}">
		@endforeach

			</div>	
		</div>
	</div>
</section>

@endsection