@extends('layouts.guest_self')

@section('main-content')
    <div class="secion" id="breadcrumb-wp">
        <div class="secion-detail">
            <ul class="list-item clearfix">
                <li>
                    <a href="" title="">Trang chủ</a>
                </li>
                <li>
                    <a href="" title="">Điện thoại</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content fl-right">
        <div class="section" id="detail-product-wp">
            <div class="section-detail clearfix">
                <div class="thumb-wp fl-left">
                    <a href="" title="" id="main-thumb">
                        <img src="{{ url($product->imageUrl) }}"
                            data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg" />
                    </a>
                </div>
                <div class="info fl-right">
                    <h3 class="product-name">{{ $product->name }}</h3>
                    <div class="desc">
                        <p>Bộ vi xử lý :Intel Core i505200U 2.2 GHz (3MB L3)</p>
                        <p>Cache upto 2.7 GHz</p>
                        <p>Bộ nhớ RAM :4 GB (DDR3 Bus 1600 MHz)</p>
                        <p>Đồ họa :Intel HD Graphics</p>
                        <p>Ổ đĩa cứng :500 GB (HDD)</p>
                    </div>
                    <div class="num-product">
                        <span class="title">Sản phẩm: </span>
                        @if ($product->amount > 0)
                            <span class="status">Còn hàng</span>
                        @else
                            <span class="status">Hết hàng</span>
                        @endif
                    </div>
                    <p class="price">{{ number_format($product->price, 0, '.', ',') }}đ</p>
                    @if ($product->amount > 0)
                        <a href="{{route('cart.add', $product->id)}}" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="section" id="post-product-wp">
            <div class="section-head">
                <h3 class="section-title">Mô tả sản phẩm</h3>
            </div>
            <div class="section-detail">
                {!! $product->detailDesc !!}
            </div>
        </div>
        <div class="section" id="same-category-wp">
            <div class="section-head">
                <h3 class="section-title">Cùng chuyên mục</h3>
            </div>
            <div class="section-detail">
                <ul class="list-item">
                    <li>
                        <a href="" title="" class="thumb">
                            <img src="public/images/img-pro-17.png">
                        </a>
                        <a href="" title="" class="product-name">Laptop HP Probook 4430s</a>
                        <div class="price">
                            <span class="new">17.900.000đ</span>
                            <span class="old">20.900.000đ</span>
                        </div>
                        <div class="action clearfix">
                            <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                            <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                        </div>
                    </li>
                    <li>
                        <a href="" title="" class="thumb">
                            <img src="public/images/img-pro-18.png">
                        </a>
                        <a href="" title="" class="product-name">Laptop HP Probook 4430s</a>
                        <div class="price">
                            <span class="new">17.900.000đ</span>
                            <span class="old">20.900.000đ</span>
                        </div>
                        <div class="action clearfix">
                            <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                            <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                        </div>
                    </li>
                    <li>
                        <a href="" title="" class="thumb">
                            <img src="public/images/img-pro-19.png">
                        </a>
                        <a href="" title="" class="product-name">Laptop HP Probook 4430s</a>
                        <div class="price">
                            <span class="new">17.900.000đ</span>
                            <span class="old">20.900.000đ</span>
                        </div>
                        <div class="action clearfix">
                            <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                            <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                        </div>
                    </li>
                    <li>
                        <a href="" title="" class="thumb">
                            <img src="public/images/img-pro-20.png">
                        </a>
                        <a href="" title="" class="product-name">Laptop HP Probook 4430s</a>
                        <div class="price">
                            <span class="new">17.900.000đ</span>
                            <span class="old">20.900.000đ</span>
                        </div>
                        <div class="action clearfix">
                            <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                            <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                        </div>
                    </li>
                    <li>
                        <a href="" title="" class="thumb">
                            <img src="public/images/img-pro-21.png">
                        </a>
                        <a href="" title="" class="product-name">Laptop HP Probook 4430s</a>
                        <div class="price">
                            <span class="new">17.900.000đ</span>
                            <span class="old">20.900.000đ</span>
                        </div>
                        <div class="action clearfix">
                            <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                            <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                        </div>
                    </li>
                    <li>
                        <a href="" title="" class="thumb">
                            <img src="public/images/img-pro-22.png">
                        </a>
                        <a href="" title="" class="product-name">Laptop HP Probook 4430s</a>
                        <div class="price">
                            <span class="new">17.900.000đ</span>
                            <span class="old">20.900.000đ</span>
                        </div>
                        <div class="action clearfix">
                            <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                            <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                        </div>
                    </li>
                    <li>
                        <a href="" title="" class="thumb">
                            <img src="public/images/img-pro-23.png">
                        </a>
                        <a href="" title="" class="product-name">Laptop HP Probook 4430s</a>
                        <div class="price">
                            <span class="new">17.900.000đ</span>
                            <span class="old">20.900.000đ</span>
                        </div>
                        <div class="action clearfix">
                            <a href="" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                            <a href="" title="" class="buy-now fl-right">Mua ngay</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="sidebar fl-left">
        <div class="section" id="category-product-wp">
            <div class="section-head">
                <h3 class="section-title">Danh mục sản phẩm</h3>
            </div>
            <div class="secion-detail">
                <ul class="list-item">
                    <li>
                        <a href="?page=category_product" title="">Điện thoại</a>
                        <ul class="sub-menu">
                            <li>
                                <a href="?page=category_product" title="">Iphone</a>
                            </li>
                            <li>
                                <a href="?page=category_product" title="">Samsung</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?page=category_product" title="">Iphone X</a>
                                    </li>
                                    <li>
                                        <a href="?page=category_product" title="">Iphone 8</a>
                                    </li>
                                    <li>
                                        <a href="?page=category_product" title="">Iphone 8 Plus</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?page=category_product" title="">Oppo</a>
                            </li>
                            <li>
                                <a href="?page=category_product" title="">Bphone</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="?page=category_product" title="">Máy tính bảng</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title="">laptop</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title="">Tai nghe</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title="">Thời trang</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title="">Đồ gia dụng</a>
                    </li>
                    <li>
                        <a href="?page=category_product" title="">Thiết bị văn phòng</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="section" id="banner-wp">
            <div class="section-detail">
                <a href="" title="" class="thumb">
                    <img src="public/images/banner.png" alt="">
                </a>
            </div>
        </div>
    </div>
@endsection
