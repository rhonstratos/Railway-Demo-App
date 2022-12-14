@props(['appointment'])
<li class="p-2 border-[2px] flex flex-row justify-center items-center gap-2 rounded-[4px] cursor-pointer" onclick="location.href='{{ route('business.appointments.index') }}'">
	{{-- profile pic --}}
	<div class="">
		@php
			$_apt_user = $appointment->user->accountSettings->profile_img;
			$_userImg = !is_null($_apt_user) ? asset('storage/users/' . $appointment->user->userId . '/images/profile/' . $_apt_user) : asset('assets/master/placeholders/poggy.png');
		@endphp
		<a class="glightbox" data-gallery="" href="{{ $_userImg }}">
			<img class="object-cover w-[75px] h-[75px] rounded-full" src="{{ $_userImg }}" alt="img">
		</a>
	</div>

	{{-- some information --}}
	<div class="flex flex-col gap-2 justify-between items-center truncate">
		<div class="flex flex-col gap-2 justify-center items-center">
			<span class="text-[18px] xl:text-[20px] max-w-[180px] sm:max-w-[400px] md:max-w-[500px] lg:max-w-[250px] 2xl:max-w-[350px] truncate">
				{{ $appointment->user->firstname . ' ' . $appointment->user->lastname }}
			</span>
			<span class="px-4 max-w-[180px] sm:max-w-[400px] md:max-w-[500px] lg:max-w-[250px] 2xl:max-w-[350px] truncate">
				{{ \Carbon\Carbon::parse($appointment->appointment_date_time)->format('D, M d, o') }}
				at
				{{ \Carbon\Carbon::parse($appointment->appointment_date_time)->format('h:i A') }}
			</span>
		</div>

		<span class="max-w-[180px] sm:max-w-[400px] md:max-w-[500px] lg:max-w-[250px] 2xl:max-w-[350px] truncate">
			Appt. ID: {{ $appointment->appointmentId }}
		</span>

		<span class="max-w-[180px] sm:max-w-[400px] md:max-w-[500px] lg:max-w-[250px] 2xl:max-w-[350px] truncate">
			Phone number: {{ $appointment->user->contact }}
			@if ($appointment->alt_contact)
				<br>
				Alternative Phone number: {{ $appointment->alt_contact }}
			@endif
		</span>
	</div>
</li>
