{{-- parent layout /resources/view/layouts/doubleNavigation --}}
@extends('layouts.doubleNavigation')

{{-- yield('title') --}}
@section('title')
	<title>{{ Str::title(config('app.name')) }} - Invoices</title>
@endsection

@section('page_name')
	<span class="text-[#CDCECF]">Pages</span>
	<span>/</span>
	<span>Invoices</span>
@endsection

{{-- yield('content') --}}
@section('content')
	{{-- header --}}
	<div class="business-header lg:flex-row lg:justify-between lg:items-center">
		<span class="flex flex-col gap-1">
			<h1 class="xl:basis-1/3 text-darkblue text-[24px] sm:text-[32px] font-extrabold">Invoices</h1>
			{{-- <span class="italic text-[12px]">Here are the list of users that are registered within the system</span> --}}
		</span>
	</div>

	{{-- main content --}}
	<div class="h-[calc(100vh_-_133px)] sm:h-[calc(100vh_-_102px)] xl:h-[calc(100vh_-_94px)] px-4 flex flex-col gap-2 text-[12px] 2xl:text-[14px]">
		{{-- the table --}}
		<div class="sm:business-whitecard-bg flex flex-col gap-2 sm:pt-0 grow overflow-y-auto">
			{{-- table something headings and metadata --}}
			<div class="sticky top-0 sm:pt-4 flex flex-col gap-3 bg-light sm:bg-white">
				<div class="flex flex-col md:flex-row gap-2 md:justify-between md:items-center">
					{{-- table headings --}}
					<div class="flex flex-row gap-2 justify-between items-center">
						<h2 class="text-[16px] font-semibold">Recent Invoices</h2>
					</div>

					<form class="w-full md:w-3/4 md:min-w-[250px] flex flex-col sm:flex-row gap-2 sm:items-center">
						{{-- date range --}}
						<div class="order-last sm:order-first w-full flex flex-row gap-2 justify-end items-center">
							<span class="hidden sm:inline-block">Date</span>
					
							<div class="grow flex flex-row gap-2 justify-between items-center overflow-x-auto">
								{{-- date from --}}
								<div class="w-full flex flex-col gap-1">
									<span class="hidden {{-- invisible --}}">fake span</span>
									<input class="business-input-textbox border-[1px] rounded-[8px]" type="date" name="review_date_start" id="review_date_start">
								</div>
					
								{{-- "to" --}}
								<div class="flex flex-col gap-1 justify-around">
									<span class="text-center">to</span>
								</div>
					
								{{-- date to --}}
								<div class="w-full flex flex-col gap-1">
									<span class="hidden {{-- invisible --}}">fake span</span>
									<input class="business-input-textbox border-[1px] rounded-[8px]" type="date" name="review_date_end" id="review_date_end">
								</div>
							</div>
						</div>
	
						{{-- searchbar --}}
						<div class="basis-1/2 flex flex-row bg-dirtywhite rounded-[8px] items-center">
							<i class="fa-solid fa-magnifying-glass px-2"></i>
							<input class="business-input-textbox bg-transparent w-full"
								type="text" placeholder="Search...">
						</div>
					</form>
				</div>

				{{-- metadata --}}
				<div class="py-3 hidden sm:flex flex-row justify-around items-center bg-dirtywhite text-center rounded-t-[4px]">
					<span class="basis-1/6">User ID</span>
					<span class="basis-1/6">Order ID</span>
					<span class="basis-2/6">Name</span>
					<span class="basis-1/6">Date</span>
					<span class="basis-1/6">Action</span>
				</div>
			</div>

			{{-- invoice table --}}
			<ul class="list-none">
				<li class="px-3 sm:px-0 py-2 mb-2 sm:border-b-[1px] flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-0 bg-white sm:bg-transparent rounded-[8px] shadow-lg sm:shadow-none text-center cursor-pointer"
					onclick="location.href='{{route('business.appointments.details')}}'">
					{{-- top-row --}}
					<div class="sm:basis-2/6 flex flex-row justify-between sm:justify-center items-center">
						{{-- user id --}}
						<div class="sm:basis-1/2 flex flex-row justify-center gap-1 italic">
							<span class="sm:hidden">User ID:</span>
							<span class="">123123123</span>
						</div>

						{{-- order id --}}
						<div class="sm:basis-1/2 flex flex-row justify-center gap-1 italic">
							<span class="sm:hidden">Order ID:</span>
							<span class="">abcabcabc</span>
						</div>
					</div>

					{{-- middle-row --}}
					<div class="sm:basis-4/6 flex justify-between items-center">
						{{-- user name --}}
						<div class="sm:basis-1/2 flex flex-row gap-2 sm:justify-center items-center">
							<div class="">
								<img class="object-cover w-[50px] h-[50px] rounded-full"
								src="https://th.bing.com/th/id/R.4cfb6ea3e537cc86c89e65b2230cba73?rik=DmGEyMYVAnrYog&riu=http%3a%2f%2fimg3.wikia.nocookie.net%2f__cb20131017123233%2fkyoukainokanata%2fimages%2fe%2fe2%2fMirai_Kuriyama_anime.png&ehk=VG96WJbwVGOFBVgc2joIimFafgCmbFCX02NAnIa7VR4%3d&risl=&pid=ImgRaw&r=0"
								alt="">
							</div>
							<div class="flex flex-col items-start">
								<span class="font-semibold max-w-[150px] sm:max-w-[100px] md:max-w-[200px] lg:max-w-none truncate">First Name Last Name</span>
								<span class="italic max-w-[150px] sm:max-w-[100px] md:max-w-[200px] lg:max-w-none truncate">customerako@gmail.com</span>
							</div>
						</div>

						<div class="sm:basis-1/2 flex gap-2 items-center">
							{{-- date registered --}}
							<div class="sm:basis-1/2 flex flex-col sm:justify-center items-center">
								<span class="sm:hidden">Billing Date:</span>
								<span>{{ $user->created_at->format('M d, o') }}</span>
							</div>
	
							<div class="sm:basis-1/2 flex justify-center items-center">
								<span class="text-[20px]">&#10095;</span>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>

		{{-- put pagination here --}}
		<span>pagination here</span>
	</div>

	<script>
		//custom scripts here
	</script>
@endsection
