<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Business\AuthData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
	use AuthData;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		if ($request->ajax()) {
			return $this->advanceSearch($request);
		}

		$users = User::where('id', '!=', Auth::id())
			->where('is_business', User::IS_CUSTOMER)
			->ordered()
			->paginate(30);

		return view('pages.shop.users-list')
			->with(compact('users'))
			->with($this->getAuthShopData());
	}

	public function store(Request $request)
	{
		// dd($request->toArray());
		try {
			DB::beginTransaction();
			$banUser = User::where('userId', $request->userId)->firstOrFail();
			$banUser->is_banned = true;
			$banUser->is_banned_reason = $request->reason;
			$banUser->save();
			DB::commit();
			return redirect()->route('business.users.index');
		} catch (\Exception $err) {
			DB::rollBack();
			return redirect()->back()->withErrors([
				'An unexpected error has occured, please try again.'
			]);
		}
	}

	public function unbanUser(Request $request)
	{
		try {
			DB::beginTransaction();
			$banUser = User::where('userId', $request->userId)->firstOrFail();
			$banUser->is_banned = false;
			$banUser->is_banned_reason = null;
			$banUser->save();
			DB::commit();
			return redirect()->route('business.users.index');
		} catch (\Exception $err) {
			DB::rollBack();
			return redirect()->back()->withErrors([
				'An unexpected error has occured, please try again.'
			]);
		}
	}

	public function getBanReason(Request $request)
	{
		return response()->json(User::where('userId', $request->userId)->firstOrFail()->is_banned_reason);
	}

	public function advanceSearch(Request $request)
	{
		$filter = ['user_status', 'search'];
		$users = User::where('id', '!=', Auth::id())
			->where('is_business', User::IS_CUSTOMER);

		if (!is_null($request->user_status)) {
			$filter['user_status'] = $request->user_status;
			$users = $users->where('is_banned', $request->user_status);
		}
		if (!is_null($request->search)) {
			$filter['search'] = $request->search;
			$users = $users->where('userId', 'like', $request->search . '%');
			$users = $users->orWhere(DB::raw('concat(firstname,lastname)'), 'like', '%' . $request->search . '%');
		}

		$users = $users->ordered()->paginate(30);

		// return view('pages.shop.users-list')
		// 	->with(compact('users'))
		// 	->with(compact('filter'))
		// 	->with($this->getAuthShopData());

		return response()->json([
			'list' => view('components.business.users-list')
				->with(compact('users'))
				->render(),
			'paginate' => view('components.paginate-button')
				->with(['data' => $users])
				->render()
		]);
	}
}
