@extends('web.master')

@section('content')

<section class="page-innerFrame bg-white beyond-fr1 frame1 page-lastFrame">
	<div class="page-container">
		<div class="width--90 margin-a">
			<div class="page-innerFrame__title align-c">
				<h5 class="slideUp">Experiences</h5>
				<h1 class="slideUp">Beyond Masungi</h1>
			</div>
{{-- 			<div class="page-general inlineBlock-parent fadeIn">
				<div class="width--50">
					<div class="beyond-fr1__sliderThumbCon">
						<!-- COMPONENT_THUMBNAIL_LIST -->
						<div class="beyond-fr1__sliderThumbList">
							<div class="beyond-fr1__ImgCon" style="background-image: url('https://masungi-uat.praxxys.ph/storage/beyondmasungi-images/5e32d320b44admFxNMEcXYFfrBO85DG29G1aE7S1iWLF3PFR3rD3S.jpg"></div>
						</div>
						<div class="beyond-fr1__sliderThumbList">
							<div class="beyond-fr1__ImgCon" style="background-image: url('https://masungi-uat.praxxys.ph/storage/beyondmasungi-images/5e32d320b44admFxNMEcXYFfrBO85DG29G1aE7S1iWLF3PFR3rD3S.jpg"></div>
						</div>
						<div class="beyond-fr1__sliderThumbList">
							<div class="beyond-fr1__ImgCon" style="background-image: url('https://masungi-uat.praxxys.ph/storage/beyondmasungi-images/5e32d320b44admFxNMEcXYFfrBO85DG29G1aE7S1iWLF3PFR3rD3S.jpg"></div>
						</div>
						<!-- END_COMPONENT_THUMBNAIL_LIST -->
					</div>
				</div
				><div class="width--50">
					<div class="beyond-fr1__sliderCon">
						<!-- COMPONENT_SLIDER_CONTENT -->
						<div class="beyond-fr1__sliderList">
							<h2>Sample</h2>
							<p>Sample Text here</p>
						</div>
						<!-- END_COMPONENT_SLIDER_CONTENT -->
					</div>
				</div
>			</div> --}}

			<div class="page-general inlineBlock-parent fadeIn">
				<div class="width--50">
					<div class="beyond-fr1__sliderThumbCon">
						<!-- COMPONENT_THUMBNAIL_LIST -->
						@foreach($natures as $nature)
						<div class="beyond-fr1__sliderThumbList">
							<div class="beyond-fr1__ImgCon" style="background-image: url('{{ $nature['image_path'] }}')"></div>
						</div>
						<!-- END_COMPONENT_THUMBNAIL_LIST -->
						@endforeach
					</div>
				</div
				><div class="width--50">
					<div class="beyond-fr1__sliderCon">
						<!-- COMPONENT_SLIDER_CONTENT -->
						<div class="beyond-fr1__sliderList">
							<h2>{{ $pageItems["item_1_title"] }}</h2>
							{{-- <h5>Wawa Park</h5> --}}
							{!! $pageItems["item_1_description"] !!}
						</div>
						<!-- END_COMPONENT_SLIDER_CONTENT -->
					</div>
				</div>
			</div>

			<div class="page-general inlineBlock-parent fadeIn">
				<div class="width--50">
					<div class="beyond-fr1__sliderThumbCon">
						<!-- COMPONENT_THUMBNAIL_LIST -->
						@foreach($cultures as $culture)
						<div class="beyond-fr1__sliderThumbList">
							<div class="beyond-fr1__ImgCon" style="background-image: url('{{ $culture['image_path'] }}')"></div>
						</div>
						<!-- END_COMPONENT_THUMBNAIL_LIST -->
						@endforeach
					</div>
				</div
				><div class="width--50">
					<div class="beyond-fr1__sliderCon">
						<!-- COMPONENT_SLIDER_CONTENT -->
						<div class="beyond-fr1__sliderList">
							<h2>{{ $pageItems["item_title"] }}</h2>
							{{-- <h5>Wawa Park</h5> --}}
							{!! $pageItems["item_2_description"] !!}
						</div>
						<!-- END_COMPONENT_SLIDER_CONTENT -->
					</div>
				</div>
			</div>

			<div class="page-general inlineBlock-parent fadeIn">
				<div class="width--50">
					<div class="beyond-fr1__sliderThumbCon">
						<!-- COMPONENT_THUMBNAIL_LIST -->
						@foreach($arts as $art)
						<div class="beyond-fr1__sliderThumbList">
							<div class="beyond-fr1__ImgCon" style="background-image: url('{{ $art['image_path'] }}')"></div>
						</div>
						<!-- END_COMPONENT_THUMBNAIL_LIST -->
						@endforeach
					</div>
				</div
				><div class="width--50">
					<div class="beyond-fr1__sliderCon">
						<!-- COMPONENT_SLIDER_CONTENT -->
						<div class="beyond-fr1__sliderList">
							<h2>{{ $pageItems["item_3_title"] }}</h2>
							{{-- <h5>Wawa Park</h5> --}}
							{!! $pageItems["item_3_description"] !!}
						</div>
						<!-- END_COMPONENT_SLIDER_CONTENT -->
					</div>
				</div>
			</div>

			<div class="page-general inlineBlock-parent fadeIn">
				<div class="width--50">
					<div class="beyond-fr1__sliderThumbCon">
						<!-- COMPONENT_THUMBNAIL_LIST -->
						@foreach($seas as $sea)
						<div class="beyond-fr1__sliderThumbList">
							<div class="beyond-fr1__ImgCon" style="background-image: url('{{ $sea['image_path'] }}')"></div>
						</div>
						<!-- END_COMPONENT_THUMBNAIL_LIST -->
						@endforeach
					</div>
				</div
				><div class="width--50">
					<div class="beyond-fr1__sliderCon">
						<!-- COMPONENT_SLIDER_CONTENT -->
						<div class="beyond-fr1__sliderList">
							<h2>{{ $pageItems["item_4_title"] }}</h2>
							{{-- <h5>Wawa Park</h5> --}}
							{!! $pageItems["item_4_description"] !!}
						</div>
						<!-- END_COMPONENT_SLIDER_CONTENT -->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection
