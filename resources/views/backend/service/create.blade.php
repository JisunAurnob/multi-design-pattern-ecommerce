@extends('backend.layout.app')
@section('title')
Services Create
@endsection
@section('main')
<form action="{{route('service.store')}}" method="post" class=" px-6 py-6 rounded-md space-y-7" enctype="multipart/form-data">
    @csrf
    <div class="bg-white py-12 rounded-lg shadow-md">
        <div class="px-10">
            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                Name<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input required id="name" value="{{ old('name') }}" name="name" type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Enter type " />
            </div>
            @error('name')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        

        <div class="px-10">
            <label for="image" class="block text-sm leading-5 font-medium text-gray-700">
                Icon  <a class="text-blue-600 underline" href="https://squoosh.app/" target="_blank">Resize here</a> <br>
                <span class="text-black"> The size of height and width should be the same for 1:1 ratio </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="icon" value="{{ old('icon') }}" name="icon" type="file" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Enter category image" />
            </div>
            @error('icon')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>

        <div class="px-10">
            <label for="position" class="block text-sm leading-5 font-medium text-gray-700">
                Position
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="position" value="{{ old('position') }}" name="position" type="number" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Enter type " />
            </div>
            @error('position')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>

        

        

        

        

        <div class="px-10">
            <label for="status" class="block text-sm leading-5 font-medium text-gray-700">
                Status<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <select required name="status" class="form-select appearance-none
                            block
                            w-full
                            px-3
                            py-1.5
                            text-base
                            font-normal
                            text-gray-700
                            bg-white bg-clip-padding bg-no-repeat
                            border border-solid border-gray-300
                            rounded
                            transition
                            ease-in-out
                            m-0
                            focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">

                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>

                </select>
            </div>
            @error('status')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-8 pt-5">
            <div class="flex justify-end">
                <span class="inline-flex rounded-md shadow-sm">
                    <a href="{{route('service.list')}}" class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                        Cancel
                    </a>
                </span>
                <span class="ml-3 inline-flex rounded-md shadow-sm">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                        Save
                    </button>
                </span>
            </div>
        </div>
</form>


@endsection