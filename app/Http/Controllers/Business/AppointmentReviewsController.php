<?php

namespace App\Http\Controllers\Business;

use App\Actions\Business\Appointments\FilteredView;
use App\Actions\Business\ProductReviews\FilterReviews;
use App\Http\Controllers\ReviewsController as Controller;
use App\Models\Products;
use App\Models\Reviews;
use App\Models\Shop;
use App\Traits\Business\AuthData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentReviewsController extends Controller
{
	use AuthData;

	public function __construct(
		private FilteredView $filteredView
	)
	{
	}

	public function index(Request $request)
	{
		if ($request->ajax()) {
			return $this->filter($request);
		}
		$reviews = Reviews::whereNotNull('appointment_id')
			->with(['user', 'product'])
			->orderBy('created_at', 'DESC')
			->paginate(30);
		return view('pages.shop.appointments-review')
			->with(compact('reviews'))
			->with($this->getAuthShopData());
	}

	public function filter(Request $request)
	{
		$reviews = Reviews::whereNotNull('appointment_id')
			->with(['user', 'product']);

		$view = view('pages.shop.appointments-review');

		$results = $this->filteredView->execute($request, $reviews, $view);

		$reviews = $results['review']
			->orderBy('created_at', 'DESC')
			->paginate(30);

		$view = $results['view'];

		// return $view->with(compact('reviews'))
		// 	->with($this->getAuthShopData());

		return response()->json([
			'list' =>
				view('components.business.appoinement-review-card')
				->with(compact('reviews'))
				->with(['shop' => Auth::user()->shop])
				->render(),
			'paginate' =>
				view('components.paginate-button')
				->with(['data' => $reviews])
				->render(),
		]);
	}

	public function toggleFavorite(Request $request)
	{
		$shop = Shop::firstOrFail();
		$current = $shop->shop_settings;
		if (!Arr::exists($current, 'fav_reviews')) {
			$current['fav_reviews'] = [];
		}
		$action = null;
		try {
			DB::beginTransaction();
			if (Arr::exists($current, 'fav_reviews') && Arr::exists($current['fav_reviews'], $request->id)) {
				$current['fav_reviews'] = Arr::except($current['fav_reviews'], $request->id);
				$action = 'remove';
			} else if (Arr::exists($current, 'fav_reviews') && count($current['fav_reviews']) < 3) {
				$current['fav_reviews'] = Arr::add($current['fav_reviews'], $request->id, $request->id);
				$action = 'add';
			} else {
				return response()->json(['status' => false, 'message' => 'fail1', 'action' => $action]);
			}
			$shop->shop_settings = $current;
			$shop->save();
			DB::commit();
			return response()->json(['status' => true, 'message' => 'success', 'action' => $action, 'test' => $current]);
		} catch (\Exception $err) {
			DB::rollBack();
			dd($err);
			return response()->json(['status' => false, 'message' => 'fail2', 'action' => $action]);
		}
	}
}
