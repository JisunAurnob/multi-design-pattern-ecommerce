<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str; 
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function list()
    {
        if (\request()->search) {
            $categories = Category::with('parent')->where('name','LIKE','%'.\request()->search.'%')->get();
            }else{
    
                $categories = Category::with('parent')->get();
            }
            
            return view('backend.category.list', compact('categories'));
    }

    public function create()
    {
        $categories=Category::where('parent_id',null)->with('childs')->get();
        $hi_pen='';
        // dd($categories->toArray());
        return view('backend.category.create',compact('categories','hi_pen'));
    }

    public function store(Request $request)
    {
        //  dd($request->all());
        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:categories',
            'image' => 'required|image',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $image = null;
        if ($request->hasFile('image')) {
            $image = date('Ymdhsis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/category', $image);
        }


        Category::create([
            'name'  => $request->name,
            'image' => $image,
            'description' => $request->description,
            'slug'  => $request->category_slug,
            'parent_id'  => $request->parent_id,
            'status'  => $request->status,
        ]);

        notify()->success('Category Created Successfully');
        return to_route('admin.category.list');
    }

    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $parents=Category::where('parent_id',null)->with('childs')->get();
        $hi_pen='';
        // dd($category);
        return view('backend.category.edit', compact('category','parents','hi_pen'));
    }

    public function update(Request $request, $slug)
    {
        $category   = Category::where('slug', $slug)->first();

        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:categories,name,' . $category->id
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $image = $category->getRawOriginal('image');
        if ($request->hasFile('image')) {
            $remove = public_path().'/uploads/category/'.$image;
            File::delete($remove);
            $image = date('Ymdhsis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/category', $image);
        }
        // dd($request->toArray());
        $category->update([
            'name'  => $request->name,
            'image' => $image,
            'description' => $request->description,
            'slug'  => $request->category_slug,
            'parent_id'  => $request->parent_id,
            'status'  => $request->status,
        ]);
        notify()->success('Category updated successfully');
        return to_route('admin.category.list');
    }

    public function delete($slug)
    {
        try {
            Category::where('slug', $slug)->first()->delete();
            notify()->success('Category deleted successfully');
        } catch (\Throwable $th) {
            // notify()->error($th->getMessage());
            notify()->error('This Category cannot be deleted!');
        }
        return to_route('admin.category.list');
    }
}
     