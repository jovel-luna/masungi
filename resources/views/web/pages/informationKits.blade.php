@extends('web.master')

@section('content')

<section class="page-innerFrame bg-white info-fr1 frame1 page-lastFrame">
	<div class="page-container">
		<div class="width--90 margin-a">
			<div class="page-innerFrame__title align-c">
				<h5 class="slideUp"> {{ $pageItems["frame_1_title"] }} </h5>
				<h1 class="slideUp"> {{ $pageItems["frame_1_subtitle"] }} </h1>
			</div>
			<div class="page-general width--80 margin-a align-c fadeIn">
					{!!	 $pageItems["frame_1_content_one"] !!}
			</div>
			<div class="page-general l-margin-t">
				<div class="page-grid grid-3">
						@foreach($infokits as $infokit)
						<div class="page__gridChild">
						    <div class="page-grid__imgCon" style="background-image: url('{{ $infokit['image_path'] }}')"></div>
						    <div class="page-grid__textConPrev">
						      <h2>{{ $infokit['name'] }} </h2>
						    </div>
						    <div class="page-grid__textCon">
						      <div class="page-grid__limitCon">
						        <div class="align-c">
						         <a href="{{ $infokit['document_path'] }}" target="_blank"> <button class="button type-1"><span>Download</span><img src="images/images/icons/arrow.png"></button></a>
						        </div>
						      </div>
						    </div>
						</div>
						@endforeach
				</div>
			</div>
		</div>
	</div>
</section>

@endsection