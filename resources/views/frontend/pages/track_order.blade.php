@extends('frontend.master')
@section('content')
   

<div class="px-8 pt-12 pb-8 mb-8 track-div">

    <h1 class="text-4xl heading-text text-center font-semibold mb-6 track-title">Order status</h1>
    <div class="flex flex-col justify-center items-center">
       
  
        <div class="flex flex-col order-track w-[30%] ">
            
            @foreach($order->order_activity as $data)
            <div class="flex track-sec gap-5 ">
                <div class="col-start-2 col-end-4 mr-10 md:mx-auto relative">
                    <div class="h-full w-6 flex items-center justify-center">
                        <div class="h-full w-1 bg-green-500 pointer-events-none"></div>
                    </div>
                    <div
                        class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full text-gray-50 bg-green-500 shadow text-center p-[3px]">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check"
                            class="svg-inline--fa fa-check " role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512">
                            <path fill="currentColor"
                                d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z">
                            </path>
                        </svg>
                    </div>
                </div>
                <div class=" col-start-4 col-end-12 p-4 rounded-xl my-4 mr-auto shadow-md w-full">
                    <h3 class="font-semibold text-lg mb-1 order-text">{{$data->to_status}}</h3>
                    <p class="leading-tight text-justify w-full order-date mb-1"></p>
                    <p class="leading-tight text-justify w-full order-date text-sm font-bold">{{ date('d-m-Y h:i A',strtotime($data->created_at)) }}</p>
                </div>
            </div>
            @endforeach
            
            
        </div>
    </div>
  </div>




            {{-- <div class="flex flex-col order-track w-[30%] ">
                <div class="flex track-sec gap-5 ">
                    <div class="col-start-2 col-end-4 mr-10 md:mx-auto relative">
                        <div class="h-full w-6 flex items-center justify-center">
                            <div class="h-full w-1 bg-green-500 pointer-events-none"></div>
                        </div>
                        <div
                            class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full text-gray-50 bg-green-500 shadow text-center">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check"
                                class="svg-inline--fa fa-check mt-1" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 448 512">
                                <path fill="currentColor"
                                    d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class=" col-start-4 col-end-12 p-4 rounded-xl my-4 mr-auto shadow-md w-full">
                        <h3 class="font-semibold text-lg mb-1 order-text">Confirm</h3>
                        <p class="leading-tight text-justify w-full order-date mb-1"></p>
                        <p class="leading-tight text-justify w-full order-date text-sm font-bold">2024-03-14, 2:07 PM</p>
                    </div>
                </div>
            </div> --}}
  

@endsection
