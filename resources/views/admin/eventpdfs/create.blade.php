@extends('admin.master')

@section('meta:title', 'Create Event Pdfs')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> Event Pdfs </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.eventpdfs.index') }}">  Event Pdfs </a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <eventpdfs-view
        fetch-url="{{ route('admin.eventpdfs.fetch-item') }}"
        submit-url="{{ route('admin.eventpdfs.store') }}"
        ></eventpdfs-view>
    </section>
</div>

@endsection