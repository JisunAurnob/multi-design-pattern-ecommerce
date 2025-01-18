@extends('frontend.master')
@section('content')
    <!-- menu section    -->

    <!-- banner section -->
    <!-- product detail -->
    <main class="max-w-7xl mx-auto py-10 px-2 lg:px-5">
        <!-- Product -->
        <div class="grid md:gap-5 gap-3 lg:grid-cols-2 xl:grid-cols-2 md:grid-cols-2  lg:gap-x-8 lg:items-start">
            <!-- Image gallery -->
            <div class="flex flex-col" x-data="Components.tabs()" @tab-click.window="onTabClick"
                @tab-keydown.window="onTabKeydown">
                <div class="w-full aspect-w-1 aspect-h-1">
                    <div class="lg:h-[600px] h-[400px]">
                        <img src="{{ $product->image }}" alt="Angled front view with bag zipped and handles upright."
                            class="w-full h-full object-center object-fill sm:rounded-lg" id="main_image" />
                    </div>
                </div>
                <!-- Image selector -->
                <div class="hidden mt-6 w-full max-w-2xl mx-auto sm:block lg:max-w-none">
                    <div class="grid grid-cols-4 gap-6" aria-orientation="horizontal" role="tablist">
                        @foreach ($product->productImages as $img)
                            <button
                                class="relative h-24 bg-white rounded-md flex items-center justify-center text-sm font-medium uppercase text-gray-900 cursor-pointer hover:bg-gray-50 focus:outline-none focus:ring focus:ring-offset-4 focus:ring-opacity-50">
                                <span class="sr-only"> Angled view </span>
                                <span class="absolute inset-0 rounded-md overflow-hidden">
                                    <img src="{{ $img->image }}" alt=""
                                        class="w-full h-full object-center object-cover multiple_image" />
                                </span>
                                <span
                                    class="absolute inset-0 rounded-md ring-2 ring-offset-2 pointer-events-none ring-indigo-500"
                                    aria-hidden="true" x-state:on="Selected" x-state:off="Not Selected"
                                    :class="{ 'ring-indigo-500': selected, 'ring-transparent': !(selected) }"></span>
                            </button>
                        @endforeach

                    </div>
                </div>


            </div>

            <!-- Product info -->
            <div>
                <h1 class="md:text-3xl text-xl font-extrabold tracking-tight text-gray-900">
                    {{ $product->name }}
                </h1>

                <div class="mt-3">
                    <h2 class="sr-only">Product information</h2>
                    <div class="text-base text-gray-700 space-y-6 mb-4">
                        <p>
                            {!! $product->short_description !!}
                        </p>
                    </div>
                    <div class="">
                        @if ((int) $product->discount['amount'] > 0)
                            <span class="flex items-center text-violet-800 text-base">{{ $product->discount['percentage'] }}
                                Off</span>
                            <span class="flex items-center text-gray-400 line-through ">BDT. {{ $product->price }}</span>
                        @endif
                        <p class="md:text-3xl font-bold text-gray-900">BDT.
                            {{ $product->price - $product->discount['amount'] }}</p>
                    </div>

                </div>

                <!-- Reviews -->
                <div class="mt-3">
                    <h3 class="sr-only">Reviews</h3>
                    <div class="flex items-center">
                        <div class="flex items-center">
                            @for ($i = 0; $i < $product->rate; $i++)
                                <svg class="h-5 w-5 flex-shrink-0 text-indigo-500" x-state:on="Active"
                                    x-state:off="Inactive"
                                    x-state-description='Active: "text-indigo-500", Inactive: "text-gray-300"'
                                    x-description="Heroicon name: solid/star" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            @endfor

                            @for ($i = 0; $i < 5 - $product->rate; $i++)
                                <svg class="h-5 w-5 flex-shrink-0 text-indigo-500" x-state:on="Active"
                                    x-state:off="Inactive"
                                    x-state-description='Active: "text-indigo-500", Inactive: "text-gray-300"'
                                    x-description="Heroicon name: solid/star" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="none" stroke="currentColor" aria-hidden="true">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                            @endfor
                            <span class="ml-1    text-sm">{{ $product->rate ? '(' . $product->rate . ')' : '' }}</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="sr-only">Description</h3>
                    <p> <b>Category:</b> <a href="{{ route('category.wise.product', $product->category->slug) }}"
                            class="text-orange-800">{{ $product->category->name }}</a></p>
                </div>

                <form class="mt-6">


                    <div class="mt-10 flex sm:flex-col1">
                        <a href="{{ route('addToCart', $product->id) }}"
                            class="max-w-xs flex-1 bg-[#ff6a28] border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500 sm:w-full">
                            Add to cart
                        </a>

                        <a href="{{ route('add.to.wishlist', $product->id) }}"
                            class="ml-4 py-3 px-3 rounded-md flex items-center justify-center text-gray-400 hover:bg-gray-100 hover:text-gray-500">
                            <svg class="h-6 w-6 flex-shrink-0" x-description="Heroicon name: outline/heart"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                            <span class="sr-only">Add to favorites</span>
                        </a>
                    </div>
                </form>

                <section aria-labelledby="details-heading" class="mt-12">
                    <h2 id="details-heading" class="sr-only">Additional details</h2>

                    <div class="border-t divide-y divide-gray-200">
                        <div x-data="{ open: true }">
                            <h3>
                                <button type="button" x-description="Expand/collapse question button"
                                    class="group relative w-full py-6 flex justify-between items-center text-left"
                                    aria-controls="disclosure-1" @click="open = !open" aria-expanded="false"
                                    x-bind:aria-expanded="open.toString()">
                                    <span class="text-sm font-medium text-gray-900" x-state:on="Open" x-state:off="Closed"
                                        :class="{ 'text-indigo-600': open, 'text-gray-900': !(open) }">
                                        About Product
                                    </span>
                                    <span class="ml-6 flex items-center">
                                        <svg class="h-6 w-6 text-gray-400 group-hover:text-gray-500 block" x-state:on="Open"
                                            x-state:off="Closed" :class="{ 'hidden': open, 'block': !(open) }"
                                            x-description="Heroicon name: outline/plus-sm"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        <svg class="h-6 w-6 text-indigo-400 group-hover:text-indigo-500 hidden"
                                            x-state:on="Open" x-state:off="Closed"
                                            :class="{ 'block': open, 'hidden': !(open) }"
                                            x-description="Heroicon name: outline/minus-sm"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18 12H6"></path>
                                        </svg>
                                    </span>
                                </button>
                            </h3>
                            <div class="pb-6 prose prose-sm" id="disclosure-1" x-show="open" style="display: none">
                                {!! $product->long_description !!}
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>

        {{-- review --}}
        @foreach ($product->review_rating as $data)
            <div class="mt-5 bg-white rounded-lg shadow-md p-6 flex items-start justify-between">
                <!-- Left side: Comment, Customer Name, Image -->
                <div class="flex items-start">
                    <!-- Customer Image -->
                    <img src="{{ $data->customer->image ?? '' }}" alt="Customer Image" class="h-12 w-12 rounded-full">
                    <div class="ml-4">
                        <!-- Customer Name -->
                        <h3 class="text-lg font-semibold">{{ $data->customer->name ?? '' }}</h3>
                        <!-- Comment -->
                        <p class="mt-3 text-gray-600">{{ $data->comment }}</p>
                        <!-- Comment Time and Date -->
                        <p class="text-sm text-gray-400 text-right">
                            {{ \Carbon\Carbon::parse($data->created_at)->format('d F Y H:i:s') }}
                        </p>
                    </div>
                </div>
                <!-- Right side: Rating Star -->
                <div class="flex items-center">
                    @for ($i = 0; $i < $data->rating; $i++)
                        <svg class="h-5 w-5 flex-shrink-0 text-indigo-500" x-state:on="Active" x-state:off="Inactive"
                            x-state-description='Active: "text-indigo-500", Inactive: "text-gray-300"'
                            x-description="Heroicon name: solid/star" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                    @endfor

                    @for ($i = 0; $i < 5 - $data->rating; $i++)
                        <svg class="h-5 w-5 flex-shrink-0 text-indigo-500" x-state:on="Active" x-state:off="Inactive"
                            x-state-description='Active: "text-indigo-500", Inactive: "text-gray-300"'
                            x-description="Heroicon name: solid/star" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="none" stroke="currentColor" aria-hidden="true">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                    @endfor
                </div>
            </div>
        @endforeach
        {{$product->review_rating->links()}}
       

        {{-- end review --}}
    </main>
    <!-- related product -->
    <section class="bg-[#F7FAFC] py-10">
        <div class="lg:px-8 max-w-7xl mx-auto px-2 py-2 sm:px-6">
            <!-- heading icon -->
            <div class="border-b border-gray-500 mb-5 mx-auto relative w-32">
                <img class="absolute bg-[#F3FFFF] border border-gray-500 bottom-[-22px] h-10 left-0 m-auto p-1.5 right-0 rounded-full w-10"
                    src="{{ url('/frontend/image/man shirt.png') }}" alt="" />
            </div>
            <h1 class="antialiased capitalize font-bold mb-5 text-2xl text-center text-deep-sapphire-600 tracking-wide">
                Related Products
            </h1>

            <div class="flex space-x-3">
                {{-- <article
                    class="md:w-3/12 block duration-300 hover:scale-105 hover:shadow-xl hover:transform rounded-md shadow-lg">
                    <img src="https://framerusercontent.com/images/Esmk96O6NzS7dSfnXrwuf929oTk.png?scale-down-to=1024"
                        alt="" class="h-[373px] w-full" />
                </article> --}}
                <div class="lg:w-9/12 w-full">
                    <div class="slider">

                        @foreach ($related_products->reverse()->take(8) as $product)
                            @include('frontend.components.product-card', ['product' => $product])
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.multiple_image').click(function() {
                var src = $(this).attr('src');
                $('#main_image').attr('src', src);
            });
        });
    </script>
@endpush
