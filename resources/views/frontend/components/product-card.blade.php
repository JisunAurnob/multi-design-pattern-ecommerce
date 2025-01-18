<article class="hover:shadow-xl rounded-md shadow-lg border border-gray-400 h-[250px] md:h-[373px] productCardM">
    <a href="{{route('products.view',$product->slug)}}">
        <div class="overflow-hidden relative rounded-t">
            {{-- @dump($product->productImages) --}}
            <img class="object-fill duration-300 h-32 hover:scale-105 md:h-56 lg:h-[253px] w-full productImages"
                src="{{$product->image}}" alt="{{$product->name}}" />
            <div class="absolute flex flex-col right-[6px] top-[8px]">
                <a href="{{route('add.to.wishlist', $product->id)}}"
                    class="bg-white duration-300 ease-in flex h-6 hover:shadow-md hover:text-[#E21C21] items-center p-1 rounded text-gray-500 transition w-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bg-white h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                        </path>
                    </svg>
                </a>
            </div>
            @if (($product->discount['amount'])>0)
            <div class="absolute bg-[#ff6a28] bottom-3 inline-flex items-center left-3 px-2 rounded-md text-white">
                {{$product->discount['percentage']}} off

            </div>
            @endif
        </div>

        <div class="mt-1 p-2">
            <h2 class="text-slate-700 line-clamp-1"> {{$product->name}}</h2>

           
            <div class="inline-flex items-center">
                @for ($i = 0; $i < $product->rate; $i++)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                        </path>
                    </svg>
                @endfor
                @for ($i = 0; $i < (5 - $product->rate); $i++)
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                
                @endfor
                <span class="ml-1    text-sm">{{$product->rate ? '('.$product->rate.')' : ''}}</span>
            </div>
            <div class="flex lg:flex-row addcart flex-col justify-between">

                <div class="flex mb-3">
                    @if($product->discount['amount'])
                    BDT. <p class="ml-1"> {{$product->price - $product->discount['amount']}}</p>
                    <p class="px-1 line-through text-gray-500"> {{$product->price}}</p>
                    @else
                    BDT. <p class="ml-1"> {{$product->price}}</p>
                    @endif
                </div>
                <div
                    class=" bg-[#09CCD0] duration-100 flex flex-nowrap w-28 hover:bg-[#ff6a28] items-center justify-center px-2  md:py-1.5 py-1 rounded-full space-x-1 md:space-x-1.5 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z">
                        </path>
                    </svg>

                    <a href="{{route('addToCart', $product->id)}}">
                        <button class="text-sm whitespace-nowrap">Add to cart</button>
                    </a>

                </div>
            </div>

        </div>
    </a>
</article>