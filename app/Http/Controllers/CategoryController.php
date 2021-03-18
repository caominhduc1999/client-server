<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('backend.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('backend.categories.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name'
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục'
        ]);

        Category::create($request->all());
        return redirect()->back()->with('success', 'Thêm thành công !');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $category = Category::find($id);
        return view('backend.categories.edit', compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name,'.$category->id.''
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục'
        ]);

        $category->update($request->all());
        $category->save();
        return redirect()->back()->with('success', 'Sửa thành công !');
    }


    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Xóa thành công !');
    }
}
