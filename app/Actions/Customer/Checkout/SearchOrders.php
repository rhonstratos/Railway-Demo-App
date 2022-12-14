<?php

namespace App\Actions\Customer\Checkout;

use App\Http\Requests\Customer\Checkout\CheckoutRequest;
use App\Models;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class SearchOrders
{
	public function __construct(
		private Models\Orders $order
	) {
	}
	public function execute(QueryBuilder $order, string $filter)
	{
		switch ($filter) {
			case 'All':
				break;
			case 'Processing':
				$order = $order
					->whereIn('status', [
						$this->order::STATUS_WAITING,
						$this->order::STATUS_PREPARING,
						$this->order::STATUS_SHIPPING,
						$this->order::STATUS_SHIPPED,
						$this->order::STATUS_CONFIRM_MEET_UP,
						$this->order::STATUS_READY_TO_PICK,
					]);
				break;
			case 'Completed':
				$order = $order
					->where('status', $this->order::STATUS_COMPLETED);
				break;
			case 'Canceled':
				$order = $order
					->where('status', $this->order::STATUS_CANCELED);
				break;
			default:
				$order = $order
					->where('status', '!=', $this->order::STATUS_COMPLETED);
				break;
		}
		return $order;
	}
	public function searchByOrderId(QueryBuilder $order, string $orderId)
	{
		return $order
			->where('orderId', 'like', "%{$orderId}%");
	}
}
