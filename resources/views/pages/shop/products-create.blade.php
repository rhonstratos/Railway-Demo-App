@extends('layouts.doubleNavigation')
{{-- rename this to business or shop --}}

@section('title')
	<title>{{ Str::title(config('app.name')) }} - Products</title>
@endsection

@section('content')
	{{-- header --}}
	<form method="post" action="{{ isset($product) ? route('business.products.update', $product->productId) : route('business.products.store') }}" enctype="multipart/form-data">
		@csrf
		@isset($product)
			@method('PUT')
		@endisset
		<div class="business-header sm:flex-row sm:justify-between sm:items-center">
			<span class="w-fit flex flex-row gap-3 items-center cursor-pointer" onclick="location.href='{{ route('business.products.index') }}'">
				<span class="text-[20px]">&#10094;</span>
				<div class="flex flex-col gap-1">
					<h1 class="xl:basis-1/3 text-darkblue text-[24px] sm:text-[32px] font-extrabold">{{ $pageTitle }}</h1>
				</div>
			</span>

			<!-- 4 Buttons -->
			<div class="flex flex-row gap-1">
				{{-- publish --}}
				<button type="submit" class="w-[150px] bottom-[53px] right-[20px] px-3 py-2 fixed sm:static flex gap-1 justify-center items-center bg-{{ $site_settings->site_color_theme }} text-white rounded-[8px] shadow-lg truncate z-[1]">
					<span>
						<i class="fa-solid fa-upload"></i>
					</span>
					<span class="">
						{{ !isset($product) ? __('Publish') : __('Save Changes') }}
					</span>
				</button>
				@if (false)
					{{-- save draft --}}
					<button class="px-3 basis-1/3 sm:basis-1/4 flex gap-1 justify-center items-center bg-white text-status-green rounded-[8px] shadow-lg truncate">
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

					{{-- delete --}}
					<button class="px-3 basis-1/3 sm:basis-1/4 flex gap-1 justify-center items-center bg-white text-status-red rounded-[8px] shadow-lg truncate">
						<span>
							<i class="fa-solid fa-trash-can"></i>
						</span>
						<span class="">
							Delete
						</span>
					</button>
				@endif
			</div>
		</div>

		{{-- main content --}}
		<div class="h-[calc(100vh_-_111px)] sm:h-[calc(100vh_-_80px)] xl:h-[calc(100vh_-_72px)] px-4 flex flex-col lg:flex-row gap-2 overflow-y-auto">
			{{-- main body --}}
			<div class="lg:basis-3/5 flex flex-col gap-2">
				<section class="business-whitecard-bg">
					<!-- Session Status -->
					<x-auth-session-status class="mb-4" :status="session('status')" />

					<!-- Validation Errors -->
					<x-auth-validation-errors class="mb-4" :errors="$errors" />
					{{-- category section --}}
					<h2 class="2xl:text-[18px]">Category</h2>
					<section class="px-[5px] flex flex-col gap-1">
						<select class="w-full h-[32px] px-3 py-0 focus:border-{{ $site_settings->site_color_theme }} rounded-[4px] shadow-lg focus:ring-{{ $site_settings->site_color_theme }}" name="category" id="category">
							<option value="" selected disabled>
								<span>Select a Category</span>
							</option>
							<option value="Mobile and Gadgets" {{ isset($product->category) && $product->category == 'Mobile and Gadgets' ? __('selected') : null }}>
								<span>Mobile and Gadgets</span>
							</option>
							<option value="Computers and Accessories" {{ isset($product->category) && $product->category == 'Computers and Accessories' ? __('selected') : null }}>
								<span>Computers and Accessories</span>
							</option>
							<option value="Gaming and Consoles" {{ isset($product->category) && $product->category == 'Gaming and Consoles' ? __('selected') : null }}>
								<span>Gaming and Consoles</span>
							</option>
							<option value="Audio" {{ isset($product->category) && $product->category == 'Audio' ? __('selected') : null }}>
								<span>Audio</span>
							</option>
							<option value="Cameras and Drones" {{ isset($product->category) && $product->category == 'Cameras and Drones' ? __('selected') : null }}>
								<span>Cameras and Drones</span>
							</option>
							<option value="Others" {{ isset($product->category) && $product->category == 'Others' ? __('selected') : null }}>
								<span>Others</span>
							</option>
						</select>

						<div class="flex flex-row gap-1 justify-between items-center">
							<div class="{{-- basis-1/2 --}} w-full">
								<div>
									<span>Product name</span>
									<span class="text-{{ $site_settings->site_color_theme }}">*</span>
								</div>
								<input class="w-full business-input-textbox focus:ring-{{ $site_settings->site_color_theme }}" type="text" name="product_name" id="product_name" value="{{ isset($product->category) ? $product->name : old('product_name') }}"
									placeholder="">
							</div>

							@if (false)
								<div class="basis-1/2 text-[12px]">
									<div>
										<span>Product brand</span>
										<span class="text-{{ $site_settings->site_color_theme }}">*</span>
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
								<span class="text-{{ $site_settings->site_color_theme }}">*</span>
							</div>
							<div class="my-2 flex flex-row gap-3 items-center">
								<div class="flex flex-row gap-2 items-center">
									<input class="accent-{{ $site_settings->site_color_theme }}" type="radio" name="condition"
										{{ (isset($product->details['condition']) && $product->details['condition'] == 'new' ? true : (!old('condition') ? false : old('condition') == 'new')) ? __('checked') : __('') }}
										value="new" id="brandnew">
									<label for="brandnew">Brand new</label>
								</div>

								<div class="flex flex-row gap-2 items-center">
									<input class="accent-{{ $site_settings->site_color_theme }}" type="radio" name="condition"
										{{ (isset($product->details['condition']) && $product->details['condition'] == 'used' ? true : (!old('condition') ? false : old('condition') == 'used')) ? __('checked') : __('') }}
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
									<span class="text-{{ $site_settings->site_color_theme }}">*</span>
								</div>
								<input class="w-full business-input-textbox focus:ring-{{ $site_settings->site_color_theme }}" type="number" name="price" id="prod_price" value="{{ isset($product->price) ? $product->price : old('price') }}" placeholder=""
									id="price">
							</div>
							<div class="basis-1/2 flex flex-col gap-1">
								<div>
									<span>Quantity</span>
									<span class="text-{{ $site_settings->site_color_theme }}">*</span>
								</div>
								<input class="w-full business-input-textbox focus:ring-{{ $site_settings->site_color_theme }}" type="number" name="quantity" value="{{ isset($product) ? $product->currentInventory()->quantity : old('quantity') }}" id="quantity">
							</div>
						</div>

						{{-- product description --}}
						<div class="flex flex-col gap-1 mb-2">
							<div>
								<span>Product description</span>
								<span class="text-{{ $site_settings->site_color_theme }}">*</span>
							</div>
							<div>
								<textarea class="border-none px-2 py-1 bg-dirtywhite w-full rounded-[7px] caret-black focus:ring-{{ $site_settings->site_color_theme }}" id="product_description" name="product_description" data-preview="#previewproduct_description"
								 rows="6" cols="3">{{ isset($product->description) ? $product->description : old('product_description') }}</textarea>
							</div>
							<div>
								<span>Preview</span>
							</div>
							<div>
								<div id="previewproduct_description" class="border-none px-2 py-1 bg-dirtywhite w-full rounded-[7px] caret-black"></div>
							</div>
						</div>

						{{-- product specification --}}
						<div class="flex flex-col gap-1">
							<div class="flex flex-col">
								<div>
									<span>
										Product specifications
									</span>
									<span class="text-{{ $site_settings->site_color_theme }}">*</span>
								</div>
								<span class="italic">
									Providing additional details, buyer can find your listing easily.
								</span>
							</div>

							{{-- the additional specs --}}
							<div class="flex flex-col gap-1" id="specs-div">
								@isset($product)
									@foreach ($product->details['speficications'] as $key => $val)
										<div class="flex flex-row gap-1">
											<div class="basis-1/2">
												<input class="w-full business-input-textbox focus:ring-{{ $site_settings->site_color_theme }}" type="text" name="spec_key[]" value="{{ $key }}" placeholder="dimensions">
											</div>
											<div class="basis-1/2">
												<input class="w-full business-input-textbox focus:ring-{{ $site_settings->site_color_theme }}" type="text" name="spec_value[]" value="{{ $val }}" placeholder="120mm">
											</div>
										</div>
									@endforeach
								@else
									<div class="flex flex-row gap-1">
										<div class="basis-1/2">
											<input class="w-full business-input-textbox focus:ring-{{ $site_settings->site_color_theme }}" type="text" name="spec_key[]" placeholder="dimensions">
										</div>
										<div class="basis-1/2">
											<input class="w-full business-input-textbox focus:ring-{{ $site_settings->site_color_theme }}" type="text" name="spec_value[]" placeholder="120mm">
										</div>
									</div>
								@endisset
							</div>

							{{-- add more4 --}}
							<div class="flex flex-col justify-center items-end">
								<button type="button" class="w-[102px] p-2 bg-{{ $site_settings->site_color_theme }} rounded-[4px] text-white" id="addMore">
									add more
								</button>
							</div>
						</div>
						@if (false)
							{{-- transfer method --}}
							<div class="px-[5px] flex flex-col gap-1">
								<div>
									<span>Transfer Method</span>
								</div>
								<div class="flex flex-row gap-3 items-center">
									<div class="basis-[129px] flex flex-row gap-2">
										<input class="accent-{{ $site_settings->site_color_theme }}" type="checkbox" name="transfer_method[]" value="pick-up" id="shopPickup">
										<label for="shopPickup">
											Shop pick-up
										</label>
									</div>

									<div class="basis-[129px] flex flex-row gap-2">
										<input class="accent-{{ $site_settings->site_color_theme }}" type="checkbox" name="transfer_method[]" value="meet-up" id="meetup">
										<label for="meetup">
											Meet-up
										</label>
									</div>

									<div class="basis-[129px] flex flex-row gap-2">
										<input class="accent-{{ $site_settings->site_color_theme }}" type="checkbox" name="transfer_method[]" value="delivery" id="delivery">
										<label for="delivery">
											Delivery
										</label>
									</div>
								</div>
							</div>

							{{-- payment method --}}
							<div class="px-[5px] mt-5 flex flex-col gap-1">
								<div>
									<span>Payment Method</span>
								</div>
								<div class="flex flex-row gap-3 items-center">
									<div class="basis-[129px] flex flex-row gap-2">
										<input class="accent-{{ $site_settings->site_color_theme }}" type="checkbox" name="payment_method[]" value="online" id="onlinePayment">
										<label for="onlinePayment">
											Online Payment
										</label>
									</div>

									<div class="basis-[129px] flex flex-row gap-2">
										<input class="accent-{{ $site_settings->site_color_theme }}" type="checkbox" name="payment_method[]" value="cash" id="cashPayment">
										<label for="cashPayment">
											Cash
										</label>
									</div>
								</div>
							</div>
						@endif
					</section>
				</section>

				{{-- image uploads --}}
				<section class="business-whitecard-bg">
					<div class="flex flex-row justify-between items-center">
						{{-- image thumbnail --}}
						<div class="h-full basis-1/2 flex flex-col gap-1 items-center">
							<span class="basis-[24px]">
								Image thumbnail
							</span>

							<div id="prodShowcase-div" class="w-[100px] h-[100px] grow bg-customgray-lightgray rounded-[4px] overflow-hidden">
								@isset($product)
									<img src="{{ asset('/storage/' . $product->productId . '/file/' . $product->img_showcase . '/type/products') }}" alt="img" class="object-cover w-[100px] h-[100px] rounded-[4px]">
								@endisset
								{{-- lagay mo ung image thumbnail here --}}
							</div>

							<input id="img_showcase" onchange="previewProductShowcase(this)" type="file" name="img_showcase" accept="image/*" hidden class="hidden">

							<button onclick="$('#img_showcase').click()" type="button" class="basis-[32px] px-3 py-1 bg-{{ $site_settings->site_color_theme }} text-white rounded-[4px]">
								Upload
							</button>
						</div>

						<div class="h-full basis-1/2 flex flex-col gap-1 items-center">
							<span class="basis-[24px]">
								Image gallery
							</span>

							{{-- image (, 1st pic na lang siguro ung naka preview) --}}
							<div id="prodGallery-a" class=" grow flex justify-center items-center flex-wrap gap-2" data-gallery="bannerGallery1">
								{{-- put images here --}}
								@isset($product)
									@foreach ($product->img as $img)
										<img src="{{ asset('/storage/' . $product->productId . '/file/' . $img . '/type/products') }}" alt="img" class="object-cover w-[45px] h-[45px] rounded-[4px]">
									@endforeach
								@else
									<i class="fa-solid fa-photo-film w-[90px] h-[90px]"></i> {{-- gamitin na lang to kapag alang picture --}}
								@endisset
							</div>
							<input id="product_img" type="file" onchange="previewProductGallery(this.files)" name="product_img[]" accept="image/*" multiple hidden class="hidden">
							<button onclick="$('#product_img').click()" type="button" class="basis-[32px] px-3 py-1 bg-{{ $site_settings->site_color_theme }} text-white rounded-[4px]">
								Upload
							</button>
						</div>
					</div>
				</section>

				{{-- for spacing only -  ayaw gumana ng margin at padding bottom amp --}}
				<span class="invisible hidden lg:block text-[8px]">asdasd</span>
			</div>

			{{-- image preview --}}
			<section class="business-whitecard-bg lg:basis-2/5 lg:h-fit mb-[61px] sm:mb-4 lg:mb-0">
				{{-- load preview --}}
				<div class="flex flex-row gap-2 justify-between items-center">
					<span class="">Enter the product name, price, and image showcase to preview</span>
					<button type="button" class="p-2 bg-{{ $site_settings->site_color_theme }} rounded-[4px] text-white" id="load-preview">
						Load preview
					</button>
				</div>

				<div id="prod-card-preview" class="rounded-[8px] shadow-lg">
				</div>

				@if (false)
					<div class="flex flex-col justify-between items-center">
						<button type="submit" class="w-[150px] px-3 py-1 bg-{{ $site_settings->site_color_theme }} text-white rounded-[4px]">
							save
						</button>
					</div>
				@endif
			</section>
		</div>
	</form>
	@push('scripts')
		<script>
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			const descEditor = document.getElementById('product_description')
			var _easymde
			const previewProductShowcase = (el) => {
				if (el.files && el.files[0]) {
					let reader = new FileReader();
					reader.onload = (e) => {
						$('#prodShowcase-a').attr('href', e.target.result);
						$('#prodShowcase-div').html('');
						$('#prodShowcase-div').append(
							$('<img>', {
								src: e.target.result,
								alt: 'img',
								class: 'object-cover w-[100px] h-[100px] rounded-[4px]'
							})
						);
					}
					reader.readAsDataURL(el.files[0]);
				}
			}
			const previewProductGallery = (files) => {
				console.log(files)
				if (files) {
					$('#prodGallery-a').html('');
					Array.from(files).forEach((ev, k) => {
						let reader = new FileReader();
						reader.onload = (e) => {
							$('#prodGallery-a').append(
								$('<img>', {
									src: e.target.result,
									alt: 'img',
									class: 'object-cover w-[45px] h-[45px] rounded-[4px]'
								})
							);
						}
						reader.readAsDataURL(ev);
					});
				}
			}
			const showPreview = (_imgShowcase, _prodName, _prodPrice) => {
				$.post('{{ route('business.products.preview') }}', {
						prodName: _prodName,
						prodPrice: _prodPrice,
						imgShowcase: _imgShowcase,
					})
					.done((data) => {
						console.log(data)
						$('#prod-card-preview').html(data)
					})
			};
			const getPreview = () => {
				let _imgShowcase = $('#prodShowcase-div img').attr('src')
				let _prodName = $('#product_name').val()
				let _prodPrice = $('#prod_price').val()
				console.log(_imgShowcase ? true : false && _prodName ? true : false && _prodPrice ? true :
					false)
				if (_imgShowcase ? true : false && _prodName ? true : false && _prodPrice ? true : false) {
					showPreview(_imgShowcase, _prodName, _prodPrice)
				}
			}
			const addSpecs = () => {
				$('#specs-div').append(
					`<div class="flex flex-row gap-1">
						<div class="basis-1/2">
							<input class="w-full business-input-textbox focus:ring-{{ $site_settings->site_color_theme }}" type="text" name="spec_key[]" placeholder="dimensions">
						</div>
						<div class="basis-1/2">
							<input class="w-full business-input-textbox focus:ring-{{ $site_settings->site_color_theme }}" type="text" name="spec_value[]" placeholder="120mm">
						</div>
					</div>`
				)
			}
			$(() => {
				_easymde = new TextareaMarkdown(descEditor);
				$('#load-preview').click(getPreview)
				$('#addMore').click(addSpecs)
			});
		</script>
	@endpush
@endsection
