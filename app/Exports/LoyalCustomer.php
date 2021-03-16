<?php
/**
 * Created by PhpStorm.
 * User: caomi
 * Date: 3/16/2021
 * Time: 10:46 AM
 */

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class LoyalCustomer implements FromView
{
    public function view(): View
    {
        $month = request()->month ? request()->month : now()->month;

        $customers = DB::table('users')
            ->join('orders', 'orders.user_id', '=', 'users.id')
            ->whereMonth('orders.created_at', '=', $month)
            ->select('users.id', 'users.name', 'orders.user_id', 'orders.phone', 'orders.email', DB::raw('SUM(orders.total) as total'))
            ->groupBy('users.id', 'users.name', 'orders.user_id', 'orders.phone', 'orders.email')
            ->take(5)
            ->orderBy('total', 'desc')
            ->get();

        return view('backend.exports.loyal_customer', [
            'customers' => $customers,
        ]);
    }
}