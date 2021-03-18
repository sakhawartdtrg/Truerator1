@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Logs</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Logs</li>
                </ol>
            </div>
            </div>
            <!-- Main content -->
            <section class="content">

                <div class="card">
                    <div class="card-header">
                        Logs List
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class=" general-table table table-bordered table-striped table-hover datatable datatable-User">
                                <thead>
                                    <tr>
                                        <th>
                                           Id
                                        </th>
                                        <th>
                                            Description
                                        </th>
                                        <th>
                                            Caused By
                                        </th>
                                        <th>
                                            Created At
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($logs as $key => $log)
                                        <tr data-entry-id="{{ $key }}">

                                            <td>
                                                {{ ++$key }}
                                            </td>
                                            <td>
                                                {{ $log->description ?? '' }}
                                            </td>
                                            <td>
                                                {{ $log->causer->name ?? '' }}
                                            </td>
                                            <td>
                                                {{ date('d-M-y',strtotime($log->created_at)) ?? '' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>
@endsection
@section('scripts')
@parent

@endsection
