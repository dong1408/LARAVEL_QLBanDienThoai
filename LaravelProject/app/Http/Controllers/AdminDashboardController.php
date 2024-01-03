<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next){
            session(['module_active' => 'dashboard']);
            return $next($request);
        });


    }

    public function index(){
        $orders = Order::simplePaginate(10);        
        return view('admin.dashboard.show', compact('orders'));
    }

}
