@extends('layouts.admin')

@section('content')
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold">
                Chỉnh sửa thông tin người dùng
            </div>
            <div class="card-body">
                {!! Form::open(['route' => ['admin.user.update', $user->id], 'method' => 'POST']) !!}
                @csrf
                <div class="form-group">
                    {!! Form::label('name', 'Họ và tên') !!}
                    {!! Form::text('name', $user->name, ['class' => 'form-control', 'id' => 'name']) !!}
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::text('email', $user->email, ['class' => 'form-control', 'id' => 'email', 'readonly' => 'readonly']) !!}
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- <div class="form-group">
                    {!! Form::label('password', 'Mật khẩu') !!}
                    {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('password-confirm', 'Xác nhận mật khẩu') !!}
                    {!! Form::password('password_confirm', ['class' => 'form-control', 'id' => 'password-confirm']) !!}
                </div> --}}
                <div class="form-group">
                    @php
                        $list_role = $roles->pluck('name', 'id')->toArray();
                        $roleOfUser = $user->roles->pluck('id')->toArray();
                    @endphp
                    {!! Form::label('', 'Vai trò') !!}<br>
                    @foreach ($roles as $role)
                        {!! Form::checkbox('role_id[]', $role->id, in_array($role->id, $roleOfUser), ['id' => $role->id]) !!}
                        {!! Form::label($role->id, $role->name) !!}<br>
                    @endforeach

                </div>



                <button type="submit" name="btn_add" class="btn btn-primary">Cập nhật</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
