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
		<span class="w-fit flex flex-row gap-3 items-center cursor-pointer" onclick="location.href='{{ route('business.orders.index') }}'">
			<span class="text-[20px]">&#10094;</span>
			<div class="flex flex-col">
				<h1 class="xl:basis-1/3 text-darkblue text-[24px] sm:text-[32px] font-extrabold">
					<span>Orders</span>
				</h1>
				<span class="italic text-[12px]">#{{ $order->orderId }}</span>
			</div>
		</span>
	</div>

	{{-- main content --}}
	<div class="h-[calc(100vh_-_129px)] sm:h-[calc(100vh_-_98px)] xl:h-[calc(100vh_-_90px)] px-4 flex flex-col gap-2 text-[12px] 2xl:text-[14px] overflow-y-auto">
		<!-- Session Status -->
		<x-auth-session-status class="mb-4" :status="session('status')" />

		<!-- Validation Errors -->
		<x-auth-validation-errors class="mb-4" :errors="$errors" />

		{{-- first row --}}
		<section class="flex flex-col lg:flex-row gap-2">
			{{-- Order details, status and payment details --}}
			<div class="lg:basis-2/3 business-whitecard-bg gap-3">
				{{-- 3 buttons --}}
				<div class="w-full pb-3 border-b-[1px] flex flex-row gap-2 justify-around items-center overflow-x-auto">
					<button class="w-1/3 py-1 border-{{ $site_settings->site_color_theme }} border-b-[2px]" id="orderDetailsOn" onclick="changeTab(this.id)">Overview</button>
					<button class="w-1/3 py-1 border-transparent border-b-[2px] hidden" id="orderDetailsOff" onclick="changeTab(this.id)">Overview</button>
					<button class="w-1/3 py-1 border-{{ $site_settings->site_color_theme }} border-b-[2px] hidden" id="status&paymentDetailsOn" onclick="changeTab(this.id)">Status & Payment Details</button>
					<button class="w-1/3 py-1 border-transparent border-b-[2px]" id="status&paymentDetailsOff" onclick="changeTab(this.id)">Status & Payment Details</button>
				</div>

				{{-- sub contents --}}
				<section class="">
					{{-- Order details --}}
					<div class="flex flex-col gap-2" id="orderDetailsDiv">
						{{-- overview --}}
						<div class="flex flex-col gap-2">
							<span class="text-[16px] font-semibold">Overview</span>

							<div class="w-full px-3 flex flex-col gap-1">
								<div class="flex flex-row gap-2">
									<span class="">Created:</span>
									<span class="font-semibold">
										{{ $order->created_at->format('D, M d, o - h:i A') }}
									</span>
								</div>
								<div class="flex flex-row gap-2">
									<span class="">Order Status:</span>
									<span class="font-semibold">{{ config('enums.order_status')[$order->status] }}</span>
								</div>
								<div class="flex flex-row gap-2">
									<span class="">Transfer Method:</span>
									<span class="font-semibold capitalize">{{ $order->transfer_method }}</span>
								</div>
								<div class="flex flex-row gap-2">
									<span class="">Payment Method:</span>
									<span class="font-semibold capitalize">{{ $order->payment_method }}</span>
								</div>
								<div class="flex flex-row gap-2">
									<span class="">Order Total:</span>
									<span>Php <span class="font-semibold capitalize">{{ number_format((float) $order->total, 2, '.', ',') }}</span>
									</span>
								</div>
								@if (false)
									<div class="flex flex-row gap-2">
										<span class="">Order Confirmed:</span>
										<span class="">22 Aug 2022, 10:02 am</span>
									</div>
									<div class="flex flex-row gap-2">
										<span class="">Printed:</span>
										<span class="">22 Aug 2022, 10:02 am</span>
									</div>
									<div class="flex flex-row gap-2">
										<span class="">Email:</span>
										<span class="">jajajaj@gmail.com</span>
									</div>
								@endif
							</div>
						</div>
						{{-- if order has invoice ? true : false --}}
						@if (false)
							{{-- invoice --}}
							<div class="flex flex-col gap-2">
								<span class="text-[16px] font-semibold">Invoice</span>

								<div class="w-full px-3 flex flex-col gap-1">
									<div class="flex flex-row gap-2">
										<span class="">Price:</span>
										<span class="">Php 000.00</span>
									</div>
									<div class="flex flex-row gap-2">
										<span class="">Shipping:</span>
										<span class="">Php 000.00</span>
									</div>
									<div class="flex flex-row gap-2">
										<span class="">Total payable:</span>
										<span class="">Php 000.00</span>
									</div>
								</div>
							</div>
						@endif
					</div>

					{{-- Payment details --}}
					<div class="hidden flex-col gap-2" id="status&paymentDetailsDiv">
						<div class="flex flex-col gap-2 sm:flex-row sm:justify-between sm:items-center">
							<span class="text-[16px] font-semibold">Status</span>

							<form class="basis-1/2" action="{{ route('business.orders.status.update') }}" method="post">
								@csrf
								@method('PATCH')
								<div class="flex flex-row gap-1">
									<input type="text" name="orderId" value="{{ $order->orderId }}" readonly hidden class="hidden">
									{{-- pending filter --}}
									<select
										class="basis-1/2 min-w-[91px] border-0 h-[32px] px-3 py-0 bg-white rounded-[4px] shadow-lg cursor-pointer text-[12px] 2xl:text-[14px] focus:ring-{{$site_settings->site_color_theme}}"
										id="showApptStatusList" name="order_status">
										@foreach ($stat as $key => $status)
											<option value="{{ $key }}" {{ $key == $order->status ? __('selected') : null }}>
												{{ $status }}
											</option>
										@endforeach
									</select>
									@if ($order->status == \App\Models\Orders::STATUS_COMPLETED || $order->status == \App\Models\Orders::STATUS_CANCELED)
										<button disabled type="button" class="basis-1/2 h-[32px] px-3 bg-customgray-darkgray text-white rounded-[4px] shadow-lg truncate">
											<span>UPDATE</span>
										</button>
									@else
										<button type="submit" class="basis-1/2 h-[32px] px-3 bg-{{ $site_settings->site_color_theme }} text-white rounded-[4px] shadow-lg truncate">
											<span>UPDATE</span>
										</button>
									@endif
								</div>
							</form>
						</div>

						<div class="w-full pb-3 border-b-[1px] flex flex-row justify-between items-center">
							<span class="text-[16px] font-semibold">Payment details</span>

							<div class="basis-1/2 flex flex-row gap-1">
								{{-- pending filter --}}
								@if (false)
									<button type="button" class="basis-1/2 min-w-[80px] h-[32px] px-3 flex flex-row justify-center items-center gap-2 bg-dirtywhite rounded-[4px] shadow-lg truncate">
										<i class="fa-solid fa-paper-plane"></i>
										<span>INVOICE</span>
									</button>
								@endif

								<button type="button" class="basis-1/2 justify-end h-[32px] px-3 bg-{{ $site_settings->site_color_theme }} text-white rounded-[4px] shadow-lg truncate">
									<span>PRINT INVOICE</span>
								</button>
							</div>
						</div>

						{{-- content --}}
						<div class="px-3 flex flex-col gap-2 overflow-x-auto">
							{{-- metadata --}}
							<div class="hidden flex-row gap-2 items-center">
								<span class="basis-1/6 text-center">DATE</span>
								<span class="basis-1/6 text-center">AMOUNT</span>
								<span class="basis-1/6 text-center">TRANSACITON ID</span>
								<span class="basis-1/6 text-center">ACTION</span>
							</div>

							{{-- data --}}
							<div class="flex flex-col gap-2">
								{{-- 1st row --}}
								<div class="flex flex-row gap-2">
									<div class="w-full flex flex-row gap-2 items-center">
										<span class="">Date:</span>
										<span class="">22 Aug 2022</span>
									</div>
									<div class="w-full flex flex-row gap-2 items-center">
										<span class="">Transaction ID:</span>
										<span class="">123456789</span>
									</div>
								</div>

								{{-- 2nd row --}}
								<div class="flex flex-row gap-1">
									<div class="w-full flex flex-row gap-2 items-center">
										<span class="">Amount:</span>
										<span class="">Php 406.00</span>
									</div>
									<div class="w-full flex flex-row gap-2 items-center">
										<span class="">Action:</span>
										<span class="">...</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>

			{{-- customer details --}}
			<div class="lg:basis-1/3 business-whitecard-bg gap-3">
				<div class="w-full flex flex-row gap-2 items-center font-semibold">
					<h2 class="text-[16px]">Customer details</h2>
				</div>

				{{-- sub contents --}}
				<div class="px-3 flex flex-col gap-2">
					{{-- name --}}
					<div class="flex flex-col gap-1">
						<span>Name:</span>
						<span class="px-3 font-semibold capitalize">{{ $order->user->firstname . ' ' . $order->user->lastname }}</span>
					</div>

					{{-- phone number --}}
					<div class="flex flex-col gap-1">
						<span>Phone Number:</span>
						<span class="px-3 font-semibold capitalize">{{ $order->user->contact }}</span>
					</div>

					{{-- address --}}
					<div class="flex flex-col gap-1">
						<span>Address:</span>
						<span class="px-3 font-semibold capitalize">{{ $order->user->address ?? __('undefined') }}</span>
					</div>
				</div>
			</div>
		</section>

		{{-- second row --}}
		<section class="mb-4">
			{{-- Product summary --}}
			<div class="lg:business-whitecard-bg gap-3">
				<div class="w-full py-2 px-3 flex flex-row gap-2 justify-between items-center font-semibold">
					<h2 class="text-[16px]">Product Summary</h2>
					@if (false)
						<button class="h-[32px] px-3 flex flex-row gap-2 justify-center items-center bg-{{ $site_settings->site_color_theme }} text-white rounded-[4px] shadow-lg truncate">
							<i class="fa-solid fa-paper-plane"></i>
							<span>Out of Stock</span>
						</button>
					@endif
				</div>

				{{-- sub contents --}}
				<div class="business-whitecard-bg lg:bg-transparent lg:shadow-none">
					{{-- metadata --}}
					<div class="py-2 hidden lg:flex flex-row text-center items-center bg-dirtywhite rounded-t-[4px]">
						<span class="basis-1/6"></span>
						<span class="basis-1/6">Product</span>
						<span class="basis-1/6">Current Inventory Quantity</span>
						<span class="basis-1/6">Order Quantity</span>
						<span class="basis-1/6">Item Price</span>
						<span class="basis-1/6">Subtotal</span>
						{{-- <span class="basis-[14.3%]">Discount</span> --}}
					</div>

					<div id="ordered-products">
						<x-business.order-product-list :$order />
					</div>
				</div>
			</div>
		</section>
	</div>

	<script>
		//custom scripts here
		function changeTab(id) {
			switch (id) {
				case "orderDetailsOff":
					//change buttons
					document.getElementById("orderDetailsOn").style.display = "block";
					document.getElementById("orderDetailsOff").style.display = "none";

					document.getElementById("status&paymentDetailsOn").style.display = "none";
					document.getElementById("status&paymentDetailsOff").style.display = "block";

					//change displays
					document.getElementById("orderDetailsDiv").style.display = "flex";
					document.getElementById("status&paymentDetailsDiv").style.display = "none";
					break;
				case "status&paymentDetailsOff":
					//change buttons
					document.getElementById("orderDetailsOn").style.display = "none";
					document.getElementById("orderDetailsOff").style.display = "block";

					document.getElementById("status&paymentDetailsOn").style.display = "block";
					document.getElementById("status&paymentDetailsOff").style.display = "none";

					//change displays
					document.getElementById("orderDetailsDiv").style.display = "none";
					document.getElementById("status&paymentDetailsDiv").style.display = "flex";
					break;
			}
		}
	</script>
@endsection
