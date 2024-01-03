<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Double;

class CartController extends Controller
{
    public function show(){
        $categorys = Category::all();
        $listProductCart = array();
        if(Cart::count() > 0){
            foreach(Cart::content() as $row){
                $listProductCart[$row->id] = Product::find($row->id);
            }
        }
        return view('guest.cart.show', compact('categorys', 'listProductCart'));
    }

    public function addCart(Request $request, int $id){
        $product = Product::find($id);
        if($product && $product->amount > 0){
            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'qty' => 1,
                'price' => $product->price,
                'options' => ['imageUrl' => $product->imageUrl]
            ]);
            return redirect()->route('cart.show');
        }
        return redirect()->route('guest.home');
    }

    public function update(Request $request){
        $data = $request->get('qty');        
        foreach ($data as $k => $v) {
            Cart::update($k, $v);
        }
        return redirect()->route('cart.show');
    }

    public function delete($rowId){
        Cart::remove($rowId);
        return redirect()->route('cart.show');
    }

    public function deleteAll(Request $request){
        Cart::destroy();
        return redirect()->route('cart.show');
    }

    public function checkout(){
        if(Cart::count() > 0){
            if(Auth::check()){
                $categorys = Category::all();
                return view('guest.cart.checkout', compact('categorys'));
            }else{
                return redirect()->route('login');
            }
        }else{
            return redirect()->route('guest.home');
        }
    }

    public function handlerCheckout(Request $request){
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:1000',
            'phone' => 'required|numeric|digits:10',
        ]);

        $order = Order::create([
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'phoneNumber' => $request->input('phone'),
            'note' => $request->input('note'),
            'payMethod' => $request->input('payMethod'),
            'amount' => Cart::count(),
            'total' => (Double)str_replace(",","",Cart::total()),
            'customerID' => Auth::user()->id,                        
        ]);

        foreach(Cart::content() as $row){
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $row->id,
                'amount' => $row->qty,
                'price' => (Double)str_replace(",","", $row->price),
                'subTotal' => (Double)str_replace(",","", $row->total), 
            ]);
        }
        Cart::destroy();
        return redirect()->route('guest.home')->with('status', 'Bạn đã đặt hàng thành công');
    }
}
