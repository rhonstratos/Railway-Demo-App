{{-- notes --}}
{{-- change mobile text size: minimum of 14px
				implement dark mode on all sections
				finish billing
				make layout more responsive
	change margin on the right and also padding
	change date and name filter into more user friendly one (dropdown?) --}}

@extends('layouts.doubleNavigation')
@section('title')
	<title>{{ Str::title(config('app.name')) }} - Appointments</title>
@endsection

@section('content')
	{{-- center header --}}
	<div class="business-header flex-row justify-between items-center">
		<h1 class="xl:basis-1/3 text-darkblue dark:text-dirtywhite text-[24px] sm:text-[32px] font-extrabold">Appointment
			List</h1>

		<button class="px-3 py-2 bg-{{ $site_settings->site_color_theme }} text-white rounded-[8px] shadow-lg" type="button" onclick="location.href='{{ route('business.reviews.index') }}'">
			<span class="sm:hidden">Appt.</span>
			<span class="hidden sm:inline-block">Appointment</span>
			<span>Reviews</span>
		</button>
	</div>

	{{-- main content --}}
	<div class="h-[calc(100vh_-_127px)] sm:h-[calc(100vh_-_80px)] xl:h-[calc(100vh_-_72px)] flex flex-col gap-2">
		{{-- advance search --}}
		<form id="appointments_search" onsubmit="_advanceSearch(this,event)" action="{{ route('business.appointments.search') }}" method="post" class="px-3 flex gap-2 flex-col md:flex-row md:justify-between md:items-start">
			@csrf
			{{-- searchbar --}}
			<div class="sm:basis-1/2 flex flex-row bg-dirtywhite rounded-[8px] items-center">
				<i class="fa-solid fa-magnifying-glass px-2"></i>
				<input name="search" value="{{ isset($filter['search']) ? $filter['search'] : null }}" class="business-input-textbox bg-transparent w-full focus:ring-{{ $site_settings->site_color_theme }}" type="text"
					placeholder="Browse by ID or Name...">
			</div>

			<div class="sm:basis-1/2 flex flex-col gap-2">
				{{-- date range --}}
				<div class="w-full md:min-w-[250px] flex flex-col sm:flex-row gap-2 sm:items-center">
					<div class="w-full flex flex-row gap-2 justify-end items-center">
						<div class="grow flex flex-row gap-2 justify-between items-center">
							{{-- "from" --}}
							<div class="flex flex-col gap-1 justify-around">
								<span class="text-center">from</span>
							</div>
							{{-- date from --}}
							<div class="w-full flex flex-col gap-1">
								<span class="hidden {{-- invisible --}}">fake span</span>
								<input class="business-input-textbox border-[1px] rounded-[8px] focus:ring-{{ $site_settings->site_color_theme }}" type="date" name="review_date_start"
									value="{{ isset($filter['review_date_start']) ? $filter['review_date_start'] : null }}" id="review_date_start">
							</div>

							{{-- "to" --}}
							<div class="flex flex-col gap-1 justify-around">
								<span class="text-center">to</span>
							</div>

							{{-- date to --}}
							<div class="w-full flex flex-col gap-1">
								<span class="hidden {{-- invisible --}}">fake span</span>
								<input class="business-input-textbox border-[1px] rounded-[8px] focus:ring-{{ $site_settings->site_color_theme }}" type="date" name="review_date_end"
									value="{{ isset($filter['review_date_end']) ? $filter['review_date_end'] : null }}" id="review_date_end">
							</div>
						</div>
					</div>
				</div>

				{{-- filter options --}}
				<div class="flex flex-row gap-2 text-darkblue dark:text-dirtywhite">
					<div class="grow flex flex-row gap-2">
						{{-- appointment status filter (button) --}}
						<select name="appointment_status" class="border-none w-full h-[32px] px-3 py-0 bg-white rounded-[8px] shadow-lg cursor-pointer focus:ring-{{ $site_settings->site_color_theme }}" id="showApptStatusList">
							<option value="" {{ !isset($filter['appointment_status']) ? null : __('disabled') }}>
								<p class="text-black">Appointment: All</p>
							</option>
							@foreach (config('enums.appointment_status') as $i => $status)
								<option value="{{ $i }}" {{ \App\Models\Appointments::APPOINTMENT_PENDING == $i ? __('selected') : null }} class="{{ config('enums.appointment_status_colors')[$i] }}">
									Appointment: <strong>{{ $status }}</strong>
								</option>
							@endforeach
						</select>

						{{-- repair status filter (button) --}}
						<select name="repair_status" class="border-none w-full h-[32px] px-3 py-0 bg-white rounded-[8px] shadow-lg cursor-pointer focus:ring-{{ $site_settings->site_color_theme }}" id="repStatusList">
							<option value="" selected {{ !isset($filter['repair_status']) ? null : __('disabled') }}>
								<p class="text-black">Repair: All</p>
							</option>
							@foreach (config('enums.repair_status') as $i => $status)
								<option value="{{ $i }}" {{ isset($filter['repair_status']) && $filter['repair_status'] == $i ? __('selected') : null }} class="{{ config('enums.repair_status_colors')[$i] }}">
									Repair: <strong>{{ $status }}</strong>
								</option>
							@endforeach
						</select>
					</div>

					{{-- search button --}}
					@if (false)
						<button class="w-[32px] lg:w-auto h-[32px] lg:px-3 flex flex-row justify-center items-center gap-2 bg-white rounded-[8px] shadow-lg truncate">
							<i class="fa-solid fa-magnifying-glass"></i>
							<span class="hidden lg:inline-block">Search</span>
						</button>
					@endif
				</div>
			</div>
		</form>

		{{-- day, week and month (button) --}}
		@if (false)
			<div class="mx-5 basis-[40px] shrink-0 flex flex-row justify-between items-center lg:justify-start text-darkblue dark:text-dirtywhite">
				<div class="flex flex-row items-center gap-2 min-w-[90px] whitespace-nowrap cursor-pointer" onclick="changeSort()">
					<i class="fa-solid fa-filter"></i>
					<span id="sortBy">Date & Time</span>
					<i class="fa-solid fa-caret-down"></i>
				</div>
				<div class="max-w-[572px] md:ml-[100px] basis-[60%] sm:basis-3/4 flex lg:gap-5 flex-row justify-between items-center" id="dateFilterMenu">
					<button class="basis-1/4 flex flex-row justify-end sm:justify-center items-center cursor-pointer" id="dateFilterAll"
						onclick="changeDateFilter(this.id); location.href='{{ route('business.appointments.filter', ['filter' => 'all']) }}';">
						<div class="block" id="dateIconAllOn">
							<i class="fa-solid fa-calendar-days text-{{ $site_settings->site_color_theme }} text-[20px] mr-2"></i>
							<p class="hidden sm:inline-block font-extrabold">All</p>
						</div>
						<div class="hidden" id="dateIconAllOff">
							<i class="fa-solid fa-calendar-days text-[20px] mr-2"></i>
							<p class="hidden sm:inline-block">All</p>
						</div>
					</button>
					<button class="basis-1/4 flex flex-row justify-end sm:justify-center items-center cursor-pointer" id="dateFilter1"
						onclick="changeDateFilter(this.id); location.href='{{ route('business.appointments.filter', ['filter' => 'today']) }}';">
						<div class="hidden" id="dateIcon1On">
							<i class="fa-solid fa-calendar-day text-{{ $site_settings->site_color_theme }} text-[20px] mr-2"></i>
							<p class="hidden sm:inline-block font-extrabold">Today</p>
						</div>
						<div class="block" id="dateIcon1Off">
							<i class="fa-solid fa-calendar-day text-[20px] mr-2"></i>
							<p class="hidden sm:inline-block">Today</p>
						</div>
					</button>
					<button class="basis-1/4 flex flex-row justify-end sm:justify-center items-center cursor-pointer" id="dateFilter2" onclick="changeDateFilter(this.id); location.href='{{ route('business.appointments.filter', ['filter' => 'week']) }}';">
						<div class="hidden" id="dateIcon2On">
							<i class="fa-solid fa-calendar-week text-{{ $site_settings->site_color_theme }} text-[20px] mr-2"></i>
							<p class="hidden sm:inline-block font-extrabold">This week</p>
						</div>
						<div class="block" id="dateIcon2Off">
							<i class="fa-solid fa-calendar-week text-[20px] mr-2"></i>
							<p class="hidden sm:inline-block">This week</p>
						</div>
					</button>
					<button class="basis-1/4 flex flex-row justify-end sm:justify-center items-center cursor-pointer" id="dateFilter3"
						onclick="changeDateFilter(this.id); location.href='{{ route('business.appointments.filter', ['filter' => 'month']) }}';">
						<div class="hidden" id="dateIcon3On">
							<i class="fa-solid fa-calendar text-{{ $site_settings->site_color_theme }} text-[20px] mr-2"></i>
							<p class="hidden sm:inline-block font-extrabold">This month</p>
						</div>
						<div class="block" id="dateIcon3Off">
							<i class="fa-regular fa-calendar text-[20px] mr-2"></i>
							<p class="hidden sm:inline-block">This month</p>
						</div>
					</button>
				</div>
				@if (isset($filterBy))
					@push('scripts')
						@switch($filterBy)
							@case('all')
								<script>
									changeDateFilter('dateFilterAll');
								</script>
							@break

							@case('today')
								<script>
									changeDateFilter('dateFilter1');
								</script>
							@break

							@case('week')
								<script>
									changeDateFilter('dateFilter2');
								</script>
							@break

							@case('month')
								<script>
									changeDateFilter('dateFilter3');
								</script>
							@break
						@endswitch
					@endpush
				@endif
			</div>
		@endif

		{{-- the metadata and appointment data --}}
		<div class="sm:mx-4 grow sm:bg-white dark:sm:bg-black sm:shadow-lg rounded-[8px] overflow-y-auto">
			{{-- metadata --}}
			<div class="sticky top-0 py-[10px] hidden sm:flex flex-row justify-end items-center bg-dirtywhite dark:bg-[#1C2023] text-gray dark:text-dirtywhite">
				<div class="basis-[23.75%] md:basis-[38%] lg:basis-[47.5%] flex flex-col md:flex-row justify-between items-center">
					<div class="basis-1/3 order-first hidden lg:flex justify-center">Time</div>
					<div class="basis-1/3 order-first hidden lg:flex justify-center">Date</div>
					<span class="md:basis-1/2 lg:basis-1/3 md:flex justify-center">Name</span>
					<div class="md:order-first md:basis-1/2 md:flex lg:hidden md:justify-center">(Date and Time)</div>
				</div>
				<span class="basis-[23.75%] md:basis-[19%] lg:basis-[15.83%] flex justify-center"> Number</span>
				<span class="basis-[23.75%] md:basis-[19%] lg:basis-[15.83%] flex justify-center"> Appointment</span>
				<span class="basis-[23.75%] md:basis-[19%] lg:basis-[15.83%] flex justify-center"> Repair</span>
			</div>

			{{-- appointment data list --}}
			<ul id="appointments_list" class="list-none">
				<x-business.appointment-list :appointments="$appointmentData" />
			</ul>
		</div>

		<div id="appointments_list_paginate" class="flex flex-col">
			<x-paginate-button :data="$appointmentData" />
		</div>

		{{-- the appointment information --}}
		<div class="w-screen h-screen top-0 left-full z-[3] fixed bg-[rgba(0,0,0,0)] ease-in-out" id="apptInfo">
			<div class="w-full sm:w-[425px] lg:w-[620px] 2xl:w-[1125px] h-screen top-0 -right-full absolute flex flex-col bg-light overflow-y-auto ease-in-out duration-300" id="apptInfoContent">

			</div>
		</div>
	</div>

	{{-- billing modal --}}
	<div class="w-screen h-screen fixed top-0 left-0 z-[11] hidden justify-center items-center bg-[rgba(0,0,0,0.5)]" id="billingModal">
		<form class="w-[calc(100vw_-_20px)] h-[calc(100vh_-_20px)] flex gap-3 flex-col bg-white rounded-[10px] overflow-y-auto" id="billing">

			{{-- the header section --}}
			<section class="px-[10px] pt-[20px] pb-2 top-0 sticky flex gap-2 flex-col bg-white">
				<div class="flex justify-between items-center">
					<h2 class="text-darkblue dark:text-dirtywhite text-[18px] sm:text-[32px] font-extrabold">
						Billing
					</h2>

					{{-- close button --}}
					<label class="w-[36px] h-[36px] text-center text-darkblue dark:text-dirtywhite text-[24px] sm:text-[32px] font-extrabold" for="proceedToBillingCheckbox" onclick="proceedToBillingModal()">
						&#10799;
					</label>
				</div>
				<div class="flex gap-1 flex-row justify-center items-center">
					<button class="p-2 basis-1/3 bg-dirtywhite text-[10px] text-[#5F6368] font-semibold rounded-[7px]">
						PREVIEW
					</button>
					<button class="p-2 basis-1/3 bg-dirtywhite text-[10px] text-[#5F6368] font-semibold rounded-[7px]">
						SAVE DRAFT
					</button>
					<button class="p-2 basis-1/3 bg-{{ $site_settings->site_color_theme }} text-[10px] text-dirtywhite font-semibold rounded-[7px]">
						SEND
					</button>
				</div>
			</section>

			{{-- the customer textboxes section --}}
			<section class="px-[10px] flex gap-2 flex-col">
				<h2 class="text-darkblue text-[16px] sm:text-[24px] font-extrabold">
					Customer
				</h2>
				<input class="border-none px-2 py-1 bg-dirtywhite rounded-[7px]" type="text" name="name" id="" placeholder="name">
				<input class="border-none px-2 py-1 bg-dirtywhite rounded-[7px]" type="text" name="email" id="" placeholder="email">
				<input class="border-none px-2 py-1 bg-dirtywhite rounded-[7px]" type="text" name="phoneNum" id="" placeholder="phone no.">
			</section>

			{{-- the service details textboxes section --}}
			<section class="px-[10px] flex gap-2 flex-col">
				<h2 class="text-darkblue text-[16px] sm:text-[24px] font-extrabold">
					Service details
				</h2>
				<textarea class="border-none px-2 py-1 bg-dirtywhite rounded-[7px]" name="repairDesc" id="" rows="3" form="billing" placeholder="repair description"></textarea>
				<input class="border-none px-2 py-1 bg-dirtywhite rounded-[7px]" type="text" name="" id="" placeholder="repair cost">
			</section>

			{{-- the message textbox section --}}
			<section class="px-[10px] flex gap-2 flex-col">
				<h2 class="text-darkblue text-[16px] sm:text-[24px] font-extrabold">
					Message
				</h2>
				<textarea class="border-none px-2 py-1 bg-dirtywhite rounded-[7px]" name="repairDesc" id="" rows="3" form="billing" placeholder="message description"></textarea>
			</section>

			{{-- item, quantity, price and subtotal section --}}
			<section class="mt-[20px]">
				{{-- metadata section for item, quantity, price and subtotal (grayed division) --}}
				<div class="h-[16px] mb-2 bg-dirtywhite">

				</div>

				{{-- item, quantity, price and subtotal textboxes --}}
				<ul class="px-[10px] flex flex-col">
					<li class="flex gap-2 flex-col">
						<input class="border-none my-1 first:mt-0 last:mt-0 px-2 py-1 bg-dirtywhite rounded-[7px]" type="text" name="" id="" placeholder="Item name">
						<div class="flex gap-1 flex-row justify-center">
							<div class="basis-1/2">
								<input class="w-full border-none my-1 first:mt-0 last:mt-0 px-2 py-1 bg-dirtywhite rounded-[7px]" type="text" name="" id="" placeholder="Quantity">
							</div>
							<div class="basis-1/2">
								<input class="w-full border-none my-1 first:mt-0 last:mt-0 px-2 py-1 bg-dirtywhite rounded-[7px]" type="text" name="" id="" placeholder="Price">
							</div>
						</div>

						<div class="flex gap-1 flex-row justify-between items-center text-right">
							<span class="basis-1/2 text-[#5F6368] text-[14px]">Subtotal</span>
							<span class="basis-1/2 text-[#5F6368] text-[14px]">PHP 1000.00</span>
						</div>

						<button class="w-fit text-left text-{{ $site_settings->site_color_theme }}" id="addMoreItemFillUp">+
							Add more</button>
					</li>
				</ul>
			</section>

			{{-- discount, amount and type section --}}
			<section class="pb-[20px]">
				{{-- metadata section for discount amount and type (grayed division) --}}
				<div class="h-[16px] mb-2 bg-dirtywhite">

				</div>

				<div class="px-[10px] flex gap-2 flex-col">
					<input class="border-none my-1 first:mt-0 last:mt-0 px-2 py-1 bg-dirtywhite rounded-[7px]" type="text" name="" id="" placeholder="Add discount">
					<div class="flex gap-1 flex-row justify-center">
						<div class="basis-1/2">
							<input class="w-full border-none my-1 first:mt-0 last:mt-0 px-2 py-1 bg-dirtywhite rounded-[7px]" type="text" name="" id="" placeholder="Amount%">
						</div>

						{{-- the value of the amount of discount --}}
						<div class="basis-1/2">
							<input class="w-full border-none my-1 first:mt-0 last:mt-0 px-2 py-1 bg-dirtywhite rounded-[7px]" type="text" name="" id="" placeholder="Amount_in_value">
						</div>
					</div>

					{{-- php and % toggle --}}
					<div onclick="toggleDiscountType()">
						<label for="discountTypeCheckbox">
							<div class="w-[75px] h-[30px] border-[1px] border-gray-200 flex gap-[1px] flex-row items-center bg-gray-200 text-[12px] rounded-[7px] overflow-clip">
								<div class="basis-1/2 h-full flex flex-row justify-center items-center bg-white" id="php">
									<span>
										Php
									</span>
								</div>
								<div class="basis-1/2 h-full flex flex-row justify-center items-center bg-dirtywhite" id="percent">
									<span>
										%
									</span>
								</div>
							</div>
						</label>
					</div>

					<div class="flex gap-1 flex-row justify-between items-center text-[#5F6368] text-right text-[14px]">
						<span class="basis-1/2">Total Discount</span>
						<span class="basis-1/2" id="discount">- PHP 0000.00</span>
					</div>
					<div class="flex gap-1 flex-row justify-between items-center text-[#5F6368] text-right text-[14px] font-extrabold">
						<span class="basis-1/2">Total</span>
						<span class="basis-1/2" id="total">PHP 0000.00</span>
					</div>
				</div>
			</section>
		</form>
	</div>

	{{-- checkbox hacks --}}
	<input class="absolute -top-full" type="checkbox" checked id="repairStatusCheckBox">
	<input class="absolute -top-full" type="checkbox" checked id="activityLogsCheckbox">
	<input class="absolute -top-full" type="checkbox" checked id="proceedToBillingCheckbox">
	@push('scripts')
		<script>
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			const _advanceSearch = (el, event, url = null) => {
				event.preventDefault()
				let data = $('#' + el.id).serializeArray()
				if (url == null) {
					url = location.href
				}
				$.get(url, data)
					.done((data) => {
						$('#appointments_list').html(data['list'])
						$('#appointments_list_paginate').html(data['paginate'])
						$(() => {
							$('._paginate_btn').click(_paginate)
						})
					})
					.fail((jqXHR, ajaxOptions, thrownError) => {
						alert('An unexpected error occured, please try again.')
					})
			};
			const _paginate = (e) => {
				e.preventDefault()
				let _url = e.currentTarget.dataset.href
				_advanceSearch(
					document.getElementById('appointments_search'),
					e,
					_url
				)
			};
			$(() => {
				$('#appointments_search').change(() => {
					$('#appointments_search').submit()
				})
				$('._paginate_btn').click(_paginate)
			});

			const setRepairButton = (status) => {
				const arr = @json(config('enums.repair_status'));
				// console.log(arr,status)
				if (status == 0) {
					// console.log(status)
					repairOneStatus()
				}
				if (status == 1) {
					// console.log(status)
					repairTwoStatus()
				}
				if (status == 2) {
					// console.log(status)
					repairThreeStatus()
				}
				if (status == 3) {
					// console.log(status)
					repairFourStatus()
				}
				if (status == 4) {
					// console.log(status)
					repairFiveStatus()
				}
			};
			const setAppointmentButton = (status) => {
				const appointment_status = @json(config('enums.appointment_status'));
				const stat = appointment_status[status].toLowerCase()
				if (stat == 'approved') {
					setAppointmentApproved(stat)
				}
				if (stat == 'canceled') {
					setAppointmentCanceled()
				}
				if (stat == 'rejected') {
					setAppointmentRejected(stat)
				}
				if (stat == 'pending') {
					setAppointmentCanceled()
				}

			};

			const getAppointment = (id) => {
				$(() => {
					const url = `{{ route('business.appointments.index') }}/fetch/${id}`
					$('#apptInfoContent').html('')
					$.get(url)
						.done((data) => {
							const appointmentModal = [
								'appointment-id',
								'appointment-user-name',
								'appointment-user-firstname',
								'appointment-user-lastname',
								'appointment-user-contact',
								'appointment-user-contact-alt',
								// 'appointment-user-address',
								'appointment-date',
								'appointment-time',
								'appointment-category',
								'appointment-brand-name',
								'appointment-model-name',
								'appointment-model-number',
								'appointment-concern',
							]
							let arr = []

							$('#apptInfoContent').html(data[0])
							if (data['apt-status'] != {{ \App\Models\Appointments::APPOINTMENT_CANCELED }}) {
								setAppointmentButton(data['apt-status'])
								setRepairButton(data['rpr-status'])
							}

							$(() => {
								// showSlide(1);
								showApptInfo()
							})
						})
				})
			};

			self.changeRepairStatus = (id) => {
				const url = '{{ route('business.appointments.index') }}'
				if (id == 'repStats1') {
					// console.log(url+`/${$('#appointment-id').html()+'/repair/'+$('#repair-'+id+' input').val()}`)
					$('#repair-' + id).attr('action', $('#repair-' + id).attr('action') + `/${$('#appointment-id').html()+'/repair/'+$('#repair-'+id+' input').val()}`)
					$('#repair-' + id).submit()
					repairOneStatus()
				}
				if (id == 'repStats2') {
					// console.log(url+`/${$('#appointment-id').html()+'/repair/'+$('#repair-'+id+' input').val()}`)
					$('#repair-' + id).attr('action', $('#repair-' + id).attr('action') + `/${$('#appointment-id').html()+'/repair/'+$('#repair-'+id+' input').val()}`)
					$('#repair-' + id).submit()
					repairTwoStatus()
				}
				if (id == 'repStats3') {
					// console.log(url+`/${$('#appointment-id').html()+'/repair/'+$('#repair-'+id+' input').val()}`)
					$('#repair-' + id).attr('action', $('#repair-' + id).attr('action') + `/${$('#appointment-id').html()+'/repair/'+$('#repair-'+id+' input').val()}`)
					$('#repair-' + id).submit()
					repairThreeStatus()
				}
				if (id == 'repStats4') {
					// console.log(url+`/${$('#appointment-id').html()+'/repair/'+$('#repair-'+id+' input').val()}`)
					$('#repair-' + id).attr('action', $('#repair-' + id).attr('action') + `/${$('#appointment-id').html()+'/repair/'+$('#repair-'+id+' input').val()}`)
					$('#repair-' + id).submit()
					repairFourStatus()
				}
				if (id == 'repStats5') {
					console.log(url + `/${$('#appointment-id').html()+'/repair/'+$('#repair-'+id+' input').val()}`)
					$('#repair-' + id).attr('action', url + `/${$('#appointment-id').html()+'/repair/'+$('#repair-'+id+' input').val()}`)
					$('#repair-' + id).submit()
					repairFiveStatus()
				}
			}

			self.setAppointment = (buttonid) => {
				// console.log(buttonid)
				// console.log($('#appointment-'+buttonid+' input').val())

				if (buttonid == "approved") {
					// console.log(url+'/'+$('#appointment-id').html()+'/status/'+$('#appointment-'+buttonid+' input').val())
					document.getElementById('appointment-' + buttonid).action += '/' + $('#appointment-id').html() + '/status/' + $('#appointment-' + buttonid + ' input').val()
					$('#appointment-' + buttonid).submit();

				} else if (buttonid == "rejected") {
					// console.log(url+'/'+$('#appointment-id').html()+'/status/'+$('#appointment-'+buttonid+' input').val())
					document.getElementById('appointment-' + buttonid).action += '/' + $('#appointment-id').html() + '/status/' + $('#appointment-' + buttonid + ' input').val()
					$('#appointment-' + buttonid).submit();

				} else if (buttonid == "cancellationMsgDiv") {
					// // console.log(url+'/'+$('#appointment-id').html()+'/status/'+$('#appointment-'+buttonid+' input').val())
					// document.getElementById(buttonid).action += '/'+$('#appointment-id').html()+'/status/'+$('#appointment-'+buttonid+' input').val()
					$('#' + buttonid).submit();
				}
			}
		</script>
	@endpush
@endsection
