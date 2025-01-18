@extends('backend.layout.app')
@section('title')
New Customer Create
@endsection
@section('main')
<form action="{{route('customer.store')}}" method="post" class=" px-6 py-6 rounded-md space-y-7" enctype="multipart/form-data">
    @csrf
    <div class="bg-white py-12 rounded-lg shadow-md">
        <div class="px-10">
            <label for="first_name" class="block text-sm leading-5 font-medium text-gray-700">
               First Name<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input required id="first_name" value="{{ old('first_name') }}" name="first_name" type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Enter First Name " />
            </div>
            @error('first_name')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-10">
            <label for="last_name" class="block text-sm leading-5 font-medium text-gray-700">
               Last Name<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input required id="last_name" value="{{ old('last_name') }}" name="last_name" type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Enter Last Name " />
            </div>
            @error('last_name')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <!-- <div class="px-10">
            <label for="business_name" class="block text-sm leading-5 font-medium text-gray-700">
               Business Name<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="business_name" value="{{ old('business_name') }}" name="business_name" type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Enter Business Name " />
            </div>
            @error('business_name')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div> -->
        <div class="px-10">
            <label for="email" class="block text-sm leading-5 font-medium text-gray-700">
                Email 
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="email" value="{{ old('email') }}" name="email" type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Enter Your Email " />
            </div>
            @error('email')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-10">
            <label for="phone" class="block text-sm leading-5 font-medium text-gray-700">
                Phone 
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="phone" value="{{ old('phone') }}" name="phone" type="tel" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"  />
            </div>
            @error('phone')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-10">
                <label for="password" class="block text-sm leading-5 font-medium text-gray-700">
                    Password<span class="text-red-600"> * </span>
                </label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <input required id="password" name="password" type="password"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                        placeholder="Enter password" />
                </div>
                @error('password')
                    <p class="text-red-600 mt-5">{{ $message }}</p>
                @enderror
        </div>

        <div class="px-10">
            <label for="image" class="block text-sm leading-5 font-medium text-gray-700">
                Image <a class="text-blue-600 underline" href="https://squoosh.app/" target="_blank">Resize here</a> <br>
                <span class="text-black"> The size of height and width should be the same for 1:1 ratio </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="image" value="{{ old('image') }}" name="image" type="file" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" >
            </div>
            @error('image')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-10">
            <label for="address" class="block text-sm leading-5 font-medium text-gray-700">
                Address 
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="address" value="{{ old('address') }}" name="address" type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Enter Your Address " />
            </div>
            @error('address')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="px-10">
            <label for="date_of_birth" class="block text-sm leading-5 font-medium text-gray-700">
                Date Of Birth 
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="date_of_birth" value="{{ old('date_of_birth') }}" name="date_of_birth" type="date" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" />
            </div>
            @error('date_of_birth')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-10">
            <label for="remarks" class="block text-sm leading-5 font-medium text-gray-700">
                Remarks
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="remarks" value="{{ old('remarks') }}" name="remarks" type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Remarks " />
            </div>
            @error('remarks')
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

                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>

                </select>
            </div>
            @error('status')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-8 pt-5">
            <div class="flex justify-end">
                <span class="inline-flex rounded-md shadow-sm">
                    <a href="{{route('customer.list')}}" class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
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