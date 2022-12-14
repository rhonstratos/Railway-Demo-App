<?php

namespace App\Http\Controllers;

use App\Actions\AccountSettings as Actions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\AccountSecurity as Security;
use App\Traits\Business\AuthData;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountSettingsController extends Controller
{
	use AuthData;
	public function __construct(
		private Actions\StoreBasic $storeBasic,
		private Actions\StoreAuth $storeAuth
	) {
	}

	public function formStore(Request $request)
	{
		switch ($request->action) {
			case 'basic':
				return
					$this->storeB(Security\BasicRequest::createFrom($request));
				break;
			case 'security':
				return
					$this->storeS(Security\AuthRequest::createFrom($request));
				break;
			default:
				// return abort(404);
				return redirect()->back();
				break;
		}
	}

	private function storeB(Security\BasicRequest $request)
	{
		try {
			$val = $this->validate($request, $request->rules());

			DB::beginTransaction();
			$this->storeBasic->execute($val);
			DB::commit();

			return redirect()
				->route('customer.settings.index')
				->with(['success' => 'basic']);
		} catch (\Exception $err) {
			DB::rollBack();
			// dd($err);
			return redirect()->back()->withErrors([
				'An error has occured. please try again later.'
			]);
		}
	}

	private function storeS(Security\AuthRequest $request)
	{
		try {
			$val = $this->validate($request, $request->rules());

			DB::beginTransaction();
			$this->storeAuth->execute($val);
			DB::commit();

			return redirect()
				->route('customer.settings.index')
				->with(['success' => 'security']);
		} catch (\Exception $err) {
			DB::rollBack();
			// dd($err);
			return redirect()->back()->withErrors([
				'An error has occured. please try again later.'
			]);
		}
	}
}
