<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::orderBy('created_at', 'desc')->get();
        return view('backend.coupons.index', compact('coupons'));
    }


    public function create()
    {
        return view('backend.coupons.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:coupons,code',
            'start_date' => 'required',
            'end_date' => 'required',
        ], [
            'code.required' => 'Vui lòng nhập code'
        ]);

        Coupon::create($request->all());
        return redirect()->back()->with('success', 'Thêm thành công !');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('backend.coupons.edit', compact('coupon'));
    }


    public function update(Request $request, Coupon $coupon)
    {
        $this->validate($request, [
            'code' => 'required|unique:coupons,code,'.$coupon->id.'',
            'start_date' => 'required',
            'end_date' => 'required',
        ], [
            'code.required' => 'Vui lòng nhập code'
        ]);

        $coupon->update($request->all());
        $coupon->save();
        return redirect()->back()->with('success', 'Sửa thành công !');
    }


    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();

        return redirect()->route('coupons.index')->with('success', 'Xóa thành công !');
    }
}
