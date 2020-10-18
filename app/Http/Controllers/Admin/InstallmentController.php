<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product_User;
use Illuminate\Http\Request;
use App\Exports\InstallmentExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class InstallmentController extends Controller
{
    public function index()
    {
        $installments = Product_User::with('product')->orderBy('id', 'desc')->get();
        return view('admin.installment.index', compact('installments'));
    }

    public function show($id){
        // $orders = Order::findOrFail($id);
        // return view('admin.order.show', compact('orders'));
    }

    public function destroy($id)
    {
        $installment = Product_User::findOrFail($id);
        $installment->delete();
        return response()->json([
            'message' => 'Xóa đơn hàng trả góp thành công!'
        ]);
    }
    public function active($id)
    {
        // $order = Order::findOrFail($id);
        // if ($order->payment == 0) {
        //     $order->payment = 1;
        //     $order->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        //     $order->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        //     $order->save();
        //     return redirect()->back();
        // }
    }

    public function viewexport() 
    {
        return view('admin.installment.viewexport');
    }

    public function export($month, $year) 
    {
        return Excel::download(new InstallmentExport($month, $year), 'installment-all.xlsx');
    }
}
