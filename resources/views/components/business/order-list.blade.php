@forelse ($orders as $order)
	<li class="px-3 sm:px-0 py-2 mb-2 sm:my-1 sm:border-b-[1px] flex flex-col sm:flex-row gap-2 sm:gap-0 bg-white sm:bg-transparent rounded-[8px] shadow-lg sm:shadow-none text-center">
		{{-- top-row --}}
		<div class="sm:basis-1/5 lg:basis-2/6 flex flex-row sm:flex-col lg:flex-row justify-between items-center">
			{{-- order id --}}
			<div class="sm:basis-1/2 flex flex-row gap-1 sm:justify-center italic sm:not-italic">
				<span class="sm:hidden">Order ID:</span>
				<span>{{ $order->orderId }}</span>
			</div>

			{{-- order date --}}
			<span class="sm:basis-1/2 italic">
				{{ $order->created_at->format('D, M d, o') }}
				-
				{{ $order->created_at->format('h:i A') }}
			</span>
		</div>

		{{-- middle-row --}}
		<div class="sm:basis-3/5 lg:basis-3/6 sm:order-last flex flex-row justify-around items-center">
			{{-- customer name --}}
			<span class="sm:basis-1/3 font-semibold">{{ $order->user->firstname . ' ' . $order->user->lastname }}</span>

			@if (false)
				{{-- order --}}
				<div class="sm:basis-1/4 flex flex-col gap-1 items-center">
					<span class="sm:hidden">Order</span`>
						<span>Screws kit</span>
				</div>
			@endif

			{{-- price --}}
			<span class="sm:basis-1/3">Php {{ number_format((float) $order->total, 2, '.', ',') }}</span>

			{{-- view more --}}
			<button type="button" onclick="location.href='{{ route('business.orders.show', $order->orderId) }}'"
				class=" cursor-pointer business-label-as-button bg-{{ $site_settings->site_color_theme }} sm:basis-1/3 sm:bg-transparent sm:text-customgray-darkgray shadow-lg sm:shadow-none truncate">
				<span class="sm:hidden">View More</span>
				<i class="fa-solid fa-chevron-right"></i>
			</button>
		</div>

		{{-- bottom-row --}}
		<div class="sm:basis-1/5 lg:basis-1/6 sm:order-2 flex justify-end sm:justify-center items-center">
			{{-- font color is needed --}}
			<span class="font-semibold">{{ config('enums.order_status')[$order->status] }}</span>
			{{-- <span class="text-status-green">Completed</span> --}}
			{{-- <span class="text-status-red">Cancelled</span> --}}
		</div>
	</li>
@empty
	<li class="text-center">
		<h2>no orders found</h2>
	</li>
@endforelse
