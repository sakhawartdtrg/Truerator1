@extends('layouts.app')
@section('content')
<section class="breadcrumb">
    <h1>Abilities</h1>
    <ul>
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="divider la la-arrow-right"></li>
        <li>Abilitiy</li>
    </ul>
</section>

<div class="card mt-5 p-5">
    <h3>Ability/Gate/Permission</h3>
    <div class="mt-5">
        <form action="{{ route("abilities.store") }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="flex">
                <div class="mb-5 w-1/3 mr-2">
                    <label class="label block mb-2" for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required value="@if(isset($user->name)){{ $user->name }}@else {{ old('name') }}@endif">
                </div>
                <div class="mb-5 w-1/3 mr-2">
                    <label class="label block mb-2" for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required value="@if(isset($user->title)){{ $user->title }}@else {{ old('title') }}@endif">
                </div>
                <div class="mb-5 w-1/3 ">
                    <label class="label block mb-2" for="title">Group</label>
                    <div class="custom-select">
                        <select name="group_id" id="group_id" class="form-control">
                            @foreach ($permission_group as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                        {{-- <div class="select-icon la la-caret-down"></div> --}}
                    </div>

                    {{-- <input type="text" class="form-control" id="title" name="title" required value="@if(isset($user->title)){{ $user->title }}@else {{ old('title') }}@endif"> --}}
                </div>
            </div>
            <div class="mt-10">
                <button class="btn btn_primary mr-2 uppercase" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
