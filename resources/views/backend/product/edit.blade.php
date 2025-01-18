@extends('backend.layout.app')
@section('title')
Product Edit
@endsection
@section('main')
<style>
    .hasImage:hover section {
        background-color: rgba(5, 5, 5, 0.4);
    }

    .hasImage:hover button:hover {
        background: rgba(5, 5, 5, 0.45);
    }

    #overlay p,
    i {
        opacity: 0;
    }

    #overlay.draggedover {
        background-color: rgba(255, 255, 255, 0.7);
    }

    #overlay.draggedover p,
    #overlay.draggedover i {
        opacity: 1;
    }

    .group:hover .group-hover\:text-blue-800 {
        color: #2b6cb0;
    }
</style>
<form id="product_edit_form" action="{{ route('admin.product.update', $product->slug) }}" method="post" class=" px-6 py-6 rounded-md space-y-7"
    enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="bg-white py-12 rounded-lg shadow-md">
        <div class="px-10">
            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                Name<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input value="{{ $product->name }}" id="name" name="name" type="text"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter type name" />
            </div>
            @error('name')
                <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-10">
            <label for="short_description" class="block text-sm leading-5 font-medium text-gray-700">
                Short Description <span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <textarea id="short_description" name="short_description" type="text"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter Short Description ">{{$product->short_description }}</textarea>
            </div>
            
            @error('short_description')
                <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-10">
            <label for="long_description" class="block text-sm leading-5 font-medium text-gray-700">
                Long Description
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <textarea id="long_description"  name="long_description" type="text"
                    class="ckeditor form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter Long Description "> {{ $product->long_description }} </textarea>
            </div>
            @error('long_description')
                <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-10">
            <label for="price" class="block text-sm leading-5 font-medium text-gray-700">
                Price<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="price" value="{{ $product->price }}" name="price" type="number"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter product price" />
            </div>
            @error('price')
                <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-10">
            <label for="quantity" class="block text-sm leading-5 font-medium text-gray-700">
                Quantity<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="quantity" value="{{ $product->quantity }}" name="quantity" type="number"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter type quantity" />
            </div>
            @error('quantity')
                <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-10">
            <label for="discount" class="block text-sm leading-5 font-medium text-gray-700">
                Discount
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                @if($product->discount_type == 'amount')
                <input id="discount" value="{{ $product->discount['amount'] }}" name="discount" type="number"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter Discount Price " />
                @else
                    <input id="discount" value="{{ $product->discount['percentage'] }}" name="discount" type="number"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter Discount Price " />
                @endif
            </div>
            @error('discount')
                <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-10">
            <label for="discount_type" class="block text-sm leading-5 font-medium text-gray-700">
                Discount Type <span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
            <select class="form-select appearance-none
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
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" name="discount_type" id="">
                <option value="">--Select Type--</option>
                <option @if($product->discount_type=='amount') selected @endif value="amount">Amount</option>
                <option @if($product->discount_type=='percentage') selected @endif value="percentage">Percentage</option>
            </select> 
            </div>
            @error('discount_type')
                <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-10">
            <label for="is_feature" class="block text-sm leading-5 font-medium text-gray-700">
                Feature <span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <select required name="is_feature"
                    class="form-select appearance-none
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
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    aria-label="Default select example">
                    <option value="0"> False </option>
                    <option value="1"> True </option>
                </select>
            </div>
        </div>
        <div class="px-10">
            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                Category<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <select required name="category_id"
                    class="form-select appearance-none
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
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    aria-label="Default select example">
                    <option selected value="">Select Category </option>
                    @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" @if ($cat->id == $product->category_id) selected @endif>{{ $cat->name }}</option>

                            @foreach ($cat->childs as $childCategory)
                                @include('backend.category.child_category', [
                                    'child_category' => $childCategory,
                                    'hi_pen' => $hi_pen,
                                ])
                            @endforeach
                        @endforeach

                </select>
            </div>
            @error('category_id')
                <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-10">
            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                Brand<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <select required name="brand_id"
                    class="form-select appearance-none
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
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    aria-label="Default select example">
                    <option selected value="">Select Brand </option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach

                </select>
            </div>
            @error('brand_id')
                <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>

        <div class="px-10">
            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                Meta Title
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="meta_title" value="{{ $product->meta_title }}" name="meta_title" type="text"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter Meta Title" />
            </div>
            @error('meta_title')
                <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-10">
            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                Meta Description
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <textarea id="meta_description"  name="meta_description"
                    type="text"
                    class="ckeditor form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter Meta Description"> {{ $product->meta_description }} </textarea>
            </div>
            @error('meta_description')
                <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-10">
            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                Minimum Order Quantity
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="min_order_quantity" value="{{ $product->min_order_quantity }}" name="min_order_quantity"
                    type="number"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter Minimum Order Quantity " />
            </div>
            @error('min_order_quantity')
                <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-10">
            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                Maximum Order Quantity
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input id="max_order_quantity" value="{{ $product->max_order_quantity }}" name="max_order_quantity"
                    type="number"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                    placeholder="Enter Maximum Order Quantity " />
            </div>
            @error('max_order_quantity')
                <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <div class="px-10">
            <label for="status" class="block text-sm leading-5 font-medium text-gray-700">
                Status<span class="text-red-600"> * </span>
            </label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <select required name="status"
                    class="form-select appearance-none
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
                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    aria-label="Default select example">

                    <option @if ($product->status == 'Active') selected @endif value="Active">Active</option>
                    <option @if ($product->status == 'Inactive') selected @endif value="Inactive">Inactive</option>
                </select>
            </div>
            @error('status')
                <p class="text-red-600 mt-5">{{ $message }}</p>
            @enderror
        </div>
        <div class="my-4 px-10">
            <label for="image" class="block text-sm leading-5 font-medium text-gray-700">
                Multiple Product Image <span class="text-red-600"> * </span> <a class="text-blue-600 underline"
                    href="https://squoosh.app/" target="_blank">Resize here</a> <br>
                <span class="text-black"> The size of height and width should be the same for 1:1 ratio </span>
            </label>
            <main class="container mx-auto max-w-screen-lg h-full">
                <!-- file upload modal -->
                <article aria-label="File Upload Modal"
                    class="relative h-full flex flex-col bg-white shadow-xl rounded-md" ondrop="dropHandler(event);"
                    ondragover="dragOverHandler(event);" ondragleave="dragLeaveHandler(event);"
                    ondragenter="dragEnterHandler(event);">
                    <!-- overlay -->
                    <div id="overlay"
                        class="w-full h-full absolute top-0 left-0 pointer-events-none z-50 flex flex-col items-center justify-center rounded-md">
                        <i>
                            <svg class="fill-current w-12 h-12 mb-3 text-blue-700" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M19.479 10.092c-.212-3.951-3.473-7.092-7.479-7.092-4.005 0-7.267 3.141-7.479 7.092-2.57.463-4.521 2.706-4.521 5.408 0 3.037 2.463 5.5 5.5 5.5h13c3.037 0 5.5-2.463 5.5-5.5 0-2.702-1.951-4.945-4.521-5.408zm-7.479-1.092l4 4h-3v4h-2v-4h-3l4-4z" />
                            </svg>
                        </i>
                        <p class="text-lg text-blue-700">Drop files to upload</p>
                    </div>

                    <!-- scroll area -->
                    <section class="h-full overflow-auto p-8 w-full h-full flex flex-col">
                        <header
                            class="border-dashed border-2 border-gray-400 py-12 flex flex-col justify-center items-center">
                            <p class="mb-3 font-semibold text-gray-900 flex flex-wrap justify-center">
                                <span>Drag and drop your</span>&nbsp;<span>files in this area or</span>
                            </p>
                            <input id="hidden-input" type="file" multiple class="hidden" />
                            <button id="button"
                                class="mt-2 rounded-sm px-3 py-1 bg-gray-200 hover:bg-gray-300 focus:shadow-outline focus:outline-none"
                                type="button">
                                Upload a file
                            </button>
                        </header>

                        <h1 class="pt-8 pb-3 font-semibold sm:text-lg text-gray-900">
                            Images
                        </h1>

                        <ul id="gallery" class="flex flex-1 flex-wrap -m-1">
                            <li id="empty"
                                class="h-full w-full text-center flex flex-col items-center justify-center items-center @if (count($product->productImages)>0) hidden @endif">
                                <img class="mx-auto w-32"
                                    src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png"
                                    alt="no data" />
                                <span class="text-small text-gray-500">No images</span>
                            </li>

                            @foreach ($product->productImages->reverse() as $product_image)
                            <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-36" id="{{$product_image->id}}">
                                <article tabindex="0"
                                    class="group hasImage w-full h-full rounded-md focus:outline-none focus:shadow-outline bg-gray-100 cursor-pointer relative text-transparent hover:text-white shadow-sm">
                                    <img alt="upload preview"
                                        class="img-preview w-full h-full sticky object-cover rounded-md bg-fixed" src="{{$product_image->image}}" />
            
                                        <section class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                                            <h1 class="flex-1">{{basename($product_image->image)}}</h1>
                                            <div class="flex">
                                                <span class="p-1">
                                                    <i>
                                                        <svg class="fill-current w-4 h-4 ml-auto pt-" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                            <path d="M5 8.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5zm9 .5l-2.519 4-2.481-1.96-4 5.96h14l-5-8zm8-4v14h-20v-14h20zm2-2h-24v18h24v-18z"></path>
                                                        </svg>
                                                    </i>
                                                </span>
                                                <a class="ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md" href="{{route('admin.product.image.delete',$product_image->id)}}" onclick="return confirm('Are you sure you want to delete the image?')">
                                                    <svg class="pointer-events-none fill-current w-4 h-4 ml-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                        <path class="pointer-events-none" d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </section>
                                </article>
                            </li>
                            @endforeach
                        </ul>
                    </section>

                    <!-- sticky footer -->
                    {{-- <footer class="flex justify-end px-8 pb-8 pt-4">
                        <button id="submit"
                            class="rounded-sm px-3 py-1 bg-blue-700 hover:bg-blue-500 text-white focus:shadow-outline focus:outline-none">
                            Upload now
                        </button>
                        <button id="cancel"
                            class="ml-3 rounded-sm px-3 py-1 hover:bg-gray-300 focus:shadow-outline focus:outline-none">
                            Cancel
                        </button>
                    </footer> --}}
                </article>
            </main>

            <template id="file-template">
                <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
                    <article tabindex="0"
                        class="group w-full h-full rounded-md focus:outline-none focus:shadow-outline elative bg-gray-100 cursor-pointer relative shadow-sm">
                        <img alt="upload preview"
                            class="img-preview hidden w-full h-full sticky object-cover rounded-md bg-fixed" />

                        <section
                            class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                            <h1 class="flex-1 group-hover:text-blue-800"></h1>
                            <div class="flex">
                                <span class="p-1 text-blue-800">
                                    <i>
                                        <svg class="fill-current w-4 h-4 ml-auto pt-1"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path d="M15 2v5h5v15h-16v-20h11zm1-2h-14v24h20v-18l-6-6z" />
                                        </svg>
                                    </i>
                                </span>
                                <p class="p-1 size text-xs text-gray-700"></p>
                                <button
                                    class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md text-gray-800">
                                    <svg class="pointer-events-none fill-current w-4 h-4 ml-auto"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path class="pointer-events-none"
                                            d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                                    </svg>
                                </button>
                            </div>
                        </section>
                    </article>
                </li>
            </template>

            <template id="image-template">
                <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-36">
                    <article tabindex="0"
                        class="group hasImage w-full h-full rounded-md focus:outline-none focus:shadow-outline bg-gray-100 cursor-pointer relative text-transparent hover:text-white shadow-sm">
                        <img alt="upload preview"
                            class="img-preview w-full h-full sticky object-cover rounded-md bg-fixed" />

                        <section
                            class="flex flex-col rounded-md text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
                            <h1 class="flex-1"></h1>
                            <div class="flex">
                                <span class="p-1">
                                    <i>
                                        <svg class="fill-current w-4 h-4 ml-auto pt-"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M5 8.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5zm9 .5l-2.519 4-2.481-1.96-4 5.96h14l-5-8zm8-4v14h-20v-14h20zm2-2h-24v18h24v-18z" />
                                        </svg>
                                    </i>
                                </span>

                                <p class="p-1 size text-xs"></p>
                                <button class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-md">
                                    <svg class="pointer-events-none fill-current w-4 h-4 ml-auto"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path class="pointer-events-none"
                                            d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
                                    </svg>
                                </button>
                            </div>
                        </section>
                    </article>
                </li>
            </template>
        </div>
        <div class="mt-8 pt-5 px-10">
            <div class="flex justify-end">
                <span class="inline-flex rounded-md shadow-sm">
                    <a href="{{ route('admin.product.list') }}"
                        class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                        Cancel
                    </a>
                </span>
                <span class="ml-3 inline-flex rounded-md shadow-sm">
                    <button id="submit" type="submit"
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
        const fileTempl = document.getElementById("file-template"),
            imageTempl = document.getElementById("image-template"),
            empty = document.getElementById("empty");

        // use to store pre selected files
        let FILES = {};

        // check if file is of type image and prepend the initialied
        // template to the target element
        function addFile(target, file) {
            const isImage = file.type.match("image.*"),
                objectURL = URL.createObjectURL(file);

            const clone = isImage ?
                imageTempl.content.cloneNode(true) :
                fileTempl.content.cloneNode(true);

            clone.querySelector("h1").textContent = file.name;
            clone.querySelector("li").id = objectURL;
            clone.querySelector(".delete").dataset.target = objectURL;
            clone.querySelector(".size").textContent =
                file.size > 1024 ?
                file.size > 1048576 ?
                Math.round(file.size / 1048576) + "mb" :
                Math.round(file.size / 1024) + "kb" :
                file.size + "b";

            isImage &&
                Object.assign(clone.querySelector("img"), {
                    src: objectURL,
                    alt: file.name
                });

            empty.classList.add("hidden");
            target.prepend(clone);

            FILES[objectURL] = file;
        }


        const gallery = document.getElementById("gallery"),
            overlay = document.getElementById("overlay");

        // click the hidden input of type file if the visible button is clicked
        // and capture the selected files
        const hidden = document.getElementById("hidden-input");
        document.getElementById("button").onclick = () => hidden.click();
        hidden.onchange = (e) => {
            for (const file of e.target.files) {
                addFile(gallery, file);
            }
        };

        // use to check if a file is being dragged
        const hasFiles = ({
                dataTransfer: {
                    types = []
                }
            }) =>
            types.indexOf("Files") > -1;

        // use to drag dragenter and dragleave events.
        // this is to know if the outermost parent is dragged over
        // without issues due to drag events on its children
        let counter = 0;

        // reset counter and append file to gallery when file is dropped
        function dropHandler(ev) {
            ev.preventDefault();
            for (const file of ev.dataTransfer.files) {
                addFile(gallery, file);
                overlay.classList.remove("draggedover");
                counter = 0;
            }
        }

        // only react to actual files being dragged
        function dragEnterHandler(e) {
            e.preventDefault();
            if (!hasFiles(e)) {
                return;
            }
            ++counter && overlay.classList.add("draggedover");
        }

        function dragLeaveHandler(e) {
            1 > --counter && overlay.classList.remove("draggedover");
        }

        function dragOverHandler(e) {
            if (hasFiles(e)) {
                e.preventDefault();
            }
        }

        // event delegation to caputre delete events
        // fron the waste buckets in the file preview cards
        gallery.onclick = ({
            target
        }) => {
            if (target.classList.contains("delete")) {
                const ou = target.dataset.target;
                document.getElementById(ou).remove(ou);
                gallery.children.length === 1 && empty.classList.remove("hidden");
                delete FILES[ou];
            }
        };

        document.getElementById("submit").onclick = (event) => {
            event.preventDefault();
            var url = document.getElementById("product_edit_form").action;

            // const formData = new FormData(); // Create FormData object
            const formData = new FormData(document.getElementById("product_edit_form"));

            const inputFields = document.querySelectorAll('input');

            // Iterate over input fields and append their values to FormData
            inputFields.forEach(input => {
                if (input.type !== 'file') { // Exclude file input fields
                    formData.append(input.name, input.value);
                }
            });

            // Iterate over FILES object and append each file to FormData
            for (const key in FILES) {
                formData.append('multiple_images[]', FILES[key]);
            }
            var editorContent = editor.getData();
            formData.set('long_description', editorContent);
            // Now, you can submit formData to the server using fetch API or XMLHttpRequest
            fetch(url, {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json(); // Parse response body as JSON
                })
                .then(response => {
                    if (response?.validation_error) {
                        // console.log(response?.validation_error);
                        document.querySelectorAll('.validation-error').forEach(element => {
                            element.parentNode.removeChild(element);
                        });
                        var keys = "";
                        Object.entries(response.validation_error).forEach(([field_name, error]) => {
                            // Split field name by '.' to handle nested fields
                            const keys = field_name.split('.');

                            // Check if field name contains nested keys
                            if (keys.length > 1) {
                                const fieldName = keys[0] + "[" + keys[1] + "]" + "[" + keys[2] + "]" + "";
                                const fieldElement = document.querySelector('[name="' + fieldName + '"]');
                                if (fieldElement) {
                                    const parentElement = fieldElement.parentElement.parentElement;
                                    const errorElement = document.createElement('span');
                                    errorElement.className = "font-bold text-red-600 px-10 mb-4 validation-error";
                                    errorElement.textContent = error;
                                    parentElement.parentNode.insertBefore(errorElement, parentElement
                                        .nextSibling);
                                }
                            } else {
                                const fieldElement = document.querySelector('[name="' + field_name + '"]');
                                if (fieldElement) {
                                    const parentElement = fieldElement.parentElement.parentElement;
                                    const errorElement = document.createElement('span');
                                    errorElement.className = "font-bold text-red-600 px-10 mb-4 validation-error";
                                    errorElement.textContent = error;
                                    parentElement.parentNode.insertBefore(errorElement, parentElement
                                        .nextSibling);
                                }
                            }
                        });
                    } else if (response?.success) {
                        window.location.href = response?.data;
                    }
                })
                .catch(error => {
                    // Handle error
                    console.log(error);
                });
        };


        // clear entire selection
        document.getElementById("cancel").onclick = () => {
            while (gallery.children.length > 0) {
                gallery.lastChild.remove();
            }
            FILES = {};
            empty.classList.remove("hidden");
            gallery.append(empty);
        };
    </script>
@endpush