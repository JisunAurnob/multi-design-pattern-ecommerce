@php
    $wishlists = null;
    if (auth('customer')->user()) {
        $wishlists = App\Models\Wishlist::where('customer_id', auth('customer')->user()->id)->get();
    }
@endphp
<section class="bg-[#ff6a28] hidden lg:block">
    <div class="max-w-7xl mx-auto px-2 py-3 lg:px-8">
        <div class="flex justify-between">
            <div class="flex space-x-2 text-white">
                <span class="font-bold"> Hotline: </span>
                <span> {{ $settings->phone_number }}</span>
            </div>
            <div class="flex space-x-5 text-white">
                <span class="">
                    {{ $settings->tag_line }}
                </span>
                <a href="{{ route('all.products') }}" class="underline">Shop Now </a>
            </div>
            <div>
                <ul class="flex space-x-3">
                    <li>

                        <a href="{{ $settings->facebook }}" target="_blank">
                            <svg class="bg-white h-6 p-1 rounded-full text-[#ff5880] w-6" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M14 13.5H16.5L17.5 9.5H14V7.5C14 6.47062 14 5.5 16 5.5H17.5V2.1401C17.1743 2.09685 15.943 2 14.6429 2C11.9284 2 10 3.65686 10 6.69971V9.5H7V13.5H10V22H14V13.5Z">
                                </path>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $settings->twitter }}" target="_blank">
                            <svg class="bg-white h-6 p-1 rounded-full text-[#ff5880] w-6" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path
                                    d="M459.4 151.7c.3 4.5 .3 9.1 .3 13.6 0 138.7-105.6 298.6-298.6 298.6-59.5 0-114.7-17.2-161.1-47.1 8.4 1 16.6 1.3 25.3 1.3 49.1 0 94.2-16.6 130.3-44.8-46.1-1-84.8-31.2-98.1-72.8 6.5 1 13 1.6 19.8 1.6 9.4 0 18.8-1.3 27.6-3.6-48.1-9.7-84.1-52-84.1-103v-1.3c14 7.8 30.2 12.7 47.4 13.3-28.3-18.8-46.8-51-46.8-87.4 0-19.5 5.2-37.4 14.3-53 51.7 63.7 129.3 105.3 216.4 109.8-1.6-7.8-2.6-15.9-2.6-24 0-57.8 46.8-104.9 104.9-104.9 30.2 0 57.5 12.7 76.7 33.1 23.7-4.5 46.5-13.3 66.6-25.3-7.8 24.4-24.4 44.8-46.1 57.8 21.1-2.3 41.6-8.1 60.4-16.2-14.3 20.8-32.2 39.3-52.6 54.3z" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $settings->instagram }}" target="_blank">
                            <svg class="bg-white h-6 p-1 rounded-full text-[#ff5880] w-6" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path
                                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- header for mobile menu -->
<section x-data="{ show: false }" class="bg-[#ff6a28] px-3 py-3 shadow-md w-full block md:hidden">
    <div class="flex items-center justify-between space-x-4 text-white">
        <!-- svg start here -->
        <button @click="show=!show">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
        <!-- svg end here -->
        <div x-show="show" class="absolute  bg-white left-[-15px] px-5 py-5 shadow-md top-[63px] w-full z-50"
            style="display: none">
            {{-- @if (Auth::guard('customer')->user())
                <img src="{{Auth::guard('customer')->user()->image ?? null}}" class="h-12 w-12" alt="">
            @endif --}}
            <div class=" overflow-hidden mb-4">
                <a href="{{ route('home') }}" class="">
                    <span class="sr-only">Your Company</span>
                    <img class="w-[5.3rem] h-[2.5rem]" src="{{ $settings->logo }}" alt="" />
                </a>
            </div>
            <ul>
                <li>
                    <a class="flex py-2 space-x-4 text-gray-700" href="{{ route('home') }}">
                        <span> Home </span>
                    </a>
                </li>
                <li class="text-gray-700 dropdownn my-2">
                    <div class="flex justify-between ">
                        <span class="w-fit"> Categories </span>
                        <span class="w-fit">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                class='w-3 fill-black mt-1 catSvg transition duration-300'>
                                <path
                                    d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
                            </svg>
                        </span>
                    </div>

                    <ul class="ml-[-1rem] hidden dropdownnm">
                        @include('frontend.components.mobile_categories', [
                            'categories' => $categories,
                        ])
                    </ul>
                </li>
                <li>
                    <a class="flex py-2 space-x-4 text-gray-700" href="{{ route('all.products') }}">
                        <span> All Products </span>
                    </a>
                </li>

                @if (Auth::guard('customer')->user())
                    <li>
                        <a class="flex py-2 space-x-4 text-gray-700" href="{{ route('wishlist') }}">
                            <span> Wishlist </span>
                        </a>
                    </li>

                    {{-- <li>
                    <a class="flex py-2 space-x-4 text-gray-700" href="{{route('profile')}}">
                        <span> Dashboard </span>
                    </a>
                </li> --}}
                    <li>
                        <a class="flex py-2 space-x-4 text-gray-700" href="{{ route('profile') }}">
                            <span> Profile </span>
                        </a>
                    </li>

                    <li>
                        <a class="flex py-2 space-x-4 text-gray-700" href="">
                            <span>My Orders </span>
                        </a>
                    </li>
                @endif


                @if (Auth::guard('customer')->user())
                    <li>
                        <a class="flex py-2 space-x-4 text-gray-700" href="{{ route('user.logout') }}">
                            <span> Logout </span>
                        </a>
                    </li>
                @else
                    <li>
                        <a class="flex py-2 space-x-4 text-gray-700" href="{{ route('user.login') }}">
                            <span> Login </span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- details start here -->

        {{-- <div class="relative flex items-center">
            <input type="text" placeholder="Search" value=""
                class="bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 px-10 py-2 rounded shadow-lg w-full" />
            <button class="absolute right-0 mr-2 text-white rounded-full h-6 w-6 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    class="rounded text-gray-700">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
        </div> --}}
        <div class="flex items-center">
            <div class="flex justify-center ml-4">
                <div class="xl:w-[585px] relative">
                    <div class="flex flex-wrap items-stretch relative w-full">
                        <input type="search"
                            class="search_input bg-clip-padding bg-white block border-2 border-white dark:placeholder:text-neutral-200 dark:text-neutral-200 duration-300 ease-in-out flex-auto focus:border-primary focus:outline-none focus:shadow-te-primary focus:text-neutral-700 font-normal m-0 min-w-0 outline-none px-3 py-1.5 relative rounded-l text-base text-neutral-700 transition w-[1%]"
                            placeholder="Search" aria-label="Search" aria-describedby="button-addon1" />
                        <button
                            class="active:shadow-lg mobileSearch bg-[#ff6a28] border border-white duration-150 ease-in-out flex focus:bg-primary-700 focus:outline-none focus:ring-0 focus:shadow-lg font-medium hover:bg-primary-700 hover:shadow-lg items-center leading-tight px-6 py-2.5 relative rounded-r shadow-md text-white text-xs transition uppercase z-[2]"
                            type="button" id="button-addon1" data-te-ripple-init="" data-te-ripple-color="light">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="h-5 w-5">
                                <path fill-rule="evenodd"
                                    d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    {{-- Search result start --}}
                    <div class="absolute w-full bg-white z-50 hidden">
                        <div class="min-h-[4rem] max-h-[12rem] overflow-y-scroll search_result text-black">
                            {{-- <a href="/product/view/oscar-whitney"
                                class="flex items-center border-1 mb-2 py-2 border border-zinc-200 hover:bg-slate-100">
                                <div class="w-[20%] ps-4">
                                    <img src="/uploads/products/2024030612285128.jpg" class="h-16 w-auto"
                                        width="" />
                                </div>
                                <div class="w-[80%] ps-4">
                                    <h5 class="line-clamp-1 font-bold" title="Product name">Product name</h5>
                                    <p class="text-gray-600" title="5200$">5200$</p>
                                </div>
                            </a> --}}
                        </div>
                    </div>
                    {{-- Search result end --}}
                </div>
            </div>
        </div>

        <!-- svg end here -->
        <div>
            <div class="relative">
                <a href="{{ route('cart') }}"><span></span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z">
                        </path>
                    </svg> </a>
                @php
                    $cart = session()->has('cart') ? session()->get('cart') : [];
                    $cartCount = count($cart);
                @endphp
                <span
                    class="-right-2 -top-2 absolute bg-[#ff5880] flex font-bold h-[18px] items-center justify-center rounded-full text-[9px] text-white w-[18px] cartCount">
                    {{ $cartCount }}
                </span>

            </div>
        </div>
    </div>
</section>
<!-- header for mobile menu end -->
<!-- second header -->
<section class="hidden md:block shadow-md">
    <div class="max-w-7xl mx-auto px-2 py-2 lg:px-8  relative z-10">
        <div class="flex items-center justify-between">
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="-m-1.5 p-1.5">
                    <span class="sr-only">Your Company</span>
                    <img class="h-auto w-full" src="{{ $settings->logo }}" alt="" />
                </a>
            </div>

            <div class="flex items-center">
                <div class="flex justify-center ml-4">
                    <div class="xl:w-[585px] relative">
                        <div class="flex flex-wrap items-stretch relative w-full">
                            <input id="search_input" type="search"
                                class="search_input bg-clip-padding bg-transparent block border-2 border-[#ff6a28] dark:placeholder:text-neutral-200 dark:text-neutral-200 duration-300 ease-in-out flex-auto focus:border-primary focus:outline-none focus:shadow-te-primary focus:text-neutral-700 font-normal m-0 min-w-0 outline-none px-3 py-1.5 relative rounded-l text-base text-neutral-700 transition w-[1%]"
                                placeholder="Search" aria-label="Search" aria-describedby="button-addon1" />
                            <button
                                class="active:shadow-lg bg-[#ff6a28] duration-150 ease-in-out flex focus:bg-primary-700 focus:outline-none focus:ring-0 focus:shadow-lg font-medium hover:bg-primary-700 hover:shadow-lg items-center leading-tight px-6 py-2.5 relative rounded-r shadow-md text-white text-xs transition uppercase z-[2]"
                                type="button" id="button-addon1" data-te-ripple-init=""
                                data-te-ripple-color="light">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="h-5 w-5">
                                    <path fill-rule="evenodd"
                                        d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        {{-- Search result start --}}
                        <div class="absolute w-full bg-white z-10 hidden">
                            <div class="min-h-[4rem] max-h-[12rem] overflow-y-scroll z-50 search_result">
                                {{-- <a href="/product/view/oscar-whitney"
                                    class="flex items-center border-1 mb-2 py-2 border border-zinc-200 hover:bg-slate-100">
                                    <div class="w-[20%] ps-4">
                                        <img src="/uploads/products/2024030612285128.jpg" class="h-16 w-auto"
                                            width="" />
                                    </div>
                                    <div class="w-[80%] ps-4">
                                        <h5 class="line-clamp-1 font-bold" title="Product name">Product name</h5>
                                        <p class="text-gray-600" title="5200$">5200$</p>
                                    </div>
                                </a> --}}
                            </div>
                        </div>
                        {{-- Search result end --}}
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-6">
                <div class="relative">
                    <a href="{{ route('cart') }}"><span></span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z">
                            </path>
                        </svg> </a>

                    @php
                        $cart = session()->has('cart') ? session()->get('cart') : [];
                        $cartCount = count($cart);
                    @endphp
                    <span
                        class="-right-2.5 absolute bg-[#ff5880] flex font-bold h-[18px] items-center justify-center rounded-full text-[10px] text-white w-[18px] cartCount">
                        {{ $cartCount }}


                    </span>
                </div>
                <div class="relative">
                    <a href="{{ route('wishlist') }}"><span><svg width="20" height="18" class="mt-[3px]" viewBox="0 0 21 18"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4.97214 0.0251923C3.71435 0.183434 2.6616 0.701674 1.7705 1.60365C0.970091 2.41068 0.489057 3.26519 0.213053 4.37683C-0.275867 6.30342 0.0789948 8.20232 1.25398 9.98649C2.00708 11.1298 2.98097 12.1781 4.76711 13.7764C5.90266 14.7931 9.36848 17.7601 9.53802 17.859C9.69574 17.954 9.75488 17.9658 10.09 17.9658C10.4252 17.9658 10.4843 17.954 10.642 17.859C10.8116 17.7601 14.2853 14.7891 15.413 13.7764C17.207 12.1702 18.173 11.1258 18.9261 9.98649C20.1011 8.20232 20.4559 6.30342 19.967 4.37683C19.691 3.26519 19.21 2.41068 18.4096 1.60365C17.6131 0.800575 16.7614 0.337719 15.6456 0.100357C15.0857 -0.0183239 14.0526 -0.0301933 13.5637 0.0805759C12.1995 0.377279 11.1546 1.06167 10.2004 2.28013L10.09 2.41859L9.98357 2.28013C9.04122 1.08541 8.01212 0.401016 6.69913 0.100357C6.30878 0.00936699 5.4098 -0.0301933 4.97214 0.0251923ZM6.28907 1.23178C7.40885 1.42958 8.37487 2.07837 9.13979 3.15046C9.26991 3.3364 9.43156 3.55793 9.49465 3.64892C9.78643 4.06035 10.3936 4.06035 10.6854 3.64892C10.7485 3.55793 10.9102 3.3364 11.0403 3.15046C12.0851 1.68673 13.5401 0.998377 15.1251 1.21596C16.8837 1.45728 18.2558 2.69156 18.7802 4.50738C19.1942 5.94342 19.0128 7.45067 18.2597 8.80759C17.6289 9.94298 16.5761 11.1337 14.7427 12.7834C13.8555 13.5786 10.1255 16.7988 10.09 16.7988C10.0506 16.7988 6.33638 13.5904 5.4374 12.7834C2.61823 10.2476 1.50633 8.66518 1.23821 6.8098C1.06472 5.61112 1.31312 4.32145 1.91639 3.30475C2.82326 1.77376 4.58968 0.935081 6.28907 1.23178Z"
                                    fill="black"></path>
                            </svg></span></a><span
                        class="-right-2.5 -top-2.5 absolute bg-[#ff5880] flex font-bold h-[18px] items-center justify-center rounded-full text-[10px] text-white w-[18px]">
                        @if (isset($wishlists))
                            {{ count($wishlists) }}
                        @else
                            0
                        @endif
                    </span>
                </div>
                <!-- <div>
                    <a href="{{ route('user.login') }}"><span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-7 h-7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </span></a>
                </div> -->
                <!-- dropdown menu start -->

                @if (Auth::guard('customer')->user())
                    <div class="dropdown inline-block relative">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        @auth('customer')
                            <ul
                                class="user-dropdn dropdown-menu absolute hidden w-44 transition duration-300 left-[-90px] bg-white shadow-md text-gray-700 pt-1">
                                <li class=""><a
                                        class="transition duration-300 rounded-t hover:bg-[#ff6a28] hover:text-white py-2 px-4 block whitespace-no-wrap"
                                        href="{{ route('profile') }}">{{ auth('customer')->user()->name }}</a>
                                </li>
                                <li class=""><a
                                        class="transition duration-300 rounded-t hover:bg-[#ff6a28] hover:text-white py-2 px-4 block whitespace-no-wrap"
                                        href="{{ route('user.update.password.form') }}">Update Password</a>
                                </li>
                                <li class=""><a
                                        class="transition duration-300 rounded-t hover:bg-[#ff6a28] hover:text-white py-2 px-4 block whitespace-no-wrap"
                                        href="{{ route('user.logout') }}">Logout</a>
                                </li>

                            </ul>
                        @endauth
                    </div>
                @endif

                <!-- dropdown menu end -->
            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        $(document).ready(function() {
            $(document).on("keyup", '.search_input', function() {
                var searchInput = $(this).val();
                if (searchInput?.length == 0) {
                    $('.search_result').parent().addClass('hidden');
                } else {
                    $('.search_result').parent().removeClass('hidden');
                    var url = "{{ route('search') }}";
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'get',
                        url: url,
                        data: {
                            query: searchInput
                        },
                        success: function(response) {
                            console.log(response);
                            if (response?.success) {
                                let html = ``;
                                if (response?.data?.data?.length > 0) {
                                    $.each(response?.data?.data, function(index, product) {
                                        html += `<a href="/product/view/${product?.slug}"
                                    class="flex items-center border-1 mb-2 py-2 border border-zinc-200 hover:bg-slate-100">
                                    <div class="w-[20%] ps-4">
                                        <img src="${product?.image}" class="h-16 w-auto" alt="${product?.slug}" />
                                    </div>
                                    <div class="w-[80%] ps-4">
                                        <h5 class="line-clamp-1 font-bold" title="${product?.name}">${product?.name}</h5>
                                        <p class="text-gray-600" title="৳ ${product?.price}">৳ ${product?.price}</p>
                                    </div>
                                </a>`;
                                    });
                                    $('.search_result').html(html);
                                    console.log(`${response?.data?.data?.length} product`);
                                } else {
                                    console.log('zero product');
                                    $('.search_result').html(
                                        `<h6 class="font-bold text-red text-center my-4">No Products Found!</h6>`
                                    );
                                }
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr);
                            alert('Something went wrong')
                        }
                    });

                }
            });

            $(document).on("click", function(event) {
                // Get the parent element of #search_result
                var parentElement = $('.search_result').parent();

                // Check if the clicked element is not a descendant of the parent element
                if (!$(event.target).closest(parentElement).length) {
                    // Add the class to the parent element
                    parentElement.addClass('hidden');
                }
                // else{
                //   parentElement.removeClass('hidden');
                // }
            });

            // $(document).on("click", '#search_input', function(event) {
            //     $('#search_result').parent().removeClass('hidden');
            // });
        });
    </script>
@endpush
