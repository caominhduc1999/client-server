<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;


class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('backend.tags.index', compact('tags'));
    }


    public function create()
    {
        return view('backend.tags.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags,name'
        ], [
            'name.required' => 'Vui lòng nhập tên tag'
        ]);

        Tag::create($request->all());
        return redirect()->back()->with('success', 'Thêm thành công !');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('backend.tags.edit', compact('tag'));
    }


    public function update(Request $request, Tag $tag)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags,name,'.$tag->id.''
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục'
        ]);

        $tag->update($request->all());
        $tag->save();
        return redirect()->back()->with('success', 'Sửa thành công !');
    }


    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Xóa thành công !');
    }
}
