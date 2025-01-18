<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use function session;

class CartController extends Controller
{
    public function cart()
    {
        $carts = session()->get('cart') ?? [];
        // dd($carts);
        $total_discount = array_sum(array_column($carts, 'total_discount'));
    //    dd($total_discount);
        $total = array_sum(array_column($carts, 'total_price'));
        
        $grand_total = $total - $total_discount;
        return view('frontend.pages.shopping-card',compact('carts', 'total_discount', 'total', 'grand_total'));
    }


    public function addToCart($id): RedirectResponse
    {
        // dd('hi');
        $product = Product::findorfail($id);
        $img = optional($product->images)->first();
       
        if ($product->quantity <= 0) {
            Toastr::error('This product is not available at this moment ....!', 'warning');
            return redirect()->back();
        }
        $cart = session()->has('cart') ? session()->get('cart') : [];


        if (array_key_exists($product->id, $cart)) {
            $cart[$product->id]['quantity']++;
            $cart[$product->id]['total_discount'] = ((int)$cart[$product->id]['quantity'] * (float)$cart[$product->id]['discount']['amount']);
            $cart[$product->id]['total_price'] = ((int)$cart[$product->id]['quantity'] * (float)$cart[$product->id]['unit_price']);
        } else {
            $cart[$product->id] = [
                'product_id'     => $product->id,
                'name'          => $product->name,
                'quantity'       => 1,
                'unit_price'     => $product->price,
                'discount'       => $product->discount,
                'total_discount' => $product->discount['amount'] ?? 0,
                // 'image'          => optional($img)->full,
                 'image'          => $product->image,
                'total_price'    => ((float)$product->price),
                'attributes'     => json_encode(request()->attribute),
                'is_advance'     => $product->is_advance
            ];
        }
        session(['cart' => $cart]);
        toastr()->success('Product added to the cart!', 'success');
        // return redirect()->route('cart');
        return redirect()->back();

    }


    public function updateCart(Request $request): RedirectResponse
    {
        // dd($request->all());
        if ($request->has('cart_id') and session()->has('cart')) {
            $id = $request->input('cart_id');
            $product = Product::find($id);
            try {
                $cart = session()->get('cart');

                if ($product->quantity < $request->quantity) {
                    toastr()->warning("Give us time to make your product", "Complete Product Available $product->quantity");
                    return redirect()->back();
                }

                //dd(gettype($myCart[2]['product_price']));
                if ($request->quantity < 1) {
                    toastr()->warning("Cart Error", "Cart 1 or More Product");
                    return redirect()->back();
                }


                $cart[$id]['quantity'] = $request->quantity;

                $cart[$id]['total_price'] = ((int)$cart[$id]['quantity'] * (float)$cart[$id]['unit_price']);
                $cart[$id]['total_discount'] = (int)$cart[$id]['quantity'] * (float)$cart[$id]['discount']['amount'];
                session()->put('cart', $cart);
                Toastr::success('Cart updated successfully.', 'success', ["positionClass" => "toast-top-right"]);
                return redirect()->route('cart');
            } catch (\Throwable $th) {
                Toastr::error('Something went Wrong.', 'error', ["positionClass" => "toast-top-right"]);
                return redirect()->route('cart');
            }
        }
        return redirect()->back();
    }

    public function delete($id): RedirectResponse
    {
        $cart = session('cart');
        unset($cart[$id]);
        session()->put('cart', $cart);
        Toastr::success('Product removed successfully!', 'success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('cart');
    }

    public function destroy(): RedirectResponse
    {
        session()->forget('cart');
        Toastr::success('Cart cleared successfully!', 'success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('cart');
    }
}
