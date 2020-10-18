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
                        <strong class="card-title">Quản lý lịch sử đặt lệnh tháng {{ $month }} năm {{ $year }}</strong>
                    </div>
                    @php
                        $i = 0;
                        $fdate = new DateTime('now');
                        $ldate = new DateTime('now');
                        $fisrt_month_name = date("F", mktime(0, 0, 0, $month, 10));
                        $fdate->modify('first day of '.$fisrt_month_name);
                        $ldate->modify('last day of '.$fisrt_month_name);
                        $firstdate = $fdate->format($year.'-m-d'). ' 00:00:00';
                        $lastdate = $ldate->format($year.'-m-d'). ' 00:00:00';
                    @endphp
                    <div class="">
                        <p class="mb-0 text-white" id="success"></p>
                    </div>
                    <a href="{{ route('admin.product.export', ['yesterday' => $firstdate, 'today' => $lastdate]) }}" class="btn btn-info">Export toàn bộ đặt lệnh tháng {{ $month }} năm {{ $year }}</a>
                    @include('errors.error')
                    <div class="table-stats order-table ov-h">
                        <table class="table table-tr-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ngày</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php

                                $firstdate = $fdate->format('Y-m-d');
                                $lastdate = $ldate->format('Y-m-d');
                                if($month == date("m")){
                                    $lastdate = date('Y-m-d');
                                }
                                
                                $fmonth = $fdate->format('m');
                                $lmonth = date("m");
                                $date = strtotime($firstdate . ' 12:00:00');
                                $a = -17;
                                $b = -41;
                                $today = date("Y-m-d G:i:s", strtotime($a.' hours',$date));
                                $yesterday = date("Y-m-d G:i:s",strtotime($b.' hours',$date));
                            @endphp
                            @while ($today != $lastdate.' 19:00:00')
                                @php
                                    $i++;   
                                    $a += 24;
                                    $b += 24;
                                    $today = date("Y-m-d G:i:s", strtotime($a.' hours',$date));
                                    $yesterday = date("Y-m-d G:i:s",strtotime($b.' hours',$date));
                                    $dtoday = date("G:i d-m-Y", strtotime($a.' hours',$date));
                                    $dyesterday = date("G:i d-m-Y",strtotime($b.' hours',$date));
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $dyesterday }} đến {{ $dtoday }}</td>
                                    <td><a href="{{ route('admin.product.export', ['yesterday' => $yesterday, 'today' => $today]) }}" class="btn btn-info">Export</a></td>
                                </tr>
                            @endwhile
                            </tbody>
                        </table>

                    </div> 
                </div>
            </div>
        </div>
<nav aria-label="Page navigation example" style="float:right">
  <ul class="pagination">
    @for($i = $lmonth+1; $i <= 12; $i ++)
    <li class="page-item"><a class="page-link" href="{{ route('admin.product.viewexport', ['month' => $i, 'year' => date('Y')-1])}}">{{ $i }} - {{ date('Y')-1 }}</a></li>
    @endfor
    @for($i = 1; $i <= $lmonth; $i ++)
    <li class="page-item"><a class="page-link" href="{{ route('admin.product.viewexport', ['month' => $i, 'year' => date("Y")])}}">{{ $i }} - {{ date('Y') }}</a></li>
    @endfor
  </ul>
</nav>
    </div><!-- .animated -->
</div>
<div class="clearfix"></div>

@endsection