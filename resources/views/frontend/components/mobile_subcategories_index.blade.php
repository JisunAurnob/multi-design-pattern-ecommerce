<li class="px-2 ml-3 mb-[2px] w-full py-1 whitespace-nowrap bg-white capitalize rounded space-y-3 transition duration-300 hover:shadow-md text-black">
    <a class="block" href="/category-wise-product/{{ $child_category->slug }}">{{ $child_category->name }}</a>
    @if ($child_category->childs)
        @foreach ($child_category->childs as $childCategory)
            @include('frontend.pages.subcategories_index', [
                'child_category' => $childCategory,
            ])
        @endforeach
    @endif
</li>