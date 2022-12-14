@extends('auth.layout.auth')
@section('title')
	<title>{{ Str::title(config('app.name')) }} - You are Banned</title>
@endsection
@section('content')
	<!-- Session Status -->
	<x-auth-session-status class="mb-4" :status="session('status')" />
	<!-- Validation Errors -->
	<x-auth-validation-errors class="mb-4" :errors="$errors" />

	<div class="bg-white shadow-xl w-full h-full rounded-xl xl:p-10 p-5 text-center">
		<label for="one_time_password" class="text-sm">
			You are banned by the admins from using this site
		</label>
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
