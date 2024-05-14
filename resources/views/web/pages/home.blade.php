@extends('web.master')

@section('meta:title', $page->renderMeta('title'))
@section('meta:description', $page->renderMeta('description'))
@section('meta:keywords', $page->renderMeta('keywords'))
@section('og:image', $page->renderMetaImage())
@section('og:title', $page->renderMeta('og_title'))
@section('og:description', $page->renderMeta('og_description'))

@section('content')

<section class="hm-fr1 frame1">
	<div class="hm-fr1__bgCover" style="background-image: url('images/images/bg/Linear.png')"></div>
	<div class="hm-fr1__arrowCon">
		<svg id="hm-fr1__arrow1" width="21" height="13" viewBox="0 0 21 13" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M10.4999 12.4853C10.1236 12.4853 9.74726 12.3416 9.46032 12.0548L0.430797 3.02514C-0.143599 2.45075 -0.143599 1.51946 0.430797 0.945301C1.00496 0.371138 1.93606 0.371138 2.5105 0.945301L10.4999 8.93521L18.4894 0.945581C19.0638 0.371417 19.9948 0.371417 20.5689 0.945581C21.1436 1.51974 21.1436 2.45103 20.5689 3.02542L11.5396 12.055C11.2525 12.3419 10.8762 12.4853 10.4999 12.4853Z" fill="white"/>
		</svg>
		<svg id="hm-fr1__arrow2" width="21" height="13" viewBox="0 0 21 13" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M10.4999 12.4853C10.1236 12.4853 9.74726 12.3416 9.46032 12.0548L0.430797 3.02514C-0.143599 2.45075 -0.143599 1.51946 0.430797 0.945301C1.00496 0.371138 1.93606 0.371138 2.5105 0.945301L10.4999 8.93521L18.4894 0.945581C19.0638 0.371417 19.9948 0.371417 20.5689 0.945581C21.1436 1.51974 21.1436 2.45103 20.5689 3.02542L11.5396 12.055C11.2525 12.3419 10.8762 12.4853 10.4999 12.4853Z" fill="white"/>
		</svg>
	</div>
		{{-- DELETE_ME__STATIC_IMG__COMMENT_ME_TO_HIDE --}}
		{{-- <div class="hm-fr1__bgImg" style="background-image: url('images/images/bg/masungi_intro.jpg')"></div> --}}
		{{-- DELETE_ME__UNCOMMENT_ME_FOR_VIDEO --}}
		@foreach($homebanners as $homebanner)
		<video autoplay="" muted="" loop="" playsinline="" id="hm-fr1__vid" class="fullScreen" poster="{{$homebanner['image_path']}}">
			<source src="{{ $homebanner['image_path'] }}">
			<source src="{{ $homebanner['image_path'] }}">
			<p>Your browser does not support the <code>video</code> element </p>
		</video>
		@endforeach
	<section class="hm-fr2 page-frame slideUp">
		<home-reservation
			:trails="{{ json_encode($trails) }}"
		></home-reservation>
	</section>
</section>
<section class="hm-fr3 page-frame">
	<div class="page-container">
		<div class="width--80 align-c margin-a">
			<div class="page-frame__title slideUp">
				<h1>{{ $pageItems["frame_1_title"] }}</h1>
			</div>
			<div class="page-frame__desc fadeIn">
					{!! $pageItems["frame_1_content_one"] !!}
			</div>

			<div class="hm-fr3__sliderCon fadeIn">
				{{-- COMPONENT_SLIDER --}}
			  @foreach($oldnewmasungis as $oldnewmasungi)
				<div class="hm-fr3__sliderList">
					<div class="twentytwenty-container">					
						<img src="{{ $oldnewmasungi['new_image_path'] }}" />
						<img src="{{ $oldnewmasungi['old_image_path'] }}" />										
					</div>
				</div>
		  		@endforeach
			</div>
		</div>
	</div>
</section>
<section class="hm-fr4 page-frame">
	<div class="page-container">
		<div class="page-frame__title align-c slideUp">
			<h1>EXPERIENCES</h1>
		</div>
	</div>
	<div class="hm-fr4__sliderCon fadeIn">
		{{-- COMPONENT_SLIDER --}}
	  @foreach($experiences as $experience)
		<div class="hm-fr4__sliderList">
			<div class="hm-fr4__imgCon" style="background-image: url('{{ $experience['image_path'] }}')"></div>
			<div class="hm-fr4__textCon width--80 margin-a align-c">
				<h2>{{ $experience['name'] }}</h2> 
				{!! $experience['description'] !!}
			</div>
		</div>
		@endforeach
		{{-- END_COMPONENT_SLIDER --}}
	</div>
</section>
<section class="hm-fr5 page-frame">
	<div class="page-container to-mob">
		<div class="page-frame__title align-c slideUp">
			<h1>IMPACT</h1>
		</div>
	</div>
	<div class="hm-fr5__gridParent">
		{{-- COMPONENT_GRID --}}
		<div class="hm-fr5__gridChild">
			<div class="hm-fr5__imgCon" style="background-image: url('{{ $pageItems["frame_2_title_image"] }}')"></div>
			<div class="hm-fr5__textCon">
				<div>
					<h3> {!! $pageItems["frame_2_title"] !!} </h3>
				</div>
			</div>
		</div>
		{{-- END_COMPONENT_GRID --}}
		<div class="hm-fr5__gridChild">
			<div class="hm-fr5__imgCon" style="background-image: url('{{ $pageItems["frame_2_title_image_two"] }}')"></div>
			<div class="hm-fr5__textCon">
				<div>
					<h3> {!! $pageItems["frame_2_title_two"] !!} </h3>
				</div>
			</div>
		</div>
		<div class="hm-fr5__gridChild">
			<div class="hm-fr5__imgCon" style="background-image: url('{{ $pageItems["frame_2_title_image_three"] }}')"></div>
			<div class="hm-fr5__textCon">
				<div>
					<h3> {!! $pageItems["frame_2_title_three"] !!} </h3>
				</div>
			</div>
		</div>
		<div class="hm-fr5__gridChild">
			<div class="hm-fr5__imgCon" style="background-image: url('{{ $pageItems["frame_2_title_image_four"] }}')"></div>
			<div class="hm-fr5__textCon">
				<div>
					<h3> {!! $pageItems["frame_2_title_four"] !!} </h3>
				</div>
			</div>
		</div>
		<div class="hm-fr5__gridChild">
			<div class="hm-fr5__imgCon" style="background-image: url('{{ $pageItems["frame_2_title_image_five"] }}')"></div>
			<div class="hm-fr5__textCon">
				<div>
					<h3> {!! $pageItems["frame_2_title_five"] !!} </h3>
				</div>
			</div>
		</div>
		<div class="hm-fr5__gridChild">
			<div class="hm-fr5__imgCon" style="background-image: url('{{ $pageItems["frame_2_title_image_six"] }}')"></div>
			<div class="hm-fr5__textCon">
				<div>
					<h3> {!! $pageItems["frame_2_title_six"] !!} </h3>
				</div>
			</div>
		</div>
		{{-- END_DELETE_ME --}}
	</div>
</section>
<section class="hm-fr6 page-frame">
	<div class="page-container">
		<div class="page-frame__title align-c  slideUp">
			<h1>GALLERY</h1>
		</div>
	</div>
	<div class="hm-fr6__sliderCon">
		{{-- COMPONENT_SLIDER --}}
	  @foreach($galleries as $gallery)		
		<div class="hm-fr6__sliderList align-c">
			<div class="hm-fr5__imgCon" style="background-image: url('{{ $gallery['image_path'] }}')"></div>
			<p>{{ $gallery['name'] }}</p>
		</div
		>@endforeach
	</div>
	<div class="page-container align-c">
		<p class="type-2 font-2">Drag to slide</p>
	</div>
</section>
<section class="hm-fr7 page-frame">
	<div class="page-container">
		<div class="page-frame__title align-c slideUp">
			<h1>AWARDS</h1>
		</div>
		<div class="hm-fr7__sliderCon fadeIn">
			{{-- COMPONENT_SLIDER --}}
		  	@foreach($awards as $award)
			<div class="hm-fr7__sliderList">
				<div class="hm-fr7__imgCon" style="background-image: url('{{ $award['image_path'] }}')"></div>
				<p>{{ $award['title'] }}</p>

			</div
			>@endforeach
		</div>
		<div class="hm-fr7__sliderConFor fadeIn">
			@foreach($awards as $award)
			<div class="hm-fr7__sliderList">1</div>
			@endforeach
		</div>
	</div>
</section>
<section id="hm-fr8" class="hm-fr8 page-frame">
	<div class="page-container">
		<div class="page-frame__title align-c">
			<h1>NEWS</h1>
		</div>
		<news
			:news-list="{{ json_encode($newsitems) }}"
		></news>
	</div>
</section>
<section class="hm-fr9 page-frame">
	<div class="page-container">
		<div class="page-frame__title align-c slideUp">
			<h1>FEATURES</h1>
		</div>
		<div class="hm-fr9__sliderCon fadeIn">
			{{-- COMPONENT_SLIDER --}}
			 @foreach($features as $feature)
			<div class="hm-fr9__sliderList">
				<a href="{{ $feature['link'] }}" target="_blank">
				<div class="hm-fr9__imgCon" style="background-image: url('{{ $feature['image_path'] }}')"></div>
				</a>
			</div>
			{{-- END_COMPONENT_SLIDER --}}
			@endforeach
		</div>
	</div>
</section>
@endsection
