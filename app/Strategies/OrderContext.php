<?php
// app/Strategies/OrderContext.php
namespace App\Strategies;

use Illuminate\Http\Request;

class OrderContext
{
    protected $orderStrategy;

    public function __construct(OrderStrategy $orderStrategy)
    {
        $this->orderStrategy = $orderStrategy;
    }

    public function executeOrder(Request $request)
    {
        return $this->orderStrategy->placeOrder($request);
    }
}
