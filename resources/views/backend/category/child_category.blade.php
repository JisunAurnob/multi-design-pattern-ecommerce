<option value="{{ $child_category->id }}" @if (isset($product) && $child_category->id == $product->category_id) selected @endif
    @if (isset($category) && $child_category->id == $category->parent_id) selected @endif
    @if (isset($category) && $child_category->id == $category->id) @disabled(true) @endif>-@if (isset($hi_pen))
        {{ $hi_pen }}
    @endif{{ $child_category->name }}</option>
@if ($child_category->childs)
    @if (isset($hi_pen))
        @php
            $hi_pen .= '-';
        @endphp
    @endif
    @foreach ($child_category->childs as $childCategory)
        @include('backend.category.child_category', [
            'child_category' => $childCategory,
            'hi_pen' => $hi_pen,
        ])
    @endforeach
@endif
