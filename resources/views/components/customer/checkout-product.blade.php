<tr class="hover:bg-gray-50">

	<td data-label="Product" class="py-4 px-6">
		<div class="flex md:items-center items-start justify-end md:justify-start">

			<img src="{{ asset('/storage/' . $cart->product->productId . '/file/' . $cart->product->img_showcase . '/type/products') }}" class="h-[5rem] w-[5rem] rounded-md" alt="Product Image">

			<div class="pl-3">
				<div class="ellipsis-overflow overflow-hidden md:w-[40rem] w-[20rem] text-[1.3rem] font-semibold">
					{{ $cart->product->name }}
				</div>
				<div class="text-[1rem] font-normal mt-2 text-gray-500">
					Stock:
					<span class="text-{{ $site_settings->site_color_theme }}">
						{{ $cart->product->currentInventory()->quantity }} left
					</span>
				</div>
			</div>

		</div>
	</td>

	<td data-label="Quantity" class="py-4 px-6">
		<div class="flex items-center justify-end md:justify-center">

			<div class="number flex items-center space-x-3">
				<input type="text" name="productId[{{ $cart->product->productId }}]" value="{{ $cart->product->productId }}" hidden class="hidden">
				<input type="number" name="quantity[{{ $cart->product->productId }}]"
					class="bg-gray-50 w-14 border border-gray-300 text-gray-900
							text-[1rem] text-center rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }}
							block px-2.5 py-1
							cart-item"
					readonly value="{{ $cart->quantity }}" />
				<input type="number" name="subtotal[{{ $cart->product->productId }}]" value="{{ $cart->subtotal }}" hidden class="hidden">
			</div>

		</div>
	</td>

	<td data-label="Subtotal" class="py-4 px-6 md:text-center">
		Php {{ number_format((float) $cart->subtotal, 2, '.', ',') }}
	</td>
</tr>
