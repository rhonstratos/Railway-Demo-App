<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.heads')
    <title>@yield('title')</title>
</head>

<body class="overflow-auto">

    <header class="grid grid-cols-1 grid-rows-1 py-5">
        <div class="m-auto text-center xl:ml-10 xl:mt-5 xl:text-start">
            @php
				$shop = \App\Models\Shop::firstOrFail();
				$_site_icon = !is_null($site_settings->site_icon) ? asset('storage/master/assets/' . $site_settings->site_icon) : asset('assets/Rectify/icons/rectify-dark-blue.svg');
			@endphp
			<a href="/">
				<img src="{{ $_site_icon }}" alt="">
			</a>
        </div>
    </header>

    <div class="grid h-[80vh] m-auto p-auto w-full text-[#344767] xl:place-content-center">

        <div class="grid gap-0 xl:grid-cols-2 xl:grid-rows-1 grid-cols-1
        grid-rows-2 m-0 p-0
        {{-- justify-center justify-items-center content-center items-center align-items --}}
        xl:place-items-center
        md:place-items-start">

            <div
                class="
            m-auto p-auto mt-5 xl:place-self-center
            xl:m-auto xl:py-auto xl:pl-40
            xl:order-first xl:text-start
            order-last text-center">
                <div class="">
                    <div class="hidden xl:grid text-[70px] font-bold">
                        {{ __('Error') }} @yield('code')<br>
                    </div>
                    <div class=" xl:mt-[-20px] text-[30px] font-bold ">
                        @yield('message')<br>
                    </div>
                    <div class="text-[14px] md:text-[22px]">
                        @yield('full_message')
                    </div>
                </div>
            </div>

            <div
                class="
            m-auto p-auto mt-10 xl:mt-0 place-self-center
            xl:place-self-start
            xl:py-auto
            xl:order-last order-first">
                <div class="m-auto p-auto">
                    <img class="w-4/6 xl:w-5/6 mx-auto xl:m-0" @yield('image')>
                </div>
            </div>

        </div>

    </div>
</body>

</html>
