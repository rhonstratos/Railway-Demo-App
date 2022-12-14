{{-- parent layout /resources/view/layouts/doubleNavigation --}}
@extends('layouts.doubleNavigation')

{{-- yield('title') --}}
@section('title')
	<title>{{ Str::title(config('app.name')) }} - Order</title>
@endsection

@section('page_name')
	<span class="text-[#CDCECF]">Pages</span>
	<span>/</span>
	<span>Orders</span>
@endsection

{{-- yield('content') --}}
@section('content')
	{{-- header --}}
	<div class="business-header">
		<span class="w-fit flex flex-row gap-3 items-center cursor-pointer"
			onclick="location.href='{{ route('business.orders.index') }}'">
			<span class="text-[20px]">&#10094;</span>
			<div class="flex flex-col gap-1">
				<h1 class="xl:basis-1/3 text-darkblue text-[24px] sm:text-[32px] font-extrabold">Order history</h1>
				<span class="italic text-[12px]">Review your past transactions</span>
			</div>
		</span>

		@if (false)
		<!-- buttons -->
		<div class="basis-1/2 xl:basis-1/3 flex flex-row gap-1 text-[12px] 2xl:text-[14px]">
			<button class="basis-1/2 h-[32px] px-3 bg-white rounded-[8px] shadow-lg truncate" onclick="">
				<span><i class="fa-solid fa-download"></i></span>
				<span>DOWNLOAD</span>
			</button>

			<button class="basis-1/2 h-[32px] px-3 bg-{{$site_settings->site_color_theme}} text-white rounded-[8px] shadow-lg truncate" onclick="">
				<span><i class="fa-solid fa-plus"></i></span>
				<span>CREATE NEW</span>
			</button>
		</div>
		@endif
	</div>

	{{-- main content --}}
	<div
		class="h-[calc(100vh_-_169px)] sm:h-[calc(100vh_-_138px)] xl:h-[calc(100vh_-_94px)] px-4 flex flex-col gap-2 text-[12px] 2xl:text-[14px]">
		{{-- top row --}}
		<div class="flex flex-col md:flex-row md:justify-between md:items-center gap-2">
			{{-- 3 buttons --}}
			<div
				class="md:basis-1/2 md:max-w-[444px] flex flex-row justify-between items-center bg-white rounded-[8px] shadow-lg">
				<button class="basis-1/3 w-full h-[32px] px-3 bg-{{$site_settings->site_color_theme}} text-white rounded-[8px] truncate"
					onclick="changeFilter(this.id)" id="showAll">
					<span>Show All</span>
				</button>
				<button class="basis-1/3 w-full h-[32px] px-3 bg-white rounded-[8px] truncate" onclick="changeFilter(this.id)"
					id="paidOrders">
					<span>Completed Orders</span>
				</button>
				<button class="basis-1/3 w-full h-[32px] px-3 bg-white rounded-[8px] truncate" onclick="changeFilter(this.id)"
					id="cancelledOrders">
					<span>Cancelled Orders</span>
				</button>
			</div>

			{{-- searchbar --}}
			<div class="md:basis-1/3 flex flex-row gap-2 items-center">
				<input class="business-input-textbox grow rounded-[8px]" type="text" placeholder="Search...">
				<button class="w-[32px] h-[32px] flex justify-center items-center bg-{{$site_settings->site_color_theme}} text-white rounded-[8px]">
					<i class="fa-solid fa-magnifying-glass"></i>
				</button>
			</div>
		</div>

		{{-- the table --}}
		<div class="md:business-whitecard-bg md:pt-0 grow overflow-y-auto">
			{{-- table something headings and metadata --}}
			<div class="sticky top-0 md:pt-4 pb-2 md:pb-0 flex-col gap-3 bg-light md:bg-white">
				<div class="md:pb-2 flex flex-row justify-between items-center">
					{{-- table headings --}}
					<div class="flex flex-row gap-2 justify-between items-center">
						<h2 class="text-[16px] font-semibold">Order Summary</h2>
					</div>

					{{-- dropdown for show --}}
					<div class="basis-1/2 max-w-[330px] flex flex-row gap-2 items-center">
						<span>Show</span>

						<select
							class="min-w-[91px] border-transparent w-full h-[32px] px-3 py-0 bg-white rounded-[8px] shadow-lg cursor-pointer text-[12px] 2xl:text-[14px]"
							id="showApptStatusList">
							<option value="">All</option>
						</select>
					</div>
				</div>

				{{-- metadata --}}
				<div class="py-2 hidden md:flex flex-row items-center bg-dirtywhite text-center rounded-t-[4px]">
					<span class="basis-1/5">Order ID</span>
					<span class="basis-1/5">Customer Name</span>
					<span class="basis-1/5">Date</span>
					<span class="basis-1/5">Status</span>
					<span class="basis-1/5"></span>
				</div>
			</div>

			{{-- order history table --}}
			<ul class="list-none">
				@forelse ($orders as $order)
					<x-business.order-history-list :data="$order" />
				@empty
				<li>
					<div>
						<h2>No orders yet</h2>
					</div>
				</li>
				@endforelse
			</ul>
		</div>

		{{-- put pagination here --}}
		<x-paginate-button :data="$orders"/>
	</div>

	<script>
		//custom scripts here
		function changeFilter(id) {
			switch (id) {
				case "showAll":
					document.getElementById("showAll").style.backgroundColor = "#FF9595";
					document.getElementById("showAll").style.color = "white";

					document.getElementById("paidOrders").style.backgroundColor = "white";
					document.getElementById("paidOrders").style.color = "#67748E";

					document.getElementById("cancelledOrders").style.backgroundColor = "white";
					document.getElementById("cancelledOrders").style.color = "#67748E";
					break;
				case "paidOrders":
					document.getElementById("showAll").style.backgroundColor = "white";
					document.getElementById("showAll").style.color = "#67748E";

					document.getElementById("paidOrders").style.backgroundColor = "#FF9595";
					document.getElementById("paidOrders").style.color = "white";

					document.getElementById("cancelledOrders").style.backgroundColor = "white";
					document.getElementById("cancelledOrders").style.color = "#67748E";
					break;
				case "cancelledOrders":
					document.getElementById("showAll").style.backgroundColor = "white";
					document.getElementById("showAll").style.color = "#67748E";

					document.getElementById("paidOrders").style.backgroundColor = "white";
					document.getElementById("paidOrders").style.color = "#67748E";

					document.getElementById("cancelledOrders").style.backgroundColor = "#FF9595";
					document.getElementById("cancelledOrders").style.color = "white";
					break;
			}
		}
	</script>
@endsection
