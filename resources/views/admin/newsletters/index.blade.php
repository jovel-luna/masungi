@extends('admin.master')

@section('meta:title', 'Contact Us')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>News Letters Subscribers</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Newsletters</a></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="col-xs-12">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a @click="initList('table-1')" class="nav-link active" href="#tab1" data-toggle="tab">Active</a></li>
                        <li class="nav-item"><a @click="initList('table-2')" class="nav-link" href="#tab2" data-toggle="tab">Archived</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="tab1">
                            <newsletters-table 
                            ref="table-1"
                            export-url="{{ route('admin.newsletters.export-newsletters') }}"
                            fetch-url="{{ route('admin.newsletters.fetch') }}"
                            ></newsletters-table>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <newsletters-table
                            ref="table-2"
                            disabled
                            fetch-url="{{ route('admin.newsletters.fetch-archive') }}"
                            ></newsletters-table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection