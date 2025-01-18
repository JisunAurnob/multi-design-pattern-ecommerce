@extends('backend.layout.app')
@section('title')
Order View
@endsection
@section('main')

{{-- id="title-invoice" --}}
<div class="flex flex-wrap flex-row">
    <div class="flex justify-between max-w-full px-4 py-4 w-full">
        <p class="text-xl font-bold mt-3 mb-5">Invoice #000{{ $order->id }}</p>
        <div class="mr-10">
            @if($order->status != 'delivered')
            <!-- <button class="mr-3" onclick="toggleModal()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
            </button> -->
            <button class="mr-10" onclick="toggleModal()"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
            </button>
            @endif
            <button type="button" id="btn-invoice" onclick="printDiv('printArea')" class="" viewBox="0 0 16 16">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                </svg>

            </button>
        </div>
    </div>
    <div class="flex-shrink max-w-full px-4 w-full mb-6" id="printArea">
        <div class="p-6 bg-white rounded-lg shadow-lg">
            <div class="flex justify-between items-center pb-4 border-b border-gray-200  mb-3">
                <div class="flex flex-col">
                    <div class="text-3xl font-bold mb-1">
                        <img class="inline-block w-1/6 h-auto ltr:mr-2 rtl:ml-2" src="{{$settings->logo}}">
                    </div>
                    <p class="text-sm">
                        Company Name: {{ $settings->company_name }}<br>
                        Address: {{ $settings->address }}<br>
                        Email: {{ $settings->email }}</p>
                </div>
                <div>
                    <div class="text-4xl uppercase font-bold">Invoice</div>
                    <p> {!! DNS1D::getBarcodeHTML($order->order_number, 'C128'); !!} </p>
                </div>
            </div>
            <div class="flex flex-row justify-between py-3">
                <div class="flex-1">
                    <p><strong>To:</strong><br>
                        Name : {{ $order->receiver_name }}<br>
                        Address : {{ $order->receiver_address }}<br>
                        Phone : {{ $order->receiver_phone }}<br>
                        Email : {{ $order->receiver_email }}<br>
                        Remark : {{ $order->order_remarks }}
                    </p>
                </div>
                <div class="flex-1">
                    <div class="flex justify-between mb-2">
                        <div class="flex-1 font-semibold">Order ID :</div>
                        <div class="flex-1 ltr:text-right rtl:text-left">{{ $order->order_number }}</div>
                    </div>
                    <div class="flex justify-between mb-2">
                        <div class="flex-1 font-semibold">Order date :</div>
                        <div class="flex-1 ltr:text-right rtl:text-left">{{ date('d-m-Y h:i A',strtotime($order->created_at)) }}</div>
                    </div>
                    <div class="flex justify-between mb-2">
                        <div class="flex-1 font-semibold">Order Status :</div>
                        <div class="flex-1 ltr:text-right rtl:text-left">{{ $order->status }}</div>
                    </div>
                    <div class="flex justify-between mb-2">
                        <div class="flex-1 font-semibold">Payment Status :</div>
                        <div class="flex-1 ltr:text-right rtl:text-left">{{ $order->payment_status }}</div>
                    </div>
                    <div class="flex justify-between mb-2">
                        <div class="flex-1 font-semibold">Payment Type :</div>
                        <div class="flex-1 ltr:text-right rtl:text-left">{{ $order->payment_method }}</div>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->details as $data)
                        <tr>
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

<div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="modal">
    <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
        <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

                <form action="{{ route('order.update', $order->id) }}" method="post" class=" px-6 py-6 rounded-md space-y-7">
                    @csrf
                    @method('put')
                    <div class="bg-white py-12 rounded-lg shadow-md">
                        <div class="px-10">
                            <label for="name" class="block text-sm leading-5 font-medium text-gray-700">
                                Order Remark:<span class="text-red-600"> * </span>
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input id="order_remarks" name="order_remarks" type="text" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-2 focus:border-blue-200 focus:outline-none" placeholder="Enter remark" />
                            </div>
                            @error('order_remarks')
                            <p class="text-red-600 mt-5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-10">
                            <div class="mt-1 relative rounded-md shadow-sm">


                                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray">Status:</label>
                                <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option value="pending" @if($order->status == "pending") selected @endif>Pending</option>
                                    <option value="processing" @if($order->status == "processing") selected @endif>processing</option>
                                    <option value="confirm" @if($order->status == "confirm") selected @endif>Confirm</option>
                                    <option value="dispatch" @if($order->status == "dispatch") selected @endif>Dispatch</option>
                                    <!-- <option value="delivered">Delivered</option> -->
                                    <!-- <option value="transfer" @if($order->status == "transfer") selected @endif>Transfer</option> -->
                                    <option value="cancel" @if($order->status == "cancel") selected @endif>Cancel</option>
                                    {{-- <option value="success" @if($order->status == "success") selected @endif>Success</option> --}}
                                    {{-- <option value="pick-up" @if($order->status == "pick-up") selected @endif>Picked-up</option> --}}
                                    <option value="delivered" @if($order->status == "delivered") selected @endif>Delivered</option>
                                    <option value="return" @if($order->status == "return") selected @endif>Return</option>
                                </select>


                            </div>
                            @error('status')
                            <p class="text-red-600 mt-5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- <div class="px-10">
                            <div class="mt-1 relative rounded-md shadow-sm">


                                <label for="delivery_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray">Delivery_type:</label>
                                <select name="delivery_type" id="delivery_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option value="ship" @if($order->status == "ship") selected @endif>Ship</option>
                                    <option value="pick-up" @if($order->status == "pick-up") selected @endif>Pick-up</option>

                                </select>


                            </div>
                            @error('delivery_type')
                            <p class="text-red-600 mt-5">{{ $message }}</p>
                            @enderror
                        </div> --}}
                    
                       

                    </div>
                    <div class="mt-8 pt-5">


                        <div class="bg-gray-200 px-4 py-3 text-right">
                            <button type="button" class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700 mr-2" onclick="toggleModal()"><i class="fas fa-times"></i> Cancel</button>
                            <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 mr-2"><i class="fas fa-plus"></i> Update</button>
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>








<script type="text/javaScript">

    function toggleModal() { document.getElementById('modal').classList.toggle('hidden')}
                       
                         function printDiv(divName) {
                        var printContents = document.getElementById(divName).innerHTML;
                        var originalContents = document.body.innerHTML;

                        document.body.innerHTML = printContents;

                        window.print();

                        document.body.innerHTML = originalContents;
                       

                        
                    }
                    </script>
@endsection