<div class="col-12 col-lg-4 col-xl-3 shop-right">
                        <div class="category">
                            <div class="text-category">
                                <h6>Danh mục sản phẩm</h6>
                            </div>
                            <div class="form">
                                <form class="form-inline">
                                    @php
                                        $slug = str_replace('https://1kbuy.vn/product-category/','',url()->current());
                                    @endphp
                                    <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" onchange="location = this.value">
                                        {{-- <option selected>Lựa chọn theo danh mục...</option> --}}
                                        <option value="{{route('onekbuy.product.popularproduct')}}"  {{ request()->is('shop/xem-pho-bien') ? 'selected' : '' }}>{{ $information->phobien }}</option>
                                        <option value="{{route('onekbuy.product.mostchosen')}}" {{ request()->is('shop/duoc-lua-chon-nhieu-nhat') ? 'selected' : '' }}>{{ $information->luachon }}</option>
                                        <option value="{{route('onekbuy.product.productpropose')}}" {{ request()->is('shop/de-xuat-hap-dan') ? 'selected' : '' }}>{{ $information->dexuat }}</option>
                                        @foreach ($categoryProduct as $item)
                                            @if($item->slug != $slug)
                                                <option value="{{route('onekbuy.product.index', $item->slug)}}">{{$item->name}}({{$item->products->count()}})</option>
                                            
                                            @else
                                            <option value="{{route('onekbuy.product.index', $item->slug)}}" selected>{{$item->name}}({{$item->products->count()}})</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                        </div>
                        {{-- {{dd(str_replace('http://127.0.0.1:8000/product-category/','',url()->current())) }} --}}
                        <div class="category">
                            <div class="text-category">
                                <h6>Đề xuất hấp dẫn</h6>
                            </div>
                            @foreach ($V_productPropose as $item)
                            <div class="products-3 d-flex justify-content-start custom-wiget-product">
                                <div class="products-image-3">
                                    <a href="{{ route('onekbuy.product.product', ['slug' => $item->slug, 'id' => $item->id])}}">
                                        <img src="{{ asset('upload/images/'. $item->image)}}"
                                            alt="{{ $item->name}}" class="image-box-3"/>
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
                                        </ins>
                                        <del class="products-text-regular-price">
                                            {{ number_format( $item->price)}}đ
                                        </del> --}}
                                        @php
                                            $user = Auth::guard('web')->user()
                                        @endphp
                                        @if ($user && $user->vip == 1 && $item->promotion_price != 0)
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
                    </div>