<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ReviewRating;
use Illuminate\Support\Facades\File;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ProductController extends Controller
{
    public function list()
    {
        if (\request()->search) {
            $products = Product::where('name', 'LIKE', '%' . \request()->search . '%')->paginate(10);
        } else {

            $products = Product::orderBy('id', 'DESC')->paginate(10);
        }

        return view('backend.product.list', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('parent_id', null)->with('childs')->get();
        $brands = Brand::all();
        $hi_pen = '';
        return view('backend.product.create', compact('categories', 'hi_pen', 'brands'));
    }

    public function store(Request $request)
    {
        // dd($request->toArray());
        $validator = Validator::make($request->all(), [

            'name'              => 'required|unique:products',
            'short_description' => 'required',
            'price'             => 'required|numeric',
            'quantity'          => 'required|numeric|max:10000',
            'category_id'       => 'required|numeric',
            'discount'      => 'required|numeric|min:0',
            'discount_type'     => [
                'required_if:discount,>,0',
                'in:percentage,amount',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value === 'percentage' && ($request->input('discount') < 0 || $request->input('discount') > 100)) {
                        $fail('The ' . $attribute . ' must be between 0 and 100 when discount type is percentage.');
                    }
                    if ($value === 'amount' && ($request->input('discount') < 0 || $request->input('discount') > $request->input('price'))) {
                        $fail('The ' . $attribute . ' must be between 0 and the price when discount type is amount.');
                    }
                },
            ],
            // 'brand_id'          => 'required|numeric',
            'status'            => 'required',
            'multiple_images'  => 'required',
            
        ]);


        if ($validator->fails()) {
            return response()->json([
                'validation_error' => $validator->getMessageBag()
            ]);
        }
        $image = null;
        // if ($request->hasFile('image')) {
        //     $image = date('Ymdhsis') . '.' . $request->file('image')->getClientOriginalExtension();
        //     $request->file('image')->storeAs('/products', $image);
        // }
        // dd((int)$request->brand_id);
        $product = Product::create([
            'name'              => $request->name,
            'slug'              => Str::slug($request->name),
            'short_description' => $request->short_description,
            'long_description'  => $request->long_description,
            'image'             => $image,
            'price'             => $request->price,
            'quantity'          => $request->quantity,
            'category_id'       => $request->category_id,
            'brand_id'          => (int)$request->brand_id,
            'discount'          => $request->discount,
            'discount_type'     => $request->discount_type,
            'is_feature'        => $request->is_feature,
            'meta_title'        => $request->meta_title,
            'meta_description'  => $request->meta_description,
            'min_order_quantity' => $request->min_order_quantity,
            'max_order_quantity' => $request->max_order_quantity,
            'status'            => $request->status,
        ]);


        if (isset($request->multiple_images)) {
            foreach ($request->multiple_images as $imageFile) {
                $image = date('Ymdhsis').Str::random(4). '.' . $imageFile->getClientOriginalExtension();
                $imageFile->storeAs('/products', $image);

                ProductImage::create([
                    'product_id'             => $product->id,
                    'image'             => $image,
                    'status'             => 1,
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'data' => route('admin.product.list'),
            'message' => "Product Created Successfully",
            'code' => 200,
        ]);

        // notify()->success('Product Created Successfully');
        // return to_route('admin.product.list');
    }

    public function edit($slug)
    {
        $categories = Category::where('parent_id', null)->with('childs')->get();
        $brands     = Brand::all();
        $product    = Product::where('slug', $slug)->with('productImages')->first();
        $hi_pen = '';
        // dd($product->toArray());
        return view('backend.product.edit', compact('categories', 'brands', 'product', 'hi_pen'));
    }
    public function update(Request $request, $slug)
    {

        $product = Product::where('slug', $slug)->first();
        $validator = Validator::make($request->all(), [
            // 'name'              => 'required|unique:products,name, '. $slug,
            'name'              => 'required',
            'short_description' => 'required',
            'price'             => 'required|numeric',
            'quantity'          => 'required|numeric',
            'category_id'       => 'required|numeric',
            // 'brand_id'          => 'required|numeric',
            'status'            => 'required',
            'discount'      => 'required|numeric|min:0',
            'discount_type'     => [
                'required_if:discount,>,0',
                'in:percentage,amount',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value === 'percentage' && ($request->input('discount') < 0 || $request->input('discount') > 100)) {
                        $fail('The ' . $attribute . ' must be between 0 and 100 when discount type is percentage.');
                    }
                    if ($value === 'amount' && ($request->input('discount') < 0 || $request->input('discount') > $request->input('price'))) {
                        $fail('The ' . $attribute . ' must be between 0 to the product price when discount type is amount.');
                    }
                },
            ],


        ]);

        // dd($request->toArray());
        // if ($validator->fails()) {
        //     // dd($validator->getMessageBag());
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        if ($validator->fails()) {
            return response()->json([
                'validation_error' => $validator->getMessageBag()
            ]);
        }

        // if ($request->discount > 0) {
        //     $validator = Validator::make($request->all(), [
        //         'discount_type' => 'required_if:discount,>,0|in:amount,percentage', // discount_type is nullable as well
        //     ], [
        //         'discount_type' => 'Discount type required when discount > 0 .'
        //     ]);

        //     // if ($validator->fails()) {
        //     //     // dd($validator->getMessageBag());
        //     //     return redirect()->back()->withErrors($validator)->withInput();
        //     // }
        //     if ($validator->fails()) {
        //         return response()->json([
        //             'validation_error' => $validator->getMessageBag()
        //         ]);
        //     }
        // }


        $image = $product->getRawOriginal('image'); //112.jpg
        if ($request->hasFile('image')) {
            $remove = public_path() . '/uploads/products/' . $image;
            File::delete($remove);
            $image = date('Ymdhsis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/products', $image);
        }



        $product->update([
            'name'              => $request->name,
            // 'slug'              => Str::slug($request->name),
            'short_description' => $request->short_description,
            'long_description'  => $request->long_description,
            'price'             => $request->price,
            'quantity'          => $request->quantity,
            'category_id'       => $request->category_id,
            'brand_id'          => (int)$request->brand_id,
            'discount'          => $request->discount,
            'discount_type'     => $request->discount_type,
            'is_feature'        => $request->is_feature,
            'meta_title'        => $request->meta_title,
            'meta_description'  => $request->meta_description,
            'min_order_quantity' => $request->min_order_quantity,
            'max_order_quantity' => $request->max_order_quantity,
            'status'            => $request->status,
        ]);

        if (isset($request->multiple_images)) {
            foreach ($request->multiple_images as $imageFile) {
                $image = date('Ymdhsis').Str::random(4). '.' . $imageFile->getClientOriginalExtension();
                $imageFile->storeAs('/products', $image);

                ProductImage::create([
                    'product_id'             => $product->id,
                    'image'             => $image,
                    'status'             => 1,
                ]);
            }
        }

        notify()->success('Product Updated Successful');
        return response()->json([
            'success' => true,
            'data' => route('admin.product.list'),
            'message' => "Product Created Successfully",
            'code' => 200,
        ]);
        // return to_route('admin.product.list');
    }

    public function delete($id)
    {
        try {

            $test = Product::find($id);
            if ($test) {
                $test->delete();
                notify()->success('Product Deleted Successfully');
                return redirect()->route('admin.product.list');
            }
        } catch (Throwable) {
            notify()->error('This Product Cannot Be Deleted');
            return redirect()->route('admin.product.list');
        }
    }

    public function imageDelete($id)
    {
        try {
            $productImage = ProductImage::find($id);
            if ($productImage) {
                $image = $productImage->getRawOriginal('image');
                $remove = public_path() . '/uploads/products/' . $image;
                // dd($remove);
                File::delete($remove);
                $productImage->delete();
                notify()->success('Product Image Deleted Successfully');
                return redirect()->back();
            }
        } catch (Throwable) {
            notify()->error('This Product Image Cannot Be Deleted');
            return redirect()->back();
        }
    }


    public function reviewList(){
        $list = ReviewRating::latest()->paginate(5);
        return view('backend.product.review_list', compact('list'));
    }

    public function statusUpdate(Request $request, $id){

        $review = ReviewRating::find($id);
        if (!$review) {
            return response()->json(['error' => 'Review not found'], 404);
        }

        $review->update([
            'approval_status' => $request->approval_status,
        ]);
        return response()->json(['message' => 'Approval status updated successfully']);
    }
}