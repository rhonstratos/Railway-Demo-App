<?php

namespace App\Actions\Customer\Appointments;

use App\Models\Appointments;
use App\Models\Products;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CancelAppointment
{
	public function execute(Request $request, Appointments $appointment)
	{
		$appointment->appointment_status = $request->appointment_status;
		$appointment->reason = $request->reason_cancel;
		$appointment->save();
	}
}
