@extends('backend.layout.app')
@section('title')
    Product Create
@endsection
@section('main')
    <form action="{{ route('product.store') }}" method="post" class=" px-6 py-6 rounded-md space-y-7 "
        enctype="multipart/form-data">
        @csrf
        <div class="bg-white py-12 rounded-lg shadow-md grid grid-cols-2">
            <div class="px-10">
                <label for="product_name" class="block text-sm leading-5 font-medium text-gray-700">
                    Name<span class="text-red-600"> * </span>
                </label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <input required id="product_name" value="{{ old('product_name') }}" name="product_name" type="text"
                        class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none mb-2"
                        placeholder="Enter Product Name " />
                </div>
                @error('product_name')
                    <p class="text-red-600 mt-5">{{ $message }}</p>
                @enderror
            </div>
            <div class="px-10">
                <label for="product_slug">Slug</label>
                <input type="text" class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none mb-2" id="product_slug" name="product_slug"
                    placeholder="URL" value="{{ old('product_slug') }}"
                    required>
                @error('product_slug')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="px-10">
                <label for="short_description">Short Description
                </label>
                <textarea class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none mb-2" id="short_description" name="short_description" rows="3" required>{{ old('short_description') }}</textarea>
            </div>
            <div class="px-10">
                <label for="description" class="block text-sm leading-5 font-medium text-gray-700">
                    Description <span class="text-red-600"> * </span>
                </label>
                <div class="mt-1 relative rounded-md shadow-sm">
                   <textarea id="content" value="{{ old('description') }}" name="description"
                        class="ckeditor block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none mb-2 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none"
                        placeholder="Description">{{ old('description') }}</textarea>
                </div>
                @error('description')
                    <p class="text-red-600 mt-5">{{ $message }}</p>
                @enderror
            </div>
            <div class="px-10">
                <label for="service_id" class="block text-sm leading-5 font-medium text-gray-700">
                    Category
                </label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <select required name="service_id" id="service_id"
                        class=" form-select appearance-none
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
                        <option selected disabled>Select Category </option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>

                            @foreach ($cat->childs as $childCategory)
                                @include('backend.category.child_category', [
                                    'child_category' => $childCategory,
                                    'hi_pen' => $hi_pen,
                                ])
                            @endforeach
                        @endforeach

                    </select>
                </div>
                @error('service_id')
                    <p class="text-red-600 mt-5">{{ $message }}</p>
                @enderror
            </div>
            <div class="px-10">
                <label for="product_video">Product Video (Youtube Link)</label>
                <input type="text" class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none mb-2"
                    value="{{ old('product_video') }}"
                    id="product_video" name="product_video"
                    placeholder="https://www.youtube.com/">

                @error('product_video')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <div class="px-10">
                    <label for="meta_title">Product Tags (Use Comma)</label>
                    <input type="text" class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" id="product_tags"
                        name="product_tags"placeholder="Ex: Seeds, Healthy, Oil"
                        @if (!empty($product['product_tags'])) value="{{ $product['product_tags'] }}" @else value="{{ old('product_tags') }}" @endif
                        required>
                    @error('product_tags')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="px-10">
                    <input type="checkbox" id="is_popular" name="is_popular" value="Yes"
                        @if (!empty($product['is_popular']) && $product['is_popular'] == 'Yes') checked="" @endif>
                    <label for="is_popular">Popular Product</label>
    
                    @error('is_popular')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="px-10">
                    <input type="checkbox" id="is_bestseller" name="is_bestseller"
                        value="Yes" @if (!empty($product['is_bestseller']) && $product['is_bestseller'] == 'Yes') checked="" @endif>
                    <label for="is_bestseller">Daily Best Sells</label>
    
                    @error('is_bestseller')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="px-10">
                    <input type="checkbox" id="is_featured" name="is_featured" value="Yes"
                        @if (!empty($product['is_featured']) && $product['is_featured'] == 'Yes') checked="" @endif>
                    <label for="is_featured">Featured Item</label>
    
                    @error('is_featured')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
    
                <div class="px-10">
                    <input type="checkbox" id="is_dealsday" name="is_dealsday" value="Yes"
                        @if (!empty($product['is_dealsday']) && $product['is_dealsday'] == 'Yes') checked="" @endif>
                    <label for="is_dealsday">Deals Of The Day</label>
    
                    @error('is_dealsday')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="field_wrapper attributeDiv">
                    <div>
                        <label for="attribute"><b>Product Attribute</b></label>
                    </div>
                    {{-- <input type="hidden" id="product_descount_apply"
                        value="{{ route('product.discount.apply') }}"> --}}
                    {{-- <input type="hidden" id="product_attribute_set"
                        value="{{ route('product.attribute.index') }}"> --}}
                    @if (!$product->attribute->isEmpty())
                        @foreach ($product->attribute as $key => $attribute)
                            <input type="hidden"
                                name="product_attribute_id[{{ $key }}]"
                                value="{{ $attribute->id }}">
                            <div class="row" style="padding: 1rem">
                                <input type="radio"
                                    class="form-check-input mt-3"
                                    id="radio1" name="default_attribute"
                                    value="{{ $key }}"
                                    @if ($attribute->default_attribute == 1) checked @endif>
                                {{-- <input hidden
                                    class="form-control-file col-lg-3 m-1"
                                    type="text"
                                    name="product_attribute_id[{{ $key }}]"
                                    placeholder="Value"
                                    value="{{ $attribute->id }}" required /> --}}
                                <div class="form-group p-1">
                                    <select class="form-control"
                                        style="height: 2.1rem"
                                        name="size[{{ $key }}]">
                                        <option value=""
                                            selected>
                                            Select Size</option>
                                        @foreach ($sizeAttributes as $data)
                                            @foreach ($data['attribute_values'] as $size)
                                                <option
                                                    @if ($attribute['size'] == $size['value']) selected @endif
                                                    value="{{ $size['value'] }}">
                                                    {{ $size['value'] }}
                                                </option>
                                            @endforeach
                                        @endforeach

                                    </select>
                                    @error('size')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group p-1">
                                    <select class="form-control "
                                        style="height: 2.1rem"
                                        name="color[{{ $key }}]">
                                        <option value=""
                                            selected>
                                            Select Color</option>
                                        @foreach ($colorAttributes as $data)
                                            @foreach ($data['attribute_values'] as $color)
                                                <option
                                                    @if ($attribute['color'] == $color['value']) selected @endif
                                                    value="{{ $color['value'] }}">
                                                    {{ $color['value'] }}
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @error('size')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>


                                {{-- <input class="col-lg-2 form-control m-1"
                                    type="text"
                                    name="attribute_value[{{ $key }}]"
                                    placeholder="Value" required
                                    value="{{ $attribute->attribute_value }}" /> --}}

                                <input class="col-lg-2 form-control m-1"
                                    type="number"
                                    name="attr_stock[{{ $key }}]"
                                    placeholder="Stock" required
                                    value="{{ $attribute->stock }}" />
                                <input
                                    class="col-lg-2 form-control m-1 enterPrevent"
                                    type="text"
                                    name="product_sku[{{ $key }}]"
                                    placeholder="Sku" required
                                    value="{{ $attribute->product_sku }}" />

                                <input class="form-control-file col-lg-3 m-1"
                                    type="file" multiple
                                    name="attribute_product_images[{{ $key }}][]"
                                    placeholder="Value" />

                                <input class="col-lg-2 form-control m-1"
                                    type="text"
                                    name="attribute_alter_text[{{ $key }}]"
                                    id="attribute_alter_text{{ $key }}"
                                    placeholder="Alter text"
                                    value="{{ $attribute->attribute_alter_text }}" />

                                <input class="col-lg-2 form-control m-1"
                                    type="number"
                                    id="attribute_price_edit{{ $key }}"
                                    name="attribute_price[{{ $key }}]"
                                    placeholder="Price" required
                                    value="{{ $attribute->attribute_price }}" />


                                @php
                                    $ids = [];
                                    if ($attribute->discount_type) {
                                        $ids = array_column(json_decode($attribute->discount_type, true), 'id');
                                    }
                                    
                                @endphp
                                <div class="form-group multi-dropdown">
                                    <select class="form-control chosen-select"
                                        id="discount_type1"
                                        name="discount_type[{{ $key }}][]"
                                        multiple>
                                        @foreach ($discountRule as $atbt)
                                            <option
                                                value="{{ $atbt['id'] }}"
                                                @if (in_array($atbt['id'], $ids)) selected @endif>
                                                {{ $atbt['rule_name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input class="col-lg-2 form-control m-1"
                                    style="display: none" type="number"
                                    step="any" class="form-control"
                                    id="attribute_product_discount{{ $key }}"
                                    name="product_discount[{{ $key }}]"
                                    placeholder="Discount"
                                    value="{{ $attribute->product_discount }}"
                                    oninput="checkDiscountValue(this)">
                                <input readonly
                                    class="col-lg-2 form-control m-1"
                                    style="display: none" type="text"
                                    id="attribute_final_price_edit{{ $key }}"
                                    name="attribute_final_price[{{ $key }}]"
                                    placeholder="Final Price" required
                                    value="{{ $attribute->attribute_final_price }}" />


                                {{-- @error('attribute_final_price')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}

                                <div class="form-group mt-1 mr-1 p-1"
                                    style="border: 1px solid #0098b8; border-radius: 5px;">
                                    <input type="checkbox"
                                        id="is_point{{ $key }}"
                                        name="is_point[{{ $key }}]"
                                        value="1"
                                        @if ($attribute->is_enable_point == 1) checked @endif>
                                    <label for="is_point{{ $key }}"
                                        class="mb-0"
                                        style="font-size: .9rem;">Point
                                        Enable</label>
                                </div>

                                <a style="height:2.2rem;display:none;"
                                    id="apply_button"
                                    class="btn btn-primary mt-1"
                                    onclick="attribute_price_apply_edit({{ $key }})">Apply</a>

                                @if ($key != 0)
                                    &nbsp;<a href="javascript:void(0);"
                                        class="btn remove_button_edit mt-1"
                                        onclick="deleteAttribute({{ $attribute->id }})"
                                        style="height:2.2rem ">-</a>
                                @endif
                                &nbsp;<a style="height:2.2rem "
                                    href="javascript:void(0);"
                                    class="btn add_button add_button2 btn-primary mt-1 mb-1"
                                    att_size="{{ count($product->attribute) }}">+</a>

                            </div>
                            <?php
                            $product_attribute_images = ProductsImage::where('product_attribute_id', $attribute->id)->get();
                            ?>
                            @if ($key == 0)
                                <div class="col-lg-2 m-1"
                                    style="display:flex">
                                    @foreach ($product_attribute_images as $product_attribute_image)
                                        <img id="att_img_delete{{ $product_attribute_image->id }}"
                                            class="img-fluid" width="30%"
                                            src="{{ $product_attribute_image->image['small'] }}"><a
                                            id="att_a_img_delete{{ $product_attribute_image->id }}"
                                            style="height:2.2rem "
                                            onclick="deleteAttributeImage({{ $product_attribute_image->id }})"
                                            class="btn btn"><b>X</b></a>
                                    @endforeach
                                </div>
                            @else
                                <div class="col-lg-2 m-1"
                                    style="display:flex">
                                    @foreach ($product_attribute_images as $product_attribute_image)
                                        <img id="att_img_delete{{ $product_attribute_image->id }}"
                                            class="img-fluid" width="30%"
                                            src="{{ $product_attribute_image->image['small'] }}"><a
                                            id="att_a_img_delete{{ $product_attribute_image->id }}"
                                            style="height:2.2rem "
                                            onclick="deleteAttributeImage({{ $product_attribute_image->id }})"
                                            class="btn btn"><b>X</b></a>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="row" style="padding: 1rem">
                            <input type="radio"
                                class="form-check-input mt-3" id="radio1"
                                name="default_attribute" value="0"
                                checked>
                            {{-- <div class="form-group multi-dropdown p-1">
                                <select class="form-control m-1 chosen-select"
                                    name="size[0]">
                                    <option value="" disabled selected>
                                        Select Size</option>
                                    @foreach ($sizeAttributes as $data)
                                        @foreach ($data['attribute_values'] as $size)
                                            <option
                                                value="{{ $size['value'] }}">
                                                {{ $size['value'] }}
                                            </option>
                                        @endforeach
                                    @endforeach

                                </select>
                            </div> --}}
                            <div class="form-group p-1">
                                <select class="form-control"
                                    style=" height: 2.2rem; " name="size[0]">
                                    <option value="" selected>
                                        Select Size</option>
                                    @foreach ($sizeAttributes as $data)
                                        @foreach ($data['attribute_values'] as $size)
                                            <option
                                                value="{{ $size['value'] }}">
                                                {{ $size['value'] }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                                @error('size')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group p-1">
                                <select class="form-control"
                                    style=" height: 2.2rem; " name="color[0]">
                                    <option value="" selected>
                                        Select Color</option>
                                    @foreach ($colorAttributes as $data)
                                        @foreach ($data['attribute_values'] as $color)
                                            <option
                                                value="{{ $color['value'] }}">
                                                {{ $color['value'] }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                                @error('size')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input class="col-lg-2 form-control m-1"
                                type="number" name="attr_stock[0]"
                                placeholder="Stock" required />

                            <input
                                class="col-lg-2 form-control m-1 enterPrevent"
                                type="text" name="product_sku[0]"
                                placeholder="Sku"
                                onkeydown="return event.key != 'Enter';"
                                required />

                            <input class="form-control-file col-lg-3 m-1"
                                type="file" multiple
                                name="attribute_product_images[0][]"
                                placeholder="Value" required />

                            <input class="col-lg-2 form-control m-1"
                                type="text" name="attribute_alter_text[0]"
                                id="attribute_alter_text[0]"
                                placeholder="Alter text" />

                            <input class="col-lg-2 form-control m-1"
                                type="number" id="attribute_price1"
                                name="attribute_price[0]" placeholder="Price"
                                required />

                            <div class="form-group multi-dropdown">
                                <select class="form-control chosen-select"
                                    id="discount_type1"
                                    name="discount_type[0][]" multiple>
                                    @foreach ($discountRule as $atbt)
                                        <option value="{{ $atbt['id'] }}">
                                            {{ $atbt['rule_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <input class="col-lg-2 form-control m-1"
                                style="display: none" type="number"
                                step="any" class="form-control"
                                id="product_discount1"
                                name="product_discount[0]"placeholder="Discount"
                                oninput="checkDiscountValue(this)">
                            <input readonly class="col-lg-2 form-control m-1"
                                style="display: none" type="text"
                                id="attribute_final_price1"
                                name="attribute_final_price[0]"placeholder="Final Price" />&nbsp;
                            <div class="form-group mt-1 mr-1 p-1"
                                style="border: 1px solid #0098b8;border-radius: 5px;">
                                <input type="checkbox" id="is_point1"
                                    name="is_point[0]">
                                <label for="is_point1" class="mb-0"
                                    style="font-size: .9rem;"
                                    value="1">Point
                                    Enable</label>
                            </div>

                            <a style="height:2.2rem;display: none"
                                class="btn btn-primary mt-1"
                                onclick="attribute_price_apply(1)"
                                required>Apply</a>&nbsp;
                            <a href="javascript:void(0);"
                                class="btn add_button add_button2 btn-primary mt-1 mb-1"
                                style="
                                height: 2.2rem;
                            ">+</a>
                        </div>
                    @endif
                </div>
                <span id="discountWarning" style="color: red; display: none;">
                    Please enter a value between 0 and 100 for Discount.
                </span>
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
