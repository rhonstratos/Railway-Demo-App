<?php

namespace App\Actions\Business\Reports;

use App\Models\Billing;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Export
{
	public function execute(Request $request, $filter = null)
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
				$filter = '7 Days';
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
				$filter = '30 Days';
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
				$filter = '365 Days';
				break;
			case 'all':
				$_ordersSales
					->where('status', Orders::STATUS_COMPLETED);
				$filter = 'Since the beginning';
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
				$filter = 'This month of ' . Carbon::now()->monthName;
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
				$filter = 'the month of ' . Carbon::now()->subMonth()->monthName;
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
				$filter = 'the year ' . Carbon::now()->year;
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
				$filter = 'This decade of ' . Carbon::now()->subDecade()->year . ' to ' . Carbon::now()->year;
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
				$filter = '7 Days';
				break;
		}
		$_appointmentsSales = $_appointmentsSales;
		$_ordersSales = $_ordersSales;

		return [
			'data' => $_appointmentsSales->get()->merge($_ordersSales->get())->all(),
			'filter' => $filter,
		];
	}
}
