<div id="appointment-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full
    				md:inset-0 h-modal md:h-full justify-center items-center">

	<div class="relative p-4 w-full md:max-w-[80%] max-w-[100%] h-full md:h-[80%]">
		{{-- Modal content --}}
		<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
			<button type="button"
				class="absolute top-3 right-2.5
								text-gray-400 bg-transparent
								hover:bg-gray-200 hover:text-gray-900 rounded-lg text-[1.3rem] p-1.5
								ml-auto inline-flex items-center
								dark:hover:bg-gray-800 dark:hover:text-white"
				onclick="appointmentModal.hide()">
				<svg aria-hidden="true" class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
						clip-rule="evenodd"></path>
				</svg>
				<span class="sr-only">Close modal</span>
			</button>

			<div class="py-6 px-6 md:px-8 overflow-auto">
				<h3 class="mb-4 text-[2rem] font-bold text-gray-900 dark:text-white px-[30px]">
					Request an Appointment
				</h3>
				<form id="appointment-form" autocomplete="off" action="{{ route('customer.appointments.store') }}" method="post" enctype="multipart/form-data">
					@csrf
					{{-- Session Status --}}
					<x-auth-session-status class="mb-4" :status="session('status')" />
					{{-- Validation Errors --}}
					<x-auth-validation-errors class="mb-4" :errors="$errors" />

					<div class="grid gap-6 mb-6 md:grid-cols-3 md:grid-flow-col">

						{{-- column 1 --}}
						<div class="w-full py-[10px] px-[30px] float-left space-y-6">
							<h4 class="mb-4 text-[1.5rem] font-bold text-[#5F6368] dark:text-white">
								Contact Information
							</h4>
							<div>
								<label for="firstName" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">
									Firstname
									<span class="text-{{ $site_settings->site_color_theme }}">*</span></label>
								<input type="text" name="firstName" value="{{ $user->firstname ?? null }}" readonly id="firstName"
									class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
									placeholder="Juan" required>
							</div>
							<div>
								<label for="lastName" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">
									Lastname
									<span class="text-{{ $site_settings->site_color_theme }}">*</span></label>
								<input type="text" name="lastName" id="lastName" value="{{ $user->lastname ?? null }}" readonly
									class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
									placeholder="Dela Cruz" required>
							</div>
							<div>
								<label for="email" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">
									Email Address
									<span class="text-{{ $site_settings->site_color_theme }}">*</span></label>
								<input type="email" name="email" id="email" value="{{ $user->email ?? null }}" readonly
									class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
									placeholder="rectify@gmail.com" required>
							</div>
							<div>
								<label for="contact" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">
									Contact Number
									<span class="text-{{ $site_settings->site_color_theme }}">*</span></label>
								<input type="text" name="contact" id="contact" value="{{ $user->contact ?? null }}" readonly
									class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
									placeholder="09912345678" required>
							</div>
							<div>
								<label for="alt_contact" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">
									Alternative Contact Number
								</label>
								<input type="text" name="alt_contact" id="alt_contact"
									class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
									placeholder="09997778888">
							</div>
						</div>

						{{-- column 2 --}}
						<div class="w-full py-[10px] px-[30px] float-left space-y-6">
							<h4 class="mb-4 text-[1.5rem] font-bold text-[#5F6368] dark:text-white">
								Product Information
							</h4>

							<div>
								<label for="category" class="block mb-2 text-[1.3rem] font-medium text-gray-900 ">
									Category
									<span class="text-{{ $site_settings->site_color_theme }}">*</span></label>
								<select id="category" name="category"
									class="block p-3 mb-6 w-full text-gray-900 bg-[#F2F2F2] rounded-lg border-none focus:ring-{{ $site_settings->site_color_theme }} focus:ring-1 focus:outline-none font-medium text-[1.3rem] items-center">
									<option selected disabled value="">Select Category</option>
									<option value="Mobile Phone">Mobile Phone</option>
									<option value="Computer">Computer</option>
									<option value="Consoles">Consoles</option>
									<option value="IoT">IoT</option>
									<option value="Others">Others</option>
								</select>
							</div>

							<div>
								<label for="product_brand" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Product
									Brand
									<span class="text-{{ $site_settings->site_color_theme }}">*</span></label>
								<input type="text" name="product_brand" id="product_brand" value="{{ old('product_brand') }}"
									class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
									placeholder="Samsung" required>
							</div>

							<div>
								<label for="model_name" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Model
									Name
									<span class="text-{{ $site_settings->site_color_theme }}">*</span></label>
								<input type="text" name="model_name" id="model_name" value="{{ old('model_name') }}"
									class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
									placeholder="Galaxy S20 Ultra" required>
							</div>

							<div>
								<label for="model_num" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Model
									Number
								</label>
								<input type="text" name="model_num" id="model_num" value="{{ old('model_num') }}"
									class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
									placeholder="SM-G988">
							</div>

							<h4 class="mb-4 text-[1.5rem] font-bold text-[#5F6368] dark:text-white">
								Time and Date
							</h4>

							<div class="grid gap-6 mb-6 md:grid-cols-2">
								<div class="relative">
									<label for="date" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">
										Date
										<span class="text-{{ $site_settings->site_color_theme }}">*</span></label>
									<span id="date_error" class="hidden text-red-600">
									</span>
									<div class="relative">
										<div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
											<svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd">
												</path>
											</svg>
										</div>
										{{--
											<input datepicker datepicker-autohide id="appointment_date" name="date" type="text"
											class="bg-[#F2F2F2] border-none text-gray-900 rounded-lg text-[1.3rem] focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}} block w-full pl-10 p-2.5 py-auto h-[2.9rem]"
											placeholder="Select date">
											--}}
										@php
											$_tomorrow = now()
											    ->addDay()
											    ->toDateString();
										@endphp
										<input type="date" name="date" id="appointment_date" value="{{ $_tomorrow }}" min="{{ $_tomorrow }}" placeholder="Select date"
											class="bg-[#F2F2F2] border-none text-gray-900 rounded-lg text-[1.3rem] focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full pl-10 p-2.5 py-auto h-[2.9rem]">
									</div>
								</div>
								<div>
									<label class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Time <span class="text-{{ $site_settings->site_color_theme }}">*</span></label>
									{{-- Modal toggle --}}
									<button id="selected_time"
										class=" text-left bg-[#F2F2F2] border-none cursor-pointer text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} block w-full h-12 p-2.5 font-medium"
										type="button" onclick="timeModal.show()" disabled>
										Select Time
									</button>

									<input id="time" name="time" type="text" hidden>

									<div id="timeModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
										<div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
											{{-- Modal content --}}
											<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
												{{-- Modal header --}}
												<div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
													<h3 class="text-[1.3rem] font-semibold text-gray-900 dark:text-white">
														Select Time
													</h3>
													<button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
														onclick="timeModal.hide()">
														<svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
															<path fill-rule="evenodd"
																d="M4.293 4.293a1 1 0 011.414 0L10
																			8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1
																			1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10
																			4.293 5.707a1 1 0 010-1.414z"
																clip-rule="evenodd">
															</path>
														</svg>
														<span class="sr-only">
															Close modal
														</span>
													</button>
												</div>

												{{-- Modal body --}}
												<div class="p-6 space-y-6">
													<div class="container normal-case">
														{{-- time slots --}}
														<div>
															<div id="time_body" class="space-y-6"></div>
														</div>
													</div>
												</div>

												{{-- Modal footer --}}
												<div class="flex items-center justify-center p-6 space-x-2 mt-[2rem] rounded-b border-t border-gray-200 dark:border-gray-600">
													<button onclick="timeModal.hide()" type="button"
														class="text-white button-shade focus:ring-4 focus:outline-none focus:ring-{{ $site_settings->site_color_theme }} font-medium rounded-lg text-[1.3rem] px-7 py-2.5 text-center">
														Confirm
													</button>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>

						{{-- column 3 --}}
						<div class="w-full py-[10px] px-[30px] float-left space-y-6">
							<h4 class="mb-4 text-[1.5rem] font-bold text-[#5F6368] dark:text-white">
								Concern
							</h4>
							<div>
								<label for="concern" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">
									Describe the issue that you are experiencing <span class="text-{{ $site_settings->site_color_theme }}">*</span>
								</label>
								<textarea id="concern" name="concern" rows="4"
								 class="h-[110px] resize-none block p-2.5 w-full text-[1.3rem] text-gray-900 bg-[#F2F2F2] rounded-lg border-none focus:ring-{{ $site_settings->site_color_theme }} focus:border-{{ $site_settings->site_color_theme }} dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-{{ $site_settings->site_color_theme }} dark:focus:border-{{ $site_settings->site_color_theme }}"
								 placeholder="Describe your problem with your device">{{ old('concern') }}</textarea>
							</div>

							<div>
								<label for="attach-image" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">
									Attach Image
									<span class="text-{{ $site_settings->site_color_theme }}">*</span>
								</label>
								<div class="flex justify-center items-center w-full">
									<label id="img_placeholders" for="appointment_files"
										class="flex flex-col justify-center items-center w-full h-64 bg-[#F2F2F2] rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">

										<div class="flex flex-col justify-center items-center pt-5 pb-6">
											<svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
												</path>
											</svg>
											<p class="mb-2 text-[1.3rem] text-gray-500 ">
												<span class="font-semibold">
													Click to upload
												</span>
												or drag and drop
											</p>
											<p class="text-xs text-gray-500 ">
												SVG, PNG, JPG or GIF (MAX. 800x400px)
											</p>
										</div>

									</label>
								</div>
							</div>

							<input id="appointment_files" name="files[]" multiple type="file" hidden />
							{{-- End of Image Placeholders --}}

							<div class="flex justify-between">
								<div class="flex items-start">
									<div class="flex items-center h-5">
										<input id="remember" type="checkbox"
											class="w-4 h-4 bg-[#F8F9FA] rounded border border-gray-300 focus:ring-3 focus:ring-{{ $site_settings->site_color_theme }} dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-{{ $site_settings->site_color_theme }} dark:ring-offset-gray-800 text-{{ $site_settings->site_color_theme }}"
											required>
									</div>
									<label for="remember" class="ml-2 leading-[1.6rem] text-[1.3rem] font-medium text-gray-900 dark:text-gray-300 normal-case">
										By using this form, I understand and agree to the
										<a href="#" class="text-{{ $site_settings->site_color_theme }} hover:underline dark:text-{{ $site_settings->site_color_theme }}">
											Privacy Policy
										</a>
										and
										<a href="#" class="text-{{ $site_settings->site_color_theme }} hover:underline dark:text-{{ $site_settings->site_color_theme }}">
											Terms and Conditions
										</a>
									</label>
								</div>

							</div>
						</div>
					</div>

					<div class="flex items-center md:mb-5 mb-16">
						<button type="submit" class=" w-[10rem] text-white button-shade focus:ring-4 focus:outline-none focus:ring-{{ $site_settings->site_color_theme }} font-medium rounded-lg text-[1.3rem] px-5 py-2.5 text-center ml-[30px]">
							Submit
						</button>
						<button onclick="appointmentModal.hide()" type="button"
							class="ml-[10px] text-gray-500 bg-white w-[10rem] hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-[1.3rem] font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
