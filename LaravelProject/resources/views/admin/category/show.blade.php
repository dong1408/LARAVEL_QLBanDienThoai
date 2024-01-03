@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        @if (session('status'))
            <div class="alert alert-success" role="alert">{{ session('status') }}</div>
        @endif
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh mục sản phẩm
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.category.store', 'method' => 'POST']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Tên danh mục') !!}
                            {!! Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name']) !!}
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" name="btn-add" class="btn btn-primary">Thêm mới</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh sách
                    </div>
                    <div class="card-body">
                        <div class="analytic">
                            {{-- <a href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}" class="text-primary">Kích
                                hoạt<span class="text-muted">(10)</span></a>
                            <a href="{{ request()->fullUrlWithQuery(['status' => 'trash']) }}" class="text-primary">Vô hiệu
                                hóa<span class="text-muted">(5)</span></a> --}}
                            <a href="{{ url('admin/category/?status=active') }}"
                                @if ($status == 'active') style="color: red!important" @endif
                                class="text-primary">Kích
                                hoạt<span class="text-muted">({{ $count[0] }})</span></a>
                            <a href="{{ url('admin/category/?status=trash') }}"
                                @if ($status == 'trash') style="color: red!important" @endif
                                class="text-primary">Vô hiệu
                                hóa<span class="text-muted">({{ $count[1] }})</span></a>
                        </div>
                        <form action="{{ url('admin/category/action') }}" method="POST">
                            @csrf
                            <div class="form-action form-inline py-3">
                                <select class="form-control mr-1" id="" name="action">
                                    <option>Chọn</option>
                                    @foreach ($list_act as $k => $v)
                                        <option value="{{ $k }}">{{ $v }}</option>
                                    @endforeach
                                </select>
                                <input type="submit" name="btn-apply" value="Áp dụng" class="btn btn-primary">
                            </div>
                            <table class="table table-striped table-checkall">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="checkall">
                                        </th>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $t = 0;
                                    @endphp
                                    @foreach ($listCategory as $category)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="list_check[]" value="{{ $category->id }}">
                                            </td>
                                            <td scope="row">{{ $t++ }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                @if ($status == 'active')
                                                    <a href="{{ route('admin.category.edit', $category->id) }}"
                                                        class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                            class="fa fa-edit"></i></a>
                                                    <a href="{{ route('admin.category.delete', $category->id) }}"
                                                        class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                        data-toggle="tooltip" data-placement="top" title="Delete"
                                                        onclick="return confirm('Bạn có chắc muốn xóa khỏi hệ thống?')"><i
                                                            class="fa fa-trash"></i></a>
                                                @else
                                                    <a href="{{ route('admin.category.restore', $category->id) }}"
                                                        class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                        data-toggle="tooltip" data-placement="top" title="Restore"
                                                        onclick="return confirm('Bạn có muốn khôi phục?')"><i
                                                            class="fa-solid fa-trash-can-arrow-up"></i></a>
                                                    <a href="{{ route('admin.category.forceDelete', $category->id) }}"
                                                        class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                        data-toggle="tooltip" data-placement="top" title="Force Delete"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn khỏi hệ thống?')"><i
                                                            class="fa fa-times" aria-hidden="true"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
