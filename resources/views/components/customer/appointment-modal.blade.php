<div class="relative p-4 w-full md:max-w-[80%] max-w-[100%] h-full md:h-[80%]">

	<!-- Modal content -->
	<div class="relative bg-white rounded-lg shadow">

		<button type="button"
			class="absolute top-3 right-2.5
				text-gray-400 bg-transparent
				hover:bg-gray-200 hover:text-gray-900 rounded-lg text-[1.3rem] p-1.5
				ml-auto inline-flex items-center"
			onclick="modal.hide()" data-modal-toggle="appointment-details">

			<svg aria-hidden="true" class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd"
					d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0
					111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10
					11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293
					5.707a1 1 0 010-1.414z"
					clip-rule="evenodd">
				</path>
			</svg>
			<span class="sr-only">Close modal</span>
		</button>

		<div class="py-6 px-6 md:px-8 overflow-auto">

			<h3 class="mb-4 text-[2rem] font-bold text-gray-90 px-[30px]">
				Appointment Details
			</h3>

			<div>
				<div class="grid gap-6 mb-6 md:grid-cols-3 md:grid-flow-col">

					{{-- column 1 --}}
					<div class="w-full py-[10px] px-[30px] float-left space-y-6">
						<h4 class="mb-4 text-[1.5rem] font-bold text-[#5F6368]">
							Shop Information
						</h4>
						<div>
							<label for="shopName" class="block mb-2 text-[1.3rem] font-medium text-gray-900">
								Shop Name
							</label>
							<h3 class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg block w-full p-2.5">
								{{ $apt->shop->name }}
							</h3>
						</div>

						@foreach (collect($apt->shop->contacts)->only('landline','mobile') as $contactType => $contact)
							<div>
								<label for="shopContact{{ $loop->iteration }}" class="capitalize block mb-2 text-[1.3rem] font-medium text-gray-900">
									{{ $contactType }}
								</label>
								<h3 class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg block w-full p-2.5">
									{{ $contact }}
								</h3>
							</div>
						@endforeach
						<h4 class="mb-4 text-[1.5rem] font-bold text-[#5F6368]">
							Your Information
						</h4>
						<div>
							<label for="fullName" class="block mb-2 text-[1.3rem] font-medium text-gray-900">
								Full Name
							</label>
							<h3 class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg block w-full p-2.5">
								{{ $apt->user->firstname . ' ' . $apt->user->lastname }}
							</h3>
						</div>
						<div>
							<label for="customerContact" class="block mb-2 text-[1.3rem] font-medium text-gray-900">
								Contact Number
							</label>
							<h3 class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg block w-full p-2.5">
								{{ $apt->user->contact }}
							</h3>
						</div>
						<div>
							<label for="customerContact" class="block mb-2 text-[1.3rem] font-medium text-gray-900">
								Alternate Contact Number
							</label>
							<h3 class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg block w-full p-2.5">
								{{ $apt->alt_contact ?? __('Undefined') }}
							</h3>
						</div>

					</div>

					{{-- column 2 --}}
					<div class="w-full py-[10px] px-[30px] float-left space-y-6">

						<h4 class="mb-4 text-[1.5rem] font-bold text-[#5F6368]">
							Product Information
						</h4>
						<div>
							<label for="category" class="block mb-2 text-[1.3rem] font-medium text-gray-900">
								Category
							</label>
							<h3 class="capitalize bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg block w-full p-2.5">
								{{ $apt->product_details['category'] ?? __('Undefined') }}
							</h3>
						</div>
						<div>
							<label for="product_brand" class="block mb-2 text-[1.3rem] font-medium text-gray-900">
								Product Brand
							</label>
							<h3 class="capitalize bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg block w-full p-2.5">
								{{ $apt->product_details['product_brand'] ?? __('Undefined') }}
							</h3>
						</div>
						<div>
							<label for="model_name" class="block mb-2 text-[1.3rem] font-medium text-gray-900">
								Model Name
							</label>
							<h3 class="capitalize bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg block w-full p-2.5 ">
								{{ $apt->product_details['model_name'] ?? __('Undefined') }}
							</h3>
						</div>
						<div>
							<label for="model_num" class="block mb-2 text-[1.3rem] font-medium text-gray-900">
								Model Number
							</label>
							<h3 class="capitalize bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg block w-full p-2.5 ">
								{{ $apt->product_details['model_number'] ?? __('Undefined') }}
							</h3>
						</div>

						<h4 class="mb-4 text-[1.5rem] font-bold text-[#5F6368]">
							Time and Date
						</h4>
						<div class="grid gap-6 mb-6 md:grid-cols-2">

							<div class="relative">
								<label for="date" class="block mb-2 text-[1.3rem] font-medium text-gray-900">
									Date
								</label>
								<div class="relative">
									<h3 class="text-center bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg block w-full p-2.5 ">
										{{ $apt->appointment_date_time->format('D, M d, o') }}
									</h3>
								</div>
							</div>

							<div>
								<label class="block mb-2 text-[1.3rem] font-medium text-gray-900">
									Time
								</label>
								<h3 class="text-center bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg block w-full p-2.5 ">
									{{ $apt->appointment_date_time->format('h:i A') }}
								</h3>
							</div>

						</div>

					</div>

					{{-- column 3 --}}
					<div class="w-full py-[10px] px-[30px] float-left space-y-6">
						<h4 class="mb-4 text-[1.5rem] font-bold text-[#5F6368]">
							Concern
						</h4>
						<div>
							<label for="concern" class="block mb-2 text-[1.3rem] font-medium text-gray-900">
								Issue
							</label>
							<textarea id="concern" name="concern" rows="4"
							 class="h-[110px] resize-none block p-2.5 w-full text-[1.3rem]
								text-gray-900 bg-[#F2F2F2] rounded-lg border-none
								focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}}"
							 placeholder="Describe your problem with your device">{{ $apt->concern }}</textarea>
						</div>

						<div>
							<label for="attach-image" class="block mb-2 text-[1.3rem] font-medium text-gray-900">
								Attachment
							</label>
							<div class="grid grid-cols-4 grid-rows-2 gap-5">
								@foreach ($apt->product_details['files'] as $file)
									<figure class="relative max-w-lg transition-all duration-300 cursor-pointer">
										<a class="glightbox rounded-lg" data-gallery="gallery-appointments"
											href="{{ asset("/storage/{$apt->appointmentId}/file/{$file}/type/appointments") }}">
											<img src="{{ asset("/storage/{$apt->appointmentId}/file/{$file}/type/appointments") }}" alt="image">
										</a>
									</figure>
								@endforeach
							</div>
						</div>
					</div>
				</div>

				<div class="flex items-center md:mb-5 mb-16">
					<button type="submit"
						class="w-[10rem] text-white
							button-shade
							focus:ring-4 focus:outline-none
							focus:ring-{{$site_settings->site_color_theme}} font-medium rounded-lg
							text-[1.3rem] px-5 py-2.5 text-center
							ml-[30px]">
						Print
					</button>
					<button

					 type="button"
						class="ml-[10px] text-gray-500 bg-white
							hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border
							border-gray-200 text-[1.3rem] font-medium px-6 py-2.5 hover:text-gray-900 focus:z-10">
						Cancel Appointment
					</button>
				</div>
				</form>

			</div>
		</div>
	</div>
	<script>
		$(() => {
			lightbox = GLightbox()
		});
	</script>
