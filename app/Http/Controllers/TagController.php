<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;


class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('created_at', 'desc')->get();
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
        ]);

        Tag::create($request->all());
        return redirect()->back()->with('success', 'Added Successfully !');
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
        ]);

        $tag->update($request->all());
        $tag->save();
        return redirect()->back()->with('success', 'Updated Successfully !');
    }


    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->products()->detach();
        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Deleted Successfully !');
    }
}
