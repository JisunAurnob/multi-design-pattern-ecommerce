@extends('backend.layout.app')
@section('title')
 Customer Edit 
@endsection
@section('main')
<form action="{{route('customer.update',$customers->id)}}" method="post" class=" px-6 py-6 rounded-md space-y-7" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="bg-white py-12 rounded-lg shadow-md">
        <div class="px-10">
            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                Name<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="name" value="{{$customers->name}}" name="name" type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Enter First Name " />
            </div>
            @error('name')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <!-- <div class="px-10">
            <label for="last_name" class="block text-sm leading-5 font-medium text-gray-700">
               Last Name<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="last_name" value="{{$customers->last_name}}" name="last_name" type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Enter Last Name " />
            </div>
            @error('last_name')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div> -->
        <!-- <div class="px-10">
            <label for="business_name" class="block text-sm leading-5 font-medium text-gray-700">
               Business Name<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="business_name" value="{{$customers->business_name}}" name="business_name" type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Enter Business Name " />
            </div>
            @error('business_name')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div> -->
        <div class="px-10">
            <label for="email" class="block text-sm leading-5 font-medium text-gray-700">
                Email <span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input readonly id="email" value="{{$customers->email}}" name="email" type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-gray-200 bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Enter Your Email " />
            </div>
            @error('email')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-10">
            <label for="phone" class="block text-sm leading-5 font-medium text-gray-700">
                Phone <span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input readonly id="phone" value="{{$customers->phone}}" name="phone" type="tel" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-gray-200 bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"  />
            </div>
            @error('phone')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
       

        <div class="px-10">
            <label for="image" class="block text-sm leading-5 font-medium text-gray-700">
                Image <span class="text-red-600"> * </span> <a class="text-blue-600 underline" href="https://squoosh.app/" target="_blank">Resize here</a> <br>
                <span class="text-black"> The size of height and width should be the same for 1:1 ratio </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="image" value="{{$customers->image}}" name="image" type="file" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Enter category image" />
            </div>
            @error('image')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <!-- <div class="px-10">
            <label for="address" class="block text-sm leading-5 font-medium text-gray-700">
                Address <span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="address" value="{{$customers->address}}" name="address" type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Enter Your Address " />
            </div>
            @error('address')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div> -->
        <!-- <div class="px-10">
            <label for="date_of_birth" class="block text-sm leading-5 font-medium text-gray-700">
                Date Of Birth <span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="date_of_birth" value="{{$customers->date_of_birth}}" name="date_of_birth" type="date" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"/>
            </div>
            @error('date_of_birth')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div> -->
        <div class="px-10">
            <label for="remarks" class="block text-sm leading-5 font-medium text-gray-700">
                Remarks <span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="remarks" value="{{$customers->remarks}}" name="remarks" type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Remarks " />
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

                    <option @if($customers->status=='active') selected @endif value="active">Active</option>
                    <option @if($customers->status=='inactive') selected @endif value="inactive">Inactive</option>

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