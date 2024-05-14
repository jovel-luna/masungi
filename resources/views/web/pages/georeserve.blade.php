@extends('web.master')

@section('content')

<section class="page-innerFrame bg-white georeserve-fr1 frame1">
	<div class="page-container">
		<div class="width--90 margin-a">
			<div class="page-innerFrame__title align-c">
				<h1 class="slideUp">{{ $pageItems["frame_1_title"] }} </h1>
			</div>
			<div class="georeserve-fr1__imgCon slideUp" style="background-image: url('{{ $pageItems["frame_1_image"] }}')"></div>
			<div class="page-general width--80 margin-a l-margin-t fadeIn">
				{!!	 $pageItems["frame_1_content_one"] !!}
				<br>
 				{!!	 $pageItems["frame_1_content_two"] !!}
	
			</div>
		</div>
	</div>
</section>
<section class="page-frame bg-dullWhite georeserve-fr2">
	<div class="page-container">
		<div class="page-general page-grid grid-3 width--90 margin-a">
			@foreach($policies as $policy)
			<div class="page__gridChild align-c">
					<img src="{{ $policy['image_path'] }}">
					<h5>{{ $policy['name'] }}</h5>
					<p> {!! $policy['description'] !!} </p>
			</div>
			@endforeach
		</div>

	</div>
</section>
<section class="page-frame bg-white georeserve-fr3">
	<div class="page-container">
		<div class="page-general width--70 margin-a fadeIn">
				{!!	 $pageItems["frame_2_content"] !!}

		</div>
	</div>
</section>

@endsection