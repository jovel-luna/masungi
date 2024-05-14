@extends('web.master')

@section('content')

<section class="page-innerFrame bg-white getHere-fr1 frame1">
	<div class="page-container">
		<div class="width--90 margin-a">
			<div class="page-innerFrame__title align-c">
				<h5 class="slideUp">{{ $pageItems["frame_1_title"] }}</h5>
				<h1 class="slideUp">{{ $pageItems["frame_1_sub_title"] }}</h1>
			</div>
			<div class="width--80 margin-a align-c slideUp">
				{!! $pageItems["frame_1_content"] !!}
			</div>
			<div class="page-general inlineBlock-parent getHere-fr1__list">
				<div class="width--50 align-c">
					<img src="/images/images/icons/plane.svg">
					<h2>{{ $pageItems["frame_1_title_two"] }}</h2>
					{!! $pageItems["frame_1_content_two"] !!}

				</div
				><div class="width--50 align-c">
					<img src="/images/images/icons/car.svg">
					<h2>{{ $pageItems["frame_1_title_three"] }}</h2>
					{!! $pageItems["frame_1_content_three"] !!}
				</div>
			</div>
		</div>
	</div>
</section>
<section class="page-frame bg-dullWhite getHere-fr2">
	<div class="page-container">
		<div class="width--90 margin-a">
			<div class="page-general inlineBlock-parent fadeIn">
				<div class="width--50">
					<img class="getHere-fr2__imgCon" src="../images/images/location-map-1.png">
				</div
				><div class="width--50">
					<div class="getHere-fr2__textCon">
						{!! $pageItems["frame_2_content"] !!}
					</div>
					<a href="{{ route('web.gettingHere') }}#modal"> <button class="button type-1 m-margin-t"><span>Google Map</span><img src="../images/images/icons/arrow.png"></button></a>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="page-frame bg-white getHere-fr3 page-lastFrame">
	<div class="page-container">
		<div class="width--90 margin-a align-c">
			<div class="page-general l-margin-b slideUp">
				<h2>{{ $pageItems["frame_3_title"] }}</h2>
			</div>
			<div class="page-general inlineBlock-parent getHere-fr3__list">
				<div class="width--33 align-t">
					<img src="/images/images/icons/car.svg">
					<h5>{{ $pageItems["frame_3_title_two"] }}</h5>
					<div>
						 {!! $pageItems["frame_3_content_two"] !!}
						<br>
						<p><a href="{{ $pageItems["frame_3_content_two_link_one"] }}"> {!! $pageItems["frame_3_link_label_one"] !!},</a>
						<a href="{{ $pageItems["frame_3_content_two_link_two"] }}"> {!! $pageItems["frame_3_link_label_two"] !!},</a></p>
						<p><a href="{{ $pageItems["frame_3_content_two_link_three"] }}"> {!! $pageItems["frame_3_link_label_three"] !!},</a>
						<a href="{{ $pageItems["frame_3_content_two_link_four"] }}"> {!! $pageItems["frame_3_link_label_four"] !!},</a></p>
					</div>
				</div
				><div class="width--33 align-t">
					<img src="/images/images/icons/backpack.svg">
					<div>
						<h5>{{ $pageItems["frame_3_title_three"] }}</h5>
						{!! $pageItems["frame_3_content_three"] !!}
					</div>
				</div
				><div class="width--33 align-t">
					<img src="/images/images/icons/helicopter.svg">
					<div>
						<h5>{{ $pageItems["frame_3_title_four"] }}</h5>
						{!! $pageItems["frame_3_content_four"] !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="remodal getHere-modal" data-remodal-id="modal">
	<button data-remodal-action="close" class="remodal-close"></button>
	<store-locator></store-locator>
</div>

@endsection