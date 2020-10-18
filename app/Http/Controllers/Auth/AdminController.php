<?php

namespace App\Http\Controllers\Auth;

use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login()
    {
        if (Auth::guard('admin')->check()) {
            // nếu đăng nhập thàng công thì 
            $users = User::all();
            $vip_date_expired = new DateTime($user->vip_date_expired);
            $now =  new DateTime(date("Y-m-d"));
            foreach ($users as $key => $user) {
                if ($vip_date_expired <= $now) {
                    $user->vip = 0;
                    $user->save();
                }
            }
           
            return redirect()->route('admin.index');
        } else {
            return view('auth.admin.login');
        }
    }

    public function postLogin(Request $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::guard('admin')->attempt($login)) {
            return redirect()->route('admin.index');
        } else {
            return redirect()->back()->with('error', 'Email hoặc mật khẩu không chính xác');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('auth.admin.login');
    }
}
