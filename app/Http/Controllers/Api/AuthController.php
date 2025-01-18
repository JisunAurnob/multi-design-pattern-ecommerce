<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\UserResource;
use App\Mail\HelpMail;
use App\Models\Customer;
use App\Models\Helpline;
use App\Models\Role;
use App\Models\User;
use App\Notifications\RegistrationNotification;
use App\Notifications\ResendOtp;
use App\Services\ForgetPassword;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Devfaysal\Muthofun\Facades\Muthofun;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Throwable;

class AuthController extends Controller
{
    public ForgetPassword $forgetPasswordService;

    public function __construct(ForgetPassword $forgetPasswordService)
    {
        $this->forgetPasswordService = $forgetPasswordService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    // public function registration(Request $request): JsonResponse
    // {
    //     // Log::debug($request->all());
    //     $validation = Validator::make($request->all(), [
    //         'first_name' => 'required',
    //         'last_name' => 'required',
    //         'email' => 'required_without:phone|email|unique:customers,email',
    //         'phone' => 'required_without:email|unique:customers,phone|min:11|max:14|regex:/^(?:\+?88)?01[13-9]\d{8}$/',
    //         'password' => 'required|min:6',
    //         'vehicle_type' => 'required',
    //     ]);
    //     if ($validation->fails()) {
    //         return $this->responseWithError( $validation->errors());
    //     }
    //     try {
    //         $filename = '';
    //         if ($request->hasFile('image')) {
    //             $file = $request->file('image');
    //             $filename = date('Ymdhis') . '.' . $file->getClientOriginalExtension();
    //             $file->storeAs('/customer', $filename);
    //         }

    //         $device_token = null;
    //         if ($request->has('device_token')) {
    //             $device_token = $request->device_token;
    //         }

    //         $reset_otp = random_int(100000, 999999);
    //         $user = Customer::create([
    //             'first_name' => $request->first_name,
    //             'last_name' => $request->last_name,
    //             'email' => $request->email ? strtolower($request->email) : null,
    //             'password' => bcrypt($request->password),
    //             'phone' => $request->phone ?? null,
    //             'image' => $filename,
    //             'otp' => $reset_otp,
    //             'device_token' => $device_token,
    //             'vehicle_type' => $request->vehicle_type,
    //             'is_email_verified' => 0,
    //             'is_mobile_verified' => 0,
    //             'otp_expire_at' => Carbon::now()->addMinutes(2)
    //         ]);

    //         if (isEmail($request->email)) {
    //             //mail send
    //             Notification::send($user, new RegistrationNotification($user, $reset_otp));
    //         } else {
    //             //send sms 

    //             Muthofun::send($user->phone, 'রেজিস্ট্রেশন সম্পূর্ণ হয়েছে। ওটিপি দিয়ে ভেরিফাই করুন :' . $reset_otp);
    //         }

    //         // if (isEmail($request->phone)) {


    //         // }

    //         return $this->responseWithSuccess(UserResource::make($user), 'Customer created successfully');
    //     } catch (\Throwable $th) {
    //         return $this->responseWithError('Something went wrong', $th->getMessage());
    //     }
    // }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    // public function login(Request $request): JsonResponse
    // {
    //     $validation = Validator::make($request->all(), [
    //         'user_input' => 'required',
    //         'password' => 'required|min:6',
    //     ]);

    //     if ($validation->fails()) {
    //         return $this->responseWithError( $validation->errors());
    //     }

    //     if (isEmail($request->user_input)) {
    //         //login check
    //         $credentials = ['email' => $request->user_input, 'password' => $request->password];
    //         $user = Customer::where('email', $request->user_input)->first();
    //     } else {
    //         $credentials = ['phone' => $request->user_input, 'password' => $request->password];
    //         $user = Customer::where('phone', $request->user_input)->first();
    //     }
    //     if ($user) {
    //         if ($user->is_mobile_verified == 1 || $user->is_email_verified == 1) {
    //             if ($user['token'] = auth()->guard('api')->attempt($credentials)) {
    //                 return $this->responseWithSuccess(UserResource::make($user), 'User Logged In Successfully');
    //             } elseif ($token = auth()->guard('employee')->attempt($credentials)) {
    //                 $user = User::find(auth('employee')->user()->id);
    //                 $user['token'] = $token;
    //                 return $this->responseWithSuccess(UserResource::make($user), 'Employee Logged In Successfully');
    //             }
    //         } else {
    //             return $this->responseWithError( 'not verified');
    //         }
    //     }

    //     //if not customer check is employee or not

    //     return $this->responseWithError( 'Invalid Credential.');
    // }

    public function logout()
    {
        auth('api')->logout();
        return response()->json([
            'success' => true,
            'message' => 'Logout successful',
            'status' => 200,
        ]);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {

        $customer = Customer::find(auth('api')->user()->id);
        # use x-www-form-urlencoded in the post man
        $validation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'nullable|email|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|digits:11|regex:/(01)[0-9]{9}/|unique:customers,phone,' . $customer->id,
        ]);


        if ($validation->fails()) {
            return $this->responseWithError($validation->errors());
        }
        try {
            $filename = $customer->getRawOriginal('image');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = date('Ymdhis') . '.' . $file->getClientOriginalExtension();
                $file->storeAs('/customer', $filename);
            }

            $customer->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email ?? $customer->email,
                'phone' => $request->phone ?? $customer->phone,
                'image' => $filename,
            ]);

            return $this->ResponseWithSuccess($customer->refresh(), 'Profile updated successfully');
        } catch (\Throwable $th) {
            return $this->ResponseWithError($th->getMessage());
        }
    }

    public function view($id)
    {
        $user = Customer::find($id);
        try {
            return $this->ResponseWithSuccess($user, "Single User.");
        } catch (\Throwable $th) {
            return $this->ResponseWithError('User does not exist');
        }
    }



    public function forgetPassword(Request $request): JsonResponse
    {
        $validation = Validator::make($request->all(), [
            'user_input' => 'required'
        ]);

        if ($validation->fails()) {
            return $this->responseWithError('Invalid Input.');
        }

        try {
            $user = $this->forgetPasswordService->forgetPassword($request);

            return $this->responseWithSuccess($user, 'OTP sent.');
        } catch (\Throwable $exception) {

            return $this->responseWithError($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function postForgetPassword(Request $request): JsonResponse
    {

        $validate = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:6',
            'otp' => 'required|min:6',
        ]);
        if ($validate->fails()) {
            return $this->responseWithError($validate->getMessageBag());
        }

        $customer = Customer::where('otp', $request->otp)->where('otp_expire_at', '>', now())->first();

        if (!$customer) {
            return $this->responseWithError('OTP invalid or expired.');
        }
        try {
            $data = $customer->update([
                'password' => bcrypt($request->password),
                // 'is_mobile_verified' => 1,
                'otp' => null,
                'otp_expire_at' => null
            ]);

            return $this->responseWithSuccess($data, 'Password reset successfully');
        } catch (\Exception $exception) {
            return $this->responseWithError($exception->getMessage());
        }
    }

    public function changePassword(Request $request)
    {
        $customer = auth('api')->user();
        try {
            $validate = Validator::make($request->all(), [
                'old_password' => 'required',
                'password' => 'required|min:6|confirmed|different:old_password',
            ], [
                'password.different' => 'New password should not same as old password.'
            ]);

            if ($validate->fails()) {
                return $this->responseWithError($validate->getMessageBag());
            }

            if (Hash::check($request->old_password, auth('api')->user()->password)) {
                $customer->update([
                    'password' => bcrypt($request->input('password')),
                ]);
                return $this->responseWithSuccess($customer, 'Password updated successfully');
            }


            return $this->responseWithError('Old password not matched.');
        } catch (\Exception $exception) {
            return $this->responseWithError($exception->getMessage());
        }
    }

    public function resendOtp()
    {
        try {
            $otp = random_int(100000, 999999);
            $input = request()->input('user_input');

            $customer = Customer::where('phone', $input)
                ->orWhere('email', $input)->first();

            if ($customer) {

                $customer->update([
                    'otp' => $otp,
                    'otp_expire_at' => date('Y-m-d H:i:s', strtotime('+2 minutes')),
                ]);

                if ($customer->email) {
                    Notification::send($customer, new ResendOtp($customer, $otp));
                } else {
                    Muthofun::send($customer->phone, 'BDWash - আপনার নতুন ওটিপি :' . $otp);
                }

                return $this->responseWithSuccess($customer, 'OTP resent successfully.');
            }

            return $this->responseWithError('Customer not found.');
        } catch (\Throwable $ex) {
            return $this->responseWithError($ex->getMessage());
        }
    }

    public function verifyOtp()
    {
        try {
            $otp = request()->input('otp');
            $customer = Customer::where('otp', $otp)->first();
            if ($customer) {

                if ($customer->otp_expire_at >= now()) {
                    //reset password
                    if (request()->input('type') == 'reset_password') {
                        $data = '';
                        $message = 'OTP valid';
                    } else {
                        //new registration
                        $customer->update([
                            'is_email_verified' => 1,
                            'is_mobile_verified' => 1,
                            'otp' => null,
                            'otp_expire_at' => null
                        ]);
                        $data = $customer;
                        $message = 'Account verified.';
                    }

                    return $this->responseWithSuccess($data, $message);
                } else {
                    return $this->responseWithError('OTP Expired. Please resend OTP.');
                }
            } else {
                return $this->responseWithError('Invalid OTP');
            }
        } catch (\Throwable $e) {
            return $this->responseWithError($e->getMessage());
        }
    }


    public function test()
    {
        //     $data=$this->getTopParent(Category::find(5));
        //    dd($data);
    }


    public function saveToken(Request $request)
    {
        $user = Customer::find($request->user_id);
        $user->update(['device_token' => $request->device_token]);
        return $this->responseWithSuccess($user, 'token saved successfully.');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function sendNotification()
    {
        // $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        // FCM endpoint URL
        $apiUrl = 'https://fcm.googleapis.com/fcm/send';

        // Replace 'your_server_key_here' with your Firebase Server Key.
        $serverKey = env('FCM_SERVER');

        // Replace 'device_token_here' with the FCM token of the device you want to send the notification to.
        $deviceToken = 'fp-Qpf-BR2GJtBoQMRJF5U:APA91bGYnjie_GuEFkpial7qzSxlYlnxIcN19pZlZZooO6NxjVK4wWjUmys1wUUKI2R2UXpGPuy4n_GRZ1NMErUm-hF_dlfCgc8OR1FPHQrQFjw5d54wm58ABpwMF5ZCnfhUEOV0kcJ_';

        // Notification payload
        $notification = [
            'title' => 'Your order update',
            'body' => 'Dear customer your order has been dispatched.',
            // Add more custom data if needed
        ];

        // Data payload (if you need to send custom data along with the notification)
        $data = [
            'key1' => 'OR#0000001',
            'key2' => 'DISPATCHED',
            // Add more custom data as required
        ];

        // The message payload containing both the notification and data
        $message = [
            'notification' => $notification,
            'data' => $data,
            'to' => $deviceToken,
        ];

        // cURL request headers
        $headers = [
            'Authorization: key=' . $serverKey,
            'Content-Type: application/json',
        ];

        // Initialize cURL session
        $ch = curl_init($apiUrl);

        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));

        // Execute the cURL request
        $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);

        // Handle the response
        if ($response === false) {
            // cURL request failed
            echo 'cURL error: ' . curl_error($ch);
        } else {
            $responseData = json_decode($response, true);
            if (isset($responseData['success']) && $responseData['success'] === 1) {
                // Notification sent successfully
                echo 'Notification sent successfully';
            } else {
                // Failed to send notification
                echo 'Error sending notification: ' . $response;
            }
        }

        return $this->responseWithSuccess($response, 'success');
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'user_input' => 'required',
            'password' => 'required|min:6',
        ]);

        if ($validate->fails()) {
            return $this->responseWithError($validate->getMessageBag());
        }

        if (isEmail($request->user_input)) {
            //login check
            $credentials = ['email' => $request->user_input, 'password' => $request->password];
            $user = Customer::where('email', $request->user_input)->first();
        } else {
            $credentials = ['phone' => $request->user_input, 'password' => $request->password];
            $user = Customer::where('phone', $request->user_input)->first();
        }

        if ($user && $user->status == 'active') {
            if ($user->is_mobile_verified == 1 || $user->is_email_verified == 1) {

                if ($token = auth()->guard('api')->attempt($credentials)) {

                    $device_token = $request->device_token;
                    if ($device_token) {
                        $user->update([
                            'device_token' => $device_token,
                        ]);
                    }
                    $user->access_token = $token;

                    return $this->responseWithSuccess(UserResource::make($user), 'User Logged In Successfully');
                } else {
                    return $this->responseWithError('Invalid Credential.');
                }
            }
            return $this->responseWithError('not verified');
        }
        return $this->responseWithError('No user found or user inactive.');
    }

    public function registration(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            // 'email' => 'required_without:phone|unique:customers',
            'email' => 'required_without:phone|email|unique:customers,email',
            'phone' => 'required_without:email|unique:customers',
            'password' => 'required|min:6',
            'date_of_birth' => 'date|date_format:Y-m-d'
        ]);

        if ($validate->fails()) {

            return $this->responseWithError($validate->getMessageBag());
        }

        try {
            $device_token = null;
            if ($request->has('device_token')) {
                $device_token = $request->device_token;
            }
            $reset_otp = random_int(100000, 999999);

            $customer = Customer::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
                'otp' => $reset_otp,
                'device_token' => $device_token,
                'otp_expire_at' => Carbon::now()->addMinutes(2)
            ]);

            if (isEmail($request->email)) {
                //mail send
                Notification::send($customer, new RegistrationNotification($customer, $reset_otp));
            } elseif ($request->has('phone')) {
                //send sms 

                // Muthofun::send($customer->phone, 'রেজিস্ট্রেশন সম্পূর্ণ হয়েছে। ওটিপি দিয়ে ভেরিফাই করুন :' . $reset_otp);
                Muthofun::send($customer->phone, 'BDWash অ্যাকাউন্ট ভেরিফিকেশন কোড :' . $reset_otp);
            }
            return $this->responseWithSuccess($customer, 'Registration Success');
        } catch (Throwable $ex) {
            return $this->responseWithError($ex->getMessage());
        }
    }


    public function viewProfile()
    {
        $customer = Customer::find(auth('api')->user()->id);

        // return $this->responseWithSuccess($customer, 'Customer Profile.');
        return $this->responseWithSuccess(CustomerResource::make($customer), 'Customer Profile');
    }

    public function helpline(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'

        ]);
        if ($validate->fails()) {
            return $this->responseWithError([], $validate->errors());
        }

        $data = Helpline::create([
            'customer_id' => auth('api')->user()->id,
            'name'       => $request->name,
            'email'      => $request->email,
            'message'    => $request->message,
            'subject' => $request->subject,
        ]);

        Mail::to('a@gmail.com')->send(new HelpMail($data));
        return $this->responseWithSuccess([$data], 'Mail is sent successfully');
    }

    public function deleteAccount()
    {
        try {
            $user = Customer::find(auth('api')->user()->id);
            
            if($user)
            {
                $user->delete();
                return $this->responseWithSuccess(null,'Your account deleted successfully.');
            }

            return $this->responseWithError('Unable to delete.');
        } catch (Throwable $throwable) {
            return $this->responseWithError($throwable->getMessage());
        }
    }
}
