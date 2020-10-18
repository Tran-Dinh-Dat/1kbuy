@extends('templates.onekbuy.master')
@section('content')
	    <div class="content">
        <div class="shop-background">
            <div class="container container-shop">
                <div class="row row-shop">
                    <div class="col-12 col-lg-8 col-xl-9 shop-left ">
                        <div class="row">
                            <div class="col-6 col-md-9 custom-filter">
                                <p>Showing 1-18 of {{$countProduct->count()}} results</p>
                            </div>
                            <div class="col-6 col-md-3 custom-filter">                             
                                <form class="form-inline">
                                    <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" onchange="location = this.value">
                                        <option value="">Default Sorting...</option>
                                        <option value="{{route('onekbuy.product.sort','popularity')}}">Sort by popularity</option>
                                        <option value="{{route('onekbuy.product.sort','lastest')}}">Sort by latest</option>
                                        <option value="{{route('onekbuy.product.sort','low-to-high')}}">Sort by price: low to high</option>
                                        <option value="{{route('onekbuy.product.sort','high-to-low')}}">Sort by price: high to low</option>
                                    </select>
                                </form>
                            </div>
                            @foreach ($popularProductCategory as $item)
                            <div class="col-6 col-sm-6 col-lg-4">
                                    <div class="shop">
                                        <div class="products-image">
                                            <a href={{route('onekbuy.product.product',['id' => $item->id,'slug' => $item->slug]) }}>
                                                <img src="{{asset('./upload/images/'.$item->image)}}"
                                                    alt="" class="image-box" />
                                            </a>
                                        </div>
                                        <div class="products-text">
                                            <div class="products-text-name">
                                                <a href={{route('onekbuy.product.product',['id' => $item->id,'slug' => $item->slug]) }}><h6>{{$item->name}}</h6></a>
                                            </div>
                                            <div class="products-text-price">
                                                {{-- <ins class="products-text-sale-price">
                                                    {{ number_format( $item->promotion_price)}}<span class="woocommerce-Price-currencySymbol">&#8363;</span>
                                                </ins>
                                                <del class="products-text-regular-price">
                                                    {{ number_format( $item->price)}}đ
                                                </del> --}}
                                                @php
                                                    $user = Auth::guard('web')->user()
                                                @endphp
                                                @if ($user && $item->promotion_price != 0)
                                                <del class="products-text-sale-price">
                                                    {{ number_format( $item->price)}}<span class="woocommerce-Price-currencySymbol">&#8363;</span>
                                                </del>
                                                <ins class="products-text-sale-price float-right pr-2 font-weight-bold text-danger">
                                                    {{ number_format( $item->promotion_price)}}<span class="woocommerce-Price-currencySymbol">&#8363;</span>
                                                </ins>
                                                @else
                                                <ins class="products-text-sale-price">
                                                    {{ number_format( $item->price)}}<span class="woocommerce-Price-currencySymbol">&#8363;</span>
                                                </ins>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                        </div>
                        <div style="clear:both;"></div>
                            <ul class="pagination">
                                {{ $popularProductCategory->links() }}
                            </ul>
                    </div>
                    @include('templates.onekbuy.product-bar')
                </div>
            </div>
        </div>  
    </div>
@stop
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
    <title>Sản phẩm về 1kbuy.vn. Mua sắm trả góp 1.000 đồng mỗi ngày</title>
    <meta name="keywords" content="1kbuy, one k buy, 1k buy" />
    <meta name="news_keywords" content="1kbuy, one k buy, 1k buy" />
    <meta name="description" content="⭐Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn. ⭐ Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />
    <link rel="canonical" href="{{ route('onekbuy.product.popularproduct') }}" />
    <!-- Meta for Google -->
    <meta property="og:title" itemprop="name" content="Tin tức về 1kbuy.vn. Hệ thống mua hàng chỉ với 1.000 đồng" />    
    <meta property="og:url" itemprop="url" content="{{ route('onekbuy.product.popularproduct') }}" />
    <meta property="og:description" content="Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn. Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />
    <meta property="og:image" content="https://1kbuy.vn/upload/images/1594351195Screenshot_2-removebg-preview.png"  itemprop="thumbnailUrl" />
    <!-- Meta for Facebook -->
    <meta property="twitter:description" content="Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn. Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />
    <meta property="twitter:title" itemprop="name" content="Tin tức về 1kbuy.vn. Hệ thống mua hàng chỉ với 1.000 đồng" />    
    <meta name="twitter:image" content="https://1kbuy.vn/upload/images/1594351195Screenshot_2-removebg-preview.png" />
@endsection