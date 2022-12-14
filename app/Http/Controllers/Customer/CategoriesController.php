<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Traits\Business\AuthData;

class CategoriesController extends Controller
{
    use AuthData;
    public function index()
    {
        return view('pages.client.categories')
        ->with($this->getAuthUserData());
    }
}
