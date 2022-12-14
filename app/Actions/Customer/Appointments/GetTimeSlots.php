<?php

namespace App\Actions\Customer\Appointments;

use App\Models\Appointments;
use App\Models\Shop;
use Carbon\Carbon;

class GetTimeSlots
{
	public function __construct(
		private Shop $shop,
		private Appointments $appointment,
	) {
	}
	public function execute(string|array $date): \Illuminate\Http\JsonResponse
	{
		$queryDate = Carbon::parse(
			// 'm/d/yy',
			// 'd/m/yy',
			$date
		);

		if ($queryDate->lte(Carbon::now())) {
			return response()->json(
				[
					'400' => 'Bad Request',
					'message' => 'You must pick a date tomorrow or beyond.'
				],
				400
			);
		}

		$intervals = $this->query($queryDate->toDateString());

		return !empty($intervals)
			? response()->json($intervals)
			: response()->json(
				[
					'400' => 'Bad Request',
					'message' => 'The date you picked is already full of appointments, pick another date.'
				],
				400
			);
	}

	private function query($queryDate)
	{
		$appointmentSettings = $this->shop
			->firstOrFail()
			->appointment_settings;

		$accomodation_slots = $appointmentSettings['accomodation_slots'];

		$start = Carbon::parse($appointmentSettings['operatingHours']['start']);
		$end = Carbon::parse($appointmentSettings['operatingHours']['end']);
		$interval_hour = $appointmentSettings['accomodation_interval']['hours'];
		$interval_minutes = $appointmentSettings['accomodation_interval']['minutes'];
		$intervals = [];

		while ($start->lessThan($end)) {
			$timeDateQuery = Carbon::createFromFormat('yy-m-d H:i:s', $queryDate . ' ' . $start->toTimeString());
			$timeSlot = $this->appointment
				->whereBetween(
					'appointment_date_time',
					[$timeDateQuery, $timeDateQuery]
				)
				->get()->count();
			// dump($start->toTimeString(),$timeSlot);
			if (!($timeSlot >= $accomodation_slots)) {
				array_push($intervals, $start->format('h:i A'));
			}
			$start->addHours((int)$interval_hour)
				->addMinutes((int)$interval_minutes);
		}

		return $intervals;
	}
}
