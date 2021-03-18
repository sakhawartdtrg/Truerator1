@extends('layouts.app')
@section('content')

    <section class="breadcrumb">
        <h1>Users</h1>
        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="divider la la-arrow-right"></li>
            <li>Users</li>
        </ul>
    </section>
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-2 mr-5">
            <x-settingbar />
        </div>
        <div class="col-span-10">
            <div class="card p-5">
                <h3>User Detail</h3>
                <div class="mt-5">
                    <form action="{{ route("users.update", [$user->id]) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="flex">
                            <div class="mb-5 w-1/2 mr-2">
                                <label class="label block mb-2" for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required value="@if(isset($user->first_name)){{ $user->first_name }}@else old('first_name')@endif">
                            </div>
                            <div class="mb-5 w-1/2 ">
                                <label class="label block mb-2" for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required value="@if(isset($user->last_name)){{ $user->last_name }}@else old('last_name')@endif">
                            </div>
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="mobile">Mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" required value="@if(isset($user->mobile)){{ $user->mobile }}@else old('mobile')@endif">
                        </div>
                        <div class="flex">

                            <div class="mb-5 w-1/2 mr-2">
                                <label class="label block mb-2" for="password">Password</label>
                                <label class="form-control-addon-within">
                                    <input type="password" class="form-control border-none" id="password" name="password">
                                    <span class="flex items-center pr-4"><button type="button"
                                            class="btn btn-link la la-eye text-gray-600 text-xl leading-none"
                                            data-toggle="password-visibility"></button></span>
                                </label>
                            </div>
                            <div class="mb-5 w-1/2">
                                <label class="label block mb-2" for="password">Confirm Password</label>
                                <label class="form-control-addon-within">
                                    <input type="password" class="form-control border-none" id="password" name="password_confirmation">
                                    <span class="flex items-center pr-4">
                                        <button type="button"
                                            class="btn btn-link la la-eye text-gray-600 text-xl leading-none"
                                            data-toggle="password-visibility"></button>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label class="label block mb-2" for="category">Roles</label>
                            <div class="custom-select">

                                <select name="roles" id="roles" class="form-control">
                                    @foreach($roles as $id => $roles)
                                        <option value="{{ $id }}" {{ $id=old('roles','') || $user->roles()->pluck('name', 'name')->contains($roles) ? 'selected' : '' }}>{{ $roles }}</option>
                                    @endforeach
                                </select>
                                {{--  <div class="select-icon la la-caret-down"></div>  --}}
                            </div>
                        </div>
                        <div class="mt-10">
                            <button class="btn btn_primary mr-2 uppercase" type="submit">Save</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>        

@endsection
@push('scripts')

@endpush
