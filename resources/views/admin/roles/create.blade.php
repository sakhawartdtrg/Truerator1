@extends('layouts.app')
@section('content')
<section class="breadcrumb">
    <h1>Roles</h1>
    <ul>
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="divider la la-arrow-right"></li>
        <li>Role</li>
    </ul>
</section>
<div class="grid grid-cols-12 gap-4">
    <x-settingbar />
    <div class="card ml-5 p-5 col-span-10">
        <h3>Role</h3>
        <div class="mt-5">
            <form action="{{ route("roles.store") }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="flex">
                    <div class="mb-5 w-1/2 mr-2">
                        <label class="label block mb-2" for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required value="@if(isset($user->name)){{ $user->name }}@else {{ old('name') }}@endif">
                    </div>
                    <div class="mb-5 w-1/2 mr-2">
                        <label class="label block mb-2" for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required value="@if(isset($user->title)){{ $user->title }}@else {{ old('title') }}@endif">
                    </div>
                </div>
                <div class="mt-10">
                    <button class="btn btn_primary mr-2 uppercase" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
 @endsection
