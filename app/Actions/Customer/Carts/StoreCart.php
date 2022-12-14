<?php

namespace App\Actions\Customer\Carts;

use App\Models\Carts;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreCart
{
	public function execute(Products $product, Request $request)
	{
		$user = Auth::user();
		// $quantity = $product->currentInventory()->quantity;
		$cond = Carts::where('user_id', $user->id)
			->where('product_id', $product->id)
			->exists();

		return $cond
			? false
			: Carts::create([
				'shop_id' => $product->shop->id,
				'user_id' => $user->id,
				'product_id' => $product->id,
				'quantity' => $request->quantity,
				'subtotal' => (float) $request->quantity * $product->price,
			]);
	}
}
