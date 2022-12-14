@extends('layouts.doubleNavigation')
{{-- rename this to business or shop --}}

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Appointments</title>
@endsection

@section('content')
	<div>
		{{-- header --}}
		<div class="business-header sm:flex-row sm:justify-between sm:items-center">
			<span class="w-fit flex flex-row gap-3 items-center cursor-pointer" onclick="location.href='{{ URL::previous() }}'">
				<span class="text-[20px]">&#10094;</span>
				<div class="flex flex-col gap-1">
					<h1 class="xl:basis-1/3 text-darkblue text-[24px] sm:text-[32px] font-extrabold">Invoice details</h1>
					<span class="italic text-[12px]">Billing Id: {{ $bill->billingId }}</span>
					<span class="italic text-[12px]">Appointment Id: {{ $bill->appointment->appointmentId }}</span>
				</div>
			</span>
			@if(false)
			<button type="button" class="h-[32px] px-3 bg-{{ $site_settings->site_color_theme }} text-white rounded-[8px] shadow-lg truncate" onclick="">
				<i class="fa-solid fa-print"></i>
				<span>Print</span>
			</button>
			@endif
		</div>

		{{-- main content --}}
		<div class="h-[calc(100vh_-_183px)] sm:h-[calc(100vh_-_137px)] lg:h-[calc(100vh_-_102px)] xl:h-[calc(100vh_-_94px)] px-4 pb-4 flex flex-col gap-2 overflow-y-auto">
			<div class="business-whitecard-bg">
				{{-- <!-- Session Status -->
				<x-auth-session-status class="mb-4" :status="session('status')" />

				<!-- Validation Errors -->
				<x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}
				<div class="flex flex-col md:flex-row gap-2 md:gap-0">
					<!-- the customer section -->
					<section class="md:basis-1/2 md:px-2 md:border-r-[0.5px] flex gap-2 flex-col">
						<h2 class="text-darkblue text-[16px] xl:text-[20px] font-extrabold">
							Customer
						</h2>
						<div class="px-2 flex flex-col gap-2">
							<span>Name: {{ $bill->appointment->user->firstname . ' ' . $bill->appointment->user->lastname }}</span>
							<span>Email: {{ $bill->appointment->user->email }}</span>
							<span>Phone Number: {{ $bill->appointment->user->contact }}</span>
							<span>Alternate Phone Number: {{ $bill->appointment->alt_contact ?? __('Undefined') }}</span>
						</div>
					</section>

					<!-- the service details section -->
					<section class="md:basis-1/2 md:px-2 md:border-l-[0.5px] flex gap-2 flex-col">
						<h2 class="text-darkblue text-[16px] xl:text-[20px] font-extrabold">
							Service details
						</h2>
						<div class="px-2 flex flex-col gap-2">
							<p>
								{{ $bill->repair_remarks }}
							</p>
							<span>Labour/Repair Cost: {{ $bill->repair_cost }}</span>
						</div>
					</section>
					@if (false)
						<!-- the message textbox section -->
						<section class="md:basis-1/2 flex gap-2 flex-col">
							<h2 class="text-darkblue text-[16px] xl:text-[20px] font-extrabold">
								Message
							</h2>
							<textarea class="border-none px-2 py-1 bg-dirtywhite text-[12px] rounded-[8px]" name="repairDesc" id="" rows="3" placeholder="message description"></textarea>
						</section>
					@endif
				</div>

				<!-- item, quantity, price and subtotal section -->
				<section class="mt-[20px]">
					<!-- metadata section for item, quantity, price and subtotal (grayed division) -->
					<div class="h-auto mb-2 py-2 flex flex-row bg-dirtywhite font-semibold">
						<span class="basis-1/4 px-2 truncate">Item</span>
						<span class="basis-1/4 px-2 text-left truncate">Quantity</span>
						<span class="basis-1/4 px-2 text-left truncate">Price</span>
						<span class="basis-1/4 px-2 text-end truncate">Subtotal</span>
					</div>

					<!-- item, quantity, price and subtotal -->
					<ul class="flex flex-col">
						<li class="flex gap-2 flex-col">
							<div id="billing-items">
								@foreach ($bill->items as $item => $data)
									<div class="flex flex-row gap-2">
										<Span class="basis-1/4 px-2 capitalize truncate">{{ $item }}</Span>
										<span class="basis-1/4 px-2 text-left truncate">{{ $data['quantity'] }}</span>
										<span class="basis-1/4 px-2 text-left truncate">Php {{ number_format((float) $data['price'], 2, '.', ',') }}</span>
										<span class="basis-1/4 px-2 text-end truncate">Php {{ number_format((float) $data['quantity'] * (float) $data['price'], 2, '.', ',') }}</span>
									</div>
								@endforeach
							</div>

							@if (false)
								<button type="button" class="w-fit text-left text-{{ $site_settings->site_color_theme }}" id="addMoreItemFillUp">+ Add more</button>
								<div class="flex gap-1 flex-row justify-between items-center text-right">
									<span class="basis-1/2 text-[#5F6368] text-[14px]">Subtotal</span>
									<span class="basis-1/2 text-[#5F6368] text-[14px]">PHP 1000.00</span>
								</div>
							@endif
						</li>
					</ul>
				</section>

				{{-- discount, amount and type section --}}
				<section class="pb-[20px] sm:pb-0">
					@if (false)
						<!-- metadata section for discount amount and type (grayed division) -->
						<div class="h-[16px] md:h-auto mb-2 md:py-2 md:flex flex-row bg-dirtywhite font-semibold">
							<div class="grow flex flex-row">
								<span class="inline-block basis-1/3 px-2">Discount</span>
								<span class="inline-block basis-1/3 px-2">Amount</span>
								<span class="inline-block basis-1/3"></span>
							</div>
							<span class="hidden md:inline-block basis-[75px] text-center">Type</span>
						</div>
					@endif

					<div class="flex flex-col gap-2">
						@if (false)
							<div class="flex flex-col md:flex-row gap-2">
								<div class="flex flex-col md:flex-row md:grow gap-2">
									<input class="md:basis-1/3 border-none my-1 first:mt-0 last:mt-0 px-2 py-1 bg-dirtywhite text-[12px] rounded-[8px]" type="text" name="" id="" placeholder="Add discount">

									<div class="md:basis-2/3 flex gap-2 flex-row justify-center">
										<div class="basis-1/2">
											<input class="w-full border-none my-1 first:mt-0 last:mt-0 px-2 py-1 bg-dirtywhite text-[12px] rounded-[8px]" type="text" name="" id="" placeholder="Amount%">
										</div>

										{{-- the value of the amount of discount --}}
										<div class="basis-1/2">
											<input class="w-full border-none my-1 first:mt-0 last:mt-0 px-2 py-1 bg-dirtywhite text-[12px] rounded-[8px]" type="text" name="" id="" placeholder="Amount_in_value">
										</div>
									</div>
								</div>

								{{-- php and % toggle --}}
								<div class="md:basis-auto" onclick="toggleDiscountType()">
									<label for="discountTypeCheckbox">
										<div class="w-[75px] h-[30px] border-[1px] border-gray-200 flex gap-[1px] flex-row items-center bg-gray-200 text-[12px] rounded-[7px] overflow-clip">
											<div class="basis-1/2 h-full flex flex-row justify-center items-center bg-white" id="php">
												<span>
													Php
												</span>
											</div>
											<div class="basis-1/2 h-full flex flex-row justify-center items-center bg-dirtywhite" id="percent">
												<span>
													%
												</span>
											</div>
										</div>
									</label>
								</div>
							</div>

							<div class="flex gap-1 flex-row justify-between items-center text-[#5F6368] text-right text-[14px]">
								<span class="basis-1/2">Total Discount</span>
								<span class="basis-1/2" id="discount">- PHP 0000.00</span>
							</div>
						@endif

						<div class="flex gap-1 flex-row justify-end items-center text-[#5F6368] text-right font-extrabold">
							<span class="basis-1/2 sm:basis-1/4">Total</span>
							<span class="basis-1/2 sm:basis-1/4" id="total">PHP {{ number_format((float) $bill->total, 2, '.', ',') }}</span>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>

	{{-- checkboxes here --}}
	<input class="absolute -top-full" type="checkbox" checked id="discountTypeCheckbox">

	<script>
		// do your custom scripts here
		function toggleDiscountType() {
			if (document.getElementById("discountTypeCheckbox").checked == true) {
				document.getElementById("php").style.backgroundColor = "#F2F2F2";
				document.getElementById("percent").style.backgroundColor = "#FFFFFF";
			} else {
				document.getElementById("php").style.backgroundColor = "#FFFFFF";
				document.getElementById("percent").style.backgroundColor = "#F2F2F2";
			}
		}
		const additems = () => {
			$('#billing-items').append(
				`<div class="flex flex-col md:flex-row gap-2">
					<input
						class="md:basis-1/3 border-none my-1 first:mt-0 last:mt-0 px-2 py-1 bg-dirtywhite text-[12px] rounded-[8px]"
						type="text" name="items[]" id="" placeholder="Item name">
					<div class="md:basis-2/3 flex gap-2 flex-row justify-center">
						<div class="basis-1/2">
							<input class="w-full border-none my-1 first:mt-0 last:mt-0 px-2 py-1 bg-dirtywhite text-[12px] rounded-[8px]"
								type="number" name="quantity[]" id="" placeholder="Quantity">
						</div>
						<div class="basis-1/2">
							<input class="w-full border-none my-1 first:mt-0 last:mt-0 px-2 py-1 bg-dirtywhite text-[12px] rounded-[8px]"
								type="number" name="price[]" id="" placeholder="Price">
						</div>
					</div>
				</div>`
			)
		};
		$(() => {
			$('#addMoreItemFillUp').click(additems)
		});
	</script>
@endsection
