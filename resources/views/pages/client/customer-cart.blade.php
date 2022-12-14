@extends('layouts.customer')

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Shopping Cart</title>
@endsection

@section('content')
	<section class="bg-[#F8F9FA] lg:pt-[5rem] lg:px-[9%] py-[3rem] px-[2rem]">
		<h1 class="text-center mb-[4rem] relative">
			<span class="text-[3rem] pt-[.5rem] pb-[1rem] px-[2rem] text-[#344767] font-extrabold">
				Shopping Cart
			</span>
		</h1>
		@if ($cart->count() < 1)
			<x-customer.empty-section :asset="asset('assets/Rectify/customer-home/empty-shopcart.png')" header="Oops! Your cart is empty" paragraph1="Looks like you haven't added" paragraph2="anything in your cart yet" divclass="" imgclass=" w-[30rem] my-[3rem]"
				buttonclass=" my-[1rem] ml-5 py-[.7rem] px-[7rem]" />
		@else
			<!--responsive table-->
			<div class="box hover:shadow-none overflow-x-auto relative">
				<table class="mobiletable border-collapse m-0 p-0 w-full table-fixed text-[1.3rem] text-gray-500">
					<thead class="text-[1.5rem] text-gray-700 md:static
					overflow-hidden absolute h-[1px] m-[1px] p-0 w-[1px]">
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
							<th scope="col" class="py-3 px-6">

							</th>
						</tr>
					</thead>

					<tbody>
						@forelse ($cart as $item)
							<tr class="hover:bg-gray-50">

								<td onclick="location.href='{{ route('customer.products.show', $item->product->productId) }}'" data-label="Product" class="py-4 px-6">
									<div class="flex md:items-center items-start justify-end md:justify-start">
										<img class="h-[5rem] w-[5rem] rounded-md" src="{{ asset('/storage/' . $item->product->productId . '/file/' . $item->product->img_showcase . '/type/products') }}" alt="Product Image">
										<div class="pl-3">
											<div class="ellipsis-overflow overflow-hidden md:w-[30rem] w-[20rem] text-[1.3rem] font-semibold">
												{{ $item->product->name }}
											</div>
											<div class="text-[1rem] font-normal mt-2 text-gray-500">
												Stock:
												<span class="text-{{ $site_settings->site_color_theme }}">
													{{ $item->product->currentInventory()->quantity }} left
												</span>
											</div>
										</div>
									</div>
								</td>

								<td data-label="Quantity" class="py-4 px-6">
									<div class="flex items-center justify-end md:justify-center">
										<div class="number flex items-center space-x-3">
											<span data-value="{{ $item->product->productId }}"
												class="cursor-pointer minus w-8 h-8 text-center inline-flex items-center p-1 text-[1.3rem] font-medium text-gray-500 bg-white rounded-full border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
												<svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
												</svg>
											</span>

											<input type="number" id="cart-id-{{ $item->id }}-quantity" name="cart_quantity[]"
												class="bg-gray-50 w-14 border border-gray-300 text-gray-900
											text-[1rem] text-center rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }}
											block px-2.5 py-1
											cart-item"
												readonly value="{{ $item->quantity }}" />

											<span data-value="{{ $item->product->productId }}"
												class="cursor-pointer plus w-8 h-8 text-center inline-flex items-center p-1 text-[1.3rem] font-medium text-gray-500 bg-white rounded-full border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
												<svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
													<path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd">
													</path>
												</svg>
											</span>
										</div>
									</div>
								</td>

								<td id="subtotal-{{ $item->product->productId }}" data-label="Subtotal" class="py-4 px-6 md:text-center">
									Php <span class="cart_quantity">{{ number_format((float) $item->subtotal, 2, '.', ',') }}</span>
								</td>

								<td data-label="Action" class="py-4 px-6 md:text-center text-right mb-[5rem]">
									<form action="{{ route('customer.cart.destroy', $item->id) }}" method="post">
										@csrf
										@method('DELETE')
										<button type="submit" name="action" value="delete" class=" inline-block py-[.5rem] px-[3rem] rounded-[.5rem] text-[#fff]
											button-shade font-medium cursor-pointer ">
											<i class="fas fa-trash mr-[8px]"></i>
											Delete
										</button>
									</form>
								</td>

							</tr>
						@empty
							<tr class="m-auto text-center">
								<td colspan="4">
									<div>
										<h2>You have an empty cart!</h2>
									</div>
								</td>
							</tr>
						@endforelse

					</tbody>
				</table>
			</div>

			@if (!empty($cart))
				<div class="total-price flex items-end flex-col mt-[2rem]">
					<table class="mobiletable border-t-[3px] border-{{ $site_settings->site_color_theme }} border-solid w-[100%] max-w-[35rem] text-gray-500 text-[1.3rem]">
						{{--
						<tr>
							<td class="py-[1rem] px-[0.5rem] last:text-right">
								Subtotal
							</td>
							<td class="py-[1rem] px-[0.5rem] last:text-right">
								Php 250
							</td>
						</tr>
						<tr>

							<td class="py-[1rem] px-[0.5rem] last:text-right">
								Discount
							</td>

							<td class="py-[1rem] px-[0.5rem] last:text-right">
								- Php 50
							</td>

						</tr>
						--}}
						<tr>
							<td class="py-[1rem] px-[0.5rem] last:text-right">
								Total
							</td>
							<td class="py-[1rem] px-[0.5rem] last:text-right">
								Php <span id="cart_total">{{ number_format((float) $total, 2, '.', ',') }}</span>
							</td>
						</tr>
					</table>

					<button type="button" onclick="location.href='{{ route('customer.checkout.index') }}'"
						class="my-[1rem] inline-block py-[.9rem] px-[3rem] rounded-[.5rem]
								text-[#fff] button-shade text-[1.3rem] cursor-pointer font-[500]
								">
						<i class="fas fa-wallet mr-[8px]"></i>
						Proceed to Checkout
					</button>
				</div>
			@endif
		@endif
	</section>

	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		var _oldTotal = 0;
		const _cartQuantityURL = '{{ route('customer.carts.quantity') }}'
		const _formatOpt = {
			minimumFractionDigits: 2
		};
		const editItemQuantityDcr = (el, count, prodId) => {
			$.post(_cartQuantityURL, {
					_method: 'PATCH',
					action: 'dcr',
					productId: prodId,
					quantity: parseInt(el.val())
				})
				.done((data) => {
					if (!data['fail']) {
						el.val(data['qty']);
						el.change();
						$('#subtotal-' + prodId).html('Php ' + `<span class="cart_quantity">${parseFloat(data['subtotal']).toLocaleString('en-US', _formatOpt)}</span>`)
						$(() => sumTotal())
					}
				})
				.fail((xhr, status, error) => {

				})
		};
		const editItemQuantityIcr = (el, prodId) => {
			$.post(_cartQuantityURL, {
					_method: 'PATCH',
					action: 'icr',
					productId: prodId,
					quantity: parseInt(el.val())
				})
				.done((data) => {
					if (!data['fail']) {
						el.val(data['qty']);
						el.change();
						$('#subtotal-' + prodId).html('Php ' + `<span class="cart_quantity">${parseFloat(data['subtotal']).toLocaleString('en-US', _formatOpt)}</span>`)
						$(() => sumTotal())
					}
				})
				.fail((xhr, status, error) => {

				})
		};
		const sumTotal = () => {
			var _newTotal = 0;
			$('.cart_quantity').each(function() {
				_newTotal += parseFloat(String($(this).text()).replace(',', ''))
			})
			if (parseFloat(_newTotal) != parseFloat(_oldTotal)) {
				$('#cart_total').html(_newTotal.toLocaleString('en-US', _formatOpt))
				_oldTotal = _newTotal
			}
		};
		$(() => {
			$('.minus').click(function() {
				let _input = $(this).parent().find('input');
				let count = parseInt(_input.val()) - 1;
				count = count < 1 ? 1 : count;
				editItemQuantityDcr(_input, count, $(this).data('value'))
			});
			$('.plus').click(function() {
				let _input = $(this).parent().find('input');
				editItemQuantityIcr(_input, $(this).data('value'))
			});
			_oldTotal = {{ (float) $total }}
		});
	</script>
@endsection
