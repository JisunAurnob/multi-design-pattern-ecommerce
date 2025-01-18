@extends('frontend.master')
@section('content')

<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
   
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        {{-- <img class="mx-auto h-20 w-auto" src="{{ $settings->logo }}" alt="logo" /> --}}
        <h2 class="mt-6 text-center text-3xl leading-3 font-bold text-gray-900">
           Rate this product
        </h2>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form action="{{route('review.rate.post', ['order_details_id' => $order_details_id, 'product_id' => $product_id] )}}" method="POST">
                @csrf
                <div>
                    <label for="rate" class="block text-sm font-medium leading-5 text-gray-700">
                        Rate<span class="text-red-800"> *</span>
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input min="0" max="5" placeholder="Rate between 0-5" id="rate" name="rate" type="number"
                            value="{{old('rate')}}" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                        @error('rate')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <label for="review" class="block text-sm font-medium leading-5 text-gray-700">Review
                        </label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input id="review" name="review" type="text" value="{{ old('review') }}"
                            placeholder="Review about the product"
                            class="form-control block w-full h-20 px-3  py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                            rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" />
                        @error('review')
                            <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-500 hover:bg-[#ff5b1f] focus:outline-none focus:border-[#ff9e5e] focus:shadow-outline-[#ff9e5e] active:bg-[#ff9e5e] transition duration-150 ease-in-out">
                            Submit
                            </button>

                            <a href="{{ route('view.order', $order_number) }}"
                                class="mt-2 w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-[#ff6a28] hover:bg-[#ff5b1f] focus:outline-none focus:border-[#ff9e5e] focus:shadow-outline-[#ff9e5e] active:bg-[#ff9e5e] transition duration-150 ease-in-out">
                                Cancel
                            </a>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection