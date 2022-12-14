@extends('layouts.doubleNavigation')
{{-- rename this to business or shop --}}

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Reports</title>
@endsection

@section('content')
	<div class="business-header lg:flex-row lg:justify-between lg:items-center">
		<div class="flex flex-col gap-1">
			<h1 class="lg:basis-1/3 text-darkblue text-[24px] sm:text-[32px] font-extrabold">Reports</h1>
			<span class="italic text-[12px]">Reports everyday, every moment of your progress</span>
		</div>

		{{-- filter options --}}
		<form id="query_sales" action="{{ route('business.reports.store') }}" method="post" class="lg:basis-[60%] lg:max-w-[632px] flex flex-row gap-2 text-darkblue dark:text-dirtywhite">
			@csrf
			<input type="text" name="type" value="sales" hidden class="hidden">
			<div class="grow flex flex-row gap-2">
				<button type="submit" name="action" value="export" class="basis-1/2 w-full border-none px-2 py-1 bg-white dark:bg-black rounded-[8px] shadow-lg cursor-pointer">
					<i class="fa-solid fa-arrow-up-right-from-square"></i>
					<span>Export</span>
				</button>

				{{-- appointment status filter (button) --}}
				<select id="query_sales_filter" class="basis-1/2 w-full border-none focus:border-{{ $site_settings->site_color_theme }} h-[32px] px-3 py-0 bg-white rounded-[8px] shadow-lg cursor-pointer focus:ring-{{ $site_settings->site_color_theme }}"
					id="showApptStatusList" name="filter">
					<optgroup label="Filter by Past">
						<option value="7" {{ isset($filter) && $filter == '7' ? __('selected') : null }}>
							<p class="">Past 7 days</p>
						</option>
						<option value="30" {{ isset($filter) && $filter == '30' ? __('selected') : null }}>
							<p class="">Past 30 days</p>
						</option>
						<option value="365" {{ isset($filter) && $filter == '365' ? __('selected') : null }}>
							<p class="">Past 365 days</p>
						</option>
						<option value="all" {{ isset($filter) && $filter == 'all' ? __('selected') : null }}>
							<p class="">Since the beginning</p>
						</option>
					</optgroup>
					<optgroup label="Filter by Calendar">
						<option value="month-last" {{ isset($filter) && $filter == 'month-last' ? __('selected') : null }}>
							<p class="">Last Month of, {{ now()->subMonth()->monthName }}</p>
						</option>
						<option value="month-now" {{ isset($filter) && $filter == 'month-now' ? __('selected') : null }}>
							<p class="">This Month of, {{ now()->monthName }}</p>
						</option>
						<option value="year" {{ isset($filter) && $filter == 'year' ? __('selected') : null }}>
							<p class="">This Year of, {{ now()->year }}</p>
						</option>
						<option value="decade" {{ isset($filter) && $filter == 'decade' ? __('selected') : null }}>
							<p class="">This Decade of, {{ now()->subDecade()->year . ' to ' . now()->year }}</p>
						</option>
					</optgroup>
				</select>
			</div>

			{{-- repair status filter (button) --}}
			@if (false)
				<button type="submit" name="action" value="filter" class="w-[32px] border-none px-2 py-1 bg-white dark:bg-black rounded-[8px] shadow-lg cursor-pointer">
					<i class="fa-solid fa-magnifying-glass"></i>
				</button>
			@endif
		</form>
	</div>

	{{-- main content --}}
	<div class="h-[calc(100vh_-_169px)] sm:h-[calc(100vh_-_138px)] lg:h-[calc(100vh_-_102px)] xl:h-[calc(100vh_-_94px)] px-4 flex flex-col gap-2 overflow-y-auto">
		{{-- reports --}}
		<div class="business-whitecard-bg px-4 flex flex-col gap-2">
			<button class="flex flex-row justify-center items-center bg-white text-darkblue font-semibold" onclick="collapseReports('reportPanel')">
				<i class="fa-solid fa-chevron-up" id="upIcon"></i>
				<i class="fa-solid fa-chevron-down hidden" id="downIcon"></i>
			</button>

			<div class="flex flex-col gap-2" id="reportPanel">
				<!-- Session Status -->
				<x-auth-session-status class="mb-4" :status="session('status')" />

				<!-- Validation Errors -->
				<x-auth-validation-errors class="mb-4" :errors="$errors" />

				{{-- total products sold, appointments and total revenue --}}
				<section class="flex flex-col lg:flex-row gap-2">
					<div class="lg:basis-3/5 flex flex-col sm:flex-row gap-2">

						{{-- total products --}}
						<div class="sm:basis-1/2 px-5 py-2 flex flex-row justify-between items-center bg-white rounded-[8px] shadow-lg">
							<div class=" flex flex-col gap-1">
								<span>Product Sales</span>
								<div class="flex flex-row gap-2 items-center">
									<span id="_product_sales" class="text-[24px] font-semibold">
										Php {{ number_format((float) $_ordersSales, 2, '.', ',') }}
									</span>
									@if (false)
										<div class="px-1 bg-dirtywhite rounded-[4px]">
											<span class="">0%</span>
										</div>
									@endif

									{{-- different status of rates --}}
									{{-- <div class="px-1 bg-[rgba(255,0,0,0.1)] text-[#FF0000] rounded-[4px]">
								<i class="fa-solid fa-arrow-down"></i>
								<span class="">0%</span>
							</div>

							<div class="px-1 bg-[rgba(38,217,71,0.1)] text-[#26d947] rounded-[4px]">
								<i class="fa-solid fa-arrow-up"></i>
								<span class="">0%</span>
							</div> --}}
								</div>
							</div>

							<div class="w-[48px] h-[48px] p-2 flex justify-center items-center bg-{{ $site_settings->site_color_theme }} text-white text-[32px] rounded-[8px]">
								<i class="fa-solid fa-bag-shopping"></i>
							</div>
						</div>

						{{-- total appointments --}}
						<div class="sm:basis-1/2 px-5 py-2 flex flex-row justify-between items-center bg-white rounded-[8px] shadow-lg">
							<div class=" flex flex-col gap-1">
								<span>Appointment Sales</span>
								<div class="flex flex-row gap-2 items-center">
									<span id="_appointment_sales" id="_product_sales" class="text-[24px] font-semibold">
										Php {{ number_format((float) $_appointmentsSales, 2, '.', ',') }}
									</span>
									@if (false)
										<div class="px-1 bg-dirtywhite rounded-[4px]">
											<span class="">0%</span>
										</div>
									@endif

									{{-- different status of rates --}}
									{{-- <div class="px-1 bg-[rgba(255,0,0,0.1)] text-[#FF0000] rounded-[4px]">
								<i class="fa-solid fa-arrow-down"></i>
								<span class="">0%</span>
							</div>

							<div class="px-1 bg-[rgba(38,217,71,0.1)] text-[#26d947] rounded-[4px]">
								<i class="fa-solid fa-arrow-up"></i>
								<span class="">0%</span>
							</div> --}}
								</div>
							</div>

							<div class="w-[48px] h-[48px] p-2 flex justify-center items-center bg-{{ $site_settings->site_color_theme }} text-white text-[32px] rounded-[8px]">
								<i class="fa-solid fa-calendar-check"></i>
							</div>
						</div>
					</div>

					{{-- total revenue --}}
					<div class="lg:basis-2/5 px-5 py-2 flex flex-row justify-center items-center bg-white rounded-[8px] shadow-lg">
						<div class="w-full flex flex-col gap-1 items-center">
							<span>Total Revenue</span>
							<div class="flex flex-row gap-2 items-center">
								<span id="_total_sales" class="text-[24px] font-semibold">Php
									{{ number_format((float) ($_ordersSales + $_appointmentsSales), 2, '.', ',') }}</span>
								@if (false)
									<div class="px-1 bg-dirtywhite rounded-[4px]">
										<span class="">0%</span>
									</div>
								@endif

								{{-- different status of rates --}}
								{{-- <div class="px-1 bg-[rgba(255,0,0,0.1)] text-[#FF0000] rounded-[4px]">
							<i class="fa-solid fa-arrow-down"></i>
							<span class="">0%</span>
						</div>

						<div class="px-1 bg-[rgba(38,217,71,0.1)] text-[#26d947] rounded-[4px]">
							<i class="fa-solid fa-arrow-up"></i>
							<span class="">0%</span>
						</div> --}}
							</div>
						</div>
					</div>
				</section>

				{{-- sales funnel --}}
				@if (false)
					<section class="px-5 py-2 flex flex-col bg-white rounded-[8px] shadow-lg">
						<span>Sales funnel</span>
						<div class="flex justify-center items-center">
							graph here
						</div>
					</section>
				@endif
			</div>
		</div>

		{{-- invoices --}}
		<div class="business-whitecard-bg h-[500px] sm:h-[calc(100vh_-_420px)] lg:h-[calc(100vh_-_283px)] sm:min-h-[500px] mb-4 flex flex-col gap-2">
			{{-- the table --}}
			<div class="flex flex-col gap-2 sm:pt-0 grow overflow-y-auto">
				{{-- table something headings and metadata --}}
				<div class="sticky top-0 flex flex-col gap-3 bg-light sm:bg-white">
					<div class="flex flex-col gap-2 justify-center items-center">
						<div class="w-full flex flex-col lg:flex-row gap-2 lg:justify-between lg:items-center">
							{{-- table headings --}}
							<div class="flex flex-row gap-2 justify-between items-center">
								<h2 class="text-[16px] font-semibold">Recent Invoices</h2>
							</div>

							{{-- advance invoice filters --}}
							@php
								$_filter = isset($filter) ? $filter : null;
								$f_date_start = isset($_filter['review_date_start']) ? $_filter['review_date_start'] : null;
								$f_date_end = isset($_filter['review_date_end']) ? $_filter['review_date_end'] : null;
								$f_search = isset($_filter['review_search']) ? $_filter['review_search'] : null;
							@endphp
							<form id="query_invoices" onsubmit="_advanceSearch(this,'invoices',event)" action="{{ route('business.reports.index') }}" method="post"
								class="w-full max-w-[900px] lg:w-3/4 lg:min-w-[250px] flex flex-col sm:flex-row gap-2 sm:items-center">
								@csrf
								<input type="text" name="type" value="invoices" hidden class="hidden">
								{{-- date range --}}
								<div class="order-last sm:order-first w-full flex flex-row gap-2 justify-end items-center">
									<span class="hidden sm:inline-block">from</span>

									<div class="grow flex flex-row gap-2 justify-between items-center">
										{{-- date from --}}
										<div class="w-full flex flex-col gap-1">
											<span class="hidden {{-- invisible --}}">fake span</span>
											<input class="business-input-textbox border-[1px] rounded-[8px] focus:ring-{{ $site_settings->site_color_theme }}" type="date" name="review_date_start" value="{{ $f_date_start }}" id="review_date_start">
										</div>

										{{-- "to" --}}
										<div class="flex flex-col gap-1 justify-around">
											<span class="text-center">to</span>
										</div>

										{{-- date to --}}
										<div class="w-full flex flex-col gap-1">
											<span class="hidden {{-- invisible --}}">fake span</span>
											<input class="business-input-textbox border-[1px] rounded-[8px] focus:ring-{{ $site_settings->site_color_theme }}" type="date" name="review_date_end" value="{{ $f_date_end }}" id="review_date_end">
										</div>
									</div>
								</div>

								<div class="basis-1/2 flex flex-row gap-2">
									{{-- searchbar --}}
									<div class="w-full flex flex-row bg-dirtywhite rounded-[8px] items-center">
										<i class="fa-solid fa-magnifying-glass px-2"></i>
										<input class="business-input-textbox bg-transparent w-full focus:ring-{{ $site_settings->site_color_theme }}" type="text" name="review_search" value="{{ $f_search }}" placeholder="Browse by ID or Name...">
									</div>

									{{-- search --}}
									@if (false)
										<button type="submit" name="action" value="search" class="w-[32px] border-none px-2 py-1 bg-white dark:bg-black rounded-[8px] shadow-lg cursor-pointer">
											<i class="fa-solid fa-magnifying-glass"></i>
										</button>
									@endif
								</div>
							</form>
						</div>

						{{-- tab --}}
						<div class="w-full max-w-[522px] flex flex-row gap-2 justify-around items-center overflow-x-auto">
							<button class="w-1/2 py-1 border-{{ $site_settings->site_color_theme }} border-b-[2px]" id="appointmentsTabOn" onclick="changeTabs(this.id)">Appointments</button>
							<button class="w-1/2 py-1 border-transparent border-b-[2px] hidden" id="appointmentsTabOff" onclick="changeTabs(this.id)">Appointments</button>
							<button class="w-1/2 py-1 border-{{ $site_settings->site_color_theme }} border-b-[2px] hidden" id="ordersTabOn" onclick="changeTabs(this.id)">Orders</button>
							<button class="w-1/2 py-1 border-transparent border-b-[2px]" id="ordersTabOff" onclick="changeTabs(this.id)">Orders</button>
						</div>
					</div>

					{{-- metadata --}}
					<div class="py-3 hidden sm:flex flex-row justify-around items-center bg-dirtywhite text-center rounded-t-[4px]">
						<span class="basis-1/6">User ID</span>
						<span class="basis-1/6" id="apptSpanMetadata">Appointment ID</span>
						<span class="basis-1/6 hidden" id="orderSpanMetadata">Order ID</span>
						<span class="basis-2/6">Name</span>
						<span class="basis-1/6">Date</span>
						<span class="basis-1/6">Action</span>
					</div>
				</div>

				{{-- invoice tables --}}
				<ul class="list-none" id="appointmentsInvoiceTable">
					{{-- appointment billing invoice --}}
					<x-business.invoice-appointment-list :invoice="$appointments" />
				</ul>

				<ul class="list-none hidden" id="ordersInvoiceTable">
					{{-- orders invoice --}}
					<x-business.invoice-orders-list :invoice="$orders" />
				</ul>
			</div>

			{{-- put pagination here --}}
			<div class="w-full"id="pagination1">
				<x-paginate-button :data="$appointments" />
			</div>
			<div class="w-full hidden" id="pagination2">
				<x-paginate-button :data="$orders" />
			</div>
		</div>
	</div>

	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		const _advanceSearch = (el, type, event, url = null) => {
			event.preventDefault()
			let data = $('#' + el.id).serializeArray()
			if (url == null) {
				url = location.href
			}
			if (type == 'sales') {
				$.get(url, data)
					.done((data) => {
						const _keys = ['product', 'appointment', 'total']
						_keys.forEach((k) => {
							$('#_' + k + '_sales').html(data[k])
						})
					})
					.fail((jqXHR, ajaxOptions, thrownError) => {
						alert('An unexpected error occured, please try again.')
					})
			} else if (type == 'invoices') {
				$.get(url, data)
					.done((data) => {
						$('#appointmentsInvoiceTable').html(data['appointments'])
						$('#pagination1').html(data['appointments_paginate'])
						$('#ordersInvoiceTable').html(data['orders'])
						$('#pagination2').html(data['orders_paginate'])
					})
					.fail((jqXHR, ajaxOptions, thrownError) => {
						alert('An unexpected error occured, please try again.')
					})
			} else {
				alert('An unexpected error occured, please try again.')
			}
		};

		const _paginate = (e) => {
			e.preventDefault()
			let _url = e.currentTarget.dataset.href
			_advanceSearch(
				document.getElementById('query_invoices'),
				e,
				_url
			)
		};
		$(() => {
			$('#query_sales_filter').change((event) => {
				let _el = document.getElementById('query_sales')
				_advanceSearch(_el, 'sales', event)
			})
			$('#query_invoices').change(() => {
				$('#query_invoices').submit()
			})
			$('._paginate_btn').click(_paginate)
		});

		function collapseReports(id) {
			if (document.getElementById(id).style.display == "none") {
				document.getElementById(id).style.display = "flex";

				document.getElementById('upIcon').style.display = "inline-block";
				document.getElementById('downIcon').style.display = "none";
			} else {
				document.getElementById(id).style.display = "none";

				document.getElementById('upIcon').style.display = "none";
				document.getElementById('downIcon').style.display = "inline-block";
			}
		}

		function changeTabs(id) {
			switch (id) {
				case "appointmentsTabOff":
					//change buttons
					document.getElementById("appointmentsTabOn").style.display = "block";
					document.getElementById("appointmentsTabOff").style.display = "none";

					document.getElementById("ordersTabOn").style.display = "none";
					document.getElementById("ordersTabOff").style.display = "block";

					//change displays
					document.getElementById("appointmentsInvoiceTable").style.display = "block";
					document.getElementById("ordersInvoiceTable").style.display = "none";

					//change metadata
					document.getElementById("apptSpanMetadata").style.display = "inline-block";
					document.getElementById("orderSpanMetadata").style.display = "none";

					//change pagination
					document.getElementById("pagination1").style.display = "inline-block";
					document.getElementById("pagination2").style.display = "none";
					break;
				case "ordersTabOff":
					//change buttons
					document.getElementById("appointmentsTabOn").style.display = "none";
					document.getElementById("appointmentsTabOff").style.display = "block";

					document.getElementById("ordersTabOn").style.display = "block";
					document.getElementById("ordersTabOff").style.display = "none";

					//change displays
					document.getElementById("appointmentsInvoiceTable").style.display = "none";
					document.getElementById("ordersInvoiceTable").style.display = "block";

					//change metadata
					document.getElementById("apptSpanMetadata").style.display = "none";
					document.getElementById("orderSpanMetadata").style.display = "inline-block";

					//change pagination
					document.getElementById("pagination1").style.display = "none";
					document.getElementById("pagination2").style.display = "inline-block";
					break;
			}
		}
	</script>
@endsection
