<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('position','asc')->paginate(50);
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $category = new Category;
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories',
            'image' => 'required',
            'position' => 'unique:categories,position,100'
        ], [
            'name.required' => 'Bạn cần nhập tên danh mục',
            'name.unique' => 'Tên danh mục đã tồn tại',
            'image.required' => 'Bạn cần tải ảnh lên',
        ]);
            
        if ($validator->fails()) {
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } 
        }
        if ($request->file('image') != '') {
            $path = public_path('upload/images/');
            $file_old = $path . $category->image;
            if(File::exists($file_old)) {
                File::delete($file_old); 
            }
            
            $file = $request->file('image');
            $filename = time().$file->getClientOriginalName();
            $file->move('./upload/images/', $filename);
            $category->image = $filename;
        } 
        $category->name = $request->name;
        $request->position?$category->position = $request->position:'';
        $category->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $category->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $category->slug = Str::slug($request->name);
        $category->save();
        return redirect()->route('admin.category.index')->with('success', 'Thêm danh mục thành công!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name,'.$id,
            'position' => 'unique:categories,position,'.$id,
        ], [
            'name.required' => 'Bạn cần nhập tên danh mục',
            'name.unique' => 'Tên danh mục đã tòn tại',
            'image.required' => 'Bạn cần tải ảnh lên',
        ]);
            
        if ($validator->fails()) {
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } 
        }
        $category->name = $request->name;
        $category->position = $request->position;
        $category->slug = Str::slug($request->name);

        if ($request->file('image') != '') {
            $path = public_path('upload/images/');
            $file_old = $path . $category->image;
            if(File::exists($file_old)) {
                File::delete($file_old); 
            }
            
            $file = $request->file('image');
            $filename = time().$file->getClientOriginalName();
            $file->move('./upload/images/', $filename);
            $category->image = $filename;
        } 
        $category->save();
        return redirect()->route('admin.category.index')->with('success', 'Cập nhật danh mục thành công!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(['message' =>'Xóa danh mục thành công!']);
    }
}
