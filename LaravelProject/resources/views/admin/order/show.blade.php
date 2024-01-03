@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách đơn hàng</h5>
                <div class="form-search form-inline">
                    <form action="">
                        <input type="hidden" name="type" value="{{$type}}">
                        <input type="text" name="q" class="form-control form-search" placeholder="Bạn có thể tìm kiếm theo ID đơn hàng, tên hoặc số điện thoại khách hàng">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a href="{{ url('admin/order?type=0') }}" class="text-primart"
                        style="{{ $type == 0 ? 'color:red!important' : '' }}">Tất cả<span class="text-muted">({{$count_orders_all}})</span></a>                    
                    @foreach ($list_order_status as $status)
                        <a href="{{ url('admin/order?type=') . $status->id }}" class="text-primary"
                            style="{{ $status->id == $type ? 'color:red!important' : '' }}">{{ $status->name }}<span
                                class="text-muted">({{$status->orders->count()}})</span></a>
                    @endforeach
                </div>
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" id="">
                        <option>Chọn</option>
                        <option>Tác vụ 1</option>
                        <option>Tác vụ 2</option>
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                </div>
                <table class="table table-striped table-checkall">
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
                            <th scope="col">Tác vụ</th>
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
                                <td>
                                    <a href="{{ route('admin.order.edit', $order->id) }}"
                                        class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fa fa-edit"></i></a>
                                    {{-- <a href="{{ route('admin.order.delete', $order->id) }}"
                                        class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                        data-toggle="tooltip" data-placement="top" title="soft Delete"
                                        onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?')"><i
                                            class="fa fa-trash"></i></a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="paging">
                    @if (!empty($keySearch))
                        {{ $orders->appends(['type' => $type, 'q' => $keySearch])->links() }}
                    @else
                        {{ $orders->appends(['type' => $type])->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
