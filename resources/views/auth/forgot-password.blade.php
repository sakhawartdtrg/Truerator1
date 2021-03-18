@extends('layouts.auth')
@section('content')
    <section class="top-bar">

        <!-- Brand -->
        <span class="brand">Yeti</span>

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
        <div class="w-full md:w-1/2 xl:w-1/3">
            <div class="mx-5 md:mx-10">
                <h2 class="uppercase">Forgot Password?</h2>
                <h4 class="uppercase">We'll Email You Soon</h4>
            </div>
            <form class="card mt-5 p-5 md:p-10" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-5">
                    <label class="label block mb-2" for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="example@example.com" value="{{ old('email') }}">
                </div>
                <div class="flex">
                    <button type="submit" class="btn btn_primary ml-auto uppercase">Send Reset Link</button>
                </div>
            </form>
        </div>
    </div>
@endsection
