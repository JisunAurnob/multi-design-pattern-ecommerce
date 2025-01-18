<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    
    public function businessSettings()
    {
    
        $settings=Setting::first();

        return $this->responseWithSuccess($settings,'Business settings data.');
    }

    public function sliders()
    {
        $sliders=Slider::all();
        return $this->responseWithSuccess($sliders,'All Sliders.');
    }

    
    
}


