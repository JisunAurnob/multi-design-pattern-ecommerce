@extends('backend.layout.app')
@section('title')
Category Create
@endsection
@section('main')
<form action="{{route('admin.category.store')}}" method="post" class=" px-6 py-6 rounded-md space-y-7"
    enctype="multipart/form-data">
    @csrf
    <div class="bg-white py-12 rounded-lg shadow-md grid grid-cols-2">
        <div class="px-10 mb-2">
            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                Name<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="name" value="{{old('name')}}" name="name" type="text"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter category name" />
            </div>
            @error('name')<p class="text-red-600 mt-5">{{$message}}</p>@enderror
        </div>
        <div class="px-10 mb-2">
            <label for="category_slug" class="block text-sm leading-5 font-medium text-gray-700">
                Slug<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="category_slug" value="{{old('category_slug')}}" name="category_slug" type="text"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Category Slug" />
            </div>
            @error('category_slug')<p class="text-red-600 mt-5">{{$message}}</p>@enderror
        </div>

        <div class="px-10 mb-2">
            <label for="parent" class="block text-sm leading-5 font-medium text-gray-700">
                Select Parent<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">

            <select name="parent_id" class="form-select appearance-none
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
                            <option value="">-- Select Option --</option>
                            @foreach ($categories as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                            
                                @foreach ($cat->childs as $childCategory)
                                    @include('backend.category.child_category', ['child_category' => $childCategory, 'hi_pen' => $hi_pen])
                                @endforeach
                            
                            @endforeach

                </select>

              
            </div>
           
        </div>

        <div class="px-10 mb-2">
            <label for="image" class="block text-sm leading-5 font-medium text-gray-700">
                Image<span class="text-red-600"> * </span>  <a class="text-blue-600 underline" href="https://squoosh.app/" target="_blank">Resize here</a>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="image" value="{{old('image')}}" name="image" type="file"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter category image" />
            </div>
            @error('image')<p class="text-red-600 mt-5">{{$message}}</p>@enderror
        </div>
        <div class="px-10 mb-2">
            <label for="description" class="block text-sm leading-5 font-medium text-gray-700">
                Category Description
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <textarea id="description" value="{{ old('description') }}" 
                name="description" type="text" 
                class="ckeditor form-control block w-full px-3 py-1.5 h-12 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" 
                placeholder="Enter Category Description" rows="6"></textarea>
            </div>
            @error('description')
            <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-10 mb-2">
            <label for="status" class="block text-sm leading-5 font-medium text-gray-700">
                Status<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">

            <select name="status" class="form-select appearance-none
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
                           <option selected value="active">Active</option>
                           <option value="inactive">Inactive</option>
                           <option value="draft">Draft</option>

                </select>

              
            </div>
           
        </div>
    </div>
    <div class="mt-8 pt-5">
        <div class="flex justify-end">
            <span class="inline-flex rounded-md shadow-sm">
                <a href="{{route('admin.category.list')}}"
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

@push('js')
<script>
document.getElementById("name").addEventListener("keyup", function() {
    var categoryInput = document.getElementById("name");
    var category_name = categoryInput.value;
    console.log(category_name);
    
    category_name = category_name.replace(/[^A-Z0-9]+/ig, '-').replace(/(^[^\w]+|[^\w]+$)/g, '').toLowerCase();
    
    document.getElementById("category_slug").value = category_name;
});
</script>
@endpush