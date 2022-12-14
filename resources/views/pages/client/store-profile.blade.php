@extends('layouts.customer')

@section('title')
    <title>{{ Str::title(config('app.name')) }} - Shop Details</title>
@endsection

@section('content')
    <section class="bg-[#F8F9FA] lg:pt-[5rem] lg:px-[9%] py-[3rem] px-[2rem]">
        <h1 class="text-center mb-[4rem] relative"><span
                class="text-[3rem] pt-[.5rem] pb-[1rem] px-[2rem] text-[#344767] font-extrabold"> <span>Shop Details</span>
        </h1>

        <div class="flex justify-between items-center pb-4 dark:bg-gray-900">

            <div class="relative">
                <h3 class="text-[1.5rem] font-bold text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">Account
                    Information</h3>
            </div>

            <div>
                <button id="edit-profile"
                    class="inline-flex items-center font-bold text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 rounded-lg text-[1.3rem] px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                    type="button">


                    <i class="fa-solid fa-pen mr-3 w-5 h-5 mb-1"></i>
                    Edit
                </button>

            </div>

        </div>


        <form>
            <div class="grid gap-6 mb-6 md:grid-cols-2 md:grid-flow-col md:grid-rows-5">
                <div class="row-span-5">
                    <img src="{{ asset('assets/Rectify/customer-home/1by1.png') }}" alt="profile"
                        class="mx-auto mt-9 rounded-full w-[20rem] ">

                    <p class="text-gray-800 text-[2rem] font-bold mt-4 text-center">{{ $full_name }}</p>
                    <p class="text-gray-500 text-[1.5rem] lowercase text-center">{{ Auth::user()->email }}</p>
                </div>
                <div>
                    <label for="first_name"
                        class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">First name</label>
                    <input type="text" id="first_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-[1.3rem] rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Juan" required="">
                </div>
                <div>
                    <label for="last_name"
                        class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Last name</label>
                    <input type="text" id="last_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-[1.3rem] rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Dela Cruz" required="">
                </div>
                <div>
                    <label for="contact"
                        class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Contact Number</label>
                    <input type="tel" id="contact"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-[1.3rem] rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="0912-345-678" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" required="">
                </div>
                <div>
                    <label for="birthday"
                        class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Birthday</label>
                    <input type="date" id="birthday"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-[1.3rem] rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required="">
                </div>
                <div>
                    <label for="address"
                        class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Address</label>
                    <input type="text" id="address"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-[1.3rem] rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Meycauayan City, Bulacan" required="">
                </div>

            </div>
            <div class="flex justify-between items-center pb-4 dark:bg-gray-900">

                <div class="relative">
                    <h3 class="text-[1.5rem] font-bold text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">Account
                        Security</h3>
                </div>

                <div>
                    <button id="edit-profile"
                        class="inline-flex items-center font-bold text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 rounded-lg text-[1.3rem] px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                        type="button">


                        <i class="fa-solid fa-pen mr-3 w-5 h-5 mb-1"></i>
                        Edit
                    </button>

                </div>

            </div>
            <div class="mb-6">
                <label for="email" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Email
                    Address</label>
                <input type="email" id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-[1.3rem] rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="aveb.rectify.com" required="">
            </div>
            <div class="mb-6">
                <label for="password"
                    class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Password</label>
                <input type="password" id="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-[1.3rem] rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="•••••••••" required="">
            </div>


            <button type="submit"
                class="text-white button-shade font-medium rounded-lg text-[1.3rem] w-full sm:w-auto px-5 py-2.5 text-center">Save
                Changes</button>
        </form>


    </section>









    <section class="bg-[#F8F9FA] lg:pt-[5rem] lg:px-[9%] py-[3rem] px-[2rem]">
        <h1 class="text-center mb-[4rem] relative"><span
                class="text-[3rem] pt-[.5rem] pb-[1rem] px-[2rem] text-[#344767] font-extrabold"> <span>Sample</span> </h1>

        <form id="appointment-form" autocomplete="off" action="{{ route('customer.appointments.store') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <div class="grid gap-6 mb-6 md:grid-cols-3 grid-flow-col md:grid-rows-6">
                {{-- column 1 --}}
                <h4 class="mb-4 text-[1.5rem] font-bold text-[#5F6368] dark:text-white">Contact Information</h4>

                <div>
                    <label for="firstName" class="block mb-2 text-[1.3rem] font-medium text-gray-900">First Name</label>
                    <input type="text" name="firstName" value="{{ $firstName }}" readonly id="firstName"
                        class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}} block w-full p-2.5 "
                        placeholder="Juan" required>
                </div>

                <div>
                    <label for="lastName" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Last
                        Name</label>
                    <input type="text" name="lastName" id="lastName" value="{{ $lastName }}" readonly
                        class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="Dela Cruz" required>
                </div>

                <div>
                    <label for="email"
                        class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ $email }}" readonly
                        class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="rectify@gmail.com" required>
                </div>

                <div>
                    <label for="contact"
                        class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Contact
                        Number</label>
                    <input type="text" name="contact" id="contact" value="{{ $contact }}" readonly
                        class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="09912345678" required>
                </div>

                <div>
                    <label for="alt_contact"
                        class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Alternative Contact
                        Number</label>
                    <input type="text" name="alt_contact" id="alt_contact"
                        class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        placeholder="09997778888">
                </div>

                {{-- column 2 --}}

                <h4 class="mb-4 text-[1.5rem] font-bold text-[#5F6368] dark:text-white">Product Information</h4>
                <div>
                    <label for="category"
                        class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-400">Category</label>
                    <select id="category" name="category"
                        class="block p-3 mb-6 w-full
                                text-gray-900 bg-[#F2F2F2] rounded-lg border-none focus:ring-{{$site_settings->site_color_theme}}
                                focus:ring-1 focus:outline-none font-medium text-[1.3rem] items-center">
                        <option selected disabled value="">Select Category</option>
                        <option value="Mobile Phone">Mobile Phone</option>
                        <option value="Computer">Computer</option>
                        <option value="Consoles">Consoles</option>
                        <option value="IoT">IoT</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div>
                    <label for="product_brand" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Product Brand</label>
                    <input type="text" name="product_brand" id="product_brand" value="{{old('product_brand')}}" class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Samsung" required>
                </div>
                <div>
                    <label for="model_name" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Model Name</label>
                    <input type="text" name="model_name" id="model_name" value="{{old('model_name')}}" class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Galaxy S20 Ultra" required>
                </div>
                <div>
                    <label for="model_num" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Model Number</label>
                    <input type="text" name="model_num" id="model_num" value="{{old('model_num')}}" class="bg-[#F2F2F2] border-none text-gray-900 text-[1.3rem] rounded-lg focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}} block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="SM-G988">
                </div>

                <h4 class="mb-4 text-[1.5rem] font-bold text-[#5F6368] dark:text-white">Time and Date</h4>

                <div class="relative">
                    <label for="date" class="block mb-2 text-[1.3rem] font-medium text-gray-900 dark:text-gray-300">Date</label>
                        <span id="date_error" class="hidden text-red-600"></span>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input datepicker datepicker-autohide datepicker-buttons
                        id="date" name="date" type="text"
                        class="bg-[#F2F2F2] border-none text-gray-900
                        sm:text-sm md:text-base xl:text-[1.4rem] rounded-lg
                        focus:ring-{{$site_settings->site_color_theme}} focus:border-{{$site_settings->site_color_theme}}
                        block w-full pl-10 p-2.5 py-auto
                        dark:bg-gray-600 dark:border-gray-500
                        dark:placeholder-gray-400 dark:text-white
                        dark:focus:ring-{{$site_settings->site_color_theme}} dark:focus:border-{{$site_settings->site_color_theme}}"
                        placeholder="Select date">
                    </div>

                </div>



            </div>



            <div class="flex items-start mb-6">
                <div class="flex items-center h-5">
                    <input id="remember" type="checkbox" value=""
                        class="w-5 h-5 bg-gray-50 rounded border border-gray-300 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                        required="">
                </div>
                <label for="remember"
                    class="ml-2 text-[1.3rem] leading-[1.5rem] font-medium text-gray-900 dark:text-gray-400">I agree with
                    the
                    <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">terms and
                        conditions</a>.</label>
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-[1.3rem] w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>







<div class="block space-y-4 md:flex md:space-y-0 md:space-x-4">
    <!-- Modal toggle -->

    <button class="block w-full md:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" data-modal-toggle="extralarge-modal">
    Extra large modal
    </button>
</div>


<!-- Extra Large Modal -->
<div id="extralarge-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center" aria-hidden="true">
    <div class="relative p-4 w-full max-w-7xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex justify-between items-center p-5 rounded-t border-b dark:border-gray-600">
                <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                    Extra Large modal
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="extralarge-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                </p>
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
                </p>
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                </p>
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
                </p>
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                </p>
                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                    The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is meant to ensure a common set of data rights in the European Union. It requires organizations to notify users as soon as possible of high-risk data breaches that could personally affect them.
                </p>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                <button data-modal-toggle="extralarge-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                <button data-modal-toggle="extralarge-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
            </div>
        </div>
    </div>
</div>










    </section>




    <script>
        // do your custom scripts here
    </script>
@endsection
