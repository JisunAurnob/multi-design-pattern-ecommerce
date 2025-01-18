<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\LocationResource;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\Union;
use Devfaysal\BangladeshGeocode\Models\Upazila;

class LocationController extends Controller
{
    public function division(): \Illuminate\Http\JsonResponse
    {
        try {
            $data = Division::orderBy('name', 'asc')->get();
            return $this->responseWithSuccess($data, 'All Division.');
        } catch (\Exception $exception) {
            return $this->responseWithError($exception->getMessage());
        }
    }

    public function district($division_id = null): \Illuminate\Http\JsonResponse
    {
        try {
            if ($division_id) {
                $data = District::where('division_id', $division_id)->orderBy('name', 'asc')->get();
            } else {
                $data = District::orderBy('name', 'asc')->get();
            }

            return $this->responseWithSuccess(LocationResource::collection($data), 'All District');
        } catch (\Exception $exception) {
            return $this->responseWithError($exception->getMessage());
        }
    }

    public function districtByName($division_name = null): \Illuminate\Http\JsonResponse
    {
        try {
            if ($division_name) {
                $data = District::whereHas('division', function ($q) use ($division_name) {
                    return $q->where('name', $division_name);
                })->orderBy('name', 'asc')->get();
            } else {
                $data = District::orderBy('name', 'asc')->get();
            }

            return $this->responseWithSuccess($data, 'All District by division name');
        } catch (\Exception $exception) {
            return $this->responseWithError($exception->getMessage());
        }
    }

    public function upazilas($district_id = null): \Illuminate\Http\JsonResponse
    {
        try {
            if ($district_id) {
                $data = Upazila::where('district_id', $district_id)->orderBy('name', 'asc')->get();
            } else {
                $data = Upazila::orderBy('name', 'asc')->get();
            }

            return $this->responseWithSuccess($data, 'All upazila');
        } catch (\Exception $exception) {
            return $this->responseWithError($exception->getMessage());
        }
    }

    public function upazilasByName($district_name = null): \Illuminate\Http\JsonResponse
    {

        try {
            if ($district_name) {

                $data = Upazila::whereHas('district', function ($q) use ($district_name) {
                    return $q->where('name', $district_name);
                })->orderBy('name', 'asc')->get();
            } else {
                $data = Upazila::orderBy('name', 'asc')->get();
            }

            return $this->responseWithSuccess($data, 'All upazila by district name.');
        } catch (\Exception $exception) {
            return $this->responseWithError($exception->getMessage());
        }
    }

    public function unions($upazila_id = null): \Illuminate\Http\JsonResponse
    {
        try {
            if ($upazila_id) {
                $data = Union::where('upazila_id', $upazila_id)->orderBy('name', 'asc')->get();
            } else {
                $data = Union::orderBy('name', 'asc')->get();
            }
            return $this->responseWithSuccess($data, 'All Unions');
        } catch (\Exception $exception) {
            return $this->responseWithError($exception->getMessage());
        }
    }

    public function unionsByName($upazila_name = null): \Illuminate\Http\JsonResponse
    {
        try {
            if ($upazila_name) {
                $data = Union::whereHas('upazila', function ($q) use ($upazila_name) {
                    return $q->where('name', $upazila_name);
                })->orderBy('name', 'asc')->get();
            } else {
                $data = Union::orderBy('name', 'asc')->get();
            }
            return $this->responseWithSuccess($data, 'All Unions');
        } catch (\Exception $exception) {
            return $this->responseWithError($exception->getMessage());
        }
    }
}
