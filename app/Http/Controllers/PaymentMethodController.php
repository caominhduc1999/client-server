<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::orderBy('created_at', 'desc')->get();
        return view('backend.payment_methods.index', compact('paymentMethods'));
    }


    public function create()
    {
        return view('backend.payment_methods.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:payment_methods,name'
        ]);

        PaymentMethod::create($request->all());
        return redirect()->back()->with('success', 'Added Successfully !');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $paymentMethod = PaymentMethod::find($id);
        return view('backend.payment_methods.edit', compact('paymentMethod'));
    }


    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $this->validate($request, [
            'name' => 'required|unique:payment_methods,name,'.$paymentMethod->id.''
        ]);

        $paymentMethod->update($request->all());
        $paymentMethod->save();
        return redirect()->back()->with('success', 'Updated Successfully !');
    }


    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::find($id);
        $paymentMethod->delete();

        return redirect()->route('payment_methods.index')->with('success', 'Deleted Successfully !');
    }
}
