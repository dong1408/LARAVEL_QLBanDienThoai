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

        <div class="section" id="list-product-wp">
            <div class="section-head">
                <h3 class="section-title">{{ $nameCategory[0] }}</h3>
            </div>
            <div class="section-detail">
                <ul class="list-item clearfix">
                    @php
                        $t = 0;
                    @endphp
                    @foreach ($listProductByCat as $product)
                        @php
                            $t++;
                        @endphp
                        @if ($t <= 8)
                            <li>
                                <a href="{{route('guest.detailProduct', $product->id)}}" title="" class="thumb">
                                    <img src="{{ $product->imageUrl != null ? url($product->imageUrl) : '' }}" style="width: 175px; height: 185px">
                                </a>
                                <a href="{{route('guest.detailProduct', $product->id)}}" title="" class="product-name">{{ $product->name }}</a>
                                <div class="price">
                                    <span class="new">{{ number_format($product->price, 0, '.', ',') }}đ</span>
                                </div>
                                <div class="action clearfix">
                                    {{-- <a href="{{route('cart.add', $product->id)}}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm
                                        giỏ hàng</a> --}}
                                    <a href="{{route('guest.detailProduct', $product->id)}}" title="Mua ngay" class="buy-now" style="text-align: center">Xem chi
                                        tiết</a>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="section" id="paging">
            {{ $listProductByCat->links() }}
        </div>
    </div>
@endsection
