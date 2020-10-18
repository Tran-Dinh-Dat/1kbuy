@extends('/templates.onekbuy.master')
@section('content')
<div class="content">
    <div class="slider-main">
        <div class="background-img-top">
            <div class="container img-top">
              <a href="{{ $information->link }}"><img src="{{asset('./upload/images/'.$information->banner)}}" alt="" width="100%"></a>
            </div>
        </div>
      <div class="container slider-bottom">
        <div class="row">
          <div class="col-md-4 col-lg-2 d-none d-md-block d-print-block">
            <p class="all-product"><i class="fas fa-bars"></i> All Products</p>

            <ul>
              @foreach ($categoriesAside as $item)
              <li><a href="{{ route('onekbuy.product.index', $item->slug)}}"><i>{{ $item->name}}</i></a></li>
              @endforeach
            </ul>
          </div>
          <div class="col-12 col-md-8 col-lg-7">
            <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
              <!--Indicators-->
              <div class="carousel-inner">
                @foreach ($slides as $key => $item)
                  <div class="carousel-item {{ $key == 0 ? 'active' : ''}}">
                    <a href="{{ $item->link}}"><img class="d-block w-100" src="{{ asset('upload/images/' . $item->image)}}" alt="First slide"></a>
                  </div>
                @endforeach
              </div>
              <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
              <!--/.Controls-->
            </div>
          </div>
          <div class="col-12 col-lg-3 custom-3">
            <div class="container">
              <div class="row">
                @foreach ($banners as $item)
                  <div class="col-6 col-lg-12"><a href="{{ $item->link}}"><img class="img-2" src="{{ asset('upload/images/'. $item->image)}}" alt=""></a></div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <section class="container section-0">
    <div class="category-products-1">
      <div class="products-content-1">
      @foreach ($categories as $item)
      <div class="products-1">
        <div class="products-image-1">
          <a href="{{ route('onekbuy.product.index', $item->slug)}}">
            <img src="{{ asset('upload/images/' . $item->image)}}" alt="" class="image-box-1" />
          </a>
        </div>
        <div class="products-text-1">
          <div class="products-text-title-1">
            <h4><a href="">{{ $item->name}}</a>
            </h4>
          </div>
          <div class="more-products">
            <p>{{ $item->products->count()}} sản phẩm</p>
          </div>
        </div>
      </div>
      @endforeach
        

      </div>
      <div style="clear:both;"></div>

  </section>

  <!-- -------------------Section2-------------------------- -->

  <section class="container section-1">
    <div class="category-products">
      <div class="products-content">
        <p class=" widget-title" style="color:#000055;margin: 0px 0px 10px 8px;font-size:150%">
          {{$information->phobien}}</p>
          @foreach ($popularProducts as $item)
            <div class="products">
              <div class="products-image">
                <a href="{{ route('onekbuy.product.product', ['slug' => $item->slug, 'id' => $item->id])}}">
                  <img src="{{ asset('upload/images/'. $item->image)}}" alt=""
                    class="image-box" />
                </a>
              </div>
              <div class="products-text">
                <div class="products-text-name">
                  <a href="{{ route('onekbuy.product.product', ['slug' => $item->slug, 'id' => $item->id])}}" class="custom-color">
                      <p>{{ $item->name}}</p>
                  
                  </a>
                </div>
                <div class="products-text-price">
                  @php
                      $user = Auth::guard('web')->user();
                  @endphp
                  {{-- <del class="products-text-regular-price">
                   {{ number_format( $item->price)}}đ
                  </del> --}}
                  
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
        @endforeach
      </div>
      <div style="clear:both;"></div>
      
      <div style="text-align: center;"> <a name="" id="" class="btn m-3 custom-xem-them" href={{ route('onekbuy.product.popularproduct') }} role="button">
        <p><strong>Xem thêm</strong></p>
      </a>
      </div>
    </div>
  </section>
  
  <section class="container section-1">
    <div class="category-products">
      <div class="products-content">
        <p class=" widget-title" style="color:#000055;margin: 0px 0px 10px 8px;font-size:150%">
          {{$information->luachon}}</p>
          @foreach ($productChooseTheMost as $item)
            <div class="products">
              <div class="products-image">
                <a href="{{ route('onekbuy.product.product', ['slug' => $item->slug, 'id' => $item->id])}}">
                  <img src="{{ asset('upload/images/'. $item->image)}}" alt=""
                    class="image-box" />
                </a>
              </div>
              <div class="products-text">
                <div class="products-text-name">
                  <a href="{{ route('onekbuy.product.product', ['slug' => $item->slug, 'id' => $item->id])}}" class="custom-color">
                  <p>{{ $item->name}}</p>
                  </a>
                </div>
                <div class="products-text-price">
                  {{-- <ins class="products-text-sale-price">
                    {{ number_format( $item->promotion_price)}}<span class="woocommerce-Price-currencySymbol">&#8363;</span>
                  </ins>
                  <del class="products-text-regular-price">
                   {{ number_format( $item->price)}}đ
                  </del> --}}
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
        @endforeach
      </div>
      <div style="clear:both;"></div>

      <div style="text-align: center;"> <a name="" id="" class="btn m-3 custom-xem-them" href="{{ route('onekbuy.product.mostchosen') }}" role="button">
        <p><strong>Xem thêm</strong></p>
      </a>
      </div>
    </div>
  </section>
    <!-- -------------------Section3-------------------------- -->
  <!-- --------------Section 4 ------------------------- -->

  <section>
    <div class="container section-3">
        <h2 class="widget-title" style="color:#000055;font-size:24px;margin: 0px 0px 10px 8px;">
        {{$information->dexuat}} </h2>
        <div class="row row-products-3">
          @foreach ($productPropose as $item)
            <div class="col-6 col-md-4 col-xl-3 column-products-3">
                <div class="products-3">
                <div class="products-image-3">
                    <a href="{{ route('onekbuy.product.product', ['slug' => $item->slug, 'id' => $item->id])}}">
                    <img src="{{ asset('upload/images/'. $item->image)}}" alt=""
                        class="image-box-3" />
                    </a>
                </div>
                <div class="products-text-3">
                    <div class="products-text-name">
                      <a href="{{ route('onekbuy.product.product', ['slug' => $item->slug, 'id' => $item->id])}}">
                        <h6>{{ $item->name}}</h6>
                      </a>
                    </div>
                    <div class="products-text-price">
                      {{-- <ins class="products-text-sale-price">
                        {{ number_format( $item->promotion_price)}}<span class="woocommerce-Price-currencySymbol">&#8363;</span>
                      </ins><br style="d-none d-lg-block d-print-block">
                      <del class="products-text-regular-price">
                        {{ number_format( $item->price)}}đ
                      </del> --}}
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
        <div style="text-align: center;"> <a name="" id="" class="btn  m-3 custom-xem-them" href={{ route('onekbuy.product.productpropose') }} role="button">
          <p><strong>Xem thêm</strong></p></a>
      </div>
    </div>
  </section>
</div>
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
    <title>Mua sắm trả góp 1.000 đồng mỗi ngày</title>
    <meta name="keywords" content="1kbuy, one k buy, 1k buy" />
    <meta name="news_keywords" content="1kbuy, one k buy, 1k buy" />
    <meta name="description" content="⭐Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn. ⭐ Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />
    <link rel="canonical" href="https://1kbuy.vn" />
    <!-- Meta for Google -->
    <meta property="og:title" itemprop="name" content="Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />    
    <meta property="og:url" itemprop="url" content="https://1kbuy.vn" />
    <meta property="og:description" content="Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn. Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />
    <meta property="og:image" content="https://1kbuy.vn/upload/images/1594351195Screenshot_2-removebg-preview.png"  itemprop="thumbnailUrl" />
    <!-- Meta for Facebook -->
    <meta property="twitter:description" content="Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn. Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />
    <meta property="twitter:title" itemprop="name" content="Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />    
    <meta name="twitter:image" content="https://1kbuy.vn/upload/images/1594351195Screenshot_2-removebg-preview.png" />
@endsection