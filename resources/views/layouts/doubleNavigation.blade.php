{{-- needs to have a readable font size --}}

<!DOCTYPE html>
<html class="" id="darkClassHolder" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	@include('includes.heads')
	@yield('title')

	<style>
		*::selection {
            background: {{ $site_settings->site_color_hex }};
            color: #fff;
        }

        input[type="checkbox"] {
            accent-color: {{ $site_settings->site_color_hex }};
        }
	</style>

</head>

<body class="flex flex-col xl:flex-row text-customgray-gray bg-light dark:bg-dark text-[14px] 2xl:text-[16px] font-semibold">
	<!-- sidenav -->
	<div class="w-screen sm:w-[345px] 2xl:w-[395px] h-screen -left-full z-10 sm:z-[9] fixed xl:static ease-in-out duration-200" id="sideNav">
		<div class="h-full px-4 sm:pl-[65px] sm:pr-5 py-4 sm:border-r-[1px] xl:border-0 flex flex-col bg-white xl:bg-light dark:bg-dark">
			<div class="w-full pb-[10px] border-b-[1px] flex flex-col gap-2">
				<section class="flex flex-row justify-between items-center">
					<div class="flex flex-row gap-2">
						{{-- profile pic --}}
						<div class="w-[50px] h-[50px] relative flex justify-center items-center rounded-full overflow-hidden bg-gray-200">
							<!-- <i class="fa-solid fa-circle-user text-[24px] hover:text-{{ $site_settings->site_color_theme }} dark:hover:text-{{ $site_settings->site_color_theme }} ease-in-out duration-100"></i> -->

							@auth
								<img src="{{ asset($profile_img_path) }}" alt="profile" class="object-cover w-[50px] h-[50px]">
							@else
								<!-- <div
												class="overflow-hidden relative w-10 h-10 bg-gray-100 rounded-full dark:bg-gray-600">
												<svg class="absolute -left-1 w-12 h-12 text-gray-400" fill="currentColor"
													viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd"
														d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
													</path>
												</svg>
											</div> -->
								<i class="fa-solid fa-user bottom-0 absolute text-[50px]"></i>
							@endauth
						</div>

						{{-- profile name --}}
						<div class="flex flex-col justify-center capitalize">
							<span class="text-darkblue text-[12px]">{{ $full_name }}</span>
							<span class="text-darkblue text-[16px] font-extrabold">{{ $shop->name }}</span>
							{{-- <span class="text-darkblue text-[12px]">Full Name</span>
								<span class="text-darkblue text-[16px] font-extrabold">Shop Name</span> --}}
						</div>
					</div>
				</section>
			</div>
			<div class="hidden text-slate-400"></div>

			<!-- nav menu -->
			<div class="w-full h-fit basis-auto grow self-start overflow-auto">
				@php
					$dashboard_text = $messages_text = $appointments_text = $products_text = $orders_text = $shopSettings_text = $user_list = $reports_text = $invoices_text = $accountSecurity_text = 'text-darkblue tracking-wide';
					$highlight = 'bg-' . $site_settings->site_color_theme . ' text-white';

					$dashboard_text = Str::contains(URL::current(), route('business.dashboard.index')) ? $highlight : $dashboard_text;
					$messages_text = Str::contains(URL::current(), route('business.chat.index')) ? $highlight : $messages_text;
					$appointments_text = Str::contains(URL::current(), route('business.appointments.index')) ? $highlight : $appointments_text;
					$products_text = Str::contains(URL::current(), route('business.products.index')) ? $highlight : $products_text;
					$orders_text = Str::contains(URL::current(), route('business.orders.index')) ? $highlight : $orders_text;
					$reports_text = Str::contains(URL::current(), route('business.reports.index')) ? $highlight : $reports_text;
					// $invoices_text = Str::contains(URL::current(),route('business.appointments.invoices')) ?$highlight : $invoices_text;
					$accountSecurity_text = Str::contains(URL::current(), route('business.account-settings.index')) ? $highlight : $accountSecurity_text;
					$user_text = Str::contains(URL::current(), route('business.users.index')) ? $highlight : $user_list;
				@endphp

				<a href="{{ route('business.dashboard.index') }}">
					<div class="business-navmenu-items hover:bg-{{ $site_settings->site_color_theme }} {{ $dashboard_text }}">
						<div class="business-navmenu-iconbox">
							<i class="fa-solid fa-table-columns business-navmenu-icons text-{{ $site_settings->site_color_theme }}"></i>
						</div>
						<div>Dashboard</div>
					</div>
				</a>

				<a href="{{ route('business.appointments.index') }}">
					<div class="business-navmenu-items hover:bg-{{ $site_settings->site_color_theme }} {{ $appointments_text }}">
						<div class="business-navmenu-iconbox">
							<i class="fa-solid fa-calendar business-navmenu-icons text-{{ $site_settings->site_color_theme }}"></i>
						</div>
						<div>Appointments</div>
					</div>
				</a>

				<a href="{{ route('business.orders.index') }}">
					<div class="business-navmenu-items hover:bg-{{ $site_settings->site_color_theme }} {{ $orders_text }}">
						<div class="business-navmenu-iconbox">
							<i class="fa-solid fa-cart-shopping business-navmenu-icons text-{{ $site_settings->site_color_theme }}"></i>
						</div>
						<div>Orders</div>
					</div>
				</a>

				<a href="{{ route('business.products.index') }}">
					<div class="business-navmenu-items hover:bg-{{ $site_settings->site_color_theme }} {{ $products_text }}">
						<div class="business-navmenu-iconbox">
							<i class="fa-brands fa-product-hunt business-navmenu-icons text-{{ $site_settings->site_color_theme }}"></i>
						</div>
						<div>Products</div>
					</div>
				</a>

				@if (Route::has('business.chat.index'))
					<a href="{{ route('business.chat.index') }}">
						<div class="business-navmenu-items hover:bg-{{ $site_settings->site_color_theme }} {{ $messages_text }}">
							<div class="business-navmenu-iconbox">
								<i class="fa-solid fa-message business-navmenu-icons text-{{ $site_settings->site_color_theme }}"></i>
							</div>
							<div>Messages</div>
						</div>
					</a>
				@endif

				<a href="{{ route('business.users.index') }}">
					<div class="business-navmenu-items hover:bg-{{ $site_settings->site_color_theme }} {{ $user_text }}">
						<div class="business-navmenu-iconbox">
							<i class="fa-solid fa-users business-navmenu-icons text-{{ $site_settings->site_color_theme }}"></i>
						</div>
						<div>User List</div>
					</div>
				</a>

				<a href="{{ route('business.reports.index') }}">
					<div class="business-navmenu-items hover:bg-{{ $site_settings->site_color_theme }} {{ $reports_text }}">
						<div class="business-navmenu-iconbox">
							<i class="fa-solid fa-chart-line business-navmenu-icons text-{{ $site_settings->site_color_theme }}"></i>
						</div>
						<div>Reports</div>
					</div>
				</a>
				@if (Route::has('business.appointments.invoices'))
					<a href="{{ route('business.appointments.invoices') }}">
						<div class="business-navmenu-items hover:bg-{{ $site_settings->site_color_theme }} {{ $invoices_text }}">
							<div class="business-navmenu-iconbox">
								<i class="fa-solid fa-file-invoice business-navmenu-icons text-{{ $site_settings->site_color_theme }}"></i>
							</div>
							<div>Invoices</div>
						</div>
					</a>
				@endif
				<a href="{{ route('business.account-settings.index') }}">
					<div class="business-navmenu-items hover:bg-{{ $site_settings->site_color_theme }} {{ $accountSecurity_text }}">
						<div class="business-navmenu-iconbox">
							<i class="fa-solid fa-user business-navmenu-icons text-{{ $site_settings->site_color_theme }}"></i>
						</div>
						<div>Account Security</div>
					</div>
				</a>
			</div>
			<!-- end nav menu -->

			<div class="w-full mt-2 flex flex-row gap-2 justify-between items-center text-white dark:text-black text-[14px]">
				{{-- close nav button --}}
				<label class="basis-[30px] flex sm:hidden flex-row gap-2 items-center text-customgray-gray text-[16px]" for="navCheckbox" onclick="collapseNav()">
					<div class="w-full flex justify-center items-center">
						<span>&#10094;</span>
					</div>
				</label>

				{{-- logout button --}}
				<form class="grow" action="{{ route('logout') }}" method="post">
					@csrf
					<button type="submit" class="w-full" href="">
						<div class="flex justify-center items-center bg-{{ $site_settings->site_color_theme }} rounded-[8px] px-2 py-2">
							<i class="fa-solid fa-arrow-right-from-bracket mr-3"></i>
							<span>Logout</span>
						</div>
					</button>
				</form>

				@if (false)
					<!-- dark switch -->
					<div class="basis-[75px] flex items-center">
						<div class="w-fit h-fit flex justify-center items-center cursor-pointer" onclick="darkSwitch()">
							<div class="relative bg-dirtywhite dark:bg-lightblack rounded-[8px] w-[75px] h-[25px]">
								<div class="absolute bg-{{ $site_settings->site_color_theme }} rounded-[8px] w-1/2 h-full left-0 ease-in-out duration-300" id="switch"></div>
								<div class="absolute flex justify-around z-[2] w-full h-full py-[5px]">
									<i class="fa-solid fa-sun text-white h-full ease-in-out duration-300" id="sunSwitch"></i>
									<i class="fa-solid fa-moon text-customgray-gray h-full ease-in-out duration-300" id="moonSwitch"></i>
								</div>
							</div>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>

	<!-- header, bottom nav and main content -->
	<div class="xl:w-[calc(100vw_-_345px)] 2xl:w-[calc(100vw_-_395px)] h-screen grow">
		<!-- header -->
		<div class="mt-4 flex flex-row justify-between items-center gap-4">
			<div class="z-[1] sm:z-[10] bottom-0 left-0 w-screen sm:w-[45px] h-[45px] sm:h-screen border-t-[1px] sm:border-0 px-4 sm:px-0 py-3 sm:py-[20px] fixed bg-white sm:bg-{{ $site_settings->site_color_theme }} dark:bg-black">
				<!-- the buttons -->
				<div class="w-full h-full flex flex-row sm:flex-col justify-between items-center text-customgray-gray sm:text-white">

					{{-- hamburger icon --}}
					<label class="w-fit h-fit flex justify-center items-center cursor-pointer" for="navCheckbox" onclick="collapseNav()">
						<i class="fa-solid fa-bars xl:hidden text-[18px] sm:text-[20px]"></i>
					</label>

					<section class="flex flex-row sm:flex-col gap-7">
						@if (false)
						{{-- message icon --}}
						<a href="{{ route('messages') }}" class="w-fit h-fit flex justify-center items-center">
							<i class="fa-solid fa-message text-[18px] sm:text-[20px]"></i>
						</a>
						@endif

						{{-- site-settings --}}
						<a href="{{ route('business.site-settings.index') }}">
							<i class="fa-solid fa-gear text-[18px] sm:text-[20px]"></i>
						</a>

						{{-- notification icon --}}
						@if(false)
						<a href="" class="w-fit h-fit flex justify-center items-center">
							<i class="fa-solid fa-bell text-[18px] sm:text-[20px]"></i>
						</a>
						@endif
					</section>
				</div>
			</div>
		</div>

		<!-- main content -->
		<div class="h-[calc(100vh] sm:ml-[45px] xl:ml-0">
			@yield('content')
		</div>
	</div>

	{{-- checkbox hacks --}}
	<input class="absolute -top-full" type="checkbox" name="" checked id="navCheckbox">

	@include('includes.feet')
	<script>
		// glightbox
		var glightbox = GLightbox()

		const src = new Business()
		self.collapseNav = src.collapseNav
		self.darkSwitch = src.darkSwitch
		self.changeColor = src.changeColor
		self.changeDateFilter = src.changeDateFilter
		self.changeSort = src.changeSort
		self.showPages = src.showPages
		self.repairOneStatus = src.repairOneStatus
		self.repairTwoStatus = src.repairTwoStatus
		self.repairThreeStatus = src.repairThreeStatus
		self.repairFourStatus = src.repairFourStatus
		self.repairFiveStatus = src.repairFiveStatus
		self.setAppointmentApproved = src.setAppointmentApproved
		self.setAppointmentRejected = src.setAppointmentRejected
		self.setAppointmentCanceled = src.setAppointmentCanceled
		self.setAppointment = src.setAppointment
		self.showApptInfo = src.showApptInfo
		self.showAttachments = src.showAttachments
		self.collapseCards = src.collapseCards
		self.repairStatusDropdown = src.repairStatusDropdown
		self.changeRepairStatus = src.changeRepairStatus
		self.activityLogsDropdown = src.activityLogsDropdown
		self.proceedToBillingModal = src.proceedToBillingModal
		self.showRejectMessagePanel = src.showRejectMessagePanel
	</script>
	@stack('scripts')
</body>

</html>
