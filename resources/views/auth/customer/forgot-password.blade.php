@extends('auth.layout.auth')
@section('title')
    <title>{{ Str::title(config('app.name')) }} - Forgot Password</title>
@endsection
@section('content')
    <div class=" w-full h-full
xl:m-auto
md:m-auto
mx-auto p-0">
        <div class="bg-white shadow-xl w-full h-full rounded-xl
    xl:p-10
    p-5">
            <form action="{{ route('auth.customer.password.email') }}" method="post" autocomplete="on" aria-autocomplete="both"
                class="w-full">
                @csrf
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <div class="p-2 flex flex-col gap-4 text-black">
                    <div class="text-center">
                        <p class="text-sm">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                    </div>
                    <input class="bg-[#F2F2F2] w-full rounded-xl border-none form-input" placeholder="Email" type="text"
                        name="email" id="email">
                </div>

                <div class="p-2 my-5 text-white font-bold">
                    <button class="m-auto w-full bg-{{$site_settings->site_color_theme}} rounded-xl py-3" type="submit">Send Password Reset Link</button>
                </div>

                <div class="text-white text-center">
                    <a class="text-{{$site_settings->site_color_theme}} hover:text-red-500" href="{{route('auth.customer.login')}}">Remembered your password? Login here</a>
                </div>

            </form>
        </div>

    </div>
@endsection
