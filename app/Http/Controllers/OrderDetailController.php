<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $orderDetail = OrderDetail::find($id);
        $products = Product::all();
        return view('backend.order_details.edit', compact('orderDetail' ,'products'));
    }


    public function update(Request $request, OrderDetail $orderDetail)
    {
        $orderDetail->update($request->all());
        $orderDetail->save();
        return redirect()->back()->with('success', 'Sửa thành công !');
    }


    public function destroy($id)
    {
        $orderDetail = OrderDetail::find($id);
        $orderDetail->delete();

        return redirect()->route('orders.index')->with('success', 'Xóa thành công !');
    }
}
