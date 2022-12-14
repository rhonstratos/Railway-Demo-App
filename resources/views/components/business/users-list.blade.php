@forelse ($users as $user)
	<li class="px-3 sm:px-0 py-2 mb-2 sm:border-b-[1px] flex flex-col sm:flex-row sm:justify-around sm:items-center gap-2 sm:gap-0 bg-white sm:bg-transparent rounded-[8px] shadow-lg sm:shadow-none text-center">
		{{-- top-row --}}
		<div class="sm:basis-1/6 flex flex-row justify-between sm:justify-center items-center">
			{{-- order id --}}
			<div class="flex flex-row gap-1 italic">
				<span class="sm:hidden">User ID:</span>
				<span class="">{{ $user->userId }}</span>
			</div>
		</div>

		{{-- middle-row --}}
		<div class="sm:basis-4/6 flex flex-row gap-2 sm:gap-0 justify-between sm:justify-around items-center overflow-x-auto">
			{{-- user name --}}
			<div class="sm:basis-1/2 flex flex-row gap-2 sm:justify-center items-center">
				@php
					$profImg = $user->accountSettings->profile_img ? asset('storage/users/' . $user->userId . '/images/profile/' . $user->accountSettings->profile_img) : asset('assets/master/placeholders/poggy.png');
				@endphp
				<div class="">
					<a class="glightbox" data-gallery="gallery-{{ $user->userId }}" href="{{ $profImg }}">
						<img class="object-cover w-[50px] h-[50px] rounded-full" src="{{ $profImg }}" alt="img">
					</a>
				</div>
				<div class="flex flex-col items-start truncate text-left">
					<span class="font-semibold truncate sm:w-[100px] md:w-[150px] lg:w-[175px]">{{ $user->firstname . ' ' . $user->lastname }}</span>
					<span class="italic truncate sm:w-[100px] md:w-[150px] lg:w-[175px]">{{ $user->email }}</span>
				</div>
			</div>

			{{-- date registered --}}
			<div class="sm:basis-1/4 flex flex-col items-center">
				<span class="sm:hidden">Date Registered</span>
				<span>{{ $user->created_at->format('M d, o') }}</span>
			</div>

			{{-- status --}}
			<div class="sm:basis-1/4 flex flex-col items-start sm:items-center">
				<span class="sm:hidden">Status</span>
				@if (!$user->is_banned)
					<span class="text-status-green">Active</span>
				@else
					<span class="text-status-red cursor-pointer" onclick="showBanReason('{{ $user->userId }}')">
						<u>Banned</u>
					</span>
				@endif
				{{-- <span class="text-status-red">Pending delete</span> --}}
				{{-- <span class="text-black italic">Deactivated</span> --}}
			</div>
		</div>

		{{-- bottom-row --}}
		<div class="sm:basis-1/6 flex items-center">
			{{-- Action --}}
			@if (false)
				<button class="w-full px-3 py-1 bg-{{ $site_settings->site_color_theme }} text-white rounded-[4px] shadow-lg truncate" onclick="location.href='{{ route('business.users.show', $user->id) }}'">
					<span class="">Action</span>
				</button>
			@endif

			@if (!$user->is_banned)
				{{-- ban user --}}
				<button type="button" class="w-full px-3 py-1 bg-status-red text-white rounded-[4px] shadow-lg truncate" onclick="document.getElementById('banModal').style.display = 'flex';$('#ban-input-userId').val('{{ $user->userId }}')">
					<span class="">Ban</span>
				</button>
			@else
				{{-- unban user --}}
				<form action="{{ route('business.users.unban') }}" method="post" class="w-full">
					@csrf
					<input type="text" name="userId" value="{{ $user->userId }}" class="hidden" hidden>
					<button type="submit" class="w-full px-3 py-1 bg-{{ $site_settings->site_color_theme }} text-white rounded-[4px] shadow-lg truncate">
						<span class="">Unban</span>
					</button>
				</form>
			@endif
		</div>
	</li>
@empty
	<li class="text-center">
		<h3>No results found</h3>
	</li>
@endforelse
