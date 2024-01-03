@extends('layouts.admin')

@section('content')
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $orders->where('orderstatus_id', 6)->count() }}</h5>
                        <p class="card-text">Đơn hàng giao dịch thành công</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐANG XỬ LÝ</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $orders->where('orderstatus_id', 3)->count() }}</h5>
                        <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                    <div class="card-header">DOANH SỐ</div>
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ number_format($orders->where('orderstatus_id', 6)->sum('total'), 0, '.', ',') }}đ</h5>
                        <p class="card-text">Doanh số hệ thống</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">ĐƠN HÀNG HỦY</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $orders->where('orderstatus_id', 7)->count() }}</h5>
                        <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="padding: 25px; margin: 10px 0px; background-color: whitesmoke">
            <div class="col">
                <form action="{{ url('admin/statistical') }}" method="GET">
                    <label for="date-from">Từ ngày</label>
                    <input type="date" id="date-from" name="dateForm" value="{{ request()->input('dateFrom')?request()->input('dateFrom'):$dateFrom }}"
                        style="margin-right: 10px">
                    <label for="date-to">Đến</label>
                    <input type="date" id="date-to" name="dateTo" value="{{ request()->input('dateTo')?request()->input('dateTo'):$dateTo }}">
                    <button type="submit" name="filter_by_date" onclick="return checkDate()"
                        style="margin-left:10px; padding: 0px 20px; background-color: gold; border-radius: 10px;">Lọc</button>
                </form>
            </div>
            <div class="col">
                <form action="{{url('admin/statistical')}}" method="GET">
                    <label for="price-from">Gía từ</label>
                    <input type="number" name="priceFrom" value="{{ request()->input('priceFrom') }}" id="price-from">
                    <label for="price-to">Tới</label>
                    <input type="number" name="priceTo" value="{{ request()->input('priceTo') }}" id="price-to">
                    <button type="submit" name="filter_by_price" onclick="return checkPrice()"
                        style="margin-left:10px; padding: 0px 20px; background-color: gold; border-radius: 10px;">Lọc</button>
                </form>
            </div>
        </div>
        <!-- end analytic  -->
        <div class="card">
            <div class="card-header font-weight-bold">
                DANH SÁCH ĐƠN HÀNG
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="checkall">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Mã</th>
                            <th scope="col">Khách hàng</th>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Tổng</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Thời gian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $t = 1;
                        @endphp
                        @foreach ($orders as $order)
                            <tr>
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td>{{ $t++ }}</td>
                                <td>{{ $order->id }}</td>
                                <td>
                                    {{ $order->fullname }} <br>
                                    {{ $order->phoneNumber }}
                                </td>
                                <td>
                                    @foreach ($order->orderDetails as $item)
                                        <a href="#">{{ $item->product?->name }}</a><br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($order->orderDetails as $item)
                                        {{ $item->amount }}<br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($order->orderDetails as $item)
                                        {{ number_format($item->price, 0, '.', ',') }}đ<br>
                                    @endforeach
                                </td>
                                <td>{{ number_format($order->total, 0, '.', ',') }}đ</td>
                                <td><span class="badge badge-warning">{{ $order->orderStatus->name }}</span></td>
                                <td>{{ $order->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="paging" style="padding-top: 20px">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection
