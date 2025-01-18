<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ReviewRating;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Throwable;

class ProductController extends Controller
{
    public function products()
    {
        try {
            if(request()->has('categoryName') && request()->categoryName != null){
                $kids=Category::where('name',request()->categoryName)->first();
                if($kids){
                    $product = Product::query()
                    ->with(['productImages'])
                    ->where('category_id', $kids->id) 
                    ->where('status', 'active');

                }
                else{
                    $product = Product::query()
                    ->with(['productImages'])
                    ->where('status', 'active');
                }
            }else{
                $product = Product::query()
                ->with(['productImages'])
                ->where('status', 'active');
            }

            $categories = explode('|', request()->get('category'));
            // dd($categories);
            if (request()->get('category')) {
                $products = $product->whereIn('category_id', $categories);
            }
        //    dd($categories);
            if (request()->query('sort') === 'default') {
                $products = $product->orderBy('id', 'desc');
            }
            if (request()->query('sort') === 'asc') {
                $products = $product->orderBy('name', 'asc');
            }
            if (request()->query('sort') === 'desc') {

                $products = $product->orderBy('name', 'desc');
            }
            if (request()->query('sort') === 'low') {
                $products = $product->orderBy('price', 'asc');
            }
            if (request()->query('sort') === 'high') {
                $products = $product->orderBy('price', 'desc');
            }
            if (request()->query('start_price') && request()->query('end_price')) {
                $products = $product->where('price', '>=', request()->query('start_price'))
                    ->where('price', '<=', request()->query('end_price'));
            }
            
            // $product->orderBy('id','desc');

            $products = $product->paginate(request()->query('show') ?? 12);
            $categories=Category::where('parent_id',null)->with('childs')->get();
            return view('frontend.pages.product.all',compact('products','categories'));
        } catch (Throwable $throwable) {

            Toastr::error($throwable->getMessage());
            return redirect()->back();
        }

    }


    public function view($slug)
    {
        
        try {
            $product = Product::with('productImages')->where('slug', $slug)->first();
            $product->review_rating = $product->review_rating()->where('approval_status', 'active')->paginate(5);
           
            $related_products = Product::with('productImages')->where('category_id', $product->category_id)
                ->where('status', 'active')->orderBy('id','desc')->get();
                // dd($product);
            if($product){
                $categories=Category::where('parent_id',null)->with('childs')->get();
                return view('frontend.pages.product.product-details',compact('product','related_products','categories'));
            }
            return redirect()->back();
        } catch (Throwable $throwable) {
            Toastr::error($throwable->getMessage());
            return redirect()->back();
        }
    }


    public function getProductByCategorySlug($slug)
    {
        $params = \request()->input();

        try {
            $category = Category::with('childs')->where('slug', $slug)->first();
            if(!$category){
                return redirect()->back();
            }
            $product = Product::with('productImages')->where('status', 'Active')->where('category_id', $category->id);
            if (isset($params['search'])) {
                $product->where('title', 'like', '%' . urldecode($params['search']) . '%')
                    ->orWhere('sku', 'like', '%' . urldecode($params['search']) . '%')
                    ->orWhere('slug', 'like', '%' . urldecode($params['search']) . '%');
            }
            $products = $product->paginate(20);
            $categories=Category::where('parent_id',null)->with('childs')->get();
            return view('frontend.pages.product.all',compact('products', 'categories'));

        } catch (Throwable $throwable) {

            return redirect()->back();
        }


    }


    public function productSearch(Request $request)
    {
        $products = '';
        $query = $request->get('query');
        if (request()->ajax()) {
            $products = Product::where('status', 'Active')->where('name', 'like', '%'.$query.'%')->paginate(12);
      
                return response()->json([
                    'success' => true,
                    'data' => $products,
                    'message' => "Product Data Loaded",
                    'code' => 200,
                ]);
        }

        if ($query) {
            $products = Product::where('status', 'Active')->with('images')->search($query)->paginate(12);
            return view('frontend.product.search',compact('products','query'));
        }
            return view('frontend.product.search',compact('products','query'));
    }

    public function productDetails()
    {
        return view('frontend.pages.product.product-details');
    }
}
