@extends('admin.master')

@section('meta:title', 'Create Wedding Pdfs')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> Wedding Pdfs </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.weddingpdfs.index') }}">  Wedding Pdfs </a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <weddingpdfs-view
        fetch-url="{{ route('admin.weddingpdfs.fetch-item') }}"
        submit-url="{{ route('admin.weddingpdfs.store') }}"
        ></weddingpdfs-view>
    </section>
</div>

@endsection