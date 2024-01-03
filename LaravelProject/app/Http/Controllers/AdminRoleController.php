<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'permission']);
            return $next($request);
        });
    }

    public function show()
    {
        $roles = Role::all();
        return view('admin.role.show', compact('roles'));
    }

    public function add()
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        return view('admin.role.add', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'description' => 'required',
            'permission_id' => 'nullable|array',
            'permission_id.*' => 'exists:permissions,id',
            
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        $role->permissions()->attach($request->input('permission_id'));
        return redirect()->route('admin.role.show')->with('status', 'Bạn đã thêm vai trò thành công');
    }


    public function edit(Role $role)
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        return view('admin.role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permission_id' => 'nullable|array',
            'permission_id.*' => 'exists:permissions,id',
        ]);

        $role::updated([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        $role->permissions()->sync($request->input('permission_id', []));

        return redirect()->route('admin.role.show')->with('status', 'Cập nhật quyền thành công');
    }

    public function delete(Role $role){
        $role->delete();
        return redirect()->route('admin.role.show')->with('status', 'Bạn đã xóa thành công');
    }
}
