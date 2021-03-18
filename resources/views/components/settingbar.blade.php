<div class="card col-span-2">
    <div class="px-6 py-4 mb-2 mb-8">
        <a href="{{route('account_setup')}}" class="no-underline hover:underline" >
            <div class="flex cursor-pointer border px-4 py-2 text-lg text-grey-darkest border-b-0 ">
                <div class="pl-2">Account Setup</div>
            </div>
        </a>
        <div class="flex cursor-pointer border px-4 py-2 text-lg text-grey-darkest border-b-0" >
            <div class="pl-2">Automated Inbox Rule</div>
        </div>
        <div class="flex cursor-pointer border px-4 py-2 text-lg text-grey-darkest border-b-0" >
            <div class="pl-2">Business Hours</div>
        </div>
        <div class="flex cursor-pointer border px-4 py-2 text-lg text-grey-darkest border-b-0" >
            <div class="pl-2">Reviews</div>
        </div>
        <div class="flex cursor-pointer border px-4 py-2 text-lg text-grey-darkest border-b-0" >
            <div class="pl-2">Templates</div>
        </div>
        <a href="{{route('users.index')}}" class="no-underline hover:underline">
            <div class="flex cursor-pointer border px-4 py-2 text-lg text-grey-darkest border-b-0 {{ Request::segment(1)  == 'users' ? 'active-sidebar' : '' }}" >
                <div class="pl-2">Users</div>
            </div>
        </a>
        <a href="{{route('permission')}}" class="no-underline hover:underline">
            <div class="flex cursor-pointer border px-4 py-2 text-lg text-grey-darkest border-b-0 {{ Request::segment(1)  == 'permission' ? 'active-sidebar' : '' }}" >
                <div class="pl-2">Roles Permissions</div>
            </div>
        </a>
        <div class="flex cursor-pointer border px-4 py-2 text-lg text-grey-darkest border-b-0" >
            <div class="pl-2">Marketing Compaigns</div>
        </div>
    </div>
</div>