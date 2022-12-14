@props(['invoice'])
@forelse ($invoice as $_invoice)
	@php
		$_user = $_invoice->user;
		$_userImg = $_user->accountSettings->profile_img ? asset('storage/users/' . $_user->userId . '/images/profile/' . $_user->accountSettings->profile_img) : asset('assets/master/placeholders/poggy.png');
	@endphp
	<li class="px-3 sm:px-0 py-2 mb-2 sm:border-b-[1px] flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-0 bg-white sm:bg-transparent rounded-[8px] shadow-lg sm:shadow-none text-center">
		{{-- top-row --}}
		<div class="sm:basis-2/6 flex flex-row justify-between sm:justify-center items-center">
			{{-- order id --}}
			<div class="sm:basis-1/2 flex flex-row justify-center gap-1 italic">
				<span class="sm:hidden">Order ID:</span>
				<span class="sm:w-[75px] md:w-auto truncate">{{ $_invoice->orderId }}</span>
			</div>
			{{-- user id --}}
			<div class="sm:basis-1/2 flex flex-row justify-center gap-1 italic">
				<span class="sm:hidden">User ID:</span>
				<span class="sm:w-[75px] md:w-auto truncate">{{ $_invoice->user->userId }}</span>
			</div>
		</div>

		{{-- middle-row --}}
		<div class="sm:basis-4/6 flex justify-between items-center">
			{{-- user name --}}
			<div class="sm:basis-1/2 flex flex-row gap-2 sm:justify-center items-center">
				<div class="">
					<img class="object-cover w-[50px] h-[50px] rounded-full" src="{{ $_userImg }}" alt="">
				</div>
				<div class="flex flex-col items-start truncate text-left">
					<span class="font-semibold truncate sm:w-[100px] md:w-[150px] lg:w-[175px]">{{ $_invoice->user->firstname . ' ' . $_invoice->user->lastname }}</span>
					<span class="italic truncate sm:w-[100px] md:w-[150px] lg:w-[175px]">{{ $_invoice->user->email }}</span>
				</div>
			</div>

			<div class="sm:basis-1/2 flex gap-2 items-center">
				{{-- date registered --}}
				<div class="sm:basis-1/2 flex flex-col sm:justify-center items-center">
					<span class="sm:hidden">Billing Date:</span>
					<span class="sm:w-[75px] md:w-auto truncate">{{ $_invoice->created_at->format('M d, o') }}</span>
				</div>

				<div class="sm:basis-1/2 flex justify-center items-center cursor-pointer" onclick="location.href='{{ route('business.reports.invoice.show', ['type' => 'order', 'id' => $_invoice->orderId]) }}'">
					<span class="text-[20px]">&#10095;</span>
				</div>
			</div>
		</div>
	</li>
@empty
	<div class="text-center">
		empty
	</div>
@endforelse
