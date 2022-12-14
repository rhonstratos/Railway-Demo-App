<?php

namespace App\Actions\Business\Billing;

use App\Http\Requests\Business\BillingRequest;
use App\Models\Appointments;
use App\Models\Billing;

class StoreBilling
{
	public function __construct(
		private Billing $billing
	) {
	}
	public function execute(Appointments $appointment, BillingRequest $request)
	{
		$id = uniqid();
		while ($this->billing->where('billingId', $id)->exists()) {
			$id = uniqid();
		}

		$items = [];
		$total = $request->repair_cost;
		foreach ($request->items as $key => $item) {
			$items[$item] = [
				'quantity' => $request->quantity[$key],
				'price' => $request->price[$key],
			];
			$total += $request->quantity[$key] * $request->price[$key];
		}

		return $this->billing->create([
			'billingId' => $id,
			'appointment_id' => $appointment->id,
			'repair_remarks' => $request->repair_remarks,
			'repair_cost' => $request->repair_cost,
			'items' => $items,
			'total' => $total,
		]);
	}
}
