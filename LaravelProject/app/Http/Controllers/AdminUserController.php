<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'user']);
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $status = $request->input('status') ? $request->input('status') : "active";
        $count_user_active = User::all()->count();
        $count_user_trash = User::onlyTrashed()->count();
        $count = [$count_user_active, $count_user_trash];        
        if ($status == "active") {
            $list_act = [
                'delete' => 'Xóa'
            ];
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $users = User::where([['name', 'LIKE', '%' . $keyword . '%']])->simplePaginate(6);
            return view('admin.user.show', compact('users', 'status', 'count', 'keyword', 'list_act'));
        } else {
            $list_act = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xóa vĩnh viên'
            ];
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $users = User::onlyTrashed()->where([['name', 'LIKE', '%' . $keyword . '%'], ['deleted_at', '<>', 'NULL']])->simplePaginate(6);
            return view('admin.user.show', compact('users', 'status', 'count', 'keyword', 'list_act'));
        }
    }

    public function add()
    {
        $roles = Role::all();
        return view('admin.user.add', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'role_id.*' => 'exists:roles,id',
            ],            
            [
                'required' => ':attribute không được để trống',
                'min' => ':attribute có độ dài ít nhất :min ký tự',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                // 'confirmed' => ':Xác nhận mật khẩu không thành công'
            ]
        );

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        $user->roles()->attach($request->input('role_id'));

        return redirect('admin/user')->with('status', 'Đã thêm thành viên thành công');
    }

    public function delete($id)
    {
        if (Auth::id() != $id) {
            $user = User::find($id);
            $user->delete();
            return redirect('admin/user')->with('status', 'Bạn đã xóa thành công');
        } else {
            return redirect('admin/user')->with('status', 'Bạn không thể tự xóa mình');
        }
    }


    // Thực hiện xóa hoặc khôi phục nhiều bản ghi cùng lúc
    public function action(Request $request)
    {
        $list_check = $request->input('list_check');
        if ($list_check) {
            foreach ($list_check as $k => $id) {
                if (Auth::id() == $id) {
                    unset($list_check[$k]);
                }
            }
            if (!empty($list_check)) {
                $act = $request->input('action');
                if ($act == "delete") {
                    User::destroy($list_check);
                    return redirect('admin/user')->with('status', 'Bạn đã xóa thành công');
                }
                if ($act == "restore") {
                    User::withTrashed()->whereIn('id', $list_check)->restore();
                    return redirect('admin/user/')->with('status', 'Bạn đã khôi phục thành công');
                }
                if ($act == "forceDelete") {
                    User::withTrashed()->whereIn('id', $list_check)->forceDelete();
                    return redirect('admin/user')->with('status', 'Bạn dã xóa vĩnh viễn user khỏi hệ thống');
                } else {
                    return redirect('admin/user')->with('status', 'Vui lòng chọn thao tác cần thực hiện');
                }
            }
            return redirect('admin/user')->with('status', 'Bạn không thể thao tác trên chính bạn');
        } else {
            return redirect('admin/user')->with('status', 'Bạn cần chọn phần tử để thực hiện thao tác');
        }
    }


    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {     
        $user = User::find($id);   
        $request->validate(
            [
                'name' => 'required|string|max:255',
                // 'email' => 'required|email|unique:users,email,'.$user->id,
                'role_id.*' => 'exists:roles,id',
            ]
        );
        $user->update([
            'name' => $request->input('name'), 
            // 'email' => $request->input('email'),           
        ]);

        // update for role user
        $user->roles()->sync($request->input('role_id'));

        return redirect('admin/user')->with('status', 'Cập nhật thành công');
    }


    public function restore(int $id){
        User::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('admin.user.show')->with('status', 'Bạn đã khôi phục thành công');
    }


    public function forceDelete(int $id){
        User::onlyTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('admin.user.show')->with('status', 'Bạn đã xóa vĩnh viễn thành viên khỏi hệ thống');
    }
}
