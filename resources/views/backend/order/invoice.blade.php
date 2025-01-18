<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .invoice-details p {
            margin: 5px 0;
        }
        .invoice-details .order-info {
            text-align: right;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        .invoice-table th {
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            margin-top: 20px;
        }
        .total p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="invoice-header">
            <h2>Invoice</h2>
        </div>
        <div class="invoice-details">
            <div>
                <p><strong>PASSON</strong></p>
                <div>
                    {{-- <img class="inline-block w-1/6 h-auto ltr:mr-2 rtl:ml-2" src="{{$settings->logo}}"> --}}
                </div>
                <br>
                <p><strong>Print Date:</strong> {{ date('d-m-Y h:i A',strtotime($now)) }}</p>
                <p><strong>Billed To:</strong> {{$order->receiver_name}} </p>
                <p><strong>Phone:</strong> {{$order->receiver_phone}} </p>
                <p><strong>Email:</strong> {{$order->receiver_email}}</p>
                <p><strong>Address:</strong> {{$order->receiver_address}}</p>
            </div>
            <div class="order-info">
                <p><strong>Order ID:</strong>{{$order->order_number}}</p>
                <p><strong>Order Date:</strong>  {{ date('d-m-Y h:i A',strtotime($order->created_at)) }}</p>
                <p><strong>Order Status:</strong> {{ $order->status }}</p>
                <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
                <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                
            </div>
        </div>
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Products</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->details as $data)
                    <tr>
                        <td> {{ $data->product->name }}</td>
                        <td>{{ $data->quantity }}</td>
                        <td>BDT. {{ $data->unit_price }} </td>
                        <td>BDT. {{ $data->subtotal }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @php
        $orderDetails = App\Models\OrderDetails::where('order_id', $order->id)
        ->get()
        ->toArray();
        $Total = array_sum(array_column($orderDetails, 'subtotal'));
        // $vat = round(($settings->vat/100)*$Total)
        @endphp

        <div class="total">
            <p><strong>Sub Total:</strong>BDT. {{ $order->details->sum('subtotal') }} </p>
            <p><strong>Discount:</strong>BDT. {{ $order->total_discount ?? 0 }} </p>
            <p><strong>Delivery Charge:</strong> BDT. {{ $order->delivery_charge}} </p>
            <p><strong>Total:</strong>BDT. {{ ($Total + $order->delivery_charge )  - $order->total_discount}} </p>
        </div>

    </div>
</body>
</html>
