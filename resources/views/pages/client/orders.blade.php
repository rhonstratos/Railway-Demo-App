@php
	$statuses = [
	    'All' => route('customer.orders.index'),
	    'Processing' => route('customer.orders.index', ['filter' => 'Processing']),
	    'Completed' => route('customer.orders.index', ['filter' => 'Completed']),
	    'Canceled' => route('customer.orders.index', ['filter' => 'Canceled']),
	];
	$hasFilter = isset($filter) ? true : false;
	$query = request()->input('filter');
@endphp
@extends('layouts.customer')

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Orders</title>
@endsection

@section('content')
	<section class="bg-[#F8F9FA] lg:pt-[5rem] lg:px-[9%] py-[3rem] px-[2rem]">
		<!-- Session Status -->
		<x-auth-session-status class="mb-4" :status="session('status')" />

		<!-- Validation Errors -->
		<x-auth-validation-errors class="mb-4" :errors="$errors" />
		<h1 class="text-center mb-[4rem] relative">
			<span class="text-[3rem] pt-[.5rem] pb-[1rem] px-[2rem] text-[#344767] font-extrabold">
				My Orders
			</span>
		</h1>
		<div class="grid md:grid-cols-2 grid-cols-1 items-center pb-4 ">
			<div id="search-orders" class="flex">

				<form class="relative" id="search-orders" action="{{ route('customer.orders.index') }}" method="get">
					@csrf
					<label for="table-search" class="sr-only">
						Search
					</label>
					<div class="relative">
						<div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
							<svg aria-hidden="true" class="w-6 h-6 text-gray-500 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
							</svg>
						</div>
						<input type="hidden" name="search" value="true" hidden class="hidden">
						<input type="text" id="table-search-users" name="orderId"
							class="bg-[#fff] block p-4 pl-12 w-[35rem] text-[1.3rem] text-gray-900 rounded-lg border border-transparent focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }}"
							placeholder="Find your order, type its Order ID" required="">
						<button type="submit" class="text-white  absolute text-[1.3rem] right-2.5 bottom-2.5 button-shade font-medium bg-{{ $site_settings->site_color_theme }} rounded-lg leading-[1.25rem] px-4 py-2">Search</button>
					</div>
				</form>

			</div>

			<div class="flex items-center my-5">
				<ul class="grid gap-6 w-full grid-cols-4">
					@foreach ($statuses as $status => $url)
						<li onclick="location.href='{{ $url }}'">
							<input type="radio" id="radio-status-{{ $status }}" name="order-status" value="{{ $status }}" class="hidden peer" {{ $loop->iteration }}
								{{ $hasFilter ? ($hasFilter && $query == $status ? __('checked') : null) : ($status == 'All' ? __('checked') : null) }}>
							<label for="radio-status-{{ $status }}"
								class="inline-flex justify-center items-center p-2 w-full text-gray-500 bg-white rounded-lg cursor-pointer dark:hover:text-gray-300 peer-checked:bg-{{ $site_settings->site_color_theme }} peer-checked:text-[#fff] hover:text-gray-600 hover:bg-gray-100 ">
								<div class="block">
									<div class="w-full text-[1.3rem] px-2">
										{{ $status }}
									</div>
								</div>
							</label>
						</li>
					@endforeach
				</ul>
			</div>

		</div>

		<button type="button" onclick="qrModal.show()" class=" inline-block py-[.5rem] px-[2rem] rounded-[.5rem] mb-5 text-[1.3rem] text-{{ $site_settings->site_color_theme }} font-medium cursor-pointer hover:bg-[#fff]">
			<i class="text-[1.3rem] fas fa-mobile-screen-button mr-[8px]"></i>How to Pay Online?
		</button>

		{{-- Start Modal for QR --}}
		<div id="QR-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 z-50 md:inset-0 h-full justify-center items-center" aria-hidden="true">
			<div class="relative p-4 h-auto">
				<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
					{{-- close btn --}}
					<button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
						onclick="qrModal.hide()">
						<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
								clip-rule="evenodd"></path>
						</svg>
						<span class="sr-only">Close modal</span>
					</button>
					{{-- modal body --}}
					<div class="p-6 text-center">
						<h3 class="mb-5 text-[1.5rem] font-bold text-gray-700 w-full">
							Available Online Payment Methods
						</h3>

						{{-- available online payment method --}}
						<section class="">
							<div class="my-[3rem]">

								<div class="flex flex-row justify-center items-center text-gray-500">
									{{-- gcash --}}
									@php
										$_gcash = isset($shop->payment_settings['gcash_name']) && !is_null($shop->payment_settings['gcash_name']);
										$_gcash = $_gcash && isset($shop->payment_settings['gcash_img']) && !is_null($shop->payment_settings['gcash_img']);
										$_gcash = $_gcash && isset($shop->payment_settings['gcash_num']) && !is_null($shop->payment_settings['gcash_num']);
										//
										$_paymaya = isset($shop->payment_settings['paymaya_name']) && !is_null($shop->payment_settings['paymaya_name']);
										$_paymaya = $_paymaya && isset($shop->payment_settings['paymaya_img']) && !is_null($shop->payment_settings['paymaya_img']);
										$_paymaya = $_paymaya && isset($shop->payment_settings['paymaya_num']) && !is_null($shop->payment_settings['paymaya_num']);
									@endphp
									@if ($_gcash)
										<div @class([
											'px-2 flex flex-col gap-1',
											'border-r-[0.5px]' => $_gcash && $_paymaya,
										])>
											<span class="font-semibold text-[1.3rem]">GCash</span>
											<div class="flex flex-col gap-1 text-[1.3rem] px-[2rem] mb-5">
												<span class="capitalize">Account Name:
													{{ $shop->payment_settings['gcash_name'] }}
												</span>
												<span>Account/Mobile Number:
													{{ $shop->payment_settings['gcash_num'] }}
												</span>
											</div>
											<div class="w-full flex flex-row justify-center items-center">
												<div class="w-1/2 min-w-[100px] max-w-[165px] h-auto text-center text-black">
													<img src="{{ asset("storage/{$shop->user->userId}/file/{$shop->payment_settings['gcash_img']}/type/shop") }}" class="w-full h-auto" alt="img">
												</div>
											</div>
										</div>
									@endif
									{{-- paymaya --}}
									@if ($_paymaya)
										<div class=" px-2 border-l-[0.5px] flex flex-col gap-1">
											<span class="font-semibold text-[1.3rem]">PayMaya</span>
											<div class="flex flex-col gap-1 text-[1.3rem] px-[2rem] mb-5">
												<span class="capitalize">Account Name:
													{{ $shop->payment_settings['paymaya_name'] }}
												</span>
												<span>Account/Mobile Number:
													{{ $shop->payment_settings['paymaya_num'] }}
												</span>
											</div>
											<div class="w-full flex flex-row justify-center items-center">
												<div class="w-1/2 min-w-[100px] max-w-[165px] h-auto text-center text-black">
													<img src="{{ asset("storage/{$shop->user->userId}/file/{$shop->payment_settings['paymaya_img']}/type/shop") }}" class="w-full h-auto" alt="">
												</div>
											</div>
										</div>
									@endif
								</div>
							</div>
						</section>

						<button type="button" onclick="qrModal.hide()" {{-- onclick="newqrModal.show(); qrModal.hide()" --}} class="text-white button-shade text-[1.3rem] rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
							Close
						</button>
						<a href="{{ route('customer.chats.index') }}" type="button"
							class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm text-[1.3rem] px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
							Message Us
						</a>
					</div>
				</div>
			</div>
		</div>
		{{-- End Modal for QR --}}

		@if ($orders->count() < 1 && $hasFilter)
			<x-customer.empty-section :asset="asset('assets/Rectify/customer-home/filter-result.png')" header="Your filters produced no result" paragraph1="Try adjusting your filters to" paragraph2="display better results" divclass="" imgclass=" w-[20rem] my-[3rem]"
				buttonclass=" my-[1rem] ml-5 py-[.7rem] px-[7rem]" />
		@elseif ($orders->count() < 1)
			<x-customer.empty-section :asset="asset('assets/Rectify/customer-home/empty-shopcart.png')" header="Oops! Your dont have any orders" paragraph1="Looks like we didnt find the order you were looking for" paragraph2="or you haven't checked out your cart yet" divclass=""
				imgclass=" w-[30rem] my-[3rem]" buttonclass=" my-[1rem] ml-5 py-[.7rem] px-[7rem]" />
		@else
			@foreach ($orders as $order)
				<!--responsive table-->
				<div class="box-2 py-[2rem] px-8 mt-1rem mb-[5rem] flex-col hover:shadow-none overflow-x-auto">
					<div class="w-full flex justify-between items-center">
						<div class="md:text-[1.5rem] items-center text-[1.3rem] px-[2rem] py-[.5rem] text-[#344767] mb-5 rounded-[2rem] font-semibold bg-gray-50">
							Order ID: <span class="text-{{ $site_settings->site_color_theme }}">{{ $order->orderId }}</span>
						</div>
						<button data-popover-target="popover-details" data-popover-trigger="click" type="button" class=" inline-block py-[.5rem] px-[2rem] rounded-[.5rem] mb-5 text-gray-500 font-medium cursor-pointer focus:bg-gray-50 hover:bg-gray-50">
							<i class="text-[1.2rem] fas fa-eye mr-[8px]"></i>View Other Details
						</button>
						<div data-popover="" id="popover-details" role="tooltip"
							class="inline-block absolute invisible z-10 w-[25rem] text-[1.3rem] text-gray-500 bg-white rounded-lg border border-gray-200 shadow-sm opacity-0 transition-opacity duration-300 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600"
							data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 510px);">
							<div class="p-3">
								<div class="text-[1.3rem] text-gray-500">
									Status: <span class="text-{{ $site_settings->site_color_theme }}">{{ config('enums.order_status')[$order->status] }}</span>
								</div>

								<div class="text-[1.3rem] text-gray-500 capitalize">
									transfer - method: <span class="text-{{ $site_settings->site_color_theme }}">{{ $order->transfer_method }}</span>
								</div>
								<div class="text-[1.3rem] text-gray-500 capitalize">
									payment - method: <span class="text-{{ $site_settings->site_color_theme }}">{{ $order->payment_method }}</span>
								</div>
							</div>
							<div data-popper-arrow="" style="position: absolute; left: 0px; transform: translate(0px, 0px);"></div>
						</div>
					</div>

					<div class="w-full px-[2rem] flex justify-start text-[1.3rem] mb-7 font-semibold text-[#344767]">
						Status: <span class="text-{{ $site_settings->site_color_theme }} font-medium ml-1">{{ config('enums.order_status')[$order->status] }}</span>
					</div>

					<table class="mobiletable border-collapse m-0 p-0 w-full table-fixed text-[1.3rem] text-gray-500">

						<thead class="text-[1.5rem] text-gray-700 md:static overflow-hidden absolute h-[1px] m-[1px] p-0 w-[1px]">
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
							@foreach ($order->items as $item)
								<tr class="hover:bg-gray-50">

									<td data-label="Product" class="py-4 px-6 ">
										<div class="flex md:items-center items-start justify-end md:justify-start">
											<img class="h-[5rem] w-[5rem] rounded-md" src="{{ asset('/storage/' . $item->product->productId . '/file/' . $item->product->img_showcase . '/type/products') }}" alt="Product Image">
											<div class="pl-3">
												<div class="ellipsis-overflow overflow-hidden md:w-[30rem] w-[20rem] text-[1.3rem] font-semibold capitalize">
													{{ $item->product->name }}
												</div>

												</p>
												<div class="text-[1rem] font-normal mt-2 text-gray-500">
													Stock:
													<span class="text-{{ $site_settings->site_color_theme }} font-semibold">
														{{ $item->product->currentInventory()->quantity }} left
													</span>
												</div>
											</div>
										</div>
									</td>

									<td data-label="Quantity" class="py-4 px-6 md:text-center">
										{{ $item->quantity }}
									</td>

									<td data-label="Order Total" class="py-4 px-6 md:text-center">
										Php {{ number_format((float) $item->subtotal, 2, '.', ',') }}
									</td>
									<td data-label="Action" class="py-4 px-6 text-right mb-[5rem]">
										@php
											$_status = $order->status == \App\Models\Orders::STATUS_COMPLETED;
											$_review = $reviews->where('product_id', $item->product->id)->first();
										@endphp
										@if ($_status && !$_review)
											{{-- if order status is completed and has no review yet --}}
											<button type="button" name="action" value="rate" onclick="setProdID('{{ $item->product->productId }}');rateModal.show();"
												class="bg-{{ $site_settings->site_color_theme }} inline-block py-[.5rem] px-[2rem] rounded-[.5rem] text-[#fff] button-shade font-medium cursor-pointer">
												<i class="text-[1.2rem] fas fa-star mr-[8px]">
												</i>
												Rate
											</button>
										@elseif ($_status && $_review)
											{{-- if order status is completed and has review --}}
											<button type="button" name="action" value="rate" disabled class="inline-block py-[.5rem] px-[2rem] cursor-not-allowed rounded-[.5rem] text-gray-400 bg-gray-100 font-medium">
												<i class="text-[1.2rem] fas fa-star mr-[8px]">
												</i>
												Already reviewed
											</button>
										@else
											<button type="button" name="action" value="rate" disabled class="inline-block py-[.5rem] px-[2rem] cursor-not-allowed rounded-[.5rem] text-gray-400 bg-gray-100 font-medium">
												<i class="text-[1.2rem] fas fa-star mr-[8px]">
												</i>
												Rate
											</button>
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>

					{{-- 					<div>
						<label for="">Order total: </label>
						<input type="text" value="{{$order->total}}">
					</div> --}}

					<div class="total-price flex items-end flex-col mt-[2rem]">
						<table class="mobiletable border-t-[3px] border-{{ $site_settings->site_color_theme }} border-solid w-[100%] max-w-[35rem] text-gray-500 text-[1.3rem]">
							<tr>
								<td class="py-[1rem] px-[0.5rem] last:text-right">
									Order Total
								</td>
								<td class="py-[1rem] px-[0.5rem] last:text-right">
									Php {{ number_format((float) $order->total, 2, '.', ',') }}
								</td>
							</tr>
						</table>
					</div>

				</div>

				<!--end responsive table-->
			@endforeach

			{{-- pagination buttons --}}
			<x-customer.paginate-buttons :data="$orders" />

			{{-- create product review --}}
			<div id="rate-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 z-50 md:inset-0 h-full justify-center items-center" aria-hidden="true">
				<div class="relative p-4 w-full md:w-[50rem] h-auto">
					<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
						<form action="{{ route('customer.orders.review.store') }}" method="post" enctype="multipart/form-data">
							@csrf
							{{-- close btn --}}
							<button type="reset" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
								onclick="rateModal.hide()">
								<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
										clip-rule="evenodd"></path>
								</svg>
								<span class="sr-only">
									Close modal
								</span>
							</button>

							<div class="p-6 text-center">

								<h3 class="mb-5 text-[1.5rem] font-bold text-gray-700 ">
									Rate Product
								</h3>
								<p class="mb-5 text-[1.3rem] font-normal text-gray-500 dark:text-gray-400">
									Are you satisfied with our product? Write a review.
								</p>

								<section class="rate-star">
									<div id="radio-2" class="star-rate">
										<input type="radio" id="star-check-1" class="star-check" name="rating" value="1" hidden />
										<input type="radio" id="star-check-2" class="star-check" name="rating" value="2" hidden />
										<input type="radio" id="star-check-3" class="star-check" name="rating" value="3" hidden />
										<input type="radio" id="star-check-4" class="star-check" name="rating" value="4" hidden />
										<input type="radio" id="star-check-5" class="star-check" name="rating" value="5" hidden />
										<div class="stars">
											<label for="star-check-1">
												<i data-star-value="1" class="fa fa-star"></i>
											</label>
											<label for="star-check-2">
												<i data-star-value="2" class="fa fa-star"></i>
											</label>
											<label for="star-check-3">
												<i data-star-value="3" class="fa fa-star"></i>
											</label>
											<label for="star-check-4">
												<i data-star-value="4" class="fa fa-star"></i>
											</label>
											<label for="star-check-5">
												<i data-star-value="5" class="fa fa-star"></i>
											</label>
										</div>
									</div>
								</section>

								<div class="mb-5">
									<div class="flex justify-center items-center w-full">
										{{-- img container --}}
										<label id="img_placeholders" for="review_files"
											class="flex flex-row justify-center items-center gap-5 w-full h-64 bg-[#F2F2F2] rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
											{{-- upload placeholder --}}
											<div class="flex flex-col justify-center items-center pt-5 pb-6">
												<svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
													<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
													</path>
												</svg>
												<p class="mb-2 text-[1.3rem] text-gray-500 dark:text-gray-400">
													<span class="font-semibold">
														Click to upload
													</span>
													or drag and drop
												</p>
												<p class="text-xs text-gray-500 dark:text-gray-400">
													SVG, PNG, JPG or GIF (MAX. 800x400px)
												</p>
											</div>
										</label>
									</div>
								</div>

								<input id="review_files" name="files[]" multiple type="file" accept="image/*" hidden />
								<input id="review-productId" name="productId" type="text" hidden class="hidden" />

								<div class="mb-5">
									<textarea name="review_message" rows="4"
									 class="h-[110px] resize-none block p-2.5 w-full text-[1.3rem] text-gray-900 bg-[#F2F2F2] rounded-lg border-none focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-{{ $site_settings->site_color_theme }} dark:focus:border-{{ $site_settings->site_color_theme }}"
									 placeholder="Share your experience, and help others make better choices"></textarea>
								</div>

								<button type="submit" class="bg-{{ $site_settings->site_color_theme }} text-white button-shade text-[1.3rem] rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
									Rate Now
								</button>
								<button onclick="rateModal.hide()" type="button"
									class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm text-[1.3rem] px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
									Cancel
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		@endif
	</section>

	<script>
		const setProdID = (prodID) => {
			$('#review-productId').val(prodID)
		};

		const imgBodyPlaceholder = () => {
			$('#img_placeholders').html('')
			$('#img_placeholders').html(
				`<div class="flex flex-col justify-center items-center pt-5 pb-6">
					<svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
						</path>
					</svg>
					<p class="mb-2 text-[1.3rem] text-gray-500 dark:text-gray-400">
						<span class="font-semibold">
							Click to upload
						</span>
						or drag and drop
					</p>
					<p class="text-xs text-gray-500 dark:text-gray-400">
						SVG, PNG, JPG or GIF (MAX. 800x400px)
					</p>
				</div>`
			)
		};
		const imgPreview = (parentDiv) => {
			const f = document.getElementById('review_files')
			if (f.files.length == 0) {
				console.log('hit false')
				return imgBodyPlaceholder()
			}
			let filesAmount = f.files.length
			$(parentDiv).html('')

			for (let i = 0; i < filesAmount; i++) {
				let reader = new FileReader();

				reader.onload = (e) => {
					$(parentDiv).html($(parentDiv).html() +
						`<div>
								<figure class="relative max-w-lg transition-all duration-300 cursor-pointer">
									<img class="rounded-lg w-[50px] h-[50px] object-cover"
									src="${e.target.result}"
									alt="image description" />
								</figure>
							</div>`
					)
				}

				reader.readAsDataURL(f.files[i])
			}
		};
		const imgBody = () => {
			$('#img_placeholders').html(
				`<div class="justify-center items-center pt-5 pb-6">
					<div class="p-4">
						<div id="img_prev_body" class="flex flex-row justify-center items-center gap-5">
						</div>
					</div>
				</div>`
			)
		};
		$(() => {
			rateModal = new Modal(document.getElementById('rate-modal'))
			qrModal = new Modal(document.getElementById('QR-modal'))
			$('#review_files').on('change', () => {
				imgBody()
				imgPreview('#img_placeholders')
			});
		});
	</script>
@endsection
