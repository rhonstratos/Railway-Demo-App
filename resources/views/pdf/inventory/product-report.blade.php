@extends('pdf.layout.index')
@section('title', 'Product Report Inventory')
@section('content')
	<div>
		@foreach (range(1, 2) as $pdf)
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
						<h1>sales report for {{ $filter }}</h1>
					</div>
				</div>
				<div class="body">
					<div class="body_header">
						@if (isset($shopName) && isset($userID))
							<div>Shop Name: {{ $shopName }}</div>
							<div>User ID: {{ $userID }}</div>
						@else
							<div>Shop Name: Undefined</div>
							<div>User ID: Undefined</div>
						@endif
					</div>
					<div class="body_table">
						<table>
							<thead>
								<tr>
									<th>Product ID</th>
									<th>Date Added</th>
									<th>Product Name</th>
									<th>Category</th>
									<th>Condition</th>
									<th>Price [&#8369;]</th>
									<th>Stocks</th>
									<th>Sold</th>
								</tr>
							</thead>
							<tbody>
								@if (isset($product_report))
									@foreach ($product_report as $item)
										<tr>
											<td>{{ $item->id }}</td>
											<td>{{ $item->dateAdded }}</td>
											<td>{{ $item->name }}</td>
											<td>{{ $item->category }}</td>
											<td>{{ $item->condition }}</td>
											<td>{{ $item->price }}</td>
											<td>{{ $item->stocks }}</td>
											<td>{{ $item->sold }}</td>
										</tr>
									@endforeach
								@else
									@foreach (range(1, 17) as $item)
										<tr>
											<td>Undefined</td>
											<td>Undefined</td>
											<td>Undefined</td>
											<td>Undefined</td>
											<td>Undefined</td>
											<td>Undefined</td>
											<td>Undefined</td>
											<td>Undefined</td>
										</tr>
									@endforeach
								@endif
							</tbody>
						</table>
					</div>
					<div class="body_footer">
						<div>Page 1 of 2</div>
						<div>DateTime Generated: September 14, 2022 | 03:19 PM</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
@endsection
