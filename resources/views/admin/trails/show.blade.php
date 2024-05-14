@extends('admin.master')

@section('meta:title', $item->name )

@section('content')
    
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $item->name }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.trails.index') }}"> Trails </a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $item->name }}</a></li>
                </ol>
            </div>
        </div>
    </section>
    
    <page-pagination fetch-url="{{ route('admin.trails.fetch-pagination', $item->id) }}"></page-pagination>

    <section class="content">
        {{-- <div class="mb-4">
            <a href="{{ route('admin.time-slots.create', [$item->id, $item->name]) }}" class="btn btn-primary text-white">
                <i class="fa fa-plus"></i>
                Create Time Slot
            </a>
        </div> --}}

        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" data-target="#tab1" href="javascript:void(0)" data-toggle="tab">Trail Data</a></li>
                    {{-- <li class="nav-item"><a @click="initList('table-1')" class="nav-link" data-target="#tab2" href="javascript:void(0)" data-toggle="tab">Time Slots</a></li> --}}
                    <li class="nav-item"><a @click="initList('table-2')" class="nav-link" data-target="#tab3" href="javascript:void(0)" data-toggle="tab">Activity Logs</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="tab1">
                        <trails-view
                        fetch-url="{{ route('admin.trails.fetch-item', $item->id) }}"
                        submit-url="{{ route('admin.trails.update', $item->id) }}"
                        ></trails-view>
                    </div>
                  {{--   <div class="tab-pane" id="tab2">
                        <time-slots-table
                        ref="table-1"
                        fetch-url="{{ route('admin.time-slots.fetch.time', $item->id) }}"
                        ></time-slots-table>
                    </div> --}}
                    <div class="tab-pane" id="tab3">
                        <activity-log-table 
                        ref="table-2"
                        disabled
                        no-action
                        fetch-url="{{ route('admin.activity-logs.fetch.trails', $item->id) }}"
                        ></activity-log-table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection