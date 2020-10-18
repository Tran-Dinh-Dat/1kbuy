<?php

namespace App\Http\Controllers\Auth;

use Str;
use Mail;
use Cache;
use App\User;
use DateTime;
use Validator;
use Carbon\Carbon;
use App\Models\Wallet;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
	public function login()
    {
        if (Auth::guard('web')->check()) {
            // nếu đăng nhập thàng công thì 
            $user = Auth::guard('web')->user();
            $vip_date_expired = new DateTime($user->vip_date_expired);
            $now =  new DateTime(date("Y-m-d"));
            if ($vip_date_expired <= $now) {
                $user->vip = 0;
                $user->save();
            }
            Session::forget('cart');
            return redirect()->route('onekbuy.user.info');
        } else {
            return view('auth.index.login');
        }
    }
    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'loginemail' => 'required|email',
            'loginpassword' => 'required',
        ],[
            'loginemail.required'=>'Tên đăng nhập bắt buộc',
            'loginemail.email' => 'Định dạng email không chính xác',
            'loginpassword.required'=>'Mật khẩu đăng nhập bắt buộc',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }


        $login = [
            'email' => $request->loginemail,
            'password' => $request->loginpassword,
            'active' => 1
        ];
        if (Auth::guard('web')->attempt($login)) {
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Email hoặc mật khẩu không chính xác');
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('onekbuy.index.index');
    }

//--------------------Đăng ký

    public function register(Request $request){       

        $validator = Validator::make($request->all(),[
            'username' => 'required|min:6',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            're_password' => 'required|same:password',
            'checkbox' =>'required',
        ],[
            'username.required'=>'Thông tin tên đăng nhập bắt buộc',
            'username.min'=>'Tên đăng nhập cần nhập ít nhất 6 kí tự',
            'email.required'=> 'Thông tin email bắt buộc',
            'email.email'=> 'Định dạng email không chính xác',
            'email.unique'=> 'Email đã tồn tại',
            'password.required'=>'Thông tin mật khẩu đăng nhập bắt buộc',
            'password.min'=>'Mật khẩu đăng nhập phải có ít nhất 8 ký tự',
            're_password.required'=> 'Nhập lại thông tin mật khẩu',
            're_password.same'=> 'Bạn cần nhập đúng mật khẩu ở trên',
            'checkbox.required' => 'Bạn chưa chấp nhận điều khoản'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput()->with('msg',true);
        }
        
        $register = new User();
        $register->name = $request->username;
        $register->email = $request->email;
        $register->password= bcrypt($request->password);
        $register->verify_token = Str::random(60);
        $register->role = 0;
        $register->active = 1;
        $register->vip_date_create = Carbon::now('Asia/Ho_Chi_Minh');
        $register->vip_date_expired = Carbon::now('Asia/Ho_Chi_Minh');
        $register->vip_package = '';
        $register->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $register->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        $register->save();

        // Mail::send('mail.register',array('data' => $register),function($message) use ($register){
        //     $message->to($register->email)->subject('Đăng kí tài khoản thành công. Vui lòng truy cập email để kích hoạt tài khoản');
        // });

        $wallet = new Wallet();
        $wallet->credit_user = 0;
        $wallet->credit_total = 0;
        $wallet->user_id = $register->id;
        $wallet->save();
        $profile = new Profile();
        $profile->user_id = $register->id;
        $profile->save();
        
        Session::flash('msg',false);
        Session::flash('msg1','Đăng ký thành viên thành công. Mời bạn đăng nhập để trải nghiệm');
        
        return redirect()-> route('auth.index.login');
    }

//  -------------Forgot password

    public function forgotPassword(){
        return view('onekbuy.user.forgotpassword');
    }

    public function postForgotPassword(Request $request){
        $validator = Validator::make($request->all(),[
            'emailforgot'=>'required|email',
        ],[
            'emailforgot.required'=>'Nhập thông tin email đăng ký',
            'emailforgot.email'=>'Định dạng email không chính xác'

        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $email = $request->emailforgot;

        $check = User::where('email',$email)->first();

        if(!$check){
            return redirect()->route('onekbuy.user.forgotpassword')->with('error','Email không hợp lệ');
        }

        Mail::send('mail.repasswordemail',array('data' => $check),function($message) use ($check){
            $message->to($check->email)->subject('Xác nhận email thành công');
        });

        $check->reset_password_token = Str::random(60);
        $check->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $check->save();
        return redirect(route('auth.index.login'))->with('success','Hãy kiểm tra email để xác nhận lại.');
    }

    public function confirmPassword($token){


        $check = User::where('verify_token',$token)->first();
        if(!$check){
            return redirect()->route('onekbuy.user.forgotpassword')->with('error','Mã kích hoạt không đúng');
        }

        if($check->reset_password_token == NULL ){
            return redirect()->route('onekbuy.user.forgotpassword')->with('error','Mã kích hoạt không tồn tại');
        }

        Cache::put('reset_password', $check->id, 900);

        
        return redirect()->route('onekbuy.user.repassword')->with('success', 'Vui lòng nhập mật khẩu mới');

    }

    public function active(){
        return view('mail.active');
    }

    public function repassword(){
        if(!Cache::has('reset_password')){
            return redirect()->route('onekbuy.user.repassword')->with('error', 'Mã kích hoạt hết thời hạn');
        }
        return view('onekbuy.user.repassword');
    }

    public function postRepassword(Request $request){

        $validator = Validator::make($request->all(),[
            'newpassword'=>'required',
            'renewpassword'=>'required|same:newpassword',
        ],[
            'newpassword.required'=>'Bạn cần nhập mật khẩu mới',
            'renewpassword.required'=>'Bạn cần nhập xác nhận lại mật khẩu mới',
            'renewpassword.same'=>'Bạn cần nhập đúng mật khẩu ở trên'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
        
        $password = $request->newpassword;
        $repassword = $request->renewpassword;

        $id = Cache::get('reset_password');

        $user = User::find($id);

        $user->password = trim(bcrypt($password));
        $user->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
                
        $user->update();
        return redirect()->route('auth.index.login')->with('success','Đã đổi mật khẩu thành công');
        ;
    }

    public function activeAccount($token){
        $check = User::where('verify_token',$token)->first();

        if(!$check){
            return redirect()->route('auth.index.login')->with('error','Mã kích hoạt không tồn tại');
        }

        //dd(Carbon::now()->toDateTimeString());
       
        if($check->email_verified_at != NULL){
            return redirect()->route('auth.index.login')->with('error','Tài khoản đã được kích hoạt');
        }

        $check->email_verified_at = Carbon::now('Asia/Ho_Chi_Minh');
        $check->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $check->active = 1;
        $check->save();
        return redirect()->route('auth.mail.active')->with('success','Tài khoản đã kích hoạt thành công');
    }  
}

