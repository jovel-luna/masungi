@extends('web.master')

@section('content')

<section class="page-innerFrame bg-white contact-fr1 frame1">
	<div class="page-container">
		<div class="width--90 margin-a">
			<div class="page-innerFrame__title align-c">
				<h1 class="slideUp">Contact Us</h1>
			</div>
			<div class="page-general width--80 margin-a align-c fadeIn mb-3">
				<p><b>Address:</b> {{ $pageItems['address'] }} | <b>Email Address</b>: {{ $pageItems['email_address'] }} | <b>Mobile Numbers</b>: {{ $pageItems['mobile_numbers'] }} | <b>Operating Hours</b>: {{ $pageItems['operating_hours'] }} </p>
			</div>
			<div class="page-general width--80 margin-a align-c fadeIn">
				<p>We're here to help and answer any question you might have.</p>
				<p>We look forward to hearing from you.</p>
			</div>
			<div class="page-general width--90 margin-a l-margin-t fadeIn">
				<contact-us-form
					store-url="{{ route('web.inquiry.contact-us') }}"
				></contact-us-form>
			</div>
		</div>
	</div>
</section>
<section id="contact-map" class="page-frame bg-white contact-fr2">
	<div class="page-container">
		<div class="width--90 margin-a inlineBlock-parent">
			<div class="width--40 page-general align-t fadeIn">
				<h2>Find Us</h2>
				<div class="inlineBlock-parent m-margin-b">
					<i class="fas fa-map-marker-alt"></i>
					<a href="" target="_blank">
						<p>Masungi Georeserve</p>
					</a>
					<p>{{ $pageItems['address'] }}
				</div>
				<div class="inlineBlock-parent m-margin-b">
					<i class="fas fa-envelope"></i>
					<p><a href="mailto:trail@masungigeoreserve.com" target="_blank">{{ $pageItems['email_address'] }}</a></p>
				</div>
				<div class="inlineBlock-parent m-margin-b">
					<i class="fas fa-phone-alt"></i>
					<div>
						<p>{{ $pageItems['mobile_numbers'] }}</p>
						{{-- <p><a href="tel: +63 (995) 186 99 11" target="_blank">+63 (995) 186 99 11</a></p> --}}
					</div>
				</div>
				<div class="inlineBlock-parent m-margin-b">
					<i></i>
					<p>{{ $pageItems['operating_hours'] }}</p>
				</div>
			</div

			><div class="width--60 align-t fadeIn">
				<store-locator></store-locator>
			</div>
			
		</div>

	</div>
</section>

@endsection