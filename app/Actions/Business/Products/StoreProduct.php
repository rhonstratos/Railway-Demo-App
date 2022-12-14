<?php

namespace App\Actions\Business\Products;

use App\Http\Requests\Business\Products\StoreProductRequest;
use App\Models;
use Illuminate\Http\Request;

class StoreProduct
{
	public function __construct(
		private Models\Products $product
	) {
	}

	public function execute(string $id, Models\Shop $shop, StoreProductRequest $request): Models\Products
	{
		$imgs = [];
		foreach ($request->file('product_img') as $image) {
			$destinationPath = "products/{$id}";
			array_push($imgs, pathinfo($image->store($destinationPath))['basename']);
		}
		$destinationPath = "products/{$id}";
		$imgShowcase = pathinfo($request->file('img_showcase')->store($destinationPath))['basename'];

		$prod = $this->product
			->create([
				'productId' => $id,
				'shop_id' => $shop->id,
				'name' => $request->product_name,
				'img_showcase' => $imgShowcase,
				'img' => $imgs,
				'category' => $request->category,
				'price' => $request->price,
				'is_variant' => 0,
				'cart_max_quantity' => $request->cart_max_quantity ?? 50,
				'description' => $request->product_description,
				'details' => [
					'speficications' => array_combine($request->spec_key, $request->spec_value),
					// 'transfer_method' => $request->transfer_method,
					// 'payment_method' => $request->payment_method,
					'condition' => $request->condition,
				],
			]);
		if ($prod->hasValidInventory()) {
			$prod->clearInventory();
		}
		$prod->setInventory($request->quantity);
		return $prod;
	}
}
