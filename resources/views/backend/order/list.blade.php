@extends('backend.layout.app')
@section('title')
Orders List ({{ request()->has('status')?ucfirst(request()->status):' All ' }})
@endsection



@section('main')
<div class="flex flex-col container px-8">
    <!-- Primary -->
    <div class="flex justify-between items-center px-9">
        <div class="">
            <span class="inline-flex rounded-md shadow-sm">

            </span>
        </div>
        <div>
            <form action="" method="get" class="w-full">
                <div class="flex mb-10 justify-center items-center">
                    <div class="space-x-6  w-1/8">
                        <label for="email" class=" text-sm font-medium leading-5 text-gray-700 ml-5"></label>
                        <div class="mt-1  rounded-md shadow-sm">
                            <input id="email" name="search" type="text" placeholder="Search by Order" class="form-input  w-full py-2" value="">
                        </div>
                    </div>
                    <div class="mt-1.5">
                        <button type="submit" class="focus:outline-none space-x-6 bg-indigo-600 text-white rounded-md px-4 py-2 ml-5 mt-5">
                            submit
                        </button>
                        @if (request()->query('search'))
                        <a href="{{route('order.list')}}" class="focus:outline-none space-x-6 bg-indigo-600 text-white rounded-md px-4 py-2.5 ml-5 mt-5">
                            Reset
                        </a>
                        @endif

                    </div>
                </div>
            </form>
        </div>
    </div>



    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        @if (request()->query('search'))
        <div class="flex mb-10  items-left">
            <p>You searched for: {{ request()->query('search') }}</p>
        </div>
        @endif
        <div class="shadow  border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            ID
                        </th>

                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Order Number
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Customer Name
                        </th>

                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Phone Number
                        </th>

                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Paymet Method
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Paymet Status
                        </th>

                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Order Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($orders as $key => $order)
                    <tr>
                        <td class="text-sm text-gray-900">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $key + 1 }}
                                </div>
                            </div>
                        </td>
                        <td class="text-sm text-gray-900">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $order->order_number }}
                                </div>
                            </div>
                        </td>

                        <td class="text-sm text-gray-900">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $order->customer->first_name }} {{ $order->customer->last_name }}
                                </div>
                            </div>
                        </td>
                        <td class="text-sm text-gray-900">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    <!-- {{ optional($order->customer)->phone }} -->
                                    {{ $order->receiver_phone  }}
                                </div>
                            </div>
                        </td>
                        <td class="text-sm text-gray-900">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $order->payment_method }}
                                </div>
                            </div>
                        </td>
                        <td class="text-sm text-gray-900">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $order->payment_status }}
                                </div>
                            </div>
                        </td>
                        <td class="text-sm text-gray-900">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">

                                    {{ date('d-m-Y h:i A',strtotime($order->created_at)) }}
                                </div>
                            </div>
                        </td>
                        <td class="text-sm text-gray-900">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $order->status }}
                                </div>
                            </div>
                        </td>
                        <td class=" space-x-2 py-8 px-8 whitespace-nowrap text-right text-sm font-medium flex">
                            <a title="view" href="{{route('order.view',$order->id)}}" class="text-indigo-600 hover:text-indigo-900">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                    <path fill="none" d="M0 0h24v24H0z" />
                                    <path d="M12 3c5.392 0 9.878 3.88 10.819 9-.94 5.12-5.427 9-10.819 9-5.392 0-9.878-3.88-10.819-9C2.121 6.88 6.608 3 12 3zm0 16a9.005 9.005 0 0 0 8.777-7 9.005 9.005 0 0 0-17.554 0A9.005 9.005 0 0 0 12 19zm0-2.5a4.5 4.5 0 1 1 0-9 4.5 4.5 0 0 1 0 9zm0-2a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                                </svg>

                            </a>
                            {{-- {{ route('dealer.purchase.view.invoice', $purchase->id) }} --}}
                            <a title="Download Invoice" href="{{route('invoice.download', $order->id)}}" class="text-indigo-600 hover:text-indigo-900">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                    </tr>
                    @endforeach
                    <!-- More people... -->
                </tbody>
            </table>
            {{$orders->links()}}

        </div>
    </div>
</div>
@endsection