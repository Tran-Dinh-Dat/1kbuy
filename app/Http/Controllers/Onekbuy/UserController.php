<?php

namespace App\Http\Controllers\Onekbuy;

use Auth;
use Session;
use Validator;
use Carbon\Carbon;
use App\Models\Ward;
use App\Models\Order;
use App\Models\Refund;
use App\Models\Wallet;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Profile;
use App\Models\District;
use App\Models\Province;
use App\Models\Product_User;
use Illuminate\Http\Request;
use App\Models\DepositRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    public function info(){
        $payments = Payment::all();
        $userId = Auth::guard('web')->user()->id;
        $provinces = Province::all();
        $districts = District::all();
        $wards = Ward::all();
        $credit_total = Wallet::with('user')->where('user_id', $userId)->first()->credit_total;
        $user = Auth::user();
        $orders = Order::where('user_id', $userId)->get();
        $transactionHistory = Product_User::where('user_id', Auth::guard('web')->user()->id)->get();
        return view('onekbuy.user.info', compact(
            'user', 
            'transactionHistory', 
            'credit_total', 
            'provinces', 
            'districts', 
            'wards',
            'payments',
            'orders'
        ));
    }
    public function getLocation(Request $request)
    {
        if ($request->type == "province") {
            $data = District::with('province')->where('_province_id',$request->id)->get();
        } 
        if ($request->type == "district") {
            $data = Ward::with('district')->where('_district_id',$request->id)->get();
        }
        return response()->json(['data' => $data]);
    }

    public function postinfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'i_name' => 'required',
            'i_phone' => 'required|max:10|regex:/(0)[0-9]{9}/',
            'i_address' => 'required',
        ], [
            'i_name.required' => 'Nhập họ và tên của bạn',
            'i_phone.required' => 'Nhập số điện thoại của bạn',
            'i_phone.regex' => 'Định dạng số điện thoại không hợp lệ',
            'i_address.required' => 'Nhập địa chỉ của bạn',
            // 'i_email.required' => 'Nhập thông tin Email đăng ký ',
            // 'd_email.email' => 'Bạn cần phải nhập đúng định dạng email',
            // 'd_money.required' => 'Bạn cần phải số tiền',
            // 'd_message.required' => 'Bạn cần phải nhập lời nhắn',
            // 'd_payment.required' => 'Bạn cần phải lựa chọn phương thức thanh toán',
            // 'd_account_holder.required' => 'Bạn cần phải nhập tên chủ tài khoản',
            // 'd_account_number.required' => 'Bạn cần nhập số tài khoản',
        ]);
        if ($validator->fails()) {
            // $request->session()->flash('deposit', true);
            $request->session()->flash('info', true);
            return back()->withErrors($validator)->withInput();
        }
        
        $profile = Profile::where('user_id', Auth::guard('web')->user()->id)->first();
        $user = Auth::guard('web')->user();
        $profile->fullname = "";
        $user->name = $request->i_name;
        $profile->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $profile->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        $profile->phone_number = $request->i_phone;
        if ($request->province && $request->district && $request->ward) {
            $province = Province::findOrFail($request->province)->_name;
            $district = District::findOrFail($request->district)->_name;
            $ward = Ward::findOrFail($request->ward)->_name;
            $profile->address = $request->i_address. ", $ward , $district , $province";
        } else {
            $addre = explode(',', $profile->address);
            if(isset($addre[3])){
                $profile->address = $request->i_address.','.$addre[1].','.$addre[2].','.$addre[3];
            }else{
                $profile->address = $request->i_address;
            }
        }
      
        if ($request->file('avatar') != '') {
            $path = public_path('upload/images/');
            $file_old = $path . $profile->avatar;
            if(File::exists($file_old)) {
                File::delete($file_old); 
            }
            
            $file = $request->file('avatar');
            $filename = time().$file->getClientOriginalName();
            $file->move('./upload/images/', $filename);
            $profile->avatar = $filename;
        } 
        $profile->save();
        $user->save();
        $request->session()->flash('info', true);
        return back()->with('success-info', 'Cập nhật thông tin người dùng thành công!')->withInput();
    }

    public function deposit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'd_name' => 'required|min:6',
            'd_phone' => 'required|max:10|regex:/(0)[0-9]{9}/',
            'd_email' => 'required|email',
            'd_money' => 'required',
            'd_message' => 'required',
            'd_payment' => 'required|not_in:0',
            'd_account_holder' => 'required',
            'd_account_number' => 'required',
        ], [
            'd_name.required' => 'Nhập họ và tên của bạn',
            'd_name.min' => 'Điền đầy đủ họ và tên',
            'd_phone.required' => 'Nhập số điện thoại của bạn',
            'd_phone.regex' => 'Định dạng số điện thoại không hợp lệ',
            'd_email.required' => 'Nhập thông tin Email đăng ký ',
            'd_email.email' => 'Bạn cần phải nhập đúng định dạng email',
            'd_money.required' => 'Bạn cần phải số tiền',
            'd_message.required' => 'Bạn cần phải nhập lời nhắn',
            'd_payment.required' => 'Bạn cần phải lựa chọn phương thức thanh toán',
            'd_account_holder.required' => 'Bạn cần phải nhập tên chủ tài khoản',
            'd_account_number.required' => 'Bạn cần nhập số tài khoản',
        ]);
        if ($validator->fails()) {
            $request->session()->flash('deposit', true);
            $request->session()->flash('infos', true);
            return back()->withErrors($validator)->withInput();
        }
        $userId = Auth::guard('web')->user()->id;
        $depositrequest = new DepositRequest;
        $depositrequest->name = $request->d_name;
        $depositrequest->phone = $request->d_phone;
        $depositrequest->email = $request->d_email;
        $depositrequest->payment = $request->d_payment;
        $depositrequest->account_holder = $request->d_account_holder;
        $depositrequest->account_number = $request->d_account_number;
        $depositrequest->money = $request->d_money;
        $depositrequest->message = $request->d_message;
        $depositrequest->user_id = $userId;
        $depositrequest->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $depositrequest->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $depositrequest->save();

        $data = $request->all();
        $data['id'] = $depositrequest->id;
        $request->session()->flash('deposit', true);
        $request->session()->flash('infos', true);
        // Mail::send('onekbuy.user.mail.depositrequest',array('data' => $data),function($message) use ($data){
        //     $message->to(Config::get('app.mail_user'), $data['d_name'] )->subject('Yêu cầu nạp tiền');
        // });
        return back()->with('success-deposit', 'Đã gửi yêu cầu nạp tiền!');
    }

    public function refund(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $refund = new Refund;
        $validator = Validator::make($request->all(), [
            'r_name' => 'required|min:6',
            'r_phone' => 'required|max:10|regex:/(0)[0-9]{9}/',
            'r_refund_value' => 'required|integer',
            'r_payment' => 'required|not_in:0',
            'r_account_holder' => 'required',
            'r_account_number' => 'required',
            'r_password' => 'required'
        ], [
            'r_name.required' => 'Bạn cần phải nhập tên!',
            'r_name.min:6' => 'Bạn cần phải nhập ít nhất 6 ký tự',
            'r_phone.required' => 'Bạn cần phải nhập số điện thoại',
            'r_phone.regex' => 'Bạn cần nhập số điện thoại đúng định dạng!',
            'r_refund_value.required' => 'Bạn cần phải nhập số tiền',
            'r_payment.required' => 'Bạn cần phải lựa chọn phương thức thanh toán',
            'r_account_holder.required' => 'Bạn cần phải nhập tên chủ tài khoản',
            'r_account_number.required' => 'Bạn cần nhập số tài khoản',
            'r_password.required' => 'Bạn cần nhập mật khẩu',
        ]);
        
        if ($validator->fails()) {
            $request->session()->flash('refund', true);
            $request->session()->flash('infos', true);
            return back()->withErrors($validator)->withInput()->with(['active' => true ]);
        }
        $wallet = Wallet::where('user_id', $userId)->first();
        
        if($wallet->credit_total < $request->r_refund_value){
            $request->session()->flash('refund', true);
            $request->session()->flash('infos', true);
            return back()->with('error-refund', 'Bạn không có đủ tiền trong ví!')->withInput();
        }

        if($request->r_refund_value < 10000){
            $request->session()->flash('refund', true);
            $request->session()->flash('infos', true);
            return back()->with('error-refund', 'Số tiền nhập vào quá ít!')->withInput();
        }
        
        $refund->name = $request->r_name;
        $refund->email = $request->r_email;
        $refund->phone = $request->r_phone;
        $refund->refund_value = $request->r_refund_value;
        $refund->user_id = $userId;
        $refund->status = 0;
        $refund->payment = $request->r_payment;
        $refund->account_holder = $request->r_account_holder;
        $refund->account_number = $request->r_account_number;
        $password = $request->r_password;
        $refund->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $refund->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        if(!Hash::check($password, Auth::guard('web')->user()->password)) {
            $request->session()->flash('refund', true);
            $request->session()->flash('infos', true);
            return back()->with('error-refund', 'Mật khẩu không chính xác!')->withInput();
        } 
        $refund->save();
        $data = $request->all();
        $request->session()->flash('refund', true);
        $request->session()->flash('infos', true);
        // Mail::send('onekbuy.user.mail.refund',array('data' => $data),function($message) use ($data){
        //     $message->to(Config::get('app.mail_user'), $data['r_name'] )->subject('Yêu cầu hoàn tiền');
        // });

        return back()->with('success-refund', 'Gửi yêu cầu hoàn tiền thành công!');
    }   

    public function re_password(Request $request)
    {
        $user = Auth::guard('web')->user();
        if(!Hash::check($request->old_pass, Auth::guard('web')->user()->password)) {
            $request->session()->flash('re_pass', true);
            $request->session()->flash('infos', true);
            return back()->with('error', 'Bạn cần phải nhập đúng mật khẩu cũ');
        } 
        $validator = Validator::make($request->all(), [
            'old_pass' => 'required',
            'new_pass' => 'required|min:8',
            'cf_pass' => 'required|same:new_pass'
        ], [
            'old_pass.required' => 'Bạn cần nhập mật khẩu cũ',
            'new_pass.required' => 'Bạn cần nhập mật khẩu mới',
            'cf_pass.required' => 'Bạn cần nhập lại mật khẩu mới',
            'new_pass.min' => 'Bạn cần nhập ít nhất là 8 ký tự',
            'cf_pass.same' => 'Bạn cần nhập đúng mật khẩu mới',
        ]);

        if ($validator->fails()) {
            $request->session()->flash('re_pass', true);
            $request->session()->flash('infos', true);
            return back()->withErrors($validator)->withInput();
        }
        $user->password = bcrypt($request->new_pass);
        $user->save();
        $request->session()->flash('re_pass', true);
        $request->session()->flash('infos', true);
        return back()->with('success-password', 'Thay đổi mật khẩu thành công');
    }

    public function deleteOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        $request->session()->flash('order', true);
        $request->session()->flash('infos', true);
        return back()->with('success-order', 'Xóa đơn hàng thành công');
    }

    public function updateVipMonth(Request $request)
    {
        $date = date('Y-m-j');
        $oneMonth = strtotime ( '+1 month' , strtotime ( $date ) ) ;
        $oneMonth = date ( 'Y-m-j' , $oneMonth );
        $costs = intval($request->costs);
        $user =  Auth::guard('web')->user();
        $firstUserproduct = Product_User::where([
            ['status','=', 0], 
            ['user_id', '=', $user->id]
        ])->first();
        if($firstUserproduct) {
            $product = Product::findOrFail($firstUserproduct->product_id);
        }
        $wallet = $user->wallet;
        if ($user->vip == 0) {
            if ($costs < $wallet->credit_total)
            {
                $user->vip = 1;
                $user->vip_package = Config::get('user.vip_package.vip_month');
                $user->vip_date_create = $date;
                $user->vip_date_expired = $oneMonth;
                $wallet->credit_total -= $costs;
                $user->save();
                $wallet->save();
                if ($firstUserproduct && $firstUserproduct->tien_tra_gop >= $product->promotion_price) {
                    $firstUserproduct->status = 1;
                    $firstUserproduct->save();
                }  
                $request->session()->flash('history', true);
                $request->session()->flash('infos', true);
                return back()->with('success-history', 'Nâng cấp tài khoản vip tháng thành công');
            } else {
                $request->session()->flash('history', true);
                $request->session()->flash('infos', true);
                return back()->with('error-history', 'Tài khoản của bạn không đủ');
            }
        } else {
            if ($costs < $wallet->credit_total) {
                $oneMonth = strtotime ( '+1 month' , strtotime ( $user->vip_date_expired ) ) ;
                $oneMonth = date ( 'Y-m-j' , $oneMonth );
                $user->vip_date_expired = $oneMonth;
                $wallet->credit_total -= $costs;
                $wallet->save();
                $user->save();
                $request->session()->flash('history', true);
                $request->session()->flash('infos', true);
                return back()->with('success-history', 'Nâng cấp tài khoản vip tháng thành công');
            }
            else {
                $request->session()->flash('history', true);
                $request->session()->flash('infos', true);
                return back()->with('error-history', 'Tài khoản của bạn không đủ');
            }
            
        }
    }

    public function updateVipYear(Request $request)
    {
        $date = date('Y-m-j');
        $oneYear = strtotime ( '+1 year' , strtotime ( $date ) );
        $oneYear = date ('Y-m-j' , $oneYear );
        $costs = intval($request->costs);
        $user =  Auth::guard('web')->user();
        $wallet = $user->wallet;
        if ($user->vip == 0) {
            if ($costs < $wallet->credit_total)
            {
                $user->vip = 1;
                $user->vip_package = Config::get('user.vip_package.vip_year');
                $user->vip_date_create = $date;
                $user->vip_date_expired = $oneYear;
                $wallet->credit_total -= $costs;
                $user->save();
                $wallet->save();
                $request->session()->flash('history', true);
                $request->session()->flash('infos', true);
                return back()->with('success-history', 'Nâng cấp tài khoản vip năm thành công');
            } else {
                $request->session()->flash('history', true);
                $request->session()->flash('infos', true);
                return back()->with('error-history', 'Tài khoản của bạn không đủ');
            }
        } else {
            if ($costs < $wallet->credit_total) {
                $oneYear = strtotime ( '+1 year' , strtotime ( $user->vip_date_expired ) ) ;
                $oneYear = date ( 'Y-m-j' , $oneYear );
                $user->vip_package = Config::get('user.vip_package.vip_year');
                $user->vip_date_expired = $oneYear;
                $wallet->credit_total -= $costs;
                $wallet->save();
                $user->save();
                $request->session()->flash('history', true);
                $request->session()->flash('infos', true);
                return back()->with('success-history', 'Nâng cấp tài khoản vip năm thành công');
            }
            else {
                $request->session()->flash('history', true);
                $request->session()->flash('infos', true);
                return back()->with('error-history', 'Tài khoản của bạn không đủ');
            }
            
        }
    }
}