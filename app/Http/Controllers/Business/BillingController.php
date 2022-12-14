<?php

namespace App\Http\Controllers\Business;

use App\Actions\Business\Billing\StoreBilling;
use App\Http\Controllers\Controller;
use App\Http\Requests\Business as BusinessRequests;
use App\Models\Appointments;
use App\Models\User;
use App\Traits\Business\AuthData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillingController extends Controller
{
	use AuthData;

	public function __construct(
		private StoreBilling $storeBilling
	) {
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Appointments $appointment)
	{
		// dump($appointment->toArray());
		return view('pages.shop.appointments-billing')
			->with(compact('appointment'))
			->with($this->getAuthShopData());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Appointments $appointment, BusinessRequests\BillingRequest $request)
	{
		// dd($appointment->toArray(), $request->toArray());
		try {
			DB::beginTransaction();
			$billing = $this->storeBilling->execute($appointment, $request);
			// dump($billing->toArray());
			DB::commit();
			return redirect()->route('business.appointments.index')
				->with([
					'success' => 'Billing complete.'
				]);
		} catch (\Exception $err) {
			DB::rollBack();
			return redirect()->back()->withErrors([
				'fail' => 'An unexpected error occurred, please try again.'
			]);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
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
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
