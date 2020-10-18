<?php

namespace App\Http\Controllers\Onekbuy;

use DB;
use Auth;
use Carbon\Carbon;
use App\Models\Ward;
use App\Models\Order;
use App\Models\Product;
use App\Models\Profile;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart');
        $provinces = Province::all();
        $districts = District::all();
        $wards = Ward::all();
        return view('onekbuy.cart.index', compact([
            'cart',
            'provinces',
            'districts',
            'wards',
        ]));
    }

    public function store(Request $request)
    {
        $user = Auth::guard('web')->user();
        $this->validate($request,[
            'size' => 'required'
        ], [
            'size.required'  => 'Bạn cần chọn size',
        ]); 
        $id = $request->id;
        $product = Product::findOrFail($id);
        $cart = Session::get('cart');
        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] += $request->qty;
        } else {
            $price = $product->price;
            $cart[$product->id] = array(
                "id" => $product->id,
                "name" => $product->name,
                "price" => $price,
                "sku" => $product->sku,
                "ship" => $product->ship,
                "image" => $product->image,
                "qty" => $request->qty,
                "size" => $request->size,
            );
        }
        Session::put('cart', $cart);
        Session::flash('success','Sản phẩm đã được thêm vào giỏ hàng!');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        if ($request->id) {
            $cart = Session::get('cart');
            $provinces = Province::all();
            $districts = District::all();
            $wards = Ward::all();
            unset($cart[$request->id]);
            Session::put('cart', $cart);
            $cart = Session::get('cart');
            $cart_item_cp = view('onekbuy.cart.cart_item_cp', compact('cart', 'provinces', 'districts', 'wards'))->render();
            return response()->json(['cart_item_cp'=> $cart_item_cp, 'code' => 200], 200);
        }
    }

    public function update(Request $request)
    {
        if ($request->id && $request->qty) {
            $cart = Session::get('cart');
            $provinces = Province::all();
            $districts = District::all();
            $wards = Ward::all();
            $cart[$request->id]['qty'] = intval($request->qty);
            Session::put('cart', $cart);
            $cart = Session::get('cart');
            $cart_item_cp = view('onekbuy.cart.cart_item_cp', compact('cart', 'provinces', 'districts', 'wards'))->render();
            return response()->json(['cart_item_cp'=> $cart_item_cp, 'code' => 200], 200);
        }
    }

    public function checkout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'address' => 'required',
        ], [
            'name.required' => 'Bạn cần phải nhập tên',
            'email.required' => 'Bạn cần phải nhập email',
            'email.email' => 'Bạn cần phải nhập đúng định dạng email',
            'phone_number.required' => 'Bạn cần phải số điện thoại',
            'address.required' => 'Bạn cần phải địa chỉ',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } 
        DB::beginTransaction();
		try {
            $cart = Session::get("cart");
            $user = Auth::guard('web')->user();
            $order = new Order;
            $order->user_id = $user ? $user->id : null;
            $order->name = $request->name;
            $order->phone_number = $request->phone_number;
            $order->email = $request->email;
            if ($request->province && $request->district && $request->ward) {
                $province = Province::findOrFail($request->province)->_name;
                $district = District::findOrFail($request->district)->_name;
                $ward = Ward::findOrFail($request->ward)->_name;
                $order->address =  "$request->address, $ward , $district , $province";
            } else {
                $profile = Profile::where('user_id', Auth::guard('web')->user()->id)->first();
                $addre = explode(',', $profile->address);
                if(isset($addre[3])){
                    $order->address = $addre[0].','.$addre[1].','.$addre[2].','.$addre[3];
                }else{
                    $order->address = $request->address;
                }
            }
            $order->payment = $request->payment;
            $order->total = $request->total;
            $order->note = $request->note;
            $order->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $order->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $order->save();
            
            foreach ($cart as $key => $value) {
                DB::table('order_products')->insert([
                    'order_id' => $order->id, 
                    'product_id' => $value['id'], 
                    'qty' => $value['qty'], 
                    'size' => $value['size'], 
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                    'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                ]);
            }
            // $data = $order;
            // Mail::send('onekbuy.cart.mail',array('data' => $data),function($message) use ($data){
            //     $message->to($data['email'], $data['name'] )->subject('Hoàn tất đặt hàng 1kbuy');
            // });
           
            DB::commit();

            Session::forget('cart');
            return redirect()->back()->with('success', 'Đặt hàng thành công');
		}catch (Exception $e) {
			DB::rollBack();
			throw new Exception($e->getMessage());
		}
    }
}
