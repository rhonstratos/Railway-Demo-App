<?php

namespace App\Http\Controllers\Business;

use App\Actions\Business\Orders as Actions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Business\Orders as FormRequests;
use App\Models\Orders;
use App\Traits\Business\AuthData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
	use AuthData;
	public function __construct(
		private Actions\UpdateStatus $updateStatus,
		private $paginateCount = 30,
	) {
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if($request->ajax()){
			return $this->advanceSearch($request);
		}
		$orders = Orders::where('shop_id', Auth::id())
			->with(['items.product', 'user'])
			->where('status','!=',Orders::STATUS_COMPLETED)
			->where('status','!=',Orders::STATUS_CANCELED)
			->orderBy('created_at', 'DESC')
			->paginate($this->paginateCount);

		return view('pages.shop.orders')
			->with(compact('orders'))
			->with($this->getAuthShopData());
	}

	public function updateStatus(FormRequests\UpdateStatus $request)
	{
		$newStatus = $request->order_status;
		$orderId = $request->orderId;
		$order = Orders::where('orderId', $orderId)->firstOrFail();

		try {
			DB::beginTransaction();
			if ($newStatus == Orders::STATUS_COMPLETED) {
				$this->updateStatus->updateProductStock($newStatus, $order);
			} else {
				$this->updateStatus->execute($newStatus, $order);
			}
			DB::commit();

			return redirect()
				->route('business.orders.show', $orderId)
				->with([
					'success' => 'Order status updated!'
				]);
		} catch (\Exception $err) {
			DB::rollBack();
			return redirect()->back()->withErrors([
				'fail' => 'There was an unexpected error, please try again.'
			]);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($order)
	{
		$order = Orders::where('orderId', $order)->firstOrFail()->load('items.product');
		// dd($order->toArray());
		$statuses = config('enums.order_status_optgroup');
		$stat = [];

		foreach ($statuses as $key => $status) {
			if (is_array($status) && $key == $order->transfer_method) {
				foreach ($status as $k => $v) {
					$stat[$k] = $v;
				}
				continue;
			}
			if (is_array($status)) {
				continue;
			}
			$stat[$key] = $status;
		}

		return view('pages.shop.orders-details')
			->with(compact('order'))
			->with(compact('stat'))
			->with($this->getAuthShopData());
	}

	/**
	 *
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function history()
	{
		$orders = Orders::where('shop_id', Auth::user()->shop->id)
			->with(['user'])
			->orderBy('created_at', 'DESC')
			->paginate(30);
		// dump($orders->toArray());
		return view('pages.shop.orders-history')
			->with(compact('orders'))
			->with($this->getAuthShopData());
	}

	public function advanceSearch(Request $request)
	{
		// dd($request->toArray())
		$orders = Orders::where('shop_id', Auth::id())
			->with(['items.product', 'user']);

			$filter = [
				'order_status',
				'date_from',
				'date_to',
				'search',
			];
		if(!is_null($request->order_status)){
			$orders = $orders->where('status',$request->order_status);
			$filter['order_status']=$request->order_status;
		}
		if(!is_null($request->date_from) || !is_null($request->date_to)){
			$orders = $orders->whereBetween('created_at',[
				Carbon::parse($request->date_from),
				Carbon::parse($request->date_to),
			]);
			$filter['date_from']=$request->date_from;
			$filter['date_to']=$request->date_to;
		}
		if(!is_null($request->search)){
			$orders = $orders->where('orderId','like',$request->search.'%');
			$orders = $orders->with(['user'=>function($q)use($request){
				return $q->orWhere(DB::raw('concat(firstname,lastname)'),'like','%'.$request->search.'%');
			}]);
			$filter['search']=$request->search;
		}

		$orders = $orders->orderBy('created_at', 'DESC')
			->paginate($this->paginateCount);

		// return view('pages.shop.orders')
		// 	->with(compact('filter'))
		// 	->with(compact('orders'))
		// 	->with($this->getAuthShopData());

		return response()->json([
			'list'=>
				view('components.business.order-list')
					->with(compact('orders'))
					->render(),
			'paginate'=>
				view('components.paginate-button')
					->with(['data'=>$orders])
					->render(),
		]);
	}
}
