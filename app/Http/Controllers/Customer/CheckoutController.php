<?php

namespace App\Http\Controllers\Customer;

use App\Actions\Customer\Checkout as BaseActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Checkout as FormRequest;
use App\Models\Carts;
use App\Models\Products;
use App\Traits\Business\AuthData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
	use AuthData;

	public function __construct(
		private BaseActions\StoreCheckout $storeCheckout
	) {
		$this->middleware('customer.hasAddress');
	}

	public function index()
	{
		$carts = Carts::where('user_id', Auth::id())
			->with('product')
			->get();

		return view('pages.client.checkout')
			->with(compact('carts'))
			->with($this->getAuthUserData());
	}

	public function store(FormRequest\CheckoutRequest $request)
	{
		try {
			DB::beginTransaction();
			$this->storeCheckout->execute($request);
			DB::commit();
			return redirect()->route('customer.orders.index');
		} catch (\Exception $err) {
			DB::rollback();
			//dd($request->toArray(), $err);
			return redirect()
				->back()
				->withErrors([
					'There was an error on our end, but we will fix it soon.'
				]);
		}
	}
}
