@extends('admin.master')

@section('meta:title', $item->renderName())

@section('content')
    
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $item->renderName() }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.time-slots.index') }}">Time Slots</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $item->renderName() }}</a></li>
                </ol>
            </div>
        </div>
    </section>
    
    <section class="content">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" data-target="#tab1" href="javascript:void(0)" data-toggle="tab">Information</a></li>
                    <li class="nav-item"><a @click="initList('table-2')" class="nav-link" data-target="#tab2" href="javascript:void(0)" data-toggle="tab">Archived</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="tab1">
                            <time-slots-table 
                            ref="table-1"
                            fetch-url="{{ route('admin.time-slots.fetch-filtered', $item->id) }}"
                            submit-url="{{ route('admin.time-slots.reorder') }}"
                            ></time-slots-table>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <time-slots-table
                            ref="table-2"
                            disabled
                            fetch-url="{{ route('admin.time-slots.fetch-archive') }}"
                            ></time-slots-table>
                        </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
