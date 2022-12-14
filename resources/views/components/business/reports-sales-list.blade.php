<li class="px-3 sm:px-0 py-2 mb-2 sm:border-b-[1px] flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-0 bg-white sm:bg-transparent rounded-[8px] shadow-lg sm:shadow-none text-center cursor-pointer"
	onclick="location.href='{{ route('business.appointments.details') }}'">
	{{-- top-row --}}
	<div class="sm:basis-2/6 flex flex-row justify-between sm:justify-center items-center">
		{{-- user id --}}
		<div class="sm:basis-1/2 flex flex-row justify-center gap-1 italic">
			<span class="sm:hidden">User ID:</span>
			<span class="">123123123</span>
		</div>

		{{-- order id --}}
		<div class="sm:basis-1/2 flex flex-row justify-center gap-1 italic">
			<span class="sm:hidden">Order ID:</span>
			<span class="">abcabcabc</span>
		</div>
	</div>

	{{-- middle-row --}}
	<div class="sm:basis-4/6 flex justify-between items-center">
		{{-- user name --}}
		<div class="sm:basis-1/2 flex flex-row gap-2 sm:justify-center items-center">
			<div class="">
				<img class="object-cover w-[50px] h-[50px] rounded-full"
					src="https://th.bing.com/th/id/R.4cfb6ea3e537cc86c89e65b2230cba73?rik=DmGEyMYVAnrYog&riu=http%3a%2f%2fimg3.wikia.nocookie.net%2f__cb20131017123233%2fkyoukainokanata%2fimages%2fe%2fe2%2fMirai_Kuriyama_anime.png&ehk=VG96WJbwVGOFBVgc2joIimFafgCmbFCX02NAnIa7VR4%3d&risl=&pid=ImgRaw&r=0"
					alt="">
			</div>
			<div class="flex flex-col items-start">
				<span class="font-semibold max-w-[150px] sm:max-w-[100px] md:max-w-[200px] lg:max-w-none truncate">First Name Last Name</span>
				<span class="italic max-w-[150px] sm:max-w-[100px] md:max-w-[200px] lg:max-w-none truncate">customerako@gmail.com</span>
			</div>
		</div>

		<div class="sm:basis-1/2 flex gap-2 items-center">
			{{-- date registered --}}
			<div class="sm:basis-1/2 flex flex-col sm:justify-center items-center">
				<span class="sm:hidden">Billing Date:</span>
				<span>{{ $user->created_at->format('M d, o') }}</span>
			</div>

			<div class="sm:basis-1/2 flex justify-center items-center">
				<span class="text-[20px]">&#10095;</span>
			</div>
		</div>
	</div>
</li>
