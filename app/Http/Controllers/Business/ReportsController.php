<?php

namespace App\Http\Controllers\Business;

use App\Actions\Business\Reports as Actions;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PDF\GenerateReportController as PDF;
use App\Models\Appointments;
use App\Models\Billing;
use App\Models\Orders;
use App\Traits\Business\AuthData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReportsController extends Controller
{
	use AuthData;

	public function __construct(
		private Actions\FilteredView $filteredView,
		private Actions\FilterInvoice $filterInvoice,
		private Actions\Export $export,
		private PDF $pdf,
		private $paginationSize = 30
	)
	{
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {
			if ($request->type == 'sales')
				return $this->store($request);
			if ($request->type == 'invoices')
				return $this->searchInvoice($request);
		}
		$user = Auth::user();
		$_appointmentsSales = Billing::whereBetween('created_at', [
			Carbon::today()->subWeek(),
			Carbon::now(),
		])->sum('total');

		$_ordersSales = Orders::where('status', Orders::STATUS_COMPLETED)
			->whereBetween('created_at', [
				Carbon::today()->subWeek(),
				Carbon::now(),
			])
			->sum('total');

		$orders = Orders::where('shop_id', $user->shop->id)
			->where('status', Orders::STATUS_COMPLETED)
			->with('user')
			->orderBy('created_at', 'DESC')
			->paginate(15);

		$appointments = Billing::query()
			->with('appointment.user')
			->orderBy('created_at', 'DESC')
			->paginate(15);

		return view('pages.shop.reports')
			->with(compact('orders'))
			->with(compact('appointments'))
			->with(compact('_appointmentsSales'))
			->with(compact('_ordersSales'))
			->with($this->getAuthShopData());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		if ($request->action == 'export') {
			return $this->export($request);
		}

		// $user = Auth::user();
		// $filter = $request->filter;
		$result = $this->filteredView->execute($request);
		$_appointmentsSales = $result['apt'];
		$_ordersSales = $result['ord'];

		// $orders = Orders::where('shop_id', $user->shop->id)
		// 	->where('status', Orders::STATUS_COMPLETED)
		// 	->with('user')
		// 	->orderBy('created_at', 'DESC')
		// 	->paginate(15);

		// $appointments = Billing::query()
		// 	->with('appointment.user')
		// 	->orderBy('created_at', 'DESC')
		// 	->paginate(15);

		// return view('pages.shop.reports')
		// 	->with(compact('filter'))
		// 	->with(compact('_appointmentsSales'))
		// 	->with(compact('_ordersSales'))
		// 	->with(compact('orders'))
		// 	->with(compact('appointments'))
		// 	->with($this->getAuthShopData());

		return response()->json([
			'product' => 'Php ' . number_format((float) ($_ordersSales), 2, '.', ','),
			'appointment' => 'Php ' . number_format((float) ($_appointmentsSales), 2, '.', ','),
			'total' => 'Php ' . number_format((float) ($_ordersSales + $_appointmentsSales), 2, '.', ',')
		]);
	}

	private function export(Request $request)
	{
		$filtered = $this->export->execute($request);
		$result = collect($filtered['data']);

		if ($result->count() < 1) {
			return redirect()->back()
				->withErrors([
					'fail' => 'No results found to generate a report.'
				]);
		}

		$items = $result->sortByDesc('total');
		return $this->pdf->exportReport($items, $filtered['filter']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function showInvoice($type, $id)
	{
		switch (Str::lower($type)) {
			case 'billing':
				return $this->invoiceAppointment($id);
			case 'order':
				return $this->invoiceOrder($id);
			default:
				return abort(404);
		}
	}

	public function searchInvoice(Request $request)
	{
		$user = Auth::user();
		// $_appointmentsSales = Billing::whereBetween('created_at', [
		// 	Carbon::today()->subWeek(),
		// 	Carbon::now(),
		// ])->sum('total');

		// $_ordersSales = Orders::where('status', Orders::STATUS_COMPLETED)
		// 	->whereBetween('created_at', [
		// 		Carbon::today()->subWeek(),
		// 		Carbon::now(),
		// 	])
		// 	->sum('total');

		$result = $this->filterInvoice->execute($request, $user);
		$orders = $result['orders'];
		$appointments = $result['appointments'];
		// $filter = $result['filter'];

		// return view('pages.shop.reports')
		// 	->with(compact('filter'))
		// 	->with(compact('orders'))
		// 	->with(compact('appointments'))
		// 	->with(compact('_appointmentsSales'))
		// 	->with(compact('_ordersSales'))
		// 	->with($this->getAuthShopData());

		return response()->json([
			'appointments' =>
				view('components.business.invoice-appointment-list')
				->with(['invoice' => $appointments])
				->render(),
			'appointments_paginate' =>
				view('components.paginate-button')
				->with(['data' => $appointments])
				->render(),

			'orders' =>
				view('components.business.invoice-orders-list')
				->with(['invoice' => $orders])
				->render(),
			'orders_paginate' =>
				view('components.paginate-button')
				->with(['data' => $orders])
				->render(),
		]);

	}
	private function invoiceAppointment($id)
	{
		$bill = Billing::where('billingId', $id)
			->with('appointment.user')->firstOrFail();
		return view('pages.shop.invoices-appt-details')
			->with(compact('bill'))
			->with($this->getAuthShopData());
	}

	private function invoiceOrder($id)
	{
		$order = Orders::where('orderId', $id)
			->with(['user', 'items.product'])->firstOrFail();
		return view('pages.shop.invoices-order-details')
			->with(compact('order'))
			->with($this->getAuthShopData());
	}
}