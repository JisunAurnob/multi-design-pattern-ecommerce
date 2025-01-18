<?php

namespace App\Mail;
namespace App\Http\Controllers\Frontend;


use Carbon\Carbon;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Devfaysal\Muthofun\Facades\Muthofun;


class ResetPasswordController extends Controller
{
    public function passwordResetForm(){
        return view('frontend.pages.profile.reset_password');
    }

    public function resetPasswordContact(Request $request){
        $request->validate([
            'email' => 'required|email', 
        ]);

        $user = Customer::where('email', $request->email)->first();
        if ($user) {
            $token=Str::random(40);
            $email = $request->email;

            PasswordReset::updateOrCreate([
                'email' => $email,
            ],
            [
                'email' => $email,
                'token' => $token,
                'created_at' => now(),
            ]);
            $token_data = PasswordReset::where('email',$email )->first();
           
            Mail::to($email)->send(new \App\Mail\ResetMail($token_data));

            Toastr::success('Email sent to : '. $request->email);
            return redirect()->route('user.login');
        } else {
            Toastr::error('No User found!');
            return redirect()->back();
        }
    }


    public function resetPassword(Request $request, $token){

        $verifyToken = PasswordReset::where('token', $token)->first();

        if ($verifyToken === null) {
            Toastr::success('Token not found.');
            return redirect()->route('user.login');
        }
        elseif($verifyToken->created_at >= Carbon::now()->subMinutes(3) )
        {
            return view('frontend.pages.profile.reset_password_form',compact('token'));
        }
        if($verifyToken){
           
            PasswordReset::where('token', $verifyToken->token)->delete();
        }
        Toastr::success('Token Expired. Please reset again.');
        return redirect()->route('user.login'); 
    }


     public function resetPasswordPost(Request $request, $token){
        // dd($request->all());
        $request->validate([
            'password'=>'required|min:6|confirmed',
        ]);

        $verifyToken = PasswordReset::where('token', $token)->first();

         if ($verifyToken->token == $token) {
             $customer = Customer::where('email', $verifyToken->email)->first();
 
             $customer->update([
                 'password' => app('hash')->make($request->input('password')),
             ]);
 
             PasswordReset::where('token', $verifyToken->token)->delete();
             Toastr::success('Password updated successfully...!');
             return redirect()->route('user.login');
         }else{
             notify()->error('Token Expired.');
             return redirect()->back();
         }

    }

    public function passwordUpdateForm(){
        return view('frontend.pages.profile.update_password');
    }

    public function userUpdatePassword(Request $request){
        
        $request->validate([
            // 'otp'=>'required|max: 6',
            'old_password'=>'required',
            'password'=>'required|confirmed',
        ]);
    
            if (Hash::check($request->old_password, Auth::guard('customer')->user()->password)) {
                $user = Customer::where('id', Auth::guard('customer')->user()->id)->first();
                $user->update([
                    'password'=>bcrypt($request->password),
                ]);

                Auth::guard('customer')->logout();
                Toastr::success('Password updated successfully!');
                return redirect()->route('user.login');
            }
            else {
                Toastr::error('Old Password does not match!');
                return redirect()->back();
            }
      
    }
}
