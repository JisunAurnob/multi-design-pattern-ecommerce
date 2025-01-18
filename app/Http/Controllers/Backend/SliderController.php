<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Throwable;

class SliderController extends Controller
{
    public function list()
    {
        if(\request()->search){
            $sliders=Slider::where('title','LIKE','%'. \request()->search . '%')->paginate(20);
        }else{
        $sliders = Slider::paginate(20);
        }
        return view('backend.slider.list', compact('sliders'));
    }

    public function create()
    {
        return view('backend.slider.create');
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'image' => 'required',
            'is_has_button' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

    try{
        $image = null;
        if ($request->hasFile('image')) {
            $image = date('Ymdhsis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/slider', $image);
        }

        $sliders = Slider::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image' => $image,
            'slug' => Str::slug($request->title),
            'is_has_button' => $request->is_has_button,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,


        ]);

        notify()->success('Slider Created Successfully');
        return redirect()->route('slider.list');
    }
    catch(Throwable)
    {
        notify()->error('Same Title Cannot Be Added');

        return redirect()->route('slider.list');
    }
    }

    public function edit($id)
    {
        $sliders = Slider::find($id);
        return view('backend.slider.edit', compact('sliders'));
    }

    public function update(Request $request, $id)
    {
        $sliders = Slider::find($id);

        $validate = Validator::make($request->all(), [
            'title' => 'required',

            'is_has_button' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $image = $sliders->getRawOriginal('image');
        if ($request->hasFile('image')) {
            $image = date('Ymdhsis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/slider', $image);
        }

        $sliders->update([

            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image' => $image,
            'is_has_button' => $request->is_has_button,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,


        ]);

        notify()->success('Slider Updated Successfully');
        return redirect()->route('slider.list');
    }

    public function delete($id)
    {
        $test = Slider::find($id);
        if ($test) {
            $test->delete();
            notify()->success('Slider Deleted Successfully');
            return redirect()->route('slider.list');
        } else {
            notify()->error('Slider Not Found');
            return redirect()->route('slider.list');
        }
    }
}
