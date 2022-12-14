@extends('layouts.customer')

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Order Details</title>
@endsection

@section('content')
	<section class="bg-[#F8F9FA] lg:py-[5rem] lg:px-[9%] py-[3rem] px-[2rem]">
		<h1 class="text-center mb-[2rem] relative">
			<span class="text-[3rem] py-[.5rem] px-[2rem] text-[#344767] font-extrabold">
				Checkout
			</span>
		</h1>

		<h3 class="text-[2rem] p-[.35em] font-bold text-gray-700 relative">
			Customer Details
		</h3>

		<div class="box-2 gap-[1.5rem] py-[2rem] px-8 mt-1rem mb-[5rem] hover:shadow-none overflow-x-auto relative">
			<div class="grid gap-6 mb-6 md:grid-cols-2 md:grid-flow-row">

				<div>
					<label for="firstName" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">First
						Name
					</label>
					<input type="text" name="firstName" value="{{ $user->firstname }}" readonly id="firstName"
						class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
						placeholder="Juan" required>
				</div>

				<div>
					<label for="lastName" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Last
						Name</label>
					<input type="text" name="lastName" id="lastName" value="{{ $user->lastname }}" readonly
						class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
						placeholder="Dela Cruz" required>
				</div>

				<div>
					<label for="contact" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Contact
						Number</label>
					<input type="text" name="contact" id="contact" value="{{ $user->contact }}" readonly
						class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
						placeholder="09912345678" required>
				</div>

				<div class="capitalize">
					<label for="address" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">
						Address</label>
					<input type="address" name="address" id="address" value="{{ $user->address ?? __('Undefined') }}" readonly
						class="bg-[#F2F2F2] capitalize border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
						placeholder="rectify@gmail.com" required>
				</div>

			</div>
		</div>

		<form action="{{ route('customer.checkout.store') }}" method="post">
			@csrf
			<!--responsive table-->
			<h3 class="text-[2rem] p-[.35em] font-bold text-gray-700 relative">
				Order Summary
			</h3>

			<div class="box hover:shadow-none overflow-x-auto relative">
				<table class="mobiletable border-collapse m-0 p-0 w-full table-fixed text-[1.3rem] text-gray-500">

					<thead class="text-[1.5rem] text-gray-700 md:static
								overflow-hidden absolute h-[1px]
								m-[1px] p-0 w-[1px]">
						<tr class="p-[.35em] border-b-[3px] border-transparent mb-[.625em]">
							<th scope="col" class="py-3 px-6 text-left">
								Product
							</th>
							<th scope="col" class="py-3 px-6">
								Quantity
							</th>
							<th scope="col" class="py-3 px-6">
								Subtotal
							</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($carts as $cart)
							<x-customer.checkout-product :$cart />
						@endforeach
					</tbody>

				</table>
			</div>
			<!--end responsive table-->

			<h3 class="text-[2rem] p-[.35em] font-bold text-gray-700 relative">
				Methods
			</h3>

			<div class="box-2 gap-[1.5rem] py-[2rem] px-8 mt-1rem mb-[5rem] hover:shadow-none overflow-x-auto relative">
				<div class="flex justify-between items-center pb-4 dark:bg-gray-900">
					<div class="relative">
						<h3 class="text-[1.5rem] font-bold text-gray-700 ">
							Pickup Location
						</h3>
					</div>
				</div>

				{{-- transfer methods --}}
				<ul class="grid gap-6 w-full md:grid-cols-3">
					{{-- pick-up --}}
					@if (Str::contains('pick-up', $shop->transfer_method))
						<li id="transfer_method-pick-up">
							<input type="radio" id="shop-pickup" name="transfer_method" value="pick-up" class="hidden peer">
							<label for="shop-pickup"
								class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer dark:hover:text-gray-300 peer-checked:border-{{ $site_settings->site_color_theme }} peer-checked:text-{{ $site_settings->site_color_theme }} hover:text-gray-600 hover:bg-gray-100 ">
								<div class="block">
									<div class="w-full text-[1.3rem] font-semibold">
										Shop Pickup
									</div>

									<div class="w-full ellipsis-overflow h-[2rem] overflow-hidden inline-block pt-[.5rem] text-[1.3rem] font-medium capitalize">
										<i class="fa-solid fa-location-dot h-[1.4rem] text-{{ $site_settings->site_color_theme }} mr-[8px]"></i>
										{{ $shop_address }}
									</div>
								</div>

								<svg aria-hidden="true" class="ml-3 w-9 h-9" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
								</svg>
							</label>
						</li>
					@endif
					{{-- meet-up --}}
					@if (Str::contains('meet-up', $shop->transfer_method))
						<li id="transfer_method-meet-up">
							<input type="radio" id="meetup" name="transfer_method" value="meet-up" class="hidden peer">
							<label for="meetup"
								class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer dark:hover:text-gray-300 peer-checked:border-{{ $site_settings->site_color_theme }} peer-checked:text-{{ $site_settings->site_color_theme }} hover:text-gray-600 hover:bg-gray-100 ">
								<div class="block">
									<div class="w-full text-[1.3rem] font-semibold">
										Set Meetup Location
									</div>
									<div class="w-full inline-block ellipsis-overflow h-[2rem] overflow-hidden pt-[.5rem] text-[1.3rem] font-medium">
										<i class="fa-solid fa-message h-[1.4rem] text-{{ $site_settings->site_color_theme }} mr-[8px]"></i>
										Message us to let us know your preferred location
									</div>
								</div>

								<svg aria-hidden="true" class="ml-3 w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
								</svg>
							</label>
						</li>
					@endif
					{{-- delivery --}}
					@if (Str::contains('delivery', $shop->transfer_method))
						<li id="transfer_method-delivery">
							<input type="radio" id="delivery" name="transfer_method" value="delivery" class="hidden peer">
							<label for="delivery"
								class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer dark:hover:text-gray-300 peer-checked:border-{{ $site_settings->site_color_theme }} peer-checked:text-{{ $site_settings->site_color_theme }} hover:text-gray-600 hover:bg-gray-100 ">
								<div class="block">
									<div class="w-full ellipsis-overflow h-[2rem] overflow-hidden text-[1.3rem] font-semibold">
										Retrieve through Delivery
									</div>

									<div class="w-full inline-block pt-[.5rem] text-[1.3rem] font-medium">
										<i class="fa-solid fa-truck h-[1.4rem] text-{{ $site_settings->site_color_theme }} mr-[8px]"></i>
										We deliver via {{ collect(['Lalamove', 'etc.'])->implode(', ') }}
										{{-- to be changed via shop settings --}}
									</div>
								</div>

								<svg aria-hidden="true" class="ml-3 w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
								</svg>
							</label>
						</li>
					@endif
				</ul>

				<div class="flex justify-between items-center mt-4 pb-4 dark:bg-gray-900">
					<div class="relative">
						<h3 class="text-[1.5rem] font-bold text-gray-700 ">
							Preferred Payment Method
						</h3>
					</div>
				</div>

				{{-- payment methods --}}
				<ul class="grid gap-6 w-full md:grid-cols-3">
					{{-- cash payment --}}
					@if (Str::contains('cash', $shop->payment_method))
						<li id="payment_method-cash">
							<input type="radio" id="cash" name="payment_method" value="cash" class="hidden peer">
							<label for="cash"
								class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer dark:hover:text-gray-300 peer-checked:border-{{ $site_settings->site_color_theme }} peer-checked:text-{{ $site_settings->site_color_theme }} hover:text-gray-600 hover:bg-gray-100 ">
								<div class="block">
									<div class="w-full text-[1.3rem] font-semibold">
										Cash on hand
									</div>
									<div class="w-full inline-block ellipsis-overflow h-[2rem] overflow-hidden pt-[.5rem] text-[1.3rem] font-medium">
										<i class="fa-solid fa-wallet h-[1.4rem] text-{{ $site_settings->site_color_theme }} mr-[8px]"></i>
										Pay cash after pickup / meetup
									</div>
								</div>
								<svg aria-hidden="true" class="ml-3 w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
								</svg>
							</label>
						</li>
					@endif

					{{-- online payment --}}
					@if (Str::contains('online', $shop->payment_method))
						<li id="payment_method-online">
							<input type="radio" id="gcash" name="payment_method" value="online" class="hidden peer">
							<label for="gcash"
								class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-lg border border-gray-200 cursor-pointer dark:hover:text-gray-300 peer-checked:border-{{ $site_settings->site_color_theme }} peer-checked:text-{{ $site_settings->site_color_theme }} hover:text-gray-600 hover:bg-gray-100 ">
								<div class="block">
									<div class="w-full text-[1.3rem] font-semibold">
										Online transaction
									</div>
									<div class="w-full inline-block ellipsis-overflow h-[2rem] overflow-hidden pt-[.5rem] text-[1.3rem] font-medium">
										<i class="fa-solid fa-mobile h-[1.4rem] text-{{ $site_settings->site_color_theme }} mr-[8px]"></i>
										Pay via GCash, or to any available method channels
									</div>
								</div>
								<svg aria-hidden="true" class="ml-3 w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
								</svg>
							</label>
						</li>
					@endif
				</ul>
			</div>

			<div class="total-price flex items-end flex-col mt-[2rem]">
				<table class="mobiletable border-t-[3px] border-{{ $site_settings->site_color_theme }} border-solid w-[100%] max-w-[35rem] text-gray-500 text-[1.3rem]">
					<tr>
						<td class="py-[1rem] px-[0.5rem] last:text-right">
							Total
						</td>
						<td class="py-[1rem] px-[0.5rem] last:text-right">
							Php {{ number_format((float) array_sum(Arr::map($carts->toArray(), fn($v) => $v['subtotal'])), 2, '.', ',') }}
						</td>
					</tr>
				</table>

				<button type="submit" class="my-[1rem] inline-block py-[.9rem] px-[3rem] rounded-[.5rem]
						text-[#fff] text-[1.3rem] cursor-pointer font-[500]
						button-shade">
					<i class="fas fa-wallet mr-[8px]"></i>
					Place Order
				</button>
			</div>
		</form>
	</section>

	<script>
		$(() => {
			$('.minus').click(function() {
				var $input = $(this).parent().find('input');
				var count = parseInt($input.val()) - 1;
				count = count < 1 ? 1 : count;
				$input.val(count);
				$input.change();
				return false;
			});
			$('.plus').click(function() {
				var $input = $(this).parent().find('input');
				$input.val(parseInt($input.val()) + 1);
				$input.change();
				return false;
			});
		});
	</script>
@endsection
