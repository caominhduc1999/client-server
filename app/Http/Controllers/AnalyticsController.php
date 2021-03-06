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
            ->whereMonth('order_details.created_at', '=', $month)
            ->select('products.id','products.name','order_details.product_id','order_details.price',
                DB::raw('SUM(order_details.quantity) as total_quantity'),
                DB::raw('SUM(order_details.price * order_details.quantity) as total_price'))
            ->groupBy('products.id','order_details.product_id','products.name', 'order_details.price')
            ->orderBy('total_quantity','desc')
            ->get();

        return view('backend.analytics.analytics_by_month', compact('products', 'month'));
    }

    public function analyticsLoyalCustomer(Request $request)
    {
        $month = $request->month ? $request->month : now()->month;

        $customers = DB::table('users')
            ->rightJoin('orders', 'orders.user_id', '=', 'users.id')
            ->whereMonth('orders.created_at', '=', $month)
            ->select('users.id', 'users.name', 'orders.user_id', 'orders.phone', 'orders.email', DB::raw('SUM(orders.total) as total'))
            ->groupBy('users.id', 'users.name', 'orders.user_id', 'orders.phone', 'orders.email')
            ->orderBy('total', 'desc')
            ->get();

        return view('backend.analytics.loyal_customer', compact('customers', 'month'));
    }

    public function loyalCustomerOrderDetail($userId)
    {
        $orders = Order::with('order_details')->where('user_id', $userId)->orderBy('created_at', 'desc')->get();
//        dd($orders);
        return view('backend.analytics.loyal_customer_order_details', compact('orders', 'userId'));
    }

    public function guestLoyalCustomerOrderDetail($phone, $email)
    {
        $orders = Order::with('order_details')->where([['phone', $phone], ['email', $email]])->orderBy('created_at', 'desc')->get();

        return view('backend.analytics.loyal_customer_order_details', compact('orders', 'phone'));
    }

    public function analyticsImport(Request $request)
    {
        $from_date = $request->from_date ? $request->from_date : today();
        $to_date = $request->to_date ? $request->to_date : today();

        $imports = DB::table('import_details')
            ->leftJoin('products','products.id','=','import_details.product_id')
            ->whereDate('import_details.created_at', '>=', $from_date)
            ->whereDate('import_details.created_at', '<=', $to_date)
            ->select('products.id','products.name','import_details.product_id',
                DB::raw('SUM(import_details.quantity) as total_quantity'),
                DB::raw('SUM(import_details.import_price * import_details.quantity) as total_price'))
            ->groupBy('products.id','import_details.product_id','products.name')
            ->orderBy('total_quantity','desc')
            ->get();

        return view('backend.analytics.analytics_imports', compact('imports', 'from_date', 'to_date'));
    }

    public function analyticsByDayExport()
    {
        return \Excel::download(new \App\Exports\AnalyticsByDay(), 'analytics_by_day.xlsx');
    }

    public function analyticsByMonthExport()
    {
        return \Excel::download(new \App\Exports\AnalyticsByMonth(), 'analytics_by_month.xlsx');
    }

    public function loyalCustomerExport()
    {
        return \Excel::download(new \App\Exports\LoyalCustomer(), 'loyal_customer.xlsx');
    }

    public function analyticsImportExport()
    {
        return \Excel::download(new \App\Exports\AnalyticsImport(), 'analytics_imports.xlsx');
    }
}
