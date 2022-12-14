<div class="grid flex-wrap justify-center grid-cols-1 text-center ">
	<div class="h-[40rem] border-solid border-[1px]">
		<img src="{{ asset('assets/Rectify/customer-home/empty-shopcart.png') }}" alt=""
			class="mx-auto w-[30rem]  my-[3rem]">
		<h3 class="text-[2rem] my-[1rem] font-semibold text-{{$site_settings->site_color_theme}}">Oops! Your cart is empty</h3>
		<p class="text-[1.3rem] leading-normal my-[1rem] font-semibold text-[#959596]">Looks like you haven't added
			<br>anything in your cart yet
		</p>
		<a href="#"
			class="my-[1rem] ml-5 inline-block py-[.7rem] px-[7rem] rounded-[.5rem] text-[#fff] button-shade text-[1.5rem] cursor-pointer font-[500]"
			type="button">
			Shop Now</a>
	</div>
</div>


<div class="grid flex-wrap justify-center grid-cols-1 text-center ">
	<div class="h-[40rem] border-solid border-[1px]">
		<img src="{{ asset('assets/Rectify/customer-home/no-result.png') }}" alt=""
			class="mx-auto w-[15rem]  my-[3rem]">
		<h3 class="text-[2rem] my-[1rem] font-semibold text-{{$site_settings->site_color_theme}}">Sorry! No result found</h3>
		<p class="text-[1.3rem] leading-normal my-[1rem] font-semibold text-[#959596]">We're sorry what you were looking for.
			<br>Please try another way
		</p>

	</div>
</div>


<div class="grid flex-wrap justify-center grid-cols-1 text-center ">
	<div class="h-[40rem] border-solid border-[1px]">
		<img src="{{ asset('assets/Rectify/customer-home/filter-result.png') }}" alt=""
			class="mx-auto w-[15rem]  my-[3rem]">
		<h3 class="text-[2rem] my-[1rem] font-semibold text-{{$site_settings->site_color_theme}}">Your filters produced no result</h3>
		<p class="text-[1.3rem] leading-normal my-[1rem] font-semibold text-[#959596]">Try adjusting your filters to
			<br>display better results
		</p>

	</div>
</div>


<div class="grid flex-wrap justify-center grid-cols-1 text-center ">
	<div class="h-[40rem] border-solid border-[1px]">
		<img src="{{ asset('assets/Rectify/customer-home/calendar-empty.png') }}" alt=""
			class="mx-auto w-[12rem] my-[3rem]">
		<h3 class="text-[2rem] my-[1rem] font-semibold text-{{$site_settings->site_color_theme}}">No appointments found!</h3>
		<p class="text-[1.3rem] leading-normal my-[1rem] font-semibold text-[#959596]">There are no upcoming
			<br>appointments scheduled.
		</p>
		<a href="{{ route('customer.home.index') }}"
			class="my-[1rem] ml-5 inline-block py-[.7rem] px-[3rem] rounded-[.5rem] text-[#fff] button-shade text-[1.5rem] cursor-pointer font-[500]"
			type="button">
			Book an Appointment</a>
	</div>
</div>

<div class="grid flex-wrap justify-center grid-cols-1 text-center ">
	<div class="h-[40rem] border-solid border-[1px]">
		<img src="{{ asset('assets/Rectify/customer-home/no-favorite.png') }}" alt=""
			class="mx-auto w-[15rem]  my-[3rem]">
		<h3 class="text-[2rem] my-[1rem] font-semibold text-{{$site_settings->site_color_theme}}">No favorites yet</h3>
		<p class="text-[1.3rem] leading-normal my-[1rem] font-semibold text-[#959596]">Click the heart icon of the product,
			<br>and you'll see it here next time
		</p>
		<a href="{{ route('customer.products.index') }}"
			class="my-[1rem] ml-5 inline-block py-[.7rem] px-[7rem] rounded-[.5rem] text-[#fff] button-shade text-[1.5rem] cursor-pointer font-[500]"
			type="button">
			Shop Now</a>
	</div>
</div>

<div class="grid flex-wrap justify-center grid-cols-1 text-center ">
	<div class="h-[40rem] border-solid border-[1px]">
		<img src="{{ asset('assets/Rectify/customer-home/empty-shopcart.png') }}" alt=""
			class="mx-auto w-[30rem]  my-[3rem]">
		<h3 class="text-[2rem] my-[1rem] font-semibold text-{{$site_settings->site_color_theme}}">There are no products yet</h3>
		<p class="text-[1.3rem] leading-normal my-[1rem] font-semibold text-[#959596]">When there are, you'll see
			<br>them here next time
		</p>
		<a href="{{ route('customer.home.index') }}"
			class="my-[1rem] ml-5 inline-block py-[.7rem] px-[3em] rounded-[.5rem] text-[#fff] button-shade text-[1.5rem] cursor-pointer font-[500]"
			type="button">
			Go Back to Home</a>
	</div>
</div>
