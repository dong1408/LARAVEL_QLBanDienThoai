<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class AdminPermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'permission']);
            return $next($request);
        });
    }

    public function add()
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        return view('admin.permission.add', compact('permissions'));


        // $permissions = Permission::all()->groupBy(function ($permission) {
        //     return explode('.', $permission->slug)[0];            
        // })->toArray();
        // echo "<pre>";
        // print_r($permissions);
        // echo "</pre>";
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255',
                'slug' => 'required'
            ]
        );

        Permission::create(
            [
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'description' => $request->input('description')
            ]
        );

        return redirect('admin/permission/add')->with('status', 'Thêm quyền thành công');
    }


    public function edit($id)
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->slug)[0];
        });
        $permission = Permission::find($id);
        return view('admin.permission.edit', compact('permissions', 'permission'));

    }

    public function update(Request $request, $id){
        $request->validate(
            [
                'name' => 'required|max:255',
                'slug' => 'required'
            ]
        );

        Permission::where('id', $id)->update([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description')
        ]);

        return redirect('admin/permission')->with('status', 'Cập nhật quyền thành công');
    }

    public function delete($id){
        Permission::where('id', $id)->delete();
        return redirect('admin/permission')->with('status', 'Bạn đã xóa thành công');   
    }
}
