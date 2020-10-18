<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Exports\RefundExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class RefundController extends Controller
{
    public function index(Request $request)
    {
        $refund = Refund::orderBy('created_at', 'desc')->paginate(50);
        
        if ($request->has('search')) {
            $refund = Refund::orderBy('created_at', 'desc')->where('email',  'LIKE', "%$request->search%")->paginate(50);
        } 
        return view('admin.refund.index', compact('refund')); 
    }

    public function history(Request $request)
    {
        $refund = Refund::orderBy('created_at', 'desc')->where('status', 1)->paginate(50);
        
        if ($request->has('search')) {
            $refund = Refund::orderBy('created_at', 'desc')->where('status', 1)->where('email',  'LIKE', "%$request->search%")->paginate(50);
        } 
        return view('admin.refund.history', compact('refund')); 
    }

    public function destroy($id)
    {
        $refund = Refund::findOrFail($id);
        $refund->delete();
        return response()->json([
            'message' => 'Xóa yêu cầu hoàn tiền thành công!'
          ]);
    }

    public function active(Request $request)    
    {
        $id = $request->id;
        $refund = Refund::findOrFail($id);
        if ($refund->status == 0) {
            $refund->status = 1;
            $refund->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $refund->save();
            $wallet = Wallet::where('user_id', $refund->user_id)->first();
            $wallet->credit_total -= $refund->refund_value;
            $refund->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $wallet->save();
            return '<span class="badge badge-complete">Chấp nhận</span>';
        } else {
            $refund->status= 0;
            $refund->save();
            return '<a href="javascript:void(0)" onclick="getActive('.$id.')" style="cursor: pointer"><span class="badge badge-danger ">Chưa xác nhận</span> </a>';
        }
    }
    public function export() 
    {
        return Excel::download(new RefundExport, 'Yêu cầu hoàn tiền.xlsx');
    }
}
