@props(['appointments'])
@forelse($appointments as $key => $data)
	{{-- kay rhon to --}}
	<li class="border-dirtywhite dark:border-dirtywhite sm:border-b-[1px] my-[5px] sm:my-1 font-bold cursor-pointer" onclick="getAppointment('{{ $data->appointmentId }}')">
		<div class="min-h-[45px] mx-4 sm:mx-0 flex flex-row bg-white dark:bg-black sm:bg-transparent shadow-lg sm:shadow-none rounded-[10px] sm:rounded-none overflow-hidden">
			{{-- NOTE
																													* on first flexbox: name, date and time
																													* on second flexbox: contact number, appointment status and repair status
																									--}}
			{{-- item number --}}
			<div class="basis-[5%] hidden sm:flex justify-center items-center text-black dark:text-dirtywhite">
				<span>{{ $appointments->firstItem() + $key }}</span>
			</div>

			{{-- the div with an appointment status border color --}}
			<div class="basis-1/2 sm:basis-[23.75%] md:basis-[38%] lg:basis-[47.5%] pl-[6px] sm:px-0 pt-[6px] pb-[3px] border-status-bluegreen border-b-[3px] sm:border-b-0 flex flex-col md:flex-row justify-center items-center" id="apptStatus">
				{{-- name --}}
				<div class="basis-1/2 lg:basis-1/3 flex md:justify-center items-center text-black dark:text-dirtywhite">
					<span>{{ $data->user->firstname }} {{ $data->user->lastname }}</span>
				</div>

				{{-- date and time --}}
				<div class="basis-1/2 lg:basis-2/3 md:order-first flex gap-1 md:justify-center flex-row items-center text-black dark:text-dirtywhite text-[11px] lg:text-[14px] 2xl:text-[16px]">
					<span
						class="lg:basis-1/2 lg:flex lg:justify-center">{{ date(
						    'h:i
																																																																																																																																																														A',
						    strtotime($data->appointment_date_time),
						) }}</span>
					<span
						class="lg:basis-1/2 lg:flex lg:justify-center">{{ date(
						    'M d,
																																																																																																																																																														Y',
						    strtotime($data->appointment_date_time),
						) }}</span>
				</div>
			</div>

			{{-- the div with an repair status border color --}}
			<div class="basis-1/2 sm:basis-[71.25%] md:basis-[57%] lg:basis-[47.5%] pr-[6px] sm:px-0 pt-[6px] pb-[3px] border-grayer-light border-b-[3px] sm:border-b-0 flex flex-row justify-center sm:justify-start items-center" id="repairStatus">
				{{-- contact number --}}
				<div class="basis-3/4 sm:basis-1/3 flex justify-center items-center text-black dark:text-dirtywhite">
					<i>{{ $data->user->contact }}</i>
				</div>
				{{-- Appointment status and Repair status on desktop --}}
				<div class="hidden basis-2/3 sm:flex gap-1 flex-row justify-center items-center text-dirtywhite dark:text-dirtywhite">
					<div class="basis-1/2 flex justify-center {{ config('enums.appointment_status_colors')[$data->appointment_status] }}">
						<span>{{ config('enums.appointment_status')[$data->appointment_status] }}</span>
					</div>
					<div class="basis-1/2 flex justify-center {{ config('enums.repair_status_colors')[$data->repair_status] }}">
						<span>{{ config('enums.repair_status')[$data->repair_status] }}</span>
					</div>
				</div>
			</div>
		</div>
	</li>
@empty
	<li class="border-dirtywhite text-center dark:border-dirtywhite my-[5px] sm:my-0">
		<h2>No appointments yet</h2>
	</li>
@endforelse
