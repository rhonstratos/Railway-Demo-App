@extends('layouts.doubleNavigation')
{{-- rename this to business or shop --}}

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Dashboard</title>
@endsection

@section('content')
<div class="fixed top-0 left-0 sm:left-[45px] xl:left-[390px] w-screen sm:w-[calc(100vw_-_45px)] xl:w-[calc(100vw_-_395px)] h-[calc(100vh_-_43px)] sm:h-screen">
	<iframe src="{{ route('messages') }}" class="w-full h-full">
	</iframe>
</div>

<script>
	// do your custom scripts here
</script>
@endsection
