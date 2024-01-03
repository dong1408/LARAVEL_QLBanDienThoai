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
                <h5 class="m-0 ">Danh sách thành viên</h5>
                <div class="form-search form-inline">
                    <form action="#">
                        <input type="hidden" name="status" value="{{ $status }}">
                        <input type="text" name="keyword" value="{{ request()->input('keyword') }}"
                            class="form-control form-search" placeholder="Tìm kiếm">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    {{-- <a href="{{request()->fullUrlWithQuery(['status' => 'active'])}}" class="text-primary">Kích hoạt<span class="text-muted">(10)</span></a>
                    <a href="{{request()->fullUrlWithQuery(['status' => 'trash'])}}" class="text-primary">Vô hiệu hóa<span class="text-muted">(5)</span></a> --}}
                    <a href="{{ url('admin/user/?status=active') }}"
                        @if ($status == 'active') style="color: red!important" @endif class="text-primary">Kích
                        hoạt<span class="text-muted">({{ $count[0] }})</span></a>
                    <a href="{{ url('admin/user/?status=trash') }}"
                        @if ($status == 'trash') style="color: red!important" @endif class="text-primary">Vô hiệu
                        hóa<span class="text-muted">({{ $count[1] }})</span></a>
                </div>
                <form action="{{ url('admin/user/action') }}" method="POST">
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
                                <th scope="col">Email</th>
                                <th scope="col">Vai trò</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users->count() > 0)
                                @php
                                    $t = 0;
                                @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="list_check[]" value="{{ $user->id }}">
                                        </td>
                                        <td scope="row">{{ $t }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                <a href="{{ route('admin.role.edit', $role->id) }}"><span
                                                        class="badge badge-warning">{{ $role->name }}</span></a>
                                            @endforeach
                                        </td>
                                        <td>26:06:2020 14:00</td>
                                        <td>
                                            @if ($status == 'active')
                                                <a href="{{ route('admin.user.edit', $user->id) }}"
                                                    class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                        class="fa fa-edit"></i></a>
                                                @if (Auth::id() != $user->id)
                                                    <a href="{{ route('admin.user.delete', $user->id) }}"
                                                        class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                        data-toggle="tooltip" data-placement="top" title="Delete"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i
                                                            class="fa fa-trash"></i></a>
                                                @endif
                                            @else
                                                <a href="{{ route('admin.user.restore', $user->id) }}"
                                                    class="btn btn-success btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Restore"
                                                    onclick="return confirm('Bạn có muốn khôi phục?')"><i
                                                        class="fa-solid fa-trash-can-arrow-up"></i></a>
                                                <a href="{{ route('admin.user.forceDelete', $user->id) }}"
                                                    class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Force Delete"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn khỏi hệ thống?')"><i
                                                        class="fa fa-times" aria-hidden="true"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @php
                                        $t++;
                                    @endphp
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8">Không tìm thấy kết quả phù hợp</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </form>
                @if (!empty($keyword))
                    {{ $users->appends(['status' => $status, 'keyword' => $keyword])->links() }}
                @else
                    {{ $users->appends(['status' => $status])->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection
