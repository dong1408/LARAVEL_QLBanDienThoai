@extends('layouts.guest_self')

@section('main-content-wp')
    {{-- @parent --}}
    <div id="wp-content" class="wp-inner">
        <div class="section" id="nav-status-order">
            <ul style="display: flex; justify-content: space-around; margin:0px">
                <li style="{{ $type == 0 ? 'color: red; border-bottom: 1px solid red;' : '' }}"><a
                        href="{{ url('order/?type=0') }}">Tất cả</a></li>
                @foreach ($list_status_order as $status)
                    <li style="{{ $status->id == $type ? 'color: red; border-bottom: 1px solid red;' : '' }}"><a
                            href="{{ url('order/?type=') . $status->id }}">{{ $status->name }}</a></li>
                @endforeach
            </ul>
        </div>
        @if ($orders->count() > 0)
            <div class="section" id="search-order">
                <form action="">
                    <input type="text" style="width:100%; padding:10px 5px"
                        placeholder="Bạn có thể tìm kiếm theo ID đơn hàng hoặc Tên sản phẩm">
                    <input type="button" value="" hidden>
                </form>
            </div>
            <div class="section" id="history-cart">
                <ul>
                    @foreach ($orders as $order)
                        <li>
                            <p class="tiem-order">Thời gian đặt hàng : <strong>{{ $order->created_at }}</strong></p>
                            <p>Mã đơn hàng: <strong>{{ $order->id }}</strong></p>
                            <table>
                                <thead>
                                    <tr>
                                        <td>Stt</td>
                                        <td>Ảnh sản phẩm</td>
                                        <td>Tên sản phẩm</td>
                                        <td>Số lượng</td>
                                        <td>Đơn giá</td>
                                        <td>Thành tiền</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderDetails as $item)
                                        <tr>
                                            <td>0</td>
                                            <td><img src="{{ $item->product?->imageUrl }}" alt=""></td>
                                            <td>{{ $item->product?->name }}</td>
                                            <td>x{{ $item->amount }}</td>
                                            <td>{{ number_format($item->price, 0, '.', ',') }}đ</td>
                                            <td>{{ number_format($item->subTotal, 0, '.', ',') }}đ</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div style="marign:5px 0px; text-align: end; padding-right: 50px;">
                                <p>Tổng tiền: <strong>{{ number_format($order->total, 0, '.', ',') }}đ</strong></p>
                            </div>
                            <div style="marign:5px 0px; text-align: end; padding-right: 50px;">
                                <p>Trạng thái: <strong>{{ $order->orderStatus->name }}</strong></p>
                            </div>
                            {{-- @if ($order->orderStatus->id == 1)
                            <a target="?mod=cart&action=cancel&id=" id="" type="submit" name="cancel">Hủy đơn
                                hàng</a>
                        @endif --}}
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="section" id="empty-order">
                <div id="empty-order" style="background-color: aliceblue; height:550px">
                    <img src="{{url('images/empty-order.png')}}" alt="" style="margin: 0px auto; padding:120px 0px 15px 0px">
                    <p style="text-align: center; font-size:20px">Chưa có đơn hàng</p>
                </div>                
            </div>
        @endif
    </div>
@endsection
