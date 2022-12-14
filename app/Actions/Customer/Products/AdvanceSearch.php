<?php

namespace App\Actions\Customer\Products;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvanceSearch
{
	public function execute(Request $request)
	{
		//$request->toArray());
		$products = Products::query();

		if (!is_null($request->search)) {
			$products = $products->where('name', 'like', '%' . $request->search . '%');
		}

		if ($request->radio_category) {
			foreach ($request->radio_category as $category) {
				$products = $products->where('category', 'like', '%' . $category . '%');
			}
		}

		if ($request->product_rating) {

			$products = $products->join(
				'reviews',
				'reviews.product_id',
				'products.id'
			)->where('reviews.ratings', '>=', $request->product_rating);
		}

		$products = $products->withCount([
			'rev as avg_ratings' =>
			fn ($q) =>
			$q->select(DB::raw('avg(ratings)'))
		]);

		//dump($products->get()->toArray());

		if (!is_null($request->filter_price['min']) || !is_null($request->filter_price['max'])) {
			$products = $products->whereBetween('price', [
				!is_null($request->filter_price['min']) ? $request->filter_price['min'] : 0,
				!is_null($request->filter_price['max']) ? $request->filter_price['max'] : 0,
			]);
		}

		if ($request->product_sort) {
			$products = $request->product_sort == 'name ASC'
				? $products->orderby('name', 'ASC')
				: $products;

			$products = $request->product_sort == 'created_at DESC'
				? $products->orderby('created_at', 'DESC')
				: $products;

			$products = $request->product_sort == 'count orders'
				? $products->orderby('name', 'ASC')
				: $products;

			$products = $request->product_sort == 'price ASC'
				? $products->orderby('price', 'ASC')
				: $products;

			$products = $request->product_sort == 'price DESC'
				? $products->orderby('price', 'DESC')
				: $products;
		}

		return $products;
	}
}
