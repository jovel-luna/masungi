@extends('web.master')

@section('meta:title', $page->renderMeta('title'))
@section('meta:description', $page->renderMeta('description'))
@section('meta:keywords', $page->renderMeta('keywords'))
@section('og:image', $page->renderMetaImage())
@section('og:title', $page->renderMeta('og_title'))
@section('og:description', $page->renderMeta('og_description'))

@section('content')

<section class="page-innerFrame bg-white general-fr1 frame1">
	<div class="page-container">
		<div class="width--90 margin-a">
			<div class="page-innerFrame__title align-c">
				<h1>{{ $pageItems['frame_1_text'] }}</h1>
			</div>
			<div class="page-general">
				{!! $pageItems['frame_1_content'] !!}
			</div>
		</div>
	</div>
</section>

@endsection