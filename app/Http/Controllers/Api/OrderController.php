<?php

namespace App\Http\Controllers\Api;

use Throwable;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\OrderDetails;
use App\Models\ReviewRating;
use Illuminate\Http\Request;
use App\Models\OrderActivity;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Notifications\OrderNotification;
use Devfaysal\Muthofun\Facades\Muthofun;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\OrderHistoryResource;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    public $line_discount = 0;

    public function placeOrder(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'total_amount' => 'required|numeric',
            'total_discount' => 'required|numeric',
            'products.*.product_id' => 'required|integer',
            // 'delivery_charge' => 'required|integer',
            'receiver_name' => 'required',
            'receiver_email' => 'nullable|email',
            'receiver_phone' => 'required|min:11',
            'receiver_address' => 'required',
            'payment_method' => 'required',
            'order_from' => 'required',
            'division' => 'required',
            'district' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->responseWithError($validator->getMessageBag());
        }
        try {
            DB::beginTransaction();
            //step1 : insert data into orders table
            $settings = Setting::first();
            $order = Order::create([
                'customer_id' => auth('api')->user()->id,
                'order_number' => rand(100,999).date('Ymdhis'),
                'total_amount' => $request->total_amount,
                'total_discount' => $request->total_discount,
                'payable_total' => (float) $request->total_amount - $request->total_discount,
                'receiver_name' => $request->receiver_name,
                'receiver_phone' => $request->receiver_phone,
                'receiver_email' => $request->receiver_email,
                'receiver_address' => $request->receiver_address,
                'delivery_charge' => $settings->delivery_charge,
                'customer_note' => $request->customer_note,
                'order_from' => $request->order_from,
                'payment_method' => $request->payment_method,
                'transaction_id' => date('Ymdhis')
            ]);

            //step 2 : insert product data into Order_details table

            foreach ($request['products'] as $product) {

                $get_product = Product::find($product['product_id']);

                //check product exist or not
                if ($get_product) {

                    OrderDetails::create([
                        'product_id' => $get_product->id,
                        'order_id' => $order->id,
                        'quantity' => $product['quantity'],
                        'unit_price' => $get_product->price,
                        'extra_charge' => array_key_exists('extra_charge', $product) ? $product['extra_charge'] : 0,
                        'extra_charge_reason' => array_key_exists('extra_charge_reason', $product) ? $product['extra_charge_reason'] : null,
                        'subtotal' => $get_product->price * $product['quantity'],
                        'discount' => $this->getDiscount($get_product, $product['quantity']),
                        'payable_subtotal' => ($get_product->price * $product['quantity']) - $this->line_discount,
                    ]);
                } else {
                    DB::rollBack();
                    return $this->responseWithError('Product not found.');
                }
            }

            OrderActivity::create([
                'order_id' => $order->id,
                // 'updated_by' => auth()->user()->id,
                // 'from_status' => $order->status,
                'to_status' => Order::PENDING,
            ]);

            if (!empty($order->customer->email)) {
                Notification::send($order->customer, new OrderNotification($order));
            }

            if (!empty($order->customer->phone)) {
                Muthofun::send($order->customer->phone, 'BDWash,অভিনন্দন! আপনার অডার টি (ORD_NO:'.$order->order_number.') সফল হয়েছে।');
            }

            DB::commit();
            return $this->responseWithSuccess($order->order_number, 'Order placed Successfully.');
        } catch (\Throwable $exception) {
            DB::rollBack();
            return $this->responseWithError($exception->getMessage());
        }
    }




    public function getDiscount($product, $quantity)
    {
        if ($product->discount_type == 'amount') {
            $discount = $product->discount * $quantity;
            $this->line_discount = $discount;
            return $discount;
        }

        $discount = (($quantity * $product->price) * $product->discount) / 100;
        $this->line_discount = $discount;
        return $discount;
    }

    public function orderHistory()
    {
        $orders = Order::where('customer_id', auth('api')->user()->id)->orderBy('id', 'DESC')->get();


        return $this->responseWithSuccess(OrderHistoryResource::collection($orders), 'Order list.');
    }

    public function viewOrder($id)
    {
        $order = Order::with(['deliveryMan','pickupMan'])->find($id);
        // dd($order);
        return $this->responseWithSuccess(OrderResource::make($order), 'Single Order View ');
    }

    public function cancelOrder($id)
    {
        $order=Order::find($id);
        if($order && $order->status==Order::PENDING)
        {
            $order->update([
                'status'=>Order::CANCEL
            ]);
            return $this->responseWithSuccess($order,'Order cancelled successfully.');
        }
        return $this->responseWithError($order,'Only pending order can cancel.');
       
    }


    public function rateReview(Request $request, $id){
       
            $validate = Validator::make($request->all(), [
                'order_id' => 'required',
                'comment' => 'required',
                'rating' => 'required|numeric|min:1|max:5',
            ]);
            
            if ($validate->fails()) {
                return $this->responseWithError($validate->getMessageBag());
            }
            
           try{
            $order = Order::with('review_rating')->find($id);
            if($order->review_rating()->doesntExist()){
                if($order->status == 'success'){
                    // dd('hi');
                    $reviewRating = ReviewRating::create([
                        'customer_id' => $order->customer_id,
                        'order_id' => $id,
                        'rating' => $request->rating,
                        'comment' => $request->comment,
                        'status' => $order->status,
                        'title' => $request->title
                    ]);
                    return $this->responseWithSuccess($reviewRating,'Your review submitted successfully.');
                }
                return $this->responseWithError('Order not yet success.');
            }
            return $this->responseWithError('Review exist.');
           }
           catch(Throwable $e){
            return $this->responseWithError($e->getMessage());
           }
    }

    public function orderTrack($id){
        
        $order = Order::find($id);
        if($order){
            $orderTrack = OrderActivity::where('order_id', $id)->get();
            return $this->responseWithSuccess($orderTrack, 'Order Activities');
        }
        return $this->responseWithError('No order found!');

        
    }
}
