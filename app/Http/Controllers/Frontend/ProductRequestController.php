<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\ProductRequest;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Throwable;

class ProductRequestController extends Controller
{

    public function productRequest(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'product_name'  => 'required',
                'details'       => 'required',
                'image'         => 'required|mimes:jpg,jpeg,png'
            ]);

            $data = [
                'user_id'       => auth()->user()->id,
                'product_name'  => $request->product_name,
                'details'       => $request->details,
                'category_id'   => 1,
            ];

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $location = 'requests';
                $fileName = uniqid('request_'.strtotime(date('y-m-d')), true).'.'.$file->getClientOriginalExtension();

                $path = $file->storeAs($location, $fileName);

                $data['image'] = $path;
            }

            ProductRequest::create($data);
            Toastr::success('Request submitted successfully.');
            return redirect()->route('home');
        } catch (Throwable $th) {
            Toastr::error('Something went wrong.');
            return redirect()->route('home');
        }


    }
}
