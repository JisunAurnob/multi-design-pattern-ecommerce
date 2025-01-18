<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use Brian2694\Toastr\Facades\Toastr;

use Illuminate\Http\Request;
use Throwable;

class HomeController extends Controller
{
    public function home()
    {
        $sliders = Slider::all();
        // $categories=Category::where('parent_id',null)->with('childs')->get();
        $products=Product::with('productImages', 'review_rating')->get();
        $categories = Category::take(10)->get();
       
    return view('frontend.pages.index',compact('sliders','products','categories'));    
    }

    public function privacyPolicy()
    {
    return view('frontend.privacy_policy');    
    }

    public function list()
    {
        try {
            $product = Product::query()->with(['productImages'])->where('status', 'active');
            if (request()->query('sort') === 'default') {
                $products = $product->orderBy('id', 'desc');
            }
            if (request()->query('sort') === 'asc') {
                $products = $product->orderBy('title', 'asc');
            }
            if (request()->query('sort') === 'desc') {

                $products = $product->orderBy('title', 'desc');
            }
            if (request()->query('sort') === 'low') {
                $products = $product->orderBy('unit_price', 'asc');
            }
            if (request()->query('sort') === 'high') {
                $products = $product->orderBy('unit_price', 'desc');
            }
            if (request()->query('start_price') && request()->query('end_price')) {
                $products = $product->where('unit_price', '>=', request()->query('start_price'))
                    ->where('unit_price', '<=', request()->query('end_price'));
            }

            $products = $product->orderBy('id','desc')->paginate(20);
            return view('frontend.pages.kids',compact('products'));
        } catch (Throwable $throwable) {

            Toastr::error($throwable->getMessage());
            return redirect()->back();
        }
    }

    public function address()
    {
        return view('frontend.pages.address');
    }
}
