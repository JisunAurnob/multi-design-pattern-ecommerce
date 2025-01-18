<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\AllServices;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function list()
    {
        $services = Service::where('status', 'active')->get();

        return $this->responseWithSuccess(ServiceResource::collection($services), 'All Services');
    }


    public function demoSingle($id)
    {
        $single = Service::find($id);

        return $this->responseWithSuccess(ServiceResource::make($single), 'All Services');
    }

    public function servicesWithProducts($service_id)
    {
        $services = Service::with('product')->find($service_id);
        return $this->responseWithSuccess($services, 'All Products under a service.');
    }


    public function allServicesWithAllProducts()
    {
        $services = Service::with('product')->get();
        return $this->responseWithSuccess(AllServices::collection($services), 'All services with all products.');
    }
}
