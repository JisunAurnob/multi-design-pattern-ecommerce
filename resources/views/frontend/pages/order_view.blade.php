@extends('frontend.master')
@section('content')

<div class="mt-10 flex flex-wrap flex-row w-3/5 mx-auto">
    <div class="flex-shrink min-w-full px-4 mb-6" id="printArea">
        <div class="p-6 bg-white rounded-lg shadow-lg">
           
            <div class="flex flex-row justify-between py-3">
                <div class="flex-1">
                        Name : {{ $order->receiver_name }}<br>
                        Address : {{ $order->receiver_address }}<br>
                        Phone : {{ $order->receiver_phone }}<br>
                        Email : {{ $order->receiver_email }}<br>
                        Remark : {{ $order->order_remarks }}
                    </p>
                </div>
                <div class="flex-1">
                    <div class="flex  mb-2">
                        <div class=" font-semibold">Order ID :</div>
                        <div class=" ltr:text-right rtl:text-left">{{ $order->order_number }}</div>
                    </div>
                    <div class="flex  mb-2">
                        <div class=" font-semibold">Order date :</div>
                        <div class=" ltr:text-right rtl:text-left">{{ date('d-m-Y h:i A',strtotime($order->created_at)) }}</div>
                    </div>
                    <div class="flex  mb-2">
                        <div class=" font-semibold">Order Status :</div>
                        <div class=" ltr:text-right rtl:text-left">{{ $order->status }}</div>
                    </div>
                    <div class="flex  mb-2">
                        <div class=" font-semibold">Payment Status :</div>
                        <div class=" ltr:text-right rtl:text-left">{{ $order->payment_status }}</div>
                    </div>
                    <div class="flex  mb-2">
                        <div class=" font-semibold">Payment Type :</div>
                        <div class=" ltr:text-right rtl:text-left">{{ $order->payment_method }}</div>
                    </div>
                    {{-- <div class="flex justify-between mb-2">
                        <div class="flex-1 font-semibold">Delivery Type:</div>
                        <div class="flex-1 ltr:text-right rtl:text-left">{{ $order->delivery_type  }}</div>
                    </div> --}}

                </div>
            </div>
            <div class="py-4">
                <table class="table-bordered w-full ltr:text-left rtl:text-right text-gray-600">
                    <thead class="border-b ">
                        <tr class="bg-gray-100">
                            <th class="text-center">Products</th>
                            <th class="text-center">Qty</th>
                            <th class="text-center">Unit price</th>
                            <th class="text-center">Subtotal</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->details as $data)
                        <tr class="">
                            <td>
                                <div class="flex flex-wrap flex-row items-center">

                                    <div class="leading-5 flex-1 ltr:ml-2 rtl:mr-2 mb-1">
                                        {{ $data->product->name }}
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">{{ $data->quantity }}</td>
                            <td class="text-center">BDT. {{ $data->unit_price }} </td>
                            <td class="text-center">BDT. {{ $data->subtotal }} </td>
                            <td class="text-center "><a href="{{route('review.rate', ['order_details_id' => $data->id, 'product_id' => $data->product->id] )}}"
                                class="mr-2 capitalize text-xs px-2 py-1 rounded font-semibold cursor-pointer bg-blue-500 text-white">
                                Rate Product
                            </a></td>
                        </tr>
                        @endforeach

                    </tbody>




                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td class="text-center"><b>Sub Total</b></td>
                            <td class="text-center">BDT. {{ $order->details->sum('subtotal') }} </td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td class="text-center"><b>Discount</b></td>
                            <td class="text-center">BDT. {{ $order->total_discount ?? 0 }} </td>
                        </tr>

                        @php
                        $orderDetails = App\Models\OrderDetails::where('order_id', $order->id)
                        ->get()
                        ->toArray();
                        $Total = array_sum(array_column($orderDetails, 'subtotal'));
                        $vat = round(($settings->vat/100)*$Total)
                        @endphp

                        <!-- <tr>
                            <td colspan="2"></td>
                            <td class="text-center"><b>Vat ({{ $settings->vat}}%)</b></td>
                            <td class="text-center">{{ $vat }} BDT </td>
                        </tr> -->
                        <tr>
                            <td colspan="2"></td>
                            <td class="text-center"><b>Delivery Charge</b></td>
                            <td class="text-center">BDT. {{ $order->delivery_charge}} </td>
                        </tr>

                        <tr>
                            <td colspan="2"></td>
                            <td class="text-center"><b>Total</b></td>
                            <td class="text-center font-bold">BDT.{{ ($Total + $order->delivery_charge + $vat)  - $order->total_discount}} </td>
                        </tr>

                    </tfoot>

                </table>

                <p class="mt-5 text-gray-300 text-center float-buttom">Thanks for doing business with us.</p>

            </div>

        </div>
    </div>

</div>

@endsection