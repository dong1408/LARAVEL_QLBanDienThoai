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
                        Chỉnh sửa quyền
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => ['admin.permission.update', $permission->id], 'method' => 'POST']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Tên quyền') !!}
                            {!! Form::text('name', $permission->name, ['class' => 'form-control', 'id' => 'name']) !!}
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug', 'Slug') !!}
                            <small class="form-text text-muted pb-2">Ví dụ: posts.add</small>
                            {!! Form::text('slug', $permission->slug, ['class' => 'form-control', 'id' => 'slug']) !!}
                            @error('slug')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Mô tả') !!}
                            {!! Form::textarea('description', $permission->description, [
                                'class' => 'form-control',
                                'id' => 'description',
                                'rows' => 3,
                            ]) !!}
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh sách quyền
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên quyền</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $t = 1;
                                @endphp
                                @foreach ($permissions as $moduleName => $modulePermission)
                                    <tr>
                                        <td scope="row"></td>
                                        <td><strong>Module {{ Str::ucfirst($moduleName) }}</strong></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @foreach ($modulePermission as $permission)
                                        <tr>
                                            <td scope="row">{{ $t }}</td>
                                            <td>|---{{ $permission->name }}</td>
                                            <td>{{ $permission->slug }}</td>
                                            <td>
                                                <a href="{{route('admin.permission.edit', $permission->id)}}" class="btn btn-success btn-sm rounded-0 text-white"
                                                    type="button" data-toggle="tooltip" data-placement="top"
                                                    title="Edit"><i class="fa fa-edit"></i></a>
                                                <a href="{{route('admin.permission.delete', $permission->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button"
                                                    data-toggle="tooltip" data-placement="top" title="Delete"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')"><i
                                                    class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @php
                                            $t++;
                                        @endphp
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
