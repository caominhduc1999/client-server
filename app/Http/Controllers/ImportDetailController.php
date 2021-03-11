<?php

namespace App\Http\Controllers;

use App\Models\Import;
use App\Models\ImportDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ImportDetailController extends Controller
{

    public function index()
    {
        $importDetails = ImportDetail::all();
        return view('backend.import_details.index', compact('importDetails'));
    }


    public function create()
    {
        $imports = Import::all();
        $products = Product::all();
        return view('backend.import_details.create', compact('imports', 'products'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'import_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|min:0'
        ], [
            'import_id.required' => 'Vui lòng nhập tên nhà cung cấp'
        ]);

        ImportDetail::create($request->all());
        return redirect()->back()->with('success', 'Thêm thành công !');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $importDetail = ImportDetail::find($id);
        $imports = Import::all();
        $products = Product::all();
        return view('backend.import_details.edit', compact('importDetail', 'imports', 'products'));
    }


    public function update(Request $request, ImportDetail $importDetail)
    {
        $this->validate($request, [
            'import_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|min:0'
        ], [
            'import_id.required' => 'Vui lòng nhập tên nhà cung cấp'
        ]);

        $importDetail->update($request->all());
        $importDetail->save();
        return redirect()->back()->with('success', 'Sửa thành công !');
    }

    public function destroy($id)
    {
        $importDetail = ImportDetail::find($id);
        $importDetail->delete();

        return redirect()->route('import_details.index')->with('success', 'Xóa thành công !');
    }
}
