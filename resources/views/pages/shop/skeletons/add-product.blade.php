<!DOCTYPE html>
<html lang="en">

<head>
	@include('includes.heads')
	<title>add product</title>
</head>

<body>
	<div>
		<form action="{{ route('business.products.store') }}" method="post" enctype="multipart/form-data"
			class="w-1/2 flex mx-auto p-10 flex-col">
			@csrf
			<!-- Session Status -->
			<x-auth-session-status class="mb-4" :status="session('status')" />

			<!-- Validation Errors -->
			<x-auth-validation-errors class="mb-4" :errors="$errors" />
			<div>
				<select name="category" id="cateogry">
					<option value="Mother Board">Mother Board</option>
				</select>
			</div>
			<div>
				<x-label for="product_name" :value="__('Product Name')" />
				<x-input id="product_name" class="block mt-1 w-full" type="text" name="product_name"/>
			</div>
			<div>
				<x-label for="img_showcase" :value="__('Image Showcase')" />
				<x-input id="img_showcase" class="block mt-1 w-full" type="file" name="img_showcase" accept="image/*" />
			</div>
			<div>
				<x-label for="product_img" :value="__('Images')" />
				<x-input id="product_img" class="block mt-1 w-full" type="file" name="product_img[]" multiple accept="image/*" />
			</div>
			{{--
                <div>
                <x-label for="product_vendor" :value="__('Product Vendor')" />
                <x-input id="product_vendor" class="block mt-1 w-full" type="text" name="product_vendor"
                    :value="old('product_vendor')" />
            </div>
            --}}
			<div>
				<x-label for="" :value="__('Condition')" />
				<div class="flex flex-row w-full">
					<x-input id="new" class="block mt-1 " type="radio" name="condition" value="used" />
					<x-label for="new" class="w-fit" :value="__('Brand New')" />
				</div>
				<div class="flex flex-row w-full">
					<x-input id="used" class="block mt-1 " type="radio" name="condition" value="new" />
					<x-label for="used" class="w-fit" :value="__('Used')" />
				</div>
			</div>
			<div>
				<x-label for="price" :value="__('Price')" />
				<x-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" />
			</div>
			<div>
				<x-label for="quantity" :value="__('Quantity')" />
				<x-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" :value="old('quantity')" />
			</div>
			<div>
				<x-label for="cart_max_quantity" :value="__('Cart Max Quantity')" />
				<x-input id="cart_max_quantity" class="block mt-1 w-full" type="number" name="cart_max_quantity" :value="old('cart_max_quantity')" />
			</div>
			<div>
				<div>
					<x-label for="" :value="__('Specifications')" />
					<div class="flex flex-row">
						<x-input class="block mt-1 w-1/2" type="text" name="spec_key[]" placeholder="Specification" />
						<x-input class="block mt-1 w-1/2" type="text" name="spec_value[]" placeholder="Value" />
					</div>
				</div>
			</div>
			<div>
				<x-label for="product_description" :value="__('Product Description')" />
				<textarea name="product_description" id="product_description" class="w-full" rows="3">{{ old('product_description') }}</textarea>
			</div>
			<div>
				<x-label for="" :value="__('Transfer Method')" />
				<div class="flex flex-row">
					<x-input class="block mt-1" type="checkbox" id="pick-up" name="transfer_method[]" value="pick-up" />
					<x-label for="pick-up" :value="__('Shop Pick-up')" />
				</div>
				<div class="flex flex-row">
					<x-input class="block mt-1" type="checkbox" id="meet-up" name="transfer_method[]" value="meet-up" />
					<x-label for="meet-up" :value="__('Meet-up')" />
				</div>
				<div class="flex flex-row">
					<x-input class="block mt-1" type="checkbox" id="delivery" name="transfer_method[]" value="delivery" />
					<x-label for="delivery" :value="__('Delivery')" />
				</div>
			</div>
			<div>
				<button type="submit" class="bg-red-300 float-right rounded-full">Save</button>
			</div>
		</form>
	</div>
	@include('includes.feet')
</body>

</html>
