@extends('auth.layout.auth')
@section('title')
	<title>{{ Str::title(config('app.name')) }} - Register</title>
@endsection
@section('content')
	<div class=" w-full h-full
        xl:m-auto
        md:m-auto
        mx-auto p-0">
		<div class="bg-white shadow-xl w-full h-full rounded-xl
            xl:p-10
            p-5
            my-3">
			<form action="{{ route('auth.business.register') }}" method="post" enctype="multipart/form-data" autocomplete="on"
				aria-autocomplete="both" class="w-full">
				<!-- Session Status -->
				<x-auth-session-status class="mb-4" :status="session('status')" />

				<!-- Validation Errors -->
				<x-auth-validation-errors class="mb-4" :errors="$errors" />

				{{-- carousel --}}
				<div id="animation-carousel" data-carousel="static" class="relative m-auto" style="height: 280px">
					<!-- Carousel wrapper -->
					<div class="relative my-auto h-full overflow-hidden rounded-lg">
						<!-- Item 1 -->
						<div id="carousel-item-1" data-carousel-item="1"
							class="m-auto flex flex-col w-full h-full justify-center
                        duration-200 ease-linear absolute inset-0 transition-all transform">
							{{-- form --}}
							<div class="p-2 flex flex-col gap-4 text-black">
								<input class="bg-[#F2F2F2] w-full rounded-xl border-none form-input" placeholder="Email" type="email"
									name="email" id="email" value="{{ old('email') }}" autocomplete="email">
								<input class="bg-[#F2F2F2] w-full rounded-xl border-none form-input" placeholder="Password" type="password"
									name="password" id="password" value="{{ old('password') }}" autocomplete="new-password">
								<input class="bg-[#F2F2F2] w-full rounded-xl border-none form-input" placeholder="Confirm Password"
									type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password">
								{{-- next button --}}
								<div class="mt-5 text-white font-bold">
									<button data-carousel-next class="m-auto w-full bg-{{$site_settings->site_color_theme}} rounded-xl py-3" type="button"
										onclick="slide(2)">Next</button>
								</div>
							</div>
						</div>
						<!-- Item 2 -->
						<div id="carousel-item-2" data-carousel-item="2"
							class="m-auto flex flex-col w-full h-full justify-center
                        duration-200 ease-linear absolute inset-0 transition-all transform">
							{{-- form --}}
							<div class="p-2 flex flex-col gap-4 text-black">
								<input class="bg-[#F2F2F2] w-full rounded-xl border-none form-input" placeholder="First Name" type="text"
									name="firstname" id="firstname" value="{{ old('firstname') }}" autocomplete="given-name">
								<input class="bg-[#F2F2F2] w-full rounded-xl border-none form-input" placeholder="Last Name" type="text"
									name="lastname" id="lastname" value="{{ old('lastname') }}" autocomplete="family-name">
								<input class="bg-[#F2F2F2] w-full rounded-xl border-none form-input" placeholder="Contact" type="tel"
									name="contact" id="contact" value="{{ old('contact') }}" autocomplete="tel-local">
								<input class="bg-[#F2F2F2] w-full rounded-xl border-none form-input" placeholder="Birth Date" type="date"
									name="birthday" id="birthday" value="{{ old('birthday') }}" autocomplete="bday">
								{{-- next button --}}
								<div class="mt-5 text-white font-bold">
									<button data-carousel-next class="m-auto w-full bg-{{$site_settings->site_color_theme}} rounded-xl py-3" type="button"
										onclick="slide(3)">Next</button>
								</div>
								{{-- prev button --}}
								<div class=" text-white font-bold">
									<button data-carousel-prev class="m-auto w-full bg-slate-500 rounded-xl py-3" type="button"
										onclick="slide(1)">Back</button>
								</div>
							</div>
						</div>
						<!-- Item 3 -->
						<div id="carousel-item-3" data-carousel-item="3"
							class="m-auto flex flex-col w-full h-full justify-center
                        duration-200 ease-linear absolute inset-0 transition-all transform">
							{{-- form --}}
							<div class="p-2 flex flex-col gap-4 text-black">
								<input class="bg-[#F2F2F2] w-full rounded-xl border-none form-input" placeholder="Street" type="text"
									name="street" id="street" value="{{ old('street') }}" autocomplete="street-address">
								<input class="bg-[#F2F2F2] w-full rounded-xl border-none form-input" placeholder="Barangay" type="text"
									name="brgy" id="brgy" value="{{ old('brgy') }}" autocomplete="address-level3">
								<input class="bg-[#F2F2F2] w-full rounded-xl border-none form-input" placeholder="City / Municipality"
									type="text" name="city" id="city" value="{{ old('city') }}" autocomplete="address-level2">
								<input class="bg-[#F2F2F2] w-full rounded-xl border-none form-input" placeholder="Province" type="text"
									name="province" id="province" value="{{ old('province') }}" autocomplete="address-level1">
								<input class="bg-[#F2F2F2] w-full rounded-xl border-none form-input" placeholder="Postal / Zip Code"
									type="text" name="zip" id="zip" value="{{ old('zip') }}" autocomplete="postal-code">

								{{-- next button --}}
								<div class="mt-5 text-white font-bold">
									<button data-carousel-next class="m-auto w-full bg-{{$site_settings->site_color_theme}} rounded-xl py-3" type="button"
										onclick="slide(4)">Next</button>
								</div>
								{{-- prev button --}}
								<div class=" text-white font-bold">
									<button data-carousel-prev class="m-auto w-full bg-slate-500 rounded-xl py-3" type="button"
										onclick="slide(2)">Back</button>
								</div>
							</div>
						</div>
						<!-- Item 4 -->
						<div id="carousel-item-4" data-carousel-item="4"
							class="my-auto flex flex-col w-full h-full justify-center
                        duration-200 ease-linear absolute inset-0 transition-all transform">
							{{-- form --}}
							<div class="p-2 flex flex-col gap-4 text-black">
								<div class="mx-auto h-auto text-center">
									<label for="shop_img" class="mx-auto w-fit h-fit">
										{{-- <div class="mx-auto w-[64px] h-[64px] rounded-full p-5 bg-red-500"></div> --}}
										<img id="img_placeholder" src="{{ asset('assets/auth/add_img.svg') }}" alt="Profile Placeholder"
											class=" min-h-[128px] min-w-[128px] h-[128px] w-[128px] max-h-[128px] max-w-[128px]">
									</label>
									<div id="profile_label" class="mx-auto font-bold">
										Profile
									</div>
								</div>
								<input class="bg-[#F2F2F2] w-full rounded-xl border-none form-input" placeholder="Shop Name" type="text"
									name="shop_name" id="shop_name" value="{{ old('shop_name') }}">
								<textarea class="bg-[#F2F2F2] w-full rounded-xl border-none textarea" placeholder="Shop Description" type="text"
								 name="shop_description" id="shop_description">{{ old('shop_description') }}</textarea>
								<div class="text-center text-sm">
									<p>{{ __('By using signing up, you understand and agree to the Privacy Policy and the Terms and Conditions') }}
									</p>
								</div>
								{{-- next button --}}
								<div class=" mt-2 text-white font-bold">
									<button data-carousel-next class="m-auto w-full bg-{{$site_settings->site_color_theme}} rounded-xl py-3" type="submit">Register</button>
								</div>
								{{-- prev button --}}
								<div class=" text-white font-bold">
									<button data-carousel-prev class="m-auto w-full bg-slate-500 rounded-xl py-3" type="button"
										onclick="slide(3)">Back</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				{{-- img --}}
				<input type="file" name="shop_img" id="shop_img" value="{{ old('shop_img') }}" hidden>
				@csrf
			</form>
		</div>
		<div class="hidden h-[280px]" hidden></div>
		<div class="hidden h-[380px]" hidden></div>
		<div class="hidden h-[450px]" hidden></div>
		<div class="hidden h-[550px]" hidden></div>
		<script>
			const items = [{
					position: 0,
					el: document.getElementById('carousel-item-1')
				},
				{
					position: 1,
					el: document.getElementById('carousel-item-2')
				},
				{
					position: 2,
					el: document.getElementById('carousel-item-3')
				},
				{
					position: 3,
					el: document.getElementById('carousel-item-4')
				},
			];
			const options = {
				activeItemPosition: 1,

				indicators: {
					items: items
				},

				// callback functions
				// onNext: () => {
				//     console.log('next slider item is shown');
				// },
				// onPrev: () => {
				//     console.log('previous slider item is shown');
				// },
				// onChange: () => {
				//     console.log('new slider item has been shown');
				// }
			};
			var carousel
			$(() => {
				carousel = new Carousel(items, options);
			})
			const elemHeights = {
				1: '280',
				2: '380',
				3: '450',
				4: '550',
			}
			const slide = (item) => {
				$(() => {
					if (item == 1) {
						carousel.slideTo(item - 1)
						$('#animation-carousel').height(elemHeights[item]);
					}
					if (item == 2) {
						carousel.slideTo(item - 1)
						$('#animation-carousel').height(elemHeights[item]);
					}
					if (item == 3) {
						carousel.slideTo(item - 1)
						$('#animation-carousel').height(elemHeights[item]);
					}
					if (item == 4) {
						carousel.slideTo(item - 1)
						$('#animation-carousel').height(elemHeights[item]);

					}
				})
			};
		</script>

		<div class="mt-4 text-center">
			Already have an account? <a class="text-{{$site_settings->site_color_theme}} hover:text-red-500" href="{{ route('auth.business.login') }}">Login
				Here</a>
		</div>

		<div class="hidden ring-4 ring-pink"></div>

	</div>
	<script>
		const readURL = (input) => {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function(e) {
					$('#img_placeholder').attr('src', e.target.result);
				}

				reader.readAsDataURL(input.files[0]);
			}
		}
		$("#shop_img").change(function() {
			readURL(this);
			$("#img_placeholder").addClass('rounded-full ring-4 ring-pink')
			$('#profile_label').addClass('hidden')
		});
	</script>
@endsection
