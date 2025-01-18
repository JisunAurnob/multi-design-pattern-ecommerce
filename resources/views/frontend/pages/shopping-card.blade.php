@extends('frontend.master')
@section('content')
    <!-- banner section -->
    <!-- shopping card -->
    <main class="mx-auto pt-16 pb-24 px-4  max-w-7xl lg:px-8">


        @php
            $cart = session()->has('cart') ? session()->get('cart') : [];
            $cartCount = count($cart);
        @endphp



        @if ($cartCount != 0)
            <div class="md:flex md:justify-between md:space-x-10">
                <section aria-labelledby="cart-heading" class="w-full">
                    <div class="flex justify-between items-center mb-4">
                        <h1 class="md:text-3xl text-xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                            Shopping Cart
                        </h1>
                        <a href="{{ route('cart.destroy') }}"
                            class="whitespace-nowrap flex inline-block bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded z-50">
                            Clear Cart&nbsp;&nbsp;
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-[14px] fill-white">
                                <path
                                    d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z" />
                            </svg>
                        </a>
                    </div>
                    <!-- <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2> -->

                    <ul role="list" class="border-t border-b border-gray-200 divide-y divide-gray-200">


                        @foreach ($carts as $item)
                            {{-- <form action="{{ route('updateCart') }}" class="mt-12 lg:grid lg:grid-cols-12 lg:gap-x-12
                lg:items-start xl:gap-x-16" method="post"> --}}
                            <form action="{{ route('updateCart') }}" method="post">
                                <input type="hidden" name="cart_id" value="{{ $item['product_id'] }}">
                                @csrf

                                <li class="flex py-6 sm:py-10">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $item['image'] }}"
                                            alt="Insulated bottle with white base and black snap lid."
                                            class="w-24 h-24 rounded-md object-center object-fill" />
                                    </div>

                                    <div class="ml-4 flex-1 flex flex-col justify-between sm:ml-6 relative">
                                        <div class="relative  sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                                            <div>
                                                <div class="flex justify-between">
                                                    <h3 class="text-sm">
                                                        <a href="#"
                                                            class="font-medium text-gray-700 hover:text-gray-800">
                                                            {{ $item['name'] }}
                                                        </a>
                                                    </h3>
                                                </div>
                                                <div class="mt-1 flex text-sm">
                                                    {{-- <p class="text-gray-500">White</p> --}}
                                                </div>
                                                <p class="mt-1 text-sm font-medium text-gray-900"> {{ $item['unit_price'] }}
                                                    BDT</p>
                                            </div>

                                            <div class="mt-4 sm:mt-0 w-full flex justify-end cartQuantity">
                                                <div class="w-fit flex flex-col">
                                                    <label for="quantity" class="sr-only">Quantity, Nomad Tumbler</label>
                                                    <label for="quantity" class="w-fit text-[10px]">Quantity</label>
                                                    <input value="{{ $item['quantity'] }}" id="quantity" name="quantity"
                                                        type="number"
                                                        class="quantityInput w-20 h-8 px-2 py-1 mt-1 rounded-md border border-gray-300 py-1 text-base leading-5 font-medium text-gray-700 text-left shadow-sm focus:outline-none focus:ring-1 focus:ring-[#ff6a28] focus:border-[#ff6a28]] sm:text-sm" />

                                                </div>
                                            </div>

                                            <div class="absolute top-[-2rem] right-1 cartCancel">
                                                <button type="button"
                                                    class="-m-2 p-2 inline-flex text-gray-400 hover:text-gray-500">
                                                    <span class="sr-only">Remove</span>

                                                    <a href="{{ route('cart.delete', $item['product_id']) }}">
                                                        <svg class="h-5 w-5" x-description="Heroicon name: solid/x"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                    </a>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="flex justify-end updateCart ">
                                            <button type="submit "
                                                class="mt-2 bg-[#ff6a28] text-sm text-white px-4 py-2 rounded-md">Update
                                                Cart</button>
                                        </div>


                                    </div>


                                </li>
                            </form>
                        @endforeach
                    </ul>
                </section>

                <!-- Order summary -->
                <section aria-labelledby="summary-heading" class="bg-gray-50 rounded-lg px-4 py-6 sm:p-6 lg:p-8 md:w-5/12 ">
                    <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Order summary</h2>

                    <dl class="mt-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <dt class="text-sm text-gray-600">Subtotal</dt>
                            <dd class="text-sm font-medium text-gray-900">BDT. {{ $total }} </dd>
                        </div>
                        <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                            <dt class="flex items-center text-sm text-gray-600">
                                <span>Discount</span>
                            </dt>
                            <dd class="text-sm font-medium text-gray-900">BDT. {{ $total_discount }} </dd>
                        </div>

                        <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                            <dt class="text-base font-medium text-gray-900">Order total</dt>
                            <dd class="text-base font-medium text-gray-900">BDT. {{ $grand_total }}</dd>
                        </div>
                    </dl>

                    <div class="mt-6">
                        <a href="{{ route('checkout') }}">
                            <button type="button"
                                class="w-full bg-[#ff6a28] border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-[#ff6a28] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500">
                                Checkout
                            </button>

                        </a>
                    </div>
                </section>
            </div>
        @else
            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div
                    class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10 flex flex-col items-center justify-center h-full">
                    <div class="mt-6 text-center">
                        <div>
                            There is no item in the Cart!
                        </div>
                        <span class="block w-full rounded-md shadow-sm">
                            <a href="{{ route('home') }}"
                                class="mt-2 w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-[#ff6a28] hover:bg-[#ff5b1f] focus:outline-none focus:border-[#ff9e5e] focus:shadow-outline-[#ff9e5e] active:bg-[#ff9e5e] transition duration-150 ease-in-out">
                                Continue Shopping
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        @endif



    </main>
@endsection
