{{-- parent layout /resources/view/layouts/doubleNavigation --}}
@extends('layouts.doubleNavigation')

{{-- yield('title') --}}
@section('title')
	<title>{{ Str::title(config('app.name')) }} - Dashboard</title>
@endsection

@section('page_name')
	<!-- page name -->
	<span class="text-[#CDCECF]">Pages</span>
	<span>/</span>
	<span>Dashboard</span>
@endsection

{{-- yield('content') --}}
@section('content')
	{{-- header --}}
	<div class="business-header">
		<div class="flex flex-col gap-1">
			<h1 class="xl:basis-1/3 text-darkblue text-[24px] sm:text-[32px] font-extrabold">Dashboard</h1>
			@if (false)
				<span class="italic text-[12px]">Summarization of your shop's chuchumachu</span>
			@endif
		</div>
	</div>

	{{-- main content --}}
	<div class="h-[calc(100vh_-_135px)] sm:h-[calc(100vh_-_102px)] px-4 overflow-y-auto">
		<div class="mb-2 flex flex-col md:flex-row justify-center items-center gap-2">
			{{-- total sales --}}
			<div class="business-whitecard-bg w-full md:basis-1/2 flex flex-row justify-between items-center cursor-pointer" onclick="location.href='{{ route('business.reports.index') }}'">
				<div class="flex flex-col gap-1">
					<span>Today's Sales</span>
					<div class="flex flex-row gap-2 items-center">
						<span class="text-[24px] font-semibold">
							Php {{ number_format((float) $salesToday, 2, '.', ',') }}
						</span>
					</div>
				</div>

				<div class="w-[48px] h-[48px] p-2 flex justify-center items-center bg-{{ $site_settings->site_color_theme }} text-white text-[32px] rounded-[8px]">
					<i class="fa-solid fa-peso-sign"></i>
				</div>
			</div>

			{{-- total users --}}
			<div class="business-whitecard-bg w-full md:basis-1/2 flex flex-row justify-between items-center cursor-pointer" onclick="location.href='{{ route('business.users.index') }}'">
				<div class=" flex flex-col gap-1">
					<span>Total Users</span>
					<div class="flex flex-row gap-2 items-center">
						<span class="text-[24px] font-semibold">
							{{ $totalUsers ?? 0 }}
						</span>
					</div>
				</div>

				<div class="w-[48px] h-[48px] p-2 flex justify-center items-center bg-{{ $site_settings->site_color_theme }} text-white text-[32px] rounded-[8px]">
					<i class="fa-solid fa-user"></i>
				</div>
			</div>
		</div>

		@if ($products->count() > 0)
			<div class="flex flex-col gap-2">
				<span>Low Stock Products</span>
				<div class="business-whitecard-bg min-h-[95px] max-h-[475px] mb-2 flex flex-col gap-2">
					{{-- metadata --}}
					<div class="sticky top-0 p-2 hidden sm:flex flex-row justify-end items-center bg-dirtywhite text-gray">
						<span class="basis-[50px] invisible flex justify-center">.</span>
						<span class="basis-1/2 flex justify-center">Product Name</span>
						<span class="basis-1/2 flex justify-center">Stock</span>
					</div>

					<ul class="list-none flex flex-col gap-2 overflow-y-auto">
						@foreach ($products as $product)
							<x-business.low-stock-product-list :$product />
						@endforeach
					</ul>
				</div>
			</div>
		@endif

		<div class="business-whitecard-bg mb-2 flex flex-col gap-2">
			<span>Chart</span>
			<canvas class="flex flex-row justify-center items-center" id="chart-holder">
				Your browser does not support the canvas element.
			</canvas>
		</div>

		<div class="mb-2 flex flex-col lg:flex-row justify-center items-start gap-2">
			<div class="w-full lg:basis-1/2 flex flex-col">
				{{-- upcoming appointments --}}
				<span class="mb-2">Upcoming Appointments This Week</span>
				<div class="business-whitecard-bg w-full min-h-[108px] max-h-[444px] md:max-h-full overflow-y-auto">
					<ul class="list-none flex flex-col gap-2">
						@forelse ($appointmentData as $appointment)
							<x-business.upcoming-appointments-list :$appointment />
						@empty
							<li class="text-center">
								<h3>
									No upcoming appointments yet
								</h3>
							</li>
						@endforelse
					</ul>
				</div>
			</div>

			<div class="w-full lg:basis-1/2 flex flex-col">
				{{-- upcoming orders --}}
				<span class="mb-2">Upcoming Orders</span>
				<div class="business-whitecard-bg w-full min-h-[108px] max-h-[444px] md:max-h-full overflow-y-auto">
					<ul class="list-none flex flex-col gap-2">
						@forelse ($orderData as $order)
							<x-business.upcoming-orders-list :$order />
						@empty
							<li class="text-center">
								<h3>
									No upcoming orders yet
								</h3>
							</li>
						@endforelse
					</ul>
				</div>
			</div>
		</div>
	</div>

	@push('scripts')
		<script>
			const chartDiv = document.getElementById('chart-holder')
			var data = @json($this_week_sales_chart);
			console.log(data)
			Object.entries(data).map(([k, v]) => {
				console.log(k)
			})
			const cfg = {
				type: 'line',
				data: {
					labels: data.map(row => new Date(Date.parse(row.date)).toLocaleString('en-US', {
						month: 'short',
						day: '2-digit',
						week: 'short',
					})),
					datasets: [{
						label: 'Total Revenue for the past 7 Days (Php)',
						data: data.map(row => row.total),
						backgroundColor: '{{ $site_settings->site_color_hex }}',
						borderColor: '{{ $site_settings->site_color_hex }}'
					}]
				}
			};
			var weekChart;
			$(() => {
				weekChart = new Chart(chartDiv, cfg)
				weekChart.defaults.color = '{{ $site_settings->site_color_hex }}';
			});
		</script>
	@endpush
@endsection
