@extends('layouts.doubleNavigation')
{{-- rename this to business or shop --}}

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Site Settings</title>
@endsection

@section('content')
	<form action="{{ route('business.site-settings.system-images.store') }}" method="post" enctype="multipart/form-data">
		@csrf
		@method('PATCH')

		{{-- header --}}
		<div class="business-header flex-row gap-4 justify-between items-center sticky top-[16px]">
			<span class="w-fit flex flex-row gap-3 items-center cursor-pointer" onclick="location.href='{{ route('business.site-settings.index') }}'">
				<span class="text-[20px]">&#10094;</span>
				<div class="flex flex-col gap-1">
					<h1 class="xl:basis-1/3 text-darkblue text-[24px] sm:text-[32px] font-extrabold">System Logo, Icons and Splash Screens</h1>
					<span class="italic text-[12px]">Put all your logos, icons and splash screens here that caters all screen sizes</span>
				</div>
			</span>

			<button class="business-label-as-button bg-{{ $site_settings->site_color_theme }} w-fit px-3 py-2 flex gap-2 text-[12px] 2xl:text-[14px] rounded-[8px] md:shadow-lg">
				<i class="fa-solid fa-floppy-disk"></i>
				<span>Save</span>
			</button>
		</div>

		{{-- takip sa top part --}}
		<div class="bg-white fixed top-0 left-0 w-full h-[16px]"></div>

		{{-- main content --}}
		<div class="xl:h-[calc(100vh_-_94px)] px-4 pb-4 flex flex-col gap-2 xl:overflow-y-auto">
			{{-- shop logo --}}
			<div class="business-whitecard-bg">
				<span class="font-semibold">System Logo and Name</span>
				<label for="site-logo" class="w-full flex flex-col gap-2 justify-center items-center cursor-pointer">
					<div id="site-logo-label">
						<img class="object-cover w-[228px] lg:w-[456px] h-[80px] lg:h-[160px] border-[1px]"
							src="{{ !is_null($site_settings->site_icon) ? asset('storage/master/assets/' . $site_settings->site_icon) : asset('assets/Rectify/icons/rectify-dark-blue.svg') }}" alt="img">
					</div>
					<span>Logo</span>
				</label>
				<span class="">Name</span>
				<input class="business-input-textbox" type="text" name="site_name" value="{{ $site_settings->site_name }}" placeholder="Defaults to: Rectify">
				<input id="site-logo" type="file" accept="image/*" name="site_logo" hidden class="hidden" onchange="previewSiteLogo('#site-logo-label',this.files)">
			</div>

			<div class="flex flex-col lg:flex-row gap-2 items-center lg:items-start mb-[43px] sm:mb-0">
				{{-- icons --}}
				<div class="business-whitecard-bg w-full">
					<div class="flex flex-row justify-between items-center cursor-pointer" onclick="collapseCards('collapsibleIconsCard')">
						<span class="font-semibold">Icons</span>
						<i class="fa-solid fa-chevron-down"></i>
					</div>

					<div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-3 2xl:grid-cols-4 gap-2 place-items-center" id="collapsibleIconsCard">
						@php
							$_icons = ['57x57', '60x60', '72x72', '76x76', '96x96', '114x114', '152x152', '180x180', '192x192', '256x256', '384x384', '512x512'];
						@endphp
						@foreach ($_icons as $icons)
							<label for="icon-{{ $icons }}"class="flex flex-col justify-center items-center cursor-pointer">
								<div id="icon-{{ $icons }}-label">
									@if (isset($site_settings->site_assets[$icons]) && !is_null($site_settings->site_assets[$icons]))
										<img class="object-cover w-[90px] h-[90px]" src="{{ asset('storage/master/assets/' . $site_settings->site_assets[$icons]) }}" alt="img">
									@else
										<i class="fa-solid fa-image w-[90px] h-[90px] text-customgray-gray"></i>
									@endif
								</div>
								<span class="text-center">Icon {{ $icons }}</span>
							</label>
							<input id="icon-{{ $icons }}" type="file" accept="image/*" name="icon[{{ $icons }}]" hidden class="hidden" onchange="previewIcon('#icon-{{ $icons }}-label',this.files)">
						@endforeach
					</div>
				</div>

				{{-- splash screens --}}
				<div class="business-whitecard-bg w-full">
					<div class="flex flex-row justify-between items-center cursor-pointer" onclick="collapseCards('collapsibleSplashScreensCard')">
						<span class="font-semibold">Splash Screens</span>
						<i class="fa-solid fa-chevron-down"></i>
					</div>

					<div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-3 2xl:grid-cols-4 gap-2 place-items-center" id="collapsibleSplashScreensCard">
						@php
							$_splash = ['641x1136', '750x1334', '828x1792', '1125x2436', '1242x2608', '1242x2688', '1536x2048', '1668x2224', '1668x2388', '2048x2732'];
						@endphp
						@foreach ($_splash as $splash)
							<label for="splash-{{ $splash }}" class="flex flex-col justify-center items-center cursor-pointer">
								<div id="splash-{{ $splash }}-label">
									@if (isset($site_settings->site_assets[$splash]) && !is_null($site_settings->site_assets[$splash]))
										<img class="object-cover w-[80px] h-[142px]" src="{{ asset('storage/master/assets/' . $site_settings->site_assets[$splash]) }}" alt="img">
									@else
										<i class="fa-solid fa-image w-[80px] h-[142px] text-customgray-gray"></i>
									@endif
								</div>
								<span class="text-center">Splash screen {{ $splash }}</span>
							</label>
							<input id="splash-{{ $splash }}" type="file" accept="image/*" name="splash[{{ $splash }}]" hidden class="hidden" onchange="previewIcon('#splash-{{ $splash }}-label',this.files)">
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</form>
	@push('scripts')
		<script>
			var lightbox
			const previewIcon = (label, files) => {
				let reader = new FileReader();
				reader.onload = (e) => {
					$(label).html(
						`<img class="object-cover w-[90px] h-[90px]" src="${e.target.result}" alt="img">`
					)
				}
				reader.readAsDataURL(files[0])
			};
			const previewSplash = (label, files) => {
				let reader = new FileReader();
				reader.onload = (e) => {
					$(label).html(
						`<img class="object-cover w-[80px] h-[142px]" src="${e.target.result}" alt="img">`
					)
				}
				reader.readAsDataURL(files[0])
			};
			const previewSiteLogo = (label, files) => {
				let reader = new FileReader();
				reader.onload = (e) => {
					$(label).html(
						`<img class="object-cover w-[228px] lg:w-[456px] h-[80px] lg:h-[160px] border-[1px]" src="${e.target.result}" alt="">`
					)
				}
				reader.readAsDataURL(files[0])
			};
			$(() => {

			});
		</script>
	@endpush
@endsection
