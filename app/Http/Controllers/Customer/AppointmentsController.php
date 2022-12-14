<?php

namespace App\Http\Controllers\Customer;

use App\Actions\Customer\Appointments as Actions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer as CustomerRequests;
use App\Models\Appointments;
use App\Models\Reviews;
use App\Models\Shop;
use App\Models\User;
use App\Traits\Business\AuthData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AppointmentsController extends Controller
{
	use AuthData;

	public function __construct(
		private Actions\GetTimeSlots $getTimeSlots,
		private Actions\FilteredView $filteredView,
		private Actions\StoreAppointment $storeAppointment,
		private Actions\CancelAppointment $cancelAppointment,
		private Actions\SearchAppointments $searchAppointments,
	) {
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$appointmentData = Appointments::query()
			->with('user')
			->where('user_id',Auth::id());
		$shopOwner = Shop::findOrFail(1);
		if (request()->search) {
			$appointmentData = $this->searchAppointments
				->searchByAppointmentId(
					$appointmentData,
					request()->appointmentId
				);
			if ($appointmentData->count() < 1) {
				$appointmentData = $appointmentData->paginate(30);
				return view('pages.client.appointments')
					->with($this->getAuthUserData())
					->with(compact('appointmentData'))
					->with(compact('shopOwner'))
					->with([
						'filter' => request()->search
					]);
			}
		}
		$appointmentData = $appointmentData
		->orderBy('appointment_date_time','DESC')
		->paginate(30);
		return view('pages.client.appointments')
			->with($this->getAuthUserData())
			->with(compact('appointmentData'))
			->with(compact('shopOwner'));
	}

	public function filter($request)
	{
		$shopOwner = Shop::findOrFail(1);
		$appointmentData =
			$this->filteredView->execute($request);

		$view = view('pages.client.appointments')
			->with($this->getAuthUserData())
			->with(compact('appointmentData'))
			->with(compact('shopOwner'))
			->with(compact('request'));

		if ($appointmentData->count() < 1) {
			return $view->with([
				'filter' => $request
			]);
		}

		return $view;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$user = Auth::user();
		return view('pages.client.skeletons.appointments')
			->with(compact('user'))
			->with($this->getAuthUserData());
	}
	public function getTimeSlots(Request $request)
	{
		return $this->getTimeSlots
			->execute($request->query('date'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(CustomerRequests\AppointmentRequest $request)
	{
		// dump($request);

		if (
			Auth::user()
			// ->load('appointments')
			->appointments()
			->where('appointment_status', Appointments::APPOINTMENT_PENDING)
			->get()
			->count() >= 1
		) {
			return redirect()
				->route('customer.appointments.index')
				->withErrors([
					'You alrady have a pending appointment.'
				]);
		}

		try {
			DB::beginTransaction();
			$aptId = $this->storeAppointment->execute($request);
			DB::commit();

			return redirect()->route('customer.appointments.index')
				->with([
					'sucess' => 'Your appointment is now scheduled'
				]);
		} catch (\Exception $err) {
			DB::rollBack();
			$error = [
				'message' => $err->getMessage(),
				'code' => $err->getCode(),
				'file' => $err->getFile(),
				'line' => $err->getLine(),
			];
			event(new \App\Events\FailedAction($this::class, $error));

			dd($err,$request->toArray());

			return redirect()
				->route('customer.appointments.index')
				->withErrors([
					'You alrady have a pending appointment.'
				]);
			// throw ValidationException::withMessages([
			//     'error 500' => 'An error has occured, please try again.',
			//     // 'message'=>$e->getMessage()
			// ]);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Appointments $appointment)
	{
		$apt = $appointment->load('shop.user');
		$shopOwner = Shop::findOrFail(1);
		$hasReviewed = Reviews::where('user_id', Auth::id())
			->where('appointment_id', $apt->id)
			->exists();
		// dump($apt->toArray(), $hasReviewed);
		return view('pages.client.appointment-show')
			->with($this->getAuthUserData())
			->with(compact('apt'))
			->with(compact('hasReviewed'))
			->with(compact('shopOwner'));
		// return response()->json(
		// 	view('components.customer.appointment-modal', [
		// 		'apt' => $apt
		// 	])->render(),
		// 	200,
		// 	[],
		// 	request()->wantsJson() ? 0 : JSON_PRETTY_PRINT
		// );
	}

	public function cancelAppointment(Appointments $appointment, Request $request)
	{
		try {
			DB::beginTransaction();
			$this->cancelAppointment->execute($request, $appointment);
			DB::commit();
			return redirect()->back()->with([
				'success' => 'You successfully canceled your appointment.'
			]);
		} catch (\Exception $err) {
			DB::rollBack();
			//dd($err);
			return redirect()->back()->withErrors([
				'fail' => 'An unexpected error occurred, please try again.'
			]);
		}
	}
}
