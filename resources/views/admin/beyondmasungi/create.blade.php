@extends('admin.master')

@section('meta:title', 'Create Beyond Masungi Content')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Beyond Masungi Content</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.beyondmasungi.index') }}"> Beyond Masungi </a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <beyondmasungi-view
        fetch-url="{{ route('admin.beyondmasungi.fetch-item') }}"
        submit-url="{{ route('admin.beyondmasungi.store') }}"
        ></beyondmasungi-view>
    </section>
</div>

@endsection