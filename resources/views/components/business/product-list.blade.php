@forelse ($products as $prod)
	<li class="my-2 first:mt-0 last:mb-0 sm:border-b-[1px]">
		<div class="{{-- h-[130px] --}}max-h-[130px] p-2 flex flex-row gap-2 sm:gap-0 justify-between sm:justify-end items-center bg-white sm:bg-transparent shadow-lg sm:shadow-none rounded-[8px]">

			<div class="basis-[50px] sm:basis-[14.2%] sm:flex sm:justify-center sm:items-center">
				{{-- product image --}}
				<img class="object-cover w-[50px] h-[50px] rounded-[4px]" src="{{ asset('/storage/' . $prod->productId . '/file/' . $prod->img_showcase . '/type/products') }}" alt="{{ $prod->img_showcase }}">
			</div>

			<div class="sm:basis-[85.2%] flex flex-col sm:flex-row gap-1 sm:gap-0 grow">
				<div class="sm:basis-1/6 flex flex-row sm:justify-center sm:text-center items-center font-bold">
					{{-- Product name --}}
					<span class="w-[200px] sm:max-w-[75px] lg:max-w-[130px] 2xl:max-w-[200px] truncate">{{ Str::title($prod->name) }}</span>
				</div>

				<div class="{{-- h-[62px] --}}sm:basis-4/6 max-h-[62px] flex flex-row gap-1 sm:gap-0 justify-between text-center">
					{{-- <div class="basis-1/4 flex flex-col gap-1">
						@for ($i = 0; $i < 3; $i++)
						<span>
							variation
						</span>
						@endfor
					</div> --}}
					<div class="basis-1/4 flex flex-row justify-center items-center gap-1">
						{{-- price --}}
						<span>&#8369; {{ number_format((float) $prod->price, 2, '.', ',') }}</span>
					</div>

					<div class="basis-1/4 flex flex-row justify-center items-center gap-1">
						<span class="sm:hidden">Stock:</span>
						<span>{{ $prod->currentInventory()->quantity }}</span>
						{{-- <span class="text-status-red">Sold Out</span> --}}
						{{-- <span class="text-status-red">Out of stock</span> --}}
					</div>

					<div class="basis-1/4 flex flex-row justify-center items-center gap-1">
						<span class="sm:hidden">Sales:</span>
						<span>{{ array_sum(Arr::map($prod->orderedItems->toArray(), fn($v) => $v['quantity'])) }}</span>
					</div>

					<div class="basis-1/4">
						<button class="w-full sm:w-fit h-full px-3 py-1 sm:bg-status-bluegreen text-status-bluegreen sm:text-white rounded-[4px]" onclick="location.href='{{ route('business.products.edit', ['product' => $prod->productId]) }}'">
							<i class="fa-solid fa-pen-to-square"></i>
							<span>Edit</span>
						</button>
					</div>
				</div>

				<div class="sm:basis-1/6 flex justify-center items-center">
					<button class="w-full sm:w-fit h-full px-3 py-1 bg-{{ $site_settings->site_color_theme }} text-white rounded-[4px]" onclick="location.href='{{ route('business.products.reviews.index', $prod->productId) }}'">
						<span>Reviews</span>
					</button>
				</div>
			</div>
		</div>
	</li>
@empty
	<li class="">
		<div class="flex justify-center items-center">
			No products yet
		</div>
	</li>
@endforelse
