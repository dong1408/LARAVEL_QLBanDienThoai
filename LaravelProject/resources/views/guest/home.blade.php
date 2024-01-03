@extends('layouts.guest_self')

@section('main-content')
    <div class="main-content fl-right">
        <div class="section" id="slider-wp">
            <div class="section-detail">
                <div class="item">
                    <img src="{{ url('images/slider-01.png') }}" alt="">
                </div>
                <div class="item">
                    <img src="{{ url('images/slider-02.png') }}" alt="">
                </div>
                <div class="item">
                    <img src="{{ url('images/slider-03.png') }}" alt="">
                </div>
            </div>
        </div>
        <div class="section" id="support-wp">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <div class="thumb">
                            <img src="{{ url('images/icon-1.png') }}">
                        </div>
                        <h3 class="title">Miễn phí vận chuyển</h3>
                        <p class="desc">Tới tận tay khách hàng</p>
                    </li>
                    <li>
                        <div class="thumb">
                            <img src="{{ url('images/icon-2.png') }}">
                        </div>
                        <h3 class="title">Tư vấn 24/7</h3>
                        <p class="desc">1900.9999</p>
                    </li>
                    <li>
                        <div class="thumb">
                            <img src="{{ url('images/icon-3.png') }}">
                        </div>
                        <h3 class="title">Tiết kiệm hơn</h3>
                        <p class="desc">Với nhiều ưu đãi cực lớn</p>
                    </li>
                    <li>
                        <div class="thumb">
                            <img src="{{ url('images/icon-4.png') }}">
                        </div>
                        <h3 class="title">Thanh toán nhanh</h3>
                        <p class="desc">Hỗ trợ nhiều hình thức</p>
                    </li>
                    <li>
                        <div class="thumb">
                            <img src="{{ url('images/icon-5.png') }}">
                        </div>
                        <h3 class="title">Đặt hàng online</h3>
                        <p class="desc">Thao tác đơn giản</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="section" id="feature-product-wp">
            <div class="section-head">
                <h3 class="section-title">Sản phẩm nổi bật</h3>
            </div>
            <div class="section-detail">
                <ul class="list-item">
                    <li>
                        <a href="?page=detail_product" title="" class="thumb">
                            <img src="{{ url('images/img-pro-05.png') }}">
                        </a>
                        <a href="?page=detail_product" title="" class="product-name">Laptop
                            Lenovo IdeaPad 120S</a>
                        <div class="price">
                            <span class="new">5.190.000đ</span>
                            <span class="old">6.190.000đ</span>
                        </div>
                        <div class="action clearfix">
                            <a href="?page=cart" title="" class="add-cart fl-left">Thêm giỏ
                                hàng</a>
                            <a href="?page=checkout" title="" class="buy-now fl-right">Mua
                                ngay</a>
                        </div>
                    </li>
                    <li>
                        <a href="?page=detail_product" title="" class="thumb">
                            <img src="{{ url('images/img-pro-08.png') }}">
                        </a>
                        <a href="?page=detail_product" title="" class="product-name">Samsung
                            Galaxy S8 Plus</a>
                        <div class="price">
                            <span class="new">20.490.000đ</span>
                            <span class="old">22.900.000đ</span>
                        </div>
                        <div class="action clearfix">
                            <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm
                                giỏ hàng</a>
                            <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua
                                ngay</a>
                        </div>
                    </li>
                    <li>
                        <a href="?page=detail_product" title="" class="thumb">
                            <img src="{{ url('images/img-pro-05.png') }}">
                        </a>
                        <a href="?page=detail_product" title="" class="product-name">Laptop
                            Lenovo IdeaPad 120S</a>
                        <div class="price">
                            <span class="new">5.190.000đ</span>
                            <span class="old">6.190.000đ</span>
                        </div>
                        <div class="action clearfix">
                            <a href="?page=cart" title="" class="add-cart fl-left">Thêm giỏ
                                hàng</a>
                            <a href="?page=checkout" title="" class="buy-now fl-right">Mua
                                ngay</a>
                        </div>
                    </li>
                    <li>
                        <a href="?page=detail_product" title="" class="thumb">
                            <img src="{{ url('images/img-pro-05.png') }}">
                        </a>
                        <a href="?page=detail_product" title="" class="product-name">Laptop
                            Lenovo IdeaPad 120S</a>
                        <div class="price">
                            <span class="new">5.190.000đ</span>
                            <span class="old">6.190.000đ</span>
                        </div>
                        <div class="action clearfix">
                            <a href="?page=cart" title="" class="add-cart fl-left">Thêm giỏ
                                hàng</a>
                            <a href="?page=checkout" title="" class="buy-now fl-right">Mua
                                ngay</a>
                        </div>
                    </li>
                    <li>
                        <a href="?page=detail_product" title="" class="thumb">
                            <img src="{{ url('images/img-pro-05.png') }}">
                        </a>
                        <a href="?page=detail_product" title="" class="product-name">Laptop
                            Lenovo IdeaPad 120S</a>
                        <div class="price">
                            <span class="new">5.190.000đ</span>
                            <span class="old">6.190.000đ</span>
                        </div>
                        <div class="action clearfix">
                            <a href="?page=cart" title="" class="add-cart fl-left">Thêm giỏ
                                hàng</a>
                            <a href="?page=checkout" title="" class="buy-now fl-right">Mua
                                ngay</a>
                        </div>
                    </li>
                    <li>
                        <a href="?page=detail_product" title="" class="thumb">
                            <img src="{{ url('images/img-pro-05.png') }}">
                        </a>
                        <a href="?page=detail_product" title="" class="product-name">Laptop
                            Lenovo IdeaPad 120S</a>
                        <div class="price">
                            <span class="new">5.190.000đ</span>
                            <span class="old">6.190.000đ</span>
                        </div>
                        <div class="action clearfix">
                            <a href="?page=cart" title="" class="add-cart fl-left">Thêm giỏ
                                hàng</a>
                            <a href="?page=checkout" title="" class="buy-now fl-right">Mua
                                ngay</a>
                        </div>
                    </li>
                    <li>
                        <a href="?page=detail_product" title="" class="thumb">
                            <img src="{{ url('images/img-pro-05.png') }}">
                        </a>
                        <a href="?page=detail_product" title="" class="product-name">Laptop
                            Lenovo IdeaPad 120S</a>
                        <div class="price">
                            <span class="new">5.190.000đ</span>
                            <span class="old">6.190.000đ</span>
                        </div>
                        <div class="action clearfix">
                            <a href="?page=cart" title="" class="add-cart fl-left">Thêm giỏ
                                hàng</a>
                            <a href="?page=checkout" title="" class="buy-now fl-right">Mua
                                ngay</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        @foreach ($categorys as $category)
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">{{ $category->name }}</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @php
                            $t = 0;
                        @endphp
                        @foreach ($category->products as $product)
                            @php
                                $t++;
                            @endphp
                            @if ($t <= 8)
                                <li>
                                    <a href="{{route('guest.detailProduct', $product->id)}}" title="" class="thumb">
                                        <img src="{{ $product->imageUrl != null ? url($product->imageUrl) : '' }}" style="width: 175px; height: 185px">
                                    </a>
                                    <a href="{{route('guest.detailProduct', $product->id)}}" title=""
                                        class="product-name">{{ $product->name }}</a>
                                    <div class="price">
                                        <span class="new">{{ number_format($product->price, 0, '.', ',') }}đ</span>
                                    </div>
                                    <div class="action clearfix">
                                        {{-- <a href="{{route('cart.add', $product->id)}}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm
                                            giỏ hàng</a> --}}
                                        <a href="{{route('guest.detailProduct', $product->id)}}" title="Mua ngay" class="buy-now" style="text-align: center">Xem chi tiết</a>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    @if ($t > 8)
                        <a href="?category={{ $category->id }}">Xem thêm ...</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
