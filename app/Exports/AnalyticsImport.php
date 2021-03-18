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

class AnalyticsImport implements FromView
{
    public function view(): View
    {
        $from_date = request()->from_date ? request()->from_date : today();
        $to_date = request()->to_date ? request()->to_date : today();

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

        return view('backend.exports.analytics_imports', [
            'imports' => $imports
        ]);
    }
}