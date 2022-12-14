<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Reviews;
use App\Models\Shop;
use App\Traits\Business\AuthData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
	use AuthData;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//dump($this->getAuthUserData()['shop']->toArray());
		$shop = Shop::firstOrFail();
		$reviews = null;
		if (isset($shop->shop_settings['fav_reviews'])) {

			$reviews = Reviews::with(['appointment'])->whereIn('id', $shop->shop_settings['fav_reviews'])->get();
		}
		$top_products = $shop
			->product()
			->with(['favorite'])
			->withCount([
				'rev as avg_ratings' =>
				fn($q) =>
				$q->select(DB::raw('avg(ratings)'))
			])->orderBy('avg_ratings', 'DESC')->take(5)->get()
			->filter(fn($v, $k) => $v->avg_ratings != null);

		// dd($top_products->toArray(), $top_products->count() != 10);

		return view('pages.client.index')
			->with(compact('reviews'))
			->with(compact('top_products'))
			->with($this->getAuthUserData());
	}

	public function guestIndex()
	{
		$shop = Shop::firstOrFail();
		$reviews = null;
		if (isset($shop->shop_settings['fav_reviews'])) {
			$reviews = Reviews::with(['appointment'])->whereIn('id', $shop->shop_settings['fav_reviews'])->get();
		}
		$top_products = $shop
			->product()
			->with(['favorite'])
			->withCount([
				'rev as avg_ratings' =>
				fn($q) =>
				$q->select(DB::raw('avg(ratings)'))
			])->orderBy('avg_ratings', 'DESC')->take(5)->get()
			->filter(fn($v, $k) => $v->avg_ratings != null);
		return !Auth::check()
			? view('pages.client.index')
				->with(compact('reviews'))
				->with(compact('top_products'))
				->with($this->getGuestUserData())
			: redirect()->route('customer.home.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
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
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
