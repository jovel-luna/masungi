@extends('admin.master')

@section('meta:title', 'Create Previous Guests')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Previous Guests</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.previousguests.index') }}"> Previous Guests </a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <previousguests-view
        fetch-url="{{ route('admin.previousguests.fetch-item') }}"
        submit-url="{{ route('admin.previousguests.store') }}"
        ></previousguests-view>
    </section>
</div>

@endsection