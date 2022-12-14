<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Billing;
use App\Models\Orders;
use App\Models\Products;
use App\Models\User;
use App\Traits\Business\AuthData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
	use AuthData;

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$user = Auth::user();
		$orderData = Orders::with(['user'])
			->where('status', Orders::STATUS_WAITING)
			->withCount('items as items_count')
			->orderBy('created_at', 'DESC')
			->get();
		$appointmentData = Appointments::with(['user'])
			->where('appointment_status', Appointments::APPOINTMENT_PENDING)
			->whereBetween('appointment_date_time', [
				Carbon::today(), Carbon::today()->addWeek()
			])
			->orderBy('created_at', 'DESC')
			->get();

		$_ordersSales = Orders::where('status', Orders::STATUS_COMPLETED)
			->whereDate('created_at', Carbon::today())->sum('total');

		$_appointmentsSales = Billing::whereDate('created_at', Carbon::today()->subDays(6))->sum('total');

		$_ordersWeekChart = Orders::selectRaw('SUM(total) as total, DATE(created_at) as date')
			->where('status', Orders::STATUS_COMPLETED)
			->where('created_at', '>', Carbon::today()->subDays(6))
			->orderBy('date', 'DESC')
			->groupBy('date')
			->get();

		$_appointmentsWeekChart = Billing::selectRaw('SUM(total) as total, DATE(created_at) as date')
			->where('created_at', '>', Carbon::today()->subDays(6))
			->orderBy('date', 'DESC')
			->groupBy('date')
			->get();

		$salesToday = $_appointmentsSales + $_ordersSales;
		$totalUsers = User::where('id', '!=', $user->id)->count('id');

		$products = Products::join('inventories', function ($q) {
			$q->on('inventories.inventoriable_id', '=', 'products.id')
				->where('inventoriable_type', Products::class)
				->latest('id');
		})->where('inventories.quantity', '<', '10')->get();

		$_ord = [];
		$_apt = [];
		foreach ($_ordersWeekChart->toArray() as $flip) {
			$_ord[$flip['date']] = $flip['total'];
		}
		foreach ($_appointmentsWeekChart->toArray() as $flip) {
			$_apt[$flip['date']] = $flip['total'];
		}

		$numberOfDays = Carbon::today()->diffInDays(Carbon::today()->subDays(6));
		$_total = Arr::map(range(0, $numberOfDays), function ($v, $k) {
			return Carbon::today()->copy()->subDays($v)->toDateString();
		});
		$_total = array_flip($_total);
		ksort($_total);

		foreach ($_total as $_i => $_days) {
			$_total[$_i] = (float) 0;
			$_total[$_i] = isset($_ord[$_i]) && !is_null($_ord[$_i]) ? (float) $_total[$_i] + (float) $_ord[$_i] : (float) $_total[$_i];
			$_total[$_i] = isset($_apt[$_i]) && !is_null($_apt[$_i]) ? (float) $_total[$_i] + (float) $_apt[$_i] : (float) $_total[$_i];
		}
		$this_week_sales_chart = Arr::map($_total, fn($v, $k) => ['date' => $k, 'total' => $v]);
		$this_week_sales_chart = array_values($this_week_sales_chart);
		// dd($this_week_sales_chart);
		return view('pages.shop.dashboard')
			->with($this->getAuthShopData())
			->with(compact('products'))
			->with(compact('this_week_sales_chart'))
			->with(compact('salesToday'))
			->with(compact('totalUsers'))
			->with(compact('orderData'))
			->with(compact('appointmentData'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return abort(404);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		return abort(404);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		return abort(404);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		return abort(404);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		return abort(404);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		return abort(404);
	}
	public function showOrder()
	{
		return view('pages.shop.order');
	}
}
