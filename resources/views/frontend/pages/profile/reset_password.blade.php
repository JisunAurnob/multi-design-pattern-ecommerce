@extends('frontend.master')
@section('content')



<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <img class="mx-auto h-20 w-auto rounded" src="{{$settings->logo}}" alt="logo" />       
         <h2 class="mt-6 text-center text-3xl leading-3 font-bold text-gray-900">
            Reset your password
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form action="{{route('user.reset.password.contact')}}" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                        Enter Email <span class="text-red-800"> *</span>
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input placeholder="Enter your email" id="email" name="email" type="email"
                               value="{{old('email')}}"
                               required
                               class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"/>
                    </div>
                    @error('email')
                    <span class="text-red-600 text-sm ml-1 mt-1">{{$message}}</span>
                    @enderror
                </div>

                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-[#ff6a28] hover:bg-[#ff5b1f] focus:outline-none focus:border-[#ff9e5e] focus:shadow-outline-[#ff9e5e] active:bg-[#ff9e5e] transition duration-150 ease-in-out">
                            Submit to get reset link
                        </button>
                        <a href="{{route('user.login')}}"
                           class="mt-2 w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-[#ff6a28] hover:bg-[#ff5b1f] focus:outline-none focus:border-[#ff9e5e] focus:shadow-outline-[#ff9e5e] active:bg-[#ff9e5e] transition duration-150 ease-in-out">
                            Back
                        </a>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection