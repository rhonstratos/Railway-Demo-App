@extends('auth.layout.auth')
@section('title')
    <title>{{ Str::title(config('app.name')) }} - Login</title>
@endsection
@section('content')
    <div class=" w-full h-full
xl:m-auto
md:m-auto
mx-auto p-0">
        <div class="bg-white shadow-xl w-full h-full rounded-xl
    xl:p-10
    p-5">
            <form action="{{ route('auth.customer.password.update') }}" method="post" autocomplete="on" aria-autocomplete="both" class="w-full">
                @csrf
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <div class="p-2 flex flex-col gap-4 text-black">
                    <input class="bg-[#F2F2F2] w-full rounded-xl border-none form-input" value="{{old('email', $request->email)}}" placeholder="Email" type="text"
                        name="email" id="email">
                    <input class="bg-[#F2F2F2] w-full rounded-xl border-none form-input" placeholder="Password" type="password"
                        name="password" id="password">
                    <input class="bg-[#F2F2F2] w-full rounded-xl border-none form-input" placeholder="Confirm Password" type="password"
                    name="password_confirmation" id="password_confirmation">
                </div>

                <div class="p-2 my-5 text-white font-bold">
                    <button class="m-auto w-full bg-{{$site_settings->site_color_theme}} rounded-xl py-3" type="submit">Reset Password</button>
                </div>

            </form>
        </div>

    </div>
@endsection
