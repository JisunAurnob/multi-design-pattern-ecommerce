@extends('frontend.master')
@section('content')
    <section class=" md:max-w-xl w-full mx-auto md:px-10 p-5 py-20 md:space-x-7 loginMobile">
        <h1 class="text-xl mb-7 text-center">Sign in to your Account</h1>
        <div class="border p-7 rounded-md shadow-md">
            <!-- <h2 class="text-lg font-medium text-gray-900">Delivery Address</h2> -->
            <form action="{{ route('user.login.post') }}" method="POST">
                @csrf
                <div class="gap-y-4 grid grid-cols-1 mt-2 sm:gap-x-4 sm:grid-cols-2">


                    <div class="sm:col-span-2">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email or Phone</label>
                        <div class="mt-1">
                            <input type="text" name="user_input" id="user_input"
                                placeholder="Enter your email or phone number"
                                class="block border border-gray-300 focus:outline-emerald-600 focus:ring-indigo-500 px-4 py-[10px] rounded-md shadow-sm sm:text-sm w-full" />
                        </div>
                        @error('user_input')
                            <span class="text-red-600 text-sm ml-1 mt-1">{{ $message }}</span>
                        @enderror
                    </div>





                    <div class="sm:col-span-2">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password </label>
                        <div class="mt-1">
                            <input type="password" name="password" id="password" autocomplete="tel"
                                class="block border border-gray-300 focus:outline-emerald-600 focus:ring-indigo-500 px-4 py-[10px] rounded-md shadow-sm sm:text-sm w-full" />
                        </div>
                        @error('password')
                            <span class="text-red-600 text-sm ml-1 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="sm:col-span-2 flex justify-between forgotInfo">
                        <div>
                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                            <label class="form-check-label" for="form2Example3">
                                Remember me
                            </label>
                        </div>

                        <a href="{{ route('user.reset.password.form') }}" class="text-red-500"> Forgot
                            Password?</a>
                    </div>
                    <button type="submit"
                        class="max-w-xs flex-1 bg-[#ff6a28] border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500 sm:w-full">
                        Sign In
                    </button>
                    <p class="text-red-600 pt-2 text-sm">Don't have an account yet? <a href="{{ route('user.register') }}"
                            class="fw-bold text-body"><u> Sign Up</u></a></p>

                </div>
            </form>
        </div>



    </section>
@endsection
