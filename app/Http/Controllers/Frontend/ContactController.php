<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use App\Models\ContactUs;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        $contact = BusinessSetting::all()->first();
        return view('frontend.contact.index', compact('contact'));
    }

    public function contactPost(Request $request)
    {
        $request->validate([
            'email'     => 'required|email',
            'name'      => 'required',
            'details'   => 'required',
            'location'  => 'required'
        ]);

        try {
            ContactUs::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'details'   => $request->details,
                'location'  => $request->location
            ]);
            Toastr::success('Message has sent succesfully.');
            return redirect()->route('home');
        } catch (\Throwable $th) {
            Toastr::error('something went wrong..!');
            return redirect()->back();
        }
        
    }
}
