@extends('backend.layout.app')
@section('title')
Shipping Charge Update
@endsection
@section('main')
<form action="{{route('shipping.update', $data->id)}}" method="post" class=" px-6 py-6 rounded-md space-y-7"
    enctype="multipart/form-data">
    @csrf
    <div class="bg-white py-12 rounded-lg shadow-md grid grid-cols-2">

        <div class="px-10 mb-2">
            <label for="location" class="block text-sm leading-5 font-medium text-gray-700">
                Location<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="location" value="{{$data->location}}" name="location" type="text"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter location " />
            </div>
            @error('location')<p class="text-red-600 mt-5">{{$message}}</p>@enderror
        </div>


        <div class="px-10 mb-2">
            <label for="amount" class="block text-sm leading-5 font-medium text-gray-700">
                Amount<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="amount" value="{{$data->amount}}" name="amount" type="number"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter amount " />
            </div>
            @error('amount')<p class="text-red-600 mt-5">{{$message}}</p>@enderror
        </div>
      
    </div>
    <div class="mt-8 pt-5">
        <div class="flex justify-end">
            <span class="inline-flex rounded-md shadow-sm">
                <a href="{{route('shipping.index')}}"
                    class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                    Cancel
                </a>
            </span>
            <span class="ml-3 inline-flex rounded-md shadow-sm">
                <button type="submit"
                    class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                    Save
                </button>
            </span>
        </div>
    </div>
</form>
@endsection

