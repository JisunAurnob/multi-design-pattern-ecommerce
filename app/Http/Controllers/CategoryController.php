<?php

namespace App\Http\Controllers;
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
            
            return view('backend.admin.category.list', compact('categories'));
    }

    public function create()
    {
        $categories=Category::where('parent_id',null)->with('childs')->get();
        $hi_pen='';
        // dd($categories->toArray());
        return view('backend.admin.category.create',compact('categories','hi_pen'));
    }

    public function store(Request $request)
    {
        // dd($request->toArray());
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
        $parents=Category::where('parent_id',null)->get();
        return view('backend.category.edit', compact('category','parents'));
    }

    public function update(Request $request, $slug)
    {
        $category   = Category::where('slug', $slug)->first();
        $validator  = Validator::make($request->all(), [
            'name' => 'required|max:255',
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

        $slug   = Str::slug($request->name, '-');
        $count  = Category::where('slug', $slug)->count();
        if ($count) {
            $slug = $slug . '-' . ($count + 1);
        }
        $category->update([
            'name'  => $request->name,
            'image' => $image,
            'slug'  => $slug,
            'parent_id'  => $request->parent_id,
        ]);
        notify()->success('Category updated successfully');
        return to_route('category.index');
    }

    public function delete($slug)
    {
        try {
            Category::where('slug', $slug)->first()->delete();
            notify()->success('category deleted successfully');
        } catch (\Throwable $th) {
            notify()->error($th->getMessage());
        }
        return to_route('admin.category.list');
    }
}
     