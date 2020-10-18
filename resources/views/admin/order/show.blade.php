@extends('templates.admin.master')
@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Trang chủ</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Trang chủ</a></li>
                            <li><a href="#" class="active">Sản phẩm</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <strong class="card-title">Quản lý sản phẩm</strong>
                    </div>

                    <div class="">
                        <p class="mb-0 text-white" id="success"></p>
                    </div>
                    @include('errors.error')
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên khách hàng</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Lời nhắn</th>
                                    <th>Trạng thái</th>
                                    <th>Thời gian đặt hàng</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr id="tableId{{$orders->id}}">
                                        <td>#{{ $orders->id }} </td>
                                        <td><a href="">{{ $orders->name}}</a></td>
                                        <td>{{ $orders->email}}</a></td>
                                        <td>{{ $orders->phone_number}}</a></td>
                                        <td>{{ $orders->note}}</td>
                                        <td> 
                                            @if ($orders->payment == 1)
                                                <p class="text-success">Đã thanh toán</p>
                                            @else
                                              <p class="text-danger">Chưa thanh toán</p>
                                            @endif
                                        </td>
                                        <td>{{ $orders->created_at}}</td>
                                        
                                        <td>
                                            <a href="" data-toggle="modal" data-target="#modelId{{$orders->id}}" class="btn btn-danger">Xóa</a>
                                            <!-- Modal delete-->
                                            <div class="modal fade" id="modelId{{$orders->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog text-left" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Bạn có châc chắn xóa không?</h5>
                                                        </div>

                                                        <div class="modal-body">
                                                            <h5 class="modal-title">Xóa đơn hàng và chi tiết đơn hàng</h5>
                                                        </div>
                                                        
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                            <form role="form" action="{{ route('admin.order.destroy',$orders->id) }}" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger deleteOrder"><i class="fa fa-times"></i> Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div> <!-- /.table-stats -->

                </div>
            </div>
            <div class="col-lg-1">
            </div>
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <strong class="card-title">Thông tin sản phẩm</strong>
                    </div>

                    <div class="">
                        <p class="mb-0 text-white" id="success"></p>
                    </div>
                    @include('errors.error')
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Hình ảnh</th>
                                    <th>Sku</th>
                                    <th>Số lượng</th>
                                    <th>Size</th>
                                    <th>Giá</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($orders->product as $item)
                                    <tr id="{{$item->id}}">
                                        <td>{{ $item->id }} </td>
                                        <td>{{ $item->name }} </td>
                                        <td><img src="{{ asset('upload/images/'. $item->image)}}" width="100px" height="100px" /></td>
                                        <td>{{ $item->sku }} </td>
                                        <td>{{ $item->pivot->qty }} </td>
                                        <td>{{ $item->pivot->size }} </td>
                                        <td>
                                            {{ number_format($item->price) }} vnđ
                                        </td>
                                    </tr>
                                @endforeach
                                    <tr>
                                        <td class="text-right" colspan="5"><strong>Tổng tiền: </strong></td>
                                        <td class="text-right">{{ number_format($orders->total)}} VNĐ</td>
                                    </tr>
                            </tbody>
                        </table>
                    </div> <!-- /.table-stats -->
                    
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div>
<div class="clearfix"></div>


@endsection
@section('javascript')
    <script src="{{ asset('asset/admin/assets/js/adminJs/product.js')}}"></script>
@endsection