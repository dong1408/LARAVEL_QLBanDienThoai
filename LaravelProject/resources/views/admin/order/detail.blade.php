@extends('layouts.admin')

@section('content')
    <div id="content" class="detail-exhibition container-fluid">
        <div class="card">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="section" id="info">
                <div class="section-head"
                    style="text-align: center; background-color: #F7F8F7; padding:10px; margin-bottom:10px">
                    <h3 class="">Thông tin đơn hàng</h3>
                </div>
                <ul class="list-item" style="list-style: none">
                    <li>
                        <h5 class="title" style="font-family: inherit">Mã đơn hàng</h5>
                        <span class="detail">WEBCAMP#{{ $order->id }}</span>
                    </li>
                    <li>
                        <h5 class="title" style="font-family: inherit">Địa chỉ nhận hàng</h5>
                        <span class="detail">{{ $order->address . ' / ' . $order->phoneNumber }}</span>
                    </li>
                    <li>
                        <h5 class="title" style="font-family: inherit">Thông tin vận chuyển</h5>
                        @if ($order->payMethod == 'cod')
                            <span class="detail">Thanh toán tại nhà</span>
                        @else
                            <span class="detail">Thanh toán tại cửa hàng</span>
                        @endif
                    </li>
                    {!! Form::open(['route' => ['admin.order.update', $order->id], 'method' => 'POST']) !!}
                    <li>
                        <h5 class="title" style="font-family: inherit">Tình trạng đơn hàng</h5>
                        {!! Form::select('status', $list_order_status->pluck('name', 'id'), $order->orderstatus_id) !!}
                        <input type="submit" name="sm_status" value="Cập nhật đơn hàng">
                    </li>
                    {!! Form::close() !!}
                </ul>
            </div>
            <div class="section">
                <div class="section-head">
                    <h3 class="" style="padding-left: 20px; font-size:23px">Sản phẩm đơn hàng</h3>
                </div>
                <div class="table-responsive" style="padding: 15px; font-size:16px">
                    <table class="table table-striped info-exhibition">
                        <thead style="font-family: ">
                            <tr>
                                <td class="thead-text">STT</td>
                                <td class="thead-text">Ảnh sản phẩm</td>
                                <td class="thead-text">Tên sản phẩm</td>
                                <td class="thead-text">Đơn giá</td>
                                <td class="thead-text">Số lượng</td>
                                <td class="thead-text">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $t = 1;
                            @endphp
                            @foreach ($order->orderDetails as $item)
                                <tr>
                                    <td class="thead-text">{{ $t++ }}</td>
                                    <td class="thead-text">
                                        <div class="thumb">
                                            <img src="{{ $item->product?->imageUrl != null ? url($item->product?->imageUrl) : '' }}"
                                                alt="">
                                        </div>
                                    </td>
                                    <td class="thead-text">{{ $item->product?->name }}</td>
                                    <td class="thead-text">{{ number_format($item->price, 0, '.', ',') }}đ</td>
                                    <td class="thead-text">{{ $item->amount }}</td>
                                    <td class="thead-text">{{ number_format($item->subTotal, 0, '.', ',') }}đ</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="section">
                <h3 style="padding-left: 20px; font-size:23px">Giá trị đơn hàng</h3>
                <div class="section-detail">
                    <ul class="list-item clearfix" style="list-style: none">
                        <li>
                            <span class="total-fee">Tổng số lượng</span>
                            <span class="total">Tổng đơn hàng</span>
                        </li>
                        <li>
                            <span class="total-fee">{{ $order->amount }} sản phẩm</span>
                            <span class="total">{{ number_format($order->total, 0, '.', ',') }}đ</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
