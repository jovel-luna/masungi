@extends('web.master')

@section('content')

<section class="page-innerFrame bg-white wed-fr1 frame1">
	<div class="page-container">
		<div class="width--90 margin-a">
			<div class="page-innerFrame__title align-c">
				<h5 class="slideUp">{{ $pageItems['frame_1_title'] }}</h5>
				<h1 class="slideUp">{{ $pageItems['frame_1_subtitle'] }}</h1>
			</div>
			<div class="page-general width--80 margin-a align-c">
				<h2 class="slideUp">{{ $pageItems['frame_1_subtitle_one'] }}</h2>
				<h5 class="fadeIn">{{ $pageItems['frame_1_subtitle_two'] }}</h5>
			</div>
			<div class="page-general width--80 margin-a m-margin-t align-c fadeIn">
				<div class="wed-fr1__tabParent">
					<h5>{{ $pageItems['frame_1_subtitle_three'] }}</h5>
					<h5>{{ $pageItems['frame_1_subtitle_four'] }}</h5>
					<h5>{{ $pageItems['frame_1_subtitle_five'] }}</h5>
				</div>
				<div class="wed-fr1__tabChild">
					{!! $pageItems['frame_1_content_one']!!}
					{!! $pageItems['frame_1_content_two']!!}
					{!! $pageItems['frame_1_content_three']!!}					
				</div>

				<div class="to-mob">
					<div>
						<h5>{{ $pageItems['frame_1_subtitle_three'] }}</h5>
						<p>{!! $pageItems['frame_1_content_one']!!}</p>
					</div>
					<div>
						<h5>{{ $pageItems['frame_1_subtitle_four'] }}</h5>
						<p>{!! $pageItems['frame_1_content_two']!!}</p>
					</div>
					<div>
						<h5>{{ $pageItems['frame_1_subtitle_five'] }}</h5>
						<p>{!! $pageItems['frame_1_content_three']!!}</p>
					</div>
				</div>

			</div>
			<div class="page-general width--80 margin-a l-margin-t">
				<div class="page-grid grid-3">
					@foreach($weddingpdfs as $weddingpdf)
					<div class="page__gridChild">
						<div class="page-grid__imgCon" style="background-image: url('{{ $weddingpdf['image_path'] }}')"></div>
						<div class="page-grid__textConPrev">
							<h2>{{ $weddingpdf['name'] }}</h2>
						</div>
						<div class="page-grid__textCon">
							<div class="page-grid__limitCon">
								<div class="align-c">
									<a href="{{ $weddingpdf['document_path'] }}" target="blank"><button class="button type-1"><span>Download</span><img src="images/images/icons/arrow.png"></button></a>
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
<section class="page-frame bg-dullWhite wed-fr2">
	<div class="page-container">
			@foreach($venues as $venue)
				<div class="page-general width--80 margin-a m-margin-tb fadeIn">
					<div class="width--50">
						<div class="wed-fr2__sliderThumbCon">
						@foreach($venue['weddingVenues'] as $weddingVenue)
							<!-- COMPONENT_THUMBNAIL_LIST -->
							<div class="wed-fr2__sliderThumbList">
								<div class="wed-fr2__ImgCon" style="background-image: url('{{ Storage::url($weddingVenue['image_path'])}}')"></div>
							</div>
							<!-- END_COMPONENT_THUMBNAIL_LIST -->
						@endforeach

						</div>
					</div

					><div class="width--50">
						<div class="wed-fr2__sliderCon">
						@foreach($venue['weddingVenues'] as $weddingVenue)
							<!-- COMPONENT_SLIDER_CONTENT -->						
							<div class="wed-fr2__sliderList">
								<h2>{{ $venue['name'] }}</h2>
								{!! $weddingVenue['description'] !!}
							</div>
							<!-- END_COMPONENT_SLIDER_CONTENT -->
						@endforeach
						</div>
					</div>
				</div>
			@endforeach
	</div>
</section>
<section class="page-frame bg-white event-fr2 wed-fr3 trail-fr1">
	<div class="page-container">
		<div class="page-general width--90 margin-a m-margin-b align-c">
			<h2 class="slideUp">Inspiration Board</h2>
		</div>
	</div>
	<div class="event-fr2__slider2Con slide__options active fadeIn">
		{{-- COMPONENT_SLIDER_LIST --}}
		@foreach($weddingboards as $weddingboard)
		<div class="event-fr2__sliderList">
			<div class="event-fr2__ImgCon" style="background-image: url('{{$weddingboard['image_path']}}')"></div>
		</div>
		@endforeach
		{{-- END_COMPONENT_SLIDER_LIST --}}
	</div>
</section>
<section class="page-frame bg-dullWhite event-fr4">
	<div class="page-container">
		<div class="page-general width--90 margin-a m-margin-b align-c">
			<h2 class="slideUp">Contact Us</h2>
			<p class="fadeIn">Kindly supply the following information and our Partnerships Officer will get back to you.</p>
		</div>
		<div class="page-general width--90 margin-a">
			<wedding-inquiry-form
				store-url="{{ route('web.inquiry.wedding-inquiry') }}"
			></wedding-inquiry-form>
		</div>
	</div>
</section>

@endsection
