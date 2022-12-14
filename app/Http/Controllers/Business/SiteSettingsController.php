<?php

namespace App\Http\Controllers\Business;

use App\Actions\Business\SiteSettings as Actions;
use App\Actions\SiteSettings as SiteSettingsActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\SiteSettings\AssetsForm;
use App\Traits\Business\AuthData;
use App\Http\Requests\Business\ShopSettings as ShopSettingsRequests;
use App\Http\Requests\SiteSettings\ThemeColor;
use App\Models\Shop;
use App\Models\SiteSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class SiteSettingsController extends Controller
{
	use AuthData;

	public function __construct(
		private Actions\StoreForms $storeForms,
		private SiteSettingsActions\ThemeColor $themeColor,
		private SiteSettingsActions\SiteAssets $siteAssets,
	) {
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{ 
		return view('pages.shop.site-settings')
			->with($this->getAuthShopData());
	}

	public function info()
	{
		// dump($this->getAuthShopData()['shop']->toArray());
		return view('pages.shop.site-settings-shopInfo')
			->with($this->getAuthShopData());
	}

	public function faqs()
	{
		return view('pages.shop.site-settings-faqs')
			->with($this->getAuthShopData());
	}

	public function gallery()
	{
		$siteSettings = SiteSettings::first();
		return view('pages.shop.site-settings-gallery')
			->with(compact('siteSettings'))
			->with($this->getAuthShopData());
	}

	public function add_new_gallery_card(Request $request)
	{
		// dd($request);
		return view('components.business.your-gallery-card-template')->render();
	}

	public function themeColor(ThemeColor $request)
	{
		try {
			DB::beginTransaction();
			$this->themeColor->execute($request);
			DB::commit();
			return redirect()->route('business.site-settings.index')
				->with([
					'success' => 'You have successfully changed the site\'s theme color.'
				]);
		} catch (\Exception $err) {
			DB::rollback();
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
	}

	public function system_images()
	{
		return view('pages.shop.site-settings-system-images')
			->with($this->getAuthShopData());
	}
	public function storeSiteAssets(AssetsForm $request)
	{
		try{
			DB::beginTransaction();
			$this->siteAssets->execute($request);
			DB::commit();
			return redirect()->route('business.site-settings.system-images')
				->with([
					'success' => 'You have successfully changed the site\'s assets.'
				]);
		}catch(\Exception $err){
			DB::rollBack();
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
	}

	public function form1(ShopSettingsRequests\Form1 $request)
	{
		try {
			DB::beginTransaction();
			$this->storeForms->formOne($request);
			DB::commit();
			return redirect()->back();
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
	}
	public function form2(ShopSettingsRequests\Form2 $request)
	{
		try {
			DB::beginTransaction();
			$this->storeForms->formTwo($request);
			DB::commit();
			return redirect()->back();
		} catch (\Exception $err) {
			DB::rollBack();
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
	}
	public function form3(ShopSettingsRequests\Form3 $request)
	{
		// dd($request);
		try {
			DB::beginTransaction();
			$this->storeForms->formThree($request);
			DB::commit();
			return redirect()->back();
		} catch (\Exception $err) {
			DB::rollBack();
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
	}
	public function form4(ShopSettingsRequests\Form4 $request)
	{
		try {
			DB::beginTransaction();
			$this->storeForms->formFour($request);
			DB::commit();
			return redirect()->back();
		} catch (\Exception $err) {
			DB::rollBack();
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
	}
	public function form5(ShopSettingsRequests\Form5 $request)
	{
		try {
			DB::beginTransaction();
			$this->storeForms->formFive($request);
			DB::commit();
			return redirect()->back();
		} catch (\Exception $err) {
			DB::rollBack();
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
	}
	public function shopTagIsValid(ShopSettingsRequests\ShopTag $request)
	{
		$shop = Shop::first();
		$result = Str::contains($request->tag, $shop->services);

		return $result
			? response()->json(['fail' => 'The tagline you wish to add is already saved.'], 418)
			: response()->json(
				view(
					'components.business.tagline',
					['data' => $request->tag]
				)->render()
			);
	}
	public function loadShopTags()
	{
		$shop = Shop::first();

		$shopTags = Arr::map($shop->services, fn ($v, $k) => view(
			'components.business.tagline',
			['data' => $v]
		)->render());

		return response()->json($shopTags);
	}
	public function form6(ShopSettingsRequests\Form6 $request)
	{
		try {
			DB::beginTransaction();
			$this->storeForms->formSix($request);
			DB::commit();
			return redirect()->back();
		} catch (\Exception $err) {
			DB::rollBack();
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
	}
	public function form7(ShopSettingsRequests\Form7 $request)
	{
		try {
			DB::beginTransaction();
			$this->storeForms->formSeven($request);
			DB::commit();
			return redirect()->back();
		} catch (\Exception $err) {
			DB::rollBack();
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
	}
	public function form8(ShopSettingsRequests\Form8 $request)
	{
		try {
			DB::beginTransaction();
			$this->storeForms->formEight($request);
			DB::commit();
			return redirect()->back();
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
	}
	public function form9(ShopSettingsRequests\Form9 $request)
	{
		try {
			DB::beginTransaction();
			$this->storeForms->formNine($request);
			DB::commit();
			return redirect()->back();
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
	}
	public function form10(ShopSettingsRequests\Form10 $request)
	{
		try {
			DB::beginTransaction();
			if ($request->action == 'delete') {
				$this->storeForms->form10Delete($request);
			}
			if ($request->action == 'save') {
				$this->storeForms->form10($request);
			}
			DB::commit();
			return redirect()->route('business.site-settings.gallery');
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
	}
}
