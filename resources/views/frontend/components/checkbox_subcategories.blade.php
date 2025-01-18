<div class="flex items-center">
    <input id="{{ $child_category->slug }}" name="category[]" value="{{ $child_category->id }}" type="checkbox"
        class="h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500" />
    <label for="{{ $child_category->slug }}" class="ml-3 text-sm text-gray-600">
        {{ $child_category->name }}
    </label>
</div>
@if ($child_category->childs->count() > 0)
    @foreach ($child_category->childs as $childCategory)
        @include('frontend.components.checkbox_subcategories', [
            'child_category' => $childCategory,
        ])
    @endforeach
@endif
