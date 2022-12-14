<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="md:text-[62.5%] text-[50%] overflow-x-hidden md:scroll-py-[5rem] scroll-smooth scroll-py-0">

<head>
    @include('includes.heads')
    @yield('title')

    <style>
        *::selection {
            background: {{ $site_settings->site_color_hex }};
            color: #fff;
        }

        input[type="checkbox"] {
            accent-color: {{ $site_settings->site_color_hex }};
        }

        .thumbnail:hover .thumbnail-image,
        .selected .thumbnail-image {
            border: 4px solid {{ $site_settings->site_color_hex }};
        }

        .tab.active {
            border-bottom-color: {{ $site_settings->site_color_hex }};
            color: #222;
        }

        .tab.active:hover {
            cursor: default;
        }

        .span-line {
            position: relative;
            z-index: 1;
        }

        .span-line::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 3px;
            background-color: {{ $site_settings->site_color_hex }};
            transform: skewY(-3deg);
            z-index: -1;
        }

        .loader-container {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 10000;
            background: {{ $site_settings->site_color_hex }};
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            width: 100%;
        }

        .loader-container img {
            height: 10rem;
        }

        .loader-container.fade-out {
            top: -120%;
        }

        /* radio-2 */
        #radio-2 input.star-check[type="radio"] {
            display: none;
        }

        .star-rate#radio-2>.stars {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        /* radio */
        .star-check:nth-of-type(1):hover~.stars [data-star-value="1"],
        .star-check:nth-of-type(2):hover~.stars [data-star-value="1"],
        .star-check:nth-of-type(2):hover~.stars [data-star-value="2"],
        .star-check:nth-of-type(3):hover~.stars [data-star-value="1"],
        .star-check:nth-of-type(3):hover~.stars [data-star-value="2"],
        .star-check:nth-of-type(3):hover~.stars [data-star-value="3"],
        .star-check:nth-of-type(4):hover~.stars [data-star-value="1"],
        .star-check:nth-of-type(4):hover~.stars [data-star-value="2"],
        .star-check:nth-of-type(4):hover~.stars [data-star-value="3"],
        .star-check:nth-of-type(4):hover~.stars [data-star-value="4"],
        .star-check:nth-of-type(5):hover~.stars [data-star-value="1"],
        .star-check:nth-of-type(5):hover~.stars [data-star-value="2"],
        .star-check:nth-of-type(5):hover~.stars [data-star-value="3"],
        .star-check:nth-of-type(5):hover~.stars [data-star-value="4"],
        .star-check:nth-of-type(5):hover~.stars [data-star-value="5"] {
            color: {{ $site_settings->site_color_hex }};
        }

        /* checking */
        .star-check:nth-of-type(1):checked~.stars [data-star-value="1"],
        .star-check:nth-of-type(2):checked~.stars [data-star-value="1"],
        .star-check:nth-of-type(2):checked~.stars [data-star-value="2"],
        .star-check:nth-of-type(3):checked~.stars [data-star-value="1"],
        .star-check:nth-of-type(3):checked~.stars [data-star-value="2"],
        .star-check:nth-of-type(3):checked~.stars [data-star-value="3"],
        .star-check:nth-of-type(4):checked~.stars [data-star-value="1"],
        .star-check:nth-of-type(4):checked~.stars [data-star-value="2"],
        .star-check:nth-of-type(4):checked~.stars [data-star-value="3"],
        .star-check:nth-of-type(4):checked~.stars [data-star-value="4"],
        .star-check:nth-of-type(5):checked~.stars [data-star-value="1"],
        .star-check:nth-of-type(5):checked~.stars [data-star-value="2"],
        .star-check:nth-of-type(5):checked~.stars [data-star-value="3"],
        .star-check:nth-of-type(5):checked~.stars [data-star-value="4"],
        .star-check:nth-of-type(5):checked~.stars [data-star-value="5"] {
            color: {{ $site_settings->site_color_hex }};
        }

        .stars [data-star-value] {
            color: rgb(65, 65, 65);
            position: relative;
            cursor: pointer;
            display: grid;
            align-items: center;
            width: fit-content;
            transition: color 0.3s ease;
        }

        .stars [data-star-value]::after {
            content: "";
            position: absolute;
            min-width: 8px;
            min-height: 8px;
            width: 50%;
            height: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
        }

        .box-2 {
            background-color: #fff;
            border-radius: 2rem;
            box-shadow: 0 2rem 3rem rgba(132, 139, 200, 0.18);
            transition: all 300ms ease;
        }

        #scroll-top {
            position: fixed;
            top: -120%;
            right: 2rem;
            padding: .5rem 1.5rem;
            font-size: 4rem;
            color: #fff;
            border-radius: .5rem;
            transition: 1s linear;
            z-index: 1000;
        }

        #scroll-top.active {
            top: calc(100% - 12rem)
        }

        .blur-profile {
            filter: blur(2px);
            -webkit-filter: blur(2px);
        }

        .button-shade {
            background-color: {{ $site_settings->site_color_hex }};
        }

        .button-shade:hover {
            background-image: linear-gradient(rgb(0 0 0/30%) 0 0);
        }

    </style>

</head>

<body class="box-border m-0 md:p-0 normal-case outline-none border-none no-underline pb-[6rem] bg-[#F8F9FA]">
    <!--relative min-h-screen-->

	<!-- header section starts  -->
	<header>
		<!--header 1-->
		<div class="header-1 bg-[#fff] md:py-[1.5rem] md:px-[9%] flex items-center justify-between relative p-[2rem]" id="header-1">
			<a href="#" class="logo">
				<img class="h-[4rem]" src="{{ !is_null($site_settings->site_icon) ? asset('storage/master/assets/' . $site_settings->site_icon) : asset('assets/Rectify/icons/rectify-dark-blue.svg') }}" />
			</a>

            <div class="hidden xl:block">
                <div class="text-center capitalize flex items-center">
                    <div class="inline-block px-[2rem] py-[1.8rem]">
                        <p class="cursor-pointer ellipsis-overflow text-[#344767] w-[45rem] overflow-hidden text-[1.5rem] font-medium"
                            data-popover-target="popover-bottom" data-popover-placement="bottom" type="button">
                            <i
                                class="fa-solid fa-location-dot h-[1.4rem] text-{{ $site_settings->site_color_theme }} mr-[8px]"></i>
                            {{ $shop_address }}
                        </p>
                    </div>

                    <div data-popover id="popover-bottom" role="tooltip"
                        class="inline-block absolute invisible z-10 text-[1.3rem] text-gray-500 bg-white rounded-lg border border-gray-200 shadow-sm opacity-0 transition-opacity duration-300">
                        <div class="py-4 px-5">
                            <p class="text-[#344767] text-[1.5rem] font-semibold normal-case">Come and visit us at</p>
                            <p class="text-[#344767] text-[1.5rem] font-medium">
                                <i
                                    class="fa-solid fa-location-dot h-[1.4rem] text-{{ $site_settings->site_color_theme }} mr-[8px]"></i>
                                {{ $shop_address }}
                            </p>
                        </div>
                        <div data-popper-arrow></div>
                    </div>

                    <p class="text-[#344767] inline-block px-[2rem] py-[1.8rem] text-[1.5rem] font-medium">
                        <i
                            class="fa-solid fa-clock h-[1.4rem] text-{{ $site_settings->site_color_theme }} mr-[8px]"></i>
                        {{ \Carbon\Carbon::parse($shop->appointment_settings['operatingHours']['start'])->format('h:i A') }}
                        -
                        {{ \Carbon\Carbon::parse($shop->appointment_settings['operatingHours']['end'])->format('h:i A') }}
                    </p>
                    <p
                        class="text-{{ $site_settings->site_color_theme }} inline-block px-[2rem] py-[1.8rem] text-[1.5rem] font-semibold">
                        <i
                            class="fa-solid fa-phone h-[1.4rem] text-{{ $site_settings->site_color_theme }} mr-[8px]"></i>
                        {{ $shop->contacts['mobile'] }}
                    </p>
                </div>
            </div>

            <div class="icons">
                @if (false)
                    <div id="search-btn" {{-- onclick="searchDrop() --}} data-modal-toggle="popup-search"
                        class="fa-solid fa-magnifying-glass cursor-pointer text-[2.5rem] ml-[1.5rem] text-[#344767] hover:text-{{ $site_settings->site_color_theme }} transition-all duration-[.2s] ease-linear inline-block">
                    </div>

                    <button data-popover-trigger="click" data-popover-target="popover-notification"
                        data-popover-placement="bottom" data-popover-offset="20" type="button">
                        <i
                            class="fa-solid fa-bell cursor-pointer text-[2.5rem] ml-[1.5rem] text-[#344767] hover:text-{{ $site_settings->site_color_theme }} transition-all duration-[.2s] ease-linear">
                        </i>
                    </button>

                    <div data-popover="" id="popover-notification" role="tooltip"
                        class="shadow-lg rounded-2xl inline-block absolute invisible z-10 w-72 text-sm font-light text-gray-500 bg-white border border-gray-200 opacity-0 transition-opacity duration-300 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400"
                        data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom"
                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 510px);">
                        <div class="p-3 space-y-2">

                            <div
                                class="p-5 mb-4 bg-gray-50 rounded-lg border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
                                <time class="text-lg font-semibold text-gray-900 dark:text-white">October 09,
                                    2022</time>
                                <ol class="mt-3 divide-y divider-gray-200 dark:divide-gray-700">

                                    <li>
                                        <a href="#"
                                            class="block items-center p-3 sm:flex hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <img class="mr-3 mb-3 w-12 h-12 rounded-full sm:mb-0"
                                                src="{{ /* Auth::check() ? asset($profile_img_path) : */ asset('assets/Rectify/customer-home/1by1.png') }}"
                                                alt="Bonnie Green image">
                                            <div>
                                                <div
                                                    class="text-base font-normal text-gray-600 dark:text-gray-400 normal-case">
                                                    <span class="font-medium text-gray-900 dark:text-white">Allen
                                                        Vincent</span> added <span
                                                        class="font-medium text-gray-900 dark:text-white normal-case">a
                                                        new
                                                        product</span>
                                                </div>
                                                <span
                                                    class="inline-flex items-center text-xs font-normal text-gray-500 dark:text-gray-400">
                                                    <i class="fa-solid fa-clock mr-1 w-3 text-gray-500"></i>
                                                    08:02 am
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ol>
                            </div>
                            <div
                                class="p-5 bg-gray-50 rounded-lg border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
                                <time class="text-lg font-semibold text-gray-900 dark:text-white">October 08,
                                    2022</time>
                                <ol class="mt-3 divide-y divider-gray-200 dark:divide-gray-700">
                                    <li>
                                        <a href="#"
                                            class="block items-center p-3 sm:flex hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <img class="mr-3 mb-3 w-12 h-12 rounded-full sm:mb-0"
                                                src="{{ asset('assets/Rectify/customer-home/1by1.png') }}"
                                                alt="Laura Romeros image">
                                            <div class="text-gray-600 dark:text-gray-400">
                                                <div class="text-base font-normal"><span
                                                        class="font-medium text-gray-900 dark:text-white">Allen
                                                        Vincent</span> likes <span
                                                        class="font-medium text-gray-900 dark:text-white">your
                                                        comment</span></div>
                                                <div class="text-sm font-normal">"Thank you seller! Nagagamit ko na uli
                                                    cp
                                                    ko hehe"</div>
                                                <span
                                                    class="inline-flex items-center text-xs font-normal text-gray-500 dark:text-gray-400">
                                                    <i class="fa-solid fa-clock mr-1 w-3 text-gray-500"></i>
                                                    09:53 pm
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block items-center p-3 sm:flex hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <img class="mr-3 mb-3 w-12 h-12 rounded-full sm:mb-0"
                                                src="{{ asset('assets/Rectify/customer-home/1by1.png') }}"
                                                alt="Mike Willi image">
                                            <div>
                                                <div class="text-base font-normal text-gray-600 dark:text-gray-400">
                                                    <span class="font-medium text-gray-900 dark:text-white">Allen
                                                        Vincent</span> repaired <span
                                                        class="font-medium text-gray-900 dark:text-white">your Realme
                                                        5i</span></div>
                                                <span
                                                    class="inline-flex items-center text-xs font-normal text-gray-500 dark:text-gray-400">
                                                    <i class="fa-solid fa-clock mr-1 w-3 text-gray-500"></i>
                                                    04:04 pm
                                                </span>
                                            </div>
                                        </a>
                                    </li>

                                </ol>
                            </div>

                        </div>
                        <div data-popper-arrow=""
                            style="position: absolute; left: 0px; transform: translate(0px, 0px);">
                        </div>
                    </div>
                @endif
                <a href="{{ route('customer.cart.index') }}">
                    <i
                        class="fa-solid fa-shopping-cart cursor-pointer text-[2.5rem] ml-[1.5rem] text-[#344767] hover:text-{{ $site_settings->site_color_theme }} transition-all duration-[.2s] ease-linear">
                    </i>
                </a>

                @guest
                    {{-- Guest Mode --}}
                    <button data-popover-trigger="click" data-popover-target="popover-account-guest"
                        data-popover-placement="bottom" data-popover-offset="20" type="button">
                        <x-profile-placeholder class="ml-[1.5rem]" />
                    </button>

                    <div data-popover="" id="popover-account-guest" role="tooltip"
                        class="shadow-lg rounded-2xl inline-block absolute invisible z-10 w-72 text-sm font-light text-gray-500 bg-white border border-gray-200 opacity-0 transition-opacity duration-300 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400"
                        data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom"
                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 510px);">
                        <div class="p-3 space-y-2">
                            <div class=" bg-white flex flex-col items-center justify-center p-4 rounded-2xl w-64">
                                <i
                                    class="fa-solid fa-user text-[2rem] text-gray-500 block h-[2rem] w-[2rem] leading-[2rem] bg-[rgba(0,0,0,.05)] rounded-[50%] p-5"></i>

                                <p class="text-gray-800 text-[1.3rem] font-medium mt-4 text-center">
                                    Not Signed In
                                </p>

                                <p class="text-gray-500 mt-4 cursor-pointer hover:text-{{$site_settings->site_color_theme}} normal-case text-center">
                                    You must be logged in to access this functionality
                                </p>
                                <div class=" w-full mt-8">
                                    <button
                                        class="py-2 px-4 button-shade text-white w-full font-semibold rounded-lg shadow-lg"
                                        onclick="location.href='{{ route('auth.customer.login') }}'">
                                        LOGIN
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div data-popper-arrow="" style="position: absolute; left: 0px; transform: translate(0px, 0px);">
                        </div>
                    </div>
                @else
                    <!--Sign In Mode-->
                    <button data-popover-trigger="click" data-popover-target="popover-account" class="align-bottom"
                        data-popover-placement="bottom" data-popover-offset="20" type="button">
                        <img src="{{ $profile_img_path }}" alt="profile"
                            class="rounded-full w-12 h-12 object-cover cursor-pointer ml-[1.5rem]">
                    </button>
                    <div data-popover="" id="popover-account" role="tooltip"
                        class="shadow-lg rounded-2xl inline-block absolute invisible z-10 w-72 text-sm font-light text-gray-500 bg-white border border-gray-200 opacity-0 transition-opacity duration-300 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400"
                        data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom"
                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 510px);">
                        <div class="p-3 space-y-2">
                            <div class=" bg-white flex flex-col items-center justify-center p-4 rounded-2xl w-64">

                                <img src="{{ $profile_img_path }}" alt="profile"
                                    class="mx-auto rounded-full w-[4rem] h-[4rem] object-cover">

                                <p class="text-gray-800 text-[1.3rem] font-medium mt-4 text-center">
                                    {{ $full_name }}
                                </p>
                                <p class="text-gray-500 lowercase">{{ $user->email }}</p>
                                <button onclick="location.href='{{ route('customer.orders.index') }}'"
                                    class="text-{{ $site_settings->site_color_theme }} mt-4 cursor-pointer text-[1rem]">My
                                    Orders</button>
                                <button onclick="location.href='{{ route('customer.settings.index') }}'"
                                    class="text-{{ $site_settings->site_color_theme }} mt-2 cursor-pointer text-[1rem]">Account
                                    Settings</button>

                                <div class=" w-full mt-8">
                                    <form action="{{ route('logout') }}" method="POST" class="inline">
                                        @csrf
                                        <button
                                            class="button-shade py-2 px-4 text-white w-full font-semibold rounded-lg shadow-lg ">LOGOUT</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div data-popper-arrow="" style="position: absolute; left: 0px; transform: translate(0px, 0px);">
                        </div>
                    </div>
                @endguest
            </div>
        </div>

        <!--header 2-->
        <div id="header-2" class="header-2 bg-[#fff] hidden md:block">
            <nav class="text-center capitalize">
                <a href="{{ Auth::check() ? route('customer.home.index') : __('/') }}"
                    class="text-[#344767] inline-block px-[1.2rem] py-[1.8rem] text-[1.7rem] hover:text-{{ $site_settings->site_color_theme }} hover:bg-[rgb(220,220,220,0.3)] transition-all duration-[.2s] ease-linear font-semibold">
                    Home
                </a>

                <a href="{{ route('customer.products.index') }}"
                    class="text-[#344767] inline-block px-[1.2rem] py-[1.8rem] text-[1.7rem] hover:text-{{ $site_settings->site_color_theme }} hover:bg-[rgb(220,220,220,0.3)] transition-all duration-[.2s] ease-linear font-semibold">
                    Products
                </a>

                <a href="{{ route('customer.favorites.index') }}"
                    class="text-[#344767] inline-block px-[1.2rem] py-[1.8rem] text-[1.7rem] hover:text-{{ $site_settings->site_color_theme }} hover:bg-[rgb(220,220,220,0.3)] transition-all duration-[.2s] ease-linear font-semibold">
                    Favorites
                </a>

                <a href="{{ route('customer.appointments.index') }}"
                    class="text-[#344767] inline-block px-[1.2rem] py-[1.8rem] text-[1.7rem] hover:text-{{ $site_settings->site_color_theme }} hover:bg-[rgb(220,220,220,0.3)] transition-all duration-[.2s] ease-linear font-semibold">
                    Appointments
                </a>

                <a href="{{ route('customer.chats.index') }}"
                    class="text-[#344767] inline-block px-[1.2rem] py-[1.8rem] text-[1.7rem] hover:text-{{ $site_settings->site_color_theme }} hover:bg-[rgb(220,220,220,0.3)] transition-all duration-[.2s] ease-linear font-semibold">
                    Messages
                </a>
            </nav>
        </div>

        <!-- bottom navbar  -->
        <nav class="mobile-nav text-center bg-[#FFF] fixed bottom-0 left-0 right-0 z-[1000] md:hidden block shadow-md">
            <a href="{{ Auth::check() ? route('customer.home.index') : __('/') }}">
                <i
                    class="fas fa-home text-[2.5rem] p-[2rem] text-[#344767]
					hover:text-{{ $site_settings->site_color_theme }} hover:bg-[rgb(220,220,220,0.3)]
					transition-all duration-[.2s] ease-linear">
                </i>
            </a>

            <a href="{{ route('customer.products.index') }}">
                <i
                    class="fas fa-tags text-[2.5rem] p-[2rem] text-[#344767]
					hover:text-{{ $site_settings->site_color_theme }} hover:bg-[rgb(220,220,220,0.3)]
					transition-all duration-[.2s] ease-linear">
                </i>
            </a>

            <a href="{{ route('customer.favorites.index') }}">
                <i
                    class="fas fa-heart text-[2.5rem] p-[2rem] text-[#344767]
					hover:text-{{ $site_settings->site_color_theme }} hover:bg-[rgb(220,220,220,0.3)]
					transition-all duration-[.2s] ease-linear">
                </i>
            </a>

            <a href="{{ route('customer.appointments.index') }}">
                <i
                    class="fas fa-calendar text-[2.5rem] p-[2rem] text-[#344767]
					hover:text-{{ $site_settings->site_color_theme }} hover:bg-[rgb(220,220,220,0.3)]
					transition-all duration-[.2s] ease-linear">
                </i>
            </a>

            <a href="{{ route('customer.chats.index') }}">
                <i
                    class="fas fa-message text-[2.5rem] p-[2rem] text-[#344767]
					hover:text-{{ $site_settings->site_color_theme }} hover:bg-[rgb(220,220,220,0.3)]
					transition-all duration-[.2s] ease-linear">
                </i>
            </a>
        </nav>
    </header>

    {{-- section('content') --}}
    @yield('content')

    {{-- footer section --}}
    <section class="horizontal-scroll2"
        style="background-image: url({{ asset('assets/Rectify/customer-home/footer_bg.png') }})">

        <div class="horizontal-scroll"
            style="background-image: url({{ asset('assets/Rectify/customer-home/footer_fr.png') }})">
        </div>

        <div class="flex-wrap md:px-[9%] px-[2rem] bg-[#d8d4d4] grid md:grid-cols-4 grid-cols-2">
            <div class="flex-[1_1_25rem] m-[2rem] md:block hidden">
                <h3 class="text-[2.3rem] font-extrabold text-[#344767] py-[1rem] px-0 ">
                    About Us
                </h3>
                <p class="text-[1.3rem] py-[.5rem] px-0 text-gray-500">
                    {{ $shop->description }}
                </p>
            </div>

            <div class="flex-[1_1_25rem] m-[2rem] md:text-left text-center md:block hidden">
                <h3 class="text-[2.3rem] font-extrabold text-[#344767] py-[1rem] px-0 ">
                    Quick Links
                </h3>
                <a href="#" class="block text-[1.3rem] py-[.5rem] px-0 text-gray-500">Home</a>
                <a href="#" class="block text-[1.3rem] py-[.5rem] px-0 text-gray-500">About Us</a>
                <a href="#" class="block text-[1.3rem] py-[.5rem] px-0 text-gray-500">Services</a>
                <a href="#" class="block text-[1.3rem] py-[.5rem] px-0 text-gray-500">Gallery</a>
                <a href="#" class="block text-[1.3rem] py-[.5rem] px-0 text-gray-500">Top Products</a>
            </div>

            <div class="flex-[1_1_25rem] m-[2rem] md:text-left text-center md:block hidden">
                <h3 class="text-[2.3rem] font-extrabold text-[#344767] py-[1rem] px-0 ">
                    Follow Us
                </h3>
                <a href="#" class="block text-[1.3rem] py-[.5rem] px-0 text-gray-500">Facebook</a>
                <a href="#" class="block text-[1.3rem] py-[.5rem] px-0 text-gray-500">Instagram</a>
                <a href="#" class="block text-[1.3rem] py-[.5rem] px-0 text-gray-500">Tiktok</a>
                <a href="#" class="block text-[1.3rem] py-[.5rem] px-0 text-gray-500">Twitter</a>
            </div>

            <div class="flex-[1_1_25rem] m-[2rem] col-span-2 md:col-span-1">
                <h3 class="text-[2.3rem] font-extrabold text-[#344767] text-center md:text-left py-[1rem] px-0">
                    Contact Info
                </h3>

                <div>
                    <div class="info flex items-center">
                        <a href="#">
                            <i
                                class="cursor-pointer mr-[1rem] fa-solid fa-phone h-[1.3rem] w-[1.3rem] leading-[1.3rem] text-[1.1rem] text-[#344767] bg-[#f2f2f2] rounded-[50%] mt-[.7rem] p-5 hover:text-{{ $site_settings->site_color_theme }} transition-all duration-[.2s] ease-linear">
                            </i>
                        </a>
                        <p class="text-[1.3rem] py-[.5rem] px-0 text-gray-500">
                            {{ $shop->contacts['mobile'] }}
                        </p>
                    </div>

                    <div class="info flex items-center">
                        <a href="#">
                            <i
                                class="cursor-pointer mr-[1rem] fa-solid fa-envelope h-[1.3rem] w-[1.3rem] leading-[1.3rem] text-[1.1rem] text-[#344767] bg-[#f2f2f2] rounded-[50%] mt-[.7rem] p-5 hover:text-{{ $site_settings->site_color_theme }} transition-all duration-[.2s] ease-linear">
                            </i>
                        </a>
                        <p class="text-[1.3rem] py-[.5rem] px-0 text-gray-500">
                            {{ $shop->user->email }}
                        </p>
                    </div>

                    <div class="info flex items-center">
                        <a href="#">
                            <i
                                class="cursor-pointer mr-[1rem] fa-solid fa-map-marker-alt h-[1.3rem] w-[1.3rem] leading-[1.3rem] text-[1.1rem] text-[#344767] bg-[#f2f2f2] rounded-[50%] mt-[.7rem] p-5 hover:text-{{ $site_settings->site_color_theme }} transition-all duration-[.2s] ease-linear">
                            </i>
                        </a>
                        <p class="text-[1.3rem] py-[.5rem] px-0 text-gray-500">
                            {{ $shop_address }}
                        </p>
                    </div>
                </div>
            </div>

            <h1
                class=" bg-[#d8d4d4] credit text-[2rem] col-span-2 md:col-span-4
							text-[#344767] font-SemiBoldItalic
							border-t-[.1rem] border-solid border-[#fff5]
							py-[2.5rem] px-[1rem]
							text-center mb-[6rem] md:mb-0">
                Created by <span class="text-{{ $site_settings->site_color_theme }}">Team 404</span> | Copyright 2022
            </h1>
        </div>
    </section>

    @include('includes.feet')

    <script>
        $(() => {
            var lightbox = GLightbox();
            // $('.search-form').click(searchToggle)
            const header2 = document.querySelector('#header-2')

            window.onscroll = () => {

                //searchForm.classList.remove('top-[115%]')
                //searchForm.classList.add('top-[-115%]')

                if (window.scrollY > 80) {
                    header2.classList.add('fixed');
                    header2.classList.add('top-0');
                    header2.classList.add('left-0');
                    header2.classList.add('right-0');
                    header2.classList.add('z-[1000]');
                    header2.classList.add('bg-[#FFF]');
                    header2.classList.add('shadow-lg');
                } else {
                    header2.classList.remove('fixed');
                    header2.classList.remove('top-0');
                    header2.classList.remove('left-0');
                    header2.classList.remove('right-0');
                    header2.classList.remove('z-[1000]');
                    header2.classList.remove('bg-[#FFF]');
                    header2.classList.remove('shadow-lg');
                }
            }

        });
    </script>
</body>

</html>
