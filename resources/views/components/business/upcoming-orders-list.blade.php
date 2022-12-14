@props(['order'])
<li class="p-2 border-[2px] flex flex-row gap-2 items-center rounded-[4px] capitalize truncate cursor-pointer" onclick="location.href='{{ route('business.orders.show', $order->orderId) }}'">
	{{-- product image --}}
	<div class="basis-[75px]">
		@php
			$_ord_user = $order->user->accountSettings->profile_img;
			$_userImg = !is_null($_ord_user) ? asset('storage/users/' . $order->user->userId . '/images/profile/' . $_ord_user) : asset('assets/master/placeholders/poggy.png');
		@endphp
		<a class="glightbox" data-gallery="productSummary" href="{{ $_userImg }}">
			<div class="flex justify-center items-center">
				<img class="object-cover w-[50px] h-[50px] rounded-[8px]" src="{{ $_userImg }}" alt="image">
			</div>
		</a>
	</div>

	{{-- other data --}}
	<div class="grow flex flex-col gap-1">
		{{-- name --}}
		<span class="font-semibold w-[200px] truncate">
			{{ $order->user->firstname . ' ' . $order->user->lastname }}
		</span>

		<div class="w-full flex flex-row justify-around items-center gap-2">
			{{-- first half --}}
			@if (false)
				<div class="w-full flex flex-row gap-2 lg:justify-center">
					<span class=""><i class="fa-solid fa-warehouse"></i></span>
					<span>1</span>
				</div>
			@endif
			<div class="w-full flex flex-col lg:flex-row gap-1">
				<div class="w-full flex flex-row gap-2 lg:justify-center">
					<span class=""><i class="fa-solid fa-cart-shopping"></i></span>
					<span class="">{{ $order->items_count }}</span>
				</div>
			</div>
			<div class="w-full flex flex-col lg:flex-row gap-1">
				<div class="w-full flex flex-row gap-2 lg:justify-center">
					<span class=""><i class="fa-solid fa-money-bills"></i></span>
					<span class="">Php {{ number_format((float) $order->total, 2, '.', ',') }}</span>
				</div>
			</div>
		</div>

		{{-- <button class=" lg:basis-1/5 h-[32px] px-3 bg-{{$site_settings->site_color_theme}} text-white rounded-[4px] shadow-lg truncate">
			Action
		</button> --}}
		@if (false)
			<div class="w-[150px] flex flex-row gap-2 lg:justify-center self-end font-semibold">
				<span class="">Subtotal:</span>
				<span>Php 0.00</span>
			</div>
		@endif

		{{-- <div class="lg:basis-1/3 w-full flex flex-col lg:flex-row gap-1"> --}}
		@if (false)
			<div class="flex flex-row gap-2">
				<span class="flex items-center">Discount:</span>
				<span class="">Php 406.00</span>
			</div>
		@endif
		{{-- </div> --}}
	</div>
</li>
