@extends('layouts.doubleNavigation')
{{-- rename this to business or shop --}}

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Site Settings</title>
@endsection

@section('content')
	{{-- header --}}
	<div class="business-header">
		<span class="flex flex-col gap-1">
			<h1 class="xl:basis-1/3 text-darkblue text-[24px] sm:text-[32px] font-extrabold">Settings</h1>
			<span class="italic text-[12px]">Modify the system's settings</span>
			<!-- Session Status -->
			<x-auth-session-status class="mb-4" :status="session('status')" />

			<!-- Validation Errors -->
			<x-auth-validation-errors class="mb-4" :errors="$errors" />
		</span>
	</div>

	{{-- main content --}}
	<div class="h-[calc(100vh_-_129px)] sm:h-[calc(100vh_-_102px)] px-4 pb-4 flex flex-col gap-2 overflow-y-auto capitalize">
		{{-- content management --}}
		<h2 class="font-semibold">Content Management</h2>
		<section class="flex flex-col lg:flex-row gap-2 text-[12px] 2xl:text-[14px]">
			<div class="lg:w-3/5 flex flex-col gap-2">
				{{-- system name and etc --}}
				<div class="business-whitecard-bg">
					<div class="flex flex-row justify-between items-center">
						<span class="font-semibold">System name, logo, and tagline</span>
						<label class="business-label-as-button w-[59px] bg-{{ $site_settings->site_color_theme }} gap-1" for="settingsModalCheckbox" onclick="settingsModal('systemNameModal')">
							<i class="fa-solid fa-pencil"></i>
							<span>Edit</span>
						</label>
					</div>

					<div class="w-full flex flex-row gap-3 justify-start items-center">
						{{-- shop image --}}
						@if ($user->accountSettings->profile_img)
							<img class="object-cover w-[75px] h-[75px] border-[1px] rounded-full" src="{{ asset('storage/users/' . $user->userId . '/images/profile/' . $user->accountSettings->profile_img) }}" alt="">
						@else
							<i class="fa-solid fa-shop w-[75px] h-[75px] border-[1px] rounded-full text-{{ $site_settings->site_color_theme }}"></i>
						@endif

						<div class="flex flex-col gap-1">
							<span class="text-[24px]">{{ $shop->name }}</span>
							<span class="text-[14px]">{{ $shop->tagline }}</span>
						</div>
					</div>

					@if (false)
						{{-- shop logo --}}
						<div class="w-full flex flex-col gap-2 justify-center items-center">
							{{-- default to --}}
							<img class="object-cover w-[228px] h-[80px] border-[1px]" src="{{ asset('storage/users/' . $user->userId . '/images/profile/' . $user->accountSettings->profile_img) }}" alt="">
							{{-- @if ($user->accountSettings->profile_img)
						@else
							<i class="fa-solid fa-shop w-[75px] h-[75px] border-[1px] rounded-full text-{{$site_settings->site_color_theme}}"></i>
						@endif --}}
							<span>Shop logo</span>
						</div>
					@endif
				</div>

				{{-- shop information --}}
				<button class="business-whitecard-bg" onclick="location.href='{{ route('business.site-settings.info') }}'">
					<div class="w-full flex flex-row justify-between items-center">
						<span class="font-semibold">Shop information </span>
						<span>❯</span>
					</div>
				</button>

				{{-- FAQs --}}
				<button class="business-whitecard-bg" onclick="location.href='{{ route('business.site-settings.system-images') }}'">
					<div class="w-full flex flex-row justify-between items-center">
						<span class="font-semibold">System Logo, Icons, and Splash Screens</span>
						<span>❯</span>
					</div>
				</button>

				{{-- FAQs --}}
				<button class="business-whitecard-bg" onclick="location.href='{{ route('business.site-settings.faqs') }}'">
					<div class="w-full flex flex-row justify-between items-center">
						<span class="font-semibold">Frequently Asked Questions</span>
						<span>❯</span>
					</div>
				</button>

				{{-- Your gallery --}}
				<div class="business-whitecard-bg">
					<button class="flex flex-row justify-between items-center" onclick="location.href='{{ route('business.site-settings.gallery') }}'">
						<span class="font-semibold">Your Gallery</span>
						<span>❯</span>
					</button>

					{{-- banners --}}
					<div class="flex flex-row gap-2 items-center overflow-x-auto">
						@if (!is_null($site_settings) && isset($site_settings->gallery) && array_filter(array_map('array_filter', $site_settings->gallery)))
							@foreach (range(1, 5) as $i)
								@php
									$_gallery = $site_settings->gallery;
								@endphp
								@if (is_null($_gallery['gallery_title'][$i]) || is_null($_gallery['gallery_desc'][$i]) || is_null($_gallery['gallery_img'][$i]))
									@continue
								@endif
								<a href="{{ asset('storage/master/gallery/' . $_gallery['gallery_img'][$i]) }}" class="glightbox" data-gallery="shop_gallery"
									data-glightbox="title: {{ $_gallery['gallery_title'][$i] }}; description: {{ $_gallery['gallery_desc'][$i] }}">
									<div class="w-[100px] h-[100px] rounded-[8px] overflow-hidden">
										<img class="w-full h-full object-cover" src="{{ asset('storage/master/gallery/' . $_gallery['gallery_img'][$i]) }}" alt="img">
									</div>
								</a>
							@endforeach
						@else
							<div class="w-full h-[125px] flex justify-center items-center">
								<span>No banners attached</span>
							</div>
						@endif
					</div>
				</div>
			</div>

			{{-- Shop location --}}
			<div class="business-whitecard-bg lg:w-2/5 h-fit">
				<div class="flex flex-row justify-between items-center">
					<span class="font-semibold">Shop location</span>
					<label class="business-label-as-button w-[59px] bg-{{ $site_settings->site_color_theme }} gap-1" for="settingsModalCheckbox" onclick="settingsModal('shopLocationModal')">
						<i class="fa-solid fa-pencil"></i>
						<span>Edit</span>
					</label>
				</div>

				<div class="flex flex-col gap-1">
					<div class="flex flex-col">
						<span class="">Address</span>
						<p class="mx-2">{{ implode(', ', $shop->address) }}</p>
					</div>
					<div class="flex flex-col truncate">
						<span>Google Maps Link</span>
						<a class="mx-2" href="https://goo.gl/maps/pWk41ifWhYuaQ3pa7">
							{{ $shop->googleMaps ?? __('undefined') }}
						</a>
					</div>

					@if ($shop->googleMaps_embed)
						{{-- maps --}}
						<div class="flex flex-col justify-center items-center">
							<span>Google Maps Preview</span>
							<div class="h-[150px] w-full border-[1px] flex justify-center items-center rounded-[4px] overflow-hidden">
								<iframe class="mx-auto w-full h-full" src="{{ $shop->googleMaps_embed }}" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
							</div>
						</div>
					@endif
				</div>
			</div>
		</section>

		{{-- shop Opertation --}}
		<h2 class="font-semibold">Shop Opertation</h2>
		<section class="lg:w-[calc(60%_-_8px)] flex flex-col gap-2 text-[12px] 2xl:text-[14px]">
			{{-- operating hours --}}
			<div class="business-whitecard-bg">
				<div class="flex flex-row justify-between items-center">
					<span class="font-semibold">Appointment Settings</span>
					<label class="business-label-as-button w-[59px] bg-{{ $site_settings->site_color_theme }} gap-1" for="settingsModalCheckbox" onclick="settingsModal('operatingHoursModal')">
						<i class="fa-solid fa-pencil"></i>
						<span>Edit</span>
					</label>
				</div>
				{{-- --}}
				<div>
					<div class="flex flex-col">
						<span>Operating hours</span>
						<span class="font-semibold text-black">
							{{ \Carbon\Carbon::parse($shop->appointment_settings['operatingHours']['start'])->format('h:i A') }}
							-
							{{ \Carbon\Carbon::parse($shop->appointment_settings['operatingHours']['end'])->format('h:i A') }}
						</span>
					</div>
					<div class="flex flex-col">
						<span>Accomodation Slots & Interval (Hours - Minutes)</span>
						<span class="font-semibold text-black normal-case">
							{{ $shop->appointment_settings['accomodation_slots'] . ' slots' }}
							in every
							{{ $shop->appointment_settings['accomodation_interval']['hours'] . 'hr' }}
							{{ $shop->appointment_settings['accomodation_interval']['minutes'] . 'min' }}
							interval
						</span>
					</div>
				</div>

				<span class="">Slots Interval Preview</span>
				<ul class="min-h-[56px] flex flex-row flex-wrap gap-1 justify-center items-center">
					@php
						$_start = \Carbon\Carbon::parse($shop->appointment_settings['operatingHours']['start']);
						$_end = \Carbon\Carbon::parse($shop->appointment_settings['operatingHours']['end']);
						$_interval_hour = $shop->appointment_settings['accomodation_interval']['hours'];
						$_interval_minutes = $shop->appointment_settings['accomodation_interval']['minutes'];
						$_appointmentIntervals = [];
						while ($_start->lessThan($_end)) {
						    array_push($_appointmentIntervals, $_start->format('h:i A'));
						    $_start->addHours((int) $_interval_hour)->addMinutes((int) $_interval_minutes);
						}
					@endphp
					<div class="hidden bg-{{ $site_settings->site_color_theme }}"></div>
					@foreach ($_appointmentIntervals as $key => $days)
						<li class="px-3 py-1 text-center rounded-full capitalize {{-- bg-{{$site_settings->site_color_theme}} text-white --}} bg-[#F2F2F2] text-[#67748E]">
							<span>{{ $days }}</span>
						</li>
					@endforeach
				</ul>

				<span class="">Operating Days</span>
				<ul class="min-h-[56px] flex flex-row flex-wrap gap-1 justify-center items-center">
					<div class="hidden bg-{{ $site_settings->site_color_theme }}"></div>
					@forelse (config('enums.week_days') as $key => $days)
						<li @class([
							'bg-' . $site_settings->site_color_theme . ' text-white' => $shop->appointment_settings['operatingDays'][$key],
							'bg-[#F2F2F2] text-[#67748E]' => !$shop->appointment_settings[
								'operatingDays'
							][$key],
							'px-3 py-1 text-center rounded-full capitalize',
						])>
							<span>{{ $days }}</span>
						</li>
					@empty
						{{-- pag wala pang pinipiling day --}}
						<span>No selected days</span>
					@endforelse
				</ul>
			</div>

			{{-- offered services --}}
			<div class="business-whitecard-bg">
				<div class="flex flex-row justify-between items-center">
					<span class="font-semibold">Offered services</span>
					<label class="business-label-as-button w-[59px] bg-{{ $site_settings->site_color_theme }} gap-1" for="settingsModalCheckbox" onclick="settingsModal('offeredServicesModal')">
						<i class="fa-solid fa-pencil"></i>
						<span>Edit</span>
					</label>
				</div>

				{{-- service tags --}}
				<div class="flex flex-row flex-wrap gap-1 justify-center items-center">
					@foreach ($shop->services as $service => $cond)
						@if (!$cond)
							@continue
						@endif
						<div class="px-3 py-1 bg-{{ $site_settings->site_color_theme }} text-white text-center rounded-full capitalize">
							<span>{{ $service }}</span>
						</div>
					@endforeach
				</div>
			</div>
		</section>

		{{-- interface --}}
		<h2 class="font-semibold">Interface</h2>
		<section class="lg:w-[calc(60%_-_8px)] flex flex-col gap-2 text-[12px] 2xl:text-[14px]">
			<form action="{{ route('business.site-settings.theme') }}" method="post" class="business-whitecard-bg">
				@csrf
				@method('PATCH')
				<div class="flex flex-row justify-between items-center">
					<span class="font-semibold">Interface Theme Colors</span>
					<button type="submit" class="business-label-as-button w-[59px] bg-{{ $site_settings->site_color_theme }} gap-1">
						<i class="fa-solid fa-floppy-disk"></i>
						<span>Save</span>
					</button>
				</div>

				{{-- color selection --}}
				<div class="flex flex-col gap-1">
					{{-- <span class="">System colors</span> --}}
					<div class="px-2 flex flex-row gap-2 overflow-x-auto">
						@php
							$_currentTheme = $site_settings->site_color_theme;
						@endphp
						@foreach (['pinkTheme', 'blueTheme', 'greenTheme', 'yellowTheme', 'blueGreenTheme', 'darkBlueTheme'] as $theme)
							<label for="{{ $theme }}" id="{{ $theme }}Label" onclick="changeTheme(this.id)">
								<div @class([
									// base class
									'w-[35px] h-[35px] flex justify-center items-center text-white rounded-full cursor-pointer',
									'bg-interface-color1' => $theme == 'pinkTheme',
									'bg-interface-color2' => $theme == 'blueTheme',
									'bg-interface-color3' => $theme == 'greenTheme',
									'bg-interface-color4' => $theme == 'yellowTheme',
									'bg-interface-color5' => $theme == 'blueGreenTheme',
									'bg-interface-color6' => $theme == 'darkBlueTheme',
								])>
									<i id="{{ $theme }}Check" @class([
										'fa-solid block fa-check',
										'hidden' => !('interface-color' . $loop->iteration == $_currentTheme),
									])></i>
								</div>
							</label>
							<input id="{{ $theme }}" class="absolute -top-full" type="radio" name="theme_color" value="color{{ $loop->iteration }}" {{ 'interface-color' . $loop->iteration == $_currentTheme ? __('checked') : null }}>
						@endforeach
					</div>
				</div>
				@if (false)
					{{-- system theme --}}
					<div class="flex flex-row justify-between items-center">
						<span class="">Dark theme</span>

						<label for="autoBackupCheckbox" onclick="darkSwitch()">
							<div class="w-[50px] h-[25px] relative bg-customgray-gray rounded-full ease-in-out duration-100" id="darkSwitch2bg">
								<div class="w-1/2 h-full left-0 absolute border-customgray-gray border-4 bg-white rounded-full ease-in-out duration-100" id="darkSwitch2"></div>
							</div>
						</label>
					</div>
				@endif
			</form>
		</section>

		{{-- transaction methods --}}
		<h2 class="font-semibold">Transaction Methods</h2>
		<section class="lg:w-[calc(60%_-_8px)] flex flex-col gap-2 text-[12px] 2xl:text-[14px]">
			{{-- payment method --}}
			<form action="{{ route('business.site-settings.form6') }}" method="post" class="business-whitecard-bg">
				@csrf
				@method('PATCH')
				<div class="flex flex-row justify-between items-center">
					<span class="font-semibold">Payment Method</span>
					<button type="submit" class="business-label-as-button w-[59px] bg-{{ $site_settings->site_color_theme }} gap-1">
						<i class="fa-solid fa-floppy-disk"></i>
						<span>Save</span>
					</button>
				</div>

				<div class="flex flex-row gap-3 items-center">
					<div class="basis-[129px] flex flex-row gap-2">
						<input type="checkbox" class="accent-{{ $site_settings->site_color_theme }}" name="payment_method[]" value="online" {{ Str::contains('online', $shop->payment_method) ? __('checked') : null }} id="payment-method-onlinePayment">
						<label for="payment-method-onlinePayment">
							Online Payment
						</label>
					</div>

					<div class="basis-[129px] flex flex-row gap-2">
						<input type="checkbox" class="accent-{{ $site_settings->site_color_theme }}" name="payment_method[]" value="cash" {{ Str::contains('cash', $shop->payment_method) ? __('checked') : null }} id="payment-method-cashPayment">
						<label for="payment-method-cashPayment">
							Cash
						</label>
					</div>
				</div>
			</form>

			{{-- transfer method --}}
			<form action="{{ route('business.site-settings.form7') }}" method="post" class="business-whitecard-bg">
				@csrf
				@method('PATCH')
				<div class="flex flex-row justify-between items-center">
					<span class="font-semibold">Transfer Method</span>
					<button type="submit" class="business-label-as-button w-[59px] bg-{{ $site_settings->site_color_theme }} gap-1">
						<i class="fa-solid fa-floppy-disk"></i>
						<span>Save</span>
					</button>
				</div>

				<div class="flex flex-row gap-3 items-center">
					<div class="basis-[129px] flex flex-row gap-2">
						<input type="checkbox" class="accent-{{ $site_settings->site_color_theme }}" name="transfer_method[]" value="pick-up" {{ Str::contains('pick-up', $shop->transfer_method) ? __('checked') : null }} id="transfer-method-pick-up">
						<label for="transfer-method-pick-up">
							Shop pick-up
						</label>
					</div>

					<div class="basis-[129px] flex flex-row gap-2">
						<input type="checkbox" name="transfer_method[]" class="accent-{{ $site_settings->site_color_theme }}" value="meet-up" {{ Str::contains('meet-up', $shop->transfer_method) ? __('checked') : null }} id="transfer-method-meet-up">
						<label for="transfer-method-meet-up">
							Meet-up
						</label>
					</div>

					<div class="basis-[129px] flex flex-row gap-2">
						<input type="checkbox" name="transfer_method[]" class="accent-{{ $site_settings->site_color_theme }}" value="delivery" {{ Str::contains('delivery', $shop->transfer_method) ? __('checked') : null }} id="transfer-method-delivery">
						<label for="transfer-method-delivery">
							Delivery
						</label>
					</div>
				</div>
			</form>
		</section>

		{{-- available online payment method --}}
		<section class="lg:w-[calc(60%_-_8px)] flex flex-col gap-2 text-[12px] 2xl:text-[14px]">
			<div class="business-whitecard-bg">
				<div class="flex flex-row justify-between items-center">
					<span class="font-semibold">Available Online Payment Methods</span>
					<label class="business-label-as-button w-[59px] bg-{{ $site_settings->site_color_theme }} gap-1" for="settingsModalCheckbox" onclick="settingsModal('paymentMethodsModal')">
						<i class="fa-solid fa-pencil"></i>
						<span>Edit</span>
					</label>
				</div>

				<div class="flex flex-row justify-center items-center">
					<div class="basis-1/2 px-2 border-r-[0.5px] flex flex-col gap-1">
						<span class="font-semibold">GCash</span>
						<div class="flex flex-col gap-1">
							<span>Account Name:
								{{ isset($shop->payment_settings['gcash_name']) ? $shop->payment_settings['gcash_name'] : __('Undefined') }}</span>
							<span>Account/Mobile Number:
								{{ isset($shop->payment_settings['gcash_num']) ? $shop->payment_settings['gcash_num'] : __('Undefined') }}</span>
						</div>
						<div class="w-full flex flex-row justify-center items-center">
							@if (!isset($shop->payment_settings['gcash_img']) || is_null($shop->payment_settings['gcash_img']))
								<div class="w-1/2 min-w-[100px] max-w-[165px] h-auto text-center text-black">
									<i class="fa-solid fa-qrcode w-full h-auto"></i>
									<span class="w-full">no qr-code</span>
								</div>
							@else
								<img class="w-1/2 min-w-[100px] max-w-[165px] h-auto" src="{{ asset('/storage/' . $user->userId . '/file/' . $shop->payment_settings['gcash_img'] . '/type/shop') }}" alt="img">
							@endif
						</div>
					</div>
					<div class="basis-1/2 px-2 border-l-[0.5px] flex flex-col gap-1">
						<span class="font-semibold">PayMaya</span>
						<div class="flex flex-col gap-1">
							<span>Account Name:
								{{ isset($shop->payment_settings['paymaya_name']) ? $shop->payment_settings['paymaya_name'] : __('Undefined') }}</span>
							<span>Account/Mobile Number:
								{{ isset($shop->payment_settings['paymaya_num']) ? $shop->payment_settings['paymaya_num'] : __('Undefined') }}</span>
						</div>
						<div class="w-full flex flex-row justify-center items-center">
							@if (!isset($shop->payment_settings['paymaya_img']) || is_null($shop->payment_settings['paymaya_img']))
								<div class="w-1/2 min-w-[100px] max-w-[165px] h-auto text-center text-black">
									<i class="fa-solid fa-qrcode w-full h-auto"></i>
									<span class="w-full">no qr-code</span>
								</div>
							@else
								<img class="w-1/2 min-w-[100px] max-w-[165px] h-auto" src="{{ asset('/storage/' . $user->userId . '/file/' . $shop->payment_settings['paymaya_img'] . '/type/shop') }}" alt="img">
							@endif
						</div>
					</div>
				</div>
			</div>
		</section>

		@if (false)
			{{-- Backup and Restore --}}
			<h2 class="font-semibold">Backup and Restore</h2>
			<section class="lg:w-3/5 flex flex-col gap-2 text-[12px] 2xl:text-[14px]">
				{{-- Backup --}}
				<div class="business-whitecard-bg">
					<div class="flex items-center">
						<span class="font-semibold">Backup</span>
					</div>

					{{-- create backup --}}
					<div class="flex flex-row justify-between items-center">
						<span>Create backup</span>
						<button class="px-3 py-1 bg-dirtywhite rounded-[4px] font-semibold">
							BACK UP NOW
						</button>
					</div>

					{{-- automatic backup --}}
					<div class="flex flex-col gap-1">
						<div class="flex flex-row justify-between items-center">
							<span>Automatic backup</span>
							<label for="autoBackupCheckbox" onclick="autoBackupSwitch()">
								<div class="w-[50px] h-[25px] relative bg-customgray-gray rounded-full" id="backupSwitchbg">
									<div class="w-1/2 h-full left-0 absolute border-customgray-gray border-4 bg-white rounded-full ease-in-out duration-100" id="switchBall"></div>
								</div>
							</label>

							<input class="absolute -top-full" type="checkbox" name="" checked id="autoBackupCheckbox">
						</div>

						<div>
							<select class="w-[100px] border-none px-2 py-1 text-[12px] 2xl:text-[14px] bg-white dark:bg-black rounded-[4px] shadow-lg cursor-pointer" id="backupDate">
								<option value="weekly">
									<p class="">Weekly</p>
								</option>
								<option value="monthly">
									<p class="">Monthly</p>
								</option>
								<option value="yearly">
									<p class="">Yearly</p>
								</option>
							</select>
						</div>
					</div>

					{{-- last back up created --}}
					<div class="flex flex-row justify-between items-center">
						<span>Last back up created</span>
						<div class="flex flex-row gap-2">
							<span>10:39 PM</span>
							<span>September 30, 2022</span>
						</div>
					</div>
				</div>

				<div class="business-whitecard-bg">
					<div class="flex items-center">
						<span class="font-semibold">Restore</span>
					</div>

					{{-- create backup --}}
					<div class="flex flex-row justify-between items-center">
						<span>Restore system from backup file</span>
						<button class="px-3 py-1 bg-dirtywhite rounded-[4px] font-semibold">
							<span>UPLOAD</span>
						</button>
					</div>
				</div>
			</section>
		@endif
	</div>

	{{-- settngs modal --}}
	<div class="business-modalbg" id="settingsModal">
		<div class="business-modal1">
			{{-- system name and etc modal --}}
			<div class="hidden flex-col gap-1" id="systemNameModal">
				<form class="flex flex-col gap-2" action="{{ route('business.site-settings.form1') }}" method="post" enctype="multipart/form-data">
					@csrf
					@method('PATCH')
					<div class="flex flex-row justify-between items-center">
						<span class="font-semibold">Edit system name and tagline</span>
						<label class="business-close-button" for="settingsModalCheckbox" onclick="settingsModal('shopInfoModal')">
							<span class="text-[20px]">&#10799;</span>
						</label>
					</div>

					<div class="w-full flex flex-row gap-3 justify-center items-center">
						{{-- shop image --}}
						<div class="flex flex-col gap-1 justify-center items-center">
							@if (false)
								<span>PROFILE PICTURE</span>
							@endif
							<label for="shop_img" class="flex justify-center items-center">
								<div id="shop_img_preview" class="w-[90px] h-[90px] border-[1px] rounded-full overflow-hidden">
									{{-- default to --}}
									@if ($user->accountSettings->profile_img)
										<img class="object-cover w-[90px] h-[90px] rounded-full" src="{{ asset('storage/users/' . $user->userId . '/images/profile/' . $user->accountSettings->profile_img) }}" alt="">
									@else
										<i class="fa-solid fa-shop w-[90px] h-[90px] text-{{ $site_settings->site_color_theme }}"></i>
									@endif

									{{-- eto ung may img --}}
									{{-- <img class="w-[75px] h-[75px] border-[1px] rounded-full"
									src="" alt=""> --}}
								</div>
							</label>
							<input type="file" name="shop_img" id="shop_img" accept="image/*" hidden class="hidden"
								onchange="
									if (this.files && this.files[0]) {
										let reader = new FileReader();
										reader.onload = (e) => {
											$('#shop_img_preview').html('');
											$('#shop_img_preview').prepend($('<img>',{alt:'img',src:e.target.result,class:'m-auto w-auto h-auto'}));
										}
										reader.readAsDataURL(this.files[0]);
									} ">
						</div>

						<div class="grow flex flex-col gap-1">
							<label for="shop_name" class="">SHOP NAME</label>
							<input id="shop_name" class="p-1 text-[12px] bg-dirtywhite dark:bg-lightblack border-none rounded-[4px] focus:ring-{{ $site_settings->site_color_theme }}" type="text" name="shop_name" value="{{ $shop->name }}">

							<label for="tagline" class="">SHOP TAGLINE</label>
							<input id="tagline" class="p-1 text-[12px] bg-dirtywhite dark:bg-lightblack border-none rounded-[4px] focus:ring-{{ $site_settings->site_color_theme }}" type="text" name="tagline" value="{{ $shop->tagline }}">
						</div>
					</div>

					<div class="flex flex-row gap-2 justify-between items-center">
						<span>
							By saving this information, you agree to publicly show
							this information to your customers.
						</span>

						<button type="submit" class="px-5 py-1 bg-{{ $site_settings->site_color_theme }} text-white rounded-[4px] self-end">
							SAVE
						</button>
					</div>
				</form>
			</div>

			{{-- your gallery modal --}}
			<div class="hidden flex-col gap-1" id="bannerModal">
				<div class="flex flex-row justify-between items-center">
					<span class="font-semibold">Edit banners</span>

					{{-- close button --}}
					<label class="business-close-button" for="settingsModalCheckbox" onclick="settingsModal('bannerModal')">
						<span class="text-[20px]">&#10799;</span>
					</label>
				</div>

				{{-- banners and upload banner --}}
				<ul class="min-h-[266px] max-h-[266px] mx-3 flex flex-col gap-1 overflow-y-auto">
					@for ($i = 0; $i < 10; $i++)
						<li class="flex flex-row gap-2 justify-between items-center">
							<div class="flex flex-row gap-2 items-center">
								<div class="w-[100px] h-[50px] flex justify-center items-center overflow-hidden">
									<img class="w-auto h-full"
										src="https://th.bing.com/th/id/R.4cfb6ea3e537cc86c89e65b2230cba73?rik=DmGEyMYVAnrYog&riu=http%3a%2f%2fimg3.wikia.nocookie.net%2f__cb20131017123233%2fkyoukainokanata%2fimages%2fe%2fe2%2fMirai_Kuriyama_anime.png&ehk=VG96WJbwVGOFBVgc2joIimFafgCmbFCX02NAnIa7VR4%3d&risl=&pid=ImgRaw&r=0"
										alt="">
								</div>
							</div>

							<div class="flex flex-row gap-2">
								{{-- edit --}}
								<label class="px-3 py-2 flex flex-row gap-2 justify-center items-center bg-status-bluegreen text-white rounded-[4px]" for="editBannerCheckbox" onclick="editBanner()">
									<i class="fa-solid fa-pen-to-square"></i>
									<span class="hidden sm:block">Edit content</span>
								</label>

								{{-- delete --}}
								<button class="px-3 py-2 flex flex-row gap-2 justify-center items-center bg-status-red text-white rounded-[4px]">
									<i class="fa-solid fa-trash-can"></i>
									<span class="hidden sm:block">Delete</span>
								</button>
							</div>
						</li>
					@endfor
				</ul>

				<div class="flex flex-col gap-2 items-center">
					<span>
						By saving this information, you agree to publicly show
						this information to your customers.
					</span>

					<div class="flex flex-row gap-2 self-end">
						<button class="px-3 py-2 flex gap-2 items-center bg-{{ $site_settings->site_color_theme }} text-white rounded-[4px]">
							<i class="fa-solid fa-image"></i>
							<span>Upload</span>
							<span class="hidden">photos</span>
						</button>
						<button class="px-5 py-1 bg-{{ $site_settings->site_color_theme }} text-white rounded-[4px]" id="bannerSave">
							SAVE
						</button>
					</div>
				</div>

				{{-- image preview modal --}}
				<div class="business-modalbg" id="editBannerModal">
					<div class="business-modal1 max-w-[546px]">
						{{-- modal header --}}
						<div class="flex flex-row justify-between items-center">
							<span class="font-semibold">Edit content</span>

							{{-- close button --}}
							<label class="business-close-button" for="editBannerCheckbox" onclick="editBanner()">
								<span class="text-[20px]">&#10799;</span>
							</label>
						</div>

						{{-- body --}}
						<div class="flex flex-col gap-2 justify-center items-center">
							{{-- image --}}
							<div class="flex justify-center items-center">
								<div class="w-[100px] border-[1px]">
									{{-- <i class="fa-solid fa-shop w-full h-full text-{{$site_settings->site_color_theme}}"></i> --}}

									{{-- eto ung may img --}}
									<img
										src="https://th.bing.com/th/id/R.4cfb6ea3e537cc86c89e65b2230cba73?rik=DmGEyMYVAnrYog&riu=http%3a%2f%2fimg3.wikia.nocookie.net%2f__cb20131017123233%2fkyoukainokanata%2fimages%2fe%2fe2%2fMirai_Kuriyama_anime.png&ehk=VG96WJbwVGOFBVgc2joIimFafgCmbFCX02NAnIa7VR4%3d&risl=&pid=ImgRaw&r=0"
										class="w-full h-auto" alt="">
								</div>
							</div>

							{{-- title --}}
							<div class="w-[80%]">
								<input class="w-full px-2 py-1 text-[12px] bg-dirtywhite dark:bg-lightblack border-none rounded-[4px]" type="text" placeholder="Title" id="title">
							</div>

							{{-- description --}}
							<div class="w-[80%]">
								<textarea class="w-full border-none px-2 py-1 bg-dirtywhite text-[12px] rounded-[4px]" id="description" rows="3" placeholder="Description"></textarea>
							</div>
						</div>

						{{-- modal footer --}}
						<div class="flex flex-row gap-2 self-end">
							<button class="px-5 py-1 bg-{{ $site_settings->site_color_theme }} text-white rounded-[4px]" id="bannerSave">
								SAVE
							</button>
						</div>
					</div>
				</div>
			</div>

			{{-- shop location modal --}}
			<div class="hidden flex-col gap-1" id="shopLocationModal">
				<form class="flex flex-col gap-2" action="{{ route('business.site-settings.form2') }}" method="post">
					@csrf
					@method('PATCH')
					<div class="flex flex-row justify-between items-center">
						<span class="font-semibold">Edit shop location</span>

						{{-- close button --}}
						<label class="business-close-button" for="settingsModalCheckbox" onclick="settingsModal('shopLocationModal')">
							<span class="text-[20px]">&#10799;</span>
						</label>
					</div>

					{{-- input fields --}}
					<div class="flex flex-col gap-1">
						<div class="flex flex-row gap-2">
							<div class="basis-[70%] flex flex-col gap-1">
								<input id="googleMaps_embed" name="googleMaps_embed" type="text" readonly hidden class="hidden" value="{{ $shop->googleMaps_embed }}" />
								{{-- street apartment building --}}
								<div class="flex flex-col">
									<label for="streetAptBuilding">Street/Apartment/Building</label>
									<div class="w-full">
										<input class="w-full business-input-textbox focus:ring-{{ $site_settings->site_color_theme }}" type="text" required name="street" value="{{ $shop->address['street'] }}" id="streetAptBuilding">
									</div>
								</div>

								<div class="flex flex-row gap-2">
									{{-- province --}}
									<div class="basis-1/2">
										<label for="province">Province</label>
										<div class="w-full">
											<input class="w-full business-input-textbox focus:ring-{{ $site_settings->site_color_theme }}" type="text" required name="province" value="{{ $shop->address['province'] }}" id="province">
										</div>
									</div>

									{{-- city municipal --}}
									<div class="basis-1/2">
										<label for="cityMunicipal">City/Municipal</label>
										<div class="w-full">
											<input class="w-full business-input-textbox focus:ring-{{ $site_settings->site_color_theme }}" type="text" required name="city" value="{{ $shop->address['city'] }}" id="cityMunicipal">
										</div>
									</div>
								</div>
							</div>

							<div class="grow flex flex-col gap-1">
								{{-- zip code --}}
								<div class="flex flex-col">
									<label id="zipCode">Zip Code</label>
									<div class="w-full">
										<input class="w-full business-input-textbox focus:ring-{{ $site_settings->site_color_theme }}" type="text" required name="zip" value="{{ $shop->address['zip'] }}" id="zipCode">
									</div>
								</div>

								{{-- brgy --}}
								<div class="flex flex-col">
									<label for="brgy">Barangay</label>
									<div class="w-full">
										<input class="w-full business-input-textbox focus:ring-{{ $site_settings->site_color_theme }}" type="text" required name="brgy" value="{{ $shop->address['brgy'] }}" id="brgy">
									</div>
								</div>
							</div>
						</div>

						<div class="flex flex-col">
							<label for="gmapsLink">Google Maps Link</label>
							<div class="w-full">
								<input class="w-full business-input-textbox focus:ring-{{ $site_settings->site_color_theme }}" type="url" name="googleMaps" value="{{ $shop->googleMaps }}" id="gmapsLink">
							</div>
						</div>
					</div>

					{{-- map preview --}}
					<span>Map preview</span>
					<div class="h-[150px] border-[1px] flex justify-center items-center rounded-[4px] overflow-hidden">
						<iframe id="gmap_canvas" class="mx-auto w-full h-full" src="{{ $shop->googleMaps_embed }}" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
					</div>

					<div class="flex flex-row gap-2 justify-between items-center">
						<span>
							By saving this information, you agree to publicly show
							this information to your customers.
						</span>

						<button type="submit" class="px-5 py-1 bg-{{ $site_settings->site_color_theme }} text-white rounded-[4px] self-end" id="bannerSave">
							SAVE
						</button>
					</div>
				</form>
			</div>

			{{-- shop operation settings modal --}}
			<div class="hidden flex-col gap-1" id="operatingHoursModal">
				<form action="{{ route('business.site-settings.form4') }}" method="post">
					@csrf
					@method('PATCH')
					<div class="flex flex-row justify-between items-center">
						<span class="font-semibold">Edit operating hours</span>

						{{-- close button --}}
						<label class="business-close-button" for="settingsModalCheckbox" onclick="settingsModal('operatingHoursModal')">
							<span class="text-[20px]">&#10799;</span>
						</label>
					</div>

					{{-- shop operation time settings --}}
					<div class="flex flex-col gap-1">
						<span>Opening hours</span>
						<div class="flex flex-col items-center gap-2">
							<div class="w-full flex flex-row gap-2 justify-between items-center">
								{{-- opening hours --}}
								<div class="w-full flex flex-col">
									<label id="time_opening">Opening</label>
									<div class="">
										<input class="w-full business-input-textbox focus:ring-{{ $site_settings->site_color_theme }}" type="time" name="time_opening"
											value="{{ \Carbon\Carbon::parse($shop->appointment_settings['operatingHours']['start'])->format('H:i') }}" id="time_opening">
									</div>
								</div>

								{{-- closing hours --}}
								<div class="w-full flex flex-col">
									<label id="time_closing">Closing</label>
									<div class="">
										<input class="w-full business-input-textbox focus:ring-{{ $site_settings->site_color_theme }}" type="time" name="time_closing"
											value="{{ \Carbon\Carbon::parse($shop->appointment_settings['operatingHours']['end'])->format('H:i') }}" id="time_closing">
									</div>
								</div>
							</div>

							<div class="w-full flex flex-row gap-2 justify-between items-center">
								{{-- appointment time intervals --}}
								<div class="w-full flex flex-col">
									<span>Time interval</span>
									<div class="flex flex-row gap-2 justify-between items-center">
										<input class="w-full business-input-textbox focus:ring-{{ $site_settings->site_color_theme }}" type="number" step="1" name="time_interval_hour"
											value="{{ $shop->appointment_settings['accomodation_interval']['hours'] }}" id="time_interval_hour">
										<span class="font-semibold">:</span>
										<input class="w-full business-input-textbox focus:ring-{{ $site_settings->site_color_theme }}" type="number" step="15" name="time_interval_minute"
											value="{{ $shop->appointment_settings['accomodation_interval']['minutes'] }}" id="time_interval_minute">
									</div>
								</div>

								{{-- accomodation per interval --}}
								<div class="w-full flex flex-col">
									<label id="time_interval">Accomodation per interval</label>
									<div class="">
										<input class="w-full business-input-textbox focus:ring-{{ $site_settings->site_color_theme }}" type="number" step="1" value="{{ $shop->appointment_settings['accomodation_slots'] }}" name="time_interval"
											id="time_interval">
									</div>
								</div>
							</div>
						</div>

						{{-- shop operating days settings --}}
						<div class="p-2 border-[1px] rounded-[4px]">
							@php
								$_weekdays = $shop->appointment_settings['operatingDays'];
							@endphp
							<ul class="min-h-[56px] flex flex-row flex-wrap gap-1 justify-center items-center">
								@foreach (config('enums.week_days') as $w => $weekdayTitle)
									<label id="{{ $weekdayTitle }}" for="{{ $weekdayTitle }}Checkbox" @class([
										'px-3 py-1 text-center rounded-full',
										'bg-' . $site_settings->site_color_theme . ' text-white' => $_weekdays[$w],
										'bg-[#F2F2F2] text-[#67748E]' => !$_weekdays[$w],
									]) onclick="operatingDays('{{ $weekdayTitle }}');">
										{{ $weekdayTitle }}
									</label>
									{{-- checkbox for days --}}
									<input id="{{ $weekdayTitle }}Checkbox" class="hidden" type="checkbox" name="operating_days[{{ $w }}]" value="{{ $w }}" {{ $_weekdays[$w] ? __('checked') : null }}>
								@endforeach
							</ul>
							@if (false)
								@foreach ($shop->appointment_settings['operatingDays'] as $days => $checked)
									<input type="checkbox" id="weekday-{{ config('enums.week_days')[$days] }}" name="operating_days[{{ $days }}]" {{ $checked ? __('checked') : null }}>
								@endforeach
							@endif
						</div>

						<div class="flex flex-row gap-2 justify-between items-center">
							<span>
								By saving this information, you agree to publicly show
								this information to your customers.
							</span>

							<button type="submit" class="px-5 py-1 bg-{{ $site_settings->site_color_theme }} text-white rounded-[4px] self-end">
								SAVE
							</button>
						</div>
					</div>
				</form>
			</div>

			{{-- offered services modal --}}
			<form action="{{ route('business.site-settings.form5') }}" method="post" class="hidden flex-col gap-1" id="offeredServicesModal">
				@csrf
				@method('PATCH')
				<div class="flex flex-row justify-between items-center">
					<span class="font-semibold">Edit offered services</span>

					{{-- close button --}}
					<label class="business-close-button" for="settingsModalCheckbox" onclick="settingsModal('offeredServicesModal')">
						<span class="text-[20px]">&#10799;</span>
					</label>
				</div>

				{{-- service tags --}}
				@php
					$_services = $shop->services;
				@endphp
				<div class="p-2 border-[1px] rounded-[4px]">
					<ul class="min-h-[56px] flex flex-row flex-wrap gap-1 justify-center items-center">
						@foreach ($_services as $service => $cond)
							<label for="service{{ $loop->iteration }}Checkbox">
								<li id="service{{ $loop->iteration }}" @class([
									'px-3 py-1 text-center rounded-full',
									'bg-' . $site_settings->site_color_theme . ' text-white' => $cond,
									'bg-[#F2F2F2] text-[#67748E]' => !$cond,
								]) onclick="servicesOffered(this.id)">
									<span>{{ $service }}</span>
								</li>
							</label>
							<input id="service{{ $loop->iteration }}Checkbox" class="absolute -top-full" type="checkbox" form="offeredServicesModal" name="services[{{ $service }}]" value="{{ $service }}"
								{{ $cond ? __('checked') : null }}>
						@endforeach
					</ul>
				</div>

				<div class="flex flex-row gap-2 justify-between items-center">
					<span>
						By saving this information, you agree to publicly show
						this information to your customers.
					</span>

					{{-- save button --}}
					<button type="submit" class="px-5 py-1 bg-{{ $site_settings->site_color_theme }} text-white rounded-[4px] self-end" id="">
						SAVE
					</button>
				</div>
			</form>

			{{-- available online payment method modal --}}
			<form action="{{ route('business.site-settings.form8') }}" method="post" enctype="multipart/form-data" class="hidden flex-col gap-1" id="paymentMethodsModal">
				@csrf
				@method('PATCH')
				<div class="flex flex-row justify-between items-center">
					<span class="font-semibold">Edit available payment methods</span>

					{{-- close button --}}
					<label class="business-close-button" for="settingsModalCheckbox" onclick="settingsModal('paymentMethodsModal')">
						<span class="text-[20px]">&#10799;</span>
					</label>
				</div>

				<div class="flex flex-row justify-center items-center">
					{{-- gcash --}}
					<div class="basis-1/2 px-2 border-r-[0.5px] flex flex-col gap-1">
						<span class="font-semibold">GCash</span>
						<div class="flex flex-col gap-1">
							<span>Account Name <span class="text-{{ $site_settings->site_color_theme }}">*</span></span>
							<input class="business-input-textbox mx-2 focus:ring-{{ $site_settings->site_color_theme }}" type="text" value="{{ isset($shop->payment_settings['gcash_name']) ? $shop->payment_settings['gcash_name'] : null }}"
								name="gcash_name" id="gcash_name">
							<span>Account/Mobile Number <span class="text-{{ $site_settings->site_color_theme }}">*</span></span>
							<input class="business-input-textbox mx-2 focus:ring-{{ $site_settings->site_color_theme }}" type="text" value="{{ isset($shop->payment_settings['gcash_num']) ? $shop->payment_settings['gcash_num'] : null }}"
								name="gcash_num" id="gcash_num">
						</div>
						<label for="gcash_img" class="cursor-pointer w-full flex flex-row justify-center items-center">
							<div id="_prev_update_gcash" class="w-1/2 min-w-[100px] max-w-[165px] h-auto text-center text-black">
								<i class="fa-solid fa-qrcode w-full h-auto"></i>
								<span class="w-full">no qr-code</span>
							</div>
						</label>
						<input type="file" name="gcash_img" id="gcash_img" accept="image/*" onchange="updatePreviewQR(this,'_prev_update_gcash')" hidden class="hidden">
						<label for="gcash_img" class="px-5 py-1 bg-{{ $site_settings->site_color_theme }} text-white rounded-[4px] self-center cursor-pointer">
							upload
						</label>
					</div>

					{{-- paymaya --}}
					<div class="basis-1/2 px-2 border-l-[0.5px] flex flex-col gap-1">
						<span class="font-semibold">PayMaya</span>
						<div class="flex flex-col gap-1">
							<span>Account Name <span class="text-{{ $site_settings->site_color_theme }}">*</span></span>
							<input class="business-input-textbox mx-2 focus:ring-{{ $site_settings->site_color_theme }}" type="text" value="{{ isset($shop->payment_settings['paymaya_name']) ? $shop->payment_settings['paymaya_name'] : null }}"
								name="paymaya_name" id="paymaya_name">
							<span>Account/Mobile Number <span class="text-{{ $site_settings->site_color_theme }}">*</span></span>
							<input class="business-input-textbox mx-2 focus:ring-{{ $site_settings->site_color_theme }}" type="text" value="{{ isset($shop->payment_settings['paymaya_num']) ? $shop->payment_settings['paymaya_num'] : null }}"
								name="paymaya_num" id="paymaya_num">
						</div>
						<label for="paymaya_img" class="cursor-pointer w-full flex flex-row justify-center items-center">
							<div id="_prev_update_paymaya" class="w-1/2 min-w-[100px] max-w-[165px] h-auto text-center text-black">
								<i class="fa-solid fa-qrcode w-full h-auto"></i>
								<span class="w-full">no qr-code</span>
							</div>
						</label>

						<input type="file" name="paymaya_img" id="paymaya_img" onchange="updatePreviewQR(this,'_prev_update_paymaya')" accept="image/*" hidden class="hidden">
						<label for="paymaya_img" class="px-5 py-1 bg-{{ $site_settings->site_color_theme }} text-white rounded-[4px] self-center cursor-pointer">
							upload
						</label>
					</div>
				</div>

				<div class="flex flex-row gap-2 justify-between items-center">
					<span>
						By saving this information, you agree to publicly show
						this information to your customers.
					</span>

					<button type="submit" class="px-5 py-1 bg-{{ $site_settings->site_color_theme }} text-white rounded-[4px] self-end" id="">
						SAVE
					</button>
				</div>
			</form>
		</div>
	</div>

	{{-- all checkbox hax here --}}
	<input class="absolute -top-full" type="checkbox" name="" checked id="settingsModalCheckbox">

	{{-- checkbox for services offered --}}

	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		const updatePreviewQR=(file,parent)=>{
		    if(file.files && file.files[0]){
		        let reader = new FileReader();
					reader.onload = (e) => {
					$('#'+parent).html('');
					$('#'+parent).append(
						$('<img>', {
							src: e.target.result,
							alt: 'img',
							class: 'w-full h-auto'
						})
					);
				}
				reader.readAsDataURL(file.files[0]);
		    }
		};
		const changeGoogleMaps = () => {
			let street = $('input#streetAptBuilding').val()
			let province = $('input#province').val()
			let city = $('input#cityMunicipal').val()
			let brgy = $('input#brgy').val()
			let zip = $('input#zipCode').val()

			let query =
				`${(street ? street+',':'')}${(brgy ? brgy+',':'')}${(city ? city+',':'')}${(province ? province+',':'')}${(zip ? zip:'')}`
			while (query.indexOf(' ') >= 0) {
				query = query.replace(' ', '%20')
			}
			let url = `https://maps.google.com/maps?q=${query}&t=&z=13&ie=UTF8&iwloc=&output=embed`
			$('input#googleMaps_embed').val(url)
			$('iframe#gmap_canvas').attr('src', url)
		};
		const addNewShopTag = () => {
			$.post('{{ route('business.site-settings.shopTag.isValid') }}', {
					tag: $('#addTag-new').val()
				})
				.done((data) => {
					// console.log('hit', data)
					$('#_shopTaglines-ul').append(data);
				})
		};
		const loadShopTags = () => {
			$.get('{{ route('business.site-settings.shopTag.load') }}')
				.done((data) => {
					$('#_shopTaglines-ul').html('')
					$('#_shopTaglines-ul').append(data);
				})
		};
		$(() => {
			$('#addNewTag').click(addNewShopTag)
			$('input#streetAptBuilding').on('input', changeGoogleMaps);
			$('input#province').on('input', changeGoogleMaps);
			$('input#cityMunicipal').on('input', changeGoogleMaps);
			$('input#brgy').on('input', changeGoogleMaps);
			$('input#zipCode').on('input', changeGoogleMaps);
		})

		function autoBackupSwitch() {
			// backupSwitchbg
			if (document.getElementById("autoBackupCheckbox").checked) {
				document.getElementById("switchBall").style.left = "50%"; //on
				document.getElementById("switchBall").style.borderColor = "#FF9595";
				document.getElementById("backupSwitchbg").style.backgroundColor = "#FF9595";
			} else {
				document.getElementById("switchBall").style.left = "0%"; //off
				document.getElementById("switchBall").style.borderColor = "#67748E";
				document.getElementById("backupSwitchbg").style.backgroundColor = "#67748E";
			}
		}

		function changeTheme(themeId) {
			switch (themeId) {
				case "pinkThemeLabel":
					document.getElementById("pinkThemeCheck").style.display = "block";
					document.getElementById("blueThemeCheck").style.display = "none";
					document.getElementById("greenThemeCheck").style.display = "none";
					document.getElementById("yellowThemeCheck").style.display = "none";
					document.getElementById("blueGreenThemeCheck").style.display = "none";
					document.getElementById("darkBlueThemeCheck").style.display = "none";
					break;
				case "blueThemeLabel":
					document.getElementById("pinkThemeCheck").style.display = "none";
					document.getElementById("blueThemeCheck").style.display = "block";
					document.getElementById("greenThemeCheck").style.display = "none";
					document.getElementById("yellowThemeCheck").style.display = "none";
					document.getElementById("blueGreenThemeCheck").style.display = "none";
					document.getElementById("darkBlueThemeCheck").style.display = "none";
					break;
				case "greenThemeLabel":
					document.getElementById("pinkThemeCheck").style.display = "none";
					document.getElementById("blueThemeCheck").style.display = "none";
					document.getElementById("greenThemeCheck").style.display = "block";
					document.getElementById("yellowThemeCheck").style.display = "none";
					document.getElementById("blueGreenThemeCheck").style.display = "none";
					document.getElementById("darkBlueThemeCheck").style.display = "none";
					break;
				case "yellowThemeLabel":
					document.getElementById("pinkThemeCheck").style.display = "none";
					document.getElementById("blueThemeCheck").style.display = "none";
					document.getElementById("greenThemeCheck").style.display = "none";
					document.getElementById("yellowThemeCheck").style.display = "block";
					document.getElementById("blueGreenThemeCheck").style.display = "none";
					document.getElementById("darkBlueThemeCheck").style.display = "none";
					break;
				case "blueGreenThemeLabel":
					document.getElementById("pinkThemeCheck").style.display = "none";
					document.getElementById("blueThemeCheck").style.display = "none";
					document.getElementById("greenThemeCheck").style.display = "none";
					document.getElementById("yellowThemeCheck").style.display = "none";
					document.getElementById("blueGreenThemeCheck").style.display = "block";
					document.getElementById("darkBlueThemeCheck").style.display = "none";
					break;
				case "darkBlueThemeLabel":
					document.getElementById("pinkThemeCheck").style.display = "none";
					document.getElementById("blueThemeCheck").style.display = "none";
					document.getElementById("greenThemeCheck").style.display = "none";
					document.getElementById("yellowThemeCheck").style.display = "none";
					document.getElementById("blueGreenThemeCheck").style.display = "none";
					document.getElementById("darkBlueThemeCheck").style.display = "block";
					break;
			}
		}

		function settingsModal(modalName) {
			if (document.getElementById("settingsModalCheckbox").checked) {
				// loadShopTags()
				$(() => {
					document.getElementById("settingsModal").style.display = "flex";
					document.getElementById(modalName).style.display = "flex";
				})
			} else {
				document.getElementById("settingsModal").style.display = "none";

				document.getElementById('systemNameModal').style.display = "none";
				document.getElementById('bannerModal').style.display = "none";
				document.getElementById('shopLocationModal').style.display = "none";
				document.getElementById('operatingHoursModal').style.display = "none";
				document.getElementById('offeredServicesModal').style.display = "none";
				document.getElementById('paymentMethodsModal').style.display = "none";
			}
		}

		function operatingDays(id) {
			// console.log(day + "Checkbox")
			let _el = $('#' + id);
			$(() => {
				if (document.getElementById(id + "Checkbox").checked) {
					// 67748E
					// document.getElementById(day).style.backgroundColor = "#F2F2F2";
					// document.getElementById(day).style.color = "#67748E";
					_el.removeClass('bg-[#F2F2F2]')
					_el.removeClass('text-[#67748E]')
					_el.addClass('bg-{{ $site_settings->site_color_theme }}')
					_el.addClass('text-white')
				} else {
					// document.getElementById(day).style.backgroundColor = "#FF9595";
					// document.getElementById(day).style.color = "white";
					_el.removeClass('bg-{{ $site_settings->site_color_theme }}')
					_el.removeClass('text-white')
					_el.addClass('bg-[#F2F2F2]')
					_el.addClass('text-[#67748E]')
				}
			})
		}

		function servicesOffered(id) {
			// console.log(day + "Checkbox")
			if (document.getElementById(id + "Checkbox").checked) {
				// 67748E
				console.log('true');
				$('#' + id).removeClass('bg-{{ $site_settings->site_color_theme }}')
				$('#' + id).removeClass('text-white')
				$('#' + id).addClass('bg-[#F2F2F2]')
				$('#' + id).addClass('text-[#67748E]')
				// document.getElementById(id).style.backgroundColor = "#F2F2F2";
				// document.getElementById(id).style.color = "#67748E";
			} else {
				console.log('false');
				$('#' + id).removeClass('bg-[#F2F2F2]')
				$('#' + id).removeClass('text-[#67748E]')
				$('#' + id).addClass('bg-{{ $site_settings->site_color_theme }}')
				$('#' + id).addClass('text-white')
				// document.getElementById(id).style.backgroundColor = "#FF9595";
				// document.getElementById(id).style.color = "white";
			}
		}

		function editBanner() {
			if (document.getElementById('editBannerCheckbox').checked) {
				document.getElementById('editBannerModal').style.display = "flex";
			} else {
				document.getElementById('editBannerModal').style.display = "none";
			}
		}
	</script>
@endsection
