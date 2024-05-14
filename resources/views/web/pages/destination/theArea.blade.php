@extends('web.master')

@section('content')

<section class="page-innerFrame bg-white area-fr1 frame1">
	<div class="page-container">
		<div class="width--90 margin-a">
			<div class="page-innerFrame__title align-c">
				<h5 class="slideUp">{{ $pageItems["frame_1_title"] }}</h5>
				<h1 class="slideUp">{{ $pageItems["frame_1_sub_title"] }}</h1>
			</div>
			<div class="page-general width--80 margin-a fadeIn">
				<h2> {{ $pageItems["frame_1_content_title"] }} </h2>
					    {!! $pageItems["frame_1_content_one"] !!}

			</div>
		</div>
	</div>
	<div class="area-fr1__bgCon fadeIn" style="background-image: url('{{ $pageItems["frame_1_image"] }}')"></div>
</section>
<section class="page-frame bg-white area-fr2 page-lastFrame">
	
	<div class="area-fr2__sliderCon fadeIn">
		{{-- COMPONENT_SLIDER_LIST --}}
		@foreach($destinations as $destination)
		<div class="area-fr2__sliderList">
			<div class="area-fr2__imgCon" style="background-image: url('{{ $destination["image_path"] }}')"></div>
			<div class="area-fr2__textCon width--90 margin-a m-margin-t">
				
			</div>
		</div>
		@endforeach
		{{-- END_COMPONENT_SLIDER_LIST --}}
		{{-- DELETE_ME --}}
{{-- 		<div class="area-fr2__sliderList">
			<div class="area-fr2__imgCon" style="background-image: url('http://egegorgulu.com/assets/img/beforeafter/before.jpg')"></div>
		</div>
		<div class="area-fr2__sliderList">
			<div class="area-fr2__imgCon" style="background-image: url('http://egegorgulu.com/assets/img/beforeafter/before.jpg')"></div>
		</div>
		<div class="area-fr2__sliderList">
			<div class="area-fr2__imgCon" style="background-image: url('http://egegorgulu.com/assets/img/beforeafter/before.jpg')"></div>
		</div>
 --}}		{{-- DELETE_ME --}}
	</div>
	<div class="page-container">
		<div class="width--70 margin-a">
			<div class="page-general slideUp">
				<h2> {{ $pageItems["frame_2_content_title"] }} </h2>
						{!! $pageItems["frame_2_content_one"] !!}

			</div>
		</div>
	</div>
</section>

@endsection