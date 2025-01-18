@extends('frontend.master')
@section('content')
    <!-- banner section -->
    <div class="h-[280px] relative text-white"
        style="
        background-image: url(data:image/jpeg;base64,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);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        z-index:9;
        /* height: 600px; */
      ">
        <div class="absolute bottom-0 h-full left-0 w-full bg-gray-800 opacity-75"></div>
        <div class="container flex h-full items-center justify-center max-w-7xl mx-auto relative z-10">
            <div class="text-white transform">
                <h1 class="capitalize font-medium mb-5 md:text-4xl text-3xl tracking-tight">
                    @if (request()->has('categoryName'))
                        Kids
                    @else
                        All products
                    @endif

                </h1>
            </div>
        </div>
    </div>
    <!-- all product section design -->
    <section class="bg-[#F3FFFF]">
        <div class="max-w-7xl mx-auto md:px-10 sm:px-8 px-2 py-10 homeProduct">
            <div class="flex">
                <aside class="w-[18%] aside">
                    <h2 class="sr-only">Filters</h2>

                    <div class="hidden lg:block">
                        <form class="divide-y divide-gray-200 space-y-10">
                            <div class="pt-10">
                                <fieldset>
                                    {{-- @dd($categories->toArray()) --}}
                                    <legend class="block text-sm font-medium text-gray-900">Category</legend>
                                    <div class="pt-6 space-y-3">
                                        @foreach ($categories as $cat)
                                            <div class="flex items-center">
                                                <input id="{{ $cat->slug }}" name="category[]"
                                                    value="{{ $cat->id }}" type="checkbox"
                                                    class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500" />
                                                <label for="{{ $cat->slug }}" class="ml-3 text-sm text-gray-600">
                                                    {{ $cat->name }}
                                                </label>
                                            </div>
                                            @if ($cat->childs->count() > 0)
                                                @foreach ($cat->childs as $childCategory)
                                                    @include('frontend.components.checkbox_subcategories', [
                                                        'child_category' => $childCategory,
                                                    ])
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                </fieldset>
                            </div>
                        </form>
                    </div>
                </aside>

                <section aria-labelledby="product-heading" class="mt-6 lg:mt-0 lg:col-span-2 xl:col-span-3 sortMain w-full">
                    <div class="border-b-0 flex justify-between mb-10 sortSection">
                        <div class="flex sortingDiv">
                            <div class="md:flex md:flex-start space-x-3 sortSelect whitespace-nowrap mr-4">
                                <p class="py-2 capitalize hover:text-[rgb(226,28,33)] font-light text-base">
                                    Sort by:
                                </p>
                                <select name="sortby"
                                    class="py-2 block w-full rounded-md border-gray-300 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm selectsorting">
                                    <option value="default" @if (request()->query('sort') == 'default') selected @endif>Default
                                    </option>
                                    <option value="asc" @if (request()->query('sort') == 'asc') selected @endif>Name: (A-Z)
                                    </option>
                                    <option value="desc" @if (request()->query('sort') == 'desc') selected @endif>Name: (Z-A)
                                    </option>
                                    <option value="low" @if (request()->query('sort') == 'low') selected @endif>Price L to H
                                    </option>
                                    <option value="high" @if (request()->query('sort') == 'high') selected @endif>Price H to L
                                    </option>
                                </select>
                            </div>
                            <div class="md:flex md:flex-start space-x-3 sortSelect whitespace-nowrap">
                                <p class="py-2 capitalize hover:text-[rgb(226,28,33)] font-light text-base">
                                    Show:
                                </p>
                                <select name="show"
                                    class="py-2 block w-full rounded-md border-gray-300 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm selectsorting">
                                    <option value="12" @if (request()->query('show') == 12) selected @endif>12</option>
                                    <option value="24" @if (request()->query('show') == 24) selected @endif>24</option>
                                    <option value="36" @if (request()->query('show') == 36) selected @endif>36</option>
                                    <option value="48" @if (request()->query('show') == 48) selected @endif>48</option>
                                    <option value="60" @if (request()->query('show') == 60) selected @endif>60</option>
                                </select>
                            </div>
                        </div>
                        <p class="foundproduct"><span class="font-bold pr-2 ">'{{ count($products) }}'</span>products found
                        </p>
                    </div>

                    <p class="mx-auto foundproductn mb-2"><span
                            class="font-bold pr-2 ">'{{ count($products) }}'</span>products found</p>

                    <div class="md:gap-6 gap-3 grid grid-cols-2 md:grid-cols-3 lg:px-6 lg:pb-6">
                        @foreach ($products as $product)
                            @include('frontend.components.product-card', ['product' => $product])
                        @endforeach

                    </div>
                </section>
            </div>
        </div>
        <div class="container px-16 max-w-7xl mx-auto sm:px-2 lg:px-2 py-3">
            <div class="flex items-center justify-center py-10 lg:px-0 sm:px-6 px-4">
                <div class="lg:w-3/5 w-full flex items-center justify-between border-t border-gray-200">
                    {{-- <div class="flex items-center pt-3 text-gray-600 hover:text-[rgb(226,28,33)] cursor-pointer">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20"
                            aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-sm ml-3 font-medium leading-none">Previous</p>
                    </div>
                    <div class="sm:flex hidden">
                        <p
                            class="text-sm font-medium leading-none cursor-pointer text-[rgb(226,28,33)] border-[rgb(226,28,33)] pt-3 mr-4 px-2 border-t">
                            1
                        </p>
                        <p
                            class="text-sm font-medium leading-none cursor-pointer text-gray-600 hover:text-[rgb(226,28,33)] border-transparent hover:border-[rgb(226,28,33)] pt-3 mr-4 px-2 border-t">
                            2
                        </p>
                        <p
                            class="text-sm font-medium leading-none cursor-pointer text-gray-600 hover:text-[rgb(226,28,33)] border-transparent hover:border-[rgb(226,28,33)] pt-3 mr-4 px-2 border-t">
                            3
                        </p>
                    </div>
                    <div class="flex items-center pt-3 text-gray-600 cursor-pointer">
                        <p class="text-sm font-medium leading-none mr-3">Next</p>
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20"
                            aria-hidden="true" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
    <!-- new arrivals -->
    @if ($products->count() > 1)
        <section class="bg-[#F7FAFC] py-10">
            <div class="lg:px-8 max-w-7xl mx-auto px-2 py-2 sm:px-6">
                <!-- heading icon -->
                <div class="border-b border-gray-500 mb-5 mx-auto relative w-32">
                    <img class="absolute bg-[#F3FFFF] border border-gray-500 bottom-[-22px] h-10 left-0 m-auto p-1.5 right-0 rounded-full w-10"
                        src="{{ url('/frontend/image/icon3.webp') }}" alt="" />
                </div>
                <h1
                    class="antialiased capitalize font-bold mb-5 md:text-2xl text text-center text-deep-sapphire-600 tracking-wide">
                    New arrivals
                </h1>

                <div class="md:flex all-productPageMainP space-x-3">
                    <article
                        class="hidden lg:block md:w-3/12 block duration-300 hover:scale-105 hover:shadow-xl hover:transform rounded-md shadow-lg  newarrivalpromo">
                        <img src="{{ url('/placeholder/poster/p1.jpeg') }}" alt=""
                            class=" h-full w-full" />
                    </article>
                    <div class="lg:w-9/12 w-full all-productPage">
                        <div class="slider">

                            @foreach ($products->take(8) as $product)
                                @include('frontend.components.product-card', ['product' => $product])
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Attach change event listener to both select boxes
            $('select[name="sortby"], select[name="show"]').change(function() {
                // Get the selected values
                var sortBy = $('select[name="sortby"]').val();
                var show = $('select[name="show"]').val();

                // Construct the query parameters
                var queryParams = '?sort=' + sortBy + '&show=' + show;

                // Reload the page with the query parameters
                window.location.href = window.location.pathname + queryParams;
            });

            // Function to update query parameter
            function updateQueryParam() {
                var selectedCategories = $('input[name="category[]"]:checked').map(function() {
                    return $(this).val();
                }).get().join('|');

                // Check if any categories are selected
                if (selectedCategories !== '') {
                    // Update query parameter
                    var queryParams = '?category=' + selectedCategories;
                    // Reload the page with the updated query parameter
                    window.location.href = window.location.pathname + queryParams;
                } else {
                    // If no categories are selected, remove the 'category' query parameter
                    window.location.href = window.location.pathname;
                }
            }

            // Attach click event listener to checkboxes
            $('input[name="category[]"]').click(function() {
                updateQueryParam();
            });
            // Check checkboxes based on query parameters when page loads
            var urlParams = new URLSearchParams(window.location.search);
            var categories = urlParams.get('category');
            if (categories) {
                var categoryArray = categories.split('|');
                categoryArray.forEach(function(category) {
                    $('input[name="category[]"][value="' + category + '"]').prop('checked', true);
                });
            }
        });
    </script>
@endpush
