@extends('web.master')

{{-- Meta --}}
@section('meta:title', $item->renderMeta('title'))
@section('meta:description', $item->renderMeta('description'))
@section('meta:keywords', $item->renderMeta('keywords'))

{{-- OG --}}
@section('og:image', $item->renderMetaImage())
@section('og:title', $item->renderMeta('og_title'))
@section('og:description', $item->renderMeta('og_description'))

{{-- Twitter --}}
@section('twitter:image', $item->renderMetaImage())
@section('twitter:title', $item->renderMeta('og_title'))
@section('twitter:description', $item->renderMeta('og_description'))

@section('content')

<news-page-view
	:item="{{ $item }}"
>
</news-page-view>

@endsection