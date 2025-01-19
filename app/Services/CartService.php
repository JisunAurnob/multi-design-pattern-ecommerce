<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;

class CartService
{
    public function getCart()
    {
        return session()->get('cart') ?? [];
    }

    public function getTotalDiscount($carts)
    {
        return array_sum(array_column($carts, 'total_discount'));
    }

    public function getTotal($carts)
    {
        return array_sum(array_column($carts, 'total_price'));
    }

    public function addToCart($product)
    {
        $cart = $this->getCart();
        if (array_key_exists($product->id, $cart)) {
            $cart[$product->id]['quantity']++;
            $cart[$product->id]['total_discount'] = ((int)$cart[$product->id]['quantity'] * (float)$cart[$product->id]['discount']['amount']);
            $cart[$product->id]['total_price'] = ((int)$cart[$product->id]['quantity'] * (float)$cart[$product->id]['unit_price']);
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'quantity' => 1,
                'unit_price' => $product->price,
                'discount' => $product->discount,
                'total_discount' => $product->discount['amount'] ?? 0,
                'image' => optional($product->productImages)->first()->image,
                'total_price' => (float)$product->price,
            ];
        }

        session(['cart' => $cart]);
    }

    public function updateCart(Request $request)
    {
        if ($request->has('cart_id') && session()->has('cart')) {
            $id = $request->input('cart_id');
            $product = Product::find($id);
            $cart = $this->getCart();

            if ($product->quantity < $request->quantity) {
                throw new \Exception("Product quantity is not sufficient.");
            }

            $cart[$id]['quantity'] = $request->quantity;
            $cart[$id]['total_price'] = ((int)$cart[$id]['quantity'] * (float)$cart[$id]['unit_price']);
            $cart[$id]['total_discount'] = (int)$cart[$id]['quantity'] * (float)$cart[$id]['discount']['amount'];

            session(['cart' => $cart]);
        }
    }

    public function deleteFromCart($id)
    {
        $cart = $this->getCart();
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    public function clearCart()
    {
        session()->forget('cart');
    }
}