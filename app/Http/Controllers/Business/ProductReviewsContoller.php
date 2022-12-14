<?php

namespace App\Http\Controllers\Business;

use App\Actions\Business\ProductReviews\FilterReviews;
use App\Http\Controllers\ReviewsController as Controller;
use App\Models\Orders;
use App\Models\Products;
use App\Traits\Business\AuthData;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductReviewsContoller extends Controller
{
	use AuthData;

	public function __construct(
		private FilterReviews $filterReviews
	)
	{
	}

	public function index($product)
	{
		$product = Products::where('productId', $product)
			->firstOrFail();

		$reviews = $product->rev()
			->with('user')
			->orderBy('created_at', 'ASC')
			->paginate(30);

		return view('pages.shop.products-review')
			->with(compact('product'))
			->with(compact('reviews'))
			->with($this->getAuthShopData());
	}

	public function filter(Request $request, $product)
	{
		$product = Products::where('productId', $product)
			->firstOrFail();

		$reviews = $product->rev();
		$reviews = $this->filterReviews->execute($request, $reviews);
		$reviews = $reviews
			->with('user')
			->orderBy('created_at', 'ASC')
			->paginate(30);

		return view('pages.shop.products-review')
			->with(compact('product'))
			->with(compact('reviews'))
			->with($this->getAuthShopData());
	}
}
