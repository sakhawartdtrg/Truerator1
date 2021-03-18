@extends('layouts.app')
@section('content')
<section class="breadcrumb">
    <h1>Abilities</h1>
    <ul>
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="divider la la-arrow-right"></li>
        <li>Abilities</li>
    </ul>
</section>
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
                            Title
                        </th>
                        <th class="text-left uppercase">
                            Group
                        </th>
                        <th class="text-left uppercase">
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($abilities as $key => $ability)
                        <tr data-entry-id="{{ $ability->id }}">
                            <td>
                                {{ ++$key }}
                            </td>
                            <td>
                                {{ $ability->name ?? 'N/A' }}
                            </td>
                            <td>
                                {{ $ability->title ?? 'N/A' }}
                            </td>
                            <td>
                                {{ $ability->group->name ?? 'N/A' }}
                            </td>
                            <td>
                            @if (Auth::user()->isAn('administrator'))
                                <a class="btn btn-xs btn-primary"
                                    href="{{ route('admin.abilities.show', $ability->id) }}">
                                    View
                                </a>

                                <a class="btn btn-xs btn-info"
                                    href="{{ route('admin.abilities.edit', $ability->id) }}">
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
@endsection
@section('scripts')
@parent
<script>


</script>
@endsection
