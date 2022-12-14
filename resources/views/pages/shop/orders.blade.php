{{-- parent layout /resources/view/layouts/doubleNavigation --}}
@extends('layouts.doubleNavigation')

{{-- yield('title') --}}
@section('title')
	<title>{{ Str::title(config('app.name')) }} - Order</title>
@endsection

@section('page_name')
	<span class="text-[#CDCECF]">Pages</span>
	<span>/</span>
	<span>Orders</span>
@endsection

{{-- yield('content') --}}
@section('content')
	{{-- header --}}
	<div class="business-header">
		<div class="w-full flex flex-row justify-between items-center text-[12px] 2xl:text-[14px]">
			<h1 class="xl:basis-1/3 text-darkblue text-[24px] sm:text-[32px] font-extrabold">Order</h1>

			@if (false)
				<button class="w-full max-w-[156px] h-[32px] px-3 basis-1/3 bg-white rounded-[8px] shadow-lg truncate" onclick="location.href='{{ route('business.orders.history') }}'">
					<span>Order History</span>
				</button>
			@endif
		</div>
	</div>

	{{-- main content --}}
	<div class="h-[calc(100vh_-_127px)] sm:h-[calc(100vh_-_80px)] xl:h-[calc(100vh_-_76px)] px-4 flex flex-col gap-2">
		{{-- advance orders filter --}}
		<form id="orders_search" onsubmit="_advanceSearch(this,event)" action="{{ route('business.orders.search') }}" method="post" class="px-3 py-2 flex flex-col gap-2 bg-white rounded-[8px] shadow-lg">
			@csrf

			{{-- first row --}}
			<div class="flex flex-col gap-1">
				{{-- filters --}}
				<div class="flex flex-row gap-1">
					<div class="grow flex flex-col md:flex-row gap-1">
						@if (false)
							{{-- category filter --}}
							<select class="w-full border-none h-[32px] px-3 py-0 bg-white rounded-[4px] shadow-lg cursor-pointer text-[12px] 2xl:text-[14px]" id="showApptStatusList">
								<option value="">All</option>
							</select>
						@endif

						<div class="md:basis-1/2 grow flex flex-col justify-start items-start">
							{{-- status filter --}}
							<span class="">Status</span>
							<select name="order_status" class="capitalize w-full border-none h-[32px] px-3 py-0 bg-white rounded-[4px] shadow-lg cursor-pointer focus:ring-{{ $site_settings->site_color_theme }}" id="showApptStatusList">
								<option value="" {{ isset($filter) ? null : __('selected') }}>All</option>
								@foreach (config('enums.order_status_optgroup') as $key => $status)
									@if (is_array($status))
										<optgroup label="Transfer Method: {{ $key }}">
											@foreach ($status as $_key => $_status)
												<option value="{{ $_key }}" {{ isset($filter['order_status']) && $filter['order_status'] == $_key ? __('selected') : null }}>{{ $_status }}</option>
											@endforeach
										</optgroup>
										@continue
									@endif
									<option value="{{ $key }}" {{ isset($filter['order_status']) && $filter['order_status'] == $key ? __('selected') : null }}>{{ $status }}</option>
								@endforeach
							</select>
						</div>

						<div class="md:basis-1/2 md:order-first flex flex-col gap-2">
							{{-- ID and name search --}}
							<div class="order-last md:order-first md:basis-1/2 flex flex-col items-start">
								<span class="hidden md:inline-block">Search</span>
								<div class="w-full flex flex-col gap-1">
									<input class="business-input-textbox focus:ring-{{ $site_settings->site_color_theme }}" type="text" name="search" value="{{ isset($filter['search']) ? $filter['search'] : null }}"
										placeholder="Browse by ID or Customer Name...">
								</div>
							</div>

							{{-- date range --}}
							<div class="md:basis-1/2 flex flex-col gap-1">
								<span class="">Date Range</span>

								<div class="flex flex-row gap-2 justify-between items-center">
									{{-- "from" --}}
									<div class="flex flex-col gap-1 justify-around">
										<span class="text-center">from</span>
									</div>
									{{-- date from --}}
									<div class="w-full flex flex-col gap-1">
										<span class="hidden {{-- invisible --}}">fake span</span>
										<input class="business-input-textbox border-[1px] focus:ring-{{ $site_settings->site_color_theme }}" type="date" name="date_from" value="{{ isset($filter['date_from']) ? $filter['date_from'] : null }}">
									</div>

									{{-- "to" --}}
									<div class="flex flex-col gap-1 justify-around">
										<span class="text-center">to</span>
									</div>

									{{-- date to --}}
									<div class="w-full flex flex-col gap-1">
										<span class="hidden {{-- invisible --}}">fake span</span>
										<input class="business-input-textbox border-[1px] focus:ring-{{ $site_settings->site_color_theme }}" type="date" name="date_to" value="{{ isset($filter['date_to']) ? $filter['date_to'] : null }}">
									</div>
								</div>
							</div>
						</div>
					</div>

					{{-- submit btn --}}
					@if (false)
						<div class="flex flex-col items-start">
							<span class="invisible">.</span>
							<div class="flex flex-row gap-1">
								{{-- search button --}}
								<button type="submit" class="w-[32px] lg:w-auto h-[32px] lg:px-3 flex flex-row justify-center items-center gap-2 bg-white rounded-[4px] shadow-lg truncate">
									<i class="fa-solid fa-magnifying-glass"></i>
									<span class="hidden lg:inline-block">Search</span>
								</button>

								@if (false)
									{{-- collapse button --}}
									<button class="basis-[32px] w-[32px] h-[32px] bg-white rounded-[4px] shadow-lg truncate" onclick="show()" id="showbtn">
										<i class="fa-solid fa-angles-down"></i>
									</button>

									<button class="basis-[32px] w-[32px] h-[32px] hidden bg-{{ $site_settings->site_color_theme }} text-white rounded-[8px] shadow-lg truncate" onclick="hide()" id="hidebtn">
										<i class="fa-solid fa-angles-up"></i>
									</button>
								@endif
							</div>
						</div>
					@endif
				</div>
			</div>

			{{-- second hidden row --}}
			<div class="flex flex-col md:flex-row gap-2" id="secondRow">
				{{-- order number --}}
				<div class="md:basis-1/2 flex flex-col gap-1">
					<span></span>
					{{-- <input class="business-input-textbox" type="text" name="" id=""> --}}
				</div>
			</div>
		</form>

		{{-- second card --}}
		<div class="h-[calc(100vh_-_181px)] sm:h-[calc(100vh_-_181px)] sm:business-whitecard-bg sm:pt-0 flex flex-col gap-2 overflow-y-auto">
			{{-- the table --}}
			<section class="grow">
				{{-- table header part --}}
				<div class="sticky top-0 sm:pt-4 pb-2 sm:pb-0 flex flex-col gap-2 bg-light sm:bg-white">
					<div class="flex flex-row justify-between items-center">
						<span class="text-[16px] font-semibold">Order History</span>

						@if (false)
							{{-- filter --}}
							<select class="basis-1/3 max-w-[220px] border-none w-full h-[32px] px-3 py-0 bg-white rounded-[4px] shadow-lg cursor-pointer text-[12px] 2xl:text-[14px]" id="showApptStatusList">
								<option value="">All</option>
							</select>
						@endif
					</div>

					{{-- metadata --}}
					<div class="py-2 hidden sm:flex flex-row justify-around items-center bg-dirtywhite text-center rounded-t-[4px]">
						<div class="basis-1/5 lg:basis-2/6 flex flex-row gap-1 justify-center items-center">
							<div class="lg:basis-1/2">Order ID</div>
							<div class="lg:hidden">&</div>
							<div class="lg:basis-1/2">Date</div>
						</div>
						<span class="basis-1/5 lg:basis-1/6">Status</span>
						<span class="basis-1/5 lg:basis-1/6">Customer</span>
						@if (false)
							<span class="basis-1/6 lg:basis-[14.3%]">Order</span>
						@endif
						<span class="basis-1/5 lg:basis-1/6">Total</span>
						<span class="basis-1/5 lg:basis-1/6"></span>
					</div>
				</div>

				{{-- the order data --}}
				<ul id="orders_list" class="list-none">
					<x-business.order-list :$orders />
				</ul>
			</section>
		</div>

		<div id="orders_list_paginate" class="flex flex-col">
			<x-paginate-button :data="$orders" />
		</div>
	</div>

	<script>
		//custom scripts here
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
					$('#orders_list').html(data['list'])
					$('#orders_list_paginate').html(data['paginate'])
				})
				.fail((jqXHR, ajaxOptions, thrownError) => {
					alert('An unexpected error occured, please try again.')
				})
		};
		const _paginate = (e) => {
			e.preventDefault()
			let _url = e.currentTarget.dataset.href
			_advanceSearch(
				document.getElementById('orders_search'),
				e,
				_url
			)
		};
		$(() => {
			$('#orders_search').change(() => {
				$('#orders_search').submit()
			})
			$('._paginate_btn').click(_paginate)
		});

		function show() {
			document.getElementById("showbtn").style.display = "none";
			document.getElementById("hidebtn").style.display = "block";

			document.getElementById("secondRow").style.display = "flex";
		}

		function hide() {
			document.getElementById("showbtn").style.display = "block";
			document.getElementById("hidebtn").style.display = "none";

			document.getElementById("secondRow").style.display = "none";
		}
	</script>
@endsection
