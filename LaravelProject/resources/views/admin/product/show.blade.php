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
                <h5 class="m-0 ">Danh sách sản phẩm</h5>
                <div class="form-search form-inline">
                    <form action="">
                        <input type="hidden" name="status" value="{{ $status }}">
                        <input type="" name="q" class="form-control form-search" placeholder="Tìm kiếm">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a href="{{ url('admin/product/?status=active') }}"
                        @if ($status == 'active') style="color: red!important" @endif class="text-primary">Kích
                        hoạt<span class="text-muted">({{ $count[0] }})</span></a>
                    <a href="{{ url('admin/product/?status=trash') }}"
                        @if ($status != 'active') style="color: red!important" @endif class="text-primary">Vô hiệu
                        hóa<span class="text-muted">({{ $count[1] }})</span></a>
                </div>
                <form action="" method="POST">
                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" id="">
                            <option>Chọn</option>
                            @foreach ($list_act as $k => $v)
                                <option value="{{ $k }}">{{ $v }}</option>
                            @endforeach
                        </select>
                        <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                    </div>
                    <table class="table table-striped table-checkall">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <input name="checkall" type="checkbox">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Code</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products->count() > 0)
                                @php
                                    $t = 0;
                                @endphp
                                @foreach ($products as $product)
                                    <tr class="">
                                        <td>
                                            <input type="checkbox">
                                        </td>
                                        <td>{{ $t++ }}</td>
                                        <td><img src={{ $product->imageUrl != null ? url($product->imageUrl) : '' }}
                                                alt="" width="100px"></td>
                                        <td>{{ $product->codeProduct }}</td>
                                        <td><a href="#">{{ $product->name }}</a></td>
                                        <td>{{ number_format($product->price, 0, '.', '.') }}đ</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>26:06:2020 14:00</td>
                                        <td><span class="badge badge-success">Còn hàng</span></td>
                                        <td>
                                            @if ($status == 'active')
                                                <a href="{{ route('admin.product.edit', $product->id) }}"
                                                    class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                        class="fa fa-edit"></i></a>
                                                <a href="{{ route('admin.product.delete', $product->id) }}"
                                                    class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Delete"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i
                                                        class="fa fa-trash"></i></a>
                                            @else
                                                <a href="{{ route('admin.product.restore', $product->id) }}"
                                                    class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Restore"
                                                    onclick="return confirm('Bạn có muốn khổi phục?')"><i
                                                    class="fa-solid fa-trash-can-arrow-up"></i></a>
                                                <a href="{{ route('admin.product.forceDelete', $product->id) }}"
                                                    class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="forceDelete"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa hẳn khỏi hệ thống?')"><i
                                                    class="fa fa-times" aria-hidden="true"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">Không tìm thấy kết quả phù hợp</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </form>
                @if (!empty($keySearch))
                    {{ $products->appends(['status' => $status, 'q' => $keySearch])->links() }}
                @else
                    {{ $products->appends(['status' => $status])->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection
