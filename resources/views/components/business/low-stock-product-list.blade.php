@props(['product'])
<li class="cursor-pointer" onclick="location.href='{{ route('business.products.edit', ['product' => $product->productId]) }}'">
	<div class="{{-- h-[130px] --}}max-h-[130px] p-2 flex flex-row gap-2 justify-end items-center bg-transparent shadow-none rounded-[8px]">

		<div class="basis-[50px] flex justify-center items-center">
			{{-- product image --}}
			<img class="object-cover w-[50px] h-[50px] rounded-[4px]" src="{{ asset('/storage/' . $product->productId . '/file/' . $product->img_showcase . '/type/products') }}" alt="img">
		</div>

		<div class="basis-2/3 flex flex-row gap-0 grow">
			<div class="basis-1/2 flex flex-row justify-center text-center items-center font-bold">
				{{-- Product name --}}
				<span class="w-[150px] sm:w-[250px] md:w-[300px] lg:w-[350px] 2xl:w-[400px] truncate">
					{{ $product->name }}
				</span>
			</div>

			<div class="basis-1/2 max-h-[62px] flex flex-row justify-center items-center gap-1">
				<span class="sm:hidden">Stock:</span>
				<span>{{ $product->quantity }}</span>
				{{-- <span class="text-status-red">Sold Out</span> --}}
				{{-- <span class="text-status-red">Out of stock</span> --}}
			</div>
		</div>
	</div>
</li>
