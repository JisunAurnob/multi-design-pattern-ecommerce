<div class="hidden mb-4 lg:block mt-2 sm:ml-6">
    <div class="flex space-x-4">
        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->

        <a href="{{ route('home') }}"
            class="font-md font-bold transition duration-300 hover:bg-[#ff6a28] hover:text-white px-3 py-2 rounded-md text-sm">Home</a>
        <a href="{{ route('all.products', ['categoryName' => 'kids']) }}"
            class="font-md font-bold transition duration-300 hover:bg-[#ff6a28] hover:text-white px-3 py-2 rounded-md text-sm">
            <img class="h-6" src="{{ url('/frontend/image/kids.webp') }}" alt="" /></a>
        <a href="{{ route('all.products') }}"
            class="font-md font-bold transition duration-300 hover:bg-[#ff6a28] hover:text-white px-3 py-2 rounded-md text-sm">All
            products</a>

        <a href="#"
            class="font-md font-bold transition duration-300 hover:bg-[#ff6a28] hover:text-white px-3 py-2 rounded-md text-sm">Contact</a>

        {{-- <a href="#"
            class="font-md font-bold transition duration-300 hover:bg-[#ff6a28] hover:text-white px-3 py-2 rounded-md text-sm">Blog</a> --}}
        @guest('customer')
            <a href="{{ route('user.login') }}"
                class="font-md font-bold transition duration-300 hover:bg-[#ff6a28] hover:text-white px-3 py-2 rounded-md text-sm">Login</a>
            <a href="{{ route('user.register') }}"
                class="font-md font-bold transition duration-300 hover:bg-[#ff6a28] hover:text-white px-3 py-2 rounded-md text-sm">Registration</a>
        @endguest

    </div>
</div>
