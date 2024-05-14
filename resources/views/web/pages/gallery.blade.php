@extends('web.master')

@section('content')

<section class="page-innerFrame bg-white event-fr1 gallery-fr1 frame1">
	<div class="page-container">
		<div class="width--90 margin-a">
			<div class="page-innerFrame__title align-c">
				<h5 class="slideUp">More</h5>
				<h1 class="slideUp">Gallery</h1>
			</div>
		</div>
	</div>
</section>
<section class="page-frame bg-white event-fr2 gallery-fr2 trail-fr1">
	<div class="page-container">
		<div class="margin-a width--80 event__tabParent fadeIn">
			<div class="event__tabList active">
				<p>Landscape</p>
			</div>
			<div class="event__tabList">
				<p>People</p>
			</div>
			<div class="event__tabList">
				<p>Wildlife</p>
			</div>
			<div class="event__tabList">
				<p>Moments</p>
			</div>
			<div class="to-mob">
				<select class="select">
					<option>Landscape</option>
					<option>People</option>
					<option>Wildlife</option>
					<option>Moments</option>
				</select>
			</div>
		</div>
	</div>
	<div class="event__tabChild">
		<div class="event-fr2__sliderCon slide__options active fadeIn">
			<div class="event-fr2__slider2Con active">
				{{-- COMPONENT_SLIDER_LIST --}}
				@foreach($landscapes as $landscape)
				<div class="event-fr2__sliderList">
					<div class="event-fr2__ImgCon" style="background-image: url('{{ $landscape['image_path'] }}')"></div>
				</div>
				@endforeach
				{{-- @foreach($landscapes as $landscape)
				<div class="event-fr2__sliderList">
					<div class="event-fr2__ImgCon" style="background-image: url('{{ $landscape['image_path'] }}')"></div>
					<div class="margin-a width--80 page-general align-c l-margin-t">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
					</div>
				</div>
				@endforeach --}}
			</div>
		</div>
	</div>
		<div class="event-fr2__sliderCon slide__options active fadeIn">
			<div class="event-fr2__slider2Con active">
				{{-- COMPONENT_SLIDER_LIST --}}
				@foreach($peoples as $people)
				<div class="event-fr2__sliderList">
					<div class="event-fr2__ImgCon" style="background-image: url('{{ $people['image_path'] }}')"></div>
				</div>
				@endforeach
			</div>
		</div>
		<div class="event-fr2__sliderCon slide__options active fadeIn">
			<div class="event-fr2__slider2Con active">
				{{-- COMPONENT_SLIDER_LIST --}}
				@foreach($wildlife as $wildlife)
				<div class="event-fr2__sliderList">
					<div class="event-fr2__ImgCon" style="background-image: url('{{ $wildlife['image_path'] }}')"></div>
				</div>
				@endforeach
			</div>
		</div>
		<div class="event-fr2__sliderCon slide__options active fadeIn">
			<div class="event-fr2__slider2Con active">
				{{-- COMPONENT_SLIDER_LIST --}}
				@foreach($moments as $moment)
				<div class="event-fr2__sliderList">
					<div class="event-fr2__ImgCon" style="background-image: url('{{ $moment['image_path'] }}')"></div>
				</div>
				@endforeach
			</div>
		</div>
		
</section>

@endsection