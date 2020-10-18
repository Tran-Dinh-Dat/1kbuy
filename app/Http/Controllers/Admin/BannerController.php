<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $banner = new Banner;

        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'link' => 'required'
        ], [
            'image.required' => 'Bạn cần upload hình ảnh',
            'link.required' => 'Bạn cần phải nhập link',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } 

        $banner->link = $request->link;
        $banner->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $banner->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        if ($request->file('image') != '') {
            $path = public_path('upload/images/');
            $file_old = $path . $banner->image;
            if(File::exists($file_old)) {
                File::delete($file_old); 
            }
            
            $file = $request->file('image');
            $filename = time().$file->getClientOriginalName();
            $file->move('./upload/images/', $filename);
            $banner->image = $filename;
        } 

        $banner->save();
        return back()->with('success', 'Thêm banner thành công!');
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'link' => 'required'
        ], [
            'link.required' => 'Bạn cần phải nhập link',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } 

        $banner->link = $request->link;

        if ($request->file('image') != '') {
            $path = public_path('upload/images/');
            $file_old = $path . $banner->image;
            if(File::exists($file_old)) {
                File::delete($file_old); 
            }
            
            $file = $request->file('image');
            $filename = time().$file->getClientOriginalName();
            $file->move('./upload/images/', $filename);
            $banner->image = $filename;
        } 

        $banner->save();
        return back()->with('success', 'Cập nhật banner thành công!');
    }

    public function destroy(Request $request,$id)
    {
        $banner = Banner::findOrFail($id);
        $path = public_path('upload/images/');
        $file_old = $path . $banner->image;
        if(File::exists($file_old)) {
            File::delete($file_old); 
        }
        $banner->delete();
        return response()->json([
            'message' => 'Xóa banner thành công!'
        ]);
    }
}
