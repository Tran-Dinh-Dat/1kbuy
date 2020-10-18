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
                            <li><a href="#" class="active">Người dùng</a></li>
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
                        <strong class="card-title">Quản lý xuất dữ liệu user 1 năm</strong>
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
                                    <th>Ngày</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 0;
                                $fdate = new DateTime('now');
                                $fisrt_month_name = date("F", mktime(0, 0, 0, date('m'), 10));
                                $fdate->modify('first day of '.$fisrt_month_name);

                                $firstdate = $fdate->format('Y-m-d');
                                
                                $date = strtotime($firstdate . ' 00:00:00');
                                $a = 2;
                                $today = date("Y-m-d G:i:s", strtotime($a.' month',$date));
                            @endphp
                            @while ($i != 12)
                                @php
                                    $i++;   
                                    $a -= 1;
                                    $today = date("Y-m-d G:i:s", strtotime($a.' month',$date));
                                    $yesterday = date("Y-m-d G:i:s",strtotime(($a-1).' month',$date));
                                    $dtoday = date("m-Y", strtotime($a.' month',$date));
                                    $dyesterday = date("m-Y",strtotime(($a-1).' month',$date));
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>Tháng {{ $dyesterday }} đến tháng {{ $dtoday }}</td>
                                    <td><a href="{{ route('admin.users.export', ['yesterday' => $yesterday, 'today' => $today]) }}" class="btn btn-info">Export</a></td>
                                </tr>
                            @endwhile
                            </tbody>
                        </table>

                    </div> 
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div>
<div class="clearfix"></div>

@endsection