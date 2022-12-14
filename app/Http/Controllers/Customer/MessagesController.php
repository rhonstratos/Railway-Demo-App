<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Traits\Business\AuthData;

class MessagesController extends Controller
{
    use AuthData;
    public function index()
    {
        return view('pages.client.messages')
        ->with($this->getAuthUserData());
    }
}
