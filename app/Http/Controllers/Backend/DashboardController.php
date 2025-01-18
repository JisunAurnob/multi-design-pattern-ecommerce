<?php
declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Opportunity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Test;
use App\Models\Training;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

class DashboardController extends Controller
{
    public function index()
    {
        $data['total_user'] =Customer::count();
        // $data['today_order']=Order::whereDate('created_at', Carbon::today())->get()->count();
        $data['total_order']=Order::count();
        
        $data['pending_order']=Order::where('status','pending')->count();



        return view('backend.dashboard.index',compact('data'));
    }
}
