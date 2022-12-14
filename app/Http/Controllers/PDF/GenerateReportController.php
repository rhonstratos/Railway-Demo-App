<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\Shop;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class GenerateReportController extends Controller
{
	public function createProductInventoryReport()
	{
		$pdf = Pdf::loadView('pdf.inventory.product-report');
		$pdf->setPaper('legal', 'landscape');

		return
			response($pdf->stream(), 200)
				->header('Content-Type', 'application/pdf')
				->header('Content-Disposition', 'inline; filename="filename.pdf"');
	}

	public function exportReport(Collection $data, string $filter)
	{
		// dd($data->toArray());
		$shop = Shop::first();
		$addresses = $shop->address;
		$address = "{$addresses['street']}, {$addresses['brgy']}, {$addresses['city']}, {$addresses['province']}, {$addresses['zip']}";
		$address = Str::title($address);

		// dd($address);
		// return view('pdf.reports.report')
		// ->with(compact('data'))
		// ->with(compact('shop'))
		// ->with(compact('filter'))
		// ->with(compact('address'));

		$pdf = Pdf::loadHTML(
			view('pdf.reports.report')
				->with(compact('data'))
				->with(compact('shop'))
				->with(compact('address'))
				->with(compact('filter'))
				->render()
		)->setPaper('legal', 'landscape');
		$filename = 'report_' . now()->format('M-d-o_h-i-A');
		return
			response($pdf->stream(), 200)

				->header('Content-Type', 'application/pdf')
				->header('Content-Disposition', 'inline; filename="' . $filename . '.pdf"');
	}

	public function exportInvoiceAppoinment(Billing $bill)
	{
		$bill = $bill->load('appointment.user');
		$shop = Shop::first();
		$addresses = $shop->address;
		$address = "{$addresses['street']}, {$addresses['brgy']}, {$addresses['city']}, {$addresses['province']}, {$addresses['zip']}";
		$address = Str::title($address);
		$filename = 'customer_invoice_' . $bill->billingId . '_' . now()->format('M-d-o_h-i-A');
		// dd($bill->toArray());
		// return view('pdf.invoices.customer-invoice')
		// 	->with(compact('bill'))
		// 	->with(compact('shop'))
		// 	->with(compact('filename'))
		// 	->with(compact('address'));

		$pdf = Pdf::loadHTML(
			view('pdf.invoices.customer-invoice')
				->with(compact('bill'))
				->with(compact('shop'))
				->with(compact('address'))
				->with(compact('filename'))
				->render()
		)->setPaper('legal', 'portrait');
		return
			response($pdf->stream(), 200)
				->header('Content-Type', 'application/pdf')
				->header('Content-Disposition', 'inline; filename="' . $filename . '.pdf"');
	}
}
