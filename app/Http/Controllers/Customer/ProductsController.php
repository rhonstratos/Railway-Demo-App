<?php

namespace App\Http\Controllers\Customer;

use App\Actions\Customer\Products as Actions;
use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Shop;
use App\Traits\Business\AuthData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
	use AuthData;
	public function __construct(
		private Actions\FilteredView $filteredView,
		private Actions\AdvanceSearch $advanceSearch
	)
	{
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$products = Shop::query()
			->first()
			->product()
			->with(['favorite'])
			->withCount([
				'rev as avg_ratings' =>
				fn($q) =>
				$q->select(DB::raw('avg(ratings)'))
			]);

		if (request()->search) {
			$products = $this->filteredView
				->execute(
					'search',
					$products,
					request()->search
				);
		}
		$view = view('pages.client.products')
			->with(
				[
					'products' => $products
						->orderBy('name', 'ASC')
						->paginate(30)
				]
			);
		$view = Auth::check()
			? $view->with($this->getAuthUserData())
			: $view->with($this->getGuestUserData());
		return is_null($products)
			? redirect()->back()
				->withErrors([
					'Sorry, we dont have or dont know what you are looking for.'
				])
			: $view;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('pages.client.product-show')
			->with($this->getAuthUserData());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$product = Products::where('productId', '=', $id)
			->withCount([
				'rev as avg_ratings' =>
				fn($q) =>
				$q->select(DB::raw('avg(ratings)'))
			])
			->firstOrFail();

		$rev = $product->rev()
			->with('user')
			->where('product_id', $product->id);

		$reviews_total = $rev->count();
		$reviews_stars = $product->rev()
			->where('product_id', $product->id)
			->select('ratings', DB::raw('count(id) as count'))
			->groupBy('ratings')
			->get();

		$review_stars_stats = [
			1 => 0,
			2 => 0,
			3 => 0,
			4 => 0,
			5 => 0,
		];

		foreach ($reviews_stars as $star) {
			switch ($star['ratings']) {
				case 1:
					$review_stars_stats['1'] = round(((float) $star['count'] / (float) $reviews_total) * 100);
					break;
				case 2:
					$review_stars_stats['2'] = round(((float) $star['count'] / (float) $reviews_total) * 100);
					break;
				case 3:
					$review_stars_stats['3'] = round(((float) $star['count'] / (float) $reviews_total) * 100);
					break;
				case 4:
					$review_stars_stats['4'] = round(((float) $star['count'] / (float) $reviews_total) * 100);
					break;
				case 5:
					$review_stars_stats['5'] = round(((float) $star['count'] / (float) $reviews_total) * 100);
					break;
			}
		}

		$reviews = $rev->get()
			->shuffle()->take(5);

		$view = view('pages.client.product-show')
			->with(compact('reviews'))
			->with(compact('reviews_total'))
			->with(compact('review_stars_stats'))
			->with(compact('product'));

		$view = Auth::check()
			? $view->with($this->getAuthUserData())
			: $view->with($this->getGuestUserData());
		// dump($reviews_stars, $review_stars_stats);
		return $view;
	}

	public function searchProduct(Request $request)
	{
		$products = Products::where('name', 'like', '%' . $request->search . '%')
			->orderBy('name', 'ASC')
			->paginate(30);

		return view('pages.client.products')
			->with($this->getAuthUserData())
			->with(['filterCount' => $products->count()])
			->with(compact('products'));
	}

	public function advanceSearchProduct(Request $request)
	{
		$products = $this->advanceSearch->execute($request);
		$products = $products->paginate(30);
		return view('pages.client.products')
			->with($this->getAuthUserData())
			->with(['filterCount' => $products->count()])
			->with(compact('products'));
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		return redirect()->back();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		return redirect()->back();
	}
}
