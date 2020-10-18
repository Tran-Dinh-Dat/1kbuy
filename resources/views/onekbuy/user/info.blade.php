@extends('templates.onekbuy.master')
@section('content')

    <div class="container">
        <div class="row row-form">
            <div class="col-md-3 d-none d-md-block d-lg-block d-xl-block">
                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist"
                    aria-orientation="vertical">
                    <a class="nav-link mb-3 p-3 shadow tabinfo {{ session()->has('info')?'active':'' }} {{ session()->has('infos')?'':' active' }}" id="infouser" 
                        href="#info" role="tab" aria-controls="v-pills-home" aria-selected="true" data-toggle="pill">
                        <i class="fa fa-user-circle-o mr-2"></i>
                    <span class="font-weight-bold small text-uppercase">Cập nhật thông tin</span></a>

                    <a class="nav-link mb-3 p-3 shadow tabinfo {{ session()->has('deposit')?'active':'' }}" id="depositrequestuser" 
                        href="#depositrequest" role="tab" aria-controls="v-pills-recharge" aria-selected="true" data-toggle="pill"> 
                        <i class="fa fa-user-circle-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Nạp tiền</span></a>

                    <a class="nav-link mb-3 p-3 shadow tabinfo {{ session()->has('refund')?'active':'' }}" id="refunduser" 
                        href="#refund" role="tab" aria-controls="v-pills-refund" aria-selected="true" data-toggle="pill">
                        <i class="fa fa-user-circle-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Hoàn tiền</span></a>

                    <a class="nav-link mb-3 p-3 shadow tabinfo" id="historyuser" 
                        href="#history" role="tab" aria-controls="v-pills-history" aria-selected="true" data-toggle="pill">
                        <i class="fa fa-user-circle-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Lịch sử đặt lệnh </span></a>
                    
                    <a class="nav-link mb-3 p-3 shadow tabinfo {{ session()->has('order')?'active':'' }}" id="orderuser" 
                        href="#order" role="tab" aria-controls="v-pills-order" aria-selected="true" data-toggle="pill">
                        <i class="fa fa-user-circle-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase ">Lịch sử đặt hàng </span></a>
                   
                    <a class="nav-link mb-3 p-3 shadow tabinfo " id="re_passworduser" 
                        href="#re_password" role="tab" aria-controls="v-pills-re_pass" aria-selected="true" data-toggle="pill">
                        <i class="fa fa-calendar-minus-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Đổi mật khẩu</span></a>
                </div>
            </div>

            <div class="col-md-9 d-none d-md-block d-lg-block d-xl-block">
                <div class="tab-content" id="v-pills-tabContent">
                    {{-- tab info  --}}
                    <div class="tab-pane fade shadow rounded bg-white tabcontent 
                        {{ session()->has('info')?'show active':'' }} {{ session()->get('infos')?'':'show active' }} p-4" id="info" role="tabpanel"
                        aria-labelledby="v-pills-home-tab">
                        @if (Session::has('success-info'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ Session::get('success-info')}}
                            </div>
                        @endif
                        @if (Session::has('error-info'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ Session::get('error-info')}}
                            </div>
                        @endif
                        <form class="form-update-info" method="post" action="{{ route('onekbuy.user.postinfo')}}" enctype="multipart/form-data">
                            @csrf
                                <input name="fullname" class="form-control" type="hidden" value="{{ $user->profile->fullname}}">
                            <div class="form-group ">
                                <label for="2">Tên hiển thị</label>
                                <input type="text" name="i_name" class="form-control username" id="2"
                                    value="{{ $user->name}}" >
                                    <p class="help is-danger" style="color:red;">{{ $errors->first('i_name') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="2">Email</label>
                                <input disabled name="i_email" type="text" class="form-control email" id="2"
                                    value="{{ $user->email}}">
                            </div>
                            <div class="form-group">
                                <label for="2">Số điện thoại</label>
                                <input name="i_phone" type="text" class="form-control" id="2" value="{{ $user->profile->phone_number}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('i_phone') }}</p>
                            </div>
                            @php
                                $location_address = explode(",", $user->profile->address);
                            @endphp
                            <div class="form-group">
                                <label for="2">Tỉnh</label>
                                <select class="form-control js_location " name="province" id="province_option" data-type="province" value="">
                                    @if (isset($location_address[3]))
                                        <option value="">{{$location_address[3]}}</option>
                                    @endif
                                    <option value="">--- Mời bạn chọn tỉnh ---</option>
                                    @foreach ($provinces as $item)
                                        <option value="{{ $item->id}}"> {{ $item->_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="2">Huyện</label>
                                <select class="form-control js_location" name="district" id="district_option" data-type="district">
                                    @if (isset($location_address[2]))
                                        <option value="">{{$location_address[2]}}</option>
                                    @endif
                                    <option value="">--- Mời bạn chọn huyện ---</option>
                              </select>
                            </div>
                            <div class="form-group">
                                <label for="2">Xã</label>
                                <select class="form-control js_location" name="ward" id="ward_option" }}>
                                    @if (isset($location_address[1]))
                                        <option value="">{{$location_address[1]}}</option>
                                    @endif
                                    <option value="">--- Mời bạn chọn xã ---</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Địa chỉ</label>
                                <textarea name="i_address" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $location_address[0]}}</textarea>
                                <p class="help is-danger" style="color:red;">{{ $errors->first('i_address') }}</p>
                            </div>
                            <div class="form-group">
                              <input type="text"
                                class="form-control" readonly name="" value="{{ $user->profile->address}}">
                            </div>
                            <div class="form-group">
                                <label for="">Ảnh</label><br>
                                <img src="{{ $user->profile->avatar ? asset('./upload/images/'.$user->profile->avatar) : asset('./upload/images/avatar.png') }}"  width="150px" style="object-fit: cover" />
                                <input type="file" class="form-control-file" name="avatar" id="">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('avatar') }}</p>
                            </div>
                            <button type="submit" type="button" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>
                    {{-- tab depositrequest --}}
                    <div class="tab-pane fade shadow rounded bg-white tabcontent {{ session()->has('deposit')?'show active':'' }} p-4 " id="depositrequest" role="tabpanel"
                        aria-labelledby="v-pills-recharge-tab">
                        @if (Session::has('success-deposit'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ Session::get('success-deposit')}}
                            </div>
                        @endif
                        <form class="form-reset-pass" method="post" action="{{ route('onekbuy.user.deposit')}}">
                            @csrf
                            <div class="form-group">
                                <label for="">Họ và tên</label>
                                <input name="d_name" type="text" class="form-control" value="{{ old('d_name')}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('d_name') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input readonly name="d_email" type="text" class="form-control" value="{{$user->email}}">
                            </div>
                            <div class="form-group">
                                <label for="">Số điện thoại</label>
                                <input name="d_phone" type="text" class="form-control" value="{{ old('d_phone')}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('d_phone') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="">Số tiền</label>
                                <input name="d_money" type="text" class="form-control" value="{{ old('d_money')}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('d_money') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Phương thức thanh toán</label>
                                @php
                                    $userId = Auth::guard('web')->user();
                                @endphp
                                <select name="d_payment" class="form-control" id="onchange_d_payment" class="mySelect">
                                    <option value="">Chọn phương thức thanh toán</option>
                                    @foreach ($payments as $item)
                                    <option class="pay_option" value="{{$item->name}}">
                                        {{$item->name}}
                                    </option>
                                    @endforeach
                                    <option value="khac">Khác</option>
                                </select>
                                <div class="form-group mt-2 mb-2" id="d_payment">
                                    
                                </div>
                                <p class="help is-danger" style="color:red;">{{ $errors->first('d_payment') }}</p>
                                <div class="form-group">
                                    <label for="">Chủ tài khoản</label>
                                    <input name="d_account_holder" type="text" class="form-control" value="{{ old('d_account_holder')}}">
                                    <p class="help is-danger" style="color:red;">{{ $errors->first('d_account_holder') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Số tài khoản</label>
                                    <input name="d_account_number" type="text" class="form-control" value="{{ old('d_account_number')}}">
                                    <p class="help is-danger" style="color:red;">{{ $errors->first('d_account_number') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Lời nhắn</label>
                                    <input name="d_message" type="text" class="form-control" value="{{ old('d_message')}}">
                                    <p class="help is-danger" style="color:red;">{{ $errors->first('d_message') }}</p>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
                        </form>
                    </div>

                    {{-- tab refund --}}
                    <div class="tab-pane fade shadow rounded bg-white tabcontent {{ session()->has('refund')?'show active':'' }} p-4" id="refund" role="tabpanel"
                        aria-labelledby="v-pills-recharge-tab">
                        @if (Session::has('success-refund'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ Session::get('success-refund')}}
                            </div>
                        @endif

                        @if (Session::has('error-refund'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ Session::get('error-refund')}}
                            </div>
                        @endif
                        {{-- @include('errors.errors') --}}
                        <form class="form-reset-pass" method="post" action="{{ route('onekbuy.user.refund')}}">
                            @csrf
                            <div class="form-group">
                            <label for="">Họ và tên</label>
                                <input name="r_name" type="text" class="form-control" value="{{ old('r_name')}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('r_name') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Số điện thoại</label>
                                <input name="r_phone" type="text" class="form-control" value="{{ old('r_phone')}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('r_phone') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input readonly='true' name="r_email" type="text" class="form-control" value="{{ Auth::guard('web')->user()->email}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('r_email') }}</p>
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <div class="input-group" id="show_hide_password">
                                  <input class="form-control" type="password" name="r_password" placeholder="Mật khẩu đăng nhập của bạn">
                                  <div class="input-group-addon">
                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                  </div>
                                </div>
                                <p class="help is-danger" style="color:red;">{{ $errors->first('r_password') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="refund_value">Số tiền</label>
                                <input name="r_refund_value" type="text" class="form-control" value="{{ old('r_refund_value')}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('r_refund_value') }}</p>
                            </div>
                            <label for="">Phương thức thanh toán</label>
                            <select name="r_payment" class="form-control" id="onchange_r_payment">
                                <option value="">Chọn phương thức thanh toán</option>
                                @foreach ($payments as $item)
                                    <option class="pay_option" value="{{$item->name}}">
                                        {{$item->name}}
                                    </option>
                                @endforeach
                                <option value="khac">Khác</option>
                            </select>
                            <div class="form-group  mt-2 mb-2" id="r_payment">

                            </div>
                            <p class="help is-danger" style="color:red;">{{ $errors->first('r_payment') }}</p>
                            <div class="form-group">
                                <label for="">Chủ tài khoản</label>
                                <input name="r_account_holder" type="text" class="form-control" value="{{ old('r_account_holder')}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('r_account_holder') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Số tài khoản</label>
                                <input name="r_account_number" type="text" class="form-control" value="{{ old('r_account_number')}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('r_account_number') }}</p>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
                        </form>
                    </div>

                    {{-- lịch sử giao dịch --}}
                    <div class="tab-pane fade shadow rounded bg-white tabcontent {{ session()->has('history')?'show active':'' }} p-4" id="history" role="tabpanel"
                        aria-labelledby="v-pills-history-tab">

                        <div class="form-group">
                            <div class="col-md-4">Số dư: {{ number_format($credit_total)}} vnd</div>
                            <div class="col-md-4">
                                <form action="{{ route('onekbuy.product.tra-gop-moi-ngay', Auth::guard('web')->user()->id)}}" method="post">
                                    @csrf
                                    <button type="button" data-toggle="modal" data-target="#modeltragopmoingay" class="btn btn-primary bg-orange">Trả góp mỗi ngày</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modeltragopmoingay" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Trả góp mỗi ngày</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <p>Nhập số tiền trả góp</p>
                                                    </div>
                                                    <div class="form-group">
                                                      <input type="number" min="1000" name="so_tien_tra_gop" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                               
                            </div>
                            <div class="col-md-4">
                                    @csrf
                                    <button data-toggle="modal" data-target="#modelId" type="button" class="btn btn-primary bg-orange float-right">Nâng cấp thành viên</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Đăng ký thành viên vip</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                       <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="card">
                                                                <form action="{{ route('onekbuy.order.updateVipMonth')}}" method="post" class="float-right">
                                                                    @csrf
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Thành viên Vip/tháng</h4>
                                                                        <p class="card-text">Thời gian: 1 tháng</p>
                                                                        <p class="card-text">Chi phí: 30.000 vnd/tháng</p>
                                                                        <p class="card-text">Mô tả: Trả góp với giá khuyến mãi</p>
                                                                        <input type="hidden" name="costs" id="" value="30000">
                                                                        <button type="submit" class="btn btn-primary">Đăng ký</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="card">
                                                                <form action="{{ route('onekbuy.order.updateVipYear')}}" method="post" class="float-right">
                                                                    @csrf
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Thành viên Vip/năm</h4>
                                                                        <p class="card-text">Thời gian: 1 năm</p>
                                                                        <p class="card-text">Chi phí: 300.000 vnd/năm</p>
                                                                        <p class="card-text">Mô tả: Trả góp với giá khuyến mãi</p>
                                                                        <input type="hidden" name="costs" id="" value="300000">
                                                                        <button type="submit" class="btn btn-primary">Đăng ký</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                       </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="row"> 
                            @if (Session::has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ Session::get('error')}}
                                </div>
                            @else
                                @include('errors.success')
                            @endif

                            @if (Session::has('success-history'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ Session::get('success-history')}}
                                </div>
                            @endif
                            @if (Session::has('error-history'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ Session::get('error-history')}}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th style="width: 130px;">Sản phẩm</th>
                                        <th>Size</th>
                                        <th>Giá trị</th>
                                        <th>Số tiền đã trả góp</th>
                                        <th>Trạng thái</th>
                                        <th>Thời gian đặt lệnh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactionHistory as $item)
                                        <tr>
                                            <td>{{ $item->id}}</td>
                                            <td><a href="{{ route('onekbuy.product.product', ['slug' => $item->product->slug, 'id' => $item->product->id]) }}">{{ $item->product->name}}</a></td>
                                            <td>{{ $item->size }}</td>
                                            <td>
                                                {{ number_format($item->product->price)}} vnd
                                            </td>
                                            <td>{{ number_format($item->tien_tra_gop) }} vnd</td>
                                            <td>@if ($item->status == 0 )
                                                    <span class="text-danger">Đang trả góp</span>
                                                @else
                                                    <span class="text-success">Đã hoàn thành</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->created_at->format('H:i:s Y.m.d')}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Sản phẩm</th>
                                        <th>Size</th>
                                        <th>Giá trị</th>
                                        <th>Số tiền đã trả góp</th>
                                        <th>Trạng thái</th>
                                        <th>Thời gian đặt lệnh</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    {{-- lịch sử đặt hàng --}}
                    <div class="tab-pane fade shadow rounded bg-white tabcontent {{ session()->has('order')?'show active':'' }} p-4" id="order" role="tabpanel"
                        aria-labelledby="v-pills-recharge-tab">

                        <div class="form-group">
                            <label for="">Số lượng đơn hàng : {{ $orders->count()}}</label>
                        </div>
                        @if (Session::has('success-order'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ Session::get('success-order')}}
                            </div>
                        @endif
                        <div class="form-group">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Lời nhắn</th>
                                        <th>Thời gian mua hàng</th>
                                        <th>Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $item)
                                        <tr>
                                            <td>#{{ $key+1}}</td>
                                            <td>1kbuy{{ $item->id}}</td>
                                            <td>{{ number_format($item->total) }}</td>
                                            <td>{{ $item->note }}</td>
                                            <td>{{ $item->created_at->format('Y-m-d H:i:s') }}</td>
                                            <td>
                                                <a  id="" class="btn btn-primary" href="#" data-toggle="modal" data-target="#modal-{{$item->id}}">Chi tiết</a>
                                                <a  id="" class="btn btn-danger" href="#" data-toggle="modal" data-target="#modal-delete{{$item->id}}">Xóa</a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="modal-delete{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Xóa đơn hàng</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                Bạn có chắc chắn muốn xóa đơn hàng này không?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                                <a class="btn btn-danger" href="{{ route('onekbuy.order.deleteOrder', $item->id)}}">Xóa</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="modal-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Chi tiết đơn hàng 1kbuy{{ $item->id}}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Stt</th>
                                                                            <th>Tên sản phẩm</th>
                                                                            <th>Hình ảnh</th>
                                                                            <th>SKU</th>
                                                                            <th>Số lượng</th>
                                                                            <th>Giá</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                       @foreach ($item->product as $key => $product)
                                                                        <tr>
                                                                            <td>{{ $key+1}}</td>
                                                                            <td>{{ $product->name}}</td>
                                                                            <td><img style="width: 100px" src="{{ asset('upload/images/'. $product->image)}}" alt=""></td>
                                                                            <td>{{ $product->sku}}</td>
                                                                            <td>{{ $product->pivot->qty}}</td>
                                                                            <td>{{ number_format($product->promotion_price = 0?$product->price:$product->promotion_price) }} vnd</td>
                                                                        </tr>
                                                                       @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- re_password --}}
                    <div class="tab-pane fade shadow rounded bg-white tabcontent {{ session()->has('re_pass')?'show active':'' }}  p-4 " id="re_password" role="tabpanel"
                        aria-labelledby="v-pills-re_pass-tab">
                        <p class="help is-danger" style="color:red;">{{ session()->get('error')}}</p>
                        @if (Session::has('success-password'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ Session::get('success-password')}}
                            </div>
                        @endif
                        <form class="form-reset-pass" method="post" action="{{ route('onekbuy.user.re_password')}}">
                            @csrf
                            <div class="form-group">
                                <label>Mật khẩu cũ</label>
                                <div class="input-group" id="show_hide_password">
                                  <input class="form-control" type="password" name="old_pass" value="{{ old('old_pass')}}">
                                  <div class="input-group-addon">
                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                  </div>
                                </div>
                                <p class="help is-danger" style="color:red;">{{ $errors->first('old_pass') }}</p>
                              </div>
                              <div class="form-group">
                                <label>Mật khẩu mới</label>
                                <div class="input-group" id="show_hide_password">
                                  <input class="form-control" type="password" name="new_pass" value="{{ old('new_pass')}}">
                                  <div class="input-group-addon">
                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                  </div>
                                </div>
                                <p class="help is-danger" style="color:red;">{{ $errors->first('new_pass') }}</p>
                              </div>
                              <div class="form-group">
                                <label>Xác nhận mật khẩu</label>
                                <div class="input-group" id="show_hide_password">
                                  <input class="form-control" type="password" name="cf_pass">
                                  <div class="input-group-addon">
                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                  </div>
                                </div>
                                <p class="help is-danger" style="color:red;">{{ $errors->first('cf_pass') }}</p>
                              </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>

                </div>
            </div>

            {{-- mobile --}}
            <div class="col-12 d-block d-md-none d-lg-none d-xl-none">
                {{-- info  --}}
                <nav class="navbar ">
                    <button class="navbar-toggler my-3 signin-button-custom {{ session()->has('info')?'active':'' }} {{ session()->has('infos')?'':' active' }}" type="button" data-toggle="collapse" data-target="#navbarSupportedContent3" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span>Cập nhập thông tin</span>
                    </button>
                  
                    <div class="collapse navbar-collapse signin-form-custom mb-3 {{ session()->has('info')?'show':'' }} {{ session()->has('infos')?'':'show' }}" id="navbarSupportedContent3">
                        @if (Session::has('success-info'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ Session::get('success-info')}}
                            </div>
                        @endif
                        @if (Session::has('error-info'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ Session::get('error-info')}}
                            </div>
                        @endif
                        <form class="form-update-info" method="post" action="{{ route('onekbuy.user.postinfo')}}" enctype="multipart/form-data">
                            @csrf
                                <input name="fullname" class="form-control" type="hidden" value="{{ $user->profile->fullname}}">
                            <div class="form-group ">
                                <label for="2">Tên hiển thị</label>
                                <input type="text" name="i_name" class="form-control username" id="2"
                                    value="{{ $user->name}}" >
                                    <p class="help is-danger" style="color:red;">{{ $errors->first('i_name') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="2">Email</label>
                                <input disabled name="email" type="text" class="form-control email" id="2"
                                    value="{{ $user->email}}" >
                                <p class="help is-danger" style="color:red;">{{ $errors->first('email') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="2">Số điện thoại</label>
                                <input name="i_phone" type="text" class="form-control" id="2" value="{{ $user->profile->phone_number}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('i_phone') }}</p>
                            </div>
                            @php
                                $location_address = explode(",", $user->profile->address);
                            @endphp
                            <div class="form-group">
                                <label for="2">Tỉnh</label>
                                <select class="form-control js_location_mb " name="province" id="province_option_mb" data-type="province" value="">
                                    @if (isset($location_address[3]))
                                        <option value="">{{$location_address[3]}}</option>
                                    @endif
                                    <option value="">--- Mời bạn chọn tỉnh ---</option>
                                    @foreach ($provinces as $item)
                                        <option value="{{ $item->id}}"> {{ $item->_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="2">Huyện</label>
                                <select class="form-control js_location_mb" name="district" id="district_option_mb" data-type="district">
                                    @if (isset($location_address[2]))
                                        <option value="">{{$location_address[2]}}</option>
                                    @endif
                                    <option value="">--- Mời bạn chọn huyện ---</option>
                              </select>
                            </div>
                            <div class="form-group">
                                <label for="2">Xã</label>
                                <select class="form-control js_location_mb" name="ward" id="ward_option_mb" }}>
                                    @if (isset($location_address[1]))
                                        <option value="">{{$location_address[1]}}</option>
                                    @endif
                                    <option value="">--- Mời bạn chọn xã ---</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Địa chỉ</label>
                                <textarea name="i_address" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $location_address[0]}}</textarea>
                                <p class="help is-danger" style="color:red;">{{ $errors->first('i_address') }}</p>
                            </div>
                            <div class="form-group">
                              <input type="text"
                                class="form-control" readonly name="" value="{{ $user->profile->address}}">
                            </div>
                            <div class="form-group">
                                <label for="">Ảnh</label><br>
                                <img src="{{ $user->profile->avatar ? asset('./upload/images/'.$user->profile->avatar) : asset('./upload/images/avatar.png') }}"  width="150px" style="object-fit: cover" />
                                <input type="file" class="form-control-file" name="avatar" id="">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('avatar') }}</p>
                            </div>
                            <button type="submit" type="button" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>
                </nav>

                {{-- depositrequest  --}}
                <nav class="navbar">
                    <button class="navbar-toggler mb-3 signin-button-custom {{ session()->has('deposit')?'active':'' }}" type="button" data-toggle="collapse" data-target="#navbarSupportedContent4" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span>Nạp tiền</span>
                    </button>
                  
                    <div class="collapse navbar-collapse signin-form-custom mb-3 {{ session()->has('deposit')?'show':'' }}" id="navbarSupportedContent4">
                        @if (Session::has('success-deposit'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ Session::get('success-deposit')}}
                            </div>
                        @endif
                        <form class="form-reset-pass" method="post" action="{{ route('onekbuy.user.deposit')}}">
                            @csrf
                            <div class="form-group">
                                <label for="">Họ và tên</label>
                                <input name="d_name" type="text" class="form-control" value="{{ old('d_name')}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('d_name') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input readonly name="d_email" type="text" class="form-control" value="{{$user->email}}">
                            </div>
                            <div class="form-group">
                                <label for="">Số điện thoại</label>
                                <input name="d_phone" type="text" class="form-control" value="{{ old('d_phone')}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('d_phone') }}</p>
                            </div>

                            <div class="form-group">
                                <label for="">Số tiền</label>
                                <input name="d_money" type="text" class="form-control" value="{{ old('d_money')}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('d_money') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Phương thức thanh toán</label>
                                @php
                                    $userId = Auth::guard('web')->user();
                                @endphp
                                <select name="d_payment" class="form-control" id="onchange_d_payment_mb" >
                                    <option value="">Chọn phương thức thanh toán</option>
                                    @foreach ($payments as $item)
                                        <option class="pay_option" value="{{$item->name}}">
                                            {{$item->name}}
                                        </option>
                                    @endforeach
                                    <option value="khac">Khác</option>
                                </select>
                                <div class="form-group  mt-2 mb-2" id="d_payment_mb">

                                </div>
                                <p class="help is-danger" style="color:red;">{{ $errors->first('d_payment') }}</p>
                                <div class="form-group">
                                    <label for="">Chủ tài khoản</label>
                                    <input name="d_account_holder" type="text" class="form-control" value="{{ old('d_account_holder')}}">
                                    <p class="help is-danger" style="color:red;">{{ $errors->first('d_account_holder') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Số tài khoản</label>
                                    <input name="d_account_number" type="text" class="form-control" value="{{ old('d_account_number')}}">
                                    <p class="help is-danger" style="color:red;">{{ $errors->first('d_account_number') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Lời nhắn</label>
                                    <input name="d_message" type="text" class="form-control" value="{{ old('d_message')}}">
                                    <p class="help is-danger" style="color:red;">{{ $errors->first('d_message') }}</p>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
                        </form>
                    </div>
                </nav>

                {{-- refund   --}}
                <nav class="navbar">
                    <button class="navbar-toggler mb-3 signin-button-custom {{ session()->has('refund')?'active':'' }}" type="button" data-toggle="collapse" data-target="#navbarSupportedContent8" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span>Hoàn tiền</span>
                    </button>
                  
                    <div class="collapse navbar-collapse signin-form-custom mb-3 {{ session()->has('refund')?'show':'' }}" id="navbarSupportedContent8">
                        @if (Session::has('success-refund'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ Session::get('success-refund')}}
                            </div>
                        @endif
                        
                        @if (Session::has('error-refund'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ Session::get('error-refund')}}
                            </div>
                        @endif
                        <form class="form-reset-pass" method="post" action="{{ route('onekbuy.user.refund')}}">
                            @csrf
                            <div class="form-group">
                            <label for="">Họ và tên</label>
                                <input name="r_name" type="text" class="form-control" value="{{ old('r_name')}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('r_name') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Số điện thoại</label>
                                <input name="r_phone" type="text" class="form-control" value="{{ old('r_phone')}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('r_phone') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input readonly='true' name="r_email" type="text" class="form-control" value="{{ Auth::guard('web')->user()->email}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('r_email') }}</p>
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <div class="input-group" id="show_hide_password">
                                  <input class="form-control" type="password" name="r_password" placeholder="Mật khẩu đăng nhập của bạn">
                                  <div class="input-group-addon">
                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                  </div>
                                </div>
                                <p class="help is-danger" style="color:red;">{{ $errors->first('r_password') }}</p>
                              </div>
                            <div class="form-group">
                                <label for="refund_value">Số tiền</label>
                                <input name="r_refund_value" type="text" class="form-control" value="{{ old('r_refund_value')}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('r_refund_value') }}</p>
                            </div>
                            <label for="">Phương thức thanh toán</label>
                            <select name="r_payment" class="form-control" id="onchange_r_payment_mb">
                                <option value="">Chọn phương thức thanh toán</option>
                                @foreach ($payments as $item)
                                    <option class="pay_option" value="{{$item->name}}">
                                        {{$item->name}}
                                    </option>
                                @endforeach
                                <option value="khac">Khác</option>
                            </select>
                            <div class="form-group mt-2 mb-2" id="r_payment_mb">

                            </div>
                            <p class="help is-danger" style="color:red;">{{ $errors->first('r_payment') }}</p>
                            <div class="form-group">
                                <label for="">Chủ tài khoản</label>
                                <input name="r_account_holder" type="text" class="form-control" value="{{ old('r_account_holder')}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('r_account_holder') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="">Số tài khoản</label>
                                <input name="r_account_number" type="text" class="form-control" value="{{ old('r_account_number')}}">
                                <p class="help is-danger" style="color:red;">{{ $errors->first('r_account_number') }}</p>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
                        </form>
                    </div>
                </nav>

                {{-- lich su giao dich --}}
                <nav class="navbar">
                    <button class="navbar-toggler mb-3 signin-button-custom" type="button" data-toggle="collapse" data-target="#navbarSupportedContent5" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span>Lịch sử giao dịch</span>
                    </button>
                  
                    <div class="collapse navbar-collapse signin-form-custom mb-3 custom-table" id="navbarSupportedContent5">
                        <div class="form-group">
                            <div class="col-md-4">Số dư: {{ number_format($credit_total)}} vnd</div>
                            <div class="col-md-4">
                                <form action="{{ route('onekbuy.product.tra-gop-moi-ngay', Auth::guard('web')->user()->id)}}" method="post">
                                    @csrf
                                    <button type="button" data-toggle="modal" data-target="#modeltragopmobile" class="btn btn-primary bg-orange">Trả góp mỗi ngày</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modeltragopmobile" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Trả góp mỗi ngày</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <p>Nhập số tiền trả góp</p>
                                                    </div>
                                                    <div class="form-group">
                                                      <input type="number" min="1000" name="so_tien_tra_gop" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-primary">Xác nhận</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                               
                            </div>
                            <div class="col-md-4">
                                    @csrf
                                    <button data-toggle="modal" data-target="#modelId-vip-mb" type="button" class="btn btn-primary bg-orange float-right">Nâng cấp thành viên</button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modelId-vip-mb" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Đăng ký thành viên vip</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                       <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="card">
                                                                <form action="{{ route('onekbuy.order.updateVipMonth')}}" method="post" class="float-right">
                                                                    @csrf
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Thành viên Vip/tháng</h4>
                                                                        <p class="card-text">Thời gian: 1 tháng</p>
                                                                        <p class="card-text">Chi phí: 30.000 vnd/tháng</p>
                                                                        <p class="card-text">Mô tả: Trả góp với giá khuyến mãi</p>
                                                                        <input type="hidden" name="costs" id="" value="30000">
                                                                        <button type="submit" class="btn btn-primary">Đăng ký</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="card">
                                                                <form action="{{ route('onekbuy.order.updateVipYear')}}" method="post" class="float-right">
                                                                    @csrf
                                                                    <div class="card-body">
                                                                        <h4 class="card-title">Thành viên Vip/năm</h4>
                                                                        <p class="card-text">Thời gian: 1 năm</p>
                                                                        <p class="card-text">Chi phí: 300.000 vnd/năm</p>
                                                                        <p class="card-text">Mô tả: Trả góp với giá khuyến mãi</p>
                                                                        <input type="hidden" name="costs" id="" value="300000">
                                                                        <button type="submit" class="btn btn-primary">Đăng ký</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                       </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="row"> 
                            @if (Session::has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ Session::get('error')}}
                                </div>
                            @else
                                @include('errors.success')
                            @endif

                            @if (Session::has('success-history'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ Session::get('success-history')}}
                                </div>
                            @endif
                            @if (Session::has('error-history'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{ Session::get('error-history')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Sản phẩm</th>
                                        <th>Size</th>
                                        <th>Giá trị</th>
                                        <th>Số tiền đã trả góp</th>
                                        <th>Trạng thái</th>
                                        <th>Thời gian đặt lệnh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactionHistory as $item)
                                        <tr>
                                            <td>{{ $item->id}}</td>
                                            <td><a href="{{ route('onekbuy.product.product', ['slug' => $item->product->slug, 'id' => $item->product->id]) }}">{{ $item->product->name}}</a></td>
                                            <td>{{ $item->size }}</td>
                                            <td>
                                                {{ number_format($item->product->price)}} vnd
                                            </td>
                                            <td>{{ number_format($item->tien_tra_gop) }} vnd</td>
                                            <td>@if ($item->status == 0 )
                                                    <span class="text-danger">Đang trả góp</span>
                                                @else
                                                    <span class="text-success">Đã hoàn thành</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->created_at->format('H:i:s Y.m.d')}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Sản phẩm</th>
                                        <th>Size</th>
                                        <th>Giá trị</th>
                                        <th>Số tiền đã trả góp</th>
                                        <th>Trạng thái</th>
                                        <th>Thời gian đặt lệnh</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </nav>

                {{-- lich-su-dat-hang --}}
                <nav class="navbar">
                    <button class="navbar-toggler mb-3 signin-button-custom" type="button" data-toggle="collapse" data-target="#navbarSupportedContent7" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span>Lịch sử đặt hàng</span>
                    </button>
                  
                    <div class="collapse navbar-collapse signin-form-custom mb-3 custom-table" id="navbarSupportedContent7">
                        <div class="form-group">
                            <label for="">Số lượng đơn hàng : {{ $orders->count()}}</label>
                        </div>
                        @if (Session::has('success-order'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ Session::get('success-order')}}
                            </div>
                        @endif
                        <div class="form-group">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Lời nhắn</th>
                                        <th>Thời gian mua hàng</th>
                                        <th>Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $item)
                                        <tr>
                                            <td>#{{ $key+1}}</td>
                                            <td>1kbuy{{ $item->id}}</td>
                                            <td>{{ number_format($item->total) }}</td>
                                            <td>{{ $item->note }}</td>
                                            <td>{{ $item->created_at->format('Y-m-d H:i:s') }}</td>
                                            <td>
                                                <a  id="" class="btn btn-primary" href="#" data-toggle="modal" data-target="#modalmb-{{$item->id}}">Chi tiết</a>
                                                <a  id="" class="btn btn-danger" href="#" data-toggle="modal" data-target="#modalmb-delete{{$item->id}}">Xóa</a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="modalmb-delete{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Xóa đơn hàng</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                Bạn có chắc chắn muốn xóa đơn hàng này không?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                                <a class="btn btn-danger" href="{{ route('onekbuy.order.deleteOrder', $item->id)}}">Xóa</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal -->
                                                <div class="modal fade" id="modalmb-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Chi tiết đơn hàng 1kbuy{{ $item->id}}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Stt</th>
                                                                            <th>Tên sản phẩm</th>
                                                                            <th>Hình ảnh</th>
                                                                            <th>SKU</th>
                                                                            <th>Số lượng</th>
                                                                            <th>Giá</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                       @foreach ($item->product as $key => $product)
                                                                        <tr>
                                                                            <td>{{ $key+1}}</td>
                                                                            <td>{{ $product->name}}</td>
                                                                            <td><img style="width: 100px" src="{{ asset('upload/images/'. $product->image)}}" alt=""></td>
                                                                            <td>{{ $product->sku}}</td>
                                                                            <td>{{ $product->pivot->qty}}</td>
                                                                            <td>{{ number_format($product->promotion_price = 0?$product->price:$product->promotion_price) }} vnd</td>
                                                                        </tr>
                                                                       @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </nav>
                
                {{-- re_password  --}}
                <nav class="navbar">
                    <button class="navbar-toggler mb-3 signin-button-custom {{ session()->has('re_pass')?'active':'' }}" type="button" data-toggle="collapse" data-target="#navbarSupportedContent6" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span>Đổi mật khẩu</span>
                    </button>
                  
                    <div class="collapse navbar-collapse signin-form-custom mb-3 {{ session()->has('re_pass')?'show':'' }}" id="navbarSupportedContent6">
                        <p class="help is-danger" style="color:red;">{{ session()->get('error')}}</p>
                        @if (Session::has('success-password'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ Session::get('success-password')}}
                            </div>
                        @endif
                        <form class="form-reset-pass" method="post" action="{{ route('onekbuy.user.re_password')}}">
                            @csrf
                            <div class="form-group">
                                <label>Mật khẩu cũ</label>
                                <div class="input-group" id="show_hide_password">
                                  <input class="form-control" type="password" name="old_pass" value="{{ old('old_pass')}}">
                                  <div class="input-group-addon">
                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                  </div>
                                </div>
                                <p class="help is-danger" style="color:red;">{{ $errors->first('old_pass') }}</p>
                              </div>
                              <div class="form-group">
                                <label>Mật khẩu mới</label>
                                <div class="input-group" id="show_hide_password">
                                  <input class="form-control" type="password" name="new_pass" value="{{ old('new_pass')}}">
                                  <div class="input-group-addon">
                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                  </div>
                                </div>
                                <p class="help is-danger" style="color:red;">{{ $errors->first('new_pass') }}</p>
                              </div>
                              <div class="form-group">
                                <label>Xác nhận mật khẩu</label>
                                <div class="input-group" id="show_hide_password">
                                  <input class="form-control" type="password" name="cf_pass">
                                  <div class="input-group-addon">
                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                  </div>
                                </div>
                                <p class="help is-danger" style="color:red;">{{ $errors->first('cf_pass') }}</p>
                              </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>
                </nav>
            
            </div>
        </div>
    </div>
    
    
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
    $(document).ready(function(){
            $('.signin-button-custom').click(function() {
                $(".signin-button-custom").removeClass("active");
                $(".signin-form-custom").removeClass("show");
                $(this).addClass("active");
                $(this).addClass("show");
            });
        });
    
        function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        }
      
        function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        }
        $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
        })
</script>
<script type="text/javascript">
$(document).ready(function () {
    $("body").on("change",".js_location",function(e){
    e.preventDefault();
    let id =  $(event.target).val();
    let type = $(this).attr('data-type');
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: "{{route('onekbuy.user.info.getLocation')}}", //or you can use url: "company/"+id,
        type: 'GET',
        method: 'GET',
        data: {
            _token: token,
            id: id,
            type: type
        },
        success: function (response){
            console.log(response.data);
            if (response.data) {
                var html = '';
                var element = '';
                if (type == 'province') {
                    html = '<option value="">--- Mời bạn chọn huyện ---</option>';
                    element = '#district_option';        
                } 
                if (type == 'district') {
                    html = '<option value="">--- Mời bạn chọn xã ---</option>';
                    element = '#ward_option';     
                }
               
                $.each(response.data, function(index, value) {
                    html += '<option value="'+ value.id+'">'+ value._name +'</option>';
                })
                $(element).html(' ').append(html);
            }
        }
    });
        return false;
    });
});
</script>
{{-- load quan huyen mobile --}}
<script type="text/javascript">
    $(document).ready(function () {
        $("body").on("change",".js_location_mb",function(e){
        e.preventDefault();
        let id =  $(event.target).val();
        let type = $(this).attr('data-type');
        var token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url: "{{route('onekbuy.user.info.getLocation')}}", //or you can use url: "company/"+id,
            type: 'GET',
            method: 'GET',
            data: {
                _token: token,
                id: id,
                type: type
            },
            success: function (response){
                console.log(response.data);
                if (response.data) {
                    var html = '';
                    var element = '';
                    if (type == 'province') {
                        html = '<option value="">--- Mời bạn chọn huyện ---</option>';
                        element = '#district_option_mb';        
                    } 
                    if (type == 'district') {
                        html = '<option value="">--- Mời bạn chọn xã ---</option>';
                        element = '#ward_option_mb';     
                    }
                   
                    $.each(response.data, function(index, value) {
                        html += '<option value="'+ value.id+'">'+ value._name +'</option>';
                    })
                    $(element).html(' ').append(html);
                }
            }
        });
            return false;
        });
    });
    </script>
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if($('#show_hide_password input').attr("type") == "text"){
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass( "fa-eye-slash" );
                    $('#show_hide_password i').removeClass( "fa-eye" );
                }else if($('#show_hide_password input').attr("type") == "password"){
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass( "fa-eye-slash" );
                    $('#show_hide_password i').addClass( "fa-eye" );
                }
            });
        });
    </script>
    <script>
        $('#onchange_d_payment').on('change', function() {
            if(this.value == 'khac') {
                $('#d_payment').html('<input name="d_payment" type="text" class="form-control" placeholder="Nhập phương thức thanh toán khác">');
            } 
            if(this.value != 'khac') {
                $('#d_payment').html('');
            } 
          });
    
        $('#onchange_d_payment_mb').on('change', function() {
            if(this.value == 'khac') {
                $('#d_payment_mb').html('<input name="d_payment" type="text" class="form-control" placeholder="Nhập phương thức thanh toán khác">');
            } 
            if(this.value != 'khac') {
                $('#d_payment_mb').html('');
            } 
          });

          $('#onchange_r_payment').on('change', function() {
            if(this.value == 'khac') {
                $('#r_payment').html('<input name="r_payment" type="text" class="form-control" placeholder="Nhập phương thức thanh toán khác">');
            } 
            if(this.value != 'khac') {
                $('#r_payment').html('');
            } 
          });

          $('#onchange_r_payment_mb').on('change', function() {
            if(this.value == 'khac') {
                $('#r_payment_mb').html('<input name="r_payment" type="text" class="form-control" placeholder="Nhập phương thức thanh toán khác">');
            } 
            if(this.value != 'khac') {
                $('#r_payment_mb').html('');
            } 
          });
    </script>
@endsection