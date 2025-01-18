<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order()
    {
        return view('frontend.pages.order');
    }

    public function successPage()
    {
        $orderNumber=request()->order_number;
        return view('frontend.pages.order-success',compact('orderNumber'));
    }
}
