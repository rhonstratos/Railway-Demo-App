{{-- Appointment Information header --}}
<div class="sticky top-0 p-[10px] sm:p-[20px] flex gap-0 justify-start bg-light">
	<button class="w-fit flex gap-4 items-center text-darkblue" onclick="showApptInfo()">
		<span class="text-[20px]">&#10095;</span>
		<div class="grow flex flex-col items-start">
			<div class="text-[18px] 2xl:text-[23px] overflow-hidden">
				<h2 class="font-extrabold truncate">Appointment Information</h2>
			</div>
			<div class="text-gray text-[12px]">Appointment ID: <span id="appointment-id">{{ $apt->appointmentId }}</span></div>
		</div>
	</button>
</div>

{{-- the four details section --}}
<section class="flex flex-col grow 2xl:flex-row">
	{{-- notice and canceled appointment --}}
	@if ($apt->appointment_status != \App\Models\Appointments::APPOINTMENT_CANCELED)
		{{-- notice --}}
		<div class="business-whitecard-bg 2xl:w-1/2 2xl:order-last 2xl:h-fit mx-4 mb-2 overflow-y-hidden">
			{{-- card title --}}
			<button class="flex flex-row justify-between items-center text-darkblue font-semibold" onclick="collapseCards('noticeCard')">
				<h2>NOTICE</h2>
				<i class="fa-solid fa-chevron-down"></i>
			</button>

			{{-- card main content --}}
			<section class="block" id="noticeCard">
				<section class="mb-0 grow flex gap-2 flex-col justify-between items-center" id="noticeSection">
					@if ($apt->appointment_status == \App\Models\Appointments::APPOINTMENT_PENDING)
						<p class="text-center">
							<span id="appointment-user-name">{{ $apt->user->firstname }} {{ $apt->user->lastname }}</span>
							wants to request an appointment on
							<span id="appointment-date" class="font-semibold">{{ \Carbon\Carbon::parse($apt->appointment_date_time)->format('l, F d, o') }}</span>
							at
							<span id="appointment-time" class="font-semibold">{{ \Carbon\Carbon::parse($apt->appointment_date_time)->format('h:i A') }}</span>.
						</p>
					@endif

					{{-- Accept and reject buttons --}}
					<section class="px-2 w-full flex gap-1 flex-row">
						<button class="p-2 basis-1/2 flex gap-3 justify-center items-center border-[#ECEEF6] border-[1px] text-status-green rounded-[7px] shadow-lg" id="approved" onclick="setAppointment(this.id)">
							<span id="approveSpan">Approve</span>
						</button>
						<button class="p-2 basis-1/2 flex gap-3 justify-center items-center border-[#ECEEF6] border-[1px] text-[#F56464] rounded-[7px] shadow-lg" id="reject" onclick="document.getElementById('rejectionMsgDiv').style.display = 'flex';">
							<span id="rejectSpan">Reject</span>
						</button>
						<button class="p-2 basis-2/3 hidden justify-center items-center border-[#ECEEF6] border-[1px] text-[#F56464] rounded-[7px] shadow-lg" id="cancelled" onclick="setAppointment(this.id)">
							<span class="">&#10799; Cancel appointment</span>
						</button>

						<form id="appointment-approved" class="hidden" action="{{ route('business.appointments.index') }}" method="post">
							@csrf
							@method('PATCH')
							<input type="text" name="apt_status" value="{{ \App\Models\Appointments::APPOINTMENT_APPROVED }}" hidden>
						</form>
						<form id="appointment-rejected" class="hidden" action="{{ route('business.appointments.index') }}" method="post">
							@csrf
							@method('PATCH')
							<input type="text" name="apt_status" value="{{ \App\Models\Appointments::APPOINTMENT_REJECTED }}" hidden>
						</form>
					</section>

					{{-- reject appointment message --}}
					<div class="w-full px-2 hidden {{-- flex --}} flex-col gap-2" id="rejectionMsgDiv">
						<textarea required class="w-full border-none px-2 py-1 bg-dirtywhite rounded-[4px]" name="shop_aboutUs[desc]" id="" rows="5" placeholder="State the reason why you rejected the appointment."></textarea>

						<div class="flex flex-row gap-2 items-center" id="rejectTextareaDiv">
							<button class="business-label-as-button bg-{{ $site_settings->site_color_theme }} w-full h-full gap-1 bg-white text-status-red shadow-lg" id="cancelRejection"
								onclick="document.getElementById('rejectionMsgDiv').style.display = 'none';">
								<span>Cancel</span>
							</button>
							<button class="business-label-as-button bg-{{ $site_settings->site_color_theme }} w-full h-full gap-1 shadow-lg" id="rejected" onclick="setAppointment(this.id)">
								<span>Send & Confirm Rejection</span>
							</button>
						</div>
					</div>
				</section>

				{{-- this section will be displayed(block) if the shop approves the appointment request --}}
				{{-- repair status --}}
				<section class="mx-2 pt-2 border-t-[2px] hidden" id="repairStatusSection">
					<div class="mb-2 text-darkblue font-semibold">
						<h2>REPAIR STATUS</h2>
					</div>

					{{-- repair status dropdown --}}
					<div class="w-full p-2 mb-2 border-[1px] bg-white text-white rounded-[7px] shadow-lg ease-in-out duration-200" id="repairStatusDropdown">
						@php
							$_repairStats_except = [\App\Models\Appointments::REPAIR_COMPLETED, \App\Models\Appointments::REPAIR_FAILED];
							$_repairStats_check = !Str::contains($apt->repair_status,$_repairStats_except) ? true : false;
							$_repairStats = $_repairStats_check ? __('repairStatusCheckBox') : null;
						@endphp
						<label class="flex gap-[20px] flex-row justify-center items-center cursor-pointer" for="{{ $_repairStats }}" onclick="{{ $_repairStats_check ? __('repairStatusDropdown()') : null }}">
							<span id="repairStatusButton">Not yet started</span>
							<i class="fa-solid fa-chevron-down"></i>
						</label>

						{{-- repair status list --}}
						<div class="w-full p-[10px] hidden" id="repairStatusList">
							<div class="w-full flex flex-col justify-between">
								@foreach (config('enums.repair_status') as $key => $rpr)
									@if ($loop->iteration != 5)
										<button class="mt-[10px] first:mt-0 p-2 bg-[#F9F9F9] {{ config('enums.repair_status_colors')[$key] }} rounded-[7px] shadow-lg" id="repStats{{ $loop->iteration }}" onclick="changeRepairStatus(this.id)">
											{{ $rpr }}
										</button>
										<form id="repair-repStats{{ $loop->iteration }}" action="{{ route('business.appointments.index') }}" method="post" class="hidden">
											@csrf
											@method('PATCH')
											<input type="text" name="rpr_status" value="{{ $key }}" hidden>
										</form>
									@else
										<button class="mt-[10px] first:mt-0 p-2 bg-[#F9F9F9] {{ config('enums.repair_status_colors')[$key] }} rounded-[7px] shadow-lg" id="" onclick="document.getElementById('failedRepairMsgDiv').style.display = 'flex';">
											{{ $rpr }}
										</button>
									@endif
								@endforeach
							</div>
						</div>
					</div>

					{{-- failed message panel --}}
					<div class="w-full self-center hidden {{-- flex --}} flex-col gap-2" id="failedRepairMsgDiv">
						<textarea required class="w-full border-none px-2 py-1 bg-dirtywhite rounded-[4px] focus:ring-{{$site_settings->site_color_theme}}" name="shop_aboutUs[desc]" id="" rows="5" placeholder="State the reason of the failure."></textarea>

						<div class="flex flex-row gap-2 items-center" id="cancelTextareaDiv">
							<button class="business-label-as-button bg-{{ $site_settings->site_color_theme }} w-full h-full gap-1 bg-white text-status-red shadow-lg" onclick="document.getElementById('failedRepairMsgDiv').style.display = 'none';">
								<span>Cancel</span>
							</button>
							<button class="business-label-as-button bg-{{ $site_settings->site_color_theme }} w-full h-full gap-1 shadow-lg" id="repStats5" onclick="changeRepairStatus(this.id)">
								<span>Confirm</span>
							</button>
							<form id="repair-repStats5" action="{{ route('business.appointments.index') }}" method="post" class="hidden">
								@csrf
								@method('PATCH')
								<input type="text" name="rpr_status" value="4" hidden>
							</form>
						</div>
					</div>
					@if (false)
						{{-- activity logs section --}}
						<section class="my-[20px]">
							<div onclick="activityLogsDropdown()">
								<label class="flex flex-row justify-between items-center text-darkblue text-[14px]" for="activityLogsCheckbox">
									<h2 class="font-semibold">ACTIVITY LOGS</h2>
									<i class="fa-solid fa-chevron-right"></i>
								</label>
							</div>

							{{-- activity logs --}}
							<ul class="min-h-[30px] xl:min-h-[30px] max-h-[135px] xl:max-h-[171px] mt-[10px] px-[5px] list-none overflow-y-auto" id="activityLogsList">
								<li class="mt-[5px] first:mt-0 last:mb-0 text-[9px] 2xl:text-[13px]">
									<div class="flex gap-2 justify-start items-center">
										{{-- icon --}}
										<div class="w-[30px] h-[30px] p-[5px] bg-{{ $site_settings->site_color_theme }} rounded-full">
											<div class="w-full h-full flex justify-center items-center bg-white text-{{ $site_settings->site_color_theme }} rounded-full">
												<i class="fa-solid fa-wrench w-1/2 h-1/2"></i>
											</div>
										</div>
										{{-- log --}}
										<div class="flex flex-col justify-center">
											{{-- time --}}
											<span>HH:MM</span>
											{{-- message log --}}
											<span class="font-semibold">Repair has started</span>
										</div>
									</div>
								</li>

								{{-- if there are no logs yet --}}
								{{-- <li class="flex justify-center items-center text-darkblue text-[9px] 2xl:text-[13px]">
							<span>No logs occurred</span>
						</li> --}}
							</ul>
						</section>
					@endif
				</section>
			</section>
		</div>
	@else
		{{-- canceled appointment --}}
		<div class="business-whitecard-bg 2xl:w-1/2 2xl:order-last 2xl:h-fit mx-4 mb-2 overflow-y-hidden">
			{{-- card title --}}
			<button class="flex flex-row justify-between items-center text-darkblue font-semibold" onclick="collapseCards('noticeCard')">
				<h2>APPOINTMENT CANCELED</h2>
				<i class="fa-solid fa-chevron-down"></i>
			</button>

			{{-- card main content --}}
			<section class="block" id="noticeCard">
				<section class="mb-0 grow flex gap-2 flex-col justify-between items-center" id="noticeSection">

					{{-- Accept and reject buttons --}}
					<section class="px-2 w-full flex gap-1 flex-row">
						<div class="flex flex-row">
							<div class="">
								<h3 class="text-gray">Reason:</h3>
								<textarea class="text-black">{{ $apt->reason }}</textarea>
							</div>
						</div>
					</section>
				</section>
			</section>
		</div>
	@endif

	{{-- customer, product, concern details, and reviews section --}}
	<section class="2xl:basis-3/5">
		{{-- Customer details --}}
		<div class="business-whitecard-bg mx-4 mb-2 overflow-y-hidden">
			{{-- card title --}}
			<button class="flex flex-row justify-between items-center text-darkblue font-semibold" onclick="collapseCards('customerDetailsCard')">
				<h2>CUSTOMER DETAILS</h2>
				<i class="fa-solid fa-chevron-down"></i>
			</button>

			{{-- card main content --}}
			<div class="flex gap-2 flex-col" id="customerDetailsCard">
				{{-- full name --}}
				<div class="flex flex-row">
					<div class="basis-1/2">
						<h3 class="text-gray">First Name:</h3>
						<h3 id="appointment-user-firstname" class="text-black">{{ $apt->user->firstname }}</h3>
					</div>
					<div class="basis-1/2">
						<h3 class="text-gray">Last Name:</h3>
						<h3 id="appointment-user-lastname" class="text-black">{{ $apt->user->lastname }}</h3>
					</div>
				</div>

				{{-- phone number --}}
				<div class="">
					<div class="flex flex-row">
						<div class="basis-1/2">
							<h3 class="text-gray">Phone Number:</h3>
							<h3 id="appointment-user-contact" class="text-black">{{ $apt->user->contact }}</h3>
						</div>
						<div id="contact-alt" class="basis-1/2">
							<h3 class="text-gray">Alternate Contact Number:</h3>
							<h3 id="appointment-user-contact-alt" class="text-black">{{ $apt->alt_contact ?? __('undefined') }}</h3>
						</div>
					</div>
				</div>

				{{--
				<div class="">
					<div class="text-[11px] 2xl:text-[16px]">
						<h3 class="text-gray">Address:</h3>
						<h3 id="appointment-user-address" class="text-black">000 Some Street, brgy. Some, Some City, Some Province</h3>
					</div>
				</div> --}}
			</div>
		</div>

		{{-- Product details --}}
		<div class="business-whitecard-bg mx-4 mb-2 overflow-y-hidden">
			{{-- card title --}}
			<button class="flex flex-row justify-between items-center text-darkblue font-semibold" onclick="collapseCards('productDetailsCard')">
				<h2>PRODUCT DETAILS</h2>
				<i class="fa-solid fa-chevron-down"></i>
			</button>

			{{-- card main content --}}
			<div class="flex gap-2 flex-col" id="productDetailsCard">
				{{-- Category and brand --}}
				<div class="flex flex-row">
					<div class="basis-1/2">
						<h3 class="text-gray">Category:</h3>
						<h3 id="appointment-category" class="text-black">{{ $apt->product_details['category'] ?? __('undefined') }}
						</h3>
					</div>
					<div class="basis-1/2">
						<h3 class="text-gray">Brand:</h3>
						<h3 id="appointment-brand-name" class="text-black">
							{{ $apt->product_details['product_brand'] ?? __('undefined') }}</h3>
					</div>
				</div>

				<div class="flex flex-row">
					{{-- Model name --}}
					<div class="basis-1/2">
						<h3 class="text-gray">Model Name:</h3>
						<h3 id="appointment-model-name" class="text-black">{{ $apt->product_details['model_name'] ?? __('undefined') }}
						</h3>
					</div>
					{{-- Model number --}}
					<div class="basis-1/2">
						<h3 class="text-gray">Model Number:</h3>
						<h3 id="appointment-model-number" class="text-black">
							{{ $apt->product_details['model_number'] ?? __('undefined') }}</h3>
					</div>
				</div>

			</div>
		</div>

		{{-- Concern details --}}
		<div class="business-whitecard-bg mx-4 mb-2 overflow-y-hidden">
			<button class="flex flex-row justify-between items-center text-darkblue font-semibold" onclick="collapseCards('concernDetailsCard')">
				{{-- card title --}}
				<h2>CONCERN DETAILS</h2>
				<i class="fa-solid fa-chevron-down"></i>
			</button>

			{{-- card main content --}}
			<div class="flex gap-2 flex-col" id="concernDetailsCard">
				{{-- Issue --}}
				<div class="">
					<h3 class="text-gray">Issue:</h3>
					<p id="appointment-concern" class="text-black leading-relaxed">
						{{ $apt->concern ?? __('undefined') }}
					</p>
				</div>

				{{-- Attachment --}}
				<div class="">
					<h3 class="text-gray">Attachment:</h3>

					{{-- some code snippet here for attachments --}}
					<div class="flex gap-1 flex-row overflow-x-auto" onclick="">
						@foreach ($apt->product_details['files'] as $file)
							<div class="w-[60px] h-[60px] overflow-hidden">
								<a class="glightbox" data-gallery="attachmentsGallery" href="{{ asset("/storage/{$apt->appointmentId}/file/{$file}/type/appointments") }}">
									<img class="object-cover w-[60px] h-[60px]" src="{{ asset("/storage/{$apt->appointmentId}/file/{$file}/type/appointments") }}" alt="{{ $file }}">
								</a>
							</div>
						@endforeach
					</div>

					<script>
						var glightbox = GLightbox();
					</script>
				</div>
			</div>
		</div>

		{{-- Review details --}}
		@if ($review)
			<div class="business-whitecard-bg mx-4 mb-4 overflow-y-hidden">
				{{-- card title --}}
				<button class="flex flex-row justify-between items-center text-darkblue font-semibold" onclick="collapseCards('reviewDetailsCard')">
					<h2>REVIEW DETAILS</h2>
					<i class="fa-solid fa-chevron-down"></i>
				</button>

				{{-- card main content --}}
				<div class="flex gap-2 flex-col" id="reviewDetailsCard">
					{{-- top part --}}
					<div class="flex flex-row gap-2 items-center">
						{{-- stars --}}
						<div class="flex flex-row gap-1 justify-around items-center text-{{ $site_settings->site_color_theme }}">
							<x-star-ratings :ratings="$review->ratings" />
						</div>

						<span class="italic">{{ $review->created_at->format('M d, o - h:i A') }}</span>
					</div>

					<p>
						{{ $review->message }}
					</p>
				</div>
			</div>
		@endif
	</section>
</section>

@if ($apt->repair_status == \App\Models\Appointments::REPAIR_NOT_STARTED && $apt->appointment_status == \App\Models\Appointments::APPOINTMENT_APPROVED)
	<div class="bottom-0 p-2 w-full sticky flex flex-col gap-2 justify-center bg-white border-t-[1px]">
		<button id="cancel" onclick="document.getElementById('cancellationMsgDiv').style.display = 'flex';" class="w-3/4 self-center py-2 bg-status-red text-white text-[14px] rounded-[8px]">
			<span class="m-auto text-center">Cancel Appointment</span>
		</button>

		{{-- cancel message panel --}}
		<form class="w-3/4 self-center hidden {{-- flex --}} flex-col gap-2" id="cancellationMsgDiv"
			action="{{ route('business.appointments.status', ['id' => $apt->appointmentId, 'status' => \App\Models\Appointments::APPOINTMENT_CANCELED]) }}" method="post">
			@csrf
			@method('PATCH')
			<input type="text" name="apt_status" value="{{ \App\Models\Appointments::APPOINTMENT_CANCELED }}" hidden>
			<textarea required class="w-full border-none px-2 py-1 bg-dirtywhite rounded-[4px] focus:ring-{{$site_settings->site_color_theme}}" name="cancel_reason" rows="5" placeholder="State the reason why you will cancel the appointment."></textarea>

			<div class="flex flex-row gap-2 items-center" id="cancelTextareaDiv">
				<button class="business-label-as-button bg-{{ $site_settings->site_color_theme }} w-full h-full gap-1 bg-white text-status-red shadow-lg" onclick="document.getElementById('cancellationMsgDiv').style.display = 'none';">
					<span>Cancel</span>
				</button>
				<button class="business-label-as-button bg-{{ $site_settings->site_color_theme }} w-full h-full gap-1 shadow-lg" id="canceled" onclick="setAppointment(this.id)">
					<span>Send & Confirm Cancellation</span>
				</button>
			</div>
		</form>
	</div>
@endif

{{-- show billing btn if repair is completed and has no existing billing yet --}}
@if ($apt->repair_status == \App\Models\Appointments::REPAIR_COMPLETED && !$apt->billing)
	{{-- proceed to billing button --}}
	<div class="bottom-0 p-2 w-full sticky flex justify-center bg-white border-t-[1px]" id="proceedToBillingButton">
		<label class="w-3/4 p-2 flex flex-row justify-center items-center bg-status-green text-white text-[14px] rounded-[7px] cursor-pointer" for="proceedToBillingCheckbox"
			onclick="location.href='{{ route('business.appointments.billing.create', $apt->appointmentId) }}'">
			<span>Proceed to billing &#10095;</span>
		</label>
	</div>
@endif

@if ($apt->billing)
	{{-- proceed to billing button --}}
	<div class="bottom-0 p-2 w-full sticky flex justify-center bg-white border-t-[1px]" id="proceedToBillingButton">
		<label class="w-3/4 p-2 flex flex-row justify-center items-center bg-status-green text-white text-[14px] rounded-[7px] cursor-pointer" for="proceedToBillingCheckbox"
			onclick="location.href='{{ route('business.reports.invoice.show', ['type' => 'billing', 'id' => $apt->billing->billingId]) }}'">
			<span>View Invoice &#10095;</span>
		</label>
	</div>
@endif
