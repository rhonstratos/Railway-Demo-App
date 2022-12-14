<?php

namespace App\Actions\Customer\Appointments;

use App\Http\Requests\Customer\AppointmentRequest;
use App\Models\Appointments;
use App\Models\Shop;
use Auth;
use Carbon\Carbon;

class StoreAppointment
{
	public function __construct(
		private Shop $shop,
		private Appointments $appointment,
	) {
	}
	public function execute(AppointmentRequest $request)
	{
		$apt_id = uniqid();
		while (Appointments::where('appointmentId', '=', $apt_id)->exists()) {
			$apt_id = uniqid();
		}
		$fileNames = $this->getFileNames($request, $apt_id);

		return Appointments::create([
			'appointmentId' => $apt_id,
			'user_id' => Auth::id(),
			'shop_id' => Shop::first()->id,
			'alt_contact' => $request->alt_contact,
			'product_details' => [
				'product_brand' => $request->product_brand,
				'model_name' => $request->model_name,
				'model_number' => $request->model_num,
				'category' => $request->category,
				'files' => $fileNames,
			],
			'concern' => $request->concern,
			// 'appointment_date_time' => Carbon::createFromFormat('o-m-d h:i A', $request->date . ' ' . $request->time),
			'appointment_date_time' => Carbon::parse($request->date . ' ' . $request->time),
			'appointment_status' => Appointments::APPOINTMENT_PENDING,
			'repair_status' => Appointments::REPAIR_NOT_STARTED,
		]);
	}

	private function getFileNames(AppointmentRequest $request, $apt_id)
	{
		$arr = [];

		// foreach ($request->file('files') as $image) {
		// 	array_push($arr, $image->getClientOriginalName());
		// }
		foreach ($request->file('files') as $image) {
			$destinationPath = "appointments/{$apt_id}";
			// $filename = $image->getClientOriginalName();
			// $image->storeAs($destinationPath, $filename);
			array_push($arr, pathinfo($image->store($destinationPath))['basename']);
		}

		return $arr;
	}
}
