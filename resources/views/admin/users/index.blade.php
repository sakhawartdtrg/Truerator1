@extends('layouts.app')
@section('content')
    <section class="breadcrumb">
        <h1 class="inline-block">Users</h1>
        <a href="{{route('users.create')}}" class="btn btn_primary uppercase float-right mt-2">Create</a>
        <ul>
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="divider la la-arrow-right"></li>
            <li>Users</li>
        </ul>
    </section>
    <!-- Main content -->
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
                                    <th class="text-left uppercase">Sr#</th>
        
                                    <th class="text-left uppercase">
                                        Name
                                    </th>
                                    <th class="text-left uppercase">
                                        Email
                                    </th>
                                    <th class="text-left uppercase">
                                        Role
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                    <tr data-entry-id="{{ $user->id }}">
        
                                        <td>
                                            {{ ++$key }}
                                        </td>
                                        <td>
                                            {{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $user->email ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($user->roles->pluck('title') as $role)
                                                <span class="badge badge_primary">{{ $role }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{--  <a class="btn btn-xs btn-primary" href="{{ route('users.show', $user->id) }}">
                                                view
                                            </a>
        
                                            <a class="btn btn-xs btn-info" href="{{ route('users.edit', $user->id) }}">
                                                edit
                                            </a>  --}}
        
                                            <td class="text-right whitespace-no-wrap">
                                                <div class="inline-flex ml-auto">
                                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-icon btn_outlined btn_secondary"><span class="la la-pen-fancy"></span></a>
                                                    {{-- <button  class="btn btn-icon btn_outlined btn_secondary" class="la la-pen-fancy" data-toggle="modal" data-target="#exampleModalAside"><span><i class="las la-eye"></i></span></button> --}}
                                                    {{--  <a href="{{ route('users/delete/'.$user->id) }}" class="btn btn-icon btn_outlined btn_danger ml-2"><span class="la la-trash-alt"></span></a>  --}}
                                                </div>
                                            </td>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div>
    {{-- <t-input value="Hello world" name="my-input" /></t-input>
    <t-modal name="my-modal" header="Update Profile">

    <template v-slot:footer>
        <div class="flex justify-between">
          <t-button @click="$modal.show('my-modal')" type="button" class="btn btn_secondary uppercase">
            Cancel
          </t-button>
          <t-button @click="$modal.hide('my-modal')" type="button" class="btn btn_primary uppercase ml-2" >
            Ok
          </t-button>
        </div>
      </template>
    </t-modal>

    <button  @click="$modal.show('my-modal')" class="btn btn_secondary uppercase" type="button">Show modal</button> --}}
    </div>
    {{--  <button class="btn btn_primary uppercase" data-toggle="modal" data-target="#exampleModalAside">Open Modal</button>  --}}
@endsection

