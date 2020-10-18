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
                    <div class="card-header">
                        <div class="search-container float-right row">
                            <form action="{{ route('admin.product.index')}}" >
                                <input type="text" placeholder="Tên sp, danh mục, sku" name="search" class="form-control d-inline" style="width: 200px;"  value="{{ request()->search}}">
                                <button type="submit" class="btn btn-warning text-light"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="row">
                            <a href="{{ route('admin.product.create')}}" class="btn btn-success">Thêm</a>
                            <a href="{{ route('admin.product.viewexport', ['month' => date("m"), 'year' => date("Y")])}}" class="btn btn-info m-auto">Export lịch sử đặt lệnh</a>
                        </div>
                    </div>
                    <div class="">
                        <p class="mb-0 text-white" id="success"></p>
                    </div>
                    @include('errors.error')
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>Stt</th>
                                    <th>Ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Sku</th>
                                    <th>Danh mục sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Lịch sử đặt lệnh</th>
                                    <th>Trạng thái</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $item)
                                    <tr id="tableId{{$item->id}}">
                                        <td>#{{ $key+1 }} </td>
                                        <td><img src="{{ asset('upload/images/'. $item->image)}}" width="100px" height="100px" style="object-fit: cover"  alt=""></td>
                                        <td style="width: 400px"><a href="{{ route('admin.product.detail', $item->id) }}">{{ $item->name}}</a> </td>
                                        <td>{{ $item->sku}}</td>
                                        <td>{{ $item->category->name}}</td>
                                        <td><p>{{ number_format($item->price)}} VND</p></td>
                                        <td>Số người dùng đặt lệnh ({{$item->user->count()}})</td>
                                        <td id="active-{{ $item->id }}"> 
                                            @if ($item->active == 1)
                                              <a href="javascript:void(0)" onclick="getActive({{$item->id}})" style="cursor: pointer"><i class="fa fa-check text-success"></i> </a>
                                            @else
                                              <a href="javascript:void(0)" onclick="getActive({{$item->id}})" style="cursor: pointer"><i class="fa fa-close text-danger"></i></a>
                                            @endif
                                          </td>
                                        
                                        <td>
                                            <a href="{{ route('admin.product.edit', $item->id)}}" class="btn btn-info">Sửa</a>
                                            <a href="" data-toggle="modal" data-target="#modelId{{$item->id}}" class="btn btn-danger">Xóa</a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="modelId{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Bạn có châc chắn xóa sản phẩm này không?</h5>
                                                        </div>
                                                        
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                            <a  href="{{ route('admin.product.destroy',$item->id) }}" class="btn btn-danger deleteProduct" id="deleteProduct{{$item->id}}" data-id="{{ $item->id }}" data-dismiss="modal">Xóa</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div> <!-- /.table-stats -->
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div>
<div class="clearfix"></div>
<script>
     function getActive(id){
        $.ajax({
          url: "{{route('admin.product.active')}}",
          type: 'GET',
          cache: false,
          data: {
                id: id,
            },
          success: function(data){
            console.log('success')
            $('#active-'+id).html(data);
          },
          error: function() {
           alert("Có lỗi");
         }
       });
        return false;
      }
</script>

@endsection
@section('javascript')
    <script src="{{ asset('asset/admin/assets/js/adminJs/product.js')}}"></script>
@endsection