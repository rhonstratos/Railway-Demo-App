<?php

namespace App\Actions\Customer\Carts;

use App\Models\Carts;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateCart
{
	public function execute(Products $product, Request $request)
	{
		$user = Auth::user();
		$cart = $user->cart()->where('product_id', $product->id)->firstOrFail();
		$currentQuantity = $cart->quantity;
		switch ($request->action) {
			case 'icr':
				return $this->incrementQty($product, $cart, $currentQuantity);
				break;
			case 'dcr':
				return $this->decrementQty($product, $cart, $currentQuantity);
				break;
			default:
				return $currentQuantity;
				break;
		}
	}

	private function incrementQty(Products $product, $cart, $currentQuantity)
	{
		if ($currentQuantity > $product->cart_max_quantity) {
			return [
				'qty' => $currentQuantity,
				'subtotal' => $cart->subtotal,
				'fail' => true
			];
		}

		$newQuantity = (int)$currentQuantity + 1;
		$newSubtotal = $newQuantity * $product->price;
		$cart->quantity = $newQuantity;
		$cart->subtotal = $newSubtotal;
		$cart->save();

		return [
			'qty' => $newQuantity,
			'subtotal' => $newSubtotal,
			'fail' => false
		];
	}
	private function decrementQty(Products $product, $cart, $currentQuantity)
	{
		if ($currentQuantity <= 1) {
			return [
				'qty' => $currentQuantity,
				'subtotal' => $cart->subtotal,
				'fail' => true
			];
		}

		$newQuantity = (int)$currentQuantity - 1;
		$newSubtotal = $newQuantity * $product->price;
		$cart->quantity = $newQuantity;
		$cart->subtotal = $newSubtotal;
		$cart->save();

		return [
			'qty' => $newQuantity,
			'subtotal' => $newSubtotal,
			'fail' => false
		];
	}
}
