<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request){
        $categorys = Category::all();
        $keySearch = $request->input('q')?$request->input('q'):"";
        if($keySearch != ""){
            $listProductSearch = Product::where([['name', 'LIKE', '%' . $keySearch . '%']])->simplePaginate(20);
            return view('guest.search', compact('categorys', 'listProductSearch', 'keySearch'));                
        }else{        
            $categoryId = $request->input('category')?$request->input('category'):"";        
            if($categoryId != ""){
                $nameCategory = Category::where('id',$categoryId)->pluck('name');
                $listProductByCat = Product::where('category_id',$categoryId )->simplePaginate(20);                        
                return view('guest.category', compact('categorys', 'listProductByCat', 'nameCategory'));
            }else{
                return view('guest.home', compact('categorys'));
            }
        }
    }

    public function detailProduct(int $id){        
        $categorys = Category::all();
        $product = Product::where('id', $id)->first();
        if($product){
            return view('guest.detailProduct', compact('categorys', 'product'));
        }else{
            return redirect()->route('guest.home');
        }
    }

    public function order(Request $request){
        $type = $request->input('type')?$request->input('type'):0;
        $list_status_order = OrderStatus::all(); 
        $categorys = Category::all();
        $flag = false;        
        foreach($list_status_order as $item){
            if($item->id == $type){
                $flag = true;
            }
        }
        if($flag){          
            $orders = Order::where('customerID', '=',Auth::user()->id, 'and')->where('orderstatus_id', $type)->get();
            return view('guest.purchase_order', compact('categorys', 'orders', 'list_status_order', 'type'));
        }else{
            $orders = Order::where('customerID', Auth::user()->id)->get();
            $type=0;
            return view('guest.purchase_order', compact('categorys', 'orders', 'list_status_order', 'type'));
        }   
    }
}
