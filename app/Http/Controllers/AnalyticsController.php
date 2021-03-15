<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function analyticsByDay(Request $request)
    {
        $from_date = $request->from_date ? $request->from_date : today();
        $to_date = $request->to_date ? $request->to_date : today();

        $products = DB::table('order_details')
            ->leftJoin('products','products.id','=','order_details.product_id')
            ->whereDate('order_details.created_at', '>=', $from_date)
            ->whereDate('order_details.created_at', '<=', $to_date)
            ->select('products.id','products.name','order_details.product_id','order_details.price',
                DB::raw('SUM(order_details.quantity) as total_quantity'),
                DB::raw('SUM(order_details.price * order_details.quantity) as total_price'))
            ->groupBy('products.id','order_details.product_id','products.name', 'order_details.price')
            ->orderBy('total_quantity','desc')
            ->get();

        return view('backend.analytics.analytics_by_day', compact('products', 'from_date', 'to_date'));
    }

    public function analyticsByMonth(Request $request)
    {
        $month = $request->month ? $request->month : now()->month;

        $products = DB::table('order_details')
            ->leftJoin('products','products.id','=','order_details.product_id')
            ->wheremonth('order_details.created_at', '=', $month)
            ->select('products.id','products.name','order_details.product_id','order_details.price',
                DB::raw('SUM(order_details.quantity) as total_quantity'),
                DB::raw('SUM(order_details.price * order_details.quantity) as total_price'))
            ->groupBy('products.id','order_details.product_id','products.name', 'order_details.price')
            ->orderBy('total_quantity','desc')
            ->get();

        return view('backend.analytics.analytics_by_month', compact('products', 'month'));
    }

    public function analyticsLoyalCustomer()
    {
        $customers = User::where('user_type', 2)->get();
        return view('backend.analytics.loyal_customer', compact('customers'));
    }

    public function loyalCustomerOrderDetail($userId)
    {
        $orders = Order::with('order_details')->where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        return view('backend.analytics.loyal_customer_order_details', compact('orders', 'userId'));
    }
}
