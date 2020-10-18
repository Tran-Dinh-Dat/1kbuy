<div class="cart-content py-5">
    @if (!Session::has('cart') || Session::get('cart') == null)
        <div class="alert alert-default text-center" role="alert">
            <strong>Giỏ hàng trống</strong>
        </div>            
        <div class="container text-center"> 
           @include('errors.success')
        </div>
    @else 
    <div class="container">
        <form action="{{ route('onekbuy.order.checkout')}}" method="post" id="form_checkout">
        @csrf
            <div class="row">
                @php
                    $user = Auth::guard('web')->user();
                    if($user) {
                        $profile = $user->profile;
                        $location_address = explode(",", $user->profile->address);
                    } else {
                        $location_address = ['','','',''];
                    }
                @endphp
                <div class="col-12 col-md-7 col-right">
                    <h2 class="head-title">Mua sắm Online với 1KBUY VIỆT NAM</h2>
                    <div class="form-order mt-5">
                        <p>Thông tin giao hàng</p>
                        <small class="form-text text-muted custome-size-1rem">Bạn đã có tài khoản? <a href="{{ route('auth.index.login')}}">Đăng nhập</a></small>
                        
                            <div class="">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Họ và tên" value="{{ $user ? $user->name : "" }}">
                                </div>
                                <p class="help is-danger col-12" style="color:red;">{{ $errors->first('name') }}</p>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user ? $user->email : "" }}">
                                        </div>
                                        <p class="help is-danger" style="color:red;">{{ $errors->first('email') }}</p>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <input type="text" name="phone_number" class="form-control" placeholder="Số điện thoại" value="{{ $user ? $profile->phone_number : "" }}">
                                        </div>
                                        <p class="help is-danger" style="color:red;">{{ $errors->first('phone_number') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-position">
                                <div class="form-group">
                                    <input type="text" name="address" class="form-control" placeholder="Địa chỉ (số nhà, tổ, ấp-thôn)" value="{{ $location_address[0]}}">
                                </div>
                                <p class="help is-danger" style="color:red;">{{ $errors->first('address') }}</p>
                                <div class="row">
                                    
                                    <div class="col-4">
                                        <label for="" class="name-tinhthanh custome-size-1rem">Tỉnh / Thành</label>
                                        <select class="custom-select js_location " name="province" id="province_option" data-type="province">
                                            @if (isset($location_address[3]))
                                            <option value="">{{$location_address[3]}}</option>
                                            @endif
                                            <option value="">--- Mời bạn chọn tỉnh ---</option>
                                            @foreach ($provinces as $item)
                                                <option value="{{ $item->id}}"> {{ $item->_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="" class="name-tinhthanh custome-size-1rem">Quận / huyện</label>
                                        <select class="custom-select js_location" name="district" id="district_option" data-type="district">
                                            @if (isset($location_address[2]))
                                                <option value="">{{$location_address[2]}}</option>
                                            @endif
                                            <option value="">--- Mời bạn chọn huyện ---</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="" class="name-tinhthanh custome-size-1rem">Phường / xã</label>
                                        <select class="custom-select js_location" name="ward" id="ward_option" }}>
                                            @if (isset($location_address[1]))
                                                <option value="">{{$location_address[1]}}</option>
                                            @endif
                                            <option value="">--- Mời bạn chọn xã ---</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                           <div class="form-group mt-3">
                            <textarea class="form-control" name="note" id="" rows="3" placeholder="Nội dung lời nhắn..." ></textarea>
                            </div>

                            <h5 class="mt-5 mb-4 phuong-thuc">Phương thức thanh toán</h5>
                            <div class="form-check form-control my-3">
                                <label class="form-check-label pl-4" for="radio1">
                                    <input type="radio" class="form-check-input" id="radio1" name="payment" value="0" checked>Thanh toán khi nhận hàng (COD)
                                </label>
                            </div>
                            <div class="form-check form-control my-3">
                                <label class="form-check-label pl-4" for="radio2">
                                    <input type="radio" class="form-check-input" id="radio2" name="payment" value="1">Thanh toán qua tài khoản ngân hàng
                                </label>
                            </div>
                            <p>Xem hướng dẫn thanh toán qua tài khoản ngân hàng <a href="https://1kbuy.vn/thong-tin/huong-dan-thanh-toan">tại đây</a></p>
                            <div class="form-check form-control my-3">
                                <label class="form-check-label pl-4" for="radio3">
                                    <input type="radio" class="form-check-input" id="radio3" name="payment" value="2">Thanh toán qua ví điện tử
                                </label>
                            </div>
                            <p>Xem hướng dẫn thanh toán qua ví điện tử <a href="https://1kbuy.vn/thong-tin/huong-dan-thanh-toan">tại đây</a></p>   
                    </div>
                </div>
               @if (Session::has('cart'))
                <div class="col-12 col-md-5 col-left">
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($cart as $item)
                        <div class="left-top d-flex align-items-center cart_item">
                           <div class="cart-img-box">
                            <img src="{{ asset('upload/images/'. $item['image'])}}" alt="">
                            <span class="cart_qty_number">
                                <input type="text" name="qty" value="{{ $item['qty']}}" class="cart_update" data-id={{ $item['id']}}>
                            </span>
                           </div>
                            <div class="name-product">
                                <a href="{{route('onekbuy.product.product',['id' => $item['id'],'slug' => 'slug']) }}"><p>{{ $item['name']}}</p></a>
                                <small class="text-muted custome-size-1rem">Size: {{ $item['size']}}</small>
                            </div>
                            <p class="cost-product">{{ number_format($item['price'] )}} đ</p>
                            <span style="cursor: pointer;">
                                <a name="" id="" class="cart_delete" data-id={{ $item['id']}} role="button"><i class="fa fa-window-close text-danger" aria-hidden="true"></i></a>
                            </span>
                        </div>
                        @php
                            $total += $item['price'] * $item['qty']
                        @endphp
                    @endforeach
                    <input type="hidden" name="total" value="{{ $total}}">
                    <hr class="hr-custom my-4">
                    <div class="div-space"></div>
                    <hr class="hr-custom my-4">
                    <div class="left-middle">
                        <small class="text-muted float-left custome-size-1rem">Tạm tính</small>
                        <small class="text-mute float-right"><strong>{{ number_format($total )}} đ</strong></small>
                    </div>
                    <hr class="hr-custom my-4">
                    <div class="left-bottom">
                        <p class="text-muted float-left">Tổng cộng</p>
                        <p class=" text-muted float-right">VND <strong>{{ number_format($total )}} đ</strong></p>
                    </div>
                </div>
               @endif
               <div class="col-12 col-md-7">
                <div class="submit-don-hang">
                    <a href="" class="float-left pt-2"><i class="fas fa-chevron-left"></i> Giỏ hàng</a>
                    <button type="submit" class=" float-right">Hoàn tất đơn hàng</button>
                </div>
               </div>
            </div>
        </form>
    </div>
    @endif
</div>
<script>
$(document).ready(function() {
    $('#form_checkout').bind("keypress", function(e) {
        if (e.keyCode == 13) {               
            e.preventDefault();
            return false;
        }
    });
});
</script>