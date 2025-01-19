<?php

namespace App\Http\Controllers\Frontend;

use Throwable;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Jobs\OrderMailJob;
use Illuminate\Support\Str;
use App\Models\OrderDetails;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\OrderActivity;
use App\Models\ProductRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\RedirectResponse;
use Devfaysal\Muthofun\Facades\Muthofun;
use Illuminate\Support\Facades\Validator;
use App\Models\ShippingCharge;
use App\Strategies\OrderContext;
use App\Strategies\OrderPlacementStrategy;
use App\Strategies\PaymentStrategy;

class CheckoutController extends Controller
{

    public function index(Request $request)
    {

        $carts = session('cart') ?? [];
        $total_discount = array_sum(array_column($carts, 'total_discount'));
        $total = array_sum(array_column($carts, 'total_price'));
        $grand_total = $total - $total_discount;
        $shipping_charge = ShippingCharge::all();
        return view('frontend.pages.checkout', compact(
            'total_discount',
            'grand_total',
            'shipping_charge',
            'total',
            'carts'
        ));
    }

    // public function orderPlace(Request $request): RedirectResponse
    // {
    //     // dd($request->all());
    //     $ship = ShippingCharge::where('slug' , $request->location)->first();
    //     if($ship){
    //         $delivery_charge = $ship->amount;
    //     }

    //    $validator = Validator::make($request->all(),[
    //     'receiver_name' => 'required',
    //     'receiver_phone' => 'required|regex:/^\+?(88)?0?1[3456789][0-9]{8}\b/',
    //     'email' => 'required|email',
    //     'receiver_address' => 'required',
    //     'location' => 'required',
    //    ]);
    //    if($validator->fails()){
    //         toastr()->error('Please fillup the Information!');
    //         return redirect()->back()->withErrors($validator)->withInput();
    //    }

    //     DB::beginTransaction();
    //     try {
    //         //calculate shipping charge

    //         $carts = session('cart') ?? [];
    //         $total_discount = array_sum(array_column($carts, 'total_discount'));
    //         $total = array_sum(array_column($carts, 'total_price')) + $request->amount;
    //         $grand_total = $total - $total_discount;

    //         if (!$carts) {
    //             // dd('here');
    //             toastr()->error('Your cart is empty ....!', 'warning');
    //             return redirect()->back();
    //         }


    //         $order = Order::create([
    //             // 'user_id' => auth()->user()->id,
    //             'customer_id' => auth('customer')->user()->id,
    //             'order_number' => Order::genrateOrderNumber(),
    //             'payable_total' => $grand_total,
    //             'receiver_name' => $request->receiver_name,
    //             'receiver_email' => $request->email,
    //             'receiver_phone' => $request->receiver_phone,
    //             'receiver_address' => $request->receiver_address,
    //             'total_discount' => $total_discount,
    //             'delivery_charge' => $delivery_charge ?? null,
    //             // 'coupon_code' => $requestData['coupon'] ?? null,
    //             'payment_method' => $request->payment_method,
    //             'payment_status' => Order::PENDING,
    //             'customer_note' => $request->input('customer_note'),
    //             // 'location' => $request->input('location'),
    //         ]);

    //         foreach ($carts as $cart) {
    //             $orderDetails = $order->details()->create([
    //                 'order_id' => $order->id,
    //                 'product_id' => $cart['product_id'],
    //                 'quantity' => $cart['quantity'],
    //                 'unit_price' => $cart['unit_price'],
    //                 'discount' => $cart['total_discount'],
    //                 'subtotal' => $cart['total_price'],
    //                 // 'attributes' => $cart['attributes'] ?? null,
    //             ]);
    //         }

    //         if ($order) {
    //             OrderActivity::create([
    //                 'order_id' => $order->id,
    //                 // 'updated_by' => auth('customer')->user()->id,
    //                 'order_remarks' => '',
    //                 'from_status' => '',
    //                 'to_status' =>  Order::PENDING,
    //             ]);
    //         }

    //         OrderMailJob::dispatch($order);
    //         //Muthofun::send(auth()->user()->phone_number, "Krafty: Your order no:$order->id has been placed. Soon we will contact with you. You can track your order here :https://krafty.furniture/profile");
    //         if ($order) {
    //             session()->forget('cart');
    //         }

    //         DB::commit();

    //         if ($order->payment_status == Order::PENDING && $order->payment_method == 'SSL') {

    //           $this->payWithSSLCommerz($order->id);
    //         }


    //         toastr()->success('Order placed successfully.', 'success');
    //         return redirect()->route('home');
    //     } catch (Throwable $th) {
    //         DB::rollBack();

    //         toastr()->error($th->getMessage());
    //         return redirect()->back();
    //     }
    // }

    public function orderPlace(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'receiver_name' => 'required',
            'receiver_phone' => 'required|regex:/^\+?(88)?0?1[3456789][0-9]{8}\b/',
            'email' => 'required|email',
            'receiver_address' => 'required',
            'location' => 'required',
        ]);

        if ($validator->fails()) {
            toastr()->error('Please fillup the Information!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Use the order placement strategy
            $orderContext = new OrderContext(new OrderPlacementStrategy());
            $order = $orderContext->executeOrder($request);

            // Process payment if needed
            $paymentStrategy = new PaymentStrategy();
            $paymentStrategy->processPayment($order);
            OrderMailJob::dispatch($order);
            
            if ($order) {
                session()->forget('cart');
            }
            toastr()->success('Order placed successfully.', 'success');
            return redirect()->route('home');
        } catch (\Throwable $th) {
            toastr()->error($th->getMessage());
            return redirect()->back();
        }
    }


    public function cancelOrder($order_id)
    {

        $order = Order::find($order_id);
        if ($order) {
            $order->update([
                'status' => 'cancelled'
            ]);
        }

        notify()->success('Order Cancelled');
        return redirect()->back();
    }

    public function customeProduct($id)
    {
        if (auth()->user()->role != 'admin') {
            $product_data = ProductRequest::find($id);
            $user = auth()->user();
            $sku = "RP" . date('dmyhis');

            try {
                $product = Product::create([
                    'category_id' => $product_data->category_id,
                    'sku' => $sku,
                    'title' => $product_data->product_name,
                    'slug' => Str::slug($product_data->product_name),
                    'unit_price' => $product_data->product_price,
                    'status' => 0
                ]);

                ProductImage::create([
                    'product_id' => $product->id,
                    'is_default' => 1,
                    'full' => $product_data->image
                ]);

                $order = Order::create([
                    'user_id' => $user->id,
                    'order_number' => Order::genrateOrderNumber(),
                    'payable_total' => $product_data->product_price,
                    'receiver_name' => $user->name,
                    'email' => $user->email,
                    'receiver_phone' => $user->phone_number,
                    'receiver_address' => $user->address,
                    'payment_type' => "Cash on Delivery",
                ]);

                OrderDetails::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'unit_price' => $product_data->product_price,
                    'sub_total' => $product_data->product_price
                ]);
                $product_data->update([
                    'status' => "ordered"
                ]);
                toastr()->success('Order created successfully.');
                return redirect()->route('profile');
            } catch (\Throwable $th) {
                toastr()->error($th->getMessage());
                return redirect()->back();
            }
        } else {
            Toastr::warning('Admin can not place order.');
            return redirect()->back();
        }
    }
}
