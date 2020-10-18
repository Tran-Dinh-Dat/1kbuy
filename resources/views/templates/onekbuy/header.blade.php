<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('header')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('asset/onekbuy/style/index.css')}}">
    <link rel="stylesheet" href="{{asset('asset/onekbuy/style/blog.css')}}">
    <link rel="stylesheet" href="{{asset('asset/onekbuy/style/product.css')}}">
    <link rel="stylesheet" href="{{asset('asset/onekbuy/style/post.css')}}">
    <link rel="stylesheet" href="{{asset('asset/onekbuy/style/review.css')}}">
    <link rel="stylesheet" href="{{asset('asset/onekbuy/style/style.css')}}">
    <link rel="stylesheet" href="{{asset('asset/onekbuy/style/sidenav.css')}}">
    <link rel="stylesheet" href="{{asset('asset/onekbuy/style/shop.css')}}">
    <link rel="stylesheet" href="{{asset('asset/onekbuy/style/intro.css')}}">
    <link rel="stylesheet" href="{{asset('asset/onekbuy/style/sign-in.css')}}">
    <link rel="stylesheet" href="{{asset('asset/onekbuy/style/cart.css')}}">
    <title>Mua sắm trả góp 1.000 đồng mỗi ngày</title>
    <link rel="shortcut icon" type="image/png" href="/asset/onekbuy/image/favico.png" />
    @yield('css')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" as="style" onload="this.onload=null;this.rel='stylesheet'" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
      @media only screen and (min-width: 576px) {
        .sticky {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 100;
        padding: 0px 0px 20px 20px; 
        }
      }
      @media only screen and (min-width: 991px) {
        .sticky {
        padding-left: 15%;
        }
      }
      .logo-custom {
         display: none;
      }
      .sticky .logo-custom {
        display: block;
      }
      </style>
</head>
<body>
    <header>
        <div class="top-bar shadow rounded">
          <div class="container">
            <div class="row">
              <div class="col-12">
                  <div class="dropdown float-right">
                    @if (Auth::check())
                      <a href="" class="sign-in dropdown-toggle" data-toggle="dropdown" style="color:black">
                        <img src={{ Auth::user()->profile->avatar ? asset('./upload/images/'.Auth::user()->profile->avatar) : asset('./upload/images/avatar.png')}} alt="" width="30px" style="border-radius:50px;margin-top:2px">
                        <strong>{{Auth::user()->name}}! </strong> 
                        @php
                            $user = Auth::guard('web')->user();
                            $current = \Carbon\Carbon::now();
                            $str = explode('-', $user->vip_date_expired);
                            $expired = \Carbon\Carbon::create($str[0], $str[1], $str[2]);
                        @endphp
                        @if ($user->vip == 1)
                          <img width="30px" src="{{ asset('upload/images/vip_user.png')}}" alt="">
                          <span style="font-style: italic; font-size: 12px">(còn {{  $current->diffInDays($expired) + 1 }} ngày)</span>
                        @endif
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href={{route('onekbuy.user.info')}}><i class="fas fa-sign-out-alt"></i>Thông tin đăng nhập</a>
                        <a class="dropdown-item" href={{route('auth.index.logout')}}><i class="fas fa-key"></i> Đăng xuất</a>
                      </div>
                    @endif
                  </div>
                  <div class="dropdown float-right">
                    @if (Auth::guest())
                        <a class="sign-in" href={{route('auth.index.login')}}><i class="fas fa-sign-out-alt"></i><strong>Đăng nhập | Đăng kí</strong></a>
                    @endif
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-7">
                        <div class="img-custom">
                          <a href={{ route('onekbuy.index.index') }}>
                          <img src="{{asset('./upload/images/'.$information->logo)}}" alt="">
                          </a>
                        </div>
                      <h5 class="img-custom">{{ $information->slogan}}</h5>
                    </div>
                    <div class="col-10 col-md-5 d-flex align-items-center d-flex justify-content-end">
                      <form action="{{route('onekbuy.product.search')}}" method="get">
                        <div class="input-group md-form form-sm form-2 pl-0">
                            <input class="form-control my-0 py-1 amber-border" type="text" placeholder="Search Product" aria-label="Search" name="name" required value="{{ request()->name}}"/>
                            <div class="input-group-append">
                              <button class="input-group-text amber lighten-3 d-flex justify-content-center" id="basic-text1"><i class="fas fa-search text-grey"
                              aria-hidden="true"></i></button>
                            </div> 
                        </div>
                      </form>
                      <div class="lzd-nav-cart  lzd-nav-cart-mb " id="lzd-nav-cart-mb">
                        <a href="{{ route('onekbuy.cart.index')}}">
                          <span class="cart-icon"></span>
                            @if (Session::has('cart'))
                              <span class="cart-num" id="topActionCartNumber" style="display: block;">{{Session::has('cart') <=9 ? 0:''}}{{count(Session::get('cart'))}}
                              </span>
                            @endif
                        </a>
                      </div>
                    </div>
                </div>
            </div>  
        </div>
        <div class="header-bottom d-flex justify-content-between" id="myHeader">
          <div class="logo-custom">
            <a href="/">
            <img width="80px" src="{{ asset('upload/images/'.$information->logo)}}" alt="">
            <span style="color: #c37100; font-weight: 600">{{ $information->slogan}}</span>
            </a>
          </div>
          <div class="sidenav-mobi d-md-none">
            <div id="mySidenav" class="sidenav">
              <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
              @foreach ($categoryProduct as $item)
                <a href="{{ route('onekbuy.product.index', $item->slug)}}">{{ $item->name}}</a>
              @endforeach
            </div>
            <p class="pt-2" style="font-size:25px;cursor:pointer;margin-left: 15px;" onclick="openNav()">&#9776; All Products</p>
          </div>
          <div class="navbar-main">
            <nav class="navbar navbar-expand-md navbar-light d-flex justify-content-end">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto cart-header-menu-ul">
                      <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('onekbuy.index.index') }}">{{ $information->home}} <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item @if(request()->is('blog*') or request()->is('search-blog*'))
                        active
                        @else
                        @endif">
                        <a class="nav-link" href="{{ route('onekbuy.post.index') }}">{{ $information->blog}}</a>
                      </li>
                      <li class="nav-item @if (request()->is('shop*') or request()->is('product-category*') or request()->is('search-product*'))
                          active 
                          @else
                      @endif">
                        <a class="nav-link" href="{{ route('onekbuy.product.index', 'all') }}">{{ $information->shop}}</a>
                      </li>
                      <li class="nav-item {{ request()->is('notification*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('onekbuy.notification.index') }}">{{ $information->notify}}</a>  
                      </li>
                      <li  id="cart-header-menu-show" class="active nav-item cart-header-menu {{ request()->is('notification*') ? 'active' : '' }}">
                        {{-- <div class="lzd-nav-cart ">
                        <a href="{{ route('onekbuy.cart.index')}}">
                          <span class="cart-icon"></span>
                            @if (Session::has('cart'))
                              <span class="cart-num" id="topActionCartNumber" style="display: block;">{{Session::has('cart') <=9 ? 0:''}}{{count(Session::get('cart'))}}
                              </span>
                            @endif
                        </a>
                      </div> --}}
                      </li>
                    </ul>
                  </div>
              </nav>
            </div>
          </div>
        {{-- <div id="myHeader">
          <div class="img-custom">
            <a href={{ route('onekbuy.index.index') }}>
            <img src="{{asset('./upload/images/'.$information->logo)}}" alt="">
            </a>
          </div>
          <h5 class="img-custom">Hàng Liền Tay- Tiền Về Ngay!</h5>
        </div> --}}
    </header>
    <script>
      window.onscroll = function() {myFunction()};
      var header = document.getElementById("myHeader");
      var sticky = header.offsetTop;
      function myFunction() {
        if (window.pageYOffset > sticky) {
          header.classList.add("sticky");
        } else {
          header.classList.remove("sticky");
        }
      }
      </script>

