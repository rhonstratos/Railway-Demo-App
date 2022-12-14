<?php

namespace App\Actions\Business\Reports;

use App\Models\Billing;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FilterInvoice
{
	public function execute(Request $request, $user)
	{
		$filter = [];
		$orders = Orders::where('shop_id', $user->shop->id)
			->where('status', Orders::STATUS_COMPLETED)
			->with('user');

		$appointments = Billing::query()
			->with('appointment.user');

		if (!is_null($request->review_date_start) || !is_null($request->review_date_end)) {
			$filter['review_date_start'] = $request->review_date_start;
			$filter['review_date_end'] = $request->review_date_end;
			$orders = $orders
				->whereBetween('created_at', [
					Carbon::parse($filter['review_date_start']),
					Carbon::parse($filter['review_date_end'])
				]);
			$appointments = $appointments
				->whereBetween('created_at', [
					Carbon::parse($filter['review_date_start']),
					Carbon::parse($filter['review_date_end'])
				]);
		}
		if (!is_null($request->review_search)) {
			$filter['review_search'] = $request->review_search;
			$orders = $orders
				->where('orderId', 'like', '%' . $filter['review_search'] . '%');
			$appointments = $appointments
				->where('billingId', 'like', '%' . $filter['review_search'] . '%');
		}

		$orders = $orders
			->orderBy('created_at', 'DESC')
			->paginate(15);
		$appointments = $appointments
			->orderBy('created_at', 'DESC')
			->paginate(15);
		return [
			'orders' => $orders,
			'appointments' => $appointments,
			'filter' => $filter
		];
	}
}
