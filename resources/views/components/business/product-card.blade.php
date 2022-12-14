<div
	class="group box-2 hover:shadow-none flex-[1_1_30rem] p-[2rem] rounded-[.5rem]
					overflow-hidden relative transition-all duration-[.2s] ease-linear">
	<a href="#">
		<div
			class="w-[100%] p-8 h-[120px] sm:h-[200px] rounded-[8px] md:h-[200px] my-7 mx-auto bg-cover bg-center bg-no-repeat"
			style="background-image: url({{ $img }})">
		</div>
	</a>

	<div class="px-5 pb-3 space-y-1">
		<div
			class="product-name tracking-tight leading-normal md:h-[4.8rem] h-[4rem] overflow-hidden text-[#344767] text-[1.3rem] md:text-[1.5rem] font-bold">
			<h5>
				{{ $name }}
			</h5>
		</div>

		<div class="flex justify-between items-center">
			<d iv class="price text-[1.3rem] font-bold md:text-[1.5rem] text-[#344767] py-[.5rem] px-0">
				Php {{ $price }}
				@if (false)
					<span class="text-[1.1rem] text-[#999] font-medium"> 21 sold </span>
				@endif
			</d>
		</div>
	</div>

</div>
