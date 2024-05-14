@extends('web.master')

@section('content')

<section class="page-innerFrame bg-white event-fr1 frame1">
	<div class="page-container">
		<div class="width--90 margin-a">
			<div class="page-innerFrame__title align-c">
				<h5 class="slideUp">{{ $pageItems['frame_1_title'] }}</h5>
				<h1 class="slideUp">{{ $event['name'] }}</h1>
			</div>
			<div class="page-general width--80 margin-a fadeIn">
				<p>{!! $event['description']!!}</p>
		</div>
	</div>
	</section>
<section class="page-frame bg-white event-fr2 trail-fr1">
	<div class="page-container">
		<div class="margin-a width--80 event__tabParent slideUp">
			@foreach($eventtypes as $eventtype)
			<div class="event__tabList">
				<p>{{ $eventtype['name'] }}</p>
			</div>
			@endforeach
			<div class="to-mob">
				<select class="select">
			@foreach($eventtypes as $eventtype)								
					<option>{{ $eventtype['name'] }}</option>
			@endforeach
				</select>
			</div>

		</div>
	</div>
	<div class="event__tabChild">
		@foreach($eventtypes as $eventtype)	
		{{-- COMPONENT_SLIDER_CONTAINER --}}
		<div class="event-fr2__sliderCon slide__options active">
			<div class="event-fr2__slider2Con active">
				{{-- COMPONENT_SLIDER_LIST --}}
				@foreach($eventcarousels as $eventcarousel)
				@if($eventcarousel['eventtype_id'] == $eventtype['id'])
				<div class="event-fr2__sliderList">
					<div class="event-fr2__ImgCon slideUp" style="background-image: url('{{ $eventcarousel['image_path'] }}')"></div>
				</div>
				@endif
				@endforeach
				{{-- END_COMPONENT_SLIDER_LIST --}}
			</div>	
			{{-- COMPONENT_FOR_TRAILS --}}
			<div class="trail-fr1__bannerCon width--70 margin-a fadeIn">
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
								<h6> {{ $eventtype['duration'] }} </h6>
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
								<h6> {{ $eventtype['age_group'] }} </h6>
							</div>
						</div>
						<div class="trail-fr1__ftrList inlineBlock-parent">
							<div class="trail-fr1__svgCon align-t">
								<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M17.0711 12.9289C15.9819 11.8398 14.6855 11.0335 13.2711 10.5454C14.786 9.50199 15.7812 7.75578 15.7812 5.78125C15.7812 2.59348 13.1878 0 10 0C6.81223 0 4.21875 2.59348 4.21875 5.78125C4.21875 7.75578 5.21402 9.50199 6.72898 10.5454C5.31453 11.0335 4.01813 11.8398 2.92895 12.9289C1.0402 14.8177 0 17.3289 0 20H1.5625C1.5625 15.3475 5.34754 11.5625 10 11.5625C14.6525 11.5625 18.4375 15.3475 18.4375 20H20C20 17.3289 18.9598 14.8177 17.0711 12.9289ZM10 10C7.67379 10 5.78125 8.1075 5.78125 5.78125C5.78125 3.455 7.67379 1.5625 10 1.5625C12.3262 1.5625 14.2188 3.455 14.2188 5.78125C14.2188 8.1075 12.3262 10 10 10Z" fill="#675F3A"/>
								</svg>
							</div>
							<div class="trail-fr1__ftrTextCon">
								<h6 class="type-gray bold">Participants</h6>
								<h6> {{ $eventtype['participants'] }} </h6>
							</div>
						</div>
						<div class="trail-fr1__ftrList inlineBlock-parent">
							<div class="trail-fr1__svgCon align-t">
								<svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M16.4243 7.27333H15.1469C15.1897 6.97612 15.2122 6.67248 15.2122 6.36364C15.2122 6.05521 15.1897 5.75194 15.1471 5.45515H16.4243C16.9264 5.45515 17.3334 5.04812 17.3334 4.54606C17.3334 4.044 16.9264 3.63697 16.4243 3.63697H14.5976C13.5746 1.48861 11.3823 0 8.84857 0C8.83596 0 8.82335 0.000242424 8.81081 0.000787879H3.39869C3.39711 0.000787879 3.3956 0.000545455 3.39402 0.000545455C2.89196 0.000545455 2.48493 0.407576 2.48493 0.909636V0.909879V3.63697H1.57584C1.07378 3.63697 0.666748 4.044 0.666748 4.54606C0.666748 5.04812 1.07378 5.45515 1.57584 5.45515H2.48493V7.27333H1.57584C1.07378 7.27333 0.666748 7.68036 0.666748 8.18242C0.666748 8.68448 1.07378 9.09152 1.57584 9.09152H2.48493V11.8182V19.0909C2.48493 19.593 2.89196 20 3.39402 20C3.89608 20 4.30311 19.593 4.30311 19.0909V12.7273H8.84857C11.3818 12.7273 13.5738 11.2392 14.5971 9.09152H16.4243C16.9264 9.09152 17.3334 8.68448 17.3334 8.18242C17.3334 7.68036 16.9264 7.27333 16.4243 7.27333ZM4.30311 1.81897H8.84857C8.86008 1.81897 8.8716 1.81879 8.88299 1.8183C10.3531 1.82927 11.6589 2.54194 12.4826 3.63697H4.30311V1.81897ZM4.30311 5.45515H13.3027C13.3625 5.74879 13.394 6.05261 13.394 6.36364C13.394 6.67509 13.3624 6.97927 13.3024 7.27333H4.30311V5.45515ZM8.84857 10.9091H4.30311V9.09152H12.482C11.6518 10.1944 10.3322 10.9091 8.84857 10.9091Z" fill="#675F3A"/>
								</svg>
							</div>
							<div class="trail-fr1__ftrTextCon">
								<h6 class="type-gray bold">Conversation Fees</h6>
								<h6>{!! $eventtype['conservation_fees'] !!}</h6>
							</div>
						</div>
					</div>
					<div class="page-container">
						<div class="margin-a width--100 page-general m-margin-t eventView-fr1 align-c">
							<h2 class="slideUp">{{ $eventtype['name'] }}</h2>
								<h2>{{ $eventtype['activity'] }}</h2>
							

							<div class="page-general width--100 margin-a align-l l-margin-t">
								{!! $eventtype['description'] !!}
							</div>
							<div class="page-general width--100 margin-a inlineBlock-parent eventView-fr1__textCon align-l">
								<div class="width--50 align-t">
									<h2>Features</h2>
									{!! $eventtype['features'] !!}
								</div
								><div class="width--50 align-t">
									<h2>Conservation Fees</h2>
									{!! $eventtype['conservation_info'] !!}
								</div>
							</div>
						</div>
					</div>
		    	</div>
			{{-- END_COMPONENT_FOR_TRAILS --}}
		</div>
		@endforeach	 
    </div>
</section>
<section class="page-frame bg-dullWhite event-fr3">
	<div class="page-container inlineBlock-parent align-c fadeIn">

		@foreach($eventpdfs as $eventpdf)		
		@if($eventpdf['event_id'] == $event['id'])				
		<a href="{{ $eventpdf['document_path']}}" target="_blank"><button class="button type-1 s-margin-lr"><span>{{ $eventpdf['name'] }}</span><img src="../images/images/icons/arrow.png"></button></a>
			
		@endif
		@endforeach


	</div>
</section>
<section class="page-frame event-fr4">
	<div class="page-container">
		<div class="page-general width--90 margin-a m-margin-b align-c">
			<h2 class="slideUp">Contact Us</h2>
			<p class="fadeIn">Kindly supply the following information and our Partnerships Officer will get back to you.</p>
		</div>

		@if($event['id'] == '1')		
		<div class="page-general width--90 margin-a">
			<company-inquiry-form
				store-url="{{ route('web.inquiry.company-inquiry') }}"
			></company-inquiry-form>
		</div>
		@elseif($event['id'] == '2')
		<div class="page-general width--90 margin-a">
			<school-visit-form
				store-url="{{ route('web.inquiry.school-inquiry') }}"
				:trails="{{ $trails }}"
			></school-visit-form>
		</div>
		@elseif($event['id'] != null)
		<div class="page-general width--90 margin-a l-margin-t">
				<contact-us-form
					store-url="{{ route('web.inquiry.contact-us') }}"
				></contact-us-form>
			</div>
		@endif
	</div>
</section>
<section class="page-frame event-fr5 page-lastFrame">
	<div class="page-container">
		<div class="page-general width--90 margin-a align-c">
			<h2 class="slideUp">Previous Guests</h2>
			<div class="inlineBlock-parent l-margin-t event-fr5__logoCon">
				@foreach($previousguests as $previousguest)
					<img src="{{ $previousguest['image_path'] }}">
				@endforeach
			</div>

		</div>
	</div>
</section>

@endsection