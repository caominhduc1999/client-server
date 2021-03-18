<?php

namespace App\Http\Controllers;

use App\Models\Import;
use App\Models\User;
use Illuminate\Http\Request;

class ImportController extends Controller
{

    public function index()
    {
        $imports = Import::orderBy('created_at', 'desc')->get();

        return view('backend.imports.index', compact('imports'));
    }


    public function create()
    {
        $vendors = User::where('user_type', 3)->get();
        return view('backend.imports.create', compact('vendors'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:imports,name',
            'vendor_id' => 'required',
            'import_date' => 'required'
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục'
        ]);

        Import::create($request->all());
        return redirect()->back()->with('success', 'Thêm thành công !');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $import = Import::find($id);
        $vendors = User::where('user_type', 3)->get();
        return view('backend.imports.edit', compact('import', 'vendors'));
    }


    public function update(Request $request, Import $import)
    {
        $this->validate($request, [
            'name' => 'required|unique:imports,name,'.$import->id.'',
            'vendor_id' => 'required',
            'import_date' => 'required'
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục'
        ]);

        $import->update($request->all());
        $import->save();
        return redirect()->back()->with('success', 'Sửa thành công !');
    }


    public function destroy($id)
    {
        $import = Import::find($id);
        $import->delete();

        return redirect()->route('imports.index')->with('success', 'Xóa thành công !');
    }
}
