<!DOCTYPE html>
<html class="" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	@include('includes.heads')
	@yield('title')
</head>

<body class="bg-[#F8F9FA] ">
	<div class="grid place-items-center h-screen m-auto p-0
    xl:grid-cols-2
    md:grid-cols-1">
		<div class="text-[#344767] xl:text-2xl text-md
        xl:p-0 xl:m-auto xl:p-auto
        md:m-auto md:p-auto md:pt-[4rem] md:pb-0
        pt-5 pb-0 mb-0">
			@php
				$shop = \App\Models\Shop::firstOrFail();
				$_site_icon = !is_null($site_settings->site_icon) ? asset('storage/master/assets/' . $site_settings->site_icon) : asset('assets/Rectify/icons/rectify-dark-blue.svg');
			@endphp
			<img src="{{ $_site_icon }}" class="text-center mx-auto xl:w-5/6 md:w-5/6 w-4/6" alt="{{ Str::title(config('app.name')) }}">
			<p class="mx-auto xl:text-start text-center">
				{{ $shop->tagline }}
			</p>
		</div>
		<div class="m-auto w-full h-max
        xl:px-[6rem] xl:py-[9rem]
        md:px-[3rem] md:py-[4rem]
        px-3 py-0">
			@yield('content')
		</div>
	</div>
	@include('includes.feet')
</body>

</html>
