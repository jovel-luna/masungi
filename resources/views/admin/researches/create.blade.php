@extends('admin.master')

@section('meta:title', 'Create Researches')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Researches</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.researches.index') }}"> Researches </a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <researches-view
        fetch-url="{{ route('admin.researches.fetch-item') }}"
        submit-url="{{ route('admin.researches.store') }}"
        ></researches-view>
    </section>
</div>

@endsection