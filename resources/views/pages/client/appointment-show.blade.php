@extends('layouts.customer')

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Appointment Details</title>
@endsection

@section('content')
	@php
		$_shop = $apt->shop->user;
		$shop_img = $_shop->accountSettings->profile_img;
	@endphp
	<section class="bg-[#F8F9FA] lg:pt-[5rem] lg:px-[9%] py-[3rem] px-[2rem]">
		<h1 class="text-center mb-[4rem] relative text-[3rem] pt-[.5rem] pb-[1rem] px-[2rem] text-[#344767] font-extrabold">
			Appointment <span class="text-{{ $site_settings->site_color_theme }}">#{{ $apt->appointmentId }}</span>
		</h1>

		{{-- start of buttons --}}

		<div>
			<div class="flex items-center justify-between mb-16">
				<div class="flex items-center">
					@if ($apt->billing)
						<form id="export-invoice" action="{{ route('customer.billings.invoice.export') }}" method="post" onsubmit="/* printInvoice(event,this) */">
							@csrf
							<input type="text" name="billingId" value="{{ $apt->billing->billingId }}" class="hidden" hidden>
							<button type="submit"
								class="inline-block ml-[10px] h-[4rem] text-white button-shade focus:ring-4 focus:outline-none focus:ring-{{ $site_settings->site_color_theme }} rounded-lg border-none text-[1.3rem] font-medium px-6 py-2.5 focus:z-10">
								Print Invoice
							</button>
						</form>
						<script>
							const printInvoice = (event, form) => {
								event.preventDefault()
								$.post($('#export-invoice').attr('action'), $('#export-invoice').serializeArray())
									.done((data) => {
										console.log(data)
									})
							};
						</script>
					@else
						@if (false)
							<button type="button"
								class="inline-block ml-[10px] h-[4rem] text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border-none text-[1.3rem] font-medium px-6 py-2.5 hover:text-gray-900 focus:z-10">
								No Invoice Yet
							</button>
						@endif
					@endif
					@if ($apt->appointment_status == \App\Models\Appointments::APPOINTMENT_PENDING)
						<button type="button" onclick="cancelAppointment.show()"
							class="inline-block ml-[10px] h-[4rem] text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border-none text-[1.3rem] font-medium px-6 py-2.5 hover:text-gray-900 focus:z-10">
							Cancel Appointment
						</button>
					@elseif($apt->appointment_status == \App\Models\Appointments::APPOINTMENT_CANCELED)
						<button type="button" name="appointment_status" disabled
							class="ml-[10px] text-gray-500  h-[4rem] cursor-not-allowed  bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border-none text-[1.3rem] font-medium px-6 py-2.5 hover:text-gray-900 focus:z-10">
							Apppointment Cancelled
						</button>
					@endif
				</div>
				<div class="flex">
					@if (!$hasReviewed && ($apt->repair_status == \App\Models\Appointments::REPAIR_COMPLETED || $apt->repair_status == \App\Models\Appointments::REPAIR_FAILED))
						@if (false)
							{{-- receipt ready to view button --}}
							<button type="button" class="ml-[10px] text-[#fff] shadow-lg hover:shadow-none button-shade focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border-none text-[1.3rem] font-medium px-6 py-2.5 focus:z-10 cursor-pointer">
								View Receipt
							</button>
						{{-- @else --}}
							{{-- no recipet yet button --}}
							<button type="button" disabled
								class="ml-[10px] text-gray-500 {{-- shadow-lg  --}}hover:shadow-none bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border-none text-[1.3rem] font-medium px-6 py-2.5 focus:z-10 cursor-not-allowed">
								View Receipt
							</button>
						@endif
						{{-- true rate button --}}
						<button type="button" name="action" value="rate" onclick="rateServiceModal.show()" class=" inline-block h-[4rem] py-[.5rem] ml-[10px] text-[1.3rem] px-[2rem] rounded-[.5rem] text-[#fff] button-shade font-medium cursor-pointer ">
							<i class="text-[1.2rem] fas fa-star mr-[8px]">
							</i>
							Rate
						</button>
					@elseif($hasReviewed)
						{{-- disabled rate button --}}
						<button type="button" name="action" value="rate" disabled class=" inline-block h-[4rem] py-[.5rem] ml-[10px] text-[1.3rem] px-[2rem] rounded-[.5rem] text-gray-500 bg-gray-100 font-medium cursor-not-allowed">
							<i class="text-[1.2rem] fas fa-star mr-[8px]">
							</i>
							Thank you very much for the review!
						</button>
					@endif
				</div>
			</div>
		</div>

		{{-- end of buttons --}}

		<div>
			<div class="grid gap-6 mb-6 md:grid-cols-2 grid-flow-row">

				<div class="box-2 py-[2rem] px-8 mt-1rem mb-[5rem] hover:shadow-none overflow-x-auto relative">
					<div class="flex justify-between items-center pb-4 dark:bg-gray-900">
						<div class="relative">
							<h3 class="text-[1.5rem] font-bold text-gray-700">
								Shop Information
							</h3>
						</div>
					</div>
					<div class="grid gap-6 md:grid-cols-2 grid-cols-1 md:grid-rows-3 mb-7">
						<div class="row-span-3 col-span-1">
							<label for="user_img">
								<div class="mx-auto mt-9 relative w-auto h-auto transition-all">
									<div class="block">
										<img id="user_img_preview" src="{{ $shop_img ? asset('storage/users/' . $_shop->userId . '/images/profile/' . $shop_img) : asset('assets/master/placeholders/poggy.png') }}" alt="profile"
											class="mx-auto rounded-full w-[18rem] h-[18rem] object-cover cursor-pointer">
									</div>
								</div>
							</label>
						</div>

						<div class="row-span-1">
							<label for="shopName" class="block mb-2 text-[1.3rem] border-none font-medium text-gray-900 dark:text-gray-300">
								Shop Name
							</label>
							<input type="text" id="shopName" name="shopName"
								class="bg-[#F2F2F2] text-gray-900 text-[1.3rem] border-none rounded-lg focus:border-{{ $site_settings->site_color_theme }} focus:ring-{{ $site_settings->site_color_theme }} block w-full p-2.5" readonly value="{{ $shop->name }}">
						</div>

						<div class="row-span-1">
							<label for="landline" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">
								Landline
							</label>
							<input type="text" id="landline" name="landline"
								class="bg-[#F2F2F2] text-gray-900 text-[1.3rem] border-none rounded-lg focus:border-{{ $site_settings->site_color_theme }} focus:ring-{{ $site_settings->site_color_theme }} block w-full p-2.5" readonly
								value="{{ $shop->contacts['landline'] }}">
						</div>

						<div class="row-span-1">
							<label for="shop-contact" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">
								Mobile Number
							</label>
							<input type="tel" id="shop-contact" name="shop-contact"
								class="bg-[#F2F2F2] text-gray-900 text-[1.3rem] border-none rounded-lg focus:border-{{ $site_settings->site_color_theme }} focus:ring-{{ $site_settings->site_color_theme }} block w-full p-2.5" readonly
								value="{{ $shop->contacts['mobile'] }}">
						</div>
					</div>
				</div>

				<div class="box-2 py-[2rem] px-8 mt-1rem mb-[5rem] hover:shadow-none overflow-x-auto relative row-span-1">
					<div class="flex justify-between items-center pb-4 ">
						<div class="relative">
							<h3 class="text-[1.5rem] font-bold text-gray-70">
								Status
							</h3>
						</div>
					</div>

					<div class="grid gap-6 mb-6 md:grid-cols-2 md:grid-flow-row">
						<div>
							<label for="appointment-status" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Appointment Status
							</label>
							<input type="text" name="appointment-status" value="{{ config('enums.appointment_status')[$apt->appointment_status] }}" readonly id="appointment-status"
								class="bg-[#F2F2F2] border-none {{ config('enums.appointment_status_colors')[$apt->appointment_status] }} text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
						</div>

						<div>
							<label for="repair-status" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Repair
								Status</label>
							<input type="text" name="repair-status" id="repair-status" value="{{ config('enums.repair_status')[$apt->repair_status] }}" readonly
								class="bg-[#F2F2F2] border-none {{ config('enums.repair_status_colors')[$apt->repair_status] }} text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} mb-[4rem] focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
						</div>
					</div>

					<div class="flex justify-between items-center pb-4">
						<div class="relative">
							<h3 class="text-[1.5rem] mt-3 font-bold text-gray-70">
								Date and Time
							</h3>
						</div>
					</div>

					<div class="grid gap-6 mb-6 md:grid-cols-2 md:grid-flow-row">
						<div>
							<label for="date" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Date
							</label>
							<input type="text" name="date" value="{{ \Carbon\Carbon::parse($apt->appointment_date_time)->format('D, M d, o') }}" readonly id="date"
								class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
						</div>

						<div>
							<label for="time" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Time</label>
							<input type="text" name="time" id="time" value="{{ \Carbon\Carbon::parse($apt->appointment_date_time)->format('h:i A') }}" readonly
								class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
						</div>
					</div>
				</div>
			</div>

			<div class="box-2 py-[2rem] px-8 mt-1rem mb-[5rem] hover:shadow-none overflow-x-auto relative">
				<div class="flex justify-between items-center pb-4 ">
					<div class="relative">
						<h3 class="text-[1.5rem] font-bold text-gray-70">
							Your Information
						</h3>
					</div>
				</div>

				<div class="grid gap-6 mb-6 md:grid-cols-2 md:grid-flow-row">
					<div>
						<label for="fullName" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">
							Fullname
						</label>
						<input type="text" name="fullName" value="{{ $apt->user->firstname . ' ' . $apt->user->lastname }}" readonly id="fullName"
							class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
							placeholder="Juan" required>
					</div>

					<div>
						<label for="email" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Email
							Address</label>
						<input type="email" name="email" id="email" value="{{ $apt->user->email }}" readonly
							class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
							placeholder="rectify@gmail.com" required>
					</div>

					<div>
						<label for="contact" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Contact
							Number</label>
						<input type="text" name="contact" id="contact" value="{{ $apt->user->contact }}" readonly
							class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
							placeholder="09912345678" required>
					</div>

					<div>
						<label for="alt-contact" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Alternative
							Contact
							Number</label>
						<input type="text" name="alt-contact" id="alt-contact" value="{{ $apt->alt_contact ?? __('Undefined') }}" readonly
							class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
							placeholder="" required>
					</div>
				</div>
			</div>

			<div class="box-2 py-[2rem] px-8 mt-1rem mb-[5rem] hover:shadow-none overflow-x-auto relative">
				<div class="flex justify-between items-center pb-4 ">
					<div class="relative">
						<h3 class="text-[1.5rem] font-bold text-gray-70">
							Product Information
						</h3>
					</div>
				</div>
				<div class="grid gap-6 mb-6 md:grid-cols-2 md:grid-flow-row">
					<div>
						<label for="category" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Category
						</label>
						<input type="text" name="category" value="{{ $apt->product_details['category'] ?? __('Undefined') }}" readonly id="category"
							class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
							placeholder="" required>
					</div>

					<div>
						<label for="product_brand" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Product
							Brand</label>
						<input type="product_brand" name="product_brand" id="product_brand" value="{{ $apt->product_details['product_brand'] ?? __('Undefined') }}" readonly
							class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
							placeholder="Samsung" required>
					</div>

					<div>
						<label for="model_name" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Model
							Name</label>
						<input type="text" name="model_name" id="model_name" value="{{ $apt->product_details['model_name'] ?? __('Undefined') }}" readonly
							class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
							placeholder="Samsung Galaxy Note 6" required>
					</div>

					<div>
						<label for="model_num" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Model
							Number</label>
						<input type="text" name="model_num" id="model_num" value="{{ $apt->product_details['model_number'] ?? __('Undefined') }}" readonly
							class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
							placeholder="VCXJB-3535">
					</div>
				</div>
			</div>

			<div class="box-2 py-[2rem] px-8 mt-1rem mb-[5rem] hover:shadow-none overflow-x-auto relative">
				<div class="flex justify-between items-center pb-4 ">
					<div class="relative">
						<h3 class="text-[1.5rem] font-bold text-gray-70">
							Concern
						</h3>
					</div>
				</div>
				<div class="grid gap-6 mb-6 md:grid-cols-1 md:grid-flow-row">
					<div>
						<label for="concern" class="block mb-2 text-[1.3rem] font-medium text-gray-900">
							Issue
						</label>
						<textarea id="concern" name="concern" readonly rows="4"
						 class="h-[110px] resize-none block p-2.5 w-full text-[1.3rem]
					text-gray-900 bg-[#F2F2F2] rounded-lg border-none
					focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }}"
						 placeholder="Describe your problem with your device">{{ $apt->concern ?? __('Undefined') }}</textarea>
					</div>
				</div>
			</div>

			<div class="box-2 py-[2rem] px-8 mt-1rem mb-[5rem] hover:shadow-none overflow-x-auto relative">
				<div class="flex justify-between items-center pb-4 ">
					<div class="relative">
						<h3 class="text-[1.5rem] font-bold text-gray-70">
							Attachments
						</h3>
					</div>
				</div>
				<div class="grid gap-6 mb-6 grid-cols-4 md:grid-cols-8 md:grid-flow-row">

					@foreach ($apt->product_details['files'] as $item)
						<a href="{{ asset("/storage/{$apt->appointmentId}/file/{$item}/type/appointments") }}" data-gallery="gallery2" class="glightbox">
							<div class="w-[100%] p-8 h-[10rem] rounded-lg md:h-[15rem] my-7 mx-auto bg-cover bg-center bg-no-repeat" style="background-image: url({{ asset("/storage/{$apt->appointmentId}/file/{$item}/type/appointments") }})">
							</div>
						</a>
					@endforeach

				</div>
			</div>

			{{-- start of cancellation reason --}}
			@if ($apt->reason)
				<div class="box-2 py-[2rem] px-8 mt-1rem mb-[5rem] hover:shadow-none overflow-x-auto relative">
					<div class="flex justify-between items-center pb-4 ">
						<div class="relative">
							<h3 class="text-[1.5rem] font-bold text-gray-70">
								Cancellation
							</h3>
						</div>
					</div>
					<div class="grid gap-6 mb-6 md:grid-cols-1 md:grid-flow-row">
						<div>
							<label for="cancellation_reason" class="block mb-2 text-[1.3rem] font-medium text-gray-900">
								Reason
							</label>
							<textarea id="cancellation_reason" name="cancellation_reason" readonly rows="4"
							 class="h-[110px] resize-none block p-2.5 w-full text-[1.3rem]
					text-gray-900 bg-[#F2F2F2] rounded-lg border-none
					focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }}"
							 placeholder="I have a work conflict">{{ $apt->reason ?? __('Undefined') }}</textarea>
						</div>
					</div>
				</div>
			@endif

			{{-- end of cancellation reason --}}

			{{-- Appointment Rating --}}
			@if (!$hasReviewed && ($apt->repair_status == \App\Models\Appointments::REPAIR_COMPLETED || $apt->repair_status == \App\Models\Appointments::REPAIR_FAILED))
				<div id="rate-modal-repair" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 z-50 md:inset-0 h-full justify-center items-center" aria-hidden="true">
					<div class="relative p-4 w-full md:w-[50rem] h-auto">
						<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
							<form action="{{ route('customer.appointments.review.store') }}" method="post">
								@csrf

								{{-- close modal --}}
								<button type="reset" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
									onclick="rateServiceModal.hide()">
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
										Rate Service
									</h3>
									<p class="mb-5 text-[1.3rem] font-normal text-gray-500 dark:text-gray-400">
										Are you satisfied with our services? Write a review.
									</p>

									<section class="rate-star">
										<div id="radio-2" class="star-rate">
											<input type="radio" id="star-check-1" class="star-check" name="rating" value="1" />
											<input type="radio" id="star-check-2" class="star-check" name="rating" value="2" />
											<input type="radio" id="star-check-3" class="star-check" name="rating" value="3" />
											<input type="radio" id="star-check-4" class="star-check" name="rating" value="4" />
											<input type="radio" id="star-check-5" class="star-check" name="rating" value="5" />
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

									<input id="review-productId" name="appointmentId" type="text" hidden class="hidden" readonly value="{{ $apt->appointmentId }}" />

									<div class="mb-5">
										<textarea id="review_message" name="review_message" rows="4"
										 class="h-[110px] resize-none block p-2.5 w-full text-[1.3rem] text-gray-900 bg-[#F2F2F2] rounded-lg border-none focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-{{ $site_settings->site_color_theme }} dark:focus:border-{{ $site_settings->site_color_theme }}"
										 placeholder="Share your experience, and your review might be feautured on our home page!"></textarea>
									</div>

									<button type="submit" class="text-white button-shade text-[1.3rem] rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
										Rate Now
									</button>

									<button onclick="rateServiceModal.hide()" type="reset"
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

	{{-- Start Modal for cancel appointment --}}

	<div id="cancel-appointment-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 bottom-0 z-50 md:inset-0 h-full justify-center items-center" aria-hidden="true">
		<div class="relative p-4 h-auto">
			<div class="relative bg-white rounded-lg shadow">
				<button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
					onclick="cancelAppointment.hide()">
					<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
							clip-rule="evenodd"></path>
					</svg>
					<span class="sr-only">Close modal</span>
				</button>
				<form action="{{ route('customer.appointments.status.cancel', $apt->appointmentId) }}" method="post" class="p-6 text-center">
					@csrf
					@method('PATCH')
					<h3 class="mb-5 text-[1.5rem] font-bold text-gray-700">
						Cancel Appointment
					</h3>

					<div class="mb-6">
						<label for="reason_cancel" class="block mb-2 text-[1.3rem] text-left font-medium text-gray-900 dark:text-gray-300">
							Reason for Cancelling <span class="text-red-500">*</span>
						</label>

						<textarea id="reason_cancel" name="reason_cancel" rows="4" required
						 class="h-[110px] resize-none block p-2.5 w-full text-[1.3rem] text-gray-900 bg-[#F2F2F2] rounded-lg border-none focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-{{ $site_settings->site_color_theme }} dark:focus:border-{{ $site_settings->site_color_theme }}"
						 placeholder="Ex. I had a work conflict"></textarea>
					</div>

					<p class="mb-5 text-[1.3rem] text-left font-normal text-gray-500 dark:text-gray-400">
						Are you sure you want to
						cancel? After cancelling,
						no further changes can be made to this appointment.
					</p>

					<div class="flex items-start justify-center">

						<div>
							<button type="submit" name="appointment_status" value="{{ \App\Models\Appointments::APPOINTMENT_CANCELED }}"
								class="text-white bg-red-500 hover:bg-red-700 text-[1.3rem] rounded-lg text-sm inline-flex px-5 py-2.5 text-center mr-2">
								Yes, Cancel
							</button>
						</div>

						<button onclick="cancelAppointment.hide()" type="button"
							class="text-gray-500 bg-white hover:bg-gray-100 inline-flex focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm text-[1.3rem] px-5 py-2.5 hover:text-gray-900 focus:z-10">No,
							Go back
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	{{-- End Modal for cancel appointment --}}

	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		var cancelAppointment

		$(() => {
			cancelAppointment = new Modal(document.getElementById('cancel-appointment-modal'))
		});
	</script>

	@if (!$hasReviewed && ($apt->repair_status == \App\Models\Appointments::REPAIR_COMPLETED || $apt->repair_status == \App\Models\Appointments::REPAIR_FAILED))
		<script>
			var rateServiceModal
			$(() => {
				rateServiceModal = new Modal(document.getElementById('rate-modal-repair'))
			});
		</script>
	@endif

@endsection
