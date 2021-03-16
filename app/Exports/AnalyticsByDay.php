<?php
/**
 * Created by PhpStorm.
 * User: caomi
 * Date: 3/16/2021
 * Time: 10:10 AM
 */

namespace App\Exports;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class AnalyticsByDay implements FromView
{
    public function view(): View
    {
        $from_date = request()->from_date ? request()->from_date : today();
        $to_date = request()->to_date ? request()->to_date : today();

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

        return view('backend.exports.analytics_by_day', [
            'products' => $products
        ]);
    }
}