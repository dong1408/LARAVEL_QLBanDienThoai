@extends('layouts.guest_self')

@section('main-content-wp')
    {{-- @parent --}}
    <div id="main-content-wp" class="cart-page">
        {{-- <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="?page=home" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Sản phẩm làm đẹp da</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> --}}
        <div id="wrapper" class="wp-inner clearfix">
            @if (Cart::count() > 0)
                <div class="section" id="info-cart-wp">
                    <div class="section-detail table-responsive">
                        <form action="{{ route('cart.update') }}" method="POST">
                            @csrf
                            <table class="table">
                                <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Ảnh sản phẩm</td>
                                        <td>Tên sản phẩm</td>
                                        <td>Giá sản phẩm</td>
                                        <td>Số lượng</td>
                                        <td colspan="2">Thành tiền</td>
                                        <td>Tác vụ</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $t = 0;
                                    @endphp
                                    @foreach (Cart::content() as $row)
                                        <tr>
                                            <td>{{ $t++ }}</td>
                                            <td>
                                                <a href="{{ route('guest.detailProduct', $row->id) }}" title=""
                                                    class="thumb">
                                                    <img src="{{ url($row->options->imageUrl) }}" alt="">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="" title=""
                                                    class="name-product">{{ $row->name }}</a>
                                            </td>
                                            <td>{{ number_format($row->price, 0, '.', ',') }}đ</td>
                                            <td>
                                                <input type="number" min="0"
                                                    max="{{ $listProductCart[$row->id]->amount > 5 ? '5' : $listProductCart[$row->id]->amount }}"
                                                    name="qty[{{ $row->rowId }}]" value="{{ $row->qty }}"
                                                    class="num-order">
                                            </td>
                                            <td>{{ number_format($row->total, 0, '.', ',') }}đ</td>
                                            {{-- <td>{{$row->total}}đ</td> --}}
                                            <td>
                                                <a href="" title="" class="del-product"><i
                                                        class="fa fa-trash-o"></i></a>
                                            </td>
                                            <td>
                                                <a href="{{ route('cart.delete', $row->rowId) }}"
                                                    class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Delete"
                                                    onclick="return confirm('Bạn có muốn xóa sản phẩm khỏi giỏ hàng?')"><i
                                                        class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="8">
                                            <div class="clearfix">
                                                <p id="total-price" class="fl-right">Tổng giá:
                                                    <span>{{Cart::total()}}đ</span>
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8">
                                            <div class="clearfix">
                                                <div class="fl-right">
                                                    <input type="submit" value="Cập nhật giỏ hàng" name="btn_update"
                                                        id="update-cart">
                                                    <a href="{{route('cart.checkout')}}" title="" id="checkout-cart">Thanh
                                                        toán</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="section" id="action-cart-wp">
                    <div class="section-detail">
                        <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật thông tin giỏ hàng. Nhấn
                            vào thanh toán để hoàn tất mua hàng.
                        </p>
                        <a href="{{ route('guest.home') }}" title="" id="buy-more">Mua tiếp</a><br />
                        <a href="{{ route('cart.deleteAll') }}" title="" id="delete-cart" onclick="return confirm('Bạn có muốn xóa toàn bộ giỏ hàng?')">Xóa giỏ hàng</a>
                    </div>
                </div>
            @else
                <div class="empty">
                    <img src="{{ url('images/empty-cart.png') }}" style="width: 100px;margin: 0 auto;" alt="">
                    <p>Không có sản phẩm nào trong giỏ hàng</p>
                    <a href="{{ route('guest.home') }}">VỀ TRANG CHỦ</a>
                </div>
            @endif
        </div>
    </div>
@endsection
