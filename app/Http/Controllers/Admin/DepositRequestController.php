<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DepositRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Exports\DepositExport;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use Carbon\Carbon;

class DepositRequestController extends Controller
{
    public function index(Request $request)
    {
        $depositrequest = DepositRequest::orderBy('created_at', 'desc')->paginate(50);
        if ($request->has('search')) {
            $depositrequest = DepositRequest::orderBy('created_at', 'desc')->where('email',  'LIKE', "%$request->search%")->paginate(50);
        } 
        return view('admin.depositrequest.index', compact('depositrequest'));
    }

    public function history(Request $request)
    {
        $depositrequest = DepositRequest::orderBy('created_at', 'desc')->where('status', 1)->paginate(50);
        if ($request->has('search')) {
            $depositrequest = DepositRequest::orderBy('created_at', 'desc')->where('status', 1)->where('email',  'LIKE', "%$request->search%")->paginate(50);
        } 
        return view('admin.depositrequest.history', compact('depositrequest'));
    }

    public function active(Request $request)
    {
        $id = $request->id;
        $depositrequest = DepositRequest::findOrFail($id);
        if ($depositrequest->status == 0) {
            $depositrequest->status = 1;
            $depositrequest->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $depositrequest->save();
            $wallet = User::findOrFail($depositrequest->user_id)->wallet;
            $wallet->credit_total += $depositrequest->money;
            $wallet->save();
            $data  = [  
                'id' => $depositrequest->id,
                'name' => $depositrequest->name, 
                'email' => $depositrequest->email, 
                'wallet' => $wallet->credit_total
            ];
            Mail::send('admin.depositrequest.mail',array('data' => $data),function($message) use ($data){
                $message->to($data['email'], $data['name'] )->subject('1kbuy');
            });
            return '<span class="badge badge-complete">Chấp nhận</span>';
        }
    }

    public function destroy($id)
    {
        $depositrequest = DepositRequest::findOrFail($id);
        $depositrequest->delete();
        return response()->json([
            'message' => 'Xóa yêu cầu nạp tiền thành công!'
        ]);
    }

    public function export() 
    {
        return Excel::download(new DepositExport, 'Yêu cầu nạp tiền.xlsx');
    }
}
