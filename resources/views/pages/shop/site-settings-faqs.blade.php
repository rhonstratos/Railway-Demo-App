@extends('layouts.doubleNavigation')
{{-- rename this to business or shop --}}

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Site Settings</title>
@endsection

@section('content')
{{-- header --}}
<div class="business-header flex-row justify-between items-center">
	<span class="w-fit flex flex-row gap-3 items-center cursor-pointer"
		onclick="location.href='{{ route('business.site-settings.index') }}'">
		<span class="text-[20px]">&#10094;</span>
		<div class="flex flex-col gap-1">
			<h1 class="xl:basis-1/3 text-darkblue text-[24px] sm:text-[32px] font-extrabold">Frequently Asked Questions</h1>
			<span class="italic text-[12px]">Edit your faqs here</span>
			<!-- Session Status -->
			<x-auth-session-status class="mb-4" :status="session('status')" />

			<!-- Validation Errors -->
			<x-auth-validation-errors class="mb-4" :errors="$errors" />
		</div>
	</span>

	<button form="faqs_form" class="business-label-as-button bg-{{$site_settings->site_color_theme}} gap-2 p-3 sm:px-3 sm:py-1">
		<i class="fa-solid fa-floppy-disk"></i>
		<span class="hidden sm:inline-block">save</span>
	</button>
</div>

{{-- main content --}}
<form id="faqs_form" action="{{ route('business.site-settings.form9') }}" method="post"
	class="h-[calc(100vh_-_133px)] sm:h-[calc(100vh_-_102px)] xl:h-[calc(100vh_-_94px)] px-4 pb-4 flex flex-col gap-2 text-[12px] 2xl:text-[14px] overflow-y-auto">
	@csrf
	@method('PATCH')
	<div class="flex flex-col gap-2">
		@foreach (range(1, 5) as $faq)
			<div class="pl-2 flex flex-row items-center bg-{{$site_settings->site_color_theme}} text-white rounded-[4px] shadow-lg">
				<span><i class="fa-solid fa-pencil"></i></span>
				<input
					class="w-full business-input-textbox bg-transparent text-white text-[14px] placeholder:text-white font-bold rounded-[4px]"
					type="text" placeholder="Enter Frequently Asked Question #{{ $loop->iteration }} here, ex. how do we do things?"
					name="faq[{{ $loop->iteration }}][header]" required
					value="{{ isset($shop->faqs[$loop->iteration]['header']) ? $shop->faqs[$loop->iteration]['header'] : null }}">
			</div>
			<textarea class="border-none px-2 py-1 border-[1px] bg-white text-[12px] rounded-[4px] shadow-lg"
				name="faq[{{ $loop->iteration }}][body]" rows="5" placeholder="put your answer here">{{ isset($shop->faqs[$loop->iteration]['body']) ? $shop->faqs[$loop->iteration]['body'] : null }}</textarea>
		@endforeach
	</div>
</form>

<script>
	//custom scripts here
</script>
@endsection
