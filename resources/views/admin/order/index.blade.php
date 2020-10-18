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
                            <li><a href="#" class="active">Khách hàng</a></li>
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
                        <strong class="card-title">Quản lý đơn hàng</strong>
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
                                    <th>Tổng tiền</th>
                                    <th>Lời nhắn</th>
                                    <th>Trạng thái</th>
                                    <th>Thời gian đặt hàng</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $key => $item)
                                    <tr id="tableIdOrder{{ $item->id}}">
                                        <td>#{{ $key+1 }} </td>
                                        <td><a href="">{{ $item->name}}</a></td>
                                        <td>{{ $item->email}}</a></td>
                                        <td>{{ $item->phone_number}}</a></td>
                                        <td>{{ number_format($item->total)}} VNĐ</td>
                                        <td>{{ $item->note}}</td>
                                        <td id="order_result-{{ $item->id }}"> 
                                            @if ($item->payment == 1)
                                                <p class="text-success">Đã thanh toán</p>
                                            @else
                                              <a href="{{ route('admin.order.active', $item->id) }}" style="cursor: pointer"><p class="text-danger">Chưa thanh toán</p></a>
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at}}</td>
                                        <td>
                                            <a href="{{ route('admin.order.show', $item->id) }}" class="btn btn-info">Xem đơn hàng</a>
                                            <a href="" data-toggle="modal" data-target="#modelId{{$item->id}}" class="btn btn-danger">Xóa</a>
                                            <!-- Modal delete-->
                                            <div class="modal fade" id="modelId{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
                                                            <a href="{{ route('admin.order.destroy', $item->id)}}" class="btn btn-danger deleteOrder" data-id="{{ $item->id }}" data-dismiss="modal">Xóa</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $orders->links() }} --}}
                    </div> <!-- /.table-stats -->
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div>
<div class="clearfix"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
    $("body").on("click",".deleteOrder",function(e){

    e.preventDefault();
    var id = $(this).data("id");
    // var id = $(this).attr('data-id');
    var token = $("meta[name='csrf-token']").attr("content");
    var url = e.target;

    $.ajax(
        {
            url: url.href, //or you can use url: "company/"+id,
            type: 'DELETE',
            method: 'DELETE',
            data: {
            _token: token,
            id: id
        },
        success: function (response){
            console.log('Xóa thành công!');
            // $('#deletePost' + id).modal('hide');
            $('#tableIdOrder'+id).remove();
            $( "#success" ).addClass( "success bg-success p-3" );
            $("#success").html(response.message);
        }
        });
        return false;
    });
});
</script>
@endsection
