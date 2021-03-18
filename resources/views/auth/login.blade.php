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
            <a href="{{ route('register') }}" class="btn btn_primary uppercase ml-5">Register</a>
        </nav>
    </section>

    <div class="container flex items-center justify-center mt-20 py-10">
        <div class="w-full md:w-1/2 xl:w-1/3">
            <div class="mx-5 md:mx-10">
                <h2 class="uppercase">It’s Great To See You!</h2>
                <h4 class="uppercase">Login Here</h4>
            </div>
            <form class="card mt-5 p-5 md:p-10" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-5">
                    <label class="label block mb-2" for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="example@example.com" value="{{ old('email') }}">
                </div>
                <div class="mb-5">
                    <label class="label block mb-2" for="password">Password</label>
                    <label class="form-control-addon-within">
                        <input type="password" class="form-control border-none" name="password" id="password" required autocomplete="current-password" value="{{ old('password') }}">
                        <span class="flex items-center pr-4"><button type="button"
                                class="btn btn-link text-gray-600 dark:text-gray-600 la la-eye text-xl leading-none"
                                data-toggle="password-visibility"></button></span>
                    </label>
                </div>
                <div class="flex items-center">
                    @if (Route::has('password.request'))
                        <a class="text-sm uppercase" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                    <button type="submit" class="btn btn_primary ml-auto uppercase">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection('content')

