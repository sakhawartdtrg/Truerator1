@extends('layouts.app')
@section('content')
<section class="breadcrumb">
    <h1>Reviews</h1>
    <a href="{{route('review.channels.create')}}" class="btn btn_primary uppercase float-right mt-2">Create</a>
    <ul>
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="divider la la-arrow-right"></li>
        <li>Reviews</li>
    </ul>
</section>
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-2 mr-5">
        <x-settingbar />
    </div>
    <div class="col-span-10">
        <section class="content">
            <div class="card p-5">
                <div class="grid grid-cols-4 gap-4 text-center">
                    @foreach ($channels as $item)
                        <div class="bg-green-50 p-10 rounded-lg shadow-md mx-2 p-5 justify-center">
                            <h1 class="text-xl font-bold justify-center">Use <span>{{$item->name}}</span></h1>
                            <div class="mt-4 mb-10">
                            <p class="text-gray-600 justify-center">To leave your review?</p>
                            <button class="btn btn_danger mt-5 mb-5 w-full justify-center"> Yes</button>
                            </div>
                            <p class="text-xs  justify-center">No use different site</p>
                            <button class="bg-orange-400 py-3 px-8 mt-4 rounded text-sm font-semibold hover:bg-opacity-75" data-id="{{$item->id}}">Manage</button>
                        </div>
                        
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>        
@endsection

