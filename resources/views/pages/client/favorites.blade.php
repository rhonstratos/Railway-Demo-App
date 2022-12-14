@extends('layouts.customer')

@section('title')
	{{-- remind rhon na dynamic ang title neto --}}
	{{-- na dadagdag sa dulo yung name ng product --}}
	<title>{{ Str::title(config('app.name')) }} - Favorites</title>
@endsection

@section('content')

	<!-- product section starts  -->
	<section class="bg-[#F8F9FA] lg:py-[5rem] lg:px-[9%] py-[3rem] px-[2rem]">

		<h1 class="text-center mb-[2rem] relative">
			<span class="text-[3rem] py-[.5rem] px-[2rem] text-[#344767] font-extrabold">
				Favorites
			</span>
		</h1>
		@if ($favorites->count() < 1)
			<x-customer.empty-section :asset="asset('assets/Rectify/customer-home/no-favorite.png')" header="No favorites yet" paragraph1="Click the heart icon of the product,"
				paragraph2="and you'll see it here next time" :route="route('customer.products.index')" buttontext="Shop now" divclass=""
				imgclass=" w-[15rem] my-[3rem]" buttonclass="my-[1rem] ml-5 py-[.7rem] px-[7rem]" />
		@else
			<div class="box-container flex-wrap gap-[1.5rem] grid md:grid-cols-5 grid-cols-2">

				@forelse ($favorites as $favorite)
					<x-customer.product-card :favorite="true" :product-id="$favorite->product->productId" :name="$favorite->product->name" :price="$favorite->product->price" :img-showcase="$favorite->product->img_showcase"
						:product-ratings="$favorite->avg_ratings" />
				@empty
					<div>
						<h2>you have no favorites yet</h2>
					</div>
				@endforelse
			</div>
			{{-- pagination buttons --}}
			<x-customer.paginate-buttons :data="$favorites" />
		@endif
	</section>

	<script>
		const addToFavorite = (event, el) => {
			let elem = $('#' + el)
			$.ajax({
				type: elem.attr('method'),
				url: elem.attr('action'),
				data: new FormData(document.getElementById(el)),
				contentType: false,
				cache: false,
				processData: false,
				success: (data) => {
					console.log(data)
					$('#heart-' + el.substring(4)).toggleClass('text-[#344767]')
					$('#heart-' + el.substring(4)).toggleClass('text-{{$site_settings->site_color_theme}}')
				},
				error: (data) => {
					console.log(data.code)
					console.log(data.message)
				}
			})
			event.preventDefault()
		};
	</script>
@endsection
