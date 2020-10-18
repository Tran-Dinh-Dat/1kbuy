<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="stylesheet" href="{{ asset('asset/admin/assets/css/profile.css')}}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{asset('asset/admin/assets/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset("asset/admin/assets/css/style.css")}}">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

   <style>
    #weatherWidget .currentDesc {
        color: #ffffff!important;
    }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
             height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }

    </style>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="{{ route('admin.index')}}"><i class="menu-icon fa fa-home"></i>Trang chủ </a>
                    </li>
      
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-money"></i>Hoàn tiền <strong style="color:red">({{$count_refund -> count()}})</strong></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-money"></i><a href="{{ route('admin.refund.index')}}">Các yêu cầu hoàn tiền</a></li>
                            <li><i class="menu-icon fa fa-money"></i><a href="{{ route('admin.refund.history')}}">Lịch sử hoàn tiền</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-undo"></i>Nạp tiền <strong style="color:red">({{$count_depositrequest -> count()}})</strong></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-money"></i><a href="{{ route('admin.depositrequest.index')}}">Các yêu cầu nạp tiền</a></li>
                            <li><i class="menu-icon fa fa-money"></i><a href="{{ route('admin.depositrequest.history')}}">Lịch sử nạp tiền</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-product-hunt"></i>Sản phẩm <strong style="color:red">({{$count_products -> count()}})</strong></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="{{ route('admin.product.index')}}">Tất cả sản phẩm <strong style="color:red">({{$count_products -> count()}})</strong></a></li>
                            <li><i class="menu-icon fa fa-th"></i><a href="{{ route('admin.product.create')}}">Thêm sản phẩm</a></li>
                            <li><i class="menu-icon fa fa-th"></i><a href="{{ route('admin.product.viewimport')}}">Nhập, xuất dữ liệu từ file Excel</a></li>
                            <li><i class="menu-icon fa fa-th"></i><a href="{{ route('admin.product.viewexport', ['month' => date("m"), 'year' => date("Y")])}}">Export lịch sử đặt lệnh</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-product-hunt"></i>Quản lý đơn hàng <strong style="color:red">({{$count_order -> count()}})</strong></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="{{ route('admin.order.index')}}">Tất cả đơn hàng<strong style="color:red">({{$count_order -> count()}})</strong></a></li>
                            <li><i class="menu-icon fa fa-th"></i><a href="{{ route('admin.order.viewexport')}}">Export đơn hàng</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-product-hunt"></i>Đơn hàng trả góp<strong style="color:red">({{$count_order_products -> count()}})</strong></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="{{ route('admin.installment.index')}}">Tất cả đơn hàng trả góp<strong style="color:red">({{$count_order_products -> count()}})</strong></a></li>
                            <li><i class="menu-icon fa fa-th"></i><a href="{{ route('admin.installment.viewexport')}}">Export đơn hàng trả góp</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Danh mục sản phẩm <strong style="color:red">({{$count_categories -> count()}})</strong></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-th"></i><a href="{{ route('admin.category.index')}}">Tất cả danh mục <strong style="color:red">({{$count_categories -> count()}})</strong></a></li>
                            <li><i class="menu-icon fa fa-th"></i><a href="{{ route('admin.category.create')}}">Thêm danh mục</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-newspaper-o"></i>Tin tức <strong style="color:red">({{$count_post -> count()}})</strong></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-newspaper-o"></i><a href="{{ route('admin.post.index')}}">Tất cả tin tức <strong style="color:red">({{$count_post -> count()}})</strong></a></li>
                            <li><i class="menu-icon fa fa-newspaper-o"></i><a href="{{ route('admin.post.create')}}">Thêm tin tức</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bell"></i>Thông báo <strong style="color:red">({{$count_notification->count()}})</strong></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-bell"></i><a href="{{ route('admin.notification.index')}}">Tất cả thông báo <strong style="color:red">({{$count_notification->count()}})</strong></a></li>
                            <li><i class="menu-icon fa fa-bell"></i><a href="{{ route('admin.notification.create')}}">Thêm thông báo</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user-o"></i>Quản lý người dùng<strong style="color:red"> ({{$count_user->count()}})</strong></a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-user-o"></i><a href="{{ route('admin.users.index')}}">Tất cả người dùng</a></li>
                            <li><i class="menu-icon fa fa-info-circle"></i><a href="{{ route('admin.users.viewexport')}}">Xuất thông tin người dùng</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-info-circle"></i>Thông tin</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-info-circle"></i><a href="{{ route('admin.informations.edit',$information->id)}}">Cập nhập thông tin</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-sort"></i>Slide và banner</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-info-circle"></i><a href="{{ route('admin.slide.index')}}">Tất cả slide</a></li>
                            <li><i class="menu-icon fa fa-info-circle"></i><a href="{{ route('admin.banner.index')}}">Tất cả banner</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-paperclip"></i>Nền tảng thanh toán</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-info-circle"></i><a href="{{ route('admin.payment.index')}}">Tất cả nền tảng thanh toán</a></li>
                            <li><i class="menu-icon fa fa-info-circle"></i><a href="{{ route('admin.payment.create')}}">Thêm nền tảng thanh toán</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->