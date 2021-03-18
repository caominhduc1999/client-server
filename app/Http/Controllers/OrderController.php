<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();

        return view('backend.orders.index', compact('orders'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        Order::create($request->all());
        return redirect()->back()->with('success', 'Thêm thành công !');
    }


    public function show($id)
    {
        $orderDetails = OrderDetail::where('order_id', $id)->get();
        return view('backend.orders.show', compact('orderDetails'));
    }


    public function edit($id)
    {
        $order = Order::find($id);
        $paymentMethods = PaymentMethod::all();
        $users = User::all();
        return view('backend.orders.edit', compact('order', 'users', 'paymentMethods'));
    }


    public function update(Request $request, Order $order)
    {
        $order->update($request->all());
        $order->save();
        return redirect()->back()->with('success', 'Sửa thành công !');
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        foreach($order->order_details as $orderDetail) {
            $product = Product::find($orderDetail->product_id);
            $product->inventory_quantity += $orderDetail->quantity;
            $product->save();
        }

        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Xóa thành công !');
    }
}
