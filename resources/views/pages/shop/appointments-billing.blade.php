@extends('layouts.doubleNavigation')
{{-- rename this to business or shop --}}

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Appointments</title>
@endsection

@section('content')
	<form class="" action="{{ route('business.appointments.billing.store', $appointment->appointmentId) }}" method="post" id="billing">
		@csrf
		{{-- header --}}
		<div class="business-header md:flex-row md:justify-between md:items-center">
			<span class="w-fit flex flex-row gap-3 items-center cursor-pointer" onclick="location.href='{{ route('business.appointments.index') }}'">
				<span class="text-[20px]">&#10094;</span>
				<div class="flex flex-col gap-1">
					<h1 class="xl:basis-1/3 text-darkblue text-[24px] sm:text-[32px] font-extrabold">Appointments billing</h1>
					<span class="italic">Manage your billing information here</span>
				</div>
			</span>
			<div class="flex gap-1 flex-row justify-center items-end">
				@if (false)
					<button type="button" class="p-2 basis-1/3 bg-dirtywhite text-[10px] text-[#5F6368] font-semibold rounded-[7px]">
						PREVIEW
					</button>
					<button type="button" class="p-2 basis-1/3 bg-dirtywhite text-[10px] text-[#5F6368] font-semibold rounded-[7px]">
						SAVE DRAFT
					</button>
				@endif
				<button onclick="location.reload()" type="button" class="p-2 px-6 basis-1/2 bg-dirtywhite text-[10px] text-[#5F6368] font-semibold rounded-[7px]">
					RESET
				</button>
				<button type="submit" class="p-2 px-6 basis-1/2 bg-{{ $site_settings->site_color_theme }} text-[10px] text-dirtywhite font-semibold rounded-[7px]">
					SEND
				</button>
			</div>
		</div>

		{{-- main content --}}
		<div class="h-[calc(100vh_-_183px)] sm:h-[calc(100vh_-_137px)] lg:h-[calc(100vh_-_102px)] xl:h-[calc(100vh_-_94px)] px-4 pb-4 flex flex-col gap-2 2xl:text-[14px] overflow-y-auto">
			<div class="business-whitecard-bg">
				<!-- Session Status -->
				<x-auth-session-status class="mb-4" :status="session('status')" />

				<!-- Validation Errors -->
				<x-auth-validation-errors class="mb-4" :errors="$errors" />
				<div class="flex flex-col gap-2">
					<div class="flex flex-col md:flex-row gap-2">
						<!-- the customer textboxes section -->
						<section class="md:basis-1/2 flex gap-2 flex-col">
							<h2 class="text-darkblue text-[16px] xl:text-[20px] font-extrabold">
								Customer
							</h2>
							<input class="border-none px-2 py-1 bg-dirtywhite rounded-[8px]" disabled type="text" name="name" value="{{ $appointment->user->firstname . ' ' . $appointment->user->lastname }}" placeholder="name">
							<input class="border-none px-2 py-1 bg-dirtywhite rounded-[8px]" disabled type="text" name="email" value="{{ $appointment->user->email }}" placeholder="email">
							<input class="border-none px-2 py-1 bg-dirtywhite rounded-[8px]" disabled type="text" name="phoneNum" value="{{ $appointment->user->contact }}" placeholder="phone no.">
							<input class="border-none px-2 py-1 bg-dirtywhite rounded-[8px]" disabled type="text" name="altPhoneNum" value="{{ $appointment->alt_contact ?? __('undefined') }}" placeholder="alternate phone no.">
						</section>

						<!-- the service details textboxes section -->
						<section class="md:basis-1/2 flex gap-2 flex-col">
							<h2 class="text-darkblue text-[16px] xl:text-[20px] font-extrabold">
								Service details
							</h2>
							<textarea class="border-none px-2 py-1 bg-dirtywhite rounded-[8px]" rows="3" name="repair_remarks" placeholder="ex: I replace the phone's LCD with a new one, and also replace the batteries.">{{ old('repair_remarks') }}</textarea>
							<input class="border-none px-2 py-1 bg-dirtywhite rounded-[8px]" type="number" name="repair_cost" id="repair_cost" placeholder="labour/repair cost" value="{{ old('repair_cost') }}">
						</section>
					</div>
					@if (false)
						<!-- the message textbox section -->
						<section class="md:basis-1/2 flex gap-2 flex-col">
							<h2 class="text-darkblue text-[16px] xl:text-[20px] font-extrabold">
								Message
							</h2>
							<textarea class="border-none px-2 py-1 bg-dirtywhite rounded-[8px]" name="repairDesc" id="" rows="3" placeholder="message description"></textarea>
						</section>
					@endif
				</div>

				<!-- item, quantity, price and subtotal section -->
				<section class="mt-[20px]">
					<!-- metadata section for item, quantity, price and subtotal (grayed division) -->
					<div class="h-[16px] md:h-auto mb-2 md:py-2 md:flex flex-row gap-2 bg-dirtywhite">
						<div class="md:basis-1/3 flex flex-row gap-2">
							<span class="basis-[32px] invisible"></span>
							<span class="hidden md:inline-block grow px-2">Item</span>
						</div>
						<div class="md:basis-2/3 flex flex-row gap-2">
							<span class="hidden md:inline-block basis-1/2 px-2">Quantity</span>
							<span class="hidden md:inline-block basis-1/2 px-2">Price</span>
						</div>
					</div>

					<!-- item, quantity, price and subtotal textboxes -->
					<ul class="flex flex-col">
						<li class="flex gap-2 flex-col">
							<div id="billing-items">
								<div class="flex flex-col md:flex-row gap-1 md:gap-2">
									<div class="md:basis-1/3 first:mt-0 last:mt-0 flex flex-row gap-2 justify-center items-center">
										<button type="button" class="basis-[32px] my-1 flex flex-row justify-center items-center" onclick="$(this).parent().parent().remove()">
											<i class="fa-solid fa-xmark w-[24px] h-[24px]"></i>
										</button>
										<input class="grow border-none my-1 px-2 py-1 bg-dirtywhite rounded-[8px]" type="text" name="items[]" id="" placeholder="Item name">	
									</div>
									<div class="md:basis-2/3 first:mt-0 last:mt-0 flex gap-2 flex-row">
										<div class="basis-1/2">
											<input class="quantities w-full border-none my-1 px-2 py-1 bg-dirtywhite rounded-[8px]" type="text" name="quantity[]" id="" placeholder="Quantity">
										</div>
										<div class="basis-1/2">
											<input class="prices w-full border-none my-1 px-2 py-1 bg-dirtywhite rounded-[8px]" type="text" name="price[]" id="" placeholder="Price">
										</div>
									</div>
								</div>
							</div>

							<button type="button" class="w-fit text-left text-{{ $site_settings->site_color_theme }}" id="addMoreItemFillUp">+ Add more</button>
							@if (false)
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
								<span class="hidden md:inline-block basis-1/3 px-2">Discount</span>
								<span class="hidden md:inline-block basis-1/3 px-2">Amount</span>
								<span class="hidden md:inline-block basis-1/3"></span>
							</div>
							<span class="hidden md:inline-block basis-[75px] text-center">Type</span>
						</div>
					@endif

					<div class="flex flex-col gap-2">
						@if (false)
							<div class="flex flex-col md:flex-row gap-2">
								<div class="flex flex-col md:flex-row md:grow gap-2">
									<input class="md:basis-1/3 border-none my-1 first:mt-0 last:mt-0 px-2 py-1 bg-dirtywhite rounded-[8px]" type="text" name="" id="" placeholder="Add discount">

									<div class="md:basis-2/3 flex gap-2 flex-row justify-center">
										<div class="basis-1/2">
											<input class="w-full border-none my-1 first:mt-0 last:mt-0 px-2 py-1 bg-dirtywhite rounded-[8px]" type="text" name="" id="" placeholder="Amount%">
										</div>

										{{-- the value of the amount of discount --}}
										<div class="basis-1/2">
											<input class="w-full border-none my-1 first:mt-0 last:mt-0 px-2 py-1 bg-dirtywhite rounded-[8px]" type="text" name="" id="" placeholder="Amount_in_value">
										</div>
									</div>
								</div>

								{{-- php and % toggle --}}
								<div class="md:basis-auto" onclick="toggleDiscountType()">
									<label for="discountTypeCheckbox">
										<div class="w-[75px] h-[30px] border-[1px] border-gray-200 flex gap-[1px] flex-row items-center bg-gray-200 rounded-[7px] overflow-clip">
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

						<div class="flex gap-1 flex-row justify-between items-center text-[#5F6368] text-right text-[14px] font-extrabold">
							<span class="basis-1/2">Total</span>
							<span class="basis-1/2" id="billing_total">PHP 0000.00</span>
						</div>
					</div>
				</section>
			</div>
		</div>
	</form>

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
				`<div class="flex flex-col md:flex-row gap-1 md:gap-2">
					<div class="md:basis-1/3 first:mt-0 last:mt-0 flex flex-row gap-2 justify-center items-center">
						<button type="button" class="basis-[32px] my-1 flex flex-row justify-center items-center" onclick="$(this).parent().parent().remove()">
							<i class="fa-solid fa-xmark w-[24px] h-[24px]"></i>
						</button>
						<input class="grow border-none my-1 px-2 py-1 bg-dirtywhite rounded-[8px]" type="text" name="items[]" id="" placeholder="Item name">	
					</div>
					<div class="md:basis-2/3 first:mt-0 last:mt-0 flex gap-2 flex-row">
						<div class="basis-1/2">
							<input class="quantities w-full border-none my-1 px-2 py-1 bg-dirtywhite rounded-[8px]" type="text" name="quantity[]" id="" placeholder="Quantity">
						</div>
						<div class="basis-1/2">
							<input class="prices w-full border-none my-1 px-2 py-1 bg-dirtywhite rounded-[8px]" type="text" name="price[]" id="" placeholder="Price">
						</div>
					</div>
				</div>`
			)
		};
		const computeTotal = () => {
			let repair_cost = $('#repair_cost').val()


			let arr_prices = [];
			let sum = 0
			let iteration = 0
			let prices = $('input.prices').each(function() {
				sum += Number($(this).val()) * Number($('input.quantities')[iteration].value);
				iteration++
			})
			$('#billing_total').html('Php ' + parseFloat(parseFloat(sum) + parseFloat(repair_cost)).toFixed(2))
		};
		$(() => {
			$('#addMoreItemFillUp').click(additems)

			setInterval(computeTotal, 1500);
		});
	</script>
@endsection
