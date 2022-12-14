@extends('layouts.doubleNavigation')
{{-- rename this to business or shop --}}

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Appointment Reviews</title>
@endsection

@section('content')
	{{-- header --}}
	<div class="business-header lg:flex-row lg:justify-between lg:items-center">
		<div class="w-fit flex flex-row gap-3 items-center cursor-pointer" onclick="location.href='{{ route('business.appointments.index') }}'">
			<span class="text-[20px]">&#10094;</span>
			<div class="flex flex-col">
				<h1 class="xl:basis-1/3 text-darkblue text-[24px] sm:text-[32px] font-extrabold">
					<span>Appointment Reviews</span>
				</h1>
			</div>
		</div>

		{{-- filter options  --}}
		<form id="reviews_search" onsubmit="_advanceSearch(this,event)" action="{{ route('business.appointments.reviews.filter') }}" method="post"
			class="business-whitecard-bg flex flex-col md:flex-row lg:basis-[60%] gap-2 items-end lg:bg-transparent lg:shadow-none">
			@csrf
			<div class="w-full flex flex-col md:flex-row gap-2">
				{{-- status filter --}}
				<div class="md:basis-1/2 w-full flex flex-col gap-1">
					<span class="">Stars</span>

					<select class="w-full border-none h-[32px] px-3 py-0 bg-white rounded-[8px] shadow-lg cursor-pointer focus:ring-{{ $site_settings->site_color_theme }}" id="showApptStatusList" name="star_filter">
						<option value="">All</option>
						<option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
						<option value="4">&#9733;&#9733;&#9733;&#9733;</option>
						<option value="3">&#9733;&#9733;&#9733;</option>
						<option value="2">&#9733;&#9733;</option>
						<option value="1">&#9733;</option>
					</select>
				</div>

				{{-- date range --}}
				<div class="w-full md:min-w-[250px] flex flex-col sm:flex-row gap-2 sm:items-end">
					<div class="w-full flex flex-row gap-2 justify-end items-center">
						<div class="grow flex flex-col sm:flex-row gap-2 justify-between items-center">
							<div class="w-full flex flex-row gap-2">
								{{-- "from" --}}
								<div class="sm:hidden w-[32px] flex flex-col gap-1 justify-around">
									<span class="text-center">from</span>
								</div>

								{{-- date from --}}
								<div class="w-full flex flex-col gap-1">
									<span class="hidden {{-- invisible --}}">fake span</span>
									<input class="business-input-textbox border-[1px] rounded-[8px] focus:ring-{{ $site_settings->site_color_theme }}" type="date" name="date_from" value="{{ old('date_from') }}">
								</div>
							</div>

							{{-- "to" --}}
							<div class="hidden sm:flex flex-col gap-1 justify-around">
								<span class="text-center">to</span>
							</div>

							<div class="w-full flex flex-row gap-2">
								{{-- "to" --}}
								<div class="w-[32px] sm:hidden flex flex-col gap-1 justify-around">
									<span class="text-center">to</span>
								</div>

								{{-- date to --}}
								<div class="w-full flex flex-col gap-1">
									<span class="hidden {{-- invisible --}}">fake span</span>
									<input class="business-input-textbox border-[1px] rounded-[8px] focus:ring-{{ $site_settings->site_color_theme }}" type="date" name="date_to" value="{{ old('date_to') }}">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			{{-- search button --}}
			@if (false)
				<button type="submit" class="w-auto h-[32px] px-3 flex flex-row justify-center items-center gap-2 bg-white rounded-[8px] shadow-lg truncate">
					<i class="fa-solid fa-magnifying-glass"></i>
					<span class="lg:hidden">Search</span>
				</button>
			@endif
		</form>
	</div>

	{{-- main content --}}
	<div class="h-[calc(100vh_-_303px)] sm:h-[calc(100vh_-_272px)] md:h-[calc(100vh_-_170px)] lg:h-[calc(100vh_-_118px)] xl:h-[calc(100vh_-_110px)] 2xl:h-[calc(100vh_-_113px)] px-4 flex flex-col gap-2 rounded-[8px] text-[12px] 2xl:text-[14px]">
		<ul id="reviews_list" class="grow list-none flex flex-col overflow-y-auto">
			<x-business.appoinement-review-card :$reviews :$shop />
		</ul>

		<div id="reviews_list_paginate" class="flex flex-col">
			<x-paginate-button :data="$reviews" />
		</div>
	</div>

	{{-- scripts are here --}}
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
					$('#reviews_list').html(data['list'])
					$('#reviews_list_paginate').html(data['paginate'])
				})
				.fail((jqXHR, ajaxOptions, thrownError) => {
					alert('An unexpected error occured, please try again.')
				})
		};
		const _paginate = (e) => {
			e.preventDefault()
			let _url = e.currentTarget.dataset.href
			_advanceSearch(
				document.getElementById('reviews_search'),
				e,
				_url
			)
		};
		$(() => {
			$('#reviews_search').change(() => {
				$('#reviews_search').submit()
			})
			$('._paginate_btn').click(_paginate)
		});
		const checkEl = document.getElementById("check#id")
		const _url = '{{ route('business.reviews.favorite') }}'
		const changeheart = (id, revId) => {
			let heartEl = document.getElementById(id)
			let _post = {
				id: revId
			};
			$.post(_url, _post)
				.done((data) => {
					console.log(data)
					$(() => {
						if (data['status'] && data['action'] == 'add') {
							heartEl.style.color = "#F03023";
						} else if (data['status'] && data['action'] == 'remove') {
							heartEl.style.color = "";
						}
					})
				})
		};
	</script>
@endsection
