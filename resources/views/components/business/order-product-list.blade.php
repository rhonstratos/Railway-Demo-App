@foreach ($order->items as $item)
	<div class="flex flex-row gap-2 lg:gap-0 items-center capitalize">
		{{-- product image --}}
		<div class="basis-[75px] lg:basis-1/6 lg:flex flex-row justify-center items-center">
			<a class="glightbox" data-gallery="productSummary"
				href="{{ asset('/storage/' . $item->product->productId . '/file/' . $item->product->img_showcase . '/type/products') }}">
				<div class="flex justify-center items-center">
					<img class="object-cover w-[50px] h-[50px] rounded-[8px]"
						src="{{ asset('/storage/' . $item->product->productId . '/file/' . $item->product->img_showcase . '/type/products') }}"
						alt="image">
				</div>
			</a>
		</div>

		{{-- other data --}}
		<div class="lg:basis-5/6 grow lg:grow-0 flex flex-col lg:flex-row lg:justify-center lg:items-center gap-1 lg:gap-0">
			{{-- name --}}
			<span
				class="font-semibold lg:basis-1/5 w-[200px] sm:w-[300px] md:w-[400px] lg:w-[130px] xl:w-[150px] truncate lg:text-center">
				{{ $item->product->name }}
			</span>

			<div class="w-full lg:basis-3/5 flex flex-row justify-around items-center gap-2 lg:gap-0">
				{{-- first half --}}
				<div class="lg:basis-1/3 w-full flex flex-row gap-2 lg:justify-center">
					<span class="lg:hidden"><i class="fa-solid fa-warehouse"></i></span>
					<span>{{ $item->quantity }}</span>
				</div>
				<div class="lg:basis-1/3 w-full flex flex-col lg:flex-row gap-1">
					<div class="w-full flex flex-row gap-2 lg:justify-center">
						<span class="lg:hidden"><i class="fa-solid fa-cart-shopping"></i></span>
						<span class="">10</span>
					</div>
				</div>
				<div class="lg:basis-1/3 w-full flex flex-col lg:flex-row gap-1">
					<div class="w-full flex flex-row gap-2 lg:justify-center">
						<span class="lg:hidden"><i class="fa-solid fa-money-bills"></i></span>
						<span class="">Php {{ number_format((float) $item->product->price, 2, '.', ',') }}</span>
					</div>
				</div>
			</div>

			{{-- <button class=" lg:basis-1/5 h-[32px] px-3 bg-{{$site_settings->site_color_theme}} text-white rounded-[4px] shadow-lg truncate">
				Action
			</button> --}}
			<div class="w-[150px] lg:w-auto lg:basis-1/5 flex flex-row gap-2 lg:justify-center self-end font-semibold">
				<span class="lg:hidden">Subtotal:</span>
				<span>Php {{ number_format((float) $item->subtotal, 2, '.', ',') }}</span>
			</div>

			{{-- <div class="lg:basis-1/3 w-full flex flex-col lg:flex-row gap-1"> --}}
			@if (false)
				<div class="lg:basis-1/2 flex flex-row gap-2 lg:justify-center">
					<span class="flex lg:hidden items-center">Discount:</span>
					<span class="">Php 406.00</span>
				</div>
			@endif
			{{-- </div> --}}
		</div>
	</div>
@endforeach
