<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BannedUsersController extends Controller
{
	public function index()
	{
		return view('pages.user-banned');
	}
}
