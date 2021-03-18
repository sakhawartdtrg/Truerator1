@extends('layouts.app')
@section('content')
<section class="breadcrumb">
    <h1>Reviews Channel</h1>
    <ul>
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="divider la la-arrow-right"></li>
        <li>Channel</li>
    </ul>
</section>

<div class="card mt-5 p-5">
    <h3>Reviews Channel</h3>
    <div class="mt-5">
        <form action="{{ route("review.channels.store") }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="flex">
                <div class="mb-5 w-1/3 mr-2">
                    <label class="label block mb-2" for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required value="@if(isset($user->name)){{ $user->name }}@else {{ old('name') }}@endif">
                </div>
            </div>
            <div class="mt-10">
                <button class="btn btn_primary mr-2 uppercase" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
