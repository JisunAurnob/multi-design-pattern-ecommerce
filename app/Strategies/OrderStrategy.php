<?php
namespace App\Strategies;

use Illuminate\Http\Request;

interface OrderStrategy
{
    public function placeOrder(Request $request);
}
