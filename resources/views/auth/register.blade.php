@extends('layouts.auth')
@section('content')
<section class="top-bar">

    <!-- Brand -->
    <span class="brand">TrueRator</span>

    <nav class="flex items-center ml-auto">

        <!-- Dark Mode -->
        <label class="switch switch_outlined" data-toggle="tooltip" data-tippy-content="Toggle Dark Mode">
            <input id="darkModeToggler" type="checkbox">
            <span></span>
        </label>

        <!-- Fullscreen -->
        <button type="button"
            class="hidden lg:inline-block btn-link ml-5 text-2xl leading-none la la-expand-arrows-alt"
            data-toggle="tooltip" data-tippy-content="Fullscreen" id="fullScreenToggler"></button>
        <a href="auth-login.html" class="btn btn_primary uppercase ml-5">Login</a>
    </nav>
</section>

<div class="container flex items-center justify-center mt-20 py-10">
    <div class="w-full md:w-1/2 xl:w-1/2">
        <div class="mx-5 md:mx-10">
            <h2 class="uppercase">Create Your Account</h2>
            <h4 class="uppercase">Let's Roll</h4>
        </div>
        <form class="card mt-5 p-5 md:p-10" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="flex">
                <div class="mb-5 w-1/2 mr-2">
                    <label class="label block mb-2" for="first_name">First Name</label>
                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="John" value="{{ old('first_name') }}">
                </div>
                <div class="mb-5 w-1/2">
                    <label class="label block mb-2" for="last_name">Last Name</label>
                    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Doe" value="{{ old('last_name') }}">
                </div>
            </div>
            <div class="mb-5">
                <label class="label block mb-2" for="mobile">Mobile</label>
                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="" value="{{ old('mobile') }}">
            </div>
            <div class="mb-5">
                <label class="label block mb-2" for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="example@example.com" value="{{ old('email') }}">
            </div>
            <div class="flex">

                <div class="mb-5 w-1/2 mr-2">
                    <label class="label block mb-2" for="password">Password</label>
                    <label class="form-control-addon-within">
                        <input type="password" class="form-control border-none" id="password" name="password">
                        <span class="flex items-center pr-4"><button type="button"
                                class="btn btn-link la la-eye text-gray-600 text-xl leading-none"
                                data-toggle="password-visibility"></button></span>
                    </label>
                </div>
                <div class="mb-5 w-1/2">
                    <label class="label block mb-2" for="password">Confirm Password</label>
                    <label class="form-control-addon-within">
                        <input type="password" class="form-control border-none" id="password" name="password_confirmation">
                        <span class="flex items-center pr-4">
                            <button type="button"
                                class="btn btn-link la la-eye text-gray-600 text-xl leading-none"
                                data-toggle="password-visibility"></button>
                        </span>
                    </label>
                </div>
            </div>
            <div class="flex">
                <button type="submit" class="btn btn_primary ml-auto uppercase">Register</button>
            </div>
        </form>
    </div>
</div>
@endsection
