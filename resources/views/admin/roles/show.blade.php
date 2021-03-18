@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('layouts/flash-message')
    <section class="content-header">
      <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Show Roles</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                <li class="breadcrumb-item active">Show</li>
                </ol>
            </div>
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        Show company roles
                    </div>

                    <div class="card-body">
                        <div class="mb-2">
                            <table class=" general-table table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>
                                            Id
                                        </th>
                                        <td>
                                            {{ $role->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Name
                                        </th>
                                        <td>
                                            {{ $role->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Abilities
                                        </th>
                                        <td>
                                            @foreach($role->abilities as $id => $abilities)
                                                <span class="badge badge-info">{{ $abilities->name }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                                Back to list
                            </a>
                        </div>

                        <nav class="mb-3">
                            <div class="nav nav-tabs">

                            </div>
                        </nav>
                        <div class="tab-content">

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
</div>
@endsection
