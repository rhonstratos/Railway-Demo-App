@extends('pdf.layout.index')
@section('title', 'Sales Report for ' . $filter)
@section('content')
	@php
		$addresses = $shop->address;
	@endphp
	<div>
		@foreach ($data->chunk(15) as $items)
			<div class="page-{{ $loop->iteration }}">
				<div class="header">
					<div class="m-2">
						<img class="img_head"
							src="{{ !is_null($site_settings->site_icon) ? asset('storage/master/assets/' . $site_settings->site_icon) : 'data:image/png;base64,' . base64_encode(File::get(resource_path() . '/assets/images/Rectify/icons/rectify-dark-blue.png')) }}"
							alt="">
					</div>
					<div class="header_p">
						<span>
							{{ $address }}
						</span>
						<h1><strong>sales report for {{ $filter }}</strong></h1>
					</div>
				</div>
				<div class="body">
					<div class="body_header">
						<div>Shop Name: {{ $shop->name }}</div>
						<div>User ID: {{ $shop->user->userId }}</div>
					</div>
					<div class="body_table">
						<table>
							<thead>
								<tr>
									<th style="text-align: center;">
										Billing/Order ID
									</th>
									<th style="text-align: center;">
										Total &#8369; {{ $data->sum('total') ? number_format((float) $data->sum('total'), 2, '.', ',') : null }}
									</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($items as $item)
									<tr>
										<td>
											{{ $item->billingId ? 'Billing:' . $item->billingId : ($item->orderId ? 'Order:' . $item->orderId : __('Undefined')) }}
										</td>
										<td class="text-end">
											Php {{ number_format((float) $item->total, 2, '.', ',') }}
										</td>
									</tr>
								@empty
									<tr>
										<td colspan="2">Undefined</td>
									</tr>
								@endforelse
							</tbody>
						</table>
					</div>
					<table style="width: 100%;position: absolute; bottom: 40px;">
						<tr>
							<td>
								<div class="" style="text-align: left;">
									<div>Page {{ $loop->iteration }} of {{ $loop->count }}</div>
								</div>
							</td>
							<td>
								<div class="" style="text-align: right;">
									<div>Generated on: {{ now()->format('F d, o - h:i A') }}</div>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
		@endforeach
	</div>
@endsection
