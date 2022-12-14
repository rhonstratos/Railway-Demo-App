<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Favorites;
use App\Models\Products;
use App\Models\User;
use App\Traits\Business\AuthData;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
	use AuthData;
	public function index()
	{
		$favorites = Favorites::query()
			->with('product.revCa')
			->withCount([
				'reviews as avg_ratings' =>
				fn($q) =>
				$q->select(DB::raw('avg(reviews.ratings)'))
			])
			->paginate(30);

		return view('pages.client.favorites')
			->with($this->getAuthUserData())
			->with(compact('favorites'));
	}
	public function store(Request $request)
	{
		$prod_id = Products::where('productId', $request->product_id)
			->firstOrFail()->id;

		if (!$prod_id) {
			return response()->json([
				'code' => 418,
				'message' => 'error'
			], 418);
		}
		$user_id = Auth::id();

		$check = Favorites::where('product_id', $prod_id)
			->where('user_id', $user_id)->first();

		if ($check) {
			$check->delete();
			return response()->json([
				'success' => true,
				'message' => 'removed from favorites'
			]);
		}

		$fav = Favorites::Create([
			'user_id' => $user_id,
			'product_id' => $prod_id,
		]);

		return response()->json([
			'success' => true,
			'message' => 'added to favorites'
		]);
	}
}
