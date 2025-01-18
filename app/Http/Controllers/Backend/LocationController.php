<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\Union;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    public function list()
    {
        if (\request()->search) {
        $divisions = Division::where('name', 'LIKE', '%' . \request()->search . '%')->orderBy('name')->get();
        } else {
        $divisions = Division::orderBy('name')->get();
    }
        return view('backend.location.division-list',compact('divisions'));
    }

    public function create()
    {
        return view('backend.location.division-create');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255',

        ]);
        if ($validate->fails()) {
            notify()->error($validate->getMessageBag());
        }

        Division::create([
            'name'  => $request->name
        ]);

        notify()->success('Division Created Successfully');
        return redirect()->route('division.list');
 
    }

    public function delete($division_id)
    {
        $test = Division::find($division_id);
        if ($test) {
            $test->delete();
            notify()->success('Division Deleted Successfully');
            return redirect()->route('division.list');
        } else {
            notify()->error('Division Not Found');
            return redirect()->route('division.list');
        }
    }

    public function viewDistrict($division_id)
    {

        if (\request()->search) {
            $districts = District::where('name', 'LIKE', '%' . \request()->search . '%')
                ->where('division_id', $division_id)->orderBy('name')->get();
        } else {
            $districts = District::where('division_id', $division_id)->orderBy('name')->get();
        }
               
        return view('backend.location.district-list',compact('districts','division_id'));

    }

    public function createDistrict($division_id)
    {
        $divisions=Division::find($division_id);
        return view('backend.location.district-create',compact('divisions'));
    }

    public function storeDistrict(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name'  => 'required|max:255',
            'division_id'  => 'required',

        ]);
        if ($validator->fails()) {
            notify()->error($validator->getMessageBag());
        }

        District::create([
            'name'  => $request->name,
            'division_id'  => $request->division_id
        ]);

        notify()->success('District Created Successfully');
        return redirect()->route('district.view',$request->division_id);
    }

    public function deleteDistrict(int $district_id)
    {
        $test = District::find($district_id);
        if ($test) {
            $test->delete();
            notify()->success('District Deleted Successfully');
            return redirect()->back();
        } else {
            notify()->error('District Not Found');
            return redirect()->back();
        }
    }

    public function viewUpazila($district_id)
    {
        if (\request()->search) {
            $upazilas = Upazila::where('name', 'LIKE', '%' . \request()->search . '%')
                ->where('district_id', $district_id)->orderBy('name')->get();
        } else {
            $upazilas = Upazila::where('district_id', $district_id)->orderBy('name')->get();
        }
        return view('backend.location.upazila-list',compact('upazilas','district_id'));
    }

    public function createUpazila($district_id)
    {
        $districts = District::find($district_id);
        return view('backend.location.upazila-create', compact('districts'));
    }

    public function storeUpazila(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name'  => 'required|max:255',
            'district_id'  => 'required',
        ]);

        if ($validator->fails()) {
            notify()->error($validator->getMessageBag());
        }

        Upazila::create([
            'name'        => $request->name,
            'district_id' => $request->district_id


        ]);
        notify()->success('Upazila Created Successfully');
        return redirect()->route('upazila.view',$request->district_id);
    }

    public function deleteUpazila(int $upazila_id)
    {
        $test = Upazila::find($upazila_id);
        if ($test) {
            $test->delete();
            notify()->success('Upazila Deleted Successfully');
            return redirect()->back();
        } else {
            notify()->error('Upazila Not Found');
            return redirect()->back();
        } 
    }
    
    public function viewUnion($upazila_id)
    {
        {
            if (\request()->search) {
                $unions = Union::where('name', 'LIkE', '%' . \request()->search . '%')
                    ->where('upazila_id', $upazila_id)->orderBy('name')->get();
            } else {
                $unions = Union::where('upazila_id', $upazila_id)->orderBy('name')->get();
            }
    
            return view('backend.location.union-list', compact('unions', 'upazila_id'));
        }
    }

    public function createUnion($upazila_id)
    {
        $upazilas = Upazila::find($upazila_id);
        return view('backend.location.union-create', compact('upazilas'));
    }

    public function storeUnion(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name'      => 'required|max:255',
            'upazila_id'  => 'required',

        ]);

        if ($validator->fails()) {
            notify()->error($validator->getMessageBag());
            return redirect()->back();
        }

        Union::create([

            'name'  => $request->name,
            'upazila_id'  => $request->upazila_id
        ]);

        notify()->success('Union Created Successfully');
        return redirect()->route('union.view',$request->upazila_id);
 
    }

    public function deleteUnion(int $union_id)
    {
        $test = Union::find($union_id);
        if ($test) {
            $test->delete();
            notify()->success('Union Deleted Successfully');
            return redirect()->back();
        } else {
            notify()->error('Union Not Found');
            return redirect()->back();
        }
    }
}
