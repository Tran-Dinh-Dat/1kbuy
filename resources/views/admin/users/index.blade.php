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
                            <li><a href="#" class="active">User</a></li>
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
                        <strong class="card-title">Quản lý user</strong>
                    </div>
                    <div class="card-header">
                        <div class="search-container float-right row">
                            <form action="{{ route('admin.users.index')}}" >
                                <input type="text" placeholder="Tìm theo email..." name="search" class="form-control d-inline" style="width: 200px;"  value="{{ request()->search}}">
                                <button type="submit" class="btn btn-warning text-light"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="row">
                            <a class="btn btn-success" href="{{ route('admin.users.viewexport') }}">Xuất excel</a>
                        </div>
                    </div>
                    
                    <div class="">
                        <p class="mb-0 text-white" id="success"></p>
                        @include('errors.error')
                    </div>
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>Stt</th>
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th>VIP</th>
                                    <th>Tình trạng</th>
                                    <th>Ví tiền (VND)</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $item)
                                    <tr id="tableUser{{$item->id}}">
                                        <td>#{{ $key+1 }} </td>
                                        <td><a href="{{ route('admin.profile.index', $item->id)}}">{{ $item->name}}</a> </td>
                                        <td>
                                            <a href="" data-toggle="modal" data-target="#modelIdVip_date{{$item->id}}"><span class="product">{{ $item->email}}</span></a>
                                            <!-- Button trigger modal -->
                                            
                                            <!-- Modal -->
                                            @if ($item->vip == 1)
                                            <div class="modal fade" id="modelIdVip_date{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Chi tiết gói vip</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Gói Vip</th>
                                                                        <th>Ngày nâng cấp vip</th>
                                                                        <th>Ngày hết hạn</th>
                                                                        <th>Thời gian hết hạn</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                      @php
                                                                      if ($item->vip == 1) {
                                                                        $current = \Carbon\Carbon::now();
                                                                        $str = explode('-', $item->vip_date_expired);
                                                                        $expired = \Carbon\Carbon::create($str[0], $str[1], $str[2]);
                                                                      }
                                                                      @endphp   
                                                                        <td scope="row">{{ $item->vip_package}}</td>
                                                                        <td scope="row">{{ $item->vip_date_create }}</td>
                                                                        <td scope="row">{{ $item->vip_date_expired }}</td>
                                                                        <td>
                                                                            @if ($item->vip == 1)
                                                                                còn {{  $current->diffInDays($expired) + 1 }} ngày
                                                                            @else
                                                                                Hết hạn
                                                                            @endif    
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                           
                                        </td>
                                        <td>
                                            @if ($item->vip == 1)
                                                <i class="fa fa-check text-success"></i>
                                            @else
                                                <i class="fa fa-close text-danger"></i>
                                            @endif    
                                        </td>
                                        <td id="activeUser-{{ $item->id }}"> 
                                            @if ($item->active == 1)
                                              <a href="javascript:void(0)" onclick="getActive({{$item->id}})" style="cursor: pointer"><i class="fa fa-check text-success"></i> </a>
                                            @else
                                              <a href="javascript:void(0)" onclick="getActive({{$item->id}})" style="cursor: pointer"><i class="fa fa-close text-danger"></i></a>
                                            @endif
                                          </td>
                                        <td>
                                            <a href="{{ route('admin.wallet.index', $item->id)}}">{{ number_format($item->wallet->credit_total)}} </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.users.vipactive', $item->id)}}" class="btn btn-warning text-light">Xác nhận</a>
                                            <a href="{{ route('admin.users.edit', $item->id)}}" class="btn btn-info">Sửa</a>
                                            <a href="" data-toggle="modal" data-target="#modelId{{$item->id}}" class="btn btn-danger">Xóa</a>
                                            <!-- Button trigger modal -->
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="modelId{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Bạn có châc chắn xóa tài khoản này không?</h5>
                                                        </div>
                                                        
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                            <a href="{{ route('admin.users.destroy', $item->id)}}" class="btn btn-danger deleteUser" id="user{{$item->id}}" data-id="{{$item->id}}" data-dismiss="modal">Xóa</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
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
         url: "{{route('admin.users.active')}}",
         type: 'GET',
         cache: false,
         data: {
               id: id,
           },
         success: function(data){
           console.log('success')
           $('#activeUser-'+id).html(data);
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
    <script src="{{ asset('asset/admin/assets/js/adminJs/userJs.js')}}"></script>
@endsection