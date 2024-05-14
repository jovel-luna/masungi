@extends('admin.master')

@section('meta:title', 'Create Experience')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> Create Experience Information </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.experience-information.index') }}">Experience</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <experience-information-view
        fetch-url="{{ route('admin.experience-information.fetch-item') }}"
        submit-url="{{ route('admin.experience-information.store') }}"
        ></experience-information-view>
    </section>
</div>

@endsection