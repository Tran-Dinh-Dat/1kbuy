<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::paginate(50);
        return view('admin.notification.index', compact('notifications'));
    }

    public function create()
    {
        return view('admin.notification.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:6|unique:notification,title',
            'description' => 'required',
            'content' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif',
        ], [
            'title.required' => 'Bạn cần nhập tiều đề',
            'title.unique' => 'Tiều đề đã tồn tại',
            'title.min' => 'Tiều đề tối thiểu 6 ký tự',
            'description.required' => 'Bạn cần nhập mô tả',
            'content.required' => 'Bạn cần nhập nội dung',
            'image.required' => 'Bạn tải hình ảnh lên',
            'image.mimes' => 'Bạn cần tải hình ảnh đúng định dạng jpg, jpeg, png, gif',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }  
        $notification = new Notification;
        $notification->title = $request->title;
        $notification->slug = Str::slug($request->title);
        $notification->description = $request->description;
        $notification->content = $request->content;
        $notification->excel = '';
        $notification->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $notification->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        if ($request->file('image') != '') {
            $path = public_path('upload/images/');
            $file_old = $path . $notification->image;
            if(File::exists($file_old)) {
                File::delete($file_old); 
            }
            
            $file = $request->file('image');
            $filename = time().$file->getClientOriginalName();
            $file->move('./upload/images/', $filename);
            $notification->image = $filename;
        } 
        if ($request->file('excel') != '') {
            $path = public_path('upload/excel/');
            $file_old = $path . $notification->excel;
            if(File::exists($file_old)) {
                File::delete($file_old); 
            }
            
            $file = $request->file('excel');
            $filename = time().$file->getClientOriginalName();
            $file->move('./upload/excel/', $filename);
            $notification->excel = $filename;
        } 
        $notification->save();
        return back()->with('success', 'Thêm thông báo thành công!');
    }

    public function edit($id)
    {
        $notification = Notification::findOrFail($id);
        return view('admin.notification.edit', compact('notification'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:6|unique:notification,title,'. $id,
            'description' => 'required',
            'content' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif',
        ], [
            'title.required' => 'Bạn cần nhập tiều đề',
            'title.unique' => 'Tiều đề đã tồn tại',
            'title.min' => 'Tiều đề tối thiểu 6 ký tự',
            'description.required' => 'Bạn cần nhập mô tả',
            'content.required' => 'Bạn cần nhập nội dung',
            'image.mimes' => 'Bạn cần tải hình ảnh đúng định dạng jpg, jpeg, png, gif',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } 
        $notification = Notification::findOrFail($id);
        $notification->title = $request->title;
        $notification->slug = Str::slug($request->title);
        $notification->description = $request->description;
        $notification->content = $request->content;
        $notification->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $notification->excel = '';
        if ($request->file('image') != '') {
            $path = public_path('upload/images/');
            $file_old = $path . $notification->image;
            if(File::exists($file_old)) {
                File::delete($file_old); 
            }
            
            $file = $request->file('image');
            $filename = time().$file->getClientOriginalName();
            $file->move('./upload/images/', $filename);
            $notification->image = $filename;
        } 
        if ($request->file('excel') != '') {
            $path = public_path('upload/excel/');
            $file_old = $path . $notification->excel;
            if(File::exists($file_old)) {
                File::delete($file_old); 
            }
            
            $file = $request->file('excel');
            $filename = time().$file->getClientOriginalName();
            $file->move('./upload/excel/', $filename);
            $notification->excel = $filename;
        } 
        $notification->save();
        return back()->with('success', 'Cập nhật thông báo thành công!');
        
    }

    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        return response()->json([
            'message' => 'Xóa thông báo thành công!'
        ]);
    }
}
