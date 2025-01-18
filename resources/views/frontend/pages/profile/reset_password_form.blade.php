@extends('frontend.master')
@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <img class="mx-auto h-20 w-auto" src="{{ $settings->logo }}" alt="logo" />
        <h2 class="mt-6 text-center text-xl leading-3 font-bold text-gray-900">
            Reset your password
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form action="{{ route('user.reset.password.post', $token) }}" method="POST">
                @csrf
                <div>
                    <label for="dob" class="block text-sm font-medium leading-5 text-gray-700">New Password<span
                            class="text-red-600">*</span></label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input id="password" name="password" type="password" value="{{ old('password') }}"
                            placeholder="Enter your new password"
                            class="form-control block w-full px-3  py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                       rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" />
                        @error('password')
                        <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium leading-5 text-gray-700">Confirm
                        Password<span class="text-red-600">*</span></label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            value="{{ old('password_confirmation') }}" placeholder="Enter your confirm password" class="form-control
                        block
                        w-full
                        px-3
                        py-1.5
                        text-base
                        font-normal
                        text-gray-700
                        bg-white bg-clip-padding
                        border border-solid border-gray-300
                        rounded
                        transition
                        ease-in-out
                        m-0
                        focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" />
                        @error('password_confirmation')
                        <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-[#ff6a28] hover:bg-[#ff5b1f] focus:outline-none focus:border-[#ff9e5e] focus:shadow-outline-[#ff9e5e] active:bg-[#ff9e5e] transition duration-150 ease-in-out">
                            Submit
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