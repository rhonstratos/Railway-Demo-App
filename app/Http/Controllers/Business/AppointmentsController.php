<?php

namespace App\Http\Controllers\Business;

use App\Actions\Business\Appointments as Actions;
use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Reviews;
use App\Traits\Business\AuthData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentsController extends Controller
{
	use AuthData;

	public function __construct(
		private Actions\AppointmentStatus $appointmentStatus
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
			return $this->advanceSearch($request);
		}
		$appointmentData = Appointments::where('shop_id', Auth::id())
			->where('appointment_status', '!=', Appointments::APPOINTMENT_CANCELED)
			->where('appointment_status', '!=', Appointments::APPOINTMENT_REJECTED)
			->where('repair_status', '!=', Appointments::REPAIR_COMPLETED)
			->orderBy('appointment_date_time', 'ASC')
			->paginate(30);

		return view('pages.shop.appointments')
			->with($this->getAuthShopData())
			->with(compact('appointmentData'));
	}
	public function fetchAppointment(Appointments $id)
	{
		$review = Reviews::where('appointment_id', $id->id)->first();
		return response()->json([
				view('components.business.appointment-form', [
					'apt' => $id,
					'review' => $review ?? null
				])->render(),
			'apt-status' => $id->appointment_status,
			'rpr-status' => $id->repair_status,
		]);


		// return view('components.business.appointment-form', [
		//     'apt' => $id
		// ]);
	}

	public function invoices()
	{
		return view('pages.shop.invoices')
			->with($this->getAuthShopData());
	}

	public function review()
	{
		// dump(
		// 	\App\Models\Products::query()->with('inventories', 'shop')->get()->toArray()
		// );

		return view('pages.shop.appointments-review')
			->with($this->getAuthShopData());
	}

	public function advanceSearch(Request $request)
	{
		// dd($request->toArray());
		$filter = ['search', 'review_date_start', 'review_date_end', 'appointment_status', 'repair_status'];
		$appointmentData = Appointments::where('shop_id', Auth::id());

		if (!is_null($request->search)) {
			$filter['search'] = $request->search;
			$appointmentData = $appointmentData
				->where('appointmentId', $request->search . '%')
				->with([
					'user' => function ($q) use ($request) {
				        return $q->orWhere(DB::raw('concat(firstname,lastname)'), 'like', '%' . $request->search . '%');
			        }
				]);
		}
		if (!is_null($request->review_date_start) || !is_null($request->review_date_end)) {
			$filter['review_date_start'] = $request->review_date_start;
			$filter['review_date_end'] = $request->review_date_end;
			$appointmentData = $appointmentData
				->whereBetween('appointment_date_time', [
					Carbon::parse($request->review_date_start),
					Carbon::parse($request->review_date_end)
				]);
		}
		if (!is_null($request->appointment_status)) {
			$filter['appointment_status'] = $request->appointment_status;
			$appointmentData = $appointmentData->where('appointment_status', $request->appointment_status);
		}
		if (!is_null($request->repair_status)) {
			$filter['repair_status'] = $request->repair_status;
			$appointmentData = $appointmentData->where('repair_status', $request->repair_status);
		}

		$appointmentData = $appointmentData->orderBy('appointment_date_time', 'ASC')
			->paginate(30);

		// return view('pages.shop.appointments')
		// 	->with($this->getAuthShopData())
		// 	->with(compact('filter'))
		// 	->with(compact('appointmentData'));

		return response()->json([
			'list' =>
				view('components.business.appointment-list')
				->with(['appointments' => $appointmentData])
				->render(),
			'paginate' =>
				view('components.paginate-button')
				->with(['data' => $appointmentData])
				->render(),
		]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Appointments  $appointments
	 * @return \Illuminate\Http\Response
	 */
	public function show(Appointments $appointment)
	{
		$user = $appointment->user->only(
			'birthday',
			'contact',
			'email',
			'firstname',
			'lastname'
		);
		$result = $appointment->toArray();
		$result['appointment_date'] = $result['appointment_date_time']->toDateString();
		$result['appointment_time'] = $result['appointment_date_time']->toTimeString();
		// dd($result);
		return response()->json([
			'appointment_data' => $result,
			'user_data' => $user
		]);
	}

	public function filter(Request $request, $filterBy)
	{
		// dump(uniqid());
		// dd(hexdec(uniqid()));
		$filter = now();
		switch ($filterBy) {
			case 'today':
				$filteredAppointments = Appointments::whereDate(
					'appointment_date_time',
					Carbon::today()
				)->with('user');
				break;
			case 'week':
				$filteredAppointments = Appointments::whereBetween(
					'appointment_date_time',
					[
						Carbon::now()->startOfWeek(),
						Carbon::now()->endOfWeek()
					]
				)->with('user');
				break;
			case 'month':
				$filteredAppointments = Appointments::whereBetween(
					'appointment_date_time',
					[
						Carbon::now()->startOfMonth(),
						Carbon::now()->endOfMonth()
					]
				)->with('user');
				break;
			default:
				$filteredAppointments = Appointments::select('*')->with('user');
				break;
		}
		$appointmentData = $filteredAppointments
			->orderBy('appointment_date_time', 'ASC')
			->paginate(30);

		return view('pages.shop.appointments')
			->with($this->getAuthShopData())
			->with(compact('appointmentData'))
			->with(compact('filterBy'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Appointments  $appointments
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Appointments $appointments)
	{
		dd($appointments, $request);
	}
	public function setAppointmentStatus(Request $request, $id)
	{
		try {
			$apt = Appointments::where('appointmentId', $id)->firstOrFail();
			$status = $request->apt_status;
			DB::beginTransaction();
			$this->appointmentStatus->execute($apt, $status, $request);
			DB::commit();
			// dump($status, $apt, $request->only('appointment-action')['appointment-action']);
			// dd('hit');
			return redirect()->route('business.appointments.index');
		} catch (\Exception $err) {
			DB::rollBack();
			return abort(500);
		}
	}

	public function setRepairStatus(Request $request, $id)
	{
		$complete = false;
		try {
			$rpr = Appointments::where('appointmentId', $id)->firstOrFail();
			$status = $request->rpr_status;
			DB::beginTransaction();
			if ($status == Appointments::REPAIR_NOT_STARTED) {
				$rpr->repair_status = Appointments::REPAIR_NOT_STARTED;
			}
			if ($status == Appointments::REPAIR_COMPLETED) {
				$rpr->repair_status = Appointments::REPAIR_COMPLETED;
				$complete = true;
			}
			if ($status == Appointments::REPAIR_FAILED) {
				$rpr->repair_status = Appointments::REPAIR_FAILED;
			}
			if ($status == Appointments::REPAIR_REPAIRING) {
				$rpr->repair_status = Appointments::REPAIR_REPAIRING;
			}
			if ($status == Appointments::REPAIR_WAITING_PARTS) {
				$rpr->repair_status = Appointments::REPAIR_WAITING_PARTS;
			}

			$rpr->save();
			DB::commit();

			return $complete
				? redirect()->route('business.appointments.billing.create', $rpr->appointmentId)
				: redirect()->route('business.appointments.index');
		} catch (\Exception $err) {
			DB::rollBack();
			// dd($err);
			return abort(500);
		}
	}
}
