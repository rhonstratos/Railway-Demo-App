<?php

namespace App\Actions\Business\Reports;

use App\Models\Billing;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FilteredView
{
	public function execute(Request $request)
	{
		$_appointmentsSales = Billing::query();
		$_ordersSales = Orders::query();
		switch ($request->filter) {
			case '7':
				$_appointmentsSales
					->whereBetween('created_at', [
						Carbon::today()->subDays(7),
						Carbon::now(),
					]);
				$_ordersSales
					->where('status', Orders::STATUS_COMPLETED)
					->whereBetween('created_at', [
						Carbon::today()->subDays(7),
						Carbon::now(),
					]);
				break;
			case '30':
				$_appointmentsSales
					->whereBetween('created_at', [
						Carbon::now()->subDays(30),
						Carbon::now(),
					]);
				$_ordersSales
					->where('status', Orders::STATUS_COMPLETED)
					->whereBetween('created_at', [
						Carbon::now()->subDays(30),
						Carbon::now(),
					]);
				break;
			case '365':
				$_appointmentsSales
					->whereBetween('created_at', [
						Carbon::now()->subDays(365),
						Carbon::now(),
					]);
				$_ordersSales
					->where('status', Orders::STATUS_COMPLETED)
					->whereBetween('created_at', [
						Carbon::now()->subDays(365),
						Carbon::now(),
					]);
				break;
			case 'all':
				$_ordersSales
					->where('status', Orders::STATUS_COMPLETED);
				break;
			case 'month-now':
				$_appointmentsSales
					->whereBetween('created_at', [
						Carbon::now()->startOfMonth(),
						Carbon::now()->endOfMonth(),
					]);
				$_ordersSales
					->where('status', Orders::STATUS_COMPLETED)
					->whereBetween('created_at', [
						Carbon::now()->startOfMonth(),
						Carbon::now()->endOfMonth(),
					]);
				break;
			case 'month-last':
				$_appointmentsSales
					->whereBetween('created_at', [
						Carbon::now()->subMonth()->startOfMonth(),
						Carbon::now()->subMonth()->endOfMonth(),
					]);
				$_ordersSales
					->where('status', Orders::STATUS_COMPLETED)
					->whereBetween('created_at', [
						Carbon::now()->subMonth()->startOfMonth(),
						Carbon::now()->subMonth()->endOfMonth(),
					]);
				break;
			case 'year':
				$_appointmentsSales
					->whereBetween('created_at', [
						Carbon::now()->startOfYear(),
						Carbon::now()->endOfYear(),
					]);
				$_ordersSales
					->where('status', Orders::STATUS_COMPLETED)
					->whereBetween('created_at', [
						Carbon::now()->startOfYear(),
						Carbon::now()->endOfYear(),
					]);
				break;
			case 'decade':
				$_appointmentsSales
					->whereBetween('created_at', [
						Carbon::now()->subDecade()->startOfYear(),
						Carbon::now()->endOfYear(),
					]);
				$_ordersSales
					->where('status', Orders::STATUS_COMPLETED)
					->whereBetween('created_at', [
						Carbon::now()->subDecade()->startOfYear(),
						Carbon::now()->endOfYear(),
					]);
				break;
			default:
				$_appointmentsSales
					->whereBetween('created_at', [
						Carbon::now()->subDays(7),
						Carbon::now(),
					]);
				$_ordersSales
					->where('status', Orders::STATUS_COMPLETED)
					->whereBetween('created_at', [
						Carbon::now()->subDays(7),
						Carbon::now(),
					]);
				break;
		}

		return [
			'apt' => $_appointmentsSales->sum('total'),
			'ord' => $_ordersSales->sum('total'),
		];
	}
}
