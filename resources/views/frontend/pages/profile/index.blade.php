@extends('frontend.master')
@section('content')
    <!-- menu section    -->


    <!-- banner section -->
    <div class="h-[280px] relative text-white"
        style="
        background-image: url(data:image/jpeg;base64,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);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        /* height: 600px; */
      ">
        <div class="absolute bottom-0 h-full left-0 w-full  bg-gray-800 opacity-75"></div>
        <div class="container flex h-full items-center justify-center max-w-7xl mx-auto relative ">
            <div class="text-white transform">
                <h1 class="font-medium mb-5 md:text-4xl text-3xl  tracking-tight capitalize">My Profile</h1>
            </div>

        </div>
    </div>


    <div>
        <!-- modal start here -->
        <form action="{{ route('profile.update', auth('customer')->user()->id) }}" method="post"
            class=" px-6 md:py-6 rounded-md space-y-7" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="modal">
                <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity">
                        <div class="absolute inset-0 bg-gray-900 opacity-75" />
                    </div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                    <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                        role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h1><b>Profile Edit</b> </h1>
                            <label for="name" class="font-medium text-gray-800">Name: </label>
                            <input id="name" readonly value="{{ auth('customer')->user()->name }}" name="name"
                                type="text" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />

                            <label for="email" class="font-medium text-gray-800">Email: </label>
                            <input id="email" readonly value="{{ auth('customer')->user()->email }}" name="email"
                                type="email" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" />

                            <label for="phone" class="font-medium text-gray-800">Contact: </label>
                            <input id="phone" value="{{ auth('customer')->user()->phone }}" name="phone"
                                type="number" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3"
                                placeholder="Enter Your Phone Number" />

                            <label class="font-medium text-gray-800"> Select Gender:</label>
                            <!-- <input type="text"
                                                                            class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" /> -->
                            <select name="gender" id=""
                                class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3">
                                <option>Select Gender</option>
                                <option value="women" @if (auth('customer')->user()->gender == 'women') selected @endif>Women</option>
                                <option value="man" @if (auth('customer')->user()->gender == 'man') selected @endif>Man</option>
                                <option value="child" @if (auth('customer')->user()->gender == 'child') selected @endif>Child</option>
                            </select>
                            <!-- <label class="font-medium text-gray-800">Address: </label>
                                    <input type="text" name="address" class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" placeholder=" Enter Your Address" /> -->

                            <label for="image" class="font-medium text-gray-800">Image: <a
                                    class="text-blue-600 underline" href="https://squoosh.app/" target="_blank">Resize
                                    here</a> <br>
                                <span class="text-black"> The size of height and width should be the same for 1:1 ratio
                                </span>
                            </label>
                            <input id="image" name="image" type="file" placeholder="Enter  image" />
                        </div>
                        <div class="bg-gray-200 px-4 py-3 text-right">
                            <button type="button" class="py-2 px-4 rounded-full bg-gray-500 text-white rounded hover:bg-gray-700 mr-2 transition duration-500"
                                onclick="toggleModal()"><i class="fas fa-times"></i>&nbsp;Cancel</button>
                            <button type="submit"
                                class="py-2 px-4 bg-[#ff6a28] rounded-full text-white rounded font-medium hover:bg-[#fc9a6f] mr-2 transition duration-500"><i
                                    class="fas fa-plus"></i> Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- modal end here -->
    </div>

    <!-- personal information -->
    <div class="w-full container md:mt-12 ">
        <!-- tab start here -->
        <div class="w-full md:flex md:px-10 px-2 md:space-x-7 mt-10 md:mt-0 grid grid-cols-1 md:grid-cols-2"
            x-data="{ openTab: 1 }">
            <div
                class="w-full md:block md:w-4/12  w-3/12 h-full bg-white rounded-md shadow-sm space-y-4 border-2 fullDashboard">
                <div class="w-full md:block">
                    <div class="w-32 h-32 mt-2 rounded-full m-auto">
                        <img src="{{ auth('customer')->user()->image }}" class="h-full w-full rounded object-cover" />
                    </div>
                    <div>
                        <p class="capitalize text-center">{{ auth('customer')->user()->name }}</p>
                        <p class="text-center">{{ auth('customer')->user()->phone }}</p>
                    </div>
                </div>
                <div class="pt-10 DashboardInfo">
                    <ul class="px-3 tabs">
                        <li>
                            <button @click="openTab = 1"
                                class="flex justify-between items-center py-3 pr-2 hover:bg-darkred-100 rounded-lg hover:text-[#ff6a28] font-medium hover:scale-110 transform ease-in-out duration-500 active tab"
                                data-tab-target="#dashboard">
                                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    width="25" height="25">
                                    <path fill="none" d="M0 0H24V24H0z"></path>
                                    <path
                                        d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2zm0 2c-4.418 0-8 3.582-8 8s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8zm3.833 3.337c.237-.166.559-.138.763.067.204.204.23.526.063.76-2.18 3.046-3.38 4.678-3.598 4.897-.586.585-1.536.585-2.122 0-.585-.586-.585-1.536 0-2.122.374-.373 2.005-1.574 4.894-3.602zM17.5 11c.552 0 1 .448 1 1s-.448 1-1 1-1-.448-1-1 .448-1 1-1zm-11 0c.552 0 1 .448 1 1s-.448 1-1 1-1-.448-1-1 .448-1 1-1zm2.318-3.596c.39.39.39 1.023 0 1.414-.39.39-1.024.39-1.414 0-.39-.39-.39-1.024 0-1.414.39-.39 1.023-.39 1.414 0zM12 5.5c.552 0 1 .448 1 1s-.448 1-1 1-1-.448-1-1 .448-1 1-1z"
                                        fill="rgba(0,0,0,1)"></path>
                                </svg>
                                <span class="capitalize pl-5  md:block">dashboard</span>

                            </button>
                        </li>
                        <li>
                            <button @click="openTab = 2"
                                class="flex justify-between hover:text-[#ff6a28] font-medium rounded-lg items-center py-3 pr-2 hover:bg-darkred-100 hover:scale-110 transform ease-in-out duration-500 tab"
                                data-tab-target="#information">
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                    height="24">
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path
                                        d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM11 7h2v2h-2V7zm0 4h2v6h-2v-6z">
                                    </path>
                                </svg> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="22"
                                    height="22">
                                    <path
                                        d="M512 80c8.8 0 16 7.2 16 16V416c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V96c0-8.8 7.2-16 16-16H512zM64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM208 256a64 64 0 1 0 0-128 64 64 0 1 0 0 128zm-32 32c-44.2 0-80 35.8-80 80c0 8.8 7.2 16 16 16H304c8.8 0 16-7.2 16-16c0-44.2-35.8-80-80-80H176zM376 144c-13.3 0-24 10.7-24 24s10.7 24 24 24h80c13.3 0 24-10.7 24-24s-10.7-24-24-24H376zm0 96c-13.3 0-24 10.7-24 24s10.7 24 24 24h80c13.3 0 24-10.7 24-24s-10.7-24-24-24H376z" />
                                </svg>
                                <span class="capitalize pl-5 md:block">profile</span>

                            </button>
                        </li>
                        <!-- <li>
                                        <button @click="openTab = 3" class="flex justify-between hover:text-[#ff6a28] font-medium rounded-lg items-center py-3 pr-2 hover:bg-darkred-100 hover:scale-110 transform ease-in-out duration-500 tab" data-tab-target="#information">
                                          <span class="capitalize pl-5">Address</span>
                                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                            <path fill="none" d="M0 0h24v24H0z"></path>
                                            <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM11 7h2v2h-2V7zm0 4h2v6h-2v-6z">
                                            </path>
                                          </svg>
                                        </button>
                                      </li> -->
                        <li>
                            <button @click="openTab = 4"
                                class="flex justify-between hover:text-[#ff6a28] font-medium rounded-lg items-center py-3 pr-2 hover:bg-darkred-100 hover:scale-110 transform ease-in-out duration-500 tab"
                                data-tab-target="#information">
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                    height="24">
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path
                                        d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM11 7h2v2h-2V7zm0 4h2v6h-2v-6z">
                                    </path>
                                </svg> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="23"
                                    height="23">
                                    <path
                                        d="M24 0C10.7 0 0 10.7 0 24S10.7 48 24 48H69.5c3.8 0 7.1 2.7 7.9 6.5l51.6 271c6.5 34 36.2 58.5 70.7 58.5H488c13.3 0 24-10.7 24-24s-10.7-24-24-24H199.7c-11.5 0-21.4-8.2-23.6-19.5L170.7 288H459.2c32.6 0 61.1-21.8 69.5-53.3l41-152.3C576.6 57 557.4 32 531.1 32H360V134.1l23-23c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-64 64c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l23 23V32H120.1C111 12.8 91.6 0 69.5 0H24zM176 512a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm336-48a48 48 0 1 0 -96 0 48 48 0 1 0 96 0z" />
                                </svg>
                                <span class="capitalize pl-5  md:block">Order</span>

                            </button>
                        </li>
                        <li>
                            <button @click="openTab = 5"
                                class="flex justify-between hover:text-[#ff6a28] font-medium rounded-lg items-center py-3 pr-2 hover:bg-darkred-100 hover:scale-110 transform ease-in-out duration-500 tab"
                                data-tab-target="#information">
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                    height="24">
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path
                                        d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM11 7h2v2h-2V7zm0 4h2v6h-2v-6z">
                                    </path>
                                </svg> --}}
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20"
                                    viewBox="0 0 512 512">
                                    <path
                                        d="M269.4 2.9C265.2 1 260.7 0 256 0s-9.2 1-13.4 2.9L54.3 82.8c-22 9.3-38.4 31-38.3 57.2c.5 99.2 41.3 280.7 213.6 363.2c16.7 8 36.1 8 52.8 0C454.7 420.7 495.5 239.2 496 140c.1-26.2-16.3-47.9-38.3-57.2L269.4 2.9zM144 221.3c0-33.8 27.4-61.3 61.3-61.3c16.2 0 31.8 6.5 43.3 17.9l7.4 7.4 7.4-7.4c11.5-11.5 27.1-17.9 43.3-17.9c33.8 0 61.3 27.4 61.3 61.3c0 16.2-6.5 31.8-17.9 43.3l-82.7 82.7c-6.2 6.2-16.4 6.2-22.6 0l-82.7-82.7c-11.5-11.5-17.9-27.1-17.9-43.3z" />
                                </svg>
                                <span class="capitalize pl-5  md:block">Wishlist</span>

                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- tab content start here -->
            <div class="w-full dashboardStart">
                <!-- dashboard -->
                <div x-show="openTab === 1" class="lg:px-5 active" id="dashboard" data-tab-content="">
                    <div class="bg-white rounded-xl md:py-4 py-2 px-6 border-b-4 border-darkred-50 mb-4">
                        <h1 class="capitalize">dashboard</h1>
                    </div>
                    <div
                        class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-1 gap-4 bg-white rounded-md shadow-sm border-2 px-5 py-5">
                        <div class="flex items-center bg-white border-2 p-5 rounded-md shadow-sm">
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path
                                    d="M12 11a5 5 0 0 1 5 5v6H7v-6a5 5 0 0 1 5-5zm-6.712 3.006a6.983 6.983 0 0 0-.28 1.65L5 16v6H2v-4.5a3.5 3.5 0 0 1 3.119-3.48l.17-.014zm13.424 0A3.501 3.501 0 0 1 22 17.5V22h-3v-6c0-.693-.1-1.362-.288-1.994zM5.5 8a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zm13 0a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM12 2a4 4 0 1 1 0 8 4 4 0 0 1 0-8z">
                                </path>
                            </svg> --}}
                            <img width="30" height="30" src="{{ asset('/frontend/image/totalorder.svg') }}"
                                alt="total-order">
                            <div class="pl-6">
                                <p>Total orders</p>
                                <p> {{ $total_order['total_order'] }} </p>
                            </div>
                        </div>
                        <div class="flex items-center bg-white border-2 p-5 rounded-md shadow-sm">
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path
                                    d="M12 11a5 5 0 0 1 5 5v6H7v-6a5 5 0 0 1 5-5zm-6.712 3.006a6.983 6.983 0 0 0-.28 1.65L5 16v6H2v-4.5a3.5 3.5 0 0 1 3.119-3.48l.17-.014zm13.424 0A3.501 3.501 0 0 1 22 17.5V22h-3v-6c0-.693-.1-1.362-.288-1.994zM5.5 8a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zm13 0a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM12 2a4 4 0 1 1 0 8 4 4 0 0 1 0-8z">
                                </path>
                            </svg> --}}

                            <img width="30" height="30" src="{{ asset('/frontend/image/pendingOrder.svg') }}"
                                alt="pending-order">

                            <div class="pl-6">
                                <p>Pending orders</p>
                                <p> {{ $total_order['pending_order'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-center bg-white border-2 p-5 rounded-md shadow-sm">
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path fill="none" d="M0 0h24v24H0z"></path>
                                <path
                                    d="M12 11a5 5 0 0 1 5 5v6H7v-6a5 5 0 0 1 5-5zm-6.712 3.006a6.983 6.983 0 0 0-.28 1.65L5 16v6H2v-4.5a3.5 3.5 0 0 1 3.119-3.48l.17-.014zm13.424 0A3.501 3.501 0 0 1 22 17.5V22h-3v-6c0-.693-.1-1.362-.288-1.994zM5.5 8a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zm13 0a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM12 2a4 4 0 1 1 0 8 4 4 0 0 1 0-8z">
                                </path>
                            </svg> --}}
                            <img width="30" height="30" src="{{ asset('/frontend/image/package.svg') }}"
                                alt="delivered_order">
                            <div class="pl-6">
                                <p> Delivered orders</p>
                                <p>{{ $total_order['delivered_order'] }}</p>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- information -->
                <div x-show=" openTab===2" class="lg:px-5" id="information" data-tab-content="">
                    <div class="bg-white rounded-xl py-4 px-6 border-b-4 border-darkred-50 mb-4">
                        <h1 class="capitalize">basic information</h1>
                    </div>
                    <div class="bg-white border-2 rounded-md shadow-sm px-5 py-3">
                        <div>
                            <div class="">
                                <div class="flex justify-between">
                                    <div class="flex justify-start items-center w-full space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                            height="24">
                                            <path fill="none" d="M0 0h24v24H0z"></path>
                                            <path
                                                d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm-1-11v6h2v-6h-2zm0-4v2h2V7h-2z">
                                            </path>
                                        </svg>
                                        <h1 class="capitalize font-semibold text-2xl">personal information</h1>
                                    </div>
                                    <div>
                                        <button onclick="toggleModal()"
                                            class="capitalize justify-between px-3 py-1 cursor-pointer border-2 border-darkred-100">
                                            Edit
                                        </button>
                                    </div>
                                </div>

                            </div>







                            <p class="border-b-4 border-darkred-50 ml-10 w-3/12 pt-1"></p>

                            <div class="mt-10 px-8">
                                <div class="flex w-full pb-3">
                                    <p class="capitalize w-3/12"> Name:</p>
                                    <p class="capitalize">{{ auth('customer')->user()->name }}</p>
                                </div>

                                <div class="flex w-full pb-3">
                                    <p class="w-3/12 capitalize">Contact number:</p>
                                    <p class="capitalize">{{ auth('customer')->user()->phone }}</p>
                                </div>
                                <div class="flex w-full pb-3">
                                    <p class="w-3/12 capitalize">gender:</p>
                                    <p class="capitalize">{{ auth('customer')->user()->gender }}</p>
                                </div>
                                <div class="flex w-full pb-3">
                                    <p class="capitalize w-3/12">primary email:</p>
                                    <p>{{ auth('customer')->user()->email }}</p>
                                </div>
                                <!-- <div class="flex w-full pb-3">
                                            <p class="w-3/12 capitalize">Address:</p>
                                            <p class="capitalize">address</p>
                                          </div>
                                          <div class="flex w-full pb-3">
                                            <p class="w-3/12 capitalize">Image:</p>
                                            <p class="capitalize">address</p>
                                          </div> -->
                                <!-- <div class="flex w-full">
                                                            <p class="w-3/12 capitalize">birthdate:</p>
                                                            <p class="capitalize">08/11/1998</p>
                                                        </div> -->
                            </div>
                        </div>
                        {{-- <div class="mt-8">
                            <div class="flex items-center justify-between">
                                <div class="flex justify-start items-center w-full space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                        height="24">
                                        <path fill="none" d="M0 0h24v24H0z"></path>
                                        <path
                                            d="M3 3h18a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zm9.06 8.683L5.648 6.238 4.353 7.762l7.72 6.555 7.581-6.56-1.308-1.513-6.285 5.439z">
                                        </path>
                                    </svg>
                                    <h1 class="capitalize font-semibold text-2xl">email address</h1>
                                </div>


                            </div>
                            <p class="border-b-4 border-darkred-50 ml-10 w-2/12 pt-1"></p>

                            <div class="mt-10 px-8">
                                <div class="flex w-full pb-3">
                                    <p class="capitalize w-3/12">primary email:</p>
                                    <p>{{ auth('customer')->user()->email }}</p>
                                </div>
                            </div>
                        </div> --}}
                        <!-- tab content start here -->
                    </div>
                </div>







                <!-- address -->
                <div x-show="openTab === 3" class="md:px-5" id="address" data-tab-content="">
                    <div class="bg-white rounded-xl py-4 px-6 border-b-4 border-darkred-50 mb-4">
                        <h1 class="capitalize">address</h1>
                    </div>
                    <div class="bg-white border-2 rounded-md shadow-sm px-5 py-3">
                        <div>
                            <div class="flex items-center justify-between">
                                <div class="flex justify-start items-center w-full space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                        height="24">
                                        <path fill="none" d="M0 0h24v24H0z"></path>
                                        <path
                                            d="M18.364 17.364L12 23.728l-6.364-6.364a9 9 0 1 1 12.728 0zM12 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0-2a2 2 0 1 1 0-4 2 2 0 0 1 0 4z">
                                        </path>
                                    </svg>
                                    <h1 class="capitalize font-semibold text-2xl">address</h1>
                                </div>
                                <div class="w-3/12">
                                    <button
                                        class="capitalize text-sm px-3 py-2 font-semibold cursor-pointer bg-darkred-100 text-white"
                                        id="delete-btn">
                                        Add new address
                                    </button>
                                </div>
                            </div>
                            <p class="border-b-4 border-darkred-50 ml-10 w-1/12 pt-1"></p>

                            <div class="flex flex-col pt-5">
                                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Name
                                                        </th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Address
                                                        </th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Phone Number
                                                        </th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Email
                                                        </th>
                                                        <th scope="col" class="relative px-6 py-3">
                                                            <span class="sr-only">Edit</span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Odd row -->
                                                    <tr class="bg-white">
                                                        <td
                                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                            {{ auth('customer')->user()->name }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            Regional Paradigm Technician
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ auth('customer')->user()->phone }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ auth('customer')->user()->email }}
                                                        </td>
                                                        <td
                                                            class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                            <a href="#"
                                                                class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-black bg-opacity-50 absolute inset-0 hidden justify-center items-center"
                                id="overlay">
                                <div
                                    class="bg-gray-200 py-2 px-3 rounded shadow-xl text-gray-800 w-7/12 border-2 h-80 overflow-y-scroll border-red-700">
                                    <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full float-right"
                                        id="close-modal" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <div class="grid grid-cols-2 gap-6">
                                        <div>
                                            <label for="email"
                                                class="block text-sm font-medium text-gray-700">Email</label>
                                            <div class="mt-1">
                                                <input type="text" name="email" id="email"
                                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                                    placeholder="you@example.com" />
                                            </div>
                                        </div>
                                        <div>
                                            <label for="email"
                                                class="block text-sm font-medium text-gray-700">Email</label>
                                            <div class="mt-1">
                                                <input type="text" name="email" id="email"
                                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                                    placeholder="you@example.com" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-5">
                                        <div>
                                            <label for="email"
                                                class="block text-sm font-medium text-gray-700">Email</label>
                                            <div class="mt-1">
                                                <input type="text" name="email" id="email"
                                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                                    placeholder="you@example.com" />
                                            </div>
                                        </div>
                                        <div>
                                            <label for="email"
                                                class="block text-sm font-medium text-gray-700">Email</label>
                                            <div class="mt-1">
                                                <input type="text" name="email" id="email"
                                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                                    placeholder="you@example.com" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-5">
                                        <div>
                                            <label for="email"
                                                class="block text-sm font-medium text-gray-700">Email</label>
                                            <div class="mt-1">
                                                <input type="text" name="email" id="email"
                                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                                    placeholder="you@example.com" />
                                            </div>
                                        </div>
                                        <div>
                                            <label for="email"
                                                class="block text-sm font-medium text-gray-700">Email</label>
                                            <div class="mt-1">
                                                <input type="text" name="email" id="email"
                                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                                    placeholder="you@example.com" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-full">
                                        <div>
                                            <label for="email"
                                                class="block text-sm font-medium text-gray-700">Email</label>
                                            <div class="mt-1">
                                                <textarea type="text" name="email" id="email"
                                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                                    placeholder="you@example.com"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-end pt-7">
                                        <button class="px-4 py-1.5 bg-darkred-100 rounded-md text-white" type="submit">
                                            save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- order start -->
                <div x-show="openTab === 4" class="lg:px-5" id="orders" data-tab-content="">
                    <div class="bg-white rounded-xl py-4 px-6 border-b-4 border-darkred-50 mb-4">
                        <h1 class="capitalize">my orders list</h1>
                    </div>
                    <div class="bg-white border-2 rounded-md shadow-sm px-5 py-3">
                        <div>
                            <div class="flex items-center justify-between">
                                <div class="flex justify-start items-center w-full space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                        height="24">
                                        <path fill="none" d="M0 0h24v24H0z"></path>
                                        <path
                                            d="M21 11.646V21a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-9.354A3.985 3.985 0 0 1 2 9V3a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v6c0 1.014-.378 1.94-1 2.646zm-2 1.228a4.007 4.007 0 0 1-4-1.228A3.99 3.99 0 0 1 12 13a3.99 3.99 0 0 1-3-1.354 3.99 3.99 0 0 1-4 1.228V20h14v-7.126zM14 9a1 1 0 0 1 2 0 2 2 0 1 0 4 0V4H4v5a2 2 0 1 0 4 0 1 1 0 1 1 2 0 2 2 0 1 0 4 0z"
                                            fill="rgba(0,0,0,1)"></path>
                                    </svg>
                                    <h1 class="capitalize font-semibold text-2xl">my orders list</h1>
                                </div>
                            </div>
                            <p class="border-b-4 border-darkred-50 ml-10 w-2/12 pt-1"></p>

                            <div class="flex flex-col pt-5">
                                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            serial no
                                                        </th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            order number
                                                        </th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            payment status
                                                        </th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            status
                                                        </th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Odd row -->
                                                    @foreach ($orders as $key => $order)
                                                        <tr class="bg-white">
                                                            <td
                                                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                {{ $key + 1 }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                {{ $order->order_number }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                {{ $order->payment_status }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                {{ $order->status }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">

                                                                <a href="{{ route('view.order', $order->order_number) }}"
                                                                    class="mr-2 capitalize text-sm px-3 py-2 font-semibold cursor-pointer bg-blue-500 text-white">
                                                                    View
                                                                </a>


                                                                <a href="{{ route('trackOrder', $order->order_number) }}"
                                                                    class="mr-2 capitalize text-sm px-3 py-2 font-semibold cursor-pointer bg-green-500 text-white">
                                                                    Track Order
                                                                </a>


                                                                @if ($order->status == 'pending')
                                                                    <a href="{{ route('order.cancel.form', $order->id) }}"
                                                                        class="capitalize text-sm px-3 py-2 font-semibold cursor-pointer bg-red-500 text-white"
                                                                        id="delete-btn">&nbsp;
                                                                        Cancel Order
                                                                    </a>
                                                                @endif

                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div x-show="openTab === 5" class="lg:px-5" id="orders" data-tab-content="">
                    <div class="bg-white rounded-xl py-4 px-6 border-b-4 border-darkred-50 mb-4">
                        <h1 class="capitalize">Wish list</h1>
                    </div>
                    <div class="bg-white border-2 rounded-md shadow-sm px-5 py-3">
                        <div>
                            <div class="flex items-center justify-between">
                                <div class="flex justify-start items-center w-full space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                        height="24">
                                        <path fill="none" d="M0 0h24v24H0z"></path>
                                        <path
                                            d="M21 11.646V21a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-9.354A3.985 3.985 0 0 1 2 9V3a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v6c0 1.014-.378 1.94-1 2.646zm-2 1.228a4.007 4.007 0 0 1-4-1.228A3.99 3.99 0 0 1 12 13a3.99 3.99 0 0 1-3-1.354 3.99 3.99 0 0 1-4 1.228V20h14v-7.126zM14 9a1 1 0 0 1 2 0 2 2 0 1 0 4 0V4H4v5a2 2 0 1 0 4 0 1 1 0 1 1 2 0 2 2 0 1 0 4 0z"
                                            fill="rgba(0,0,0,1)"></path>
                                    </svg>
                                    <h1 class="capitalize font-semibold text-2xl">Wish list</h1>
                                </div>
                            </div>
                            <p class="border-b-4 border-darkred-50 ml-10 w-2/12 pt-1"></p>

                            <div class="flex flex-col pt-5">
                                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                            Serial
                                                        </th>
                                                        <th scope="col"
                                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                            Image
                                                        </th>

                                                        <th scope="col"
                                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                            Name
                                                        </th>

                                                        <th scope="col"
                                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                            Add to cart
                                                        </th>

                                                        <th scope="col"
                                                            class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                            Action
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    @foreach ($wishlists as $key => $item)
                                                        <tr>
                                                            <td class="text-sm text-gray-900">
                                                                <div class="ml-4">
                                                                    <div class="text-sm font-medium text-gray-900">
                                                                        {{ $key + 1 }}
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-sm text-gray-900">
                                                                <div class="ml-4">
                                                                    <div class="text-sm font-medium text-gray-900">
                                                                        <img width="150 px"
                                                                            src="{{ $item->product->image }}"
                                                                            class="object-contain rounded-full h-14 w-14"
                                                                            alt="No Image">
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td class="text-sm text-gray-900">
                                                                <div class="ml-4">
                                                                    <div class="text-sm font-medium text-gray-900">
                                                                        {{ $item->product->name }}
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td class="text-sm text-gray-900">
                                                                <div class="ml-4">
                                                                    <div class="text-sm font-medium text-gray-900 w-28">
                                                                        <div
                                                                            class="bg-[#09CCD0] duration-100 flex hover:bg-[#ff6a28] items-center px-2 py-1.5 rounded-full space-x-1.5 text-white">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                fill="none" viewBox="0 0 24 24"
                                                                                stroke-width="1.5" stroke="currentColor"
                                                                                class="h-4 w-4">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z">
                                                                                </path>
                                                                            </svg>

                                                                            <a
                                                                                href="{{ route('addToCart', $item->product->id) }}">
                                                                                <button class="text-sm">Add to
                                                                                    cart</button>
                                                                            </a>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td
                                                                class="flex px-8 py-8 space-x-2 text-sm font-medium text-right whitespace-nowrap">
                                                                <a title="Delete"
                                                                    href="{{ route('remove.product.wishlist', $item->id) }}"
                                                                    onclick="return confirm('Are you sure you want to remove it from wishlist?')"
                                                                    class="text-indigo-600 hover:text-indigo-900">
                                                                    <svg class="w-5 h-5 text-red-600" viewBox="0 0 20 20"
                                                                        fill="currentColor">
                                                                        <path fill-rule="evenodd"
                                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                            clip-rule="evenodd" />
                                                                    </svg>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <!-- More people... -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>





    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("delete-btn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@endsection
