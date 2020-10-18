<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Slide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::all();
        return view('admin.slide.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.slide.create');
    }

    public function store(Request $request)
    {
        $slide = new Slide;

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

        $slide->link = $request->link;
        $slide->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $slide->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        if ($request->file('image') != '') {
            $path = public_path('upload/images/');
            $file_old = $path . $slide->image;
            if(File::exists($file_old)) {
                File::delete($file_old); 
            }
            
            $file = $request->file('image');
            $filename = time().$file->getClientOriginalName();
            $file->move('./upload/images/', $filename);
            $slide->image = $filename;
        } 

        $slide->save();
        return back()->with('success', 'Thêm slide thành công!');
    }

    public function edit($id)
    {
        $slide = Slide::findOrFail($id);
        return view('admin.slide.edit', compact('slide'));
    }

    public function update(Request $request, $id)
    {
        $slide = Slide::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'link' => 'required'
        ], [
            'link.required' => 'Bạn cần phải nhập link',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } 

        $slide->link = $request->link;
        $slide->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        if ($request->file('image') != '') {
            $path = public_path('upload/images/');
            $file_old = $path . $slide->image;
            if(File::exists($file_old)) {
                File::delete($file_old); 
            }
            
            $file = $request->file('image');
            $filename = time().$file->getClientOriginalName();
            $file->move('./upload/images/', $filename);
            $slide->image = $filename;
        } 

        $slide->save();
        return back()->with('success', 'Cập nhật slide thành công!');
    }

    public function destroy(Request $request,$id)
    {
        $slide = Slide::findOrFail($id);
        $path = public_path('upload/images/');
        $file_old = $path . $slide->image;
        if(File::exists($file_old)) {
            File::delete($file_old); 
        }
        $slide->delete();
        return response()->json([
            'message' => 'Xóa slide thành công!'
        ]);
    }
}
