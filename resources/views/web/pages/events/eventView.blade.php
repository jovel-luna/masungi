@extends('web.master')

@section('content')

<section class="page-innerFrame bg-white eventView-fr1 frame1">
	<div class="page-container">
		<div class="width--90 margin-a">
			@foreach($teambuildings as $teambuilding)
			<div class="page-innerFrame__title align-c">
				<h5>Company Events</h5>
				<h1>{{ $teambuilding['name'] }}</h1>
			</div>
			<div class="eventView-fr1__bannerCon">
				<div class="eventView-fr1__ImgCon" style="background-image: url('{{ $teambuilding['image_path'] }}')"></div>
			</div>
			<div class="page-general width--75 margin-a">
				<h2>{{ $teambuilding['activity'] }}</h2>
				{!! $teambuilding['description'] !!}
			</div>
			<div class="page-general width--80 margin-a inlineBlock-parent eventView-fr1__textCon">
				<div class="width--50 align-t">
					<h2>Features</h2>
					{!! $teambuilding['features'] !!}
				</div
				><div class="width--50 align-t">
					<h2>Conservation Fees</h2>
					{!! $teambuilding['conservation_fees'] !!}
				</div>
			</div>
			@endforeach
		</div>
	</div>
</section>
<section class="page-frame event-fr4 bg-dullWhite page-lastFrame">
	<div class="page-container">
		<div class="page-general width--90 margin-a m-margin-b align-c">
			<h2>Contact Us</h2>
			<p>Kindly supply the following information and our Partnerships Officer will get back to you.</p>
		</div>
		<div class="page-general width--90 margin-a">
			<company-inquiry-form
				store-url="{{ route('web.inquiry.company-inquiry') }}"
			></company-inquiry-form>
		</div>
	</div>
</section>

@endsection