@extends('templates.admin.master')
@section('content')

<div class="content">                    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Ví tiền</h5>
                </div>
                <div class="card-body">
                    <h3 class="mb-2">Tài khoản hiện tại: {{ number_format($user->wallet->credit_total) }} VND</h3>
                    <a name="" class="btn btn-success" href="#">Nạp tiền</a>
                </div>

                <div class="table-stats order-table ov-h">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Stt</th>
                                <th>Email</th>
                                <th>Thời gian giao dịch</th>
                                <th>Số tiền</th>
                                <th>Chi tiết</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->depositrequest as $item)
                                <tr>
                                    <td scope="row">1</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td class="text-danger">{{$item->money}}</td>
                                    <td>{{$item->message}}</td>
                                    <td>
                                        @if($item->status == 1)
                                            <p class="btn btn-success">Thành công</p>
                                        @else
                                        <p class="btn btn-danger">Chưa xét duyệt</p>
                                        @endif    
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
