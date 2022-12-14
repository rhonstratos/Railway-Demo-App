<?php

namespace App\Http\Controllers\Business;

use App\Actions\Business\Products as Actions;
use App\Events\Product as Events;
use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests\Business\Products as ProductRequests;
use App\Models\Orders;
use App\Models\Products;
use App\Traits\Business\AuthData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductsController extends BaseController
{
	use AuthData;

	public function __construct(
		private Actions\StoreProduct $storeProduct,
		private Actions\EditProduct $editProduct,
	) {
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	private $paginate_count = 30;
	public function index(Request $request)
	{
		if($request->ajax()){
			return $this->advanceSearch($request);
		}
		$products = Products::where('shop_id',Auth::user()->shop->id)
			->with(['orderedItems'=>function($q){
				return $q->select('quantity','id','product_id')->setEagerLoads([]);
			}])
			->orderBy('name', 'ASC')
			->paginate($this->paginate_count);

		return view('pages.shop.products')
			->with($this->getAuthShopData())
			->with(compact('products'));
	}

	public function advanceSearch(Request $request){
		// dd($request->toArray());
		$filter=['search'];
		$products = Products::where('shop_id',Auth::user()->shop->id)
			->with(['orderedItems'=>function($q){
				return $q->select('quantity','id','product_id')->setEagerLoads([]);
			}]);
		if(!is_null($request->search)){
			$filter['search']=$request->search;
			$products
			->where('productId','like',$request->search.'%')
			->orWhere('name','like','%'.$request->search.'%');
		}
		$products=$products
			->orderBy('name', 'ASC')
			->paginate($this->paginate_count);

		// return view('pages.shop.products')
		// 	->with(compact('filter'))
		// 	->with($this->getAuthShopData())
		// 	->with(compact('products'));

		return response()->json([
			'list'=>
				view('components.business.product-list')
					->with(compact('products'))
					->render(),
			'paginate' =>
				view('components.paginate-button')
					->with(['data'=>$products])
					->render(),
		]);
	}

	public function fill()
	{
		$user = Auth::user()->load('shop.product.inventories');
		return response()->json(
			view('components.business.product-list', [
				'user' => $user
			])->render()
		);
	}

	public function preview(Request $request)
	{
		$prod = $request;
		return response()->json(
			view('components.business.product-card', [
				'img' => $prod->imgShowcase,
				'name' => $prod->prodName,
				'price' => $prod->prodPrice,
			])->render()
		);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		// dump(
		// 	\App\Models\Products::query()->with('inventories', 'shop')->get()->toArray()
		// );
		$pageTitle = 'Add New Product';
		return view('pages.shop.products-create')
			->with(compact('pageTitle'))
			->with($this->getAuthShopData());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ProductRequests\StoreProductRequest $request)
	{
		try {
			$id = uniqid();
			$shop = Auth::user()->shop;
			while (Products::where('productId', $id)->exists()) {
				$id = uniqid();
			}
			DB::beginTransaction();
			$product = $this->storeProduct->execute($id, $shop, $request);
			DB::commit();
			return redirect()
				->route('business.products.index')
				->with([
					'success' => 'You save successfully added a new product to your inventory.'
				]);
		} catch (\Illuminate\Database\QueryException $qrr) {
			DB::rollBack();
			$errmsg = [
				'error 500' => 'An error has occured, please try again.',
				// 'message'=>$e->getMessage()
			];
			if ($qrr->getCode() == 23000) {
				$errmsg = ['fail' => 'That product is already in the database!',];
			}
			$error = [
				'message' => $qrr->getMessage(),
				'code' => $qrr->getCode(),
				'file' => $qrr->getFile(),
				'line' => $qrr->getLine(),
			];
			event(new \App\Events\FailedAction($this::class, $error));
			throw ValidationException::withMessages($errmsg);
		} catch (\Exception $err) {
			DB::rollBack();
			//dd($err);
			$error = [
				'message' => $err->getMessage(),
				'code' => $err->getCode(),
				'file' => $err->getFile(),
				'line' => $err->getLine(),
			];
			event(new \App\Events\FailedAction($this::class, $error));
			throw ValidationException::withMessages([
				'error 500' => 'An error has occured, please try again.',
				// 'message'=>$e->getMessage()
			]);
		}

		event(new Events\StoredSuccessful($this::class, Auth::user()->userId));
		return redirect()->route('business.products.index');
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
	public function edit($product)
	{
		$product = Products::where('productId', $product)->firstOrFail();
		$pageTitle = 'Edit Product: ' . Str::title($product->name);

		return view('pages.shop.products-create')
			->with(compact('pageTitle'))
			->with($this->getAuthShopData())
			->with(compact('product'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ProductRequests\EditProductRequest $request, $product)
	{
		$product = Products::where('productId', $product)->firstOrFail();
		$pageTitle = 'Edit Product: ' . Str::title($product->name);
		try {
			DB::beginTransaction();
			$this->editProduct->execute($request, $product);
			DB::commit();
			return view('pages.shop.products-create')
				->with(compact('pageTitle'))
				->with([
					'success' => 'You have successfully updated this product, ' . Str::title($product->name)
				])
				->with($this->getAuthShopData())
				->with(compact('product'));
		} catch (\Exception $err) {
			DB::rollBack();
			//dd($err);
			return redirect()->back()
				->withErrors([
					'fail' => 'An unexpected error has occured, please try again.'
				]);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Products $product)
	{
		//
	}
}
