@extends('layouts.admin')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('layouts/flash-message')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="card">
                    <div class="card-header">
                        Edit Roles
                    </div>

                    <div class="card-body">
                        <form action="{{ route("admin.roles.update", [$role->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">Name*</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ old('name', isset($role) ? $role->name : '') }}" required>
                                @if($errors->has('name'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </em>
                                @endif
                            </div>
                            <div class="form-group {{ $errors->has('abilities') ? 'has-error' : '' }}">
                                <label for="abilities">Abilities*
                                    <span class="btn btn-info btn-xs select-all">select all</span>
                                    <span class="btn btn-info btn-xs deselect-all">delete all</span></label>
                                <select name="abilities[]" id="abilities" class="form-control select2"
                                    multiple="multiple" required>
                                    @foreach($abilities as $id => $abilities)
                                    <option value="{{ $id }}"
                                        {{ in_array($id, old('abilities', [])) || $role->getAbilities()->pluck('name', 'name')->contains($abilities) ? 'selected' : '' }}>
                                        {{ $abilities }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('abilities'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('abilities') }}
                                </em>
                                @endif
                            </div>
                            <div>
                                <input class="btn btn-success" type="submit" value="Save">
                            </div>
                        </form>


                    </div>
                </div>
            </section>
        </div>
    </section>
</div>
@endsection
