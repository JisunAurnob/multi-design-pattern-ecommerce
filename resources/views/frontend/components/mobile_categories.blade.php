@foreach ($categories as $cat)
    <li class="categoryLi py-1 cursor-pointer dropdown  pl-4 relative  ">
        <div class="flex items-center justify-between ml-3 mt-1 py-1 pl-2 transition duration-300 rounded-md ">
            <a class="block w-full " href="{{ route('category.wise.product', $cat->slug) }}">{{ $cat->name }}</a>

            <!-- <img class="h-3 w-3" src="image/right-arrow.png" alt="" /> -->
            @if ($cat->childs->count() > 0)
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                class='w-3 fill-black mt-1 catSvg transition duration-300'>
                <path
                    d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
            </svg>
            @endif
        </div>

        @if ($cat->childs->count() > 0)
            <div class="dropdown1 p-[6px] hidden top-0 z-40 w-full transition duration-300 childcatM">
                <ul class=" w-full ">
                    @foreach ($cat->childs as $childCategory)
                        @include('frontend.components.mobile_subcategories_index', [
                            'child_category' => $childCategory,
                        ])
                    @endforeach
                </ul>
            </div>
        @endif
    </li>
@endforeach
