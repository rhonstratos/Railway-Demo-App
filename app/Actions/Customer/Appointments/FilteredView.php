<?php

namespace App\Actions\Customer\Appointments;

use App\Models\Appointments;
use App\Models\Shop;
use Carbon\Carbon;
use Request;

class FilteredView
{
	public function __construct(
		private Shop $shop,
		private Appointments $appointment,
	) {
	}

	public function execute($request, $appointmentData = null)
	{
		if (str_contains($request, 'filter-')) {
			$appointmentData = $this->filterByDate($request);
		}
		if (str_contains($request, 'apt-')) {
			$appointmentData = $this->filterByAppointmentStatus($request);
		}
		if (str_contains($request, 'rpr-')) {
			$appointmentData = $this->filterByRepairStatus($request);
		}

		if(str_contains($request, 'filter-')){

		}

		// catch if fail query, show all
		if (!$appointmentData instanceof \Illuminate\Database\Eloquent\Builder) {
			$appointmentData = Appointments::select('*');
		}

		return $appointmentData
			// ->where('user_id', '=', Auth::id())
			->with('user')
			->paginate(30);
	}
	private function filterByDate($request)
	{
		if (str_contains($request, 'all')) {
			return Appointments::select('*');
		}
		if (str_contains($request, 'today')) {
			return Appointments::where(
				'appointment_date_time',
				Carbon::today()
			);
		}
		if (str_contains($request, 'tomorrow')) {
			return Appointments::where(
				'appointment_date_time',
				Carbon::tomorrow()
			);
		}
		if (str_contains($request, 'week')) {
			return Appointments::whereBetween(
				'appointment_date_time',
				[
					Carbon::today(),
					Carbon::now()->addWeek()
				]
			);
		}
		if (str_contains($request, 'month')) {
			return Appointments::whereBetween(
				'appointment_date_time',
				[
					Carbon::today(),
					Carbon::today()->addMonths()
				]
			);
		}
		if (str_contains($request, 'year')) {
			return Appointments::whereBetween(
				'appointment_date_time',
				[
					Carbon::today(),
					Carbon::today()->addYear()
				]
			);
		}
	}
	private function filterByAppointmentStatus($request)
	{
		if (str_contains($request, 'all')) {
			return Appointments::select('*');
		} else if (str_contains($request, Appointments::APPOINTMENT_APPROVED)) {
			return Appointments::where(
				'appointment_status',
				Appointments::APPOINTMENT_APPROVED
			);
		}
		if (str_contains($request, Appointments::APPOINTMENT_CANCELED)) {
			return Appointments::where(
				'appointment_status',
				Appointments::APPOINTMENT_CANCELED
			);
		}
		if (str_contains($request, Appointments::APPOINTMENT_PENDING)) {
			return Appointments::where(
				'appointment_status',
				Appointments::APPOINTMENT_PENDING
			);
		}
		if (str_contains($request, Appointments::APPOINTMENT_REJECTED)) {
			return Appointments::where(
				'appointment_status',
				Appointments::APPOINTMENT_REJECTED
			);
		}
	}
	private function filterByRepairStatus($request)
	{
		if (str_contains($request, 'all')) {
			return Appointments::select('*');
		}
		if (str_contains($request, Appointments::REPAIR_COMPLETED)) {
			return Appointments::where(
				'repair_status',
				Appointments::REPAIR_COMPLETED
			);
		}
		if (str_contains($request, Appointments::REPAIR_FAILED)) {
			return Appointments::where(
				'repair_status',
				Appointments::REPAIR_FAILED
			);
		}
		if (str_contains($request, Appointments::REPAIR_NOT_STARTED)) {
			return Appointments::where(
				'repair_status',
				Appointments::REPAIR_NOT_STARTED
			);
		}
		if (str_contains($request, Appointments::REPAIR_REPAIRING)) {
			return Appointments::where(
				'repair_status',
				Appointments::REPAIR_REPAIRING
			);
		}
		if (str_contains($request, Appointments::REPAIR_WAITING_PARTS)) {
			return Appointments::where(
				'repair_status',
				Appointments::REPAIR_WAITING_PARTS
			);
		}
	}
}
