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
                            <li><a href="#" class="active">Hoàn tiền</a></li>
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
                        <strong class="card-title">Lịch sử hoàn tiền</strong>
                        <div class="search-container float-right">
                            <form action="{{ route('admin.refund.history')}}">
                                @csrf
                              <input type="text" placeholder="Tìm kiếm theo email.." name="search" class="form-control d-inline" style="width: 200px;"  value="{{ request()->search}}">
                              <button type="submit" class="btn btn-warning text-light"><i class="fa fa-search"></i></button>
                            </form>
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
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Phương thức</th>
                                    <th>Chủ tài khoản</th>
                                    <th>Số tài khoản</th>
                                    <th>Giá trị hoàn tiền</th>
                                    <th class="text-danger font-weight-bold">Thời gian yêu cầu</th>
                                    <th>Trạng thái</th>
                                    <th class="text-danger font-weight-bold">Thời gian hoàn tiền</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($refund as $key => $item)
                                    <tr id="tableRufund{{$item->id}}">
                                        <td>#{{ $key+1}}</td>
                                        <td>{{ $item->name}}</td>
                                        <td><a href="">{{ $item->email}}</a> </td>
                                        <td>{{ $item->payment}}</td>
                                        <td>{{ $item->account_holder}}</td>
                                        <td>{{ $item->account_number}}</td>
                                        <td><span class="product">{{ number_format($item->refund_value)}} VND</span> </td>
                                        <td><p class="text-danger">{{ $item->created_at->format('d/m/Y H:i:s') }}</p></td>
                                        <td id="active-{{ $item->id }}"> 
                                            @if ($item->status == 1)
                                              <span class="badge badge-complete">Chấp nhận</span>
                                            @else
                                              <a href="javascript:void(0)" onclick="getActive({{$item->id}})" style="cursor: pointer"><span class="badge badge-danger">Chưa xác nhận</span></a>
                                            @endif
                                        </td>
                                        <td><p class="text-danger">{{ $item->updated_at->format('d/m/Y H:i:s') }}</p></td>
                                        
                                        <td>
                                            <a href="" data-toggle="modal" data-target="#modelId{{$item->id}}" class="btn btn-danger">Xóa</a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="modelId{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Bạn có châc chắn xóa yêu cầu hoàn tiền này không?</h5>
                                                        </div>
                                                        
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary deleteRefund" data-dismiss="modal">Đóng</button>
                                                            <a href="{{ route('admin.refund.destroy', $item->id)}}" class="btn btn-danger deleteRefund" id="deleteRefund{{$item->id}}" data-id="{{$item->id}}" data-dismiss="modal">Xóa</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $refund->links() }}
                    </div> <!-- /.table-stats -->
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div>
<div class="clearfix"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    function getActive(id){
        $.ajax({
          url: "{{route('admin.refund.active')}}",
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
    <script src="{{ asset('asset/admin/assets/js/adminJs/refund.js')}}"></script>
@endsection