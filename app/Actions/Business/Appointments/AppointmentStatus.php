<?php
namespace App\Actions\Business\Appointments;

use App\Models\Appointments;

class AppointmentStatus
{
	public function execute($apt, $status, $request)
	{
		if ($status == Appointments::APPOINTMENT_APPROVED) {
			$apt->appointment_status = Appointments::APPOINTMENT_APPROVED;
		}
		if ($status == Appointments::APPOINTMENT_REJECTED) {
			$apt->appointment_status = Appointments::APPOINTMENT_REJECTED;
		}
		if ($status == Appointments::APPOINTMENT_CANCELED) {
			$apt->appointment_status = Appointments::APPOINTMENT_CANCELED;
			$apt->reason = $request->cancel_reason;
		}
		return $apt->save();
	}
}
