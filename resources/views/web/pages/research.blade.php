@extends('web.master')

@section('content')

<section class="page-innerFrame bg-white research-fr1 frame1">
	<div class="page-container">
		<div class="width--90 margin-a">
			<div class="page-innerFrame__title align-c">
				<h5 class="slideUp"> {{ $pageItems["frame_1_title"] }} </h5>
				<h1 class="slideUp"> {{ $pageItems["frame_1_subtitle"] }} </h1>
			</div>
			<div class="page-general width--80 margin-a">
				{!!	 $pageItems["frame_1_content_one"] !!}
			</div>
		</div>
	</div>
</section>
<section class="page-frame bg-dullWhite research-fr2 page-lastFrame">

	<div class="page-container">
		<div class="width--90 margin-a inlineBlock-parent page-general">
			{{-- COMPONENT_RESEARCH_LIST --}}
			@foreach($researches as $res)<div class="width--50 align-t">
				<div class="research-fr2__imageCon m-margin-b">
					<div class="research-fr2__imgCon" style="background-image: url('{{ $res['image_path'] }}')"></div>
				</div>
				{!! $res['description'] !!}	
			</div
			>@endforeach

		</div>
	</div>
</section>

@endsection
