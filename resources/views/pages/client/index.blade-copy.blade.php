@extends('layouts.customer')

@section('title')
    <title>{{ Str::title(config('app.name')) }} - Home</title>
@endsection

@section('content')
    <!-- home section starts  -->
    <!-- ayaw gumana ng file path
                                                                                            <section class="bg-[url({{ asset('assets/Rectify/customer-home/banner-bg.jpg') }})]" id="home">
                                                                                            -->
    <section class="bg-[#f1eeee] lg:py-[5rem] lg:px-[9%] py-[3rem] px-[2rem]" id="home">
        <!--row-->
        <div class="flex items-center flex-wrap gap-6">
            <!--content-->
            <div class="flex-[1_1_42rem] lg:text-left text-center">
                <h3 class="lg:text-[4.5rem] text-[#344767] font-extrabold text-[3.5rem]">Welcome to Rectify!</h3>
                <p class="text-[#666] text-[1.4rem] leading-loose py-[1rem] px-[0]">
                    Enjoy hassle-free repair booking and
                    shopping services for everyone.
                </p>
                @if (Auth::check())
                    <a href="#" data-modal-toggle="appointment-modal"
                        class="my-[1rem] inline-block
                        py-[.9rem] px-[3rem] rounded-[.5rem]
                        text-[#fff] bg-{{$site_settings->site_color_theme}} text-[1.7rem]
                        cursor-pointer font-[500]
                        hover:bg-[#d16868]"
                        type="button">book an appointment</a>
                @else
                    <a href="{{ route('auth.customer.login') }}"
                        class="my-[1rem] inline-block
                        py-[.9rem] px-[3rem] rounded-[.5rem]
                        text-[#fff] bg-{{$site_settings->site_color_theme}} text-[1.7rem]
                        cursor-pointer font-[500]
                        hover:bg-[#d16868]"
                        type="button">book an appointment</a>
                @endif
            </div>
            <!--swiper slider-->
            <!--    <div class="flex-[1_1_42rem] text-center mt-[2rem]" id="slider">    nilagay ko sa taas yung css kasi need nya ng name na same sa swiper-bundle.min.css kaya di pwede tanggalin or idk-->
            <div class="swiper product-slider text-center mt-[2rem] flex-[1_1_42rem]">
                <!--swiper-wrapper-->
                <div class="swiper-wrapper">
                    <a href="#" class="swiper-slide">
                        <img src="{{ asset('assets/Rectify/customer-home/product-1.png') }}"
                            class="h-[25rem] hover:scale-90 transition-all
                            duration-[.2s] ease-linear inline"
                            alt=""></a>
                    <a href="#" class="swiper-slide">
                        <img src="{{ asset('assets/Rectify/customer-home/product-2.png') }}"
                            class="h-[25rem] hover:scale-90 transition-all
                            duration-[.2s] ease-linear inline"
                            alt=""></a>
                    <a href="#" class="swiper-slide">
                        <img src="{{ asset('assets/Rectify/customer-home/product-3.png') }}"
                            class="h-[25rem] hover:scale-90 transition-all
                            duration-[.2s] ease-linear inline"
                            alt=""></a>
                    <a href="#" class="swiper-slide">
                        <img src="{{ asset('assets/Rectify/customer-home/product-4.png') }}"
                            class="h-[25rem] hover:scale-90 transition-all
                            duration-[.2s] ease-linear inline"
                            alt=""></a>
                    <a href="#" class="swiper-slide">
                        <img src="{{ asset('assets/Rectify/customer-home/product-5.png') }}"
                            class="h-[25rem] hover:scale-90 transition-all
                            duration-[.2s] ease-linear inline"
                            alt=""></a>
                    <a href="#" class="swiper-slide">
                        <img src="{{ asset('assets/Rectify/customer-home/product-6.png') }}"
                            class="h-[25rem] hover:scale-90 transition-all
                            duration-[.2s] ease-linear inline"
                            alt=""></a>
                </div>
                <!--image stand-->
                <img src="{{ asset('assets/Rectify/customer-home/stand.png') }}" class="w-[100%] mt-[-2rem]" alt="">
            </div>
        </div>
    </section>
    <!-- home section end  -->

    {{-- Render modal if logged in --}}
    @if (Auth::check())
        <!-- Main modal -->
        <div id="appointment-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden
            fixed top-0 right-0 left-0 z-50 w-full
            h-modal justify-center items-center
            md:inset-0 md:h-full ">
            <div class="relative p-4 w-full max-w-[80%] h-full
            md:h-[80%]">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow
                dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent
                        rounded-lg text-[1.3rem] p-1.5 ml-auto inline-flex items-center
                        hover:bg-gray-200 hover:text-gray-900
                        dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-toggle="appointment-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="py-6 px-6 lg:px-8 overflow-auto">
                        <h3
                            class="mb-4 text-[2rem] font-bold text-gray-900
                        dark:text-white px-[30px]">
                            Request an Appointment
                        </h3>
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form id="appointment-form"
                            {{-- action="{{route('customer.appointments.store')}}"
                            method="post" --}}
                            autocomplete="off"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="colum lg:w-[33%] w-full py-[10px] px-[30px] float-left space-y-6">
                                <h4
                                    class="mb-4 text-[1.5rem] font-bold text-[#5F6368]
                                dark:text-white">
                                    Contact Information</h4>
                                <div>
                                    <label for="firstName"
                                        class="block mb-2 text-[1.3rem]
                                        font-medium text-gray-900
                                        dark:text-gray-300">
                                        First Name</label>
                                    <input type="text" name="firstName" id="firstName"
                                        class="bg-[#F2F2F2] border-none
                                        text-gray-900 text-[1.3rem] rounded-lg
                                        focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}}
                                        block w-full p-2.5
                                        dark:bg-gray-600 dark:border-gray-500
                                        dark:placeholder-gray-400 dark:text-white"
                                        placeholder="Juan" required readonly value="{{ Auth::user()->firstname }}">
                                </div>
                                <div>
                                    <label for="lastName"
                                        class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Last
                                        Name</label>
                                    <input type="text" name="lastName" id="lastName"
                                        class="bg-[#F2F2F2] border-none
                                        text-gray-900 text-[1.3rem] rounded-lg
                                        focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}}
                                        block w-full p-2.5
                                        dark:bg-gray-600 dark:border-gray-500
                                        dark:placeholder-gray-400 dark:text-white"
                                        placeholder="Dela Cruz" required readonly value="{{ Auth::user()->lastname }}">
                                </div>
                                <div>
                                    <label for="email"
                                        class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Email
                                        Address</label>
                                    <input type="email" name="email" id="email"
                                        class="bg-[#F2F2F2] border-none
                                        text-gray-900 text-[1.3rem] rounded-lg
                                        focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}}
                                        block w-full p-2.5
                                        dark:bg-gray-600 dark:border-gray-500
                                        dark:placeholder-gray-400
                                        dark:text-white"
                                        placeholder="rectify@gmail.com" required readonly
                                        value="{{ Auth::user()->email }}">
                                </div>
                                <div>
                                    <label for="contact"
                                        class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Contact
                                        Number</label>
                                    <input type="text" name="contact" id="contact"
                                        class="bg-[#F2F2F2] border-none
                                        text-gray-900 text-[1.3rem] rounded-lg
                                        focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}}
                                        block w-full p-2.5
                                        dark:bg-gray-600 dark:border-gray-500
                                        dark:placeholder-gray-400 dark:text-white"
                                        placeholder="09912345678" required readonly value="{{ Auth::user()->contact }}">
                                </div>
                                <div>
                                    <label for="alt-contact"
                                        class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Alternative
                                        Contact Number</label>
                                    <input type="text" name="alt-contact" id="alt-contact"
                                        class="bg-[#F2F2F2] border-none
                                        text-gray-900 text-[1.3rem] rounded-lg
                                        focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}}
                                        block w-full p-2.5 dark:bg-gray-600
                                        dark:border-gray-500 dark:placeholder-gray-400
                                        dark:text-white"
                                        placeholder="09997778888" value="{{ old('alt-contact') }}">
                                </div>
                            </div>
                            <div class="colum lg:w-[33%] w-full py-[10px] px-[30px] float-left space-y-6">
                                <h4 class="mb-4 text-[1.5rem] font-bold text-[#5F6368] dark:text-white">Product Information
                                </h4>
                                <div>
                                    <label for="category"
                                        class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Category</label>
                                    <!--
                                                                                        <button id="dropdownDefault"
                                                                                            data-dropdown-toggle="dropdown"
                                                                                            class="text-white bg-{{$site_settings->site_color_theme}}
                                            hover:bg-[#d16868]
                                            focus:ring-4 focus:outline-none focus:ring-{{$site_settings->site_color_theme}}
                                            font-medium rounded-lg text-[1.3rem] w-full p-2.5
                                            text-center inline-flex items-center
                                            dark:bg-blue-600 dark:hover:bg-{{$site_settings->site_color_theme}}
                                            dark:focus:ring-blue-800"
                                                                                            type="button">Select Category
                                                                                                <svg class="ml-2 w-4 h-4 " aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                                                            </svg>
                                                                                        </button>
                                                                                            Dropdown menu
                                                                                        <div id="dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 410px);">
                                                                                            <ul class="py-1 text-[1.3rem] text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                                                                                                <li>
                                                                                                    <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Laptop</a>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">PC</a>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mobile</a>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tablet</a>
                                                                                                </li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    -->

                                    <button id="multiLevelDropdownButton" data-dropdown-toggle="dropdown"
                                        class="text-white bg-{{$site_settings->site_color_theme}} hover:bg-[#d16868] focus:ring-4 focus:outline-none focus:ring-{{$site_settings->site_color_theme}} font-medium rounded-lg text-[1.3rem] w-full p-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-{{$site_settings->site_color_theme}} dark:focus:ring-blue-800"
                                        type="button">Select Category <svg class="ml-2 w-4 h-4" aria-hidden="true"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg></button>
                                    <!-- Dropdown menu -->
                                    <div id="dropdown"
                                        class="hidden z-10 w-[25%] bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="multiLevelDropdownButton">
                                            <li>
                                                <button id="firstDropdownButton" data-dropdown-toggle="firstDropdown"
                                                    data-dropdown-placement="right-start" type="button"
                                                    class="flex justify-between items-center py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mobile
                                                    and Gadgets<svg aria-hidden="true" class="w-4 h-4"
                                                        fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg></button>
                                                <div id="firstDropdown"
                                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700"
                                                    data-popper-reference-hidden="" data-popper-escaped=""
                                                    data-popper-placement="right-start"
                                                    style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(10px, 500px);">
                                                    <a href="#" class="block py-2 px-4"hidden z-10 w-44 bg-white
                                                        rounded divide-y divide-gray-100 shadow dark:bg-gray-700"
                                                        data-popper-reference-hidden="" data-popper-escaped=""
                                                        data-popper-placement="right-start"
                                                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(10px, 500px);">
                                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                            aria-labelledby="firstDropdownButton">
                                                            <li>
                                                                <a href="#"
                                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sim
                                                                    Cards</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"
                                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Tablets</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"
                                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mobile
                                                                    Phones</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"
                                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Wearable
                                                                    Devices</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"
                                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Accessories</a>
                                                            </li>
                                                            <li>
                                                                <a href="#"
                                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Walkie
                                                                    Talkies</a>
                                                            </li>
                                                        </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <button id="secondDropdownButton" data-dropdown-toggle="secondDropdown"
                                                    data-dropdown-placement="right-start" type="button"
                                                    class="flex justify-between items-center py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Audio<svg
                                                        aria-hidden="true" class="w-4 h-4" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg></button>
                                                <div id="secondDropdown"
                                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700"
                                                    data-popper-reference-hidden="" data-popper-escaped=""
                                                    data-popper-placement="right-start"
                                                    style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(10px, 500px);">
                                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                        aria-labelledby="secondDropdownButton">
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earphones,
                                                                Headphones, and Headsets</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Media
                                                                Players</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Microphones</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Amplifiers
                                                                and Mixers</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Audio
                                                                and Speakers</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Audio
                                                                and Video Cables and Converters</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <button id="thirdDropdownButton" data-dropdown-toggle="thirdDropdown"
                                                    data-dropdown-placement="right-start" type="button"
                                                    class="flex justify-between items-center py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Gaming
                                                    and Console<svg aria-hidden="true" class="w-4 h-4"
                                                        fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg></button>
                                                <div id="thirdDropdown"
                                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700"
                                                    data-popper-reference-hidden="" data-popper-escaped=""
                                                    data-popper-placement="right-start"
                                                    style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(10px, 500px);">
                                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                        aria-labelledby="thirdDropdownButton">
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Console
                                                                Machines</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Console
                                                                Accessories</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Video
                                                                Game</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <button id="fourthDropdownButton" data-dropdown-toggle="fourthDropdown"
                                                    data-dropdown-placement="right-start" type="button"
                                                    class="flex justify-between items-center py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Cameras
                                                    and Drones<svg aria-hidden="true" class="w-4 h-4" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg></button>
                                                <div id="fourthDropdown"
                                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700"
                                                    data-popper-reference-hidden="" data-popper-escaped=""
                                                    data-popper-placement="right-start"
                                                    style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(10px, 500px);">
                                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                        aria-labelledby="fourthDropdownButton">
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Cameras</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Security
                                                                Cameras and Systems</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Lens</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Lens
                                                                Accessories</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Camera
                                                                Accessories</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Camera
                                                                Care</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Drones</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Drones
                                                                Accessories</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <button id="fifthDropdownButton" data-dropdown-toggle="fifthDropdown"
                                                    data-dropdown-placement="right-start" type="button"
                                                    class="flex justify-between items-center py-2 px-4 w-full hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Computer
                                                    and Accessories<svg aria-hidden="true" class="w-4 h-4"
                                                        fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg></button>
                                                <div id="fifthDropdown"
                                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700"
                                                    data-popper-reference-hidden="" data-popper-escaped=""
                                                    data-popper-placement="right-start"
                                                    style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(10px, 500px);">
                                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                                        aria-labelledby="fifthDropdownButton">
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Desktop
                                                                Computers</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Monitors</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Desktop
                                                                and Laptop Components</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Data
                                                                Storage</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Network
                                                                Components</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Softwares</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Office
                                                                Equipment</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Printers
                                                                and Scanners</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Peripherals
                                                                and Accessories</a>
                                                        </li>
                                                        <li>
                                                            <a href="#"
                                                                class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">keyboards
                                                                and Mice</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                                <div>
                                    <label for="product_brand"
                                        class="block mb-2 text-[1.3rem]
                                        font-medium text-gray-900
                                        dark:text-gray-300">
                                        Product Brand</label>
                                    <input type="text" name="product_brand" id="product_brand"
                                        class="bg-[#F2F2F2] border-none
                                        text-gray-900 text-[1.3rem] rounded-lg
                                        focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}}
                                        block w-full p-2.5 dark:bg-gray-600
                                        dark:border-gray-500 dark:placeholder-gray-400
                                        dark:text-white"
                                        placeholder="Samsung" required value="{{ old('product_brand') }}">
                                </div>
                                <div>
                                    <label for="model_name"
                                        class="block mb-2 font-medium
                                        text-[1.3rem] text-gray-900
                                        dark:text-gray-300">
                                        Model Name</label>
                                    <input type="text" name="model_name" id="model_name"
                                        class="bg-[#F2F2F2] border-none
                                        text-gray-900 text-[1.3rem] rounded-lg
                                        focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}}
                                        block w-full p-2.5
                                        dark:bg-gray-600 dark:border-gray-500
                                        dark:placeholder-gray-400 dark:text-white"
                                        placeholder="Galaxy S20 Ultra" required value="{{ old('model_name') }}">
                                </div>
                                <div>
                                    <label for="model_num"
                                        class="block mb-2 text-[1.3rem] font-medium
                                        text-gray-900
                                        dark:text-gray-300">
                                        Model Number</label>
                                    <input type="text" name="model_num" id="model_num"
                                        class="bg-[#F2F2F2] border-none
                                        text-gray-900 text-[1.3rem] rounded-lg
                                        focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}}
                                        block w-full p-2.5 dark:bg-gray-600
                                        dark:border-gray-500 dark:placeholder-gray-400
                                        dark:text-white"
                                        placeholder="SM-G988" value="{{ old('model_num') }}">
                                </div>

                                <h4 class="mb-4 text-[1.5rem] font-bold text-[#5F6368] dark:text-white">Time and Date</h4>
                                <div class="relative">
                                    <label for="date"
                                        class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Date</label>
                                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                    </div>
                                    <input datepicker="" type="text" name="date"
                                        class="bg-[#F2F2F2] border-none
                                        text-gray-900 text-[1.3rem] rounded-lg
                                        focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}}
                                        block w-full p-2.5
                                        dark:bg-gray-600 dark:border-gray-500
                                        dark:placeholder-gray-400
                                        dark:text-white
                                        datepicker-input"
                                        placeholder="Select date" value="{{ old('date') }}">
                                </div>
                                <div>
                                    <label for="time"
                                        class="block mb-2 text-[1.3rem]
                                        font-medium text-gray-900
                                        dark:text-gray-300">Time</label>
                                    <input type="text" name="time" id="time"
                                        class="bg-[#F2F2F2] border-none
                                        text-gray-900 text-[1.3rem] rounded-lg
                                        focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}}
                                        block w-full p-2.5
                                        dark:bg-gray-600 dark:border-gray-500
                                        dark:placeholder-gray-400 dark:text-white"
                                        placeholder="Select Time" value="{{ old('time') }}">
                                </div>
                            </div>

                            <div class="colum lg:w-[33%] w-full py-[10px] px-[30px] float-left space-y-6">
                                <h4 class="mb-4 text-[1.5rem] font-bold text-[#5F6368] dark:text-white">Concern</h4>
                                <div>
                                    <label for="concern"
                                        class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Describe
                                        the issue that you are experiencing
                                    </label>
                                    <textarea id="concern" name="concern" rows="4"
                                        class="block p-2.5 w-full text-[1.3rem] text-gray-900 bg-gray-50 rounded-lg border-none focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}} dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-{{$site_settings->site_color_theme}} dark:focus:border-{{$site_settings->site_color_theme}}"
                                        placeholder="Type your problem here...">{{ old('concern') }}</textarea>
                                </div>
                                <div>
                                    <label class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">
                                        Please add images or video
                                    </label>
                                    <div class="flex justify-center items-center w-full">
                                        <label for="files"
                                            class="flex flex-col justify-center items-center w-full h-64 bg-gray-50 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                            <div class="flex flex-col justify-center items-center pt-5 pb-6">
                                                <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                    </path>
                                                </svg>
                                                <p class="mb-2 text-[1.3rem] text-gray-500 dark:text-gray-400"><span
                                                        class="font-semibold">Click to upload</span> or drag and drop</p>
                                                <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF
                                                    (MAX.
                                                    800x400px)</p>
                                            </div>
                                        </label>
                                        <input hidden id="files" name="files[]" type="file" multiple>
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="remember" type="checkbox" value=""
                                                class="w-4 h-4 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-{{$site_settings->site_color_theme}} dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-{{$site_settings->site_color_theme}} dark:ring-offset-gray-800"
                                                required>
                                        </div>
                                        <label for="remember"
                                            class="ml-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">By
                                            using
                                            this form, I understand and agree to the
                                            <a href="#"
                                                class="text-{{$site_settings->site_color_theme}} hover:underline dark:text-{{$site_settings->site_color_theme}}">Privacy
                                                Policy</a>
                                            and <a href="#"
                                                class="text-{{$site_settings->site_color_theme}} hover:underline dark:text-{{$site_settings->site_color_theme}}">Terms and
                                                Conditions</a></label>
                                    </div>

                                </div>
                                <!--<button type="submit" class="w-full text-white bg-{{$site_settings->site_color_theme}} hover:bg-[#d16868] focus:ring-4 focus:outline-none focus:ring-{{$site_settings->site_color_theme}} font-medium rounded-lg text-[1.3rem] px-5 py-2.5 text-center dark:bg-{{$site_settings->site_color_theme}} dark:hover:bg-{{$site_settings->site_color_theme}} dark:focus:ring-{{$site_settings->site_color_theme}}">Request an Appointment</button>-->
                            </div>
                            <button type="submit" id="appointment-submit-btn"
                                class="w-[33%] text-white bg-{{$site_settings->site_color_theme}}
                                hover:bg-[#d16868]
                                focus:ring-4 focus:outline-none focus:ring-{{$site_settings->site_color_theme}}
                                font-medium rounded-lg text-[1.3rem] px-5 py-2.5 text-center
                                dark:bg-{{$site_settings->site_color_theme}}
                                dark:hover:bg-{{$site_settings->site_color_theme}}
                                dark:focus:ring-{{$site_settings->site_color_theme}}">
                                Request an Appointment</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    @endif

    <!-- nearby section starts  -->
    <section class="bg-[#F8F9FA] lg:py-[5rem] lg:px-[9%] py-[3rem] px-[2rem]" id="shops">
        <!--<h1 class="text-center mb-[2rem] relative before:content-[''] before:absolute before:left-0 before:top-2/4 before:translate-y-[-50%] before:w-[100%] before:h-[.01rem] before:bg-[rgba(0,0,0,.1)] z-[-1]"> <span class="text-[3rem] py-[.5rem] px-[2rem] text-[#344767]">nearby shops</span> </h1>-->
        <h1 class="text-center mb-[2rem] relative"><span
                class="text-[3rem] py-[.5rem] px-[2rem] text-[#344767] font-extrabold">nearby shops</span> </h1>
        <div class="swiper shops-slider">
            <div class="swiper-wrapper">
                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="{{ asset('assets/Rectify/customer-home/bluebell.jpg') }}"
                            class=" w-[7rem] rounded-[50%] object-cover" alt="">
                    </div>
                    <div class="content">
                        <h3 class="text-[2rem] text-[#344767] font-bold">Bluebell PC</h3>
                        <div class="stars">
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star-half-alt text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                        </div>
                        <div class="text-[1.3rem] text-[#344767] pb-[.5rem]">We provide the the best PC parts for your
                            computer at home!</div>
                        <div class="tags">
                            <p class="bg-[#f5f5f5] rounded-[5px] py-[2px] px-[5px] inline text-[#5f6368]">Computer Repair
                            </p>
                            <p class="bg-[#f5f5f5] rounded-[5px] py-[2px] px-[5px] inline text-[#5f6368]">Mobile Repair</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="{{ asset('assets/Rectify/customer-home/bluebell.jpg') }}"
                            class="w-[7rem] rounded-[50%] object-cover" alt="">
                    </div>
                    <div class="content">
                        <h3 class="text-[2rem] text-[#344767] font-bold">Bluebell PC</h3>
                        <div class="stars">
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star-half-alt text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                        </div>
                        <div class="text-[1.3rem] text-[#344767] pb-[.5rem]">We provide the the best PC parts for your
                            computer at home!</div>
                        <div class="tags">
                            <p class="bg-[#f5f5f5] rounded-[5px] py-[2px] px-[5px] inline text-[#5f6368]">Computer Repair
                            </p>
                            <p class="bg-[#f5f5f5] rounded-[5px] py-[2px] px-[5px] inline text-[#5f6368]">Mobile Repair</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="{{ asset('assets/Rectify/customer-home/bluebell.jpg') }}"
                            class="w-[7rem] rounded-[50%] object-cover" alt="">
                    </div>
                    <div class="content">
                        <h3 class="text-[2rem] text-[#344767] font-bold">Bluebell PC</h3>
                        <div class="stars">
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star-half-alt text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                        </div>
                        <div class="text-[1.3rem] text-[#344767] pb-[.5rem]">We provide the the best PC parts for your
                            computer at home!</div>
                        <div class="tags">
                            <p class="bg-[#f5f5f5] rounded-[5px] py-[2px] px-[5px] inline text-[#5f6368]">Computer Repair
                            </p>
                            <p class="bg-[#f5f5f5] rounded-[5px] py-[2px] px-[5px] inline text-[#5f6368]">Mobile Repair</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="{{ asset('assets/Rectify/customer-home/bluebell.jpg') }}"
                            class="w-[7rem] rounded-[50%] object-cover" alt="">
                    </div>
                    <div class="content">
                        <h3 class="text-[2rem] text-[#344767] font-bold">Bluebell PC</h3>
                        <div class="stars">
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star-half-alt text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                        </div>
                        <div class="text-[1.3rem] text-[#344767] pb-[.5rem]">We provide the the best PC parts for your
                            computer at home!</div>
                        <div class="tags">
                            <p class="bg-[#f5f5f5] rounded-[5px] py-[2px] px-[5px] inline text-[#5f6368]">Computer Repair
                            </p>
                            <p class="bg-[#f5f5f5] rounded-[5px] py-[2px] px-[5px] inline text-[#5f6368]">Mobile Repair</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="{{ asset('assets/Rectify/customer-home/bluebell.jpg') }}"
                            class="w-[7rem] rounded-[50%] object-cover" alt="">
                    </div>
                    <div class="content">
                        <h3 class="text-[2rem] text-[#344767] font-bold">Bluebell PC</h3>
                        <div class="stars">
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star-half-alt text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                        </div>
                        <div class="text-[1.3rem] text-[#344767] pb-[.5rem]">We provide the the best PC parts for your
                            computer at home!</div>
                        <div class="tags">
                            <p class="bg-[#f5f5f5] rounded-[5px] py-[2px] px-[5px] inline text-[#5f6368]">Computer Repair
                            </p>
                            <p class="bg-[#f5f5f5] rounded-[5px] py-[2px] px-[5px] inline text-[#5f6368]">Mobile Repair</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
    <!-- nearby shop section ends -->

    <!--top shop section starts-->
    <section class="bg-[#F8F9FA] lg:py-0 lg:px-[9%] px-[2rem]" id="shops">
        <h1 class="text-center mb-[2rem] relative"><span
                class="text-[3rem] py-[.5rem] px-[2rem] text-[#344767] font-extrabold"> <span>top shops</span> </h1>
        <div class="swiper shops-slider">
            <div class="swiper-wrapper">
                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="{{ asset('assets/Rectify/customer-home/bluebell.jpg') }}"
                            class="w-[7rem] rounded-[50%] object-cover" alt="">
                    </div>
                    <div class="content">
                        <h3 class="text-[2rem] text-[#344767] font-bold">Bluebell PC</h3>
                        <div class="stars">
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star-half-alt text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                        </div>
                        <div class="text-[1.3rem] text-[#344767] pb-[.5rem]">We provide the the best PC parts for your
                            computer at home!</div>
                        <div class="tags">
                            <p class="bg-[#f5f5f5] rounded-[5px] py-[2px] px-[5px] inline text-[#5f6368]">Computer Repair
                            </p>
                            <p class="bg-[#f5f5f5] rounded-[5px] py-[2px] px-[5px] inline text-[#5f6368]">Mobile Repair</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="{{ asset('assets/Rectify/customer-home/bluebell.jpg') }}"
                            class="w-[7rem] rounded-[50%] object-cover" alt="">
                    </div>
                    <div class="content">
                        <h3 class="text-[2rem] text-[#344767] font-bold">Bluebell PC</h3>
                        <div class="stars">
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star-half-alt text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                        </div>
                        <div class="text-[1.3rem] text-[#344767] pb-[.5rem]">We provide the the best PC parts for your
                            computer at home!</div>
                        <div class="tags">
                            <p class="bg-[#f5f5f5] rounded-[5px] py-[2px] px-[5px] inline text-[#5f6368]">Computer Repair
                            </p>
                            <p class="bg-[#f5f5f5] rounded-[5px] py-[2px] px-[5px] inline text-[#5f6368]">Mobile Repair</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="{{ asset('assets/Rectify/customer-home/bluebell.jpg') }}"
                            class="w-[7rem] rounded-[50%] object-cover" alt="">
                    </div>
                    <div class="content">
                        <h3 class="text-[2rem] text-[#344767] font-bold">Bluebell PC</h3>
                        <div class="stars">
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star-half-alt text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                        </div>
                        <div class="text-[1.3rem] text-[#344767] pb-[.5rem]">We provide the the best PC parts for your
                            computer at home!</div>
                        <div class="tags">
                            <p class="bg-[#f5f5f5] rounded-[5px] py-[2px] px-[5px] inline text-[#5f6368]">Computer Repair
                            </p>
                            <p class="bg-[#f5f5f5] rounded-[5px] py-[2px] px-[5px] inline text-[#5f6368]">Mobile Repair</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="{{ asset('assets/Rectify/customer-home/bluebell.jpg') }}"
                            class="w-[7rem] rounded-[50%] object-cover" alt="">
                    </div>
                    <div class="content">
                        <h3 class="text-[2rem] text-[#344767] font-bold">Bluebell PC</h3>
                        <div class="stars">
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star-half-alt text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                        </div>
                        <div class="text-[1.3rem] text-[#344767] pb-[.5rem]">We provide the the best PC parts for your
                            computer at home!</div>
                        <div class="tags">
                            <p class="bg-[#f5f5f5] rounded-[5px] py-[2px] px-[5px] inline text-[#5f6368]">Computer Repair
                            </p>
                            <p class="bg-[#f5f5f5] rounded-[5px] py-[2px] px-[5px] inline text-[#5f6368]">Mobile Repair</p>
                        </div>
                    </div>
                </a>
                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="{{ asset('assets/Rectify/customer-home/bluebell.jpg') }}"
                            class="w-[7rem] rounded-[50%] object-cover" alt="">
                    </div>
                    <div class="content">
                        <h3 class="text-[2rem] text-[#344767] font-bold">Bluebell PC</h3>
                        <div class="stars">
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                            <i class="fas fa-star-half-alt text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                        </div>
                        <div class="text-[1.3rem] text-[#344767] pb-[.5rem]">We provide the the best PC parts for your
                            computer at home!</div>
                        <div class="tags">
                            <p class="bg-[#f5f5f5] rounded-[5px] py-[2px] px-[5px] inline text-[#5f6368]">Computer Repair
                            </p>
                            <p class="bg-[#f5f5f5] rounded-[5px] py-[2px] px-[5px] inline text-[#5f6368]">Mobile Repair</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
    <!--top shop ends-->

    <!--Category section starts-->
    <section class="bg-[#F8F9FA] lg:py-[5rem] lg:px-[9%] py-[3rem] px-[2rem]">
        <h1 class="text-center mb-[2rem] relative"><span
                class="text-[3rem] py-[.5rem] px-[2rem] text-[#344767] font-extrabold">Categories</span> </h1>
        <div class="box-container flex flex-wrap gap-[1.5rem]">
            <!--box-->
            <div
                class="group box-2 flex-[1_1_30rem] text-center p-[2rem] rounded-[.5rem] overflow-hidden relative transition-all duration-[.2s] ease-linear">
                <h3 class="text-[#344767] text-[2rem] font-bold">Mobile Repair</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas accusamus tempore temporibus rem amet
                    laudantium animi optio voluptatum. </p>
            </div>
            <!--box-->
            <div
                class="group box-2 flex-[1_1_30rem] text-center p-[2rem] rounded-[.5rem] overflow-hidden relative transition-all duration-[.2s] ease-linear">
                <h3 class="text-[#344767] text-[2rem] font-bold">Computer Repair</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas accusamus tempore temporibus rem amet
                    laudantium animi optio voluptatum. </p>
            </div>
            <!--box-->
            <div
                class="group box-2 flex-[1_1_30rem] text-center p-[2rem] rounded-[.5rem] overflow-hidden relative transition-all duration-[.2s] ease-linear">
                <h3 class="text-[#344767] text-[2rem] font-bold">Data Reset and Recovery</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas accusamus tempore temporibus rem amet
                    laudantium animi optio voluptatum. </p>
            </div>
            <!--box-->
            <div
                class="group box-2 flex-[1_1_30rem] text-center p-[2rem] rounded-[.5rem] overflow-hidden relative transition-all duration-[.2s] ease-linear">
                <h3 class="text-[#344767] text-[2rem] font-bold">Customization</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas accusamus tempore temporibus rem amet
                    laudantium animi optio voluptatum. </p>
            </div>
            <!--box-->
            <div
                class="group box-2 flex-[1_1_30rem] text-center p-[2rem] rounded-[.5rem] overflow-hidden relative transition-all duration-[.2s] ease-linear">
                <h3 class="text-[#344767] text-[2rem] font-bold">Accesories Repair</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas accusamus tempore temporibus rem amet
                    laudantium animi optio voluptatum. </p>
            </div>
            <!--box-->
            <div
                class="group box-2 flex-[1_1_30rem] text-center p-[2rem] rounded-[.5rem] overflow-hidden relative transition-all duration-[.2s] ease-linear">
                <h3 class="text-[#344767] text-[2rem] font-bold">Network Repair</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas accusamus tempore temporibus rem amet
                    laudantium animi optio voluptatum. </p>
            </div>
            <!--box-->
            <div
                class="group box-2 flex-[1_1_30rem] text-center p-[2rem] rounded-[.5rem] overflow-hidden relative transition-all duration-[.2s] ease-linear">
                <h3 class="text-[#344767] text-[2rem] font-bold">Mobile Repair</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas accusamus tempore temporibus rem amet
                    laudantium animi optio voluptatum. </p>
            </div>
            <!--box-->
            <div
                class="group box-2 flex-[1_1_30rem] text-center p-[2rem] rounded-[.5rem] overflow-hidden relative transition-all duration-[.2s] ease-linear">
                <h3 class="text-[#344767] text-[2rem] font-bold">Computer Repair</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas accusamus tempore temporibus rem amet
                    laudantium animi optio voluptatum. </p>
            </div>
    </section>
    <!--category section ends-->

    <!-- product section starts  -->
    <section class="bg-[#F8F9FA] lg:py-[5rem] lg:px-[9%] py-[3rem] px-[2rem]">

        <h1 class="text-center mb-[2rem] relative"><span
                class="text-[3rem] py-[.5rem] px-[2rem] text-[#344767] font-extrabold">products</span> </h1>
        <div class="box-container flex flex-wrap gap-[1.5rem]">

            @for ($x = 0; $x < 8; $x++)
                <!--box-->
                <div
                    class="group box-2 flex-[1_1_30rem] text-center p-[2rem] rounded-[.5rem] overflow-hidden relative transition-all duration-[.2s] ease-linear">

                    <div
                        class="icons absolute top-[.5rem] right-[-6rem] group-hover:right-[2rem] transition-all duration-[0.2s] ease-linear delay-[0s]">
                        <a href="{{ route('customer.products.create') }}">
                            <i
                                class="cursor-pointer fa-solid fa-eye block h-[2rem] w-[2rem] leading-[2rem] text-[1.7rem] text-[#344767] bg-[rgba(0,0,0,.05)] rounded-[50%] mt-[.7rem] p-5">
                            </i>
                        </a>
                        <a href="#"
                            class="fa-solid fa-heart block h-[2rem] w-[2rem] leading-[2rem] text-[1.7rem] text-[#344767] bg-[rgba(0,0,0,.05)] rounded-[50%] mt-[.7rem] p-5"></a>
                        <a href="#"
                            class="fa-solid fa-cart-shopping block h-[2rem] w-[2rem] leading-[2rem] text-[1.7rem] text-[#344767] bg-[rgba(0,0,0,.05)] rounded-[50%] mt-[.7rem] p-5"></a>
                    </div>
                    <img src="{{ asset('assets/Rectify/customer-home/mouse-product.png') }}" class="h-[15rem] inline"
                        alt="">
                    <h3 class="text-[#344767] text-[2rem] font-bold">Logitech Mouse</h3>
                    <div class="stars">
                        <i class="fas fa-star py-[1rem] px-0 text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                        <i class="fas fa-star py-[1rem] px-0 text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                        <i class="fas fa-star py-[1rem] px-0 text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                        <i class="fas fa-star py-[1rem] px-0 text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                        <i class="fas fa-star-half-alt py-[1rem] px-0 text-[1.1rem] text-{{$site_settings->site_color_theme}}"></i>
                    </div>
                    <div class="price text-[1.5rem] text-[#333] py-[.5rem] px-0"> Php 100.50 <span
                            class="text-[1.1rem] text-[#999]"> 21 sold </span></div>
                    <a href="#"
                        class="btn block mt-[1rem] bg-{{$site_settings->site_color_theme}} text-[#fff] py-[.7rem] px-[3rem] text-[1.7rem] text-center cursor-pointer rounded-[.5rem]">buy
                        now</a>
                </div>
            @endfor

        </div>
    </section>
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
            });

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
            });
        });
    </script>
    @if (Auth::check())
        <script>
            $('form#appointment-form').submit((e) => {
                e.preventDefault();
                const url = '{{ route('customer.appointments.store') }}'
                const formData = new FormData(document.getElementById('appointment-form'))
                $.ajax({
                    url: url,
                    method: 'post',
                    data: formData,
                    success: (data) => {
                        console.log(data);
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });
        </script>
    @endif
@endsection
