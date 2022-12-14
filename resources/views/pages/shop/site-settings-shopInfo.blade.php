@extends('layouts.doubleNavigation')
{{-- rename this to business or shop --}}

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Site Settings</title>
@endsection

@section('content')
<form class="px-3" action="{{route('business.site-settings.form3')}}" method="post">
	@csrf
	@method('PATCH')
	{{-- header --}}
	<div class="business-header px-0 flex-row justify-between items-center">
		<span class="w-fit flex flex-row gap-3 items-center cursor-pointer"
			onclick="location.href='{{ route('business.site-settings.index') }}'">
			<span class="text-[20px]">&#10094;</span>
			<div class="flex flex-col gap-1">
				<h1 class="xl:basis-1/3 text-darkblue text-[24px] sm:text-[32px] font-extrabold">Shop Information</h1>
				<span class="italic text-[12px]">Edit your shops information here</span>
			</div>
		</span>

		<button type="submit" class="business-label-as-button bg-{{$site_settings->site_color_theme}} gap-2 p-3 sm:px-3 sm:py-1">
			<i class="fa-solid fa-floppy-disk"></i>
			<span class="hidden sm:inline-block">Save</span>
		</button>
	</div>

	{{-- main content --}}
	<div class="h-[calc(100vh_-_133px)] sm:h-[calc(100vh_-_102px)] xl:h-[calc(100vh_-_94px)] px-4 pb-4 flex flex-col lg:flex-row gap-2 text-[12px] 2xl:text-[14px] overflow-y-auto">
		{{-- about us section --}}
		<div class="lg:basis-1/2 flex flex-col gap-2">
			<h2 class="text-[16px] font-semibold">About Us section <span class="text-{{$site_settings->site_color_theme}}">*</span></h2>
			<section class="business-whitecard-bg">
				{{-- about us --}}
				<div class="flex flex-col gap-2">
					<span class="font-semibold">About your shop</span>

					{{-- shop heading --}}
					<input class="mx-3 business-input-textbox" type="text" name="shop_aboutUs[heading]" value="{{$shop->about_us['heading'] ?? null}}" placeholder="Heading">

					{{-- Description about your shop --}}
					<textarea required class="mx-3 border-none px-2 py-1 bg-dirtywhite text-[12px] 2xl:text-[14px] rounded-[4px]"
					 name="shop_aboutUs[desc]" id="" rows="5" placeholder="Description about your shop">{{$shop->about_us['desc'] ?? null}}</textarea>
				</div>

				{{-- history --}}
				<div class="flex flex-col gap-2">
					<span class="font-semibold">History</span>

					<div class="flex flex-col gap-2">
						<textarea required class="mx-3 border-none px-2 py-1 bg-dirtywhite text-[12px] 2xl:text-[14px] rounded-[4px]"
						 name="shop_aboutUs[history]" id="" rows="5" placeholder="Type about your shop's history">{{$shop->about_us['history'] ?? null}}</textarea>
					</div>
				</div>

				{{-- Mission & vision --}}
				<div class="flex flex-col gap-2">
					<span class="font-semibold">Mission & Vision</span>

					<div class="flex flex-col gap-2">
						<div class="flex flex-col gap-2">
							<textarea required class="mx-3 border-none px-2 py-1 bg-dirtywhite text-[12px] 2xl:text-[14px] rounded-[4px]"
							 name="shop_aboutUs[mission]" id="" rows="4" placeholder="Your mission">{{$shop->about_us['mission'] ?? null}}</textarea>
						</div>

						<div class="flex flex-col gap-2">
							<textarea required class="mx-3 border-none px-2 py-1 bg-dirtywhite text-[12px] 2xl:text-[14px] rounded-[4px]"
							 name="shop_aboutUs[vission]" id="" rows="4" placeholder="Your vision">{{$shop->about_us['vission'] ?? null}}</textarea>
						</div>
					</div>
				</div>
			</section>

			{{-- Shop description section --}}
			<h2 class="text-[16px] font-semibold">Shop Description section</h2>
			<section class="business-whitecard-bg">
				<span>Description <span class="text-{{$site_settings->site_color_theme}}">*</span></span>
				<textarea class="mx-3 business-input-textbox" rows="3" required name="shop_desc">{{$shop->description ?? null}}</textarea>
			</section>
		</div>

		<div class="lg:basis-1/2 lg:h-fit flex flex-col gap-2">
			{{-- Contact information section --}}
			<div class="flex flex-col gap-2">
				<h2 class="text-[16px] font-semibold">Contact Information section</h2>
				<section class="business-whitecard-bg">
					<span>Landline</span>
					<input class="mx-3 business-input-textbox" placeholder="Undefined" value="{{ $shop->contacts['landline'] ?? null }}"
						type="text" name="shop_contacts[landline]">

					<span>Mobile</span>
					<input class="mx-3 business-input-textbox" placeholder="Undefined" value="{{ $shop->contacts['mobile'] ?? null }}" type="text"
						name="shop_contacts[mobile]">

					<span>Email <span class="text-{{$site_settings->site_color_theme}}">*</span></span>
					<input class="mx-3 business-input-textbox" placeholder="Undefined" value="{{ $shop->contacts['email'] ?? null }}" required
						type="email" name="shop_contacts[email]">
				</section>
			</div>

			{{-- follow us section --}}
			<div class="flex flex-col gap-2">
				<h2 class="text-[16px] font-semibold">Follow Us section</h2>
				<section class="business-whitecard-bg">
					<span>Your Facebook link</span>
					<input class="mx-3 business-input-textbox" placeholder="Undefined" value="{{ $shop->socials['facebook'] ?? null }}"
						type="url" name="shop_socials[facebook]">

					<span>Your Instagram link</span>
					<input class="mx-3 business-input-textbox" placeholder="Undefined" value="{{ $shop->socials['instagram'] ?? null }}"
						type="url" name="shop_socials[instagram]">

					<span>Your Tiktok link</span>
					<input class="mx-3 business-input-textbox" placeholder="Undefined" value="{{ $shop->socials['tiktok'] ?? null }}" type="url"
						name="shop_socials[tiktok]">

					<span>Your Twitter link</span>
					<input class="mx-3 business-input-textbox" placeholder="Undefined" value="{{ $shop->socials['twitter'] ?? null }}" type="url"
						name="shop_socials[twitter]">
				</section>
			</div>
		</div>
	</div>
</form>

<script>
	//custom scripts here
</script>
@endsection
