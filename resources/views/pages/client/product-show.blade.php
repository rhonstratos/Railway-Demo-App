@extends('layouts.customer')

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Product Details</title>
@endsection

@section('content')
	<section class="bg-[#F8F9FA] md:py-[5rem] md:px-[9%] py-[3rem] px-[2rem]">

		<div class="box bg-[#fff] flex items-center justify-center">
			<div class="grid gap-6 mb-6 md:grid-cols-2 md:grid-flow-col md:grid-rows-7">
				<div class="row-span-7 p-[3rem]">
					<div class="image-gallery my-0 table mx-auto">
						<aside class="thumbnails table-cell pr-[1rem]">
							<a href="#"class="thumbnail selected"
								data-big="{{ asset('/storage/' . $product->productId . '/file/' . $product->img_showcase . '/type/products') }}">
								<div
									class="thumbnail-image md:w-[100px] w-[50px] h-[50px] md:h-[100px] my-auto mx-auto bg-cover bg-center bg-no-repeat border-[4px] border-solid border-transparent"
									style="background-image: url({{ asset('/storage/' . $product->productId . '/file/' . $product->img_showcase . '/type/products') }})">
								</div>
							</a>
							@foreach ($product->img as $img)
								<a href="#" class="thumbnail"
									data-big="{{ asset('/storage/' . $product->productId . '/file/' . $img . '/type/products') }}">
									<div
										class="thumbnail-image md:w-[100px] w-[50px] h-[50px] md:h-[100px] my-auto mx-auto bg-cover bg-center bg-no-repeat border-[4px] border-solid border-transparent"
										style="background-image: url({{ asset('/storage/' . $product->productId . '/file/' . $img . '/type/products') }})">
									</div>
								</a>
							@endforeach
						</aside>

						<main
							class="primary table-cell md:w-[400px] w-[200px] h-[200px] md:h-[400px] bg-[#cccccc] bg-cover bg-center bg-no-repeat"
							style="background-image: url({{ asset('/storage/' . $product->productId . '/file/' . $product->img_showcase . '/type/products') }});">
						</main>
					</div>

				</div>

				<div class="product-div-right p-[3rem] ">
					<span class=" product-name text-[#344767] block text-[2rem] font-bold tracking-[1px] capitalize">
						{{ $product->name }}
					</span>

					<div class="flex items-center mt-2.5 mb-5">
						<x-star-ratings :ratings="$product->avg_ratings" />
					</div>

					<div class="price text-[1.5rem] font-bold md:text-[2rem] text-[#344767] py-[.5rem] px-0 mb-2">
						Php {{ number_format((float) $product->price, 2, '.', ',') }}
						@if (false)
							<span class="text-[1.3rem] text-[#999] font-medium">
								21 sold
							</span>
						@endif
					</div>

					@if (false)
						<label for="variation" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-400">
							Variation
						</label>
						<select id="variation" name="variation"
							class="block p-3 mb-6 w-[20rem] text-gray-900 bg-[#F2F2F2] rounded-lg border-none focus:ring-{{$site_settings->site_color_theme}}
                            focus:ring-1 focus:outline-none font-medium text-[1.3rem] items-center">
							<option selected disabled value="">Select Variation</option>
							<option value="">Black</option>
							<option value="">White</option>
							<option value="">Blue</option>
							<option value="">Green</option>
							<option value="">Red</option>
						</select>
					@endif
					<p class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-400">
						Quantity
					</p>
					<div class="number flex items-center space-x-3 mb-2">
						<span
							class="cursor-pointer minus w-8 h-8 text-center inline-flex items-center p-1 text-[1.3rem] font-medium
									text-gray-500 bg-white rounded-full border border-gray-300 focus:outline-none hover:bg-gray-100
									focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600
									dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
							<svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
								xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
							</svg>
						</span>
						<form id="form-product" action="" method="post" class="my-auto">
							@csrf
							<input type="text" name="product" value="{{ $product->productId }}" class="hidden" readonly hidden>
							<input id="quantity" name="quantity" type="number"
								class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-[1rem] text-center rounded-lg
										focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}} block px-2.5 py-1
										"
								value="1" />
						</form>
						<span
							class="cursor-pointer plus w-8 h-8 text-center inline-flex items-center p-1 text-[1.3rem] font-medium
										text-gray-500 bg-white rounded-full border border-gray-300 focus:outline-none hover:bg-gray-100
										focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600
										dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
							<svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
								xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd"
									d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd">
								</path>
							</svg>
						</span>
					</div>

					<div class="text-[1.3rem] text-[#333] py-[.5rem] px-0">
						Stock:
						<span class="text-[1.3rem] text-{{$site_settings->site_color_theme}}">
							Only {{ number_format((int) $product->currentInventory()->quantity) }} items left
						</span>
					</div>

					<div class="btn-groups mt-3">
						<button type="button" onclick="formSubmit('cart')" value="cart"
							class="my-[1rem] font-semibold inline-block py-[.9rem] px-[3rem] rounded-[.5rem]
									text-[#fff] button-shade text-[1.5rem] cursor-pointer
									{{-- hover:border-[#d16868] --}} border-solid  border-{{$site_settings->site_color_theme}} border-2">
							<i class="fas fa-shopping-cart mr-[8px]"></i>
							Add To Cart
						</button>
						<button type="button" onclick="formSubmit('checkout')" value="checkout"
							class="my-[1rem] ml-7 font-semibold inline-block py-[.9rem] px-[3rem] rounded-[.5rem]
									text-{{$site_settings->site_color_theme}} hover:text-[#fff] bg-[#fff] text-[1.5rem] cursor-pointer
									hover:bg-{{$site_settings->site_color_theme}} border-solid border-{{$site_settings->site_color_theme}} border-2">
							<i class="fas fa-wallet mr-[8px]"></i>
							Buy Now
						</button>
					</div>
				</div>

			</div>
		</div>

		<div class="box-2 py-[2rem] px-8 mt-1rem mb-[5rem] bg-[#fff]">
			{{-- product specs --}}
			<table class="w-full text-left text-gray-500 dark:text-gray-400">
				<thead class="text-gray-700 text-[1.5rem] font-bold text-left ">
					<tr>
						<th scope="col" class="py-5 px-6">
							Product Specifications
						</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($product->details['speficications'] as $key => $specs)
						<tr class="mb-3 text-gray-500 text-[1.3rem]">
							<td class="py-2 px-6 normal-case">
								{{ $key . ': ' . $specs }}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			{{-- product description --}}
			<table class="w-full text-left text-gray-500">
				<thead class="text-gray-700 text-[1.5rem] font-bold text-left ">
					<tr>
						<th scope="col" class="py-5 px-6">
							Product Description
						</th>
					</tr>
				</thead>
				<tbody>
					<tr class="mb-3 text-gray-500 leading-[1.6] text-[1.3rem]">
						<td class="py-2 px-6 normal-case">
							{!! Str::of($product->description)->markdown() !!}
						</td>
					</tr>
				</tbody>
			</table>

		</div>

		<div id="product-ratings-board" class="mb-[5rem]">
			<div class="flex items-center mb-3">
				<p class="ml-2 mr-2 text-[1.3rem] font-medium text-gray-900 dark:text-white">
					<span class="font-semibold">{{ (float) $product->avg_ratings }}</span> out of 5
				</p>
				<x-star-ratings :ratings="$product->avg_ratings" :hidden="true" />
			</div>
			@if (false)
				<div>
					<p class="text-[1.3rem] font-medium text-gray-500 dark:text-gray-400">
						1,745 global ratings
					</p>
				</div>
			@endif
			<div>
				<div class="flex items-center mt-4">
					<span class="text-[1.3rem] font-medium text-{{$site_settings->site_color_theme}}">5 star</span>
					<div class="mx-4 w-2/4 h-5 bg-gray-200 rounded dark:bg-gray-700">
						<div class="h-5 bg-{{$site_settings->site_color_theme}} rounded" style="width: {{ $review_stars_stats[5] }}%"></div>
					</div>
					<span class="text-[1.3rem] font-medium text-{{$site_settings->site_color_theme}}">{{ $review_stars_stats[5] }}%</span>
				</div>
				<div class="flex items-center mt-4">
					<span class="text-[1.3rem] font-medium text-{{$site_settings->site_color_theme}}">4 star</span>
					<div class="mx-4 w-2/4 h-5 bg-gray-200 rounded dark:bg-gray-700">
						<div class="h-5 bg-{{$site_settings->site_color_theme}} rounded" style="width: {{ $review_stars_stats[4] }}%"></div>
					</div>
					<span class="text-[1.3rem] font-medium text-{{$site_settings->site_color_theme}}">{{ $review_stars_stats[4] }}%</span>
				</div>
				<div class="flex items-center mt-4">
					<span class="text-[1.3rem] font-medium text-{{$site_settings->site_color_theme}}">3 star</span>
					<div class="mx-4 w-2/4 h-5 bg-gray-200 rounded dark:bg-gray-700">
						<div class="h-5 bg-{{$site_settings->site_color_theme}} rounded" style="width: {{ $review_stars_stats[3] }}%"></div>
					</div>
					<span class="text-[1.3rem] font-medium text-{{$site_settings->site_color_theme}}">{{ $review_stars_stats[3] }}%</span>
				</div>
				<div class="flex items-center mt-4">
					<span class="text-[1.3rem] font-medium text-{{$site_settings->site_color_theme}}">2 star</span>
					<div class="mx-4 w-2/4 h-5 bg-gray-200 rounded dark:bg-gray-700">
						<div class="h-5 bg-{{$site_settings->site_color_theme}} rounded" style="width: {{ $review_stars_stats[2] }}%"></div>
					</div>
					<span class="text-[1.3rem] font-medium text-{{$site_settings->site_color_theme}}">{{ $review_stars_stats[2] }}%</span>
				</div>
				<div class="flex items-center mt-4">
					<span class="text-[1.3rem] font-medium text-{{$site_settings->site_color_theme}}">1 star</span>
					<div class="mx-4 w-2/4 h-5 bg-gray-200 rounded dark:bg-gray-700">
						<div class="h-5 bg-{{$site_settings->site_color_theme}} rounded" style="width: {{ $review_stars_stats[1] }}%"></div>
					</div>
					<span class="text-[1.3rem] font-medium text-{{$site_settings->site_color_theme}}">{{ $review_stars_stats[1] }}%</span>
				</div>
			</div>
		</div>

		<div id="product-ratings-customers" class="box bg-[#fff] flex items-center">
			<table class="w-full text-left text-gray-500 dark:text-gray-400">
				<thead class="text-gray-700 text-[1.5rem] font-bold text-left ">
					<tr>
						<th scope="col" class="py-3 px-6">
							Product Reviews
						</th>
					</tr>
				</thead>

				<tbody>
					@forelse ($reviews as $review)
						<x-customer.product-review-list :data="$review" />
					@empty
						<tr>
							<td colspan="1">
								<div class="text-center m-auto p-auto">
									<div class="grid flex-wrap justify-center grid-cols-1 text-center ">
										<div class="h-[15rem]">
											<h3 class="text-[1.5rem] mt-[5rem] my-[1rem] font-semibold text-{{$site_settings->site_color_theme}}">There aren't any reviews for this
												product yet</h3>
											<p class="text-[1.3rem] leading-normal my-[1rem] font-semibold text-[#959596]">Help our shop by sharing your
												experience.
											</p>
										</div>
									</div>
								</div>
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</section>

	<script>
		const url_cart = '{{ route('customer.cart.store') }}'
		const url_checkout = '{{ route('customer.checkout.store') }}'
		const url_insta_checkout = '{{ route('customer.carts.instant') }}'
		const formSubmit = (val) => {
			console.log(val)
			if (val == 'cart') {
				$('#form-product').attr('action', url_cart)
			} else if (val == 'checkout') {
				$('#form-product').attr('action', url_insta_checkout)
			}
			$(() => $('#form-product').submit())
		};
		$(() => {
			$('.minus').click(function() {
				var $input = $('#quantity')
				var count = parseInt($input.val()) - 1;
				count = count < 1 ? 1 : count;
				$input.val(count);
				$input.change();
				return false;
			});
			$('.plus').click(function() {
				var $input = $('#quantity')
				$input.val(parseInt($input.val()) + 1);
				$input.change();
				return false;
			});


			$('.thumbnail').on('click', function() {
				var clicked = $(this);
				var newSelection = clicked.data('big');
				var $img = $('.primary').css("background-image", "url(" + newSelection + ")");
				clicked.parent().find('.thumbnail').removeClass('selected');
				clicked.addClass('selected');
				$('.primary').empty().append($img.hide().fadeIn('slow'));
			});
		});
	</script>
@endsection
