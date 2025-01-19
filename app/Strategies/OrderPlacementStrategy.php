<?php

// app/Strategies/OrderPlacementStrategy.php
namespace App\Strategies;

use App\Models\Order;
use App\Models\OrderActivity;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderPlacementStrategy implements OrderStrategy
{
    public function placeOrder(Request $request)
    {
        $deliveryCharge = $this->getShippingCharge($request->location);
        $carts = session('cart') ?? [];

        if (!$carts) {
            toastr()->error('Your cart is empty ....!', 'warning');
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            $totalDiscount = array_sum(array_column($carts, 'total_discount'));
            $total = array_sum(array_column($carts, 'total_price')) + $request->amount;
            $grandTotal = $total - $totalDiscount;

            $order = Order::create([
                'customer_id' => auth('customer')->user()->id,
                'order_number' => Order::genrateOrderNumber(),
                'payable_total' => $grandTotal,
                'receiver_name' => $request->receiver_name,
                'receiver_email' => $request->email,
                'receiver_phone' => $request->receiver_phone,
                'receiver_address' => $request->receiver_address,
                'total_discount' => $totalDiscount,
                'delivery_charge' => $deliveryCharge,
                'payment_method' => $request->payment_method,
                'payment_status' => Order::PENDING,
                'customer_note' => $request->input('customer_note'),
            ]);

            foreach ($carts as $cart) {
                $order->details()->create([
                    'order_id' => $order->id,
                    'product_id' => $cart['product_id'],
                    'quantity' => $cart['quantity'],
                    'unit_price' => $cart['unit_price'],
                    'discount' => $cart['total_discount'],
                    'subtotal' => $cart['total_price'],
                ]);
            }

            OrderActivity::create([
                'order_id' => $order->id,
                'order_remarks' => '',
                'from_status' => '',
                'to_status' => Order::PENDING,
            ]);

            DB::commit();

            return $order;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    private function getShippingCharge($location)
    {
        $shipping = ShippingCharge::where('slug', $location)->first();
        return $shipping ? $shipping->amount : null;
    }
}
