@extends('templates.onekbuy.master')
@section('content')
<div class="content">
    <div class="shop-background">
        <div class="container container-shop">
            <div class="row row-intro">
                <div class="col-12 col-md-8 col-xl-9 question-left ">
                    <div class="row-question-left">
                        <div class="entry-content">
                            <p class="text-center has-huge-font-size"><strong><span style="color:#0800a3"
                                        class="has-inline-color">{{ $post->title }}</span></strong></p>
                            <p style="font-size:18px">{!! $post->content !!}</p>
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                </div>
                @include('templates.onekbuy.post-bar')
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<link rel="stylesheet" href="/asset/onekbuy/style/cauhoi.css">

@endsection
@section('js')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        }
      
        function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        }
        $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
        })
      </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endsection
@section('header')
    <title>{{ $post->title }} Mua sắm trả góp 1.000 đồng mỗi ngày</title>
    <meta name="keywords" content="1kbuy, one k buy, 1k buy" />
    <meta name="news_keywords" content="1kbuy, one k buy, 1k buy" />
    <meta name="description" content="⭐Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn. ⭐ Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />
    <link rel="canonical" href="{{ route('onekbuy.post.info', $post->slug) }}" />
    <!-- Meta for Google -->
    <meta property="og:title" itemprop="name" content="{{ $post->title }}" />    
    <meta property="og:url" itemprop="url" content="{{ route('onekbuy.post.info', $post->slug) }}" />
    <meta property="og:description" content="Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn. Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />
    <meta property="og:image" content="https://1kbuy.vn/upload/images/{{ $post->image }}"  itemprop="thumbnailUrl" />
    <!-- Meta for Facebook -->
    <meta property="twitter:description" content="Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn. Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />
    <meta property="twitter:title" itemprop="name" content="{{ $post->title }}" />    
    <meta name="twitter:image" content="https://1kbuy.vn/upload/images/{{ $post->image }}" />
@endsection