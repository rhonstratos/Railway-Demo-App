@extends('auth.layout.auth')
@section('content')
	<!-- Session Status -->
	<x-auth-session-status class="mb-4" :status="session('status')" />
	<!-- Validation Errors -->
	<x-auth-validation-errors class="mb-4" :errors="$errors" />

	<div class="bg-white shadow-xl w-full h-full rounded-xl xl:p-10 p-5">
		<form action="{{ route('g.2fa') }}" method="POST" autocomplete="off">
			@csrf
			<label for="one_time_password" class="text-sm">
				Enter your One Time Password, 6 digit code
			</label>
			<div class="p-2 flex flex-col gap-4 text-black">
				<input class="bg-[#F2F2F2] w-full rounded-xl border-none form-input text-center" type="text" name="one_time_password"
					id="one_time_password">
			</div>
			<div class="p-2 mt-5 text-white font-bold">
				<button class="m-auto w-full bg-{{$site_settings->site_color_theme}} rounded-xl py-3" type="submit">
					Proceed
				</button>
			</div>
		</form>
		<form action="{{ route('logout') }}" method="post">
			@csrf
			<div class="p-2 text-white font-bold">
				<button class="m-auto w-full bg-customgray-lightgray rounded-xl py-3" type="submit">
					Logout
				</button>
			</div>
		</form>
	</div>
@endsection
