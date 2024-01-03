@extends('layouts.guest_self')

@section('main-content-wp')
    {{-- @parent --}}
    <div id="main-content-wp" class="checkout-page">
        <div class="section" id="breadcrumb-wp">
            <div class="wp-inner">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <a href="?page=home" title="">Trang chủ</a>
                        </li>
                        <li>
                            <a href="" title="">Thanh toán</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="wrapper" class="wp-inner clearfix">
            {!! Form::open(['route' => 'cart.handlerCheckout', 'method' => 'POST']) !!}
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            {!! Form::label('fullname', 'Họ tên') !!}
                            {!! Form::text('fullname', old('fullname'), ['id' => 'fullname']) !!}
                            @error('fullname')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-col fl-right">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::email('email', old('email'), ['id' => 'email']) !!}
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            {!! Form::label('address', 'Địa chỉ') !!}
                            {!! Form::text('address', old('address'), ['id' => 'address']) !!}
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-col fl-right">
                            {!! Form::label('phone', 'Số điện thoại') !!}
                            {!! Form::text('phone', old('phone'), ['id' => 'phone']) !!}
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            {!! Form::label('note', 'Ghi chú') !!}
                            {!! Form::textarea('note', old('note')) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Tổng</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::content() as $row)
                                <tr class="cart-item">
                                    <td class="product-name">{{ $row->name }}<strong
                                            class="product-quantity">x{{ $row->qty }}</strong>
                                    </td>
                                    <td class="product-total">{{ number_format($row->total, 0, '.', '.') }}đ</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="order-total">
                                <td>Tổng đơn hàng:</td>
                                <td><strong class="total-price">{{ Cart::total() }}đ</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="direct-payment" name="payMethod" value="card">
                                <label for="direct-payment">Thanh toán tại cửa hàng</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" name="payMethod" value="cod">
                                <label for="payment-home">Thanh toán tại nhà</label>
                            </li>
                        </ul>
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" id="order-now" value="Đặt hàng">
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
