<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Admin;
use App\Models\Refund;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\DepositRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        $payment = Payment::all();
        $post = Post::all();
        $deposit = DepositRequest::where('status', 0)->get();
        $refund = Refund::where('status', 0)->get();
        return view('admin.index', compact('payment', 'post', 'deposit', 'refund'));
    }
    public function edit()
    {
        $user = Admin::first();
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Không được bỏ trống trường này!',
            'password.required' => 'Không được bỏ trống trường này!',
            'email.email' => 'Email không đúng định dạng!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        } else {
            $user = Admin::first();
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            return back()->with('success', 'Cập nhật tài khoản thành công');
        }
    }
    public function resetPassword(){
        DB::transaction(function () {
            $user = Admin::first();
            $new_pass = rand(100000, 999999);
            $user->password = bcrypt($new_pass);
            $user->save();
            $user['new_pass'] = $new_pass;
            
            Mail::send('mail.admin_reset_pass',array('data' => $user),function($message) use ($user){
                $message->to(Config::get('app.mail_user'), Config::get('app.mail_user') )->subject('Reset mật khẩu');
            });
            Auth::guard('admin')->logout();
            echo "<script>
                alert('Reset mật khẩu thành công, mật khẩu mới đã được gửi tới mail của bạn');
                window.location.href = '/admin'; 
            </script>";
        });
       
    }
}
