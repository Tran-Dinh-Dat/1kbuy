<?php

namespace App\Http\Controllers\Admin;

use App\User;
use DateTime;
use Carbon\Carbon;
use App\Models\Wallet;
use App\Exports\ExportUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    { 
        $users = User::paginate(20);
        if ($request->has('search')) {
            $keyword = $request->search;
            $users = User::where('email', 'LIKE', "%$keyword%")->paginate();
        } 
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.add');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:6',
            'email' => 'required|unique:users|email',
            'password' => 'min:8',
            'password_confirmation' => 'same:password|min:8'
        ], [
            'email.required' => 'Không được bỏ trống trường này!',
            'email.email' => 'Phải nhập đúng định dạng email!',
            'email.unique' => 'Email này đã tồn tại',
            'name.required' => 'Không được bỏ trống trường này!',
            'name.min' => 'Tên phải có ít nhất 6 ký tự!',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự!',
            'password_confirmation.same' => 'Xác nhận mật khẩu và mật khẩu phải khớp!',
            'password_confirmation.min' => 'Mật khẩu phải có ít nhất 8 ký tự!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = 0;
            $user->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $user->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $user->save();

            if ($user->wallet == null) {
                $wallet = new Wallet;
                $wallet->credit_user = 0;
                $wallet->credit_total = 0;
                $wallet->user_id = $user->id;
                $wallet->save();
            }
            return back()->with('success', 'Tạo tài khoản thành công');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:6',
            'email' => 'required|email',
        ], [
            'email.required' => 'Không được bỏ trống trường này!',
            'name.required' => 'Không được bỏ trống trường này!',
            'name.min:6' => 'Tên phải có ít nhất 6 ký tự!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $user->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $user->save();
            return back()->with('success', 'Cập nhật tài khoản thành công');
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'message' => 'Xóa yêu tài khoản thành công!'
        ]);
    }

    public function active(Request $request)
    {
        $id = $request->id;
        $user = User::findOrFail($id);
        if ($user->active == 0) {
            $user->active = 1;
            $user->save();
            return '<a href="javascript:void(0)" onclick="getActive('.$id.')" style="cursor: pointer"><i class="fa fa-check text-success"></i> </a>';
        } else {
            $user->active= 0;
            $user->save();
            return '<a href="javascript:void(0)" onclick="getActive('.$id.')" style="cursor: pointer"><i class="fa fa-close text-danger"></i></a>';
        }
    }

    public function vipactive(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $date = date('Y-m-j');
        $oneMonth = strtotime ( '+1 month' , strtotime ( $date ) ) ;
        $oneMonth = date ( 'Y-m-j' , $oneMonth );
        $costs = 30000;

        $wallet = $user->wallet;
        if ($user->vip == 0) {
            if ($costs < $wallet->credit_total)
            {
                $user->vip = 1;
                $user->vip_package = 'tháng';
                $user->vip_date_create = $date;
                $user->vip_date_expired = $oneMonth;
                $wallet->credit_total -= $costs;
                $wallet->save();
                $user->save();
                return back();
            } else {
                return back()->with('error', 'Tài khoản này không đủ tiền nâng cấp vip');
            }
        } else {
            $user->vip = 0;
            $user->vip_package = '';
            $user->save();
            return back();
        }
    }
    public function viewexport() 
    {
        return view('admin.users.viewexport');
    }
    public function export($month, $year) 
    {
        return Excel::download(new ExportUser($month, $year), 'users-all.xlsx');
    }
}
