@extends('web.master')

@section('content')

<more-news
	fetch-url="{{ route('web.news-fetch') }}"
></more-news>

@endsection