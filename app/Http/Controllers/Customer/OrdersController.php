<?php

namespace App\Http\Controllers\Customer;

use App\Actions\Customer\Checkout as Actions;
use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\Reviews;
use App\Traits\Business\AuthData;
use Illuminate\Support\Facades\Auth;
use Request;

class OrdersController extends Controller
{
	use AuthData;
	public function __construct(
		private Orders $order,
		private Actions\SearchOrders $searchOrders,
		private int $paginateCount = 30
	) {
	}

	public function index()
	{
		$orders = $this->order
			->where('user_id', Auth::id());
		// ->where('status', '!=', $this->order::STATUS_COMPLETED);

		if (request()->input('filter')) {
			$orders = $this->searchOrders
				->execute(
					$orders,
					request()->input('filter')
				);
			if ($orders->count() < 1) {
				$orders = $orders->paginate($this->paginateCount);
				return view('pages.client.orders')
					->with($this->getAuthUserData())
					->with(compact('orders'))
					->with([
						'filter' => request()->input('filter')
					]);
			}
		}

		if (request()->search) {
			$orders = $this->searchOrders
				->searchByOrderId(
					$orders,
					request()->orderId
				);
			if ($orders->count() < 1) {
				$orders = $orders->paginate($this->paginateCount);
				return view('pages.client.orders')
					->with($this->getAuthUserData())
					->with(compact('orders'))
					->with([
						'filter' => request()->search
					]);
			}
		}

		$orders = $orders
			->with(['user', 'items.product'])
			->orderBy('created_at', 'DESC')
			->paginate($this->paginateCount);

		$reviews = Reviews::where('user_id', Auth::id())->get();

		// dump($orders->toArray(), $reviews->toArray());

		return view('pages.client.orders')
			->with($this->getAuthUserData())
			->with(compact('reviews'))
			->with(compact('orders'))
			->with([
				'filter' => request()->input('filter')
			]);
	}
}
