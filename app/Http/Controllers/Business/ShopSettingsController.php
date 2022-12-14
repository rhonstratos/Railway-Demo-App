<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\ShopSettings as ShopSettingsRequests;
use App\Models\AccountSettings;
use App\Models\Shop;
use App\Traits\Business\AuthData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use PhpMyAdmin\Server\Privileges\AccountLocking;

class ShopSettingsController extends Controller
{
    use AuthData;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.shop.shop-settings')
            ->with($this->getAuthShopData());
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
    public function store(Request $request, $form)
    {
        // dump($request);
        // dd($form);
        return redirect()->back()->withInput();
    }

    public function formOne(ShopSettingsRequests\Form1 $request)
    {
        // dd($request);
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $shop = $user->shop;
            $settings = $user->accountSettings;
            $userId = $user->userId;
            $shop->name = $request->shop_name;
            $shop->tagline = $request->tagline;
            $settings->profile_img = $request->shop_img->getClientOriginalName();

            $image = $request->file('shop_img');
            $imageStatus = $image->storeAs("public/users/{$userId}/images/profile", $image->getClientOriginalName());
            if ($imageStatus == false) {
                // new event: error file upload after registration
            }

            $shop->save();
            $settings->save();
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
    public function formTwo(ShopSettingsRequests\Form2 $request)
    {
        // dd($request);
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $shop = $user->shop;

            $newAddress = [
                'street' => $request->street,
                'province' => $request->province,
                'city' => $request->city,
                'brgy' => $request->brgy,
                'zip' => $request->zip,
            ];
            $shop->address = $newAddress;
            $shop->googleMaps_embed = $request->googleMaps_embed;

            $shop->save();
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
    public function formThree(ShopSettingsRequests\Form3 $request)
    {
        // dd($request);
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $shop = $user->shop;

            $shop->description = $request->shop_desc;
            $shop->contacts = $request->contacts;

            $shop->save();
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
    public function formFour(ShopSettingsRequests\Form4 $request)
    {
        #dd($request->only('operating_days'));
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $shop = $user->shop;

            $shop;
            $newOperatingDays = [];
            foreach (config('enums.week_days') as $key => $days) {
                if (isset($request->operating_days[$key])) {
                    array_push($newOperatingDays, $key);
                }
            }
            #dd(Carbon::createFromFormat('h:i A', $request->time_opening));

            $newAppointmentSettings = [
                'operatingHours' => [
                    'start' => $request->time_opening,
                    'end' => $request->time_closing
                ],
                'operatingDays' => $newOperatingDays,
                'accomodation_slots' => $request->time_interval,
                'accomodation_interval' => [
                    'hours' => $request->time_interval_hour,
                    'minutes' => $request->time_interval_minute
                ]
            ];
            # dd($newAppointmentSettings);
            $shop->appointment_settings = $newAppointmentSettings;
            #dd($shop->appointment_settings);

            $shop->save();
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
