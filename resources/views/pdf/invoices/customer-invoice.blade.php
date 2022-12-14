@extends('pdf.layout.index')
@section('title', $filename)
@section('content')
	@php
		$data = count($bill->items) >= 12 ? collect($bill->items)->chunk(12) : collect([$bill]);
		// $chunk = count($bill->items) >= 12 ? true : false;
	@endphp
	@foreach ($data as $invoice)
		<div>
			<div class="header">
				<div class="">
					<img class="img_head" src="{{ !is_null($site_settings->site_icon) ? asset('storage/master/assets/' . $site_settings->site_icon) : asset('assets/Rectify/icons/rectify-dark-blue.png') }}" alt="">
				</div>
				<div class="header_p">
					<span>
						{{ $address }}
					</span>
					<h1>Customer Invoice Copy</h1>
				</div>
				<table style="width: 100%">
					<tr>
						<td style="text-align: left;">
							Billing id: {{ $bill->billingId }}
						</td>
						<td style="text-align: right;">
							Generated on: {{ now()->format('F d, o - h:i A') }}
						</td>
					</tr>
				</table>
			</div>

			{{-- top table --}}
			<table class="top_table">
				<tr style="width: 100%;">
					<th class="px-2" style="width: 50%;">
						<h2>Customer Information</h2>
					</th>
					<th class="px-2" style="width: 50%;">
						<h2>Service Details</h2>
					</th>
				</tr>
				<tr style="width: 100%;">
					<td class="px-2" style="width: 50%;">
						<div class="information px-2">
							<div>Customer: {{ $bill->appointment->user->firstname . ' ' . $bill->appointment->user->lastname }}</div>
							<div>Customer ID: {{ $bill->appointment->user->userId }}</div>
							<div>Email: {{ $bill->appointment->user->email }}</div>
							<div>Phone Number: {{ $bill->appointment->user->contact }}</div>
							<div>Alternate Phone Number: {{ $bill->appointment->alt_contact ?? __('Undefined') }}</div>
						</div>
					</td>
					<td class="px-2" style="width: 50%;">
						<div class="information px-2">
							<div>
								{{ $bill->repair_remarks }}
							</div>
						</div>
					</td>
				</tr>
			</table>

			{{-- bottom table --}}
			<table class="bottom_table" style="width: 100%;">
				{{-- metadata --}}
				<thead>
					<tr class="bottom_tr" style="width: 100%; background-color: #F2F2F2;">
						<th class="bottom_table_th">Item</th>
						<th class="bottom_table_th" style="text-align: center;">Quantity</th>
						<th class="bottom_table_th" style="text-align: center;">Price</th>
						<th class="bottom_table_th" style="text-align: right;">Subtotal</th>
					</tr>
				</thead>

				{{-- items row --}}
				<tbody>
					@foreach ($invoice->items as $_item => $_data)
						<tr class="bottom_tr">
							<td class="bottom_td">{{ $_item }}</td>
							<td class="bottom_td" style="text-align: center;">{{ $_data['quantity'] }}</td>
							<td class="bottom_td" style="text-align: center;">Php {{ number_format((float) $_data['price'], 2, '.', ',') }}</td>
							<td class="bottom_td" style="text-align: right;">Php {{ number_format((float) $_data['quantity'] * (float) $_data['price'], 2, '.', ',') }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>

		</div>
		<table style="width: 100%;position: absolute; bottom: 80px;">
			<tr>
				<td>
					<div class="" style="text-align: left;">
						<div>Page {{ $loop->iteration }} of {{ $loop->count }}</div>
						<div></div>
					</div>
				</td>
				<td>
					<div class="" style="text-align: right;">
						<div>Labour/Repair Cost: Php {{ number_format((float) $bill->repair_cost, 2, '.', ',') }}</div>
						<div style="font-weight: 700;">Total: Php {{ number_format((float) $bill->total, 2, '.', ',') }}</div>
					</div>
				</td>
			</tr>
		</table>
	@endforeach
@endsection
