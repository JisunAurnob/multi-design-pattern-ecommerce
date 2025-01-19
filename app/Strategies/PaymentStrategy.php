<?php

// app/Strategies/PaymentStrategy.php
namespace App\Strategies;

use App\Models\Order;

use App\Library\SslCommerz\SslCommerzNotification;

class PaymentStrategy
{
    public function processPayment(Order $order)
    {
        if ($order->payment_status == Order::PENDING && $order->payment_method == 'SSL') {
            // Call SSLCommerz payment gateway
            $this->payWithSSLCommerz($order->id);
        }
    }

    public function payWithSSLCommerz($baseOrderId)
    {
        $baseOrder = Order::with('customer')->find($baseOrderId);
        //        $user = auth('api')->user();
        $customer = $baseOrder->customer;

        $post_data = [];
        $post_data['total_amount'] = $baseOrder->payable_total + $baseOrder->delivery_charge; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $baseOrder->order_number; // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $baseOrder->shipping_name ?? $customer->name;
        if (!empty($baseOrder->receiver_email)) {
            $post_data['cus_email'] = $baseOrder->receiver_email;
        } elseif (!empty($customer->email)) {
            $post_data['cus_email'] = $customer->email;
        } else {
            $post_data['cus_email'] = "";
        }
        $post_data['cus_add1'] = $baseOrder->address;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $baseOrder->receiver_phone ?? $customer->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "passon";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "wear";
        $post_data['product_category'] = "lifestyle";
        $post_data['product_profile'] = "physical-goods";

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }
}
