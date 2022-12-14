<?php

namespace App\Http\Controllers\Customer;

use App\Actions\Customer\Carts as Actions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Checkout as FormRequest;
use App\Models\Carts;
use App\Models\Products;
use App\Traits\Business\AuthData;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
	use AuthData;

	public function __construct(
		private Actions\StoreCart $storeCart,
		private Actions\UpdateCart $updateCart
	)
	{
	}
	public function index()
	{
		$cart = Carts::where('user_id', Auth::id())
			->with('product')
			->get();
		// dump($cart->toArray());
		$total = 0;

		foreach ($cart as $item) {
			$total += $item->subtotal;
		}

		return view('pages.client.customer-cart')
			->with($this->getAuthUserData())
			->with(compact('total'))
			->with(compact('cart'));
	}

	public function store(Request $request)
	{
		$product = Products::where('productId', $request->product)->firstOrFail();

		if ($request->quantity > $product->currentInventory()->quantity) {
			return back()->withErrors([
				'error' => 'Your order is greater than what we have in store.'
			]);
		}

		try {
			DB::beginTransaction();
			$cart = $this->storeCart->execute($product, $request);
			if ($cart == false) {
				return redirect()->back()->withErrors([
					'This item is already in your cart.'
				]);
			}
			DB::commit();

			return redirect()->route('customer.cart.index');
		} catch (QueryException $querr) {
			DB::rollBack();
			$errorId = $request->product;
			// dump($errorId);
			return redirect()->back()
				->with(compact('errorId'))
				->withErrors([
					'This item is already in your cart!'
				]);
		} catch (\Exception $err) {
			//dd($err);
			DB::rollBack();
			return redirect()->back()->withErrors([
				'An error has occured'
			]);
		}
	}

	public function instantCheckout(FormRequest\CheckoutRequest $request)
	{
		$product = Products::where('productId', $request->product)->firstOrFail();

		if ($request->quantity > $product->currentInventory()->quantity) {
			return back()->withErrors([
				'error' => 'Your order is greater than what we have in store.'
			]);
		}
		try {
			DB::beginTransaction();
			$this->storeCart->execute($product, $request);
			DB::commit();
			return redirect()->route('customer.checkout.index');
		} catch (\Exception $err) {
			DB::rollback();
			//dd($request->toArray(), $err);
			return redirect()
				->back()
				->withErrors([
					'There was an error on our end, but we will fix it soon.'
				]);
		}
	}

	public function quantityChange(Request $request)
	{
		$product = Products::where('productId', $request->productId)->firstOrFail();

		if ($request->quantity > $product->currentInventory()->quantity) {
			return response()->json([
				'error' => 'Your order is greater than what we have in store.'
			], 418);
		}

		try {
			DB::beginTransaction();
			$newQuantity = $this->updateCart->execute($product, $request);
			DB::commit();

			return response()->json($newQuantity);
		} catch (QueryException $querr) {
			DB::rollBack();
			$errorId = $request->product;
			// dump($errorId);
			return response()->json([
				'An unexpected error has occured, please try again.'
			], 418);
		} catch (\Exception $err) {
			//dd($err);
			DB::rollBack();
			return redirect()->back()->withErrors([
				'An error has occured'
			]);
		}
	}

	public function destroy(Carts $cart)
	{
		try {
			$cart->delete();
			return redirect()->back()->with('success', 'Cart item deleted successfully');
		} catch (\Exception $err) {
			DB::rollBack();
			return redirect()->back()->withErrors([
				'error' => ''
			]);
		}
	}
}
