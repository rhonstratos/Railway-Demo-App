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
			<form action="{{ route('auth.customer.login') }}" method="post" autocomplete="on" aria-autocomplete="both" class="w-full">
				@csrf
				<!-- Session Status -->
				<x-auth-session-status class="mb-4" :status="session('status')" />

				<!-- Validation Errors -->
				<x-auth-validation-errors class="mb-4" :errors="$errors" />

				<div class="p-2 flex flex-col gap-4 text-black">
					<input class="bg-[#F2F2F2] w-full rounded-xl border-none form-input" placeholder="Email" type="text"
						name="email" id="email" autocomplete="email">
					<input class="bg-[#F2F2F2] w-full rounded-xl border-none form-input" placeholder="Password" type="password"
						name="password" id="password" autocomplete="current-password">
				</div>

				<div class="p-2 mt-5 text-white font-bold">
					<button class="m-auto w-full bg-{{$site_settings->site_color_theme}} rounded-xl py-3" type="submit">Login</button>
				</div>
				@if (Route::has('auth.business.login'))
					<div class="p-2 mb-5 text-white font-bold">
						<button data-href="{{ route('auth.business.login') }}" onclick="location.href=this.dataset.href"
							class="m-auto w-full bg-customgray-lightgray hover:text-white hover:bg-{{$site_settings->site_color_theme}} rounded-xl py-3" type="button">
							Registered shop owner? Login Here
						</button>
					</div>
				@endif
				@if (Route::has('auth.customer.password.request'))
					<div class="text-white text-center">
						<a class="text-{{$site_settings->site_color_theme}} hover:text-red-500 hover:font-bold" href="{{ route('auth.customer.password.request') }}">
							Forgot Password?
						</a>
					</div>
				@endif
			</form>
		</div>
		@if (Route::has('auth.customer.register'))
			<div class="mt-4 text-center">
				Don't have an account yet? <a class="text-{{$site_settings->site_color_theme}} hover:text-red-500 font-semibold"
					href="{{ route('auth.customer.register') }}">Register
					Here</a>
			</div>
		@endif
	</div>
@endsection
