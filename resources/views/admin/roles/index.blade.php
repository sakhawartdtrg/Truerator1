@extends('layouts.app')
@section('content')
<section class="breadcrumb">
    <h1>Roles</h1>
    <ul>
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="divider la la-arrow-right"></li>
        <li>Roles</li>
    </ul>
</section>
<section class="content">
    <div class="card p-5">
        <div class="overflow-x-auto">
            <table class="table table-auto table_hoverable w-full" id="users-table">
                <thead>
                    <tr>
                        <th class="text-left uppercase">Sr#</th>

                        <th class="text-left uppercase">
                            Role
                        </th>

                        <th class="text-left uppercase">
                            Title
                        </th>
                        {{-- <th class="text-left uppercase">
                            Roles
                        </th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $key => $role)
                    <tr data-entry-id="{{ $role->id }}">
                        <td>
                            {{ ++$key }}
                        </td>
                        <td>
                            {{ $role->name ?? '' }}
                        </td>
                        <td>
                            {{ $role->title ?? '' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
