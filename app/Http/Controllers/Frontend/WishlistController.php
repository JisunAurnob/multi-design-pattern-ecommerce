<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Throwable;

class WishlistController extends Controller
{
    public function addToWishlist($id)
    {
        try {
            $wishlist = Wishlist::where('customer_id', auth('customer')->user()->id)->where('product_id', $id)->first();
            if ($wishlist === null) {
                $product = Product::findorfail($id);
                $wishlists = Wishlist::create([
                    'product_id' => $product->id,
                    'customer_id' => auth('customer')->user()->id,
                ]);
                Toastr::success('Product Added to your wishlist.');
                return redirect()->back();
            }
            Toastr::error('Already added to the wishlist');
            return redirect()->back();
        } catch (Throwable $throwable) {
            Toastr::error('Something went worng.');
            return redirect()->back();
        }
    }

    public function removewishlist($id)
    {
        try {
            $data = Wishlist::find($id);
            if ($data) {
                $data->delete();
                Toastr::success('Wishlist deleted successfully');
                return redirect()->back();
            }
            Toastr::error('Data not found');
            return redirect()->back();
        } catch (Throwable $throwable) {
            Toastr::error('Data not found');
            return redirect()->back();
        }
    }

    public function wishlist()
    {
        $wishlist = Wishlist::where('customer_id', auth('customer')->user()->id)->with('product')->get();
        // dd($wishlist->toArray());
        return view('frontend.pages.wishlist',compact('wishlist'));
    }
}
