@extends('layouts.customer')

@section('title')
	<title>{{ Str::title(config('app.name')) }} for Customers - Home</title>
@endsection

@section('content')
	{{-- home section starts --}}

	<div class="loader-container">
		<img src="{{ asset('assets/Rectify/customer-home/gear-loader.gif') }}" alt="">
	</div>

	<section class="bg-[#f1eeee] md:py-[5rem] md:px-[9%] py-[3rem] px-[2rem]" id="home">
		{{-- row --}}
		<div class="flex items-center flex-wrap gap-6">
			{{-- content --}}
			<div class="flex-[1_1_42rem] xl:text-left text-center">
				<h3 class="md:text-[4.5rem] text-[#344767] font-extrabold text-[3.5rem] z-10">Welcome to <span class="span-line capitalize">{{ config('app.name') }}!</span></h3>
				<p class="text-[#666] font-semibold text-[1.6rem] leading-loose py-[1rem] px-[0]">
					@php
						$_taglinePlaceholder = 'Enjoy hassle-free repair booking and shopping services for everyone.';
					@endphp
					{{ $shop->tagline ?? $_taglinePlaceholder }}
				</p>
				<button type="button" onclick="{{ Auth::check() ? __('appointmentModal.show()') : __("location.href='/login'") }}"
					class="button-shade my-[1rem] inline-block py-[.9rem] px-[3rem] rounded-[.5rem] text-[#fff] text-[1.5rem] cursor-pointer font-semibold" type="button" {{-- data-modal-toggle="appointment-modal" --}}>
					Request an Appointment</button>
				<a href="{{ route('customer.products.index') }}"
					class="my-[1rem] ml-5 inline-block py-[.9rem] px-[3rem] rounded-[.5rem] text-{{ $site_settings->site_color_theme }} bg-[#fff] text-[1.5rem] cursor-pointer font-semibold hover:bg-{{ $site_settings->site_color_theme }} hover:text-[#fff] transition-all duration-[.2s] ease-linear"
					type="button">
					Browse our Products</a>
			</div>
			{{-- swiper slider --}}
			<div class="swiper product-slider text-center mt-[2rem] grow shrink basis-[42rem]">
				{{-- swiper-wrapper --}}
				<div class="swiper-wrapper">
					<a href="#" class="swiper-slide"><img src="{{ asset('assets/Rectify/customer-home/product-1.png') }}" class="h-[25rem] hover:scale-90 transition-all duration-[.2s] ease-linear inline" alt=""></a>
					<a href="#" class="swiper-slide"><img src="{{ asset('assets/Rectify/customer-home/product-2.png') }}" class="h-[25rem] hover:scale-90 transition-all duration-[.2s] ease-linear inline" alt=""></a>
					<a href="#" class="swiper-slide"><img src="{{ asset('assets/Rectify/customer-home/product-3.png') }}" class="h-[25rem] hover:scale-90 transition-all duration-[.2s] ease-linear inline" alt=""></a>
					<a href="#" class="swiper-slide"><img src="{{ asset('assets/Rectify/customer-home/product-4.png') }}" class="h-[25rem] hover:scale-90 transition-all duration-[.2s] ease-linear inline" alt=""></a>
					<a href="#" class="swiper-slide"><img src="{{ asset('assets/Rectify/customer-home/product-5.png') }}" class="h-[25rem] hover:scale-90 transition-all duration-[.2s] ease-linear inline" alt=""></a>
					<a href="#" class="swiper-slide"><img src="{{ asset('assets/Rectify/customer-home/product-6.png') }}" class="h-[25rem] hover:scale-90 transition-all duration-[.2s] ease-linear inline" alt=""></a>
				</div>
				{{-- image stand --}}
				<img src="{{ asset('assets/Rectify/customer-home/stand.png') }}" class="w-[100%] mt-[-2rem]" alt="">
			</div>
		</div>
	</section>
	{{-- home section end --}}

	@auth
		{{-- appointment modal --}}
		<x-customer.appointment-modal-form :$user />
	@else
		{{--  --}}
	@endauth

	{{-- start services --}}
	@if (isset($shop->services) && !empty(Arr::where($shop->services, fn($v, $k) => $v)))
		<section class="bg-[#fff] md:py-[5rem] md:px-[9%] py-[3rem] px-[2rem]">

			<div class="container xl:max-w-7xl mx-auto px-4">
				<h2 class="heading text-[2.3rem] text-center relative leading-normal px-[2rem] mb-2 font-extrabold text-[#344767] dark:text-gray-100">
					<span class="span-line">Offered </span>Services
				</h2>
				<p class="text-gray-600 leading-relaxed font-semibold text-[1.5rem] text-center mx-auto pb-2 mb-[2rem]">We
					create engaging experiences that are innovating and beautiful</p>

				{{-- rows --}}
				<div class="flex flex-wrap flex-row -mx-4 text-center">
					@foreach ($shop->services as $service => $cond)
						@if (!$cond)
							@continue
						@endif
						{{-- service block --}}
						<div class="flex-shrink px-4 max-w-full w-full sm:w-1/2 lg:w-1/3 lg:px-6 wow fadeInUp" data-wow-duration="1s">
							<div class="group py-8 px-12 rounded-[2rem] mb-12 bg-[#F8F9FA] hover:text-[#fff] hover:bg-{{ $site_settings->site_color_theme }} transform transition duration-300 ease-in-out hover:-translate-y-2">
								<div class="inline-block text-gray-900 mb-4">
									{{-- icon --}}

									<i @class([
										// base class
										'fa-solid h-[2rem] text-[#344767] group-hover:text-[#fff]',

										// conditional class
										'fa-mobile-screen-button' => $service == 'Mobile Repair',
										'fa-computer' => $service == 'Computer Repair',
										'fa-trash-arrow-up' => $service == 'Data Recovery',
										'fa-print' => $service == 'Accessories Repair',
										'fa-wand-magic-sparkles' => $service == 'Gadget Customization',
										'fa-compact-disc' => $service == 'Application Setup',
									])></i>
								</div>
								<h3 class="group-hover:text-[#fff] text-[1.5rem] leading-normal mb-2 font-semibold text-[#344767]">
									{{ $service }}
								</h3>
								@php
									$servicesParagraphs = [
									    'Mobile Repair' => 'Offers mobile phone repair services with any various issues.',
									    'Computer Repair' => 'Offers computer repair services for businesses or home PC owners.',
									    'Data Recovery' => 'Offers recovery of lost data files and mobile phone data reset',
									    'Accessories Repair' => 'Offers other repair services such as smartwatches, printers, and more.',
									    'Gadget Customization' => 'Offers customization of gadgets like casing, backplate.',
									    'Application Setup' => 'Offers setup of application, anti-virus, CPU driver, and more.',
									];
								@endphp
								<p class="text-gray-500 text-[1.3rem] group-hover:text-[#fff]">
									{{ $service == 'Mobile Repair' ? $servicesParagraphs[$service] : null }}
									{{ $service == 'Computer Repair' ? $servicesParagraphs[$service] : null }}
									{{ $service == 'Data Recovery' ? $servicesParagraphs[$service] : null }}
									{{ $service == 'Accessories Repair' ? $servicesParagraphs[$service] : null }}
									{{ $service == 'Gadget Customization' ? $servicesParagraphs[$service] : null }}
									{{ $service == 'Application Setup' ? $servicesParagraphs[$service] : null }}
								</p>
							</div>
						</div>
						{{-- end service block --}}
					@endforeach
				</div>
				{{-- end row --}}
			</div>
		</section>
	@endif
	{{-- End Service --}}

	{{-- about section starts  --}}
	@if (!is_null($shop->about_us))
		<section class="about bg-[#F8F9FA] md:py-[5rem] md:px-[9%] py-[3rem] px-[2rem]">
			<h2 class="heading text-[2.3rem] text-center relative leading-normal px-[2rem] mb-2 font-extrabold text-[#344767] dark:text-gray-100">
				About <span class="span-line"> Us</span></h2>
			<p class="text-gray-600 leading-relaxed font-semibold text-[1.5rem] text-center mx-auto pb-2 mb-[2rem]">Know our
				shop more!</p>

			<div class="container my-0 mx-auto max-w-[960px]">
				<div class="tabs">
					<div class="tabbar mb-[1rem] text-[1.3rem]">
						<button
							class="tab
								border-0
								border-b-[3px]
								border-solid
								border-transparent
								text-[#aaa]
								p-[1rem]
								transition-colors
								hover:text-{{ $site_settings->site_color_theme }}
								hover:cursor-pointer active"
							data-panel="one">
							Shop Details
						</button>
						<button
							class="tab
								border-0
								border-b-[3px]
								border-solid
								border-transparent
								text-[#aaa]
								p-[1rem]
								transition-colors
								hover:text-{{ $site_settings->site_color_theme }}
								hover:cursor-pointer"
							data-panel="two">
							History
						</button>
						<button
							class="tab
								border-0
								border-b-[3px]
								border-solid
								border-transparent
								text-[#aaa]
								p-[1rem]
								transition-colors
								hover:text-{{ $site_settings->site_color_theme }}
								hover:cursor-pointer"
							data-panel="three">
							Mission & Vision
						</button>
					</div>
					<div id="one" class="tabpanel hidden pay-[1em] px-0 active">
						<div class="my-[5rem]">

							{{-- ====== About Section Start --}}
							<section id="about">
								<div class="box">
									<div class="wow fadeInUp" data-wow-delay=".2s">
										<div class="-mx-4 flex flex-wrap">
											<div class="w-full px-4">
												<div class="items-center justify-between overflow-hidden lg:flex">
													<div class="w-full py-12 px-7 sm:px-12 md:p-16 lg:max-w-[565px] lg:py-9 lg:px-16 xl:max-w-[640px] xl:p-[70px]">
														<span class="mb-5 inline-block bg-{{ $site_settings->site_color_theme }} rounded-lg py-2 px-5 text-[1.3rem] font-medium text-white">
															About Us
														</span>
														<h2 class="mb-6 font-bold text-[#344767] text-[2.3rem] sm:leading-snug">
															{{ $shop->about_us['heading'] }}
														</h2>
														<p class="mb-3 text-[1.3rem] leading-relaxed text-body-color">
															{{ $shop->about_us['desc'] }}
														</p>
														@if ($shop->googleMaps)
															<a href="{{ $shop->googleMaps }}"
																class="inline-flex items-center mt-7 justify-center rounded-lg bg-{{ $site_settings->site_color_theme }} py-4 px-6 text-[1.3rem] font-medium text-white transition duration-300 ease-in-out hover:bg-opacity-90 hover:shadow-lg">
																Visit Us Now
															</a>
														@endif
													</div>
													<div class="text-center">
														<div class="relative z-10 inline-block h-full">
															<img src="{{ asset('assets/Rectify/customer-home/mobile-repair.jpg') }}" alt="image" class="mx-auto lg:ml-auto object-cover h-[20rem] md:w-[20rem] w-full rounded-lg" />
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</section>
							{{-- ====== About Section End --}}
						</div>
					</div>
					<div id="two" class="tabpanel hidden pay-[1em] px-0">
						<div class="my-[5rem]">
							<h2 class="text-[2rem] py-1 bold text-{{ $site_settings->site_color_theme }} text-center">History</h2>
							<p class="text-[1.3rem]">
								{{ $shop->about_us['history'] }}
							</p>
						</div>
					</div>
					<div id="three" class="tabpanel hidden pay-[1em] px-0">
						<div class="my-[5rem]">
							<h2 class="text-[2rem] py-1 bold text-{{ $site_settings->site_color_theme }} text-center">Mission</h2>
							<p class="text-center text-[1.3rem]">
								{{ $shop->about_us['mission'] }}
							</p>

							<h2 class="text-[2rem] py-1 bold text-{{ $site_settings->site_color_theme }} text-center mt-5">Vision</h2>
							<p class="text-center text-[1.3rem]">
								{{ $shop->about_us['vission'] }}
							</p>
						</div>
					</div>
				</div>
			</div>
		</section>
	@endif

	{{-- about section ends  --}}

	{{-- Our gallery --}}
	@if (!is_null($site_settings) && isset($site_settings->gallery) && array_filter(array_map('array_filter', $site_settings->gallery)))
		<section class="bg-[#fff] md:py-[5rem] md:px-[9%] py-[3rem] px-[2rem]">
			<h2 class="heading text-[2.3rem] text-center relative leading-normal px-[2rem] mb-2 font-extrabold text-[#344767] dark:text-gray-100">
				<span class="span-line">Our </span>Gallery
			</h2>
			<p class="text-gray-600 leading-relaxed font-semibold text-[1.5rem] text-center mx-auto pb-2 mb-[2rem]">
				Some pictures of our shop
			</p>

			<div class="flex flex-wrap flex-row">
				@foreach (range(1, 5) as $i)
					@php
						$gallery = $site_settings->gallery;
					@endphp
					@if (is_null($gallery['gallery_title'][$i]) || is_null($gallery['gallery_desc'][$i]) || is_null($gallery['gallery_img'][$i]))
						@continue
					@endif

					<figure class="flex-shrink max-w-full px-3 w-full sm:w-1/2 lg:w-1/5 group wow fadeInUp" data-wow-duration="1s">
						<div class="relative overflow-hidden cursor-pointer mb-6">
							<a href="{{ asset('storage/master/gallery/' . $gallery['gallery_img'][$i]) }}" data-gallery="shop_gallery" data-glightbox="title: {{ $gallery['gallery_title'][$i] }}; description: {{ $gallery['gallery_desc'][$i] }}"
								class="glightbox">
								<img class="block w-full h-[140px] object-cover transform duration-500 grayscale hover:scale-125" src="{{ asset('storage/master/gallery/' . $gallery['gallery_img'][$i]) }}" alt="Image Description">
								<div class="absolute inset-x-0 bottom-0 h-20 transition-opacity duration-500 ease-in opacity-0 group-hover:opacity-100 overflow-hidden px-4 py-2 text-gray-100 bg-{{ $site_settings->site_color_theme }} text-center">
									<h3 class="text-base leading-normal font-semibold my-1 text-white">Click to View</h3>
									<small class="d-block">Title and Description</small>
								</div>
							</a>
						</div>
					</figure>
				@endforeach
			</div>
		</section>
	@endif
	{{--  End Content --}}

	{{-- Testimonials starts --}}
	@if (isset($shop->shop_settings['fav_reviews']) && count($shop->shop_settings['fav_reviews']) == 3)
		<section id="testimonial" class="bg-[#F8F9FA] md:py-[5rem] md:px-[9%] py-[3rem] px-[2rem]">

			<h2 class="heading text-[2.3rem] text-center relative leading-normal px-[2rem] mb-2 font-extrabold text-[#344767] dark:text-gray-100">
				<span class="span-line">Featured</span> Testimonials
			</h2>
			<p class="text-gray-600 leading-relaxed font-semibold text-[1.5rem] text-center mx-auto pb-2 mb-[2rem]">Know our
				clients experiences about our services</p>

			<div class="container px-4">
				<div class="flex flex-wrap">
					<div class="mx-4 w-full">

					</div>
				</div>

				<div class="flex flex-wrap">
					@foreach ($reviews as $review)
						<div class="w-full px-4 md:w-1/2 lg:w-1/3">
							<div class="ud-single-testimonial wow fadeInUp mb-12 rounded-[2rem] bg-white p-8 shadow-testimonial" data-wow-delay=".1s">

								<div class="flex items-center mb-2">
									<div class="stars">
										@foreach (range(1, 5) as $i)
											<i @class([
												'fa-star py-[1rem] px-0 text-[1.3rem] text-' .
												$site_settings->site_color_theme,
												'fa-solid' => $review->ratings >= $i,
												'fa-regular' => $review->ratings < $i,
											])></i>
										@endforeach
									</div>
								</div>

								<div class="ud-testimonial-content mb-6">
									<p class="text-[1.3rem] tracking-wide text-gray-500">
										<q>{{ $review->message }}</q>
									</p>
								</div>
								<div class="ud-testimonial-info flex items-center">
									@php
										$rev_user = $review->appointment->user;
										$rev_img = !is_null($rev_user->accountSettings->profile_img) ? asset('storage/users/' . $rev_user->userId . '/images/profile/' . $rev_user->accountSettings->profile_img) : asset('assets/master/placeholders/poggy.png');
									@endphp
									<div class="ud-testimonial-image blur-profile overflow-hidden">
										<img class="h-[35px] w-[35px] rounded-full object-cover" src="{{ $rev_img }}" alt="img" />
									</div>
									<div class="ud-testimonial-meta">
										@php
											$rev_cust_name = $rev_user->firstname . ' ' . Str::mask($rev_user->lastname, '*', 0);
										@endphp
										<h4 class="text-[1.3rem] ml-5 text-[#344767] font-semibold">
											{{ $rev_cust_name }}
										</h4>
										<p class="text-[1.1rem] ml-5 text-gray-500">
											Customer Problem: {{ $review->appointment->product_details['category'] }}
										</p>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</section>
	@endif

	{{-- product section starts  --}}
	@if ($top_products->count() >= 5)
		<section class="bg-[#F8F9FA] md:py-[5rem] md:px-[9%] py-[3rem] px-[2rem]">

			<h2 class="heading text-[2.3rem] text-center relative leading-normal px-[2rem] mb-2 font-extrabold text-[#344767] dark:text-gray-100">
				Top 5 Featured <span class="span-line"> Products</span>
			</h2>
			<p class="text-gray-600 leading-relaxed font-semibold text-[1.5rem] text-center mx-auto pb-2 mb-[2rem]">
				Search and Discover all kinds of high-quality products just for you
			</p>

			<div class="box-container justify-center flex-wrap gap-[1.5rem] grid md:grid-cols-5 grid-cols-2">
				{{-- product boxes --}}
				@foreach ($top_products as $product)
					<x-customer.product-card :favorite="false" :product-ratings="$product->avg_ratings" :product-id="$product->productId" :name="$product->name" :price="$product->price" :img-showcase="$product->img_showcase" />
				@endforeach
			</div>
		</section>
	@endif

	@if (!is_null($shop->faqs))
		{{-- FAQ section starts  --}}
		<section id="faq" class="faq bg-[#F8F9FA] md:py-[5rem] md:px-[9%] py-[3rem] px-[2rem]">

			<h2 class="heading text-[2.3rem] text-center relative leading-normal px-[2rem] mb-2 font-extrabold text-[#344767] dark:text-gray-100">
				<span class="span-line">Some</span> FAQs
			</h2>
			<p class="text-gray-600 leading-relaxed font-semibold text-[1.5rem] text-center mx-auto pb-2 mb-[2rem]">Here are
				some frequently asked questions</p>

			<div class="row my-[2rem] mx-0 p-0 grid md:grid-cols-2 grid-cols-1 items-center justify-center">

				<div class="image">
					<img src="{{ asset('assets/Rectify/customer-home/FAQs-Mono.svg') }}" class="md:w-[50vw] h-[60vh] w-[100vw]" alt="">
				</div>

				<div class="accordion-container w-[100%] text-left">
					@foreach ($shop->faqs as $faq)
						<div class="accordion">
							<div class="accordion-header bg-{{ $site_settings->site_color_theme }} my-[1rem] mx-0 cursor-pointer">
								<span class="inline-block
								text-center
								h-[4rem]
								w-[5rem]
								leading-[4rem]
								text-[2rem]
								bg-[#fff]
								text-[#333]">
									+
								</span>
								<h3 class="inline
								text-[#fff]
								font-medium
								pl-[.5rem]
								text-[1.5rem]">
									{{ $faq['header'] }}
								</h3>
							</div>
							<div class="accordion-body p-[1rem]
								text-[#444]
								text-[1.3rem] hidden">
								<p>
									{{ $faq['body'] }}
								</p>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</section>
	@endif

	{{-- FAQ section ends --}}
	@if ($shop->googleMaps_embed)
		{{-- Location section starts --}}
		<section id="location" class="location bg-[#F8F9FA] md:py-[5rem] md:px-[9%] py-[3rem] px-[2rem]">
			<h2 class="heading text-[2.3rem] text-center relative leading-normal px-[2rem] mb-2 font-extrabold text-[#344767] dark:text-gray-100">
				Our <span class="span-line"> Location</span></h2>
			<p class="text-gray-600 leading-relaxed font-semibold text-[1.5rem] text-center mx-auto pb-2 mb-[2rem]">Pay us a
				visit and say hello!</p>

			{{-- <div style="w-full mt-[50px]">
				<iframe
					src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d2965.0824050173574!2d-93.63905729999999!3d41.998507000000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sWebFilings%2C+University+Boulevard%2C+Ames%2C+IA!5e0!3m2!1sen!2sus!4v1390839289319"
					width="100%" height="200" frameborder="0" style="border:0"></iframe>
			</div> --}}

			<div class="mapouter my-3">
				<iframe width="100%" height="300" id="gmap_canvas" class="rounded-lg mx-auto" src="{{ $shop->googleMaps_embed }}" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
			</div>

		</section>
		{{-- Location section ends --}}
	@endif

	@if (false)
		<section id="contact-us" class="location bg-[#F8F9FA] md:py-[5rem] md:px-[9%] py-[3rem] px-[2rem]">

			{{-- contact start --}}
			<div id="contact" class="section relative pb-20">
				<div class="container xl:max-w-[100rem] mx-auto px-4">
					<div class="flex flex-wrap flex-row -mx-4 justify-center">
						<div class="max-w-ful px-4 w-full lg:w-8/12">
							<div class="bg-[#fff] rounded-[2rem] w-full p-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
								{{-- section header --}}
								<header class="text-center mx-auto mb-12 lg:px-20">
									<h2 class="heading text-[2.3rem] text-center relative leading-normal px-[2rem] mb-2 font-extrabold text-[#344767] dark:text-gray-100">
										<span class="span-line">Contact</span> Us
									</h2>
									<p class="text-gray-600 leading-relaxed font-semibold text-[1.5rem] mx-auto pb-2">Have
										questions about our service, please contact us.</p>
								</header>{{-- end section header --}}

								{{-- contact form --}}
								<form action="#">
									<div class="flex flex-wrap flex-row -mx-4">
										<div class="flex-shrink w-full max-w-full md:w-1/2 px-4 mb-6">
											<label class="inline-block mb-2 text-[#344767] text-[1.3rem]" for="name">Your
												Name</label>
											<input type="text" name="name"
												class="w-full text-[1.3rem] leading-5 relative py-3 px-5 rounded text-[#344767] bg-[#F2F2F2] border-b border-transparent overflow-x-auto focus:outline-none focus:border-{{ $site_settings->site_color_theme }} focus:ring-0  dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600"
												id="name">
											<div class="validate"></div>
										</div>
										<div class="flex-shrink w-full max-w-full md:w-1/2 px-4 mb-6">
											<label class="inline-block mb-2 text-[#344767] text-[1.3rem]" for="email">Your
												Email</label>
											<input type="email"
												class="w-full text-[1.3rem] leading-5 relative py-3 px-5 rounded text-[#344767] bg-[#F2F2F2] border-b border-transparent overflow-x-auto focus:outline-none focus:border-{{ $site_settings->site_color_theme }} focus:ring-0  dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600"
												name="email" id="email">
											<div class="validate"></div>
										</div>
									</div>
									<div class="mb-6">
										<label class="inline-block mb-2 text-[#344767] text-[1.3rem]" for="subject">Subject</label>
										<input type="text"
											class="w-full text-[1.3rem] leading-5 relative py-3 px-5 rounded text-[#344767] bg-[#F2F2F2] border-b border-transparent overflow-x-auto focus:outline-none focus:border-{{ $site_settings->site_color_theme }} focus:ring-0  dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600"
											name="subject" id="subject">
										<div class="validate"></div>
									</div>
									<div class="mb-6">
										<label class="inline-block mb-2 text-[#344767] text-[1.3rem]" for="messages">Message</label>
										<textarea
										 class="w-full leading-5 relative text-[1.3rem] py-3 px-5 rounded text-[#344767] bg-[#F2F2F2] border-b border-transparent overflow-x-auto focus:outline-none focus:border-{{ $site_settings->site_color_theme }} focus:ring-0  dark:bg-gray-700 dark:border-gray-700 dark:focus:border-gray-600"
										 name="message" rows="10" id="messages"></textarea>
										<div class="validate"></div>
									</div>
									<div class="text-center mb-6">
										<a class="py-2.5 px-10 inline-block text-center leading-normal text-[1.5rem] text-[#fff] rounded-[.5rem] button-shade focus:outline-none focus:ring-0" href="#project">
											<i class="fa-regular fa-envelope w-[2rem]"></i>
											Send message
										</a>
									</div>
								</form>
								{{-- end contact form --}}
							</div>
						</div>
					</div>
				</div>
			</div>
			{{-- End contact --}}

		</section>
	@endif

	{{-- scroll top button  --}}

	<a href="#header-1">
		<i class="fas fa-angle-up button-shade" id="scroll-top">
		</i>
	</a>

	<script>
		$(() => {
			const swiper1 = new Swiper(".product-slider", {
				spaceBetween: 10,
				loop: true,
				centeredSlides: true,
				autoplay: {
					delay: 2500,
					disableOnInteraction: false,
				},
				breakpoints: {
					0: {
						slidesPerView: 1,
					},
					768: {
						slidesPerView: 2,
					},
					1024: {
						slidesPerView: 3,
					},
				},
			})

			const swiper2 = new Swiper(".shops-slider", {
				spaceBetween: 10,
				loop: true,
				centeredSlides: true,
				autoplay: {
					delay: 2500,
					disableOnInteraction: false,
				},
				breakpoints: {
					0: {
						slidesPerView: 1,
					},
					768: {
						slidesPerView: 2,
					},
					1024: {
						slidesPerView: 3,
					},
				},
			})


			/*faqs starts*/
			$('.accordion-header').click(function() {
				$('.accordion .accordion-body').slideUp();
				$(this).next('.accordion-body').slideDown();
				$('.accordion .accordion-header span').text('+');
				$(this).children('span').text('-');
			});
			/*faqs ends*/


			window.onload = () => {

				document.querySelector('#scroll-top').classList.add('active');

				const tabs = document.querySelectorAll('.tab')
				const panels = document.querySelectorAll('.tabpanel')

				const onTabClick = function() {
					if (this.classList.contains('active')) {
						return false
					}

					// Switch tab
					tabs.forEach(tab => tab.classList.remove('active'))
					this.classList.add('active')

					// Switch panel
					panels.forEach(panel => panel.classList.remove('active'))
					const panelId = this.getAttribute('data-panel')
					document.getElementById(panelId).classList.add('active')
				}

				tabs.forEach(tab => {
					tab.addEventListener('click', onTabClick)
				})

			}

		});


		function loader() {
			document.querySelector('.loader-container').classList.add('fade-out');
		}

		function fadeOut() {
			setInterval(loader, 2000);
		}

		window.onload = fadeOut();
	</script>
	@auth
		<script>
			var appointmentModal
			var timeModal
			var prevVal
			const imgBody = () => {
				$('#img_placeholders').html(
					`<div class="justify-center items-center pt-5 pb-6">
						<div class="p-4">
							<div id="img_prev_body" class="grid grid-cols-4 grid-rows-2 gap-5">
							</div>
						</div>
					</div>`
				)
			};

			const imgBodyPlaceholder = () => {
				if (!document.getElementById('appointment_files').value)
					$('#img_placeholders').html(
						`<div class="flex flex-col justify-center items-center pt-5 pb-6">
							<svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none"
							stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7
								16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
							</svg>
							<p class="mb-2 text-[1.3rem] text-gray-500 "><span class="font-semibold">
								Click to upload</span> or drag and drop
							</p>
							<p class="text-xs text-gray-500">
								SVG, PNG, JPG or GIF <span class="text-{{ $site_settings->site_color_theme }}">(MAXIMUM OF 8 IMAGES)</span>
							</p>
						</div>`
					)
			};

			const imgPreview = (parentDiv) => {
				const f = document.getElementById('appointment_files')
				if (f.files) {

					let filesAmount = f.files.length
					$(parentDiv).html('')

					for (let i = 0; i < filesAmount; i++) {
						let reader = new FileReader();

						reader.onload = (e) => {
							$(parentDiv).html($(parentDiv).html() +
								`<div>
									<figure class="relative max-w-lg transition-all duration-300 cursor-pointer">
										<img class="rounded-lg w-[50px] h-[50px] object-cover"
										src="${e.target.result}"
										alt="image description" />
									</figure>
								</div>`
							)
						}

						reader.readAsDataURL(f.files[i])
					}
				} else {
					imgBodyPlaceholder()
				}
			};

			const loadTimeSlots = (timeSlots) => {

				const block = $('#time_body')
				block.html('')
				Array.from(timeSlots).forEach((e, k) => {
					block.html(block.html() +
						`<div id="time-slot-${k}" class="inline-block w-[18%] p-[2%] ml-[2%] text-gray-800 rounded-lg bg-[#F2F2F2] text-center cursor-pointer ">
							${e}
						</div>`
					)
				});
				Array.from(timeSlots).forEach((e, k) => {

					$(`#time-slot-${k}`).on('click', (event) => {

						block.children().css('backgroundColor', '#d4d2d2')
						$('#time').val($(`#time-slot-${k}`).html())
						$('#selected_time').html($(`#time-slot-${k}`).html())
						$(`#time-slot-${k}`).css('backgroundColor', '{{ $site_settings->site_color_hex }}')
					})

				})
			};

			const inputChangeListener = () => {
				if ($('input#appointment_date').val() && $('input#appointment_date').val() != prevVal) {
					prevVal = $('input#appointment_date').val();
					$('input#appointment_date').change();
				}
			};
			const verifyDate = (e) => {
				let url = '{{ route('customer.appointments.getTimeSlots') }}'
				let param = $('input#appointment_date').val()

				url += '?date=' + param
				$.get(encodeURI(url))
					.done((data) => {
						loadTimeSlots(data)
						$(() => {
							$('#selected_time').prop('disabled', false)
							$('#date_error').addClass('hidden')
							console.log(data);
						})
					})
					.fail((data) => {
						$('#date_error').html(data['responseJSON']['message'])
						$(() => {
							$('#date_error').removeClass('hidden')
							$('#selected_time').prop('disabled', true)
						})
					})
			}
			$(() => {
				appointmentModal = new Modal(document.getElementById('appointment-modal'))
				timeModal = new Modal(document.getElementById('timeModal'))
				$('input#appointment_date').on('change', verifyDate)
				$('#appointment_files').on('change', () => {
					imgBody()
					imgPreview('div#img_prev_body')
				});
				setInterval(inputChangeListener, 500)
				setInterval(imgBodyPlaceholder, 500)
			});
		</script>
	@endauth
@endsection
