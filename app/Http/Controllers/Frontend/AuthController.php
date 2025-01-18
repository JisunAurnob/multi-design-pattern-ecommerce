<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use Throwable;
use App\Models\User;
use App\Models\Customer;
use App\Jobs\NotifyEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Devfaysal\Muthofun\Facades\Muthofun;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\RegistrationNotification;
use PHPOpenSourceSaver\JWTAuth\Claims\Custom;

class AuthController extends Controller
{
    public function login()
    {
        return view('frontend.pages.login.index');
    }

    public function register()
    {
        return view('frontend.pages.register.registration');
    }

    public function registration(Request $request)
    {
        // dd($request->all());
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            // 'last_name' => 'required',
            'email' => 'required_if:phone,null|email|nullable|unique:customers,email',
            'phone' => [
                'required_without:email',
                'unique:customers,phone',
                'nullable',
                'min:11',
                'max:14',
                'regex:/^(?:\+?88)?01[13-9]\d{8}$/',
            ],
            'password' => 'required|min:6',
        ]);
        if ($validation->fails()) {

            toastr()->error($validation->getMessageBag());
            return redirect()->back()->withErrors($validation)->withInput();
            
        }
        try {
            // $filename = '';
            // if ($request->hasFile('image')) {
            //     $file = $request->file('image');
            //     $filename = date('Ymdhis') . '.' . $file->getClientOriginalExtension();
            //     $file->storeAs('/customer', $filename);
            // }

            $device_token = null;
            if ($request->has('device_token')) {
                $device_token = $request->device_token;
            }

            $reset_otp = random_int(100000, 999999);
            $user = Customer::create([
                'name' => $request->name,
                // 'last_name' => $request->last_name,
                'email' => $request->email ? strtolower($request->email) : null,
                'password' => bcrypt($request->password),
                'phone' => $request->phone ?? null,
                // 'image' => $filename,
                'otp' => $reset_otp,
                // 'device_token' => $device_token,
                // 'vehicle_type' => $request->vehicle_type,
                'is_email_verified' => 0,
                'is_mobile_verified' => 1,
                'otp_expire_at' => Carbon::now()->addMinutes(2)
            ]);

            if (isEmail($request->email)) {
                //mail send
                Notification::send($user, new RegistrationNotification($user, $reset_otp));
                toastr()->success('Customer created successfully & OTP has been send to the Email.');
                return view('frontend.pages.profile.email_verification_otp_template');
            } else {
                //send sms 

                Muthofun::send($user->phone, 'রেজিস্ট্রেশন সম্পূর্ণ হয়েছে। ওটিপি দিয়ে ভেরিফাই করুন :' . $reset_otp);
            }

            // if (isEmail($request->phone)) {


            // }

            toastr()->success('Customer created successfully');
            return redirect()->route('user.login');
        } catch (\Throwable $th) {
            toastr()->error($th->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function loginPost(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'user_input' => 'required',
            'password' => 'required|min:6',
        ]);

        if ($validation->fails()) {
            toastr()->error($validation->errors());
            return redirect()->back();
        }

        if (isEmail($request->user_input)) {
            //login check
            $credentials = ['email' => $request->user_input, 'password' => $request->password];
            $user = Customer::where('email', $request->user_input)->where('status', 'active')->first();
        } else {
            $credentials = ['phone' => $request->user_input, 'password' => $request->password];
            $user = Customer::where('phone', $request->user_input)->where('status', 'active')->first();
        }
        if ($user) {
            if ($user->is_mobile_verified == 1 || $user->is_email_verified == 1) {
                if ($user['token'] = auth()->guard('customer')->attempt($credentials)) {
                    toastr()->success('User Logged In Successfully');
                    return redirect()->route('home');
                } else {
                    toastr()->error('Invalid Credentials.');
                    return redirect()->back();
                }
            }
            toastr()->error('Please verify your account.');
            return redirect()->back();
        } else {
            toastr()->error('Account not found. Please register.');
            return redirect()->back();
        }
    }

    public function logout(): RedirectResponse
    {
        Auth::guard('customer')->logout();
        toastr()->success('Logout successfully');
        return redirect()->route('home');
    }

    public function emailVerification(Request $request)
    {
       $customer = Customer::where('email', $request->email)->where('otp' , $request->otp)->first();
       if($customer){
            if($customer->otp_expire_at > now()){
                $customer->update([
                    'is_email_verified' => 1,
                    'otp' => null,
                    'otp_expire_at' => null,
                ]);
                toastr()->success('Email verified successfully');
                return redirect()->route('user.login');
            }
            toastr()->error('OTP expired!');
            return view('frontend.pages.profile.otp_resend');

       }
        toastr()->error('Invalid OTP or Email not found!');
        return view('frontend.pages.profile.otp_resend');
    }

    public function resendOTP(Request $request)
    {
       $customer = Customer::where('email', $request->email)->first();
       if($customer){
            $otp = random_int(100000, 999999);
            $customer->update([
                'otp' => $otp,
                'otp_expire_at' => Carbon::now()->addMinutes(2)
            ]);
            Notification::send($customer, new RegistrationNotification($customer, $otp));
            toastr()->success('An OTP is send to your Email');
            return view('frontend.pages.profile.email_verification_otp_template');
        }
        toastr()->error('User Not found!');
        return view('frontend.pages.profile.otp_resend');
    }

    
    
}
