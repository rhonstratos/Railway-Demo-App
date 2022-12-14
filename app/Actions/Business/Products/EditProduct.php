<?php

namespace App\Actions\Business\Products;

use App\Http\Requests\Business\Products\EditProductRequest;
use App\Models;
use Illuminate\Http\Request;

class EditProduct
{
	public function __construct(
		private Models\Products $product
	)
	{
	}
	public function execute(EditProductRequest $request, Models\Products $product)
	{
		// dd($product->toArray(), $request->toArray());
		$imgs = [];

		$product->name = $request->product_name;
		$product->category = $request->category;
		$product->price = $request->price;
		$newStock = (int) $request->quantity;
		$product->clearInventory();
		$product->setInventory($newStock);
		$product->description = $request->product_description;
		$product->details = [
			'speficications' => array_combine($request->spec_key, $request->spec_value),
			// 'transfer_method' => $request->transfer_method,
			// 'payment_method' => $request->payment_method,
			'condition' => $request->condition,
		];

		if ($request->file('img_showcase')) {
			$destinationPath = "products/{$product->productId}";
			$product->img_showcase = pathinfo($request->file('img_showcase')->store($destinationPath))['basename'];
		}

		if ($request->file('product_img')) {
			foreach ($request->file('product_img') as $image) {
				$destinationPath = "products/{$product->productId}";
				array_push($imgs, pathinfo($image->store($destinationPath))['basename']);
			}
			$product->img = $imgs;
		}

		$product->save();
	}
}
