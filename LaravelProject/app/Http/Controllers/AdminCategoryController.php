<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'category']);
            return $next($request);
        });
    }

    public function index(Request $request){
        $status = $request->input('status') ? $request->input('status') : "active";
        $conut_category_active = Category::all()->count();
        $count_category_trash = Category::onlyTrashed()->count();
        $count = [$conut_category_active, $count_category_trash];
        if($status == 'active'){
            $list_act = [
                'delete' => 'Xóa'
            ];
            $listCategory = Category::all();
            return view('admin.category.show', compact('listCategory', 'count', 'status', 'list_act'));                
        }else{
            $list_act = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xóa vĩnh viễn'
            ];
            $listCategory = Category::onlyTrashed()->get();            
            return view('admin.category.show', compact('listCategory', 'count', 'status', 'list_act'));
        }
    }

    // Xử lý thêm danh mục
    public function store(Request $request){       
        $request->validate([
            'name' => 'required|max:255'
        ]);

        Category::create([
            'name'=>$request->input('name')
        ]);
        return redirect('admin/category/')->with('status', 'Thêm danh mục thành công');
    }


    // edit danh mục
    public function edit(int $id){
        $listCategory = Category::all();
        $category = Category::find($id);
        return view('admin.category.edit', compact('listCategory','category'));
    }

    // Xử lý edit danh mục
    public function update(Request $request, int $id){
        $request->validate([
            'name' => 'required|max:255'
        ]);
        Category::where('id', $id)->update([
            'name'=>$request->input('name')
        ]);
        return redirect()->route('admin.category.show')->with('status', 'Cập nhật danh mục thành công');
    }


    // Xử lý xóa tạm thời danh mục 
    public function delete(int $id){
        Category::where('id', $id)->delete();
        return redirect()->route('admin.category.show')->with('status', 'Bạn đã xóa thành công');                    
    }


    // Xử lý các hành dộng xóa, khôi phục, xóa vĩnh viễn nhiều phần tử cùng lúc
    public function action(Request $request){
        $list_check = $request->input('list_check');
        if(!empty($list_check)){
            $act = $request->input('action');
            if($act == 'delete'){
                Category::destroy($list_check);
                return redirect('admin/category/')->with('status', 'Bạn đã xóa thành công');
            }elseif($act == 'restore'){
                Category::withTrashed()->whereIn('id', $list_check)->restore();
                return redirect('admin/category/')->with('status', 'Bạn đã khổi phục thành công');                    
            }elseif($act == 'forceDelete'){
                Category::withTrashed()->whereIn('id', $list_check)->forceDelete();
                return redirect('admin/category/')->with('status', 'Bạn dã xóa vĩnh viễn danh mục khỏi hệ thống');
            }else{
                return redirect('admin/category/')->with('status', 'Bạn chưa chọn thao tác để thực hiện');
            }
        }else{
            return redirect()->route('admin.category.show')->with('status', 'Bạn cần chọn phần tử để thực hiện thao tác');
        } 
    }


    // Xử lý khôi phục
    public function restore(int $id){
        Category::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('admin.category.show')->with('status', 'Bạn đã khôi phục thành công');
    }    


    // Xử lý xóa vĩnh viễn
    public function forceDelete(int $id){
        Category::onlyTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('admin.category.show')->with('status', 'Bạn đã xóa vĩnh viễn khỏi hệ thống');
    }
}
