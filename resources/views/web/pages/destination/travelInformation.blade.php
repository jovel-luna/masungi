@extends('web.master')

@section('content')

<section class="page-innerFrame bg-white travel-fr1 frame1 page-lastFrame">
	<div class="page-container">
		<div class="width--90 margin-a travel-fr1__list">
			<div class="page-innerFrame__title align-c">
				<h5 class="slideUp">{{ $pageItems["frame_1_title"] }}</h5>
				<h1 class="slideUp">{{ $pageItems["frame_1_sub_title"] }}</h1>
			</div>
			<div class="l-margin-b">
				<div class="page-general width--80 margin-a m-margin-b">
					<h2>{{ $pageItems["frame_1_title_one"] }}</h2>
					{!! $pageItems["frame_1_content_one"] !!}
				</div>
				<div class="page-general width--80 margin-a m-margin-b">
					<h2>{{ $pageItems["frame_1_title_two"] }}</h2>
					{!! $pageItems["frame_1_content_two"] !!}
				</div>
			</div>
			<div class="l-margin-b">
				<div class="page-general width--80 margin-a m-margin-b">
					<h2>{{ $pageItems["frame_1_title_three"] }}</h2>
					{!! $pageItems["frame_1_content_three"] !!}
				</div>
				<div class="page-general width--80 margin-a m-margin-b">
					<h2>{{ $pageItems["frame_1_title_four"] }}</h2>
					{!! $pageItems["frame_1_content_four"] !!}
				</div>
			</div>
			<div class="l-margin-b">
				<div class="page-general width--80 margin-a m-margin-b">
					<h2>{{ $pageItems["frame_1_title_five"] }}</h2>
					{!! $pageItems["frame_1_content_five"] !!}
				</div>
				<div class="page-general width--80 margin-a m-margin-b">
					<h2>{{ $pageItems["frame_1_title_six"] }}</h2>
					{!! $pageItems["frame_1_content_six"] !!}
				</div>
			</div>
		</div>
	</div>
</section>

@endsection