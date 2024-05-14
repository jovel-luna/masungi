@extends('web.master')

@section('meta:title', $page->renderMeta('title'))
@section('meta:description', $page->renderMeta('description'))
@section('meta:keywords', $page->renderMeta('keywords'))
@section('og:image', $page->renderMetaImage())
@section('og:title', $page->renderMeta('og_title'))
@section('og:description', $page->renderMeta('og_description'))

@section('content')

<section class="page-innerFrame bg-white about-fr1 frame1">
	<div class="page-container">
		<div class="width--90 margin-a">
			<div class="page-innerFrame__title align-c">
				<h5 class="slideUp">{{ $pageItems["frame_1_title"] }}</h5>
				<h1 class="slideUp">{{ $pageItems["frame_1_sub_title"] }}</h1>
			</div>
			<div class="page-general inlineBlock-parent">
				<div class="width--50 fadeIn">
					<div class="about-fr1__imgCon" style="background-image: url('{{ $pageItems["frame_1_image"] }}')"></div>
				</div
				><div class="width--50 fadeIn">
					<h2>{{ $pageItems["frame_1_content_title"]}} </h2>
					{!! $pageItems["frame_1_content_one"] !!}
				</div>
			</div>
		</div>
	</div>
</section>
<section class="page-frame bg-dullWhite about-fr2">
	<div class="page-container">
		<div class="width--70 margin-a page-general fadeIn">
			<h2> {{ $pageItems["frame_2_content_title"] }} </h2>

			{!!	 $pageItems["frame_2_content_one"] !!}
			<br>
			<h5> {{ $pageItems["frame_2_content_title_two"] }} </h5>
				 {!! $pageItems["frame_2_content_two"] !!}
			<br>
			<h5> {{ $pageItems["frame_2_content_title_three"] }} </h5>
			     {!! $pageItems["frame_2_content_three"] !!}		
		</div>
	</div>
</section>
<section class="bg-white about-fr3 page-lastFrame">
	
	<div class="about-fr3__sliderCon fadeIn">
		{{-- COMPONENT_SLIDER_LIST --}}
		@foreach($destinations as $destination)
		<div class="about-fr3__sliderList">
			<div class="about-fr3__imgCon" style="background-image: url('{{ $destination["image_path"] }}')"></div>
		</div>
		@endforeach
		
		{{-- END_COMPONENT_SLIDER_LIST --}}
		{{-- DELETE_ME --}}
{{-- 		<div class="about-fr3__sliderList">
			<div class="about-fr3__imgCon" style="background-image: url('http://egegorgulu.com/assets/img/beforeafter/before.jpg')"></div>
		</div>
		<div class="about-fr3__sliderList">
			<div class="about-fr3__imgCon" style="background-image: url('http://egegorgulu.com/assets/img/beforeafter/before.jpg')"></div>
		</div>
		<div class="about-fr3__sliderList">
			<div class="about-fr3__imgCon" style="background-image: url('http://egegorgulu.com/assets/img/beforeafter/before.jpg')"></div>
		</div>
		{{-- DELETE_ME --}} 
	</div>

	<div class="page-frame">
		<div class="page-container">
			<div class="width--70 margin-a">
				<div class="page-general fadeIn">
					<h2> {{ $pageItems["frame_3_content_title"] }} </h2>
						{!! $pageItems["frame_3_content_one"] !!}

				</div>
			</div>
			<div class="about-fr3__subSec">
				<div class="page-general l-margin-b align-c slideUp">
					<h2>{{ $pageItems["frame_4_content_title"] }}</h2>
				</div>
				<div class="width--90 margin-a page-grid grid-2 about-fr3__gridParent">
					<div class="about-fr3__gridChild">
					<div class="about-fr3__imgCon" style="background-image: url('{{ $pageItems["frame_4_content_image_one"] }}')"></div>
					<div class="about-fr3__textConPrev">
					  <h2>{{ $pageItems["frame_4_content_title_one"] }}</h2>
					</div>
					<div class="about-fr3__textCon">
					  <div>
					    <h2>{{ $pageItems["frame_4_content_title_one"] }}</h2>
					    <div class="about-fr3__text">					    
						{!! $pageItems["frame_4_content_one"] !!}
					    </div>
					  </div>
					</div>
					</div>
					<div class="about-fr3__gridChild">
					<div class="about-fr3__imgCon" style="background-image: url('{{ $pageItems["frame_4_content_image_two"] }}')"></div>
					<div class="about-fr3__textConPrev">
					  <h2>{{ $pageItems["frame_4_content_title_two"] }}</h2>
					</div>
					<div class="about-fr3__textCon">
					  <div>
					    <h2>{{ $pageItems["frame_4_content_title_two"] }}</h2>
					    <div class="about-fr3__text">					    
						{!! $pageItems["frame_4_content_two"] !!}
					    </div>
					  </div>
					</div>
					</div>
					<div class="about-fr3__gridChild">
					<div class="about-fr3__imgCon" style="background-image: url('{{ $pageItems["frame_4_content_image_three"] }}')"></div>
					<div class="about-fr3__textConPrev">
					  <h2>{{ $pageItems["frame_4_content_title_three"] }}</h2>
					</div>
					<div class="about-fr3__textCon">
					  <div>
					    <h2>{{ $pageItems["frame_4_content_title_three"] }}</h2>
					    <div class="about-fr3__text">					    
						{!! $pageItems["frame_4_content_three"] !!}
					    </div>
					  </div>
					</div>
					</div>
				
					<div class="about-fr3__gridChild">
					<div class="about-fr3__imgCon" style="background-image: url('{{ $pageItems["frame_4_content_image_four"] }}')"></div>
					<div class="about-fr3__textConPrev">
					  <h2>{{ $pageItems["frame_4_content_title_four"] }}</h2>
					</div>
					<div class="about-fr3__textCon">
					  <div>
					    <h2>{{ $pageItems["frame_4_content_title_four"] }}</h2>
					    <div class="about-fr3__text">					    
						{!! $pageItems["frame_4_content_four"] !!}
					    </div>
					  </div>
					</div>
					</div>
		
			</div>
		</div>
	</div>
</section>

@endsection