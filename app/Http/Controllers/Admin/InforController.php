<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Carbon\Carbon;
use App\Models\Information;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class InforController extends Controller
{
    public function edit(){
        $information = Information::find(1)->first();
        return view('admin.informations.edit', compact('information'));
    }

    public function update(Request $request , $id){
        $validator = Validator::make($request->all(),[
            'luachon' => 'required',
            'dexuat' => 'required',
            'phobien' => 'required',
            'home' => 'required',
            'shop' => 'required',
            'blog' => 'required',
            'notify' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email'=> 'required|email',
            'logo' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'logofooter' => 'mimes:jpeg,jpg,png,gif|max:10000',
        ],[
            'luachon.required' => 'Bạn cần nhập ô lựa chọn nhiều nhất',
            'dexuat.required' => 'Bạn cần nhập ô đề xuất hấp dẫn',
            'phobien.required' => 'Bạn cần nhập ô xem phổ biến',
            'notify.required' => 'Bạn cần nhập ô thông báo',
            'home.required' => 'Bạn cần nhập ô trang chủ',
            'shop.required' => 'Bạn cần nhập ô shop',
            'blog.required' => 'Bạn cần nhập ô tin tức',
            'phone.required' => 'Bạn cần nhập số điện thoại',
            'address.required' => 'Bạn cần nhập địa chỉ',
            'email.required' => 'Bạn cần nhập email',
            'email.email' => 'Bạn cần nhập đúng định dạng email',
            'logo.mimes' => 'Bạn chỉ thêm được ảnh jpeg, jpg, png, gif',
            'logo.max' => 'Ảnh chỉ được tới 100000',
            'logofooter.mimes' => 'Bạn chỉ thêm được ảnh jpeg, jpg, png, gif',
            'logofooter.max' => 'Ảnh chỉ được tới 100000',
        ]); 
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }    

        $information = Information::find($id)->first();
        $information->phobien = $request->phobien;
        $information->dexuat = $request->dexuat;
        $information->luachon = $request->luachon;
        $information->phone = $request->phone;
        $information->address = $request->address;
        $information->email = $request->email;
        $information->description = $request->description;
        $information->slogan = $request->slogan;
        $information->link = $request->link;
        $information->home = $request->home;
        $information->shop = $request->shop;
        $information->blog = $request->blog;
        $information->header = $request->header;
        $information->notify = $request->notify;
        $information->copyright = $request->copyright;
        $information->bocongthuong = $request->bocongthuong;
        $information->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        if($request->hasFile('logo')){
            $file = $request->file('logo');
            $filename = time().$file->getClientOriginalName();
            $file->move('./upload/images/', $filename);
            $information->logo = $filename;
        }
        if($request->hasFile('logofooter')){
            $file = $request->file('logofooter');
            $filename = time().$file->getClientOriginalName();
            $file->move('./upload/images/', $filename);
            $information->logofooter = $filename;
        }
        if($request->hasFile('banner')){
            $file = $request->file('banner');
            $filename = time().$file->getClientOriginalName();
            $file->move('./upload/images/', $filename);
            $information->banner = $filename;
        }
        $information->save();
        return back()->with('success','Bạn đã cập nhập thông tin thành công');
    }
}
