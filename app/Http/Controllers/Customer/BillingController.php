<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PDF\GenerateReportController as PDF;
use App\Models\Billing;
use Illuminate\Http\Request;

class BillingController extends Controller
{
	public function __construct(
		private PDF $pdf,
		private $paginationSize = 30
	)
	{
	}
	public function print(Request $request)
	{
		$billingId = $request->billingId;
		$bill = Billing::findOrFail($billingId);
		return $this->pdf->exportInvoiceAppoinment($bill);
	}
}
