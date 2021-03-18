@extends('layouts.app')
@section('content')
<section class="breadcrumb">
    <h1>Roles</h1>
    <ul>
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="divider la la-arrow-right"></li>
        <li>Permission</li>
    </ul>
</section>
{{-- <pre> --}}
{{-- {{ Auth()->user()->isAn('account_owner')}} --}}
<form action="{{ route('permission_assign') }}" enctype="multipart/form-data" method="POST">
    @csrf
    <section class="content">
        <div class="card p-5">
            <div class="overflow-x-auto">
                @foreach ($permissions as $key => $val )
                <table class="table table-auto table_hoverable w-full" id="users-table">
                    <thead>
                        <tr>
                            <th class="text-left uppercase" width="25%">{{ $key }}</th>
                            @foreach($roles as $role)
                            <th class="text-left uppercase">
                                {{ $role->title }}
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @php print_r($role_abilities) @endphp --}}
                        @foreach($val as $ability)
                        {{-- @php print_r($ability['id'])@endphp --}}
                        <tr data-entry-id="{{ $ability['id'] }}">
                            <td>
                                {{ $ability['title'] ?? '' }}
                            </td>
                            @foreach($roles as $role)
                            <td>
                                {{-- {{$ability['name']}} {{$role->name}} --}}
                                {{-- @if(!Auth::user()->isAn('account_owner') && $role->name=='account_owner') here @endif --}}
                                <label class="custom-checkbox">
                                    <input type="checkbox" name="role[]" @if($role->name=='account_owner' || in_array($ability['id'],$role_abilities[$role->id]) ) checked @endif @if(!Auth::user()->isAn('account_owner') && $role->name=='account_owner') disabled @endif  value="{{ $role->id.'.'.$ability['name'] }}">
                                    <span></span>
                                    <span></span>
                                </label>
                            </td>
                            @endforeach
                            {{-- <td>
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endforeach
                <div class="mt-5">
                    <button class="btn btn_primary mr-2 uppercase float-right" type="submit">Save</button>
                </div>
            </div>
        </div>
    </section>
</form>
@endsection
