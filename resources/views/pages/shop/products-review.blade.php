@extends('layouts.doubleNavigation')
{{-- rename this to business or shop --}}

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Products</title>
@endsection

@section('content')
	{{-- header --}}
	<div class="business-header lg:flex-row lg:justify-between lg:items-center">
		<div class="w-fit flex flex-row gap-3 items-center cursor-pointer"
			onclick="location.href='{{ route('business.products.index') }}'">
			<span class="text-[20px]">&#10094;</span>
			<div class="flex flex-col">
				<h1 class="xl:basis-1/3 text-darkblue text-[24px] sm:text-[32px] font-extrabold">
					<span>Product Reviews</span>
				</h1>
				<span class="text-[12px] capitalize">Product name: {{ $product->name }}</span>
			</div>
		</div>

		{{-- filter options  --}}
		<form
			class="business-whitecard-bg flex flex-col md:flex-row lg:basis-[60%] gap-2 items-end lg:bg-transparent text-[12px] 2xl:text-[14px] lg:shadow-none"
			action="{{ route('business.products.reviews.filter', $product->productId) }}" method="post">
			@csrf

			<div class="w-full flex flex-col md:flex-row gap-2">
				{{-- status filter --}}
				<div class="md:basis-1/2 w-full flex flex-col gap-1">
					<span class="">Stars</span>

					<select
						class="w-full border-none h-[32px] px-3 py-0 bg-white rounded-[8px] shadow-lg cursor-pointer text-[12px] 2xl:text-[14px]"
						name="review_stars" id="showApptStatusList">
						<option value="all">All</option>
						<option value="1">&#9733;</option>
						<option value="2">&#9733;&#9733;</option>
						<option value="3">&#9733;&#9733;&#9733;</option>
						<option value="4">&#9733;&#9733;&#9733;&#9733;</option>
						<option value="5">&#9733;&#9733;&#9733;&#9733;&#9733;</option>
					</select>
				</div>

				{{-- date range --}}
				<div class="md:basis-1/2 w-full flex flex-col gap-1">
					<span class="">Date range</span>

					<div class="flex flex-row gap-2 justify-between items-center overflow-x-auto">
						{{-- date from --}}
						<div class="w-full flex flex-col gap-1">
							<span class="hidden {{-- invisible --}}">fake span</span>
							<input class="business-input-textbox border-[1px] rounded-[8px]" type="date" name="review_date_start"
								id="review_date_start">
						</div>

						{{-- "to" --}}
						<div class="flex flex-col gap-1 justify-around">
							<span class="text-center">to</span>
						</div>

						{{-- date to --}}
						<div class="w-full flex flex-col gap-1">
							<span class="hidden {{-- invisible --}}">fake span</span>
							<input class="business-input-textbox border-[1px] rounded-[8px]" type="date" name="review_date_end"
								id="review_date_end">
						</div>
					</div>
				</div>
			</div>
			{{-- <button type="submit">go</button> --}}

			{{-- search button --}}
			<button type="submit"
				class="w-auto h-[32px] px-3 flex flex-row justify-center items-center gap-2 bg-white rounded-[8px] shadow-lg truncate">
				<i class="fa-solid fa-magnifying-glass"></i>
				<span class="lg:hidden">Search</span>
			</button>
		</form>
	</div>

	{{-- main content --}}
	<div
		class="h-[calc(100vh_-_321px)] sm:h-[calc(100vh_-_290px)] md:h-[calc(100vh_-_188px)] lg:h-[calc(100vh_-_118px)] xl:h-[calc(100vh_-_110px)] 2xl:h-[calc(100vh_-_113px)] px-4 flex flex-col gap-2 text-[12px] 2xl:text-[14px]">
		<ul class="grow list-none flex flex-col overflow-y-auto">
			@forelse ($reviews as $review)
				<x-business.product-review-card :$review />
			@empty
				<div class="text-[24px] text-center">
					<h2>
						No search/filter results or reviews found
					</h2>
				</div>
			@endforelse
		</ul>

		<span>pagination here</span>
	</div>

	{{-- scripts are here --}}
	<script>
		// custom scripts here
	</script>
@endsection
