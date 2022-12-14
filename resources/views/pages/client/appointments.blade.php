@php
	$statuses = [];
	$hasFilter = isset($filter) ? true : false;
	$query = request()->input('filter');
	// dump($hasFilter);
@endphp
@extends('layouts.customer')

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Appointments</title>
@endsection

@section('content')
	<section class="bg-[#F8F9FA] lg:pt-[5rem] lg:px-[9%] py-[3rem] px-[2rem]">

		<h1 class="text-center mb-[4rem] relative">
			<span class="text-[3rem] pt-[.5rem] pb-[1rem] px-[2rem] text-[#344767] font-extrabold">
				Appointments
			</span>
		</h1>
		<div class="flex justify-between items-center pb-4 ">

			<div id="search-appointments" class="flex">
				<form class="relative" action="{{ route('customer.appointments.index') }}" method="get">
					@csrf
					<label for="product-search" class="sr-only">
						Search
					</label>
					<div class="relative">
						<div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
							<svg aria-hidden="true" class="w-6 h-6 text-gray-500 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
							</svg>
						</div>
						<input type="hidden" name="search" value="true" hidden class="hidden">
						<input type="text" id="appointment-search-user" name="appointmentId"
							class="bg-[#fff] block p-4 pl-12 md:w-[35rem] w-[30rem] text-[1.3rem] text-gray-900 rounded-lg border border-transparent focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}}" placeholder="Search..." required>
						<button type="submit" class="text-white absolute text-[1.3rem] right-2.5 bottom-2.5 button-shade font-medium rounded-lg leading-[1.25rem] px-4 py-2">
							Search
						</button>
					</div>
				</form>
			</div>

			<div class="flex justify-end">
				<div>
					<button id="dd-radio-date-filter" data-dropdown-toggle="dd-radio-date"
						class="ml-2 mr-2 inline items-center text-gray-500 bg-white bborder-0 shadow-xl hover:shadow-none
							focus:outline-none hover:bg-gray-100 focus:ring-4
						focus:ring-gray-200 font-medium rounded-lg text-[1.3rem] px-3 py-1.5"
						type="button">
						<i class="fa-solid fa-clock md:mr-3 w-5 h-5"></i>
						<span class="md:inline hidden font-medium">
							Date
						</span>
						<svg class="md:inline hidden ml-2 w-6 h-6 mb-1" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
						</svg>
					</button>
					<!-- Dropdown menu -->
					<div id="dd-radio-date" class="hidden z-10 w-48 bg-white rounded divide-y divide-gray-100 shadow" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top"
						style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(522.5px, 3847.5px, 0px);">
						<ul class="p-3 space-y-1 text-[1rem] text-gray-700" aria-labelledby="dd-radio-date-filter">
							@php
								$weekDays = [
								    'filter-all' => 'All',
								    'filter-today' => 'today',
								    'filter-tomorrow' => 'tomorrow',
								    'filter-week' => 'next week',
								    'filter-month' => 'next month',
								    // 'filter-year' => 'next year',
								];
							@endphp
							@foreach ($weekDays as $key => $day)
								<li>
									<div class="flex items-center p-2 rounded hover:bg-gray-100 capitalize" onclick="location.href='{{ route('customer.appointments.filter', ['filter' => $key]) }}'">
										<input {{ $key == 'all' ? __('checked') : __('') }} id="dd-radio-date-filter-{{ $key }}" type="radio" value="date-{{ $key }}" name="dd-radio-date-radioBtn"
											class="w-4 h-4 text-{{$site_settings->site_color_theme}} bg-gray-100 border-gray-300 focus:ring-{{$site_settings->site_color_theme}}">
										<label for="dd-radio-date-filter-{{ $key }}" class="ml-2 w-full text-[1rem] font-medium text-gray-900 rounded">{{ $day }}</label>
									</div>
								</li>
							@endforeach
						</ul>
					</div>
				</div>

				<div>

					<button id="ddd-radio-appointment-filter" data-dropdown-toggle="dd-radio-appointment"
						class="mr-2 inline items-center text-gray-500 bg-white border-0 shadow-xl hover:shadow-none
							focus:outline-none hover:bg-gray-100 focus:ring-4
						focus:ring-gray-200 font-medium rounded-lg text-[1.3rem] px-3 py-1.5"
						type="button">
						<i class="fa-solid fa-calendar md:mr-3 w-5 h-5"></i>
						<span class="md:inline hidden font-medium">
							Appointment
						</span>
						<svg class="md:inline hidden ml-2 w-6 h-6 mb-1" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
						</svg>
					</button>

					<!-- Dropdown menu -->
					<div id="dd-radio-appointment" class="hidden z-10 w-48 bg-white rounded divide-y divide-gray-100 shadow" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top"
						style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(522.5px, 3847.5px, 0px);">
						<ul class="p-3 space-y-1 text-[1rem] text-gray-700 " aria-labelledby="dd-radio-appointment-filter">
							<li>
								<div class="flex items-center p-2 rounded hover:bg-gray-100" onclick="location.href='{{ route('customer.appointments.filter', ['filter' => 'apt-' . $key]) }}'">
									<input checked id="dd-radio-appointment-filter-all" type="radio" value="apt-all" name="dd-radio-appointment-radioBtn" class="w-4 h-4 text-{{$site_settings->site_color_theme}} bg-gray-100 border-gray-300 focus:ring-{{$site_settings->site_color_theme}} ">
									<label for="dd-radio-appointment-filter-all" class="ml-2 w-full text-[1rem] font-medium text-gray-900 rounded ">All</label>
								</div>
							</li>
							@foreach (config('enums.appointment_status') as $key => $apt_status)
								<li>
									<div class="flex items-center p-2 rounded hover:bg-gray-100" onclick="location.href='{{ route('customer.appointments.filter', ['filter' => 'apt-' . $key]) }}'">
										<input id="dd-radio-appointment-filter-{{ $key }}" type="radio" value="apt-{{ $key }}" name="dd-radio-appointment-radioBtn"
											class="w-4 h-4 text-{{$site_settings->site_color_theme}} bg-gray-100 border-gray-300 focus:ring-{{$site_settings->site_color_theme}} focus:ring-2">
										<label for="dd-radio-appointment-filter-{{ $key }}" class="ml-2 w-full text-[1rem] font-medium text-gray-900 rounded ">{{ $apt_status }}</label>
									</div>
								</li>
							@endforeach
						</ul>
					</div>
				</div>

				<div>

					<button id="dd-radio-repair-filter" data-dropdown-toggle="dd-radio-repair"
						class="mr-2 inline items-center text-gray-500 bg-white border-0 shadow-xl hover:shadow-none
						focus:outline-none hover:bg-gray-100 focus:ring-4
						focus:ring-gray-200 font-medium rounded-lg text-[1.3rem] px-3 py-1.5"
						type="button">
						<i class="fa-solid fa-screwdriver md:mr-3 w-5 h-5"></i>
						<span class="md:inline hidden font-medium">
							Repair
						</span>
						<svg class="md:inline hidden ml-2 w-6 h-6 mb-1" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
						</svg>
					</button>
					<!-- Dropdown menu -->
					<div id="dd-radio-repair" class="hidden z-10 w-48 bg-white rounded divide-y divide-gray-100 shadow" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top"
						style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(522.5px, 3847.5px, 0px);">
						<ul class="p-3 space-y-1 text-[1rem] text-gray-700" aria-labelledby="dd-radio-repair-filter">
							<li>
								<div class="flex items-center p-2 rounded hover:bg-gray-100" onclick="location.href='{{ route('customer.appointments.filter', ['filter' => 'rpr-' . $key]) }}'">
									<input checked id="dd-radio-repair-filter-all" type="radio" value="rpr-all" name="dd-radio-repair-radioBtn" class="w-4 h-4 text-{{$site_settings->site_color_theme}} bg-gray-100 border-gray-300 focus:ring-{{$site_settings->site_color_theme}}focus:ring-2">
									<label for="dd-radio-repair-filter-all" class="ml-2 w-full text-[1rem] font-medium text-gray-900 rounded">All</label>
								</div>
							</li>
							@foreach (config('enums.repair_status') as $key => $repair_status)
								<li>
									<div class="flex items-center p-2 rounded hover:bg-gray-100" onclick="location.href='{{ route('customer.appointments.filter', ['filter' => 'rpr-' . $key]) }}'">
										<input id="dd-radio-repair-filter-{{ $key }}" type="radio" value="rpr-{{ $key }}" name="dd-radio-repair-radioBtn" class="w-4 h-4 text-{{$site_settings->site_color_theme}} bg-gray-100 border-gray-300 focus:ring-{{$site_settings->site_color_theme}}">
										<label for="dd-radio-repair-filter-{{ $key }}" class="ml-2 w-full text-[1rem] font-medium text-gray-900 rounded">{{ $repair_status }}</label>
									</div>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
		@if ($appointmentData->count() < 1 && $hasFilter)
			<x-customer.empty-section :asset="asset('assets/Rectify/customer-home/filter-result.png')" header="Your filters produced no result" paragraph1="Try adjusting your filters to" paragraph2="display better results" divclass="" imgclass=" w-[20rem] my-[3rem]"
				buttonclass=" my-[1rem] ml-5 py-[.7rem] px-[7rem]" />
		@elseif ($appointmentData->count() < 1 && !$hasFilter)
			<x-customer.empty-section :asset="asset('assets/Rectify/customer-home/calendar-empty.png')" header="No appointments found!" paragraph1="There are no upcoming" paragraph2="appointments scheduled." :route="route('customer.home.index')" buttontext="Book an Appointment" divclass=""
				imgclass=" w-[12rem]  my-[3rem]" buttonclass="my-[1rem] ml-5 py-[.7rem] px-[3rem]" />
		@else
			<!--responsive table-->
			<div class="box hover:shadow-none overflow-x-auto relative">
				<table class="mobiletable border-collapse m-0 p-0 w-full table-fixed text-[1.3rem] text-gray-500">
					<thead class="text-[1.5rem] text-gray-700 md:static overflow-hidden absolute h-[1px] m-[1px] p-0 w-[1px]">
						<tr class="p-[.35em] border-b-[3px] border-transparent mb-[.625em]">
							<th scope="col" class="py-3 px-6 text-left">Shop</th>
							<th scope="col" class="py-3 px-6 text-left">Schedule</th>
							<th scope="col" class="py-3 px-6">Appointment Status</th>
							<th scope="col" class="py-3 px-6">Repair Status</th>
						</tr>
					</thead>
					<tbody class="gap-5">
						@forelse ($appointmentData as $appointment)
							<tr class="hover:bg-gray-50" onclick="location.href='{{ route('customer.appointments.show', $appointment->appointmentId) }}'" {{-- onclick="showAppointmentInfo('{{ $appointment->appointmentId }}')" --}}>

								<td data-label="Shop" class="py-4 px-6 whitespace-nowrap">
									<div class="flex items-center justify-end md:justify-start">
										<img class="w-10 h-10 rounded-full" src="{{ $shop_img }}" alt="Jese image">
										<div class="pl-3">
											<div class="text-[1.3rem] font-semibold">{{ $shopOwner->name }}</div>
											<div class="text-[1rem] font-normal text-gray-500">{{ $appointment->appointmentId }}</div>
										</div>
									</div>
								</td>
								<td data-label="Schedule" class="py-4 px-6">
									<div>
										<div class="text-[1.3rem] font-semibold">{{ $appointment->appointment_date_time->format('F d, o') }}</div>
										<div class="text-[1rem] font-normal text-gray-500">
											{{ $appointment->appointment_date_time->format('h:i a') }}
										</div>
									</div>
								</td>

								<td data-label="Appointment Status" class="py-4 px-6">
									<div class="flex items-center justify-end md:justify-center">
										<span class="{{ config('enums.appointment_status_colors')[$appointment->appointment_status] }}">{{ config('enums.appointment_status')[$appointment->appointment_status] }}</span>
									</div>
								</td>
								<td data-label="Repair Status" class="py-4 px-6">
									<div class="flex items-center justify-end md:justify-center">
										<span class="{{ config('enums.repair_status_colors')[$appointment->repair_status] }}">{{ config('enums.repair_status')[$appointment->repair_status] }}</span>
									</div>
								</td>

								{{--
							<td data-label="Action" class="py-4 px-6 md:text-center text-right">
								<a href="#" class="font-medium text-{{$site_settings->site_color_theme}} hover:underline"
									data-modal-toggle="appointment-details">View More</a>
							</td>
							--}}
							</tr>
						@empty
							<tr>
								<td colspan="4">
									<div>
										no appointments scheduled
									</div>
								</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
			<x-customer.paginate-buttons :data="$appointmentData"/>
			<!--end responsive table-->

			<!-- Main modal -->
			<div id="appointment-details" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full
					md:inset-0 h-modal md:h-full justify-center items-center">
			</div>
		@endif
	</section>
	<script>
		var modalGlighbox = null;
		// var appointmentDetailsModal
		// const showAppointmentInfo = (id) => {
		// 	const url = window.location.pathname.toString() + '/'
		// 	$('#appointment-details').html('')
		// 	$.get(url + id, (data) => {})
		// 		.done((data) => {
		// 			$('#appointment-details').html(data)
		// 			$(() => modal.show())
		// 		})
		// };
		// $(()=>{
		// 	appointmentDetailsModal = new Modal(document.getElementById('appointment-details'))
		// });
	</script>
@endsection
