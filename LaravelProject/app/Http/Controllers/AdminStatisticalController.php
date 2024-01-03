<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\Double;

class AdminStatisticalController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'statistical']);
            return $next($request);
        });
    }

    public function index(Request $request){
        $orders = Order::simplePaginate(10);
        $dateFrom = date("Y-m-01");
        $dateTo = date("Y-m-d");
        if($request->has('filter_by_date')){
            $dateFrom = $request->input('dateForm');
            $dateTo = $request->input('dateTo');
            if($dateFrom > $dateTo){
                return view('admin.statistical.show', compact('orders', 'dateFrom', 'dateTo'));
            }else{
                $orders = Order::where('created_at', '>=', $dateFrom, 'and')->where('created_at', '<=', $dateTo)->simplePaginate(10);
                return view('admin.statistical.show', compact('orders', 'dateFrom', 'dateTo'));        
            }            
        }
        if($request->has('filter_by_price')){
            $priceFrom = (Double)$request->input('priceFrom');
            $priceTo = (Double)$request->input('priceTo');
            if($priceFrom > $priceTo){
                return view('admin.statistical.show', compact('orders', 'dateFrom', 'dateTo'));
            }else{
                $orders = Order::where('total', '>=', $priceFrom, 'AND')->where('total', '<=', $priceTo)->simplePaginate(10);
                return view('admin.statistical.show', compact('orders', 'dateFrom', 'dateTo'));
            }
        }
        return view('admin.statistical.show', compact('orders', 'dateFrom', 'dateTo'));        
    }
}
