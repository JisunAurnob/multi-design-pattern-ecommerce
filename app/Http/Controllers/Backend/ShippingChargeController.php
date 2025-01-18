<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ShippingCharge;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ShippingChargeController extends Controller
{
    public function index()
    {
        $data = ShippingCharge::all();
        // dd($data);
        return view('backend.shipping.index',compact('data'));
    }

    public function create()
    {
        return view('backend.shipping.create');
    }

    public function store(Request  $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'location' => 'required',
                'amount' => 'required'
            ]);

            if($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }

            $data =  ShippingCharge::create([
                'location'=>$request->location,
                'amount'=> $request->amount,
                'slug' => Str::slug($request->location),
            ]);

            notify()->success('Shipping Charge successfully added');
            return redirect()->route('shipping.index');
        }catch (\Throwable $throwable){
            notify()->error('Something went wrong!');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $data = ShippingCharge::find($id);
        return view('backend.shipping.edit',compact('data'));
    }

    public function update(Request $request,$id)
    {
        try {
        $data = ShippingCharge::find($id);

            $validate = Validator::make($request->all(), [
                'location' => 'required',
                'amount' => 'required'
            ]);

            if($validate->fails()) {
                return redirect()->back()->withErrors($validate)->withInput();
            }
            if($data){
                 $data->update([
                'location'=>$request->location,
                'amount'=> $request->amount,
                'slug' => Str::slug($request->location),
            ]);

            notify()->success('Shipping Charge successfully updated');
            return redirect()->route('shipping.index');
            }
            notify()->error('Shipping Charge not found!');
            return redirect()->route('shipping.index');
           
        }catch (\Throwable $throwable){
            notify()->error('Something went wrong!');
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        try{
            $data = ShippingCharge::find($id);
            if($data){
                $data->delete();
                notify()->success('Data successfully deleted');
                return redirect()->back();
            }
            notify()->warning('Data not foind!');
            return redirect()->back();
        }catch(\Throwable $throwable){
            notify()->warning('Something went wrong!');
            return redirect()->back();
        }
    }
}
