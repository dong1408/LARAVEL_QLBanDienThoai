@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Thêm người dùng
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'admin.user.store', 'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('name', 'Họ và tên') !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name']) !!}
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::text('email', old('email'), ['class' => 'form-control', 'id' => 'email']) !!}
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Mật khẩu') !!}
                    {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('password-confirm', 'Xác nhận mật khẩu') !!}
                    {!! Form::password('password_confirm', ['class' => 'form-control', 'id' => 'password-confirm']) !!}
                </div>
                <div class="form-group">                    
                    {!! Form::label('', 'Vai trò') !!}<br>
                    @foreach ($roles as $role)
                        {!! Form::checkbox('role_id[]', $role->id, null, ['id' => $role->id]) !!}
                        {!! Form::label($role->id, $role->name) !!}<br>
                    @endforeach

                </div>

                <button type="submit" name="btn_add" class="btn btn-primary">Thêm mới</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
