<?php

namespace App\Actions\Customer\Appointments;

use App\Models\Appointments;
use App\Models\Products;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreReview
{
	public function execute(Request $request, Appointments $appointment)
	{
		return Reviews::create([
			'user_id' => Auth::id(),
			'appointment_id' => $appointment->id,
			'message' => $request->review_message,
			'ratings' => $request->rating,
		]);
	}
}
