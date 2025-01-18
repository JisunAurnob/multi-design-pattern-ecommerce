<?php

namespace App\Services;

use App\Jobs\ForgetPasswordJob;
use App\Models\Customer;
use App\Models\User;
use Devfaysal\Muthofun\Facades\Muthofun;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendFrontendResetPasswordJob;
use App\Notifications\PasswordReset;
use Illuminate\Support\Facades\Notification;


class ForgetPassword
{
    public User $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function forgetPassword(Request $request)
    {
        $reset_otp = random_int(100000, 999999);
        $user = Customer::where('email', $request->user_input)->orWhere('phone', $request->user_input)->first();

        if ($user) {
            $user->update([
                'otp' => $reset_otp,
                'otp_expire_at' => Carbon::now()->addMinutes(2)
            ]);
       
            if (isset($user->email)) {
                //mail send
                // dispatch(new ForgetPasswordJob($user, $reset_otp));
                Notification::send($user, new PasswordReset($user,$reset_otp));
               
            } elseif ($user->phone) {
                Muthofun::send($user->phone, "BDWash - পাসওয়ার্ড রিসেট ওটিপি: $reset_otp");
            }
            return $user;
        } else {
            abort(401, 'Invalid User');
        }
    }

    public function resetPassword(Request $request)
    {
        //check otp exist or not
        $user = User::where('otp', $request->otp)->first();
        if ($user) {
            $user->update([
                'otp' => null,
                'otp_expire_at' => null,
                'password' => app('hash')->make($request->password),
            ]);
            return true;
        }
        return false;
    }
}
