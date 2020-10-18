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
                                    <th>Ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Danh mục sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Trạng thái</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr id="tableId{{$product->id}}">
                                        <td>#{{ $product->id }} </td>
                                        <td><img src="{{ asset('upload/images/'. $product->image)}}" width="100px"  alt=""></td>
                                        <td style="width: 400px"><a href="">{{ $product->name}}</a> </td>
                                        <td>{{ $product->category->name}}</td>
                                        <td><p>{{ number_format($product->price)}} VND</p></td>
                                        <td id="active-{{ $product->id }}"> 
                                            @if ($product->active == 1)
                                              <a href="javascript:void(0)" onclick="getActive({{$product->id}})" style="cursor: pointer"><i class="fa fa-check text-success"></i> </a>
                                            @else
                                              <a href="javascript:void(0)" onclick="getActive({{$product->id}})" style="cursor: pointer"><i class="fa fa-close text-danger"></i></a>
                                            @endif
                                          </td>
                                        
                                        <td>
                                            <a href="{{ route('admin.product.edit', $product->id)}}" class="btn btn-info">Sửa</a>
                                            <a href="" data-toggle="modal" data-target="#modelId{{$product->id}}" class="btn btn-danger">Xóa</a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="modelId{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Bạn có châc chắn xóa tài khoản này không?</h5>
                                                        </div>
                                                        
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                            <a  href="{{ route('admin.product.destroy',$product->id) }}" class="btn btn-danger deleteProduct" id="deleteProduct{{$product->id}}" data-id="{{ $product->id }}" data-dismiss="modal">Xóa</a>
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
                        <strong class="card-title">Quản lý người dùng đã đặt lệnh</strong>
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
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    <th>Số lần đặt</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($productuser as $item)
                                    <tr id="{{$item->id}}">
                                        <td>{{ $item->id }} </td>
                                        <td>{{ $item->user->name }} </td>
                                        <td>{{ $item->user->email }} </td>
                                        <td>{{ $item->user->profile->address }} </td>
                                        <td>{{ $item->user->profile->phone_number }} </td>
                                        <td>{{ $item->count }} </td>
                                    </tr>
                                @endforeach
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