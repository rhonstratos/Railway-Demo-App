<?php

namespace App\Actions\Business\Orders;

use App\Models\Orders;

class UpdateStatus
{
	public function execute($newStatus, $order)
	{
		$order->status = $newStatus;
		$order->save();
	}

	public function updateProductStock($newStatus, Orders $order)
	{
		foreach ($order->items as $item) {
			$_oldQuantity = $item->product->currentInventory()->quantity;
			$_newQuantity = $_oldQuantity - $item->quantity;

			if ($item->quantity > $_oldQuantity) {
				return redirect()->back()
					->withErrors([
						'fail' => 'Cannot complete order, inventory stock is lower than than the ordered item: ' . $item->product->name
					]);
			}
			$item->product->setInventory($_newQuantity);
		}

		$order->status = $newStatus;
		//dump($order->toArray(),$order->save());
		$order->save();
	}
}
