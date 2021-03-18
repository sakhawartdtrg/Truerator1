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
                <div class="overflow-x-auto">
                    <table class="table table-auto table_hoverable w-full" id="users-table">
                        <thead>
                            <tr>
                                <th class="text-left uppercase">
                                    Sr#
                                </th>
                                <th class="text-left uppercase">
                                    Name
                                </th>
                                <th class="text-left uppercase">
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($channels as $key => $channel)
                                <tr data-entry-id="{{ $channel->id }}">
                                    <td>
                                        {{ ++$key }}
                                    </td>
                                    <td>
                                        {{ $channel->name ?? 'N/A' }}
                                    </td>
                                    <td>
                                    @if (Auth::user()->isAn('administrator'))
                                        <a class="btn btn-xs btn-info"
                                            href="{{ route('.edit', $channel->id) }}">
                                            Edit
                                        </a>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>        
@endsection

