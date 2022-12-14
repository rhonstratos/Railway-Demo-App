@extends('layouts.customer')

@section('title')
	{{-- remind rhon na dynamic ang title neto --}}
	{{-- na dadagdag sa dulo yung name ng product --}}
	<title>{{ Str::title(config('app.name')) }} - Products</title>
@endsection

@section('content')
	{{-- product section starts  --}}
	<section class="bg-[#F8F9FA] lg:py-[5rem] lg:px-[9%] py-[3rem] px-[2rem]">
		<!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
		<h1 class="text-center mb-[2rem] relative">
			<span class="text-[3rem] py-[.5rem] px-[2rem] text-[#344767] font-extrabold">
				Products
			</span>
		</h1>

		<div class="grid grid-cols-2 items-center pb-4 ">
			<div id="search-products" class="flex">
				<form action="{{ route('customer.products.search') }}" class="relative" id="search-products" method="post">
					@csrf
					<label for="product-search" class="sr-only">
						Search
					</label>
					<div class="relative">
						<div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
							<svg aria-hidden="true" class="w-6 h-6 text-gray-500 " fill="none" stroke="currentColor" viewBox="0 0 24 24"
								xmlns="http://www.w3.org/2000/svg">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
									d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
							</svg>
						</div>
						<input type="text" id="product-search-users" name="search"
							class="bg-[#fff] block p-4 pl-12 w-[35rem] text-[1.3rem] text-gray-900 rounded-lg border border-transparent focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}}"
							placeholder="Are you looking for something?" required>
						<button type="submit"
							class="text-white absolute text-[1.3rem] right-2.5 bottom-2.5 button-shade font-medium rounded-lg leading-[1.25rem] px-4 py-2">
							Search
						</button>
					</div>
				</form>
			</div>

			<div class="flex items-center justify-end my-5">

				{{-- <button onclick="openModal()" class="flex items-center">
                    <i
                        class="fa-solid fa-filter rounded-lg p-4 ml-5 bg-{{$site_settings->site_color_theme}} text-[#fff] hover:bg-[#d16868] cursor-pointer text-[1.3rem]"></i>
                </button> --}}

				<button onclick="openModal()"
					class="mr-2 inline-flex items-center text-[#fff] button-shade border-0
						font-medium rounded-lg text-[1.3rem] px-4 py-3"
					type="button">
					<i class="fa-solid fa-folder-tree md:mr-3 w-5 h-5 mx-2 my-2"></i>
					<span class="md:inline hidden font-medium">
						Advance Search
					</span>
				</button>
			</div>

		</div>
		@if (isset($filterCount) && $filterCount < 1)
			<x-customer.empty-section :asset="asset('assets/Rectify/customer-home/filter-result.png')" header="Your filters produced no result"
				paragraph1="Try adjusting your filters to" paragraph2="display better results" divclass=""
				imgclass=" w-[20rem] my-[3rem]" buttonclass=" my-[1rem] ml-5 py-[.7rem] px-[7rem]" />
		@elseif ($products->count() < 1)
			<x-customer.empty-section :asset="asset('assets/Rectify/customer-home/empty-shopcart.png')" header="There are no products yet" paragraph1="When there are, you'll see"
				paragraph2="them here next time" :route="route('customer.home.index')" buttontext="Go Back to Home" divclass=""
				imgclass=" w-[30rem] my-[3rem]" buttonclass="my-[1rem] ml-5 py-[.7rem] px-[3em]" />
		@else
			<div class="box-container flex-wrap gap-[1.5rem] grid xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-3 grid-cols-2">
				{{-- box --}}
				@foreach ($products as $item)
					<x-customer.product-card :favorite="false" :product-ratings="$item->avg_ratings" :product-id="$item->productId" :name="$item->name" :price="$item->price"
						:img-showcase="$item->img_showcase" />
				@endforeach
			</div>
			{{-- pagination buttons --}}
			<x-customer.paginate-buttons :data="$products" />
		@endif
	</section>

	{{-- advance search --}}
	<div class="dialog">
		<div class="dialog__body">
			<div class="dialog__header">
				<h3 class="text-[2rem] font-bold text-gray-70">
					Search Filter
				</h3>

				<button type="reset" class="dialog__close" onclick="closeModal()">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
						stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<line x1="18" y1="6" x2="6" y2="18"></line>
						<line x1="6" y1="6" x2="18" y2="18"></line>
					</svg>
				</button>
			</div>

			<form action="{{ route('customer.products.advance.search') }}" method="post" class="dialog__content">
				@csrf
				<div id="search-products" class="flex mb-4">
					<div class="relative" id="search-products" method="post">
						<label for="product-search" class="sr-only">
							Search
						</label>

						<div class="relative">
							<div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
								<svg aria-hidden="true" class="w-6 h-6 text-gray-500 " fill="none" stroke="currentColor" viewBox="0 0 24 24"
									xmlns="http://www.w3.org/2000/svg">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
										d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
								</svg>
							</div>
							<input type="text" id="product-search-users-advance" name="search"
								class="bg-[#F8F9FA] block p-4 pl-12 w-[30rem] text-[1.3rem] text-gray-900 rounded-lg border border-transparent focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}}"
								placeholder="Are you looking for something?">
						</div>
					</div>
				</div>

				<h4 class="text-[1.5rem] font-semibold mb-4">
					Sort By
				</h4>

				<div class="flex items-center my-5">
					<ul class="grid gap-4 w-full grid-cols-2">
						{{-- <li>
							<input type="radio" id="radio-alphabet" name="product_sort" value="name ASC" class="hidden peer">
							<label for="radio-alphabet"
								class="inline-flex justify-center items-center p-2 w-full text-gray-500 bg-white rounded-lg cursor-pointer dark:hover:text-gray-300 peer-checked:bg-{{$site_settings->site_color_theme}} peer-checked:text-[#fff] hover:text-gray-600 hover:bg-gray-100 ">
								<div class="block">
									<div class="w-full text-[1.3rem] px-2">
										A to Z
									</div>
								</div>
							</label>
						</li> --}}

						<div>
							<button id="radio-alphabet" data-dropdown-toggle="dd-radio-alphabet"
								class="mr-2 inline-flex justify-center p-2 items-center  text-gray-500 bg-white border-0
										focus:outline-none hover:bg-gray-100 focus:ring-4
									focus:ring-gray-200 font-medium rounded-lg text-[1.3rem] w-full"
								type="button">
								<div>
									<span class="px-2">
										Alphabet
									</span>
									<svg class="md:inline hidden ml-2 w-6 h-6 mb-1" aria-hidden="true" fill="none" stroke="currentColor"
										viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
									</svg>
								</div>
							</button>

							{{-- Dropdown menu --}}
							<div id="dd-radio-alphabet" class="hidden z-10 w-48 bg-white rounded divide-y divide-gray-100 shadow"
								data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top"
								style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(522.5px, 3847.5px, 0px);">
								<ul class="p-3 space-y-1 text-[1.3rem] text-gray-700 " aria-labelledby="dd-radio-product">
									<li>
										<div class="flex items-center p-2 rounded hover:bg-gray-100">
											<input id="dd-radio-alphabet-A" type="radio" name="product_sort" value="name ASC"
												class="w-4 h-4 text-{{$site_settings->site_color_theme}} bg-gray-100 border-gray-300 focus:ring-{{$site_settings->site_color_theme}} focus:ring-2">
											<label for="dd-radio-alphabet-A" class="ml-2 w-full font-medium text-gray-900 rounded ">
												A to Z
											</label>
										</div>
									</li>
									<li>
										<div class="flex items-center p-2 rounded hover:bg-gray-100">
											<input id="dd-radio-alphabet-Z" type="radio" name="product_sort" value="name DESC"
												class="w-4 h-4 text-{{$site_settings->site_color_theme}} bg-gray-100 border-gray-300 focus:ring-{{$site_settings->site_color_theme}} ">
											<label for="dd-radio-alphabet-Z" class="ml-2 w-full font-medium text-gray-900 rounded ">
												Z to A
											</label>
										</div>
									</li>
								</ul>
							</div>
						</div>

						<li>
							<input type="radio" id="radio-latest" name="product_sort" value="created_at DESC" class="hidden peer">

							<label for="radio-latest"
								class="inline-flex justify-center items-center p-2 w-full text-gray-500 bg-white rounded-lg cursor-pointer dark:hover:text-gray-300 peer-checked:bg-{{$site_settings->site_color_theme}} peer-checked:text-[#fff] hover:text-gray-600 hover:bg-gray-100 ">
								<div class="block">
									<div class="w-full text-[1.3rem] px-2">
										Latest
									</div>
								</div>
							</label>
						</li>

						<li>
							<input type="radio" id="radio-sales" name="product_sort" value="count orders" class="hidden peer">

							<label for="radio-sales"
								class="inline-flex justify-center items-center p-2 w-full text-gray-500 bg-white rounded-lg cursor-pointer dark:hover:text-gray-300 peer-checked:bg-{{$site_settings->site_color_theme}} peer-checked:text-[#fff] hover:text-gray-600 hover:bg-gray-100 ">
								<div class="block">
									<div class="w-full text-[1.3rem] px-2">
										Top Sales
									</div>
								</div>
							</label>
						</li>

						<div>
							<button id="radio-product" data-dropdown-toggle="dd-radio-product"
								class="mr-2 inline-flex justify-center p-2 items-center  text-gray-500 bg-white border-0
										focus:outline-none hover:bg-gray-100 focus:ring-4
									focus:ring-gray-200 font-medium rounded-lg text-[1.3rem] w-full"
								type="button">
								<div>
									<span class="px-2">
										Price
									</span>
									<svg class="md:inline hidden ml-2 w-6 h-6 mb-1" aria-hidden="true" fill="none" stroke="currentColor"
										viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
									</svg>
								</div>
							</button>

							{{-- Dropdown menu --}}
							<div id="dd-radio-product" class="hidden z-10 w-48 bg-white rounded divide-y divide-gray-100 shadow"
								data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top"
								style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(522.5px, 3847.5px, 0px);">
								<ul class="p-3 space-y-1 text-[1.3rem] text-gray-700 " aria-labelledby="dd-radio-product">
									<li>
										<div class="flex items-center p-2 rounded hover:bg-gray-100">
											<input id="dd-radio-product-high" type="radio" value="price DESC" name="product_sort"
												class="w-4 h-4 text-{{$site_settings->site_color_theme}} bg-gray-100 border-gray-300 focus:ring-{{$site_settings->site_color_theme}} focus:ring-2">
											<label for="dd-radio-product-high" class="ml-2 w-full font-medium text-gray-900 rounded ">
												High to Low
											</label>
										</div>
									</li>
									<li>
										<div class="flex items-center p-2 rounded hover:bg-gray-100">
											<input id="dd-radio-product-low" type="radio" value="price ASC" name="product_sort"
												class="w-4 h-4 text-{{$site_settings->site_color_theme}} bg-gray-100 border-gray-300 focus:ring-{{$site_settings->site_color_theme}} ">
											<label for="dd-radio-product-low" class="ml-2 w-full font-medium text-gray-900 rounded ">
												Low to High
											</label>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</ul>
				</div>

				<h4 class="text-[1.5rem] font-semibold mt-6 mb-4">Price Range</h4>
				<div class="grid gap-5 w-full grid-cols-2 grid-flow-row mb-4">
					<input type="text" name="filter_price[min]" id="min"
						class="col-span-1 bg-[#F8F9FA] border-none text-center text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}} w-full p-2.5"
						placeholder="₱ Minumum">

					<input type="text" name="filter_price[max]" id="max"
						class="col-span-1 bg-[#F8F9FA] border-none text-center text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}} w-full p-2.5"
						placeholder="₱ Maximum">
				</div>

				<h4 class="text-[1.5rem] font-semibold mb-4">
					By Category
				</h4>

				<div class="flex items-center mb-4">
					<input id="radio-category-1" type="checkbox" value="Mobile and Gadgets" name="radio_category[]"
						class="w-4 h-4 text-{{$site_settings->site_color_theme}} bg-gray-100 border-gray-300 focus:ring-{{$site_settings->site_color_theme}} focus:ring-2">
					<label for="radio-category-1"
						class="ml-2 text-[1.5rem] leading-[1.5rem] font-medium text-gray-900 dark:text-gray-300">Mobile and
						Gadgets
					</label>
				</div>
				<div class="flex items-center  mb-4">
					<input id="radio-category-2" type="checkbox" value="Computers and Accessories" name="radio_category[]"
						class="w-4 h-4 text-{{$site_settings->site_color_theme}} bg-gray-100 border-gray-300 focus:ring-{{$site_settings->site_color_theme}}">
					<label for="radio-category-2"
						class="ml-2 text-[1.5rem] leading-[1.5rem] font-medium text-gray-900 dark:text-gray-300">
						Computers and Accessories
					</label>
				</div>
				<div class="flex items-center  mb-4">
					<input id="radio-category-3" type="checkbox" value="Consoles" name="radio_category[]"
						class="w-4 h-4 text-{{$site_settings->site_color_theme}} bg-gray-100 border-gray-300 focus:ring-{{$site_settings->site_color_theme}}">
					<label for="radio-category-3"
						class="ml-2 text-[1.5rem] leading-[1.5rem] font-medium text-gray-900 dark:text-gray-300">Gaming and
						Consoles
					</label>
				</div>
				<div class="flex items-center  mb-4">
					<input id="radio-category-4" type="checkbox" value="Audio" name="radio_category[]"
						class="w-4 h-4 text-{{$site_settings->site_color_theme}} bg-gray-100 border-gray-300 focus:ring-{{$site_settings->site_color_theme}}">
					<label for="radio-category-4"
						class="ml-2 text-[1.5rem] leading-[1.5rem] font-medium text-gray-900 dark:text-gray-300">
						Audio
					</label>
				</div>
				<div class="flex items-center  mb-4">
					<input id="radio-category-5" type="checkbox" value="Cameras and Drones" name="radio_category[]"
						class="w-4 h-4 text-{{$site_settings->site_color_theme}} bg-gray-100 border-gray-300 focus:ring-{{$site_settings->site_color_theme}}">
					<label for="radio-category-5"
						class="ml-2 text-[1.5rem] leading-[1.5rem] font-medium text-gray-900 dark:text-gray-300">
						Cameras and Drones
					</label>
				</div>
				<div class="flex items-center  mb-4">
					<input id="radio-category-6" type="checkbox" value="Others" name="radio_category[]"
						class="w-4 h-4 text-{{$site_settings->site_color_theme}} bg-gray-100 border-gray-300 focus:ring-{{$site_settings->site_color_theme}}">
					<label for="radio-category-6"
						class="ml-2 text-[1.5rem] leading-[1.5rem] font-medium text-gray-900 dark:text-gray-300">
						Others
					</label>
				</div>

				@if (true)
					<h4 class="text-[1.5rem] font-semibold mt-6 mb-4">
						By Rating
					</h4>
					<ul class="grid w-[15rem] grid-cols-1">
						<li>
							<input type="radio" id="radio-stars-5" name="product_rating" value="5" class="hidden peer">
							<label for="radio-stars-5"
								class="inline-flex justify-start items-center p-2 px-5 w-full text-gray-500 bg-white rounded-lg cursor-pointer dark:hover:text-gray-300 peer-checked:bg-gray-100 hover:text-gray-600 hover:bg-gray-100 ">
								<div class="stars">
									<i class="fas fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
									<i class="fas fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
									<i class="fas fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
									<i class="fas fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
									<i class="fas fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
								</div>
							</label>
						</li>

						<li>
							<input type="radio" id="radio-stars-4" name="product_rating" value="4" class="hidden peer">
							<label for="radio-stars-4"
								class="inline-flex justify-between items-center p-2 px-5 w-full text-gray-500 bg-white rounded-lg cursor-pointer dark:hover:text-gray-300 peer-checked:bg-gray-100 hover:text-gray-600 hover:bg-gray-100 ">
								<div class="stars">
									<i class="fas fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
									<i class="fas fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
									<i class="fas fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
									<i class="fas fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
									<i class="fa-regular fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
								</div>
								<span class="text-[#344767] text-[1.3rem] font-semibold py-0.5 rounded ml-3">
									& Up
								</span>
							</label>
						</li>

						<li>
							<input type="radio" id="radio-stars-3" name="product_rating" value="3" class="hidden peer">

							<label for="radio-stars-3"
								class="inline-flex justify-between items-center p-2 px-5 w-full text-gray-500 bg-white rounded-lg cursor-pointer dark:hover:text-gray-300 peer-checked:bg-gray-100 hover:text-gray-600 hover:bg-gray-100 ">
								<div class="stars">
									<i class="fas fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
									<i class="fas fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
									<i class="fas fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
									<i class="fa-regular fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
									<i class="fa-regular fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>

								</div>
								<span class="text-[#344767] text-[1.3rem] font-semibold py-0.5 rounded ml-3">
									& Up
								</span>
							</label>
						</li>

						<li>
							<input type="radio" id="radio-stars-2" name="product_rating" value="2" class="hidden peer">

							<label for="radio-stars-2"
								class="inline-flex justify-between items-center p-2 px-5 w-full text-gray-500 bg-white rounded-lg cursor-pointer dark:hover:text-gray-300 peer-checked:bg-gray-100 hover:text-gray-600 hover:bg-gray-100 ">
								<div class="stars">
									<i class="fas fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
									<i class="fas fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
									<i class="fa-regular fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
									<i class="fa-regular fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
									<i class="fa-regular fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>

								</div>
								<span class="text-[#344767] text-[1.3rem] font-semibold py-0.5 rounded ml-3">
									& Up
								</span>
							</label>
						</li>

						<li>
							<input type="radio" id="radio-stars-1" name="product_rating" value="1" class="hidden peer">

							<label for="radio-stars-1"
								class="inline-flex justify-between items-center p-2 px-5 w-full text-gray-500 bg-white rounded-lg cursor-pointer dark:hover:text-gray-300 peer-checked:bg-gray-100 hover:text-gray-600 hover:bg-gray-100 ">
								<div class="stars">
									<i class="fas fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
									<i class="fa-regular fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
									<i class="fa-regular fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
									<i class="fa-regular fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>
									<i class="fa-regular fa-star py-[.5rem] px-0 text-[1.3rem] text-{{$site_settings->site_color_theme}}"></i>

								</div>
								<span class="text-[#344767] text-[1.3rem] font-semibold py-0.5 rounded ml-3">
									& Up
								</span>
							</label>
						</li>

					</ul>
				@endif

				<button type="submit"
					class="col-span-2 w-full text-white mt-5
						button-shade
						focus:ring-4 focus:outline-none
						focus:ring-{{$site_settings->site_color_theme}} font-medium rounded-lg
						text-[1.3rem] px-5 py-2.5 text-center
						">
					Apply
				</button>
			</form>
		</div>
	</div>

	<script>
		const addToFavorite = (event, el) => {

			let elem = $('#' + el)
			$.ajax({
				type: elem.attr('method'),
				url: elem.attr('action'),
				data: new FormData(document.getElementById(el)),
				contentType: false,
				cache: false,
				processData: false,
				success: (data) => {
					console.log(data)
					console.log(el.substring(4))

					$('#heart-' + el.substring(4)).toggleClass('text-[#344767]')
					$('#heart-' + el.substring(4)).toggleClass('text-{{$site_settings->site_color_theme}}')
				},
				error: (data) => {
					console.log(data.code)
					console.log(data.message)
				}
			})
			event.preventDefault()
		};

		function openModal(side) {
			const dialog = document.querySelector('.dialog');
			if (dialog) {
				dialog.classList.add('dialog--open');
			}
		}

		function closeModal() {
			const dialog = document.querySelector('.dialog');
			if (dialog) {
				dialog.classList.remove('dialog--open');
			}
		}
	</script>
@endsection
