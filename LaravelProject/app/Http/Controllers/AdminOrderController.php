<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'order']);
            return $next($request);
        });
    }

    public function index(Request $request){
        $type = $request->input('type')?$request->input('type'):0;
        $list_order_status = OrderStatus::all();
        $count_orders_all = Order::count();
        $flag = false;        
        foreach($list_order_status as $item){
            if($item->id == $type){
                $flag = true;
            }
            // $status[$item->name] = $item->id;
        }

        if($flag){       
            $keySearch = $request->input('q')?$request->input('q'):"";         
            $orders = Order::where(function($query) use ($type){
                $query->where('orderstatus_id', '=', $type);
            })->where(function($query) use ($keySearch){
                $query->where('id', 'like', '%'.$keySearch.'%')
                    ->orwhere('fullname', 'like', '%'.$keySearch.'%')
                    ->orwhere('phoneNumber', 'like', '%'.$keySearch.'%');                    
            })->simplePaginate(8);
            return view('admin.order.show', compact('orders', 'list_order_status', 'count_orders_all','type'));
        }else{
            $type=0;
            $keySearch = $request->input('q')?$request->input('q'):""; 
            $orders = Order::where(function($query) use ($keySearch){
                $query->where('id', 'like', '%'.$keySearch.'%')
                    ->orwhere('fullname', 'like', '%'.$keySearch.'%')
                    ->orwhere('phoneNumber', 'like', '%'.$keySearch.'%');
            })->simplePaginate(8);
            return view('admin.order.show', compact('orders', 'list_order_status', 'count_orders_all', 'type'));
        }
    }

    public function edit($id){
        $list_order_status = OrderStatus::all();
        $order = Order::find($id);
        return view('admin.order.detail', compact('list_order_status','order'));
    }

    public function update(Request $request, int $id){
        $order = Order::find($id);
        $order->update([
            'orderstatus_id' => $request->input('status')
        ]);
        return redirect()->route('admin.order.edit', $id)->with('status', 'Cập nhật thành công');
    }
}
