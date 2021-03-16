<?php
/**
 * Created by PhpStorm.
 * User: caomi
 * Date: 3/16/2021
 * Time: 10:39 AM
 */

namespace App\Exports;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class AnalyticsByMonth implements FromView
{
    public function view(): View
    {
        $month = request()->month ? request()->month : now()->month;

        $products = DB::table('order_details')
            ->leftJoin('products','products.id','=','order_details.product_id')
            ->wheremonth('order_details.created_at', '=', $month)
            ->select('products.id','products.name','order_details.product_id','order_details.price',
                DB::raw('SUM(order_details.quantity) as total_quantity'),
                DB::raw('SUM(order_details.price * order_details.quantity) as total_price'))
            ->groupBy('products.id','order_details.product_id','products.name', 'order_details.price')
            ->orderBy('total_quantity','desc')
            ->get();

        return view('backend.exports.analytics_by_month', [
            'products' => $products
        ]);
    }
}