@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Thêm mới vai trò</h5>
                <div class="form-search form-inline">
                    <form action="#">
                        <input type="" class="form-control form-search" placeholder="Tìm kiếm">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'admin.role.store', 'method' => 'POST']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Tên vai trò', ['class' => 'text-strong']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name']) !!}
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('description', 'Mô tả', ['class' => 'text-strong']) !!}
                    {!! Form::textarea('description', old('description'), [
                        'class' => 'form-control',
                        'id' => 'description',
                        'rows' => '3',
                    ]) !!}
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <strong>Vai trò này có quyền gì?</strong>
                <small class="form-text text-muted pb-2">Check vào module hoặc các hành động bên dưới để chọn
                    quyền.</small>

                <!-- List Permission  -->
                @foreach ($permissions as $moduleName => $modulePermission)
                    <div class="card my-4 border">
                        <div class="card-header">
                            {!! Form::checkbox(null, null, null, ['class' => 'check-all', 'id' => $moduleName]) !!}
                            {!! html_entity_decode(
                                Form::label($moduleName, '<strong>Module ' . $moduleName . '</strong>', ['class' => 'm-0']),
                            ) !!}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($modulePermission as $permission)
                                    <div class="col-md-3">
                                        {!! Form::checkbox('permission_id[]', $permission->id, null, [
                                            'class' => 'permission',
                                            'id' => $permission->slug,
                                        ]) !!}
                                        {!! Form::label($permission->slug, $permission->name) !!}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
                <input type="submit" name="btn-add" class="btn btn-primary" value="Thêm mới">
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.check-all').click(function() {
            $(this).closest('.card').find('.permission').prop('checked', this.checked)
        })
    </script>
@endsection
