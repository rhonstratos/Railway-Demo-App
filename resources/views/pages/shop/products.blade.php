@extends('layouts.doubleNavigation')
{{-- rename this to business or shop --}}

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Products</title>
@endsection

@section('content')
	{{-- header --}}
	<div class="w-full pb-[20px] xl:pb-[10px] px-4 xl:basis-[58px] flex gap-1 flex-row justify-between items-center">
		<h1 class="xl:basis-1/3 text-darkblue text-[24px] sm:text-[32px] font-extrabold">Products</h1>

		{{-- searchbar --}}
		<div class="flex flex-row gap-1">
			<button type="button" class="w-full h-[32px] px-3 bg-{{ $site_settings->site_color_theme }} text-white rounded-[8px] shadow-lg truncate" onclick="location.href='{{ route('business.products.create') }}'">
				<span><i class="fa-solid fa-plus"></i></span>
				<span class="hidden">Add</span>
				<span class="hidden">New</span>
				<span>Product</span>
			</button>
		</div>
	</div>

	{{-- main content --}}
	<div class="h-[calc(100vh_-_133px)] sm:h-[calc(100vh_-_84px)] xl:h-[calc(100vh_-_74px)]
	px-4 flex flex-col gap-2 rounded-[8px]">
		@if (false)
			{{-- filter options --}}
			<div class="basis-[19px] md:w-[300px] flex flex-row justify-around items-center text-darkblue">
				<label class="border-b-[1px] border-pink font-bold" for="all" id="allLabel" onclick="changeProductFilter(this.id);loadAll()">
					<span>All</span>
				</label>
				<label class="border-b-[1px] border-transparent" for="listed" id="listedLabel" onclick="changeProductFilter(this.id)">
					<span>Listed</span>
				</label>
				<label class="border-b-[1px] border-transparent" for="unlisted" id="unlistedLabel" onclick="changeProductFilter(this.id)">
					<span>Unlisted</span>
				</label>
				<label class="border-b-[1px] border-transparent" for="soldOut" id="soldOutLabel" onclick="changeProductFilter(this.id)">
					<span>Sold out</span>
				</label>

				{{-- make it hidden in plain sight - radio button for filter options --}}
				<input class="absolute -top-full" type="radio" name="filterOptions" checked id="all">
				<input class="absolute -top-full" type="radio" name="filterOptions" id="listed">
				<input class="absolute -top-full" type="radio" name="filterOptions" id="unlisted">
				<input class="absolute -top-full" type="radio" name="filterOptions" id="soldOut">
			</div>
		@endif

		{{-- the table --}}
		<div class="grow flex flex-col gap-2 rounded-[8px] sm:shadow-lg overflow-y-auto">
			<form id="product_search" onsubmit="_advanceSearch(this,event)" action="{{ route('business.products.search') }}" method="post" class="px-2 pt-2 flex flex-row gap-2 justify-end">
				@csrf
				{{-- searchbar --}}
				<div class="w-full md:w-1/3 h-[32px] flex flex-row bg-dirtywhite rounded-[8px] items-center">
					<i class="fa-solid fa-magnifying-glass px-2"></i>
					<input name="search" value="{{ isset($filter['search']) ? $filter['search'] : null }}" class="business-input-textbox bg-transparent w-full focus:ring-{{ $site_settings->site_color_theme }}" type="text"
						placeholder="Browse by ID or Product Name...">
				</div>

				{{-- search button --}}
				@if (false)
					<button type="submit" class="w-[32px] lg:w-auto h-[32px] lg:px-3 flex flex-row justify-center items-center gap-2 bg-white rounded-[4px] shadow-lg truncate">
						<i class="fa-solid fa-magnifying-glass"></i>
						<span class="hidden lg:inline-block">Search</span>
					</button>
				@endif
			</form>

			{{-- metadata --}}
			<div class="sticky top-0 p-2 hidden sm:flex flex-row justify-center items-center bg-dirtywhite text-gray">
				<span class="basis-[14.3%] flex justify-center">Product Name</span>
				<span class="basis-[14.3%] flex justify-center">Price</span>
				<span class="basis-[14.3%] flex justify-center">Stock</span>
				<span class="basis-[14.3%] flex justify-center">Sold</span>
				<span class="basis-[14.3%] flex justify-center">Action</span>
			</div>

			{{--  product list data --}}
			<ul id="product_list" class="list-none">
				<x-business.product-list :$products />
			</ul>
		</div>
		<div id="product_list_paginate" class="flex flex-col">
			<x-paginate-button :data="$products" />
		</div>
	</div>

	{{-- scripts are here --}}
	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		const _advanceSearch = (el, event, url = null) => {
			event.preventDefault()
			let data = $('#' + el.id).serializeArray()
			if (url == null) {
				url = location.href
			}
			$.get(url, data)
				.done((data) => {
					$('#product_list').html(data['list'])
					$('#product_list_paginate').html(data['paginate'])
				})
				.fail((jqXHR, ajaxOptions, thrownError) => {
					alert('An unexpected error occured, please try again.')
				})
		};
		const _paginate = (e) => {
			e.preventDefault()
			let _url = e.currentTarget.dataset.href
			_advanceSearch(
				document.getElementById('product_search'),
				e,
				_url
			)
		};
		$(() => {
			$('#product_search').change(() => {
				$('#product_search').submit()
			})
			$('._paginate_btn').click(_paginate)
		});

		function changeProductFilter(id) {
			switch (id) {
				case "allLabel":
					document.getElementById("allLabel").style.fontWeight = "bold";
					document.getElementById("allLabel").style.borderColor = "#FF9595";

					document.getElementById("listedLabel").style.fontWeight = "normal";
					document.getElementById("listedLabel").style.borderColor = "transparent";

					document.getElementById("unlistedLabel").style.fontWeight = "normal";
					document.getElementById("unlistedLabel").style.borderColor = "transparent";

					document.getElementById("soldOutLabel").style.fontWeight = "normal";
					document.getElementById("soldOutLabel").style.borderColor = "transparent";
					break;
				case "listedLabel":
					document.getElementById("allLabel").style.fontWeight = "normal";
					document.getElementById("allLabel").style.borderColor = "transparent";

					document.getElementById("listedLabel").style.fontWeight = "bold";
					document.getElementById("listedLabel").style.borderColor = "#FF9595";

					document.getElementById("unlistedLabel").style.fontWeight = "normal";
					document.getElementById("unlistedLabel").style.borderColor = "transparent";

					document.getElementById("soldOutLabel").style.fontWeight = "normal";
					document.getElementById("soldOutLabel").style.borderColor = "transparent";
					break;
				case "unlistedLabel":
					document.getElementById("allLabel").style.fontWeight = "normal";
					document.getElementById("allLabel").style.borderColor = "transparent";

					document.getElementById("listedLabel").style.fontWeight = "normal";
					document.getElementById("listedLabel").style.borderColor = "transparent";

					document.getElementById("unlistedLabel").style.fontWeight = "bold";
					document.getElementById("unlistedLabel").style.borderColor = "#FF9595";

					document.getElementById("soldOutLabel").style.fontWeight = "normal";
					document.getElementById("soldOutLabel").style.borderColor = "transparent";
					break;
				case "soldOutLabel":
					document.getElementById("allLabel").style.fontWeight = "normal";
					document.getElementById("allLabel").style.borderColor = "transparent";

					document.getElementById("listedLabel").style.fontWeight = "normal";
					document.getElementById("listedLabel").style.borderColor = "transparent";

					document.getElementById("unlistedLabel").style.fontWeight = "normal";
					document.getElementById("unlistedLabel").style.borderColor = "transparent";

					document.getElementById("soldOutLabel").style.fontWeight = "bold";
					document.getElementById("soldOutLabel").style.borderColor = "#FF9595";
					break;
			}
		}
	</script>
@endsection
