@extends('admin.master')

@section('meta:title', $item->email)

@section('content')
    
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $item->email }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.newsletters.index') }}">Contact Us</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $item->email }}</a></li>
                </ol>
            </div>
        </div>
    </section>
    
    <page-pagination fetch-url="{{ route('admin.newsletters.fetch-pagination', $item->id) }}"></page-pagination>

    <section class="content">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" data-target="#tab1" href="javascript:void(0)" data-toggle="tab">Information</a></li>
                    <li class="nav-item"><a @click="initList('table-1')" class="nav-link" data-target="#tab2" href="javascript:void(0)" data-toggle="tab">Activity Logs</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane show active" id="tab1">
                        <newsletters-view
                        fetch-url="{{ route('admin.newsletters.fetch-item', $item->id) }}"
                        ></newsletters-view>
                    </div>
                    <div class="tab-pane" id="tab2">
                        <activity-log-table 
                        ref="table-1"
                        disabled
                        no-action
                        fetch-url="{{ route('admin.activity-logs.fetch.newsletters', $item->id) }}"
                        ></activity-log-table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection