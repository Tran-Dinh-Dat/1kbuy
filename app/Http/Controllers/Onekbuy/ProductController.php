<?php

namespace App\Http\Controllers\Onekbuy;

use Auth;
use App\User;
use Carbon\Carbon;
use App\Models\Wallet;
use App\Models\Product;
use App\Models\Category;
use App\Models\Product_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    // public function index(){
    //     $product = Product::orderBy('id','desc')->paginate(8);
    // 	return view('onekbuy.shop.index',compact('product'));
    // }
    public function index($slug = 'all'){
        if ($slug == 'all'){
            $categoryPro = Product::where('active', 1)->orderby('id','desc')->paginate(18);
            $countProduct = Product::where('active', 1)->orderby('id','desc')->get();
        }
        else {
            $category =Category::where('slug',$slug)->first();
            if(!$category){
                return redirect()->route('onekbuy.index.index');
            }
            $categoryPro = Product::where('active', 1)->where('category_id',$category->id)->orderBy('id','desc')->paginate(18);
            $countProduct = Product::where('active', 1)->where('category_id',$category->id)->orderBy('id','desc')->get();
        }
        
        return view('onekbuy.product.index',compact('categoryPro','countProduct'));    
    }

    public function product($slug, $id)
    {
        $product = Product::where('active', 1)->findOrFail($id); 
        if(!$product){
            return redirect()->route('onekbuy.product.index');
        }
        if($slug != $product->slug){
            return redirect()->route('onekbuy.product.product', ['slug' => $product->slug, 'id' => $id]);
        }
        $productRelated = Product::where('active', 1)->where('category_id', $product->category_id)->inRandomOrder()->paginate(8);
        $productPropose = Product::where('active', 1)->inRandomOrder()->limit(15)->get();
        
        $minutes = '60';
        $key = 'detail' . $product->id;
        if (Cache::has($key)) {
            return view('onekbuy.product.product', compact('product', 'productRelated', 'productPropose'));
        } else {
            Cache::put($key, 1, $minutes);
            $product->view +=1;
            $product->save();
        }
   
        return view('onekbuy.product.product', compact('product', 'productRelated', 'productPropose'));
    }

    public function searchProduct(Request $request){
        // dd($request->name);
        $search = Product::where('active', 1)->where('name','LIKE','%'.$request->name.'%')->orderby('id','desc')->paginate(18);
        // dd($search);
        // $search -> name = $request -> name;
        $countProduct = Product::where('active', 1)->orderby('id','desc')->get();
        return view('onekbuy.product.search',compact('search','countProduct'));
    }

    public function popularProduct(){
        $popularProductCategory = Product::where('active', 1)->orderBy('view', 'desc')->paginate(18);
        $countProduct = Product::where('active', 1)->orderby('id','desc')->get();
        return view('onekbuy.product.popularproduct',compact('popularProductCategory','countProduct'));
    }
    public function mostChosen(){
        $mostChosen = Product::where('active', 1)->orderBy('buyer_number', 'desc')->paginate(18);
        $countProduct = Product::where('active', 1)->orderby('id','desc')->get();
        return view('onekbuy.product.mostchosen',compact('mostChosen','countProduct'));
    }
    public function productpropose(){
        $productPropose = Product::where('active', 1)->inRandomOrder()->paginate(18);
        $countProduct = Product::where('active', 1)->orderby('id','desc')->get();
        return view('onekbuy.product.productpropose',compact('productPropose','countProduct'));
    }

    public function sort($sort){
        $countsort = Product::where('active', 1)->orderBy('view', 'desc')->get();

        if($sort == 'popularity'){
            $sorts = Product::where('active', 1)->orderBy('view', 'desc')->paginate(18);
        }
        elseif($sort == 'lastest'){
            $sorts = Product::where('active', 1)->orderBy('id','asc')->paginate(18);
        }
        elseif($sort == 'low-to-high'){
            $sorts = Product::where('active', 1)->orderBy('price','asc')->paginate(18);
        }
        elseif($sort == 'high-to-low'){
            $sorts = Product::where('active', 1)->orderBy('price','desc')->paginate(18);
        }
        elseif($sort == 'default'){
            $sorts = Product::where('active', 1)->orderBy('id','desc')->paginate(18);
        }
        else{
            return view('errors.404');
        }
        return view('onekbuy.product.sortbypopularity',compact('sorts','sort','countsort'));
    }

    public function order($id){

        $product = Product::where('active', 1)->with('user')->find($id);
        $profile = Auth::guard('web')->user()->profile;

        if($profile->phone_number == null || $profile->address == null){
            return redirect()->route('onekbuy.user.info')->with('error-info','Bạn cần nhập đầy đủ thông tin');
        }

        if(!$product){
            return redirect()->route('onekbuy.index.index')->with('error', 'Sản phẩm không tồn tại');
        }

        if(Auth::guard('web')->user()->wallet->credit_total <= $product->promotion_price){
            return redirect()->back()->with('error', 'Tài khoản của bạn không đủ tiền');
        }

        foreach(User::find(Auth::guard('web')->user()->id)->product as $item){
            if($item->id == $id){
                $order_product = Product_User::where('product_id', $id)->where('user_id', Auth::guard('web')->user()->id)->first();
                if(!$order_product){
                    return redirect()->route('onekbuy.product.product', ['slug' => $product->slug, 'id' => $id])->with('error','Đặt lệnh thất bại'); 
                }
            }
        }

        $userproduct = new Product_User();
        $userproduct->user_id = Auth::guard('web')->user()->id;
        $userproduct->product_id = $id;
        $userproduct->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $userproduct->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $userproduct->save();

        $wallet = Wallet::where('user_id', Auth::guard('web')->user()->id)->first();
        $wallet->credit_total -= $product->promotion_price;
        $wallet->save();

        $product->buyer_number += 1;
        $product->save();

        return redirect()->route('onekbuy.product.product', ['slug' => $product->slug, 'id' => $id])->with('success', 'Đặt lệnh thành công');
    }

    public function traGop($id, Request $request){
        $product = Product::findOrFail($id);
        $user = Auth::guard('web')->user();
        if($user->vip == 1 && $user->vip_package == 2) {
            $price_sp = $product->price;
            $this->validate($request,[
                'tien_tra_gop' => "required",
                'size' => 'required'
            ], [
                'tien_tra_gop.required'  => 'Bạn cần nhập tiền trả góp',
                'size.required'  => 'Bạn cần chọn size',
            ]);  
        
            $firstUserproduct = Product_User::where([
                ['status','=', 0], 
                ['user_id', '=', Auth::guard('web')->user()->id]
            ])->first();
            $wallet = Wallet::where('user_id', Auth::guard('web')->user()->id)->first();
            if ($firstUserproduct !== null) {
                return redirect()->route('onekbuy.product.product', ['slug' => $product->slug, 'id' => $id])->with('error', 'Bạn vẫn chưa hoàn thành trả góp sản phẩm cũ');
            }

            $userproduct = new Product_User();
            $userproduct->user_id = Auth::guard('web')->user()->id;
            $userproduct->product_id = $id;
            $userproduct->size = $request->size;
            $userproduct->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $userproduct->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $userproduct->tien_tra_gop = $request->tien_tra_gop;
            
            if ($wallet->credit_total <  $request->tien_tra_gop) {
                return redirect()->route('onekbuy.product.product', ['slug' => $product->slug, 'id' => $id])->with('error', 'Bạn không đủ tiền');
            }
            if ($price_sp == $request->tien_tra_gop) {
                $userproduct->status = 1;
            } 
            $wallet->credit_total -=  $request->tien_tra_gop;
            $userproduct->save();
            $wallet->save();

            return redirect()->route('onekbuy.product.product', ['slug' => $product->slug, 'id' => $id])->with('success', 'Trả góp thành công');
        }
        
        return back()->with('error', 'Chỉ có thành viên vip năm mới có thế trả góp');
    }

    public function traGopMoiNgay(Request $request, $id)
    {
        DB::transaction(function()  use ($request) {
            $tien_tra_gop = $request->so_tien_tra_gop;
            $user = Auth::guard('web')->user();
            $firstUserproduct = Product_User::where([
                ['status','=', 0], 
                ['user_id', '=', Auth::guard('web')->user()->id]
            ])->first();
            if ($firstUserproduct == null) {
                Session::flash('history', true);
                Session::flash('infos', true);
                return back()->with('error', 'Không có sản phẩm nào đang trả góp');
            }
            $product = Product::findOrFail($firstUserproduct->product_id);
            $price_vip = $product->price;
            if ($firstUserproduct->tien_tra_gop + $tien_tra_gop >= $price_vip) {
                $firstUserproduct->status = 1;
            }    
            $wallet = Wallet::where('user_id', Auth::guard('web')->user()->id)->first();
            if ($wallet->credit_total < $tien_tra_gop) {
                Session::flash('history', true);
                Session::flash('infos', true);
                return back()->with('error', 'Bạn không đủ tiền');
            } else {
                $wallet->credit_total -=  $tien_tra_gop;
                $wallet->save();
                $firstUserproduct->tien_tra_gop += $tien_tra_gop;
                $firstUserproduct->save();
            }
            Session::flash('history', true);
            Session::flash('infos', true);
        });
        return back()->with('success', 'Trả góp mỗi ngày thành công');
    }
}
