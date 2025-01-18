<?php

namespace App\Http\Controllers\Frontend;

use Throwable;
use App\Models\User;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Wishlist;
use App\Rules\OldPassword;
use App\Models\OrderDetails;
use App\Models\ReviewRating;
use Illuminate\Http\Request;
use App\Models\OrderActivity;
use App\Models\ProductRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function profile()
    {
        $orders = Order::where('customer_id',auth('customer')->user()->id)->orderBy('id','desc')->paginate(5);
        $wishlists = Wishlist::with('product')->orderBy('id', 'desc')->paginate(5);
        // $wishlists = Wishlist::where('customer_id', auth('customer')->user()->id)->with('products')->orderBy('id', 'desc')->paginate(5);
        $total_order['total_order']=Order::count();
        $total_order['pending_order']=Order::where('status','pending')->count();
        $total_order['delivered_order']=Order::where('status','delivered')->count();

        return view('frontend.pages.profile.index',compact('orders','wishlists','total_order'));
    }

    public function profileUpdate(Request $request): RedirectResponse
    
    { 
        try {
            $user = Customer::where('id',auth('customer')->user()->id)->first();

            $data = ([
                'name'          => $request->input('name'),
                'address'       => $request->input('address'),
                'phone'         => $request->input('phone'),
                'email'         => $request->input('email'),
                'gender'         => $request->input('gender'),
                
            ]);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $location = 'customer';
                $fileName = uniqid('user'.strtotime(date('y-m-d')), true).'.'.$file->getClientOriginalExtension();

                $path = $file->storeAs($location, $fileName);

                $data['image'] = $fileName;
            }
            $user->update($data);
            Toastr::success('Profile updated successfully.');
            return redirect()->back();
        }catch (Throwable $throwable){
            Toastr::error('Error occurred while updating profile.');
            return redirect()->back();
        }
    }

    public function passwordUpdate(Request $request): RedirectResponse
    {
        $data = User::where('id',auth()->user()->id)->first();
        $request->validate([
            'old_password' => ['required', new OldPassword()],
            'new_password' => 'required|min:5',
            'password_confirmation'=> ['same:new_password']
        ]);

        try {
           $data->update([
                'password' => bcrypt($request->input('new_password')),
            ]);
            Auth::logout();
            Toastr::success('Password updated successfully.');
            return redirect()->route('home');
        } catch (Throwable $throwable) {
            Toastr::error('Error occurred while updating profile.');
            return redirect()->back();
        }
    }

    public function trackOrder(Request $request, $order_no)
    {
        // $search = $request->order_number;
        // $orders = Order::where('order_number','LIKE','%'.$search.'%')->get();
        $order = Order::where('order_number', $order_no )->with('order_activity')->first();
        return view('frontend.pages.track_order',compact('order'));
    }

    public function cancelForm($id){
        $order_id = $id;
        return view('frontend.pages.profile.cancel_form', compact('order_id'));
    }

    public function orderCancel(Request $request, $id)
    {
        // dd($request->all());
        try{
            DB::beginTransaction();
            
            $order = Order::find($id);
            if ($order->status == 'pending' ) {
                $order->update([
                    'status'=>'canceled',
                    'customer_note' =>$request->customer_note,
                ]);

                OrderActivity::create([
                    'order_id' => $id,
                    // 'updated_by' => auth('customer')->user()->id,
                    'order_remarks' => '',
                    'from_status' => $order->status,
                    'to_status' =>  Order::CANCEL,
                ]);

                DB::commit();
                Toastr::success('Order Cancelled successfully.');
                return redirect()->route('profile');
            }
            else{
                Toastr::error('You can not cancel the order');
                return redirect()->back();
            }
        }
        catch(Throwable $e){
            DB::rollBack();
            Toastr::error($e->getMessage());
            return redirect()->back();
        }
           
    }

    public function viewOrder($id){
    //    dd($id);
        $order = Order::where('order_number', $id)->first();
        if($order){
            return view('frontend.pages.order_view', compact('order'));
        }
        Toastr::error('Order not found!');
        return redirect()->back();
    }

    public function reviewRating($order_details_id ,$product_id){
        // dd($order_details_id);
        $order_details = OrderDetails::find($order_details_id);
        $order_number = $order_details->order->order_number;
        return view('frontend.pages.review_form', compact('order_details_id', 'product_id', 'order_number'));
    }

    public function reviewRatingPost(Request $request, $order_details_id, $product_id){
       
        $validate = Validator::make($request->all(), [
            'rate' => 'required|numeric|min:1|max:5',
            // 'review' => 'required',
        ]);
        
        if($validate->fails()){
            toastr()->error($validate->getMessageBag());
            return redirect()->back()->withErrors($validate)->withInput();
       }
        
    //    try{
        // dd($order_details_id);
        $order_detail = OrderDetails::where('id', $order_details_id)
        ->with('review_rating')
        ->first();
        
        // dd($order_detail);
        if($order_detail->review_rating()->doesntExist()){
            if($order_detail->order->status == 'success'){
                // dd('hi');
                $reviewRating = ReviewRating::create([
                    'customer_id' => Auth::guard('customer')->user()->id,
                    'order_details_id' => $order_detail->id,
                    'rating' => $request->rate,
                    'comment' => $request->review,
                    'status' => $order_detail->order->status,
                    'product_id' => $product_id,
                    // 'title' => $request->title
                ]);
                Toastr::success('Review posted successfully!');
                return redirect()->route('profile');
            }
            Toastr::error('Order not yet success.');
            return redirect()->back();
        }
        Toastr::error('You reviewed this product!');
        return redirect()->route('view.order',$order_detail->order->order_number);
    //    }
    //    catch(Throwable $e){
    //     Toastr::error($e->getMessage());
    //     return redirect()->back();
    //    }
    }
}
