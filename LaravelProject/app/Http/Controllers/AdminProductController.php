<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use User;

class AdminProductController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'product']);
            return $next($request);
        });
    }

    public function index(Request $request){
        $status = $request->input('status')?$request->input('status'):"active";
        $count_product_active = Product::all()->count();
        $count_product_trash = Product::onlyTrashed()->count();
        $count = [$count_product_active, $count_product_trash];
        if($status == "active"){
            $keySearch = $request->input('q')?$request->input('q'):"";            
            $list_act = [
                'delete' => 'Xóa'
            ];
            $products = Product::where([['name', 'LIKE', '%' . $keySearch . '%']])->simplePaginate(3);
            return view('admin.product.show', compact('products', 'list_act', 'status', 'keySearch', 'count'));
        }else{
            $keySearch = $request->input('q')?$request->input('q'):"";            
            $list_act = [
                'restore' => 'Khôi phục',
                'forceDelete' => 'Xóa vĩnh viễn'
            ];            
            $products = Product::onlyTrashed()->where([['name', 'LIKE', '%' . $keySearch . '%'], ['deleted_at', '<>', 'NULL']])->simplePaginate(3);        
            return view('admin.product.show', compact('products', 'list_act', 'status', 'keySearch', 'count'));                
        }        
    }

    public function add(){
        $categorys = Category::all();
        return view('admin.product.add', compact('categorys'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255'
        ]);

        $urlProduct = "";
        if($request->hasFile('file')){
            $file = $request->file;
            $filename = $file->getClientOriginalName();
            $file->move('upload/product', $file->getClientOriginalName());
            $urlProduct = "upload/product/".$filename;            
        }

        Product::create([
            'codeProduct' => $request->input('code'),
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'shortDesc' => $request->input('shortDesc'),
            'detailDesc' => $request->input('detailDesc'),
            'imageUrl' => $urlProduct,
            'category_id' => $request->input('category')
        ]);

        return redirect()->route('admin.product.show')->with('status', 'Thêm sản phẩm thành công');
    }

    public function edit(int $id){
        $product = Product::find($id);
        $categorys = Category::all();
        return view('admin.product.edit', compact('product', 'categorys'));
    }

    public function update(Request $request, int $id){
        $product = Product::find($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255'
        ]);

        $urlProduct = $product->imageUrl;
        if($request->hasFile('file')){
            $file = $request->file;
            $filename = $file->getClientOriginalName();
            $file->move('upload/product', $file->getClientOriginalName());
            $urlProduct = "upload/product/".$filename;            
        }

        $product->update([
            'codeProduct' => $request->input('code'),
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'shortDesc' => $request->input('shortDesc'),
            'detailDesc' => $request->input('detailDesc'),
            'imageUrl' => $urlProduct,
            'category_id' => $request->input('category')
        ]);

        return redirect()->route('admin.product.show')->with('status', 'Chỉnh sửa sản phẩm thành công');
    }

    public function delete(int $id){
        Product::where('id', $id)->delete();
        return redirect()->route('admin.product.show')->with('status', 'Bạn đã xóa thành công');
    }

    public function forceDelete(int $id){
        Product::onlyTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('admin.product.show')->with('status', 'Bạn đã xõa vĩnh viễn sản phẩm khỏi hệ thống');
    }

    public function restore(int $id){
        Product::onlyTrashed()->where('id', $id)->restore();
        return redirect()->route('admin.product.show')->with('status', 'Bạn đã khôi phục thành công');
    }
}
