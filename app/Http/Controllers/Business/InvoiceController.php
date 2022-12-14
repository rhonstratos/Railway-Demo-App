<?php

namespace App\Http\Controllers\Business;

use App\Actions\Business\Reports\Export;
use App\Actions\Business\Reports\FilteredView;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PDF\GenerateReportController as PDF;
use App\Models\Billing;
use App\Models\Orders;
use App\Traits\Business\AuthData;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
	use AuthData;
	public function show($invoice)
	{

	}
}
