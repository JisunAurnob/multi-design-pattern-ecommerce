<div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64 bg-white">
        <div class="h-0 flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
            <a href="{{route('admin.dashboard')}}">
                <div class="flex items-center flex-shrink-0 px-4">
                    <img class="ml-8 w-auto h-12 rounded" 
                    {{-- src="{{$settings->logo}}" --}}
                    src="{{asset('/backend/images/Passon_Logo_Transparent.png')}}"
                     alt="logo" />

                    {{-- <span class="text-black font-semibold ml-3 inline-block">{{$settings->company_name}}</span>
                    --}}
                </div>
            </a>
            <!-- Sidebar component, swap this element with another sidebar if you like -->
            <nav class="mt-5 flex-1 px-2 bg-white">
                <a href="{{route('admin.dashboard')}}" class=" {{ isRouteActive('admin.dashboard*') }} group flex items-center px-2 py-2 text-sm leading-5 hover:bg-gray-100 font-medium text-gray-600 rounded-md focus:outline-none  transition ease-in-out duration-150">
                    <svg class="mr-3 h-6 w-6 text-gray-600 group-hover:text-gray-800 group-focus:text-gray-100 transition ease-in-out duration-150" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10M9 21h6" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{route('customer.list')}}" class=" {{ isRouteActive('customer.list*') }}   group flex items-center px-2 py-2 text-sm leading-5 hover:bg-gray-100 font-medium text-gray-600 rounded-md focus:outline-none  transition ease-in-out duration-150">
                    <i class="fa-solid fa-person-circle-question mx-3"></i>
                    <svg class="w-6 h-6 mr-3 text-gray-600 transition duration-150 ease-in-out group-hover:text-gray-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M4 22a8 8 0 1 1 16 0h-2a6 6 0 1 0-12 0H4zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" fill="currentColor" />
                    </svg>
                    Customer
                </a>
                @if(hasAnyPermissions('admin.product.list'))
                <a href="{{route('admin.product.list')}}" class="{{ isRouteActive('admin.product.list*') }} group flex items-center px-2 py-2 text-sm leading-5 hover:bg-gray-100 font-medium text-gray-600 rounded-md focus:outline-none  transition ease-in-out duration-150">
                    <i class="fa-solid fa-person-circle-question mx-3"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    Product
                </a>
                @endif

                @if(hasAnyPermissions('admin.review.list'))
                <a href="{{route('admin.review.list')}}" class="{{ isRouteActive('admin.review.list*') }} group flex items-center px-2 py-2 text-sm leading-5 hover:bg-gray-100 font-medium text-gray-600 rounded-md focus:outline-none  transition ease-in-out duration-150">
                    <i class="fa-solid fa-person-circle-question mx-3"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    Product Review
                </a>
                @endif

                @if(hasAnyPermissions('admin.category.list'))
                <a href="{{route('admin.category.list')}}" class="{{ isRouteActive('admin.category.list*') }} group flex items-center px-2 py-2 text-sm leading-5 hover:bg-gray-100 font-medium text-gray-600 rounded-md focus:outline-none  transition ease-in-out duration-150">
                    <i class="fa-solid fa-person-circle-question mx-3"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    Categories
                </a>
                @endif
                
                <div class="relative">
                    <li class="flex items-center justify-between px-2 py-2 mt-1 text-sm font-medium leading-5 text-gray-600 transition duration-150 ease-in-out rounded-md group hover:text-gray-800 hover:bg-gray-100 focus:outline-none">
                        <div class="flex items-center">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                            Customer's Orders Status
                        </div>

                    </li>

                    <div class="ml-5">

                        <a href="{{ route('order.list') }}" class=" mt-1  group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 7.5A2.25 2.25 0 017.5 5.25h9a2.25 2.25 0 012.25 2.25v9a2.25 2.25 0 01-2.25 2.25h-9a2.25 2.25 0 01-2.25-2.25v-9z" />
                            </svg>
                            All Orders
                        </a>

                        <a href="{{ route('order.list', ['status' => 'pending']) }}" class=" mt-1 {{ request()->query('status') === 'pending' ? 'bg-gray-200' : '' }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 7.5A2.25 2.25 0 017.5 5.25h9a2.25 2.25 0 012.25 2.25v9a2.25 2.25 0 01-2.25 2.25h-9a2.25 2.25 0 01-2.25-2.25v-9z" />
                            </svg>
                            Pending Orders
                        </a>

                        <a href="{{ route('order.list', ['status' => 'processing']) }}" class=" mt-1  {{ request()->query('status') === 'processing' ? 'bg-gray-200' : '' }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-white  transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                            </svg>
                            Process Orders
                        </a>

                        <a href="{{ route('order.list', ['status' => 'confirm']) }}" class=" mt-1  {{ request()->query('status') === 'confirm' ? 'bg-gray-200' : '' }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-white  transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Confirmed Orders
                        </a>

                        <a href="{{ route('order.list', ['status' => 'dispatch']) }}" class=" mt-1  {{ request()->query('status') === 'dispatch' ? 'bg-gray-200' : '' }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-white  transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75" />
                            </svg>
                            Dispatch Orders
                        </a>

                      

                        {{-- <a href="{{ route('order.list', ['status' => 'success']) }}" class=" mt-1  {{ request()->query('status') === 'success' ? 'bg-gray-200' : '' }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-white  transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                            Success Orders
                        </a> --}}

                        

                        <a href="{{ route('order.list', ['status' => 'delivered']) }}" class=" mt-1  {{ request()->query('status') === 'delivered' ? 'bg-gray-200' : '' }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-white  transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                            Delivered Orders
                        </a>
                        <a href="{{ route('order.list', ['status' => 'return']) }}" class=" mt-1  {{ request()->query('status') === 'return' ? 'bg-gray-200' : '' }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-white  transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                            Return Orders
                        </a>


                        <a href="{{ route('order.list', ['status' => 'canceled']) }}" class=" mt-1 {{ request()->query('status') === 'canceled' ? 'bg-gray-200' : '' }} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-white  transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Cancel Orders
                        </a>

                        

                    </div>
                </div> 

                <!-- <div>
                @if(hasAnyPermissions('admin.wishlist'))
                <a href="{{route('admin.wishlist')}}" class=" {{isRouteActive('admin.wishlist*')}} group flex items-center px-2 py-2 text-sm leading-5 hover:bg-gray-100 font-medium text-gray-600 rounded-md focus:outline-none  transition ease-in-out duration-150">
                    <i class="fa-solid fa-person-circle-question mx-3"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>

                    Wishlist
                </a>
                @endif
                </div> -->

                <!-- <div>
                @if(hasAnyPermissions('admin.coupons'))
                <a href="{{route('admin.coupons')}}" class=" {{isRouteActive('admin.coupons*')}} group flex items-center px-2 py-2 text-sm leading-5 hover:bg-gray-100 font-medium text-gray-600 rounded-md focus:outline-none  transition ease-in-out duration-150">
                    <i class="fa-solid fa-person-circle-question mx-3"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>

                    Coupons
                </a>
                @endif
                </div> -->

                <a href="{{route('slider.list')}}" class=" {{ isRouteActive('slider.list*') }} group flex items-center px-2 py-2 text-sm leading-5 hover:bg-gray-100 font-medium text-gray-600 rounded-md focus:outline-none  transition ease-in-out duration-150">
                    <i class="fa-solid fa-person-circle-question mx-3"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                    </svg>

                    Slider
                </a>
                <a href="{{route('division.list')}}" class=" {{ isRouteActive('division.list*') }} group flex items-center px-2 py-2 text-sm leading-5 hover:bg-gray-100 font-medium text-gray-600 rounded-md focus:outline-none  transition ease-in-out duration-150">
                    <i class="fa-solid fa-person-circle-question mx-3"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" class="mr-3 text-gray-900">
                        <path d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                    Location
                </a>
                 <!-- <a href="" class=" group flex items-center px-2 py-2 text-sm leading-5 hover:bg-gray-100 font-medium text-gray-600 rounded-md focus:outline-none  transition ease-in-out duration-150">
                    <i class="fa-solid fa-person-circle-question mx-3"></i>

                    Payment
                </a> -->
                 <a href="" class=" group flex items-center px-2 py-2 text-sm leading-5 hover:bg-gray-100 font-medium text-gray-600 rounded-md focus:outline-none  transition ease-in-out duration-150">
                    <i class="fa-solid fa-person-circle-question mx-3"></i>

                    Report
                </a>
                <div class="relative">
                    <li class=" mt-1 group flex items-center justify-between px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                        <div class="flex items-center">
                            <svg cla xmlns="http://www.w3.org/2000/svg" class="mr-3 h-6 w-6 text-gray-600 group-hover:text-gray-800  transition ease-in-out duration-150" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Settings
                        </div>

                    </li>
                    <div class="ml-5">
                        @if(hasAnyPermissions('role.list'))
                        <a href="{{route('role.list')}}" class=" mt-1 {{isRouteActive('role*')}} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
                            </svg>
                            Role
                        </a>
                        @endif

                        @if(hasAnyPermissions('user.list'))
                        <a href="{{route('user.list')}}" class=" mt-1  {{isRouteActive('user*')}} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-white  transition ease-in-out duration-150">
                            <svg class="mr-3 h-6 w-6 text-gray-600 group-hover:text-gray-800  transition ease-in-out duration-150" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36">
                                <path fill="none" d="M0 0h24v24H0z" />
                                <path d="M4 22a8 8 0 1 1 16 0h-2a6 6 0 1 0-12 0H4zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6zm0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" fill="currentColor" />
                            </svg>
                            User
                        </a>
                        @endif



                        @if(hasAnyPermissions('settings'))
                        <a href="{{route('settings')}}" class=" mt-1 {{isRouteActive('settings*')}}   group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                            <svg class="mr-3 h-6 w-6 text-gray-600 group-hover:text-gray-800  transition ease-in-out duration-150" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path fill="none" d="M0 0h24v24H0z" />
                                <path d="M3.34 17a10.018 10.018 0 0 1-.978-2.326 3 3 0 0 0 .002-5.347A9.99 9.99 0 0 1 4.865 4.99a3 3 0 0 0 4.631-2.674 9.99 9.99 0 0 1 5.007.002 3 3 0 0 0 4.632 2.672c.579.59 1.093 1.261 1.525 2.01.433.749.757 1.53.978 2.326a3 3 0 0 0-.002 5.347 9.99 9.99 0 0 1-2.501 4.337 3 3 0 0 0-4.631 2.674 9.99 9.99 0 0 1-5.007-.002 3 3 0 0 0-4.632-2.672A10.018 10.018 0 0 1 3.34 17zm5.66.196a4.993 4.993 0 0 1 2.25 2.77c.499.047 1 .048 1.499.001A4.993 4.993 0 0 1 15 17.197a4.993 4.993 0 0 1 3.525-.565c.29-.408.54-.843.748-1.298A4.993 4.993 0 0 1 18 12c0-1.26.47-2.437 1.273-3.334a8.126 8.126 0 0 0-.75-1.298A4.993 4.993 0 0 1 15 6.804a4.993 4.993 0 0 1-2.25-2.77c-.499-.047-1-.048-1.499-.001A4.993 4.993 0 0 1 9 6.803a4.993 4.993 0 0 1-3.525.565 7.99 7.99 0 0 0-.748 1.298A4.993 4.993 0 0 1 6 12c0 1.26-.47 2.437-1.273 3.334a8.126 8.126 0 0 0 .75 1.298A4.993 4.993 0 0 1 9 17.196zM12 15a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                            </svg>

                            Business Settings
                        </a>
                        @endif

                        @if(hasAnyPermissions('shipping.charges.setup'))
                        <a href="{{route('shipping.index')}}" class="mt-1 {{isRouteActive('shipping.index*')}} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-6 w-6 text-gray-600 group-hover:text-gray-800  transition ease-in-out duration-150" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Shipping Charge Setup
                        </a>
                        @endif

                        @if(hasAnyPermissions('changePassword'))
                        <a href="{{route('changePassword')}}" class="mt-1 {{isRouteActive('changePassword*')}} group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-800 hover:bg-gray-100 focus:outline-none  transition ease-in-out duration-150">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-6 w-6 text-gray-600 group-hover:text-gray-800  transition ease-in-out duration-150" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Change Password
                        </a>
                        @endif

                    </div>

                </div>
            </nav>
        </div>

        <div class="flex-shrink-0 flex bg-gray-100 p-4">
            <a href="{{route('logout')}}" class="flex-shrink-0 w-full group block" title="logout">
                <div class="flex items-center space-x-2">
                    <div class="ml-3 ">

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26" width="22" height="22">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path d="M6.265 3.807l1.147 1.639a8 8 0 1 0 9.176 0l1.147-1.639A9.988 9.988 0 0 1 22 12c0 5.523-4.477 10-10 10S2 17.523 2 12a9.988 9.988 0 0 1 4.265-8.193zM11 12V2h2v10h-2z" />
                        </svg>

                    </div>
                    <div class="mb-1">
                        <p class="text-lg leading-4 font-medium text-gray-600 group-hover:text-gray-800 transition ease-in-out duration-150">
                            Logout 
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>