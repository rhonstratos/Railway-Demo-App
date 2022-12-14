<?php

namespace App\Http\Controllers;

use App\Actions\Customer as Actions;
use App\Models\Appointments;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
	public function __construct(
		private Actions\Products\StoreReview $storeProductReview,
		private Actions\Appointments\StoreReview $storeAppointmentReview,
	) {
	}
	public function storeProductReview(Request $request)
	{
		$product = Products::where('productId', $request->productId)
			->firstOrFail();

		try {
			DB::beginTransaction();
			$this->storeProductReview->execute($request, $product);
			DB::commit();
			return redirect()->back()->with([
				'success' => 'You successfully reviewed the product.'
			]);
		} catch (\Exception $err) {
			DB::rollBack();
			dd($err);
			return redirect()->back()->withErrors([
				'fail' => 'An unexpected error occurred, please try again.'
			]);
		}
	}
	public function storeAppointmentReview(Request $request)
	{
		$appointment = Appointments::where('appointmentId', $request->appointmentId)
			->firstOrFail();
		try {
			DB::beginTransaction();
			$this->storeAppointmentReview->execute($request, $appointment);
			DB::commit();
			return redirect()->back()->with([
				'success' => 'Thank you for your review.'
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
