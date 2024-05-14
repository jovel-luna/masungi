@extends('web.master')

@section('content')

<reservation
	:trails="{{ $trails }}"
	:snacks="{{ $snacks }}"
	:countries="{{ $countries }}"
	:declarations="{{ $declarations }}"
	book-url="{{ route('web.insert.booking') }}"
	fetch-available-url="{{ route('web.fetch.available-monday-slots') }}"
	check-if-available-url="{{ route('web.date.check-if-available') }}"
	date-checker-url="{{ route('web.check.date') }}"
	fetch-fully-booked-dates-url="{{ route('web.fetch.fully-booked-dates') }}"
	:bank-details="{{ $bank_details }}"
></reservation>

@endsection