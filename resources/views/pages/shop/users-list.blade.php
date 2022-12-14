{{-- parent layout /resources/view/layouts/doubleNavigation --}}
@extends('layouts.doubleNavigation')

{{-- yield('title') --}}
@section('title')
	<title>{{ Str::title(config('app.name')) }} - User List</title>
@endsection

@section('page_name')
	<span class="text-[#CDCECF]">Pages</span>
	<span>/</span>
	<span>Orders</span>
@endsection

{{-- yield('content') --}}
@section('content')
	{{-- header --}}
	<div class="business-header lg:flex-row lg:justify-between lg:items-center">
		<span class="flex flex-col gap-1">
			<h1 class="xl:basis-1/3 text-darkblue text-[24px] sm:text-[32px] font-extrabold">User list</h1>
			<span class="italic text-[12px]">Here are the list of users that are registered within the system</span>
		</span>
	</div>

	{{-- main content --}}
	<div class="h-[calc(100vh_-_149px)] sm:h-[calc(100vh_-_102px)] xl:h-[calc(100vh_-_94px)] px-4 flex flex-col gap-2 text-[12px] 2xl:text-[14px]">
		{{-- the table --}}
		<div class="sm:business-whitecard-bg sm:pt-0 grow overflow-y-auto">
			{{-- table something headings and metadata --}}
			<div class="sticky top-0 sm:pt-4 flex flex-col gap-3 bg-light sm:bg-white">
				<div class="flex flex-col md:flex-row gap-2 md:justify-between md:items-center">
					{{-- table headings --}}
					<div class="flex flex-row gap-2 justify-between items-center">
						<h2 class="text-[16px] font-semibold">User Information</h2>
					</div>

					<form onsubmit="_advanceSearch(this,event)" id="_search_users" action="{{ route('business.users.search') }}" method="post" class="md:w-1/2 md:min-w-[250px] flex flex-row gap-2 justify-center items-center">
						@csrf
						{{-- dropdown for show --}}
						<div class="basis-1/2 flex flex-row gap-2 items-center">
							<span>Show</span>
							@php
								$_usr_active = \App\Models\User::IS_ACCOUNT_ACTIVE;
								$_usr_banned = \App\Models\User::IS_ACCOUNT_BANNED;
							@endphp
							<select name="user_status"
								class="min-w-[91px] border-transparent focus:border-{{ $site_settings->site_color_theme }} w-full h-[32px] px-3 py-0 bg-white rounded-[8px] shadow-lg cursor-pointer text-[12px] 2xl:text-[14px] focus:ring-{{ $site_settings->site_color_theme }}"
								id="showApptStatusList">
								<option value="" {{ !isset($filter) ? __('selected') : null }}>All</option>
								<option value="{{ $_usr_active }}" {{ isset($filter) && $filter == $_usr_active ? __('selected') : null }}>Active</option>
								<option value="{{ $_usr_banned }}" {{ isset($filter) && $filter == $_usr_banned ? __('selected') : null }}>Banned</option>
							</select>
						</div>

						{{-- searchbar --}}
						<div class="basis-1/2 flex flex-row bg-dirtywhite rounded-[8px] items-center focus:ring-{{ $site_settings->site_color_theme }}">
							<i class="fa-solid fa-magnifying-glass px-2"></i>
							<input class="business-input-textbox bg-transparent w-full" type="text" name="search" value="" placeholder="Browse by ID or Name...">
						</div>
						{{-- submit btn --}}
						@if (false)
							<div class="flex flex-col items-start">
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
					</form>
				</div>

				{{-- metadata --}}
				<div class="py-3 hidden sm:flex flex-row justify-around items-center bg-dirtywhite text-center rounded-t-[4px]">
					<span class="basis-1/6">User ID</span>
					<div class="basis-4/6 flex flex-row items-center">
						<span class="basis-1/2">Name</span>
						<span class="basis-1/4">Date Registered</span>
						<span class="basis-1/4">Status</span>
					</div>
					<span class="basis-1/6">Action</span>
				</div>
			</div>

			{{-- order history table --}}
			<ul class="list-none" id="users_list">
				<x-business.users-list :$users />
			</ul>
		</div>

		{{-- ban modal input --}}
		<form action="{{ route('business.users.store') }}" method="post" class="business-modalbg" id="banModal">
			@csrf
			<div class="business-modal1">
				<div class="flex flex-col gap-1" id="bannerModal">
					<div class="flex flex-row justify-between items-center">
						<span class="font-semibold">Ban this user</span>

						{{-- close button --}}
						<label class="business-close-button" onclick="document.getElementById('banModal').style.display = 'none';$('#ban-modal-input-textarea').val('');">
							<span class="text-[20px]">&#10799;</span>
						</label>
					</div>
					<input type="text" id="ban-input-userId" name="userId" class="hidden" hidden>
					<textarea class="w-full border-none px-2 py-1 bg-dirtywhite rounded-[4px] focus:ring-{{ $site_settings->site_color_theme }}" id="ban-modal-input-textarea" name="reason" rows="9"
					 placeholder="State the reason why you will ban this user..."></textarea>
				</div>

				{{-- modal footer --}}
				<div class="flex flex-row gap-2 self-end">
					<button type="submit" class="px-5 py-1 bg-{{ $site_settings->site_color_theme }} text-white rounded-[4px]">
						Ban User
					</button>
				</div>
			</div>
		</form>

		{{-- ban modal display --}}
		<div class="business-modalbg" id="reasonModal">
			<div class="business-modal1">
				<div class="flex flex-col gap-1" id="bannerModal">
					<div class="flex flex-row justify-between items-center">
						<span class="font-semibold">Reason why you banned this user:</span>

						{{-- close button --}}
						<label class="business-close-button" onclick="document.getElementById('reasonModal').style.display = 'none';">
							<span class="text-[20px]">&#10799;</span>
						</label>
					</div>

					<span class="px-2" id="ban-reason-show">Pangit ka kase</span>
				</div>
			</div>
		</div>

		{{-- put pagination here --}}
		<div id="users_list_paginate" class="flex flex-col">
			<x-paginate-button :data="$users" />
		</div>
	</div>

	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		const showBanReason = (userId) => {
			let url = '{{ route('business.users.ban.reason') }}'
			$.get(url, {
					userId: userId
				})
				.done((data) => {
					$('#ban-reason-show').html(data)
					$(() => {
						document.getElementById('reasonModal').style.display = 'flex';
					})
				})
		};
		const _advanceSearch = (el, event, url = null) => {
			event.preventDefault()
			let data = $('#' + el.id).serializeArray()
			if (url == null) {
				url = location.href
			}
			$.get(url, data)
				.done((data) => {
					$('#users_list').html(data['list'])
					$('#users_list_paginate').html(data['paginate'])
				})
				.fail((jqXHR, ajaxOptions, thrownError) => {
					alert('An unexpected error occured, please try again.')
				})
		};
		const _paginate = (e) => {
			e.preventDefault()
			let _url = e.currentTarget.dataset.href
			_advanceSearch(
				document.getElementById('_search_users'),
				e,
				_url
			)
		};
		$(() => {
			$('#_search_users').on('change', () => {
				$('#_search_users').submit()
			})
			$('._paginate_btn').click(_paginate)
		});
	</script>
@endsection
