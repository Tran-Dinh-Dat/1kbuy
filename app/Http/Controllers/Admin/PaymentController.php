<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::paginate(50);
        return view('admin.payment.index', compact('payments'));
    }

    public function create(Request $request) 
    {
        return view('admin.payment.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:payments',
            'type' => 'required',
            'logo' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
        ], [
            'name.required' => 'Bạn cẩn nhập tên nền tảng thanh toán',
            'name.unique' => 'Nền tảng thanh toán đã tồn tại',
            'type.required' => 'Bạn cần chọn loại nền tảng thanh toán',
            'logo.required' => 'Bạn cần tải logo lên',
            'logo.mimes' => 'Hình ảnh logo không đúng định dạng',
            'logo.max' => 'Kích thước hình ảnh không vượt quá 10M',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $payment = new Payment;
        $payment->name = $request->name;
        $payment->type = $request->type;
        $payment->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $payment->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time().$file->getClientOriginalName();
            $file->move('./upload/images/', $filename);
            $payment->logo = $filename;
        } 
       
        $payment->save();
        return back()->with('success', 'Thêm nền tảng thanh toán thành công!');
    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        return view('admin.payment.edit', compact('payment'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:payments,name,'. $id,
            'type' => 'required',
            'logo' => 'mimes:jpeg,jpg,png,gif|max:10000',
        ], [
            'name.required' => 'Bạn cẩn nhập tên nền tảng thanh toán',
            'name.unique' => 'Nền tảng thanh toán đã tồn tại',
            'type.required' => 'Bạn cần chọn loại nền tảng thanh toán',
            'logo.mimes' => 'Hình ảnh logo không đúng định dạng',
            'logo.max' => 'Kích thước hình ảnh không vượt quá 10M',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $payment = Payment::findOrFail($id);
        $payment->name = $request->name;
        $payment->type = $request->type;
        $payment->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $payment->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        if ($request->file('logo') != '') {
            $path = public_path('upload/images/');
            $file_old = $path . $payment->logo;
            if(File::exists($file_old)) {
                File::delete($file_old); 
            }
            
            $file = $request->file('logo');
            $filename = time().$file->getClientOriginalName();
            $file->move('./upload/images/', $filename);
            $payment->logo = $filename;
        } 
       
        $payment->save();
        return back()->with('success', 'Cập nhật nền tảng thanh toán thành công!');
    }

    public function destroy($id)
    {
        $posts = Payment::findOrFail($id);
        $posts->delete();
        return response()->json([
            'message' => 'Xóa tin tức thành công!'
        ]);
    }
}
