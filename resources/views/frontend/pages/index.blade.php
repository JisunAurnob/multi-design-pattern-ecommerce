@extends('frontend.master')
@section('content')
    <section class="bg-[#F7FAFC]">

        <div class="max-w-7xl mx-auto lg:px-8">
            <div class="md:flex">
                <div class="displaycatMain  flex flex-col items-center hidden lg:block">
                    <button class="bg-[#ff6a28] flex h-12 items-center px-2 space-x-2 text-white w-64">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                            fill="currentColor" class="">
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path d="M3 4h18v2H3V4zm0 7h18v2H3v-2zm0 7h18v2H3v-2z"></path>
                        </svg>
                        <span class="text-lg uppercase pr-10">All Categories</span>
                    </button>

                    <ul class="bg-white capitalize h-[413px] mt-[19px] text-[14px] my-3 py-2 rounded-l shadow-md space-y-3 w-64 ">
                        @include('frontend.components.all_categories', [
                            'categories' => $categories,
                        ])
                    </ul>

                    {{-- </ul> --}}

                    <!-- <img
                                    class="block lg:hidden h-8 w-auto"
                                    src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg"
                                    alt="Workflow"
                                  />
                                  <img
                                    class="hidden lg:block h-8 w-auto"
                                    src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg"
                                    alt="Workflow"
                                  /> -->
                </div>

                <!-- right side start -->
                <div class="flex-col overflow-hidden w-full">

                    @include('frontend.components.menu')

                    <div class="banner-slider">
                        @foreach ($sliders as $data)
                            <div class="container md:h-[415px] h-[250px] relative text-white w-full rounded-lg sliderHome"
                                style="
                    background-image: url('{{ $data->image }}');
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-position: center;
                    margin-top: 3px;
                  ">
                                <!-- <div class="absolute bottom-0 h-full left-0 w-full z-10 bg-gray-800 opacity-75"></div>
                                            <div
                                                class="container flex h-full items-center justify-center lg:justify-start md:pl-24 relative z-10">
                                                <div class="text-white transform">
                                                    <h1 class="capitalize font-medium mb-5 md:text-4xl text-3xl tracking-tight">
                                                        New Arrivals<span class="block"> Big Sale</span>
                                                    </h1>
                                                    <button class="bg-[#ff6a28] font-semibold px-4 py-2">Shop Now</button>
                                                </div>
                                            </div> -->
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- right side end -->
            </div>
        </div>
    </section>
    <!-- category section -->
    <section class="bg-[#F7FAFC]">
        <div class="lg:px-8 sm:px-8 max-w-7xl py-10 container mx-auto px-2 catCategory">
            <!-- heading icon -->
            <div class="border-b border-gray-500 mb-5 mx-auto relative w-32">
                <img class="absolute bg-[#F3FFFF] border border-gray-500 bottom-[-22px] h-10 left-0 m-auto p-1.5 right-0 rounded-full w-10"
                    src="https://framerusercontent.com/images/10cmMGoAUy5r6d21EqNpNu3jgRI.png" alt="" />
            </div>
            <h1
                class="antialiased capitalize font-bold mb-5 md:text-2xl text-xl text-center text-deep-sapphire-600 tracking-wide">
                Category
            </h1>
            <div class="gap-2 grid grid-cols-2 lg:grid-cols-5 md:gap-16 md:grid-cols-3 ">
                @foreach ($categories as $category)
                    <a href="{{ route('category.wise.product', $category->slug) }}">
                        <div
                            class="catCategoryMobile overflow-hidden border border-gray-300 bg-white p-3 rounded shadow-md transition duration-300 ease-in-out hover:opacity-70">
                            <div class="flex justify-center cursor-pointer">
                                <img loading="lazy" class="bg-white catCategoryMobileimg h-16 md:h-32 object-cover rounded"
                                    src="{{ url($category->image) }}" alt="women" />
                            </div>
                            <div class="text-center mt-5 md:mt-10 catCategoryName">
                                <h2 class="font-semibold whitespace-nowrap tracking-wider">{{ $category->name }}</h2>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- product section -->
    <section class="bg-[#F3FFFF]">
        <div class="lg:px-8 sm:px-8 py-10  max-w-7xl mx-auto px-2 homeProduct">
            <!-- heading icon -->
            <div class="border-b border-gray-500 mb-5 mx-auto relative w-32">
                <img class="absolute bg-[#F3FFFF] border border-gray-500 bottom-[-22px] h-10 left-0 m-auto p-1.5 right-0 rounded-full w-10"
                    src="{{ url('/frontend/image/icon2.webp') }}" alt="" />
            </div>
            <h1
                class="antialiased capitalize font-bold mb-5 md:text-2xl text-xl text-center text-deep-sapphire-600 tracking-wide">
                products
            </h1>

            <div class="md:gap-6 gap-3 grid grid-cols-2 lg:grid-cols-4 md:grid-cols-3 md:pb-6">
                {{-- @foreach ($products as $product) --}}
                @foreach ($products->take(10) as $product)
                    @include('frontend.components.product-card', ['product' => $product])
                @endforeach
            </div>

        </div>

    </section>

    <!-- new arrivals -->
    <section class="bg-[#F7FAFC]">
        <div class="lg:px-8 sm:px-8 py-10 max-w-7xl mx-auto px-2">
            <!-- heading icon -->
            <div class="border-b border-gray-500 mb-5 mx-auto relative w-32">
                <img class="absolute bg-[#F3FFFF] border border-gray-500 bottom-[-22px] h-10 left-0 m-auto p-1.5 right-0 rounded-full w-10"
                    src="{{ url('/frontend/image/icon3.webp') }}" alt="" />
            </div>
            <h1
                class="antialiased capitalize font-bold mb-5 md:text-2xl text-xl text-center text-deep-sapphire-600 tracking-wide">
                New arrivals
            </h1>

            <div class="lg:flex lg:space-x-3 newarrivals">
                <article
                    class="hidden lg:block md:w-3/12 block duration-300 hover:scale-105 hover:shadow-xl hover:transform rounded-md shadow-lg newarrivalpromo">
                    <img src="{{ url('/placeholder/poster/p1.jpeg') }}" alt=""
                        class=" object-fill w-full h-full w-full" />
                </article>
                <div class="lg:w-9/12 w-full">
                    <div class="slider">
                        @foreach ($products->reverse()->take(8) as $product)
                            @include('frontend.components.product-card', ['product' => $product])
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sale offer -->
    <!-- <section class="bg-[{{ url('/frontend/image/saleoffer.png') }}]">
                        <div class="container lg:px-8 py-10 mx-auto px-2">
                           
                            <div class="border-b border-gray-500 mb-5 mx-auto relative w-32">
                                <img class="absolute bg-[#F3FFFF] border border-gray-500 bottom-[-22px] h-10 left-0 m-auto p-1.5 right-0 rounded-full w-10"
                                    src="{{ url('/frontend/image/icon4.webp') }}" alt="" />
                            </div>
                            <h1
                                class="antialiased capitalize font-bold mb-5 md:text-2xl text-xl text-center text-deep-sapphire-600 tracking-wide">
                                Sale offer
                            </h1>

                            <div class="md:gap-6 gap-3 grid grid-cols-2 lg:grid-cols-4 md:grid-cols-3">
                                <article class="duration-300 hover:scale-105 hover:shadow-xl hover:transform rounded-md shadow-lg">
                                    <img src="{{ url('/placeholder/poster/p2.jpeg') }}" alt=""
                                        class=" h-52 md:h-[332px] lg:h-[373px] w-full" />
                                </article>
                                <article class="duration-300 hover:scale-105 hover:shadow-xl hover:transform rounded-md shadow-lg">
                                    <img src="{{ url('/placeholder/poster/p3.jpeg') }}" alt=""
                                        class=" h-52 md:h-[332px] lg:h-[373px] w-full" />
                                </article>
                                <article class="duration-300 hover:scale-105 hover:shadow-xl hover:transform rounded-md shadow-lg">
                                    <img src="{{ url('/placeholder/poster/p4.jpeg') }}" alt=""
                                        class=" h-52 md:h-[332px] lg:h-[373px] w-full" />
                                </article>
                                <article class="duration-300 hover:scale-105 hover:shadow-xl hover:transform rounded-md shadow-lg">
                                    <img src="{{ url('/placeholder/poster/p5.avif') }}" alt=""
                                        class=" h-52 md:h-[332px] lg:h-[373px] w-full" />
                                </article>
                            </div>
                        </div>
                    </section> -->
@endsection
