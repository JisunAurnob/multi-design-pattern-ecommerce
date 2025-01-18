@extends('frontend.master')
@section('content')
    <!-- banner section -->
    <!-- shopping card -->
    <main class="max-w-2xl mx-auto pt-16 pb-24 px-4 sm:px-6 lg:max-w-7xl lg:px-8 mainwishlist">


        @php
            $cart = session()->has('cart') ? session()->get('cart') : [];
            $wishlistCount = count($wishlist);
        @endphp



        @if ($wishlistCount != 0)
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl wishlistData">
                Wishlist
            </h1>


            <section aria-labelledby="cart-heading" class="lg:col-span-7">
                <h2 id="cart-heading" class="sr-only">Items in your wishlist</h2>

                <ul role="list" class="border-t border-b border-gray-200 divide-y divide-gray-200 mobiletableM">

                    <div class="border-b border-gray-200 shadow sm:rounded-lg mobiletable">
                        <table class="min-w-full divide-y divide-gray-200 ProductOrderTable">
                            <thead class="bg-gray-50">
                                <tr class="ProductHeaderOrder">
                                    <th scope="col"
                                        class="ConMainHeaderTable px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        No.
                                    </th>
                                    <th scope="col"
                                        class="ConMainHeaderTable px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Image
                                    </th>

                                    <th scope="col"
                                        class="ConMainHeaderTable px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Name
                                    </th>

                                    <th scope="col"
                                        class="ConMainHeaderTable px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Add to cart
                                    </th>

                                    <th scope="col"
                                        class="ConMainHeaderTable px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Action
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($wishlist as $key => $item)
                                    <tr class="mobileView-table  relative">
                                        <td dataTitle="No." class="text-sm text-gray-900 CartOrderTableTh dataNumber">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $key + 1 }}
                                                </div>
                                            </div>
                                        </td>
                                        <td dataTitle="Product" class="text-sm text-gray-900 wishlistPro CartOrderTableTh">
                                            <div class="ml-4 wishlistProImgDiv">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <img width="150px" src="{{ $item->product->image }}"
                                                        class="object-contain rounded-full h-14 w-14" alt="No Image">
                                                </div>
                                            </div>
                                        </td>

                                        <td dataTitle="Product name"
                                            class="text-sm text-gray-900 CartOrderTableTh wishlistProduct-name">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $item->product->name }}
                                                </div>
                                            </div>
                                        </td>

                                        <td dataTitle="Add cart"
                                            class="text-sm text-gray-900 CartOrderTableTh wishlidtAddCart">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 w-28">
                                                    <div
                                                        class="bg-[#09CCD0] duration-100 flex hover:bg-[#ff6a28] items-center px-2 py-1.5 rounded-full space-x-1.5 text-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="h-4 w-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z">
                                                            </path>
                                                        </svg>

                                                        <a href="{{ route('addToCart', $item->product->id) }}">
                                                            <button class="text-sm">Add to cart</button>
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td dataTitle="Add cart"
                                            class="text-sm text-gray-900 CartOrderTableTh wishlidtAddCartM">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 w-fit">
                                                    <div
                                                        class="bg-[#09CCD0] duration-100 flex hover:bg-[#ff6a28] items-center px-2 py-1.5 rounded-full space-x-1.5 text-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="h-4 w-4">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z">
                                                            </path>
                                                        </svg>

                                                        <a class="whitespace-nowrap" href="{{ route('addToCart', $item->product->id) }}">
                                                            <button class="text-sm">Add</button>
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td
                                            class="flex px-8 py-8 space-x-2 text-sm font-medium text-right whitespace-nowrap wishlistDelete CartOrderTableTh">
                                            <a title="Delete" href="{{ route('remove.product.wishlist', $item->id) }}"
                                                onclick="return confirm('Are you sure you want to remove it from wishlist?')"
                                                class="text-indigo-600 hover:text-indigo-900">
                                                <svg class="w-5 h-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        </td>
                                        <td class="mobileWishDelete">
                                            <a title="Delete" href="{{ route('remove.product.wishlist', $item->id) }}"
                                                onclick="return confirm('Are you sure you want to remove it from wishlist?')"
                                                class="text-indigo-600 hover:text-indigo-900">
                                                {{-- <svg class="w-5 h-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg> --}}
                                                <svg class="w-4 h-4 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 512 512" fill="currentColor">
                                                    <path
                                                        d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- More people... -->
                            </tbody>
                        </table>
                    </div>
                </ul>
            </section>
        @else
            <div class="w-full flex justify-center">
                <div class="max-w-md bg-gray-200 p-4 rounded-lg">
                    <p class="text-gray-700 text-center">There are no items in the wishlist</p>
                    <a href="{{ route('home') }}"
                        class="block mt-2 mx-auto px-4 py-2 bg-[#ff6a28] text-white rounded hover:bg-[#fc844f] transition duration-300">Continue
                        Shopping</a>
                </div>
            </div>
        @endif



    </main>
@endsection
