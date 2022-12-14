<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Traits\Business\AuthData;

class StoreProfileController extends Controller
{
    use AuthData;
    public function index()
    {
        return view('pages.client.stores')
        ->with($this->getAuthUserData());
    }
    public function create()
    {
        return view('pages.client.store-profile')
        ->with($this->getAuthUserData());
    }
}
