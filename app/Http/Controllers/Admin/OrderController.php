<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\User;
use Carbon\Carbon;
use App\Models\Order;
use App\Exports\ExportOrder;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('product')->get();
        return view('admin.order.index', compact('orders'));
    }

    public function show($id){
        $orders = Order::findOrFail($id);
        $user = null;
        if ($orders->user_id != null) {
            $user = User::find($orders->user_id);
        }
        return view('admin.order.show', compact('orders', 'user'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json([
            'message' => 'Xóa đơn hàng thành công!'
        ]);
    }
    public function active($id)
    {
        $order = Order::findOrFail($id);
        if ($order->payment == 0) {
            $order->payment = 1;
            $order->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $order->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $order->save();
            return redirect()->back();
        }
    }

    public function viewexport() 
    {
        return view('admin.order.viewexport');
    }

    public function export($month, $year) 
    {
        return Excel::download(new ExportOrder($month, $year), 'order-all.xlsx');
    }
}
