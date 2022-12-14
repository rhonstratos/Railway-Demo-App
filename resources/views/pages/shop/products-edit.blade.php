@extends('layouts.doubleNavigation')
{{-- rename this to business or shop --}}

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Products</title>
@endsection

@section('content')
	{{-- header --}}
	<form method="post" action="{{ route('business.products.update', $product->id) }}" enctype="multipart/form-data">
		@csrf
		@method('PATCH')
		<!-- Session Status -->
		<x-auth-session-status class="mb-4" :status="session('status')" />

		<!-- Validation Errors -->
		<x-auth-validation-errors class="mb-4" :errors="$errors" />

		<div class="business-header">
			<h1 class="xl:basis-1/3 text-darkblue text-[24px] sm:text-[32px] font-extrabold">
				Edit product
			</h1>

			<!-- 4 Buttons -->
			<div class="xl:basis-1/2 h-[32px] flex flex-row gap-1">
				{{-- publish --}}
				<button
					class="w-[127px] sm:basis-1/4 bottom-[53px] right-[20px] px-3 py-2 fixed sm:static flex gap-1 justify-center items-center bg-{{$site_settings->site_color_theme}} text-white rounded-[8px] shadow-lg truncate">
					<span>
						<i class="fa-solid fa-upload"></i>
					</span>
					<span class="">
						Publish
					</span>
				</button>
				@if (false)
					{{-- save draft --}}
					<button
						class="px-3 basis-1/3 sm:basis-1/4 flex gap-1 justify-center items-center bg-white text-status-green rounded-[8px] shadow-lg truncate">
						<span>
							<i class="fa-solid fa-floppy-disk"></i>
						</span>
						<span class="">
							Draft
						</span>
						<span class="hidden">
							Save draft
						</span>
					</button>
				@endif

				{{-- delete --}}
				<button
					class="px-3 basis-1/3 sm:basis-1/4 flex gap-1 justify-center items-center bg-white text-status-red rounded-[8px] shadow-lg truncate">
					<span>
						<i class="fa-solid fa-trash-can"></i>
					</span>
					<span class="">
						Delete
					</span>
				</button>

				{{-- cancel --}}
				<a class="px-3 basis-1/3 sm:basis-1/4 flex gap-1 justify-center items-center bg-white rounded-[8px] shadow-lg"
					href="{{ route('business.products.index') }}">
					<button class="truncate">
						<span class="text-[18px]">&#10799;</span>
						<span class="">Cancel</span>
					</button>
				</a>
			</div>
		</div>

		{{-- main content --}}
		<div
			class="h-[calc(100vh_-_147px)] sm:h-[calc(100vh_-_116px)] xl:h-[calc(100vh_-_72px)] px-4 flex flex-col lg:flex-row gap-2 overflow-y-auto">
			<div class="lg:basis-3/5 flex flex-col gap-2">
				<section class="business-whitecard-bg">
					{{-- category section --}}
					<h2 class="2xl:text-[18px]">Category</h2>
					<section class="px-[5px] flex flex-col gap-1">
						<select class="w-full h-[32px] px-3 py-0 rounded-[4px] text-[12px]" name="category" id="category">
							<option value="{{ $product->category }}"selected>{{ $product->category }}</option>
						</select>

						<div class="flex flex-row gap-1 justify-between items-center">
							<div class="{{-- basis-1/2 --}} w-full">
								<div>
									<span>Product name</span>
									<span class="text-{{$site_settings->site_color_theme}}">*</span>
								</div>
								<input class="w-full business-input-textbox" type="text" name="product_name" id="product_name"
									value="{{ $product->name }}" placeholder="">
							</div>

							@if (false)
								<div class="basis-1/2 text-[12px]">
									<div>
										<span>Product brand</span>
										<span class="text-{{$site_settings->site_color_theme}}">*</span>
									</div>
									<input class="w-full business-input-textbox" type="text" name="" id="" placeholder="">
								</div>
							@endif

						</div>
					</section>

					{{-- about the product section --}}
					<h2 class="2xl:text-[18px]">About the product</h2>
					<section class="px-[5px] flex flex-col gap-1">
						{{-- condition --}}
						<div class="flex flex-col">
							<div>
								<span>Condition</span>
								<span class="text-{{$site_settings->site_color_theme}}">*</span>
							</div>
							<div class="my-2 flex flex-row gap-3 items-center">
								<div class="flex flex-row gap-2 items-center">
									<input type="radio" name="condition" {{ $product->details['condition'] == 'new' ? __('checked') : null }}
										value="new" id="brandnew">
									<label for="brandnew">Brand new</label>
								</div>

								<div class="flex flex-row gap-2 items-center">
									<input type="radio" name="condition" {{ $product->details['condition'] == 'used' ? __('checked') : null }}
										value="used" id="used">
									<label for="used">Used</label>
								</div>
							</div>
						</div>

						{{-- price and quantity --}}
						<div class="flex flex-row gap-1">
							<div class="basis-1/2 flex flex-col gap-1">
								<div>
									<span>Price</span>
									<span class="text-{{$site_settings->site_color_theme}}">*</span>
								</div>
								<input class="w-full business-input-textbox" type="number" name="price" value="{{ $product->price }}"
									placeholder="" id="price">
							</div>
							<div class="basis-1/2 flex flex-col gap-1">
								<div>
									<span>Quantity</span>
									<span class="text-{{$site_settings->site_color_theme}}">*</span>
								</div>
								<input class="w-full business-input-textbox" type="number" name="quantity"
									value="{{ $product->currentInventory()->quantity }}" id="quantity">
							</div>
						</div>

						{{-- product description --}}
						<div class="flex flex-col gap-1">
							<div>
								<span>Product description</span>
								<span class="text-{{$site_settings->site_color_theme}}">*</span>
							</div>
							<textarea class="border-none px-2 py-1 bg-dirtywhite text-[11px] rounded-[7px]" name="product_description"
							 id="product_description" rows="3" form="billing" placeholder="undefined">{{ $product->details['description'] }}</textarea>
						</div>

						{{-- product specification --}}
						<div class="flex flex-col gap-1">
							<div class="flex flex-col">
								<div>
									<span>
										Product specifications
									</span>
									<span class="text-{{$site_settings->site_color_theme}}">*</span>
								</div>
								<span class="italic">
									Providing additional details, buyer can find your listing easily.
								</span>
							</div>

							{{-- the additional specs --}}
							<div class="flex flex-col gap-1">
								@foreach ($product->details['speficications'] as $k => $v)
									<div class="flex flex-row gap-1">
										<div class="basis-1/2">
											<input class="w-full business-input-textbox" type="text" name="spec_key[]" value="{{ $k }}"
												placeholder="dimensions">
										</div>
										<div class="basis-1/2">
											<input class="w-full business-input-textbox" type="text" name="spec_value[]"
												value="{{ $v }}" placeholder="120mm">
										</div>
									</div>
								@endforeach
							</div>

							{{-- add more4 --}}
							<div class="flex flex-col justify-center items-end">
								<button class="w-[102px] p-2 bg-{{$site_settings->site_color_theme}} rounded-[4px] text-white" id="addMore">
									add more
								</button>
							</div>
						</div>

						{{-- transfer method --}}
						<div class="px-[5px] flex flex-col gap-1">
							<div>
								<span>Transfer Method</span>
							</div>
							<div class="flex flex-row justify-between items-center">
								<div class="flex flex-row gap-2">
									<input type="checkbox" name="transfer_method[]" value="pick-up" id="shopPickup"
										{{ in_array('pick-up', $product->details['transfer_method']) ? __('checked') : null }}>
									<label for="shopPickup">
										Shop pick-up
									</label>
								</div>

								<div class="flex flex-row gap-2">
									<input type="checkbox" name="transfer_method[]" value="meet-up" id="meetup"
										{{ in_array('meet-up', $product->details['transfer_method']) ? __('checked') : null }}>
									<label for="shopPickup">
										Meet-up
									</label>
								</div>

								<div class="flex flex-row gap-2">
									<input type="checkbox" name="transfer_method[]" value="delivery" id="delivery"
										{{ in_array('delivery', $product->details['transfer_method']) ? __('checked') : null }}>
									<label for="shopPickup">
										Delivery
									</label>
								</div>
							</div>
						</div>
					</section>
				</section>

				{{-- image uploads --}}
				<section class="p-[10px] flex flex-col bg-white rounded-[8px] shadow-lg">
					<div class="flex flex-row justify-between items-center">
						{{-- image thumbnail --}}
						<div class="h-full basis-1/2 flex flex-col gap-1 items-center">
							<span class="basis-[24px]">Image thumbnail</span>

							{{-- lagay mo ung image preview here --}}
							<div class="w-[100px] h-[100px] grow bg-customgray-lightgray rounded-[4px]">
								<x-business.product-img-box :id="$product->productId" :file="$product->img_showcase" />
							</div>

							<button onclick="$('#img_showcase').click()" type="button"
								class="basis-[32px] px-3 py-1 bg-{{$site_settings->site_color_theme}} text-white rounded-[4px]">
								Upload
							</button>
						</div>

						<div class="h-full basis-1/2 flex flex-col gap-1 items-center">
							<span class="basis-[24px]">Image showcase</span>

							{{-- image --}}
							<div class="grow flex justify-center items-center gap-2">
								@foreach ($product->img as $img)
									<x-business.product-img-box :id="$product->productId" :file="$img" />
								@endforeach
							</div>
							<input id="product_img" type="file" name="product_img[]" accept="image/*" multiple hidden class="hidden">
							<button onclick="$('#product_img').click()" type="button"
								class="basis-[32px] px-3 py-1 bg-{{$site_settings->site_color_theme}} text-white rounded-[4px]">
								Upload
							</button>
						</div>
					</div>
				</section>

				{{-- image preview --}}
				<section class="mb-[81px] p-[10px] flex flex-col gap-2 bg-white rounded-[8px] shadow-lg">
					<div>
						palagay na lang ng mga previews here
					</div>
					<div class="flex flex-col justify-between items-center">
						<button type="submit" class="w-[150px] px-3 py-1 bg-{{$site_settings->site_color_theme}} text-white rounded-[4px]">
							save
						</button>
					</div>
				</section>
			</div>
		@endsection
