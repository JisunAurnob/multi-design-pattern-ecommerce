<?php

namespace App\Http\Controllers\Backend;


use Throwable;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Exports\CustomersExport;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function list()
    {


        if (\request()->search) {
            $customers = Customer::where('first_name', 'LIKE', '%' . \request()->search . '%')->paginate(5);
        } else {

            $customers = Customer::paginate(20);
        }
        return view('backend.customer.list', compact('customers'));
    }

    public function create()
    {
        return view('backend.customer.create');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'first_name'           => 'required|max:255',
            'last_name'            => 'required|max:255',
            // 'business_name'        => 'required|max:255',
            'email'                => 'required|unique:customers',
            'phone'                => 'required|digits:11|regex:/(01)[0-9]{9}/|unique:customers',
            'address'              => 'required',

            'password'             => 'required|min:6',

        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $image = null;
        if ($request->hasFile('image')) {
            $image = date('Ymdhsis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/customer', $image);
        }

        $customers = Customer::create([

            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            // 'business_name' => $request->business_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'remarks' => $request->remarks,
            'address' => $request->address,
            'image' => $image,
            'date_of_birth' => $request->date_of_birth,
        ]);
        notify()->success('Customer Created Successfully');
        return redirect()->route('customer.list');
    }

    public function edit($id)
    {
        $customers = Customer::find($id);
        return view('backend.customer.edit', compact('customers'));
    }

    public function update(Request $request, $id)
    {

        $customers = Customer::find($id);

        $validate = Validator::make($request->all(), [
            'name'           => 'required|max:255',
            // 'last_name'            => 'required|max:255',
            // 'business_name'        => 'required|max:255',
            // 'email'                => 'required',
            // 'phone'                => 'required|digits:11|regex:/(01)[0-9]{9}/',
            // 'address'              => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $image = $customers->getRawOriginal('image');
        if ($request->hasFile('image')) {
            $image = date('Ymdhsis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/customer', $image);
        }

        $customers->update([

            'name' => $request->name,
            // 'last_name' => $request->last_name,
            // 'business_name' => $request->business_name,
            // 'email' => $request->email,
            // 'phone' => $request->phone,
            'remarks' => $request->remarks,
            // 'address' => $request->address,
            'image' => $image,
            // 'date_of_birth' => $request->date_of_birth,
            'status' => $request->status,

        ]);
        notify()->success('Customer Updated Successfully');
        return redirect()->route('customer.list');
    }

    public function view($id)
    {
        $customers = Customer::find($id);
        $wishlist = Wishlist::where('customer_id', $customers->id)->with('product')->get();
        // dd($wishlist->all());
        return view('backend.customer.view', compact('customers','wishlist'));
    }

    public function delete($id)
    {
    
    try{
        $test = Customer::find($id);
        if ($test) {
            $test->delete();
            notify()->success('Customer Deleted Successfully');
            return redirect()->route('customer.list');
        } 
    }   
        
        catch(Throwable) {
            notify()->error('This Customer cannot be deleted!');
            return redirect()->route('customer.list');
        }
    }


    public function excelExport(){
       
        // dd('hi');
        return Excel::download(new CustomersExport, 'customer_list.xlsx');
    }
}
