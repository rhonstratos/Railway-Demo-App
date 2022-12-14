<?php

namespace App\Actions\Customer\Checkout;

use App\Http\Requests\Customer\Checkout\CheckoutRequest;
use App\Models\Carts;
use App\Models\OrderedProducts;
use App\Models\Orders;
use App\Models\Products;
use App\Models\Shop;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class StoreCheckout
{
	public function __construct(
		private Orders $order,
		private OrderedProducts $orderedProducts,
		private Carts $cart,
		private Products $products,
		private CheckoutRequest $request
	) {
	}

	public function execute(CheckoutRequest $request)
	{
		$this->$request = $request;
		$this->saveOrder();
		$this->saveOrderedProducts();
		$this->deleteCart();
	}

	private function saveOrder()
	{
		$id = (string) uniqid();
		while ($this->order->where('orderId', $id)->exists()) {
			$id = (string) uniqid();
		}
		$this->order = $this->order->create([
			'user_id' => Auth::id(),
			'shop_id' => Shop::first()->id,
			'orderId' => $id,
			'total' => array_sum(array_values($this->request->subtotal)),
			'transfer_method' => $this->request->transfer_method,
			'payment_method' => $this->request->payment_method,
		]);
	}

	private function saveOrderedProducts()
	{
		$quantity = $this->request->quantity;
		$subtotal = $this->request->subtotal;
		$products = $this->products
			->select('id', 'productId')
			->whereIn('productId', $this->request->productId)
			->get();

		foreach ($products as $item) {
			$this->orderedProducts->create([
				'order_id' => $this->order->id,
				'product_id' => $item->id,
				'quantity' => $quantity[$item->productId],
				'subtotal' => $subtotal[$item->productId],
			]);
			// $this->updateProductStocks($item, $quantity[$item->productId]);
		}
	}

	private function updateProductStocks(Products $item, int $quantity)
	{
		$oldStock = $item->currentInventory()->quantity;
		$newStock = $oldStock - $quantity;
		$item->clearInventory();
		$item->setInventory($newStock);
		$item->save();
	}

	private function deleteCart()
	{
		$cart = $this->cart
			->where('user_id', Auth::id())
			->get();
		foreach ($cart as $item) {
			$item->delete();
		}
	}
}
