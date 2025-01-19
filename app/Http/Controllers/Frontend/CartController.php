<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use function session;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function cart()
    {
        $carts = $this->cartService->getCart();
        $total_discount = $this->cartService->getTotalDiscount($carts);
        $total = $this->cartService->getTotal($carts);
        $grand_total = $total - $total_discount;

        return view('frontend.pages.shopping-card', compact('carts', 'total_discount', 'total', 'grand_total'));
    }

    public function addToCart($id): RedirectResponse
    {
        $product = Product::where('id',$id)->with('productImages')->first();

        if ($product->quantity <= 0) {
            Toastr::error('This product is not available at this moment ....!', 'warning');
            return redirect()->back();
        }

        $this->cartService->addToCart($product);

        Toastr::success('Product added to the cart!', 'success');
        return redirect()->back();
    }

    public function updateCart(Request $request): RedirectResponse
    {
        $this->cartService->updateCart($request);

        Toastr::success('Cart updated successfully.', 'success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('cart');
    }

    public function delete($id): RedirectResponse
    {
        $this->cartService->deleteFromCart($id);

        Toastr::success('Product removed successfully!', 'success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('cart');
    }

    public function destroy(): RedirectResponse
    {
        $this->cartService->clearCart();

        Toastr::success('Cart cleared successfully!', 'success', ["positionClass" => "toast-top-right"]);
        return redirect()->route('cart');
    }
}