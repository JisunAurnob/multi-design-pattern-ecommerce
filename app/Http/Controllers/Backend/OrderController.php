<?php

namespace App\Http\Controllers\Backend;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Role;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OnlinePayment;
use App\Models\OrderActivity;
use App\Models\CustomerAddress;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\OrderUpdateNotification;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function list()
    {
        // dd(request()->status);

        if (request()->status) {
            if (\request()->search) {

                $orders = Order::where('status', request()->status)->where('order_number', 'LIKE', '%' . \request()->search . '%')->orderBy('id', 'DESC')->paginate(20);
            } else {
                $orders = Order::where('status', request()->status)->orderBy('id', 'DESC')->paginate(20);
            }
        } else {

            if (\request()->search) {
                $orders = Order::where('order_number', 'LIKE', '%' . \request()->search . '%')->orderBy('id', 'DESC')->paginate(15);
            } else {
                $orders = Order::orderBy('id', 'DESC')->paginate(15);
            }
        }


        return view('backend.order.list', compact('orders'));
    }

    public function view($id)
    {
        $order = Order::with('details.product')->find($id);

        // dd($order->toArray());
        $delivery = Role::with('deliveryMan')->where('slug', 'delivery-man')->first();

        return view('backend.order.view', compact('order', 'delivery'));
    }


    public function update(Request $request, $id)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'status' => 'required|in:pending,processing,cancel,delivered,confirm,dispatch,return',
                // 'pickup_id'=>'required_if:status,pick-up',
                // 'delivery_id'=>'required_if:status,delivered',
            ]
        );

        if ($validator->fails()) {
            notify()->error($validator->getMessageBag());
            return redirect()->back()->withInput();
        }

        $order = Order::find($id);

        if ($order) {
            OrderActivity::create([
                'order_id' => $id,
                'updated_by' => auth()->user()->id,
                'order_remarks' => $request->order_remarks,
                'from_status' => $order->status,
                'to_status' =>  $request->status,
            ]);

            $order->update([
                'status'        => $request->status,
                'order_remarks' => $request->order_remarks,
                // 'delivery_charge' => $request->delivery_charge,
                // 'delivery_id' => $request->delivery_id,
                // 'pickup_id' => $request->pickup_id,
            ]);

            // if (!empty($order->customer->email)) {

            //     Notification::send($order->customer, new OrderUpdateNotification($order));
            // }

            notify()->success('Status updated');
            return redirect()->back();
        }
        notify()->error('No order found.');
        return redirect()->back();
    }




    public function invoice($id)
    {

        $now = Carbon::now();
        $order = Order::with('details.product')->find($id);


        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($options);
        $html = view('backend.order.invoice', compact('order', 'now'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream();
    }

 

   
}
