<div class="group box-2 hover:shadow-none flex-[1_1_30rem] p-[2rem] rounded-[.5rem]
					overflow-hidden relative transition-all duration-[.2s] ease-linear">
	<div class="icons absolute top-[.5rem] right-[-6rem] group-hover:right-[2rem] transition-all duration-[0.2s] ease-linear delay-[0s]">
		<a href="{{ route('customer.products.show', ['product' => $productId]) }}">
			<i
				class="cursor-pointer fa-solid fa-eye block h-[2rem] w-[2rem] leading-[2rem] text-[1.7rem] text-[#344767] bg-[#f2f2f2] rounded-[50%] mt-[.7rem] p-5 hover:text-{{ $site_settings->site_color_theme }} transition-all duration-[.2s] ease-linear">
			</i>
		</a>

		<form id="fav-{{ $productId }}" action="{{ route('customer.favorites.store') }}" method="post" onsubmit="addToFavorite(event,this.id);">
			@csrf
			<input type="hidden" name="product_id" value="{{ $productId }}" hidden class="hidden">
			<button type="submit">
				<i id="heart-{{ $productId }}"
					{{ $attributes->class([
					    'text-' . $site_settings->site_color_theme => $favorite,
					    'text-[#344767]' => !$favorite,
					    'cursor-pointer fa-solid fa-heart
																block h-[2rem] w-[2rem] leading-[2rem]
																text-[1.7rem] bg-[#f2f2f2] rounded-[50%]
																mt-[.7rem] p-5 hover:text-' .
					    $site_settings->site_color_theme .
					    '
																transition-all duration-[.2s] ease-linear',
					]) }}>
				</i>
			</button>
		</form>

		<form id="cart-{{ $productId }}" action="{{ route('customer.cart.store') }}" method="post">
			@csrf
			<input type="text" name="product" value="{{ $productId }}" class="hidden" readonly hidden>
			<input type="number" name="quantity" value="1" readonly hidden class="hidden">
			<button type="submit" href="{{ route('customer.cart.index') }}" value="cart">
				<i
					class="cursor-pointer fa-solid fa-cart-shopping
					block h-[2rem] w-[2rem] leading-[2rem] text-[1.7rem]
					text-[#344767] bg-[#f2f2f2] rounded-[50%]
					mt-[.7rem] p-5 hover:text-{{ $site_settings->site_color_theme }} transition-all
					duration-[.2s] ease-linear">
				</i>
			</button>
		</form>
	</div>

	{{-- <div class="w-max md:h-[50rem] h-[140px] rounded-[8px] overflow-hidden">
	<a href="#">
		<img class="p-8 rounded-t-lg w-full h-full object-cover"
			src="{{ asset('/storage/' . $productId . '/file/' . $imgShowcase . '/type/products') }}"
			alt="product image">
	</a>
	</div> --}}

	{{-- md:w-[200px] w-[120px] p-8 h-[120px] rounded-[8px] md:h-[200px] --}}

	<a href="#">
		<div class="w-[100%] p-8 aspect-square rounded-[8px] my-7 mx-auto bg-cover bg-center bg-no-repeat"
		style="background-image: url({{ asset('/storage/' . $productId . '/file/' . $imgShowcase . '/type/products') }})">
		</div>
	</a>

	<div class="px-5 pb-3 space-y-1">
		<div class="product-name tracking-tight leading-normal md:h-[4.8rem] h-[4rem] overflow-hidden text-[#344767] text-[1.3rem] md:text-[1.5rem] font-bold">
			@if (session()->get('errorId') == $productId)
				<div class="text-sm text-red-600">
					{{ $errors->first() }}
				</div>
			@endif
			<h5 class="capitalize">
				{{ $name }}
			</h5>
		</div>

		<div class="flex items-center mt-2.5 mb-5">
			<x-star-ratings :ratings="$productRatings" />
		</div>

		<div class="flex justify-between items-center">
			<d iv class="price text-[1.3rem] font-bold md:text-[1.5rem] text-[#344767] py-[.5rem] px-0">
				Php {{ number_format((float) $price, 2, '.', ',') }}
				@if (false)
					<span class="text-[1.1rem] text-[#999] font-medium"> 21 sold </span>
				@endif
			</d>
			{{-- <a href="#" class="text-[#fff] bg-{{$site_settings->site_color_theme}} hover:bg-[#d16868] font-medium rounded-lg text-[1.5rem] px-5 py-2.5 text-center transition-all duration-[.2s] ease-linear cursor-pointer">Buy Now</a> --}}
		</div>
	</div>

</div>
