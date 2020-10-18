@extends('templates.onekbuy.master')
@section('content')
	    <div class="content">
        <div class="shop-background">
            <div class="container container-shop">
                <div class="row row-shop">
                    <div class="col-12 col-lg-8 col-xl-9 shop-left ">
                        <div class="row row-main-products">
                            <div class="col-12 col-md-6 ">
                                <div class="container">
    
                                    {{-- <div class="mySlides">
                                        <img src="{{ asset('upload/images/1.jpg')}}" style="width:100%">
                                    </div>
    
                                    <div class="mySlides">
                                        <img src="{{ asset('upload/images/2.jpg')}}" style="width:100%">
                                    </div>
     --}}
                                    <div class="mySlides">
                                        <img src="{{ asset('upload/images/'. $product->image)}}" style="width:100%" class="image-slide">
                                    </div>
                                    @foreach ($product->imagesProduct as $key => $item)
                                        @if($key <=2)
                                        <div class="mySlides zoom" id="zoom-image">
                                            <img src="{{ asset('upload/'. $item->image_name)}}" style="width:100%" class="image-slide">
                                        </div>
                                        @endif
                                    @endforeach

                                    @if ($product->imagesProduct != null)
                                    <div class="row-products ">
                                        <div class="column-products">
                                            <img class="demo cursor" src="{{ asset('upload/images/'. $product->image)}}"  onclick="currentSlide(1)" alt="The Woods">
                                        </div>
                                        @foreach ($product->imagesProduct as $key => $item)
                                            @if($key <=2)
                                            <div class="column-products">
                                                <img class="demo cursor" src="{{ asset('upload/'. $item->image_name)}}"  onclick="currentSlide({{$key + 2}})" alt="The Woods">
                                            </div>
                                            @endif
                                        @endforeach             
                                    </div>
                                    @endif
                                </div>
                            </div>
    
                            <div class="col-12 col-md-6 ">
                                <div class="products-text-custom mb-3">
                                    <div class="products-text-name">
                                        <h1>{{ $product->name}}</h1>
                                    </div>
                                    <div class="products-text-price">
                                       
                                        @php
                                            $user = Auth::guard('web')->user()
                                        @endphp
                                        
                                       @if ($user && $product->promotion_price != 0)
                                        <del class="products-text-sale-price" style="">
                                            {{ number_format( $product->price)}}<span class="woocommerce-Price-currencySymbol"> &#8363; </span>
                                        </del>
                                        <ins class="products-text-sale-price ml-4 text-info">
                                            {{ number_format( $product->promotion_price)}}<span class="woocommerce-Price-currencySymbol">&#8363;</span>
                                        </ins>
                                        @else 
                                        <ins class="products-text-sale-price">
                                            {{ number_format( $product->price)}}<span class="woocommerce-Price-currencySymbol">&#8363;</span>
                                        </ins>
                                       @endif
                                    </div>
                                    <div class="products-ship">
                                        <h6>{{$product->ship}}</h6>
                                    </div>
                                </div>
                                @include('errors.error')
                                <div class="button-buy">
                                    <form action="{{ route('onekbuy.cart.store')}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="box-qty col-md-6 col-12">
                                                <span>Số lượng: </span> <input type="number" name="qty" value="1" min="1" class="form-control">
                                            </div>
                                            <div class="box-size form-group col-md-6">
                                                @php
                                                    $sizes =  explode(",",$product->size)
                                                @endphp
                                                <label for="">Quy cách: </label>
                                                  <select class="form-control" name="size" id="size-dat-hang">
                                                    @foreach ($sizes as $size)
                                                        <option value="{{$size}}">{{ $size }}</option>
                                                    @endforeach
                                                  </select>
                                            </div>
                                        </div>
                                        <a id="" class="btn btn-danger mr-4" href="" data-toggle="modal" data-target="#exampleModal" role="button">Trả góp</a>
                                        <input type="hidden" name="id" value="{{ $product->id}}">
                                        
                                        <button type="submit" class="btn btn-primary ml-4 bg-light text-dark">Mua ngay</button>
                                    </form>

                                    
                                    <div class="modal" id="exampleModal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                        <form action="{{ route('onekbuy.product.tra-gop', $product->id) }}" method="post">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title">{{ $product->name}}</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                              <h6>Bạn có thật sự muốn <strong>Trả góp</strong> món đồ này</h6>
                                                @csrf
                                                <div class="form-group mt-4 row" id="input-tien-tra-gop">
                                                    <div class="form-group col-md-8">
                                                        <input type="number" required min="1000" name="tien_tra_gop" id="" class="form-control" placeholder="Nhập số tiền bạn muốn trả góp">
                                                    </div>
                                                    <input type="hidden" name="size" id="size-tra-gop">
                                                   
                                                </div>      
                                              <div class="form-check pt-2">
                                                <label class="form-check-label">
                                                  <input type="checkbox" class="form-check-input" name="" id="dong-y-chinh-sach" value="">
                                                  Tôi đã đọc và đồng ý <a href="{{ route('onekbuy.post.info', 'chinh-sach-tra-gop')}}">chính sách trả góp</a> của 1kbuy
                                                </label>
                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" id="btn-tra-gop" disabled class="btn btn-danger">Có</button>
                                            </div>
                                          </div>
                                        </form>  
                                        </div>
                                    </div>

                                </div>
                            </div>
    
                            <div class="col-12 col-xl-12">
                                <div class=" description-products" style="display: block;">
    
                                    <h2 class="text-decoration-underline">Chi tiết sản phẩm</h2>
    
                                    <div style="width: 100%">
                                        {!! $product->description !!}
                                    </div>
                                </div>
    
                                <div class=" description-products" style="display: block;">
    
                                    <h2 class="text-decoration-underline">Sản phẩm liên quan</h2>
                                </div>
                                <div class="row row-related-products">
                                    @foreach ($productRelated as $item)
                                        <div class="col-6 col-xl-3">
                                            <div class="product-related">
                                                <div class="products-image">
                                                    <a href="{{ route('onekbuy.product.product', ['slug' => $item->slug, 'id' => $item->id])}}">
                                                        <img src="{{ asset('upload/images/'. $item->image)}}" alt=""
                                                          class="image-box" />
                                                    </a>
                                                </div>
                                                <div class="products-text">
                                                    <div class="products-text-name text-center">
                                                        <a href="{{ route('onekbuy.product.product', ['slug' => $item->slug, 'id' => $item->id])}}">
                                                            <h6>{{ $item->name}}</h6>
                                                        </a>
                                                    </div>
                                                    <div class="products-text-price text-center">
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
                            </div>
                        </div>
    
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

        <script>
            var slideIndex = 1;
            showSlides(slideIndex);
            
            function plusSlides(n) {
            showSlides(slideIndex += n);
            }
            
            function currentSlide(n) {
            showSlides(slideIndex = n);
            }
            
            function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var captionText = document.getElementById("caption");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex-1].style.display = "block";
            }
        </script>
        <script src="https://www.jacklmoore.com/js/jquery.js"></script>
        <script src="https://www.jacklmoore.com/js/jquery.zoom.js"></script>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
      <script>
        $(document).ready(function() {
            $('#dong-y-chinh-sach').on('click',function () {
                if ($('#dong-y-chinh-sach').is(':checked')) {
                    $("#btn-tra-gop").removeAttr('disabled');
                } else {
                    $("#btn-tra-gop").attr('disabled', true); 
                }
            });
            $('#size-dat-hang').on('change', function() {
                var value = this.value;
                $('#size-tra-gop').attr("value", value);
            });
            
           
        }); 
    </script>
      
@endsection
@section('header')
    <title>{{ $product->name }}</title>
    <meta name="keywords" content="1kbuy, one k buy, 1k buy" />
    <meta name="news_keywords" content="1kbuy, one k buy, 1k buy" />
    <meta name="description" content="⭐Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn. ⭐ Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />
    <link rel="canonical" href="{{ route('onekbuy.product.product', ['slug' => $product->slug, 'id' => $product->id]) }}" />
    <!-- Meta for Google -->
    <meta property="og:title" itemprop="name" content="{{ $product->name }}" />    
    <meta property="og:url" itemprop="url" content="{{ route('onekbuy.product.product', ['slug' => $product->slug, 'id' => $product->id]) }}" />
    <meta property="og:description" content="Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn. Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />
    <meta property="og:image" content="https://1kbuy.vn/upload/images/{{ $product->image }}"  itemprop="thumbnailUrl" />
    <!-- Meta for Facebook -->
    <meta property="twitter:description" content="Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn. Hệ thống mua hàng chỉ với 1.000 đồng. 1kbuy.vn" />
    <meta property="twitter:title" itemprop="name" content="{{ $product->name }}" />    
    <meta name="twitter:image" content="https://1kbuy.vn/upload/images/{{ $product->image }}" />
@endsection
