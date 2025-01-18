@extends('frontend.master')
@section('content')


<section class="md:max-w-xl w-full mx-auto md:px-10 px-3 py-20 md:space-x-7 loginMobile">
    <h1 class="text-xl mb-7 text-center">Registration</h1>
    <div class="border p-7 rounded-md shadow-md">
        <!-- <h2 class="text-lg font-medium text-gray-900">Delivery Address</h2> -->
        <form action="{{route('user.registration')}}" method="POST">
            @csrf
            <div class="gap-y-4 grid grid-cols-1 mt-2 sm:gap-x-4 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <div class="mt-1">
                        <input type="text" name="name" required id="name" autocomplete="name" value="{{old('name')}}"
                            placeholder="Enter your name"
                            class="block border border-gray-300 focus:outline-emerald-600 focus:ring-indigo-500 px-4 py-[10px] rounded-md shadow-sm sm:text-sm w-full" />
                    </div>
                    @error('name')
                    <span class="text-red-600 text-sm ml-1 mt-1">{{$message}}</span>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="mt-1">
                        <input type="email" name="email" id="email" autocomplete="email" placeholder="Enter your email" value="{{old('email')}}"
                            class="block border border-gray-300 focus:outline-emerald-600 focus:ring-indigo-500 px-4 py-[10px] rounded-md shadow-sm sm:text-sm w-full" />
                    </div>
                    @error('email')
                    <span class="text-red-600 text-sm ml-1 mt-1">{{$message}}</span>
                    @enderror
                </div>



                <div class="sm:col-span-2">
                    <label for="phone" class="block text-sm font-medium text-gray-700">Or Phone</label>
                    <div class="mt-1">
                        <input type="tel" name="phone" id="phone" placeholder="Enter your phone number" value="{{old('phone')}}"
                            autocomplete="tel"
                            class="block border border-gray-300 focus:outline-emerald-600 focus:ring-indigo-500 px-4 py-[10px] rounded-md shadow-sm sm:text-sm w-full" />
                    </div>
                    @error('phone')
                    <span class="text-red-600 text-sm ml-1 mt-1">{{$message}}</span>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password (Min:6
                        digits)</label>
                    <div class="mt-1">
                        <input type="password" name="password" id="password"
                            class="block border border-gray-300 focus:outline-emerald-600 focus:ring-indigo-500 px-4 py-[10px] rounded-md shadow-sm sm:text-sm w-full" />
                    </div>
                    @error('password')
                    <span class="text-red-600 text-sm ml-1 mt-1">{{$message}}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="max-w-xs flex-1 bg-[#ff6a28] border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500 sm:w-full">
                    Sign Up
                </button>
                <p class="text-red-600 pt-2 text-sm">Have already an account? <a href="{{route('user.login')}}"
                        class="fw-bold text-body"><u> Sign in</u></a></p>

            </div>
        </form>
    </div>



</section>

@endsection