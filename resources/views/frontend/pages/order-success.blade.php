@extends('frontend.master')
@section('content')

<section class=" md:max-w-xl w-full mx-auto md:px-10 p-5 py-20 md:space-x-7">
    <!-- <h1 class="text-xl mb-7 text-center">Payment Success</h1> -->
    <div class="p-7 rounded-md">
        <div class="flex justify-center items-center h-full">
            <div class="max-w-md bg-white rounded-lg shadow-lg p-8">
                <div class="text-center mb-4">
                    <span class="text-green-500 text-lg font-bold">Payment Successful</span>
                </div>
                <div class="text-center">
                    <!-- Success Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto text-green-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.477 0 10s4.477 10 10 10 10-4.477 10-10S15.523 0 10 0zm5.775 7.225l-8.48 8.48c-.39.39-1.023.39-1.414 0l-3.226-3.226a1 1 0 1 1 1.414-1.414l2.812 2.812 7.066-7.065a1 1 0 1 1 1.415 1.415z" clip-rule="evenodd" />
                    </svg>
                    <!-- Success Message -->
                    <h2 class="text-2xl font-bold text-green-500 mt-4 mb-9">Thank you for your order!</h2>
                    <!-- Track Order Button -->
                    <a href="{{route('trackOrder',$orderNumber)}}" class="bg-orange-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-orange-600 transition-colors">
                        Track Your Order
                    </a>
                </div>
            </div>
        </div>
    </div>



</section>
@endsection