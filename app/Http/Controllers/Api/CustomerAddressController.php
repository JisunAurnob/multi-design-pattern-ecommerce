<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerAddressController extends Controller
{

    public function allAddress()
    {
        $addresses = CustomerAddress::where('customer_id', auth('api')->user()->id)->get();
        if ($addresses) {
            return $this->responseWithSuccess(AddressResource::collection($addresses), 'All addresses of this customer.');
        }
        return $this->responseWithError('No addresses found.');
    }


    public function viewAddress($id)
    {
        $address = CustomerAddress::find($id);
        if ($address) {
            return $this->responseWithSuccess(AddressResource::make($address), 'View address.');
        }
        return $this->responseWithError('No address found.');
    }

    public function createAddress(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required|digits:11|regex:/(01)[0-9]{9}/',
            'email' => 'required',
            'division' => 'required',
            'district' => 'required',
            'address' => 'required',
        ]);

        if ($validate->fails()) {
            return $this->responseWithError($validate->getMessageBag());
        }

        $isDefault = $this->isDefault($request->is_default);

        $customerAddress = CustomerAddress::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'customer_id' => auth('api')->user()->id,
            'division' => $request->division,
            'district' => $request->district,
            'upazila' => $request->upazila,
            'union' => $request->union,
            'address' => $request->address,
            'is_default' => $isDefault,
        ]);

        return $this->responseWithSuccess(AddressResource::make($customerAddress), 'Address created successfully.');
    }

    public function updateAddress(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required|digits:11|regex:/(01)[0-9]{9}/',
            'email' => 'required',
            'division' => 'required',
            'district' => 'required',
            'address' => 'required',
        ]);

        if ($validate->fails()) {
            return $this->responseWithError($validate->getMessageBag());
        }
        $isDefault = $this->isDefault($request->is_default);
        $customerAddress = CustomerAddress::find($id);
        if ($customerAddress) {
            $customerAddress->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'customer_id' => auth('api')->user()->id,
                'division' => $request->division,
                'district' => $request->district,
                'upazila' => $request->upazila,
                'union' => $request->union,
                'address' => $request->address,
                'is_default' => $isDefault,
            ]);

            return $this->responseWithSuccess(AddressResource::make($customerAddress), 'Address updated successfully.');
        }
        return $this->responseWithError('Address Not Found');
    }

    public function isDefault($is_default)
    {

        $checkFirstAddress = CustomerAddress::where('customer_id', auth('api')->user()->id)->first();
        if (!$checkFirstAddress) {
            return true;
        } elseif ($is_default == true) {
            CustomerAddress::where('customer_id', auth('api')->user()->id)->update([
                'is_default' => false
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function deleteAddress($address_id)
    {
        $address = CustomerAddress::find($address_id);
        if ($address && $address->is_default != 1) {
            $address->delete();
            return $this->responseWithSuccess([], 'Address deleted successfully.');
        }
        return $this->responseWithError('Address not found or address is default.');
    }

    public function makeDefaultAddress($address_id)
    {
        $address = CustomerAddress::find($address_id);
        if ($address) {
            if ($address->is_default == true) {
                return $this->responseWithSuccess($address, 'Already default.');
            }
            CustomerAddress::where('customer_id', auth('api')->user()->id)->update([
                'is_default' => false
            ]);

            $address = CustomerAddress::find($address_id);
            $address->update([
                'is_default' => true
            ]);
            return $this->responseWithSuccess(AddressResource::make($address), 'Default address set successfully.');
        }
        return $this->responseWithSuccess([], 'No address found.');
    }

    public function getDefaultAddress()
    {
        $address = CustomerAddress::where('customer_id', auth('api')->user()->id)->where('is_default', 1)->first();
        if ($address) {
            return $this->responseWithSuccess(AddressResource::make($address), 'Default address.');
        }
        return $this->responseWithError('No address found.');
    }
}
