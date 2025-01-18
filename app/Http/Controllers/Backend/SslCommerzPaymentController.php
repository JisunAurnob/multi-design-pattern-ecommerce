<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CustomerPurchase;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class SslCommerzPaymentController extends Controller
{

    public function success(Request $request)
    {
        // dd('hi');
        // Log::debug($request->all());
       
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $order = Order::where('order_number', $tran_id)->first();
        if ($order) {

            if ($order->transaction_id == null) {
                $order->update([
                    'transaction_id' => $order->order_number
                ]);
            }

            $data = json_encode($request->all());

            //for mobile app
            if ($request->status == 'VALID') {
                $order->update([
                    'additional' => $data,
                    'payment_status' => $request->status,
                    'status' => Order::CONFIRM,
                ]);
                toastr()->success('Payment Successful! Thanks for your Order.', 'success');
                return redirect()->route('payment.success',['order_number'=>$order->order_number]);//create payment success page @waythin
            } else {
                $order->update([
                    'additional' => $data,
                    'payment_status' => $request->input('status'),
                ]);
                return redirect()->route('payment.failed');//create payment failed page @waythin
            } 
        }
        return redirect()->route('payment.oops');//create oops no order found page @waythin
      
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order = Order::where('transaction_id', $tran_id)->first();

        if ($order->payment_status == Order::PENDING) {
            $update_product = Order::where('transaction_id', $tran_id)
                ->update(['payment_status' => 'failed']);

            $query = "tran_id={$request->input('tran_id')}&amount=" . $request->input('amount') . '&order_id=' . $order->id;
            return redirect()->away(config('app.frontend_url') . 'failed?' . $query);
        } else if ($order->payment_status == Order::SUCCESS) {
            $query = "tran_id={$request->input('tran_id')}&amount=" . $request->input('amount') . '&order_id=' . $order->id;
            return redirect()->away(config('app.frontend_url') . 'already-paid?' . $query);
        } else {
            $query = "tran_id={$request->input('tran_id')}&amount=" . $request->input('amount') . '&order_id=' . $order->id;
            return redirect()->away(config('app.frontend_url') . 'invalid?' . $query);
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order = Order::where('transaction_id', $tran_id)->first();

        if ($order->payment_status == Order::PENDING) {
            $update_product = Order::where('transaction_id', $tran_id)
                ->update(['payment_status' => Order::CANCEL]);

            $query = "tran_id={$request->input('tran_id')}&amount=" . $request->input('amount') . '&order_id=' . $order->id;
            return redirect()->away(config('app.frontend_url') . 'cancel?' . $query);
        } else if ($order->payment_status == Order::SUCCESS) {
            $query = "tran_id={$request->input('tran_id')}&amount=" . $request->input('amount') . '&order_id=' . $order->id;
            return redirect()->away(config('app.frontend_url') . 'already-paid?' . $query);
        } else {
            $query = "tran_id={$request->input('tran_id')}&amount=" . $request->input('amount') . '&order_id=' . $order->id;
            return redirect()->away(config('app.frontend_url') . 'invalid?' . $query);
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->payable_total,);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }
}
