<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('backend.products.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $vendors = User::where('user_type', 3)->get();
        return view('backend.products.create', compact('categories', 'vendors', 'tags'));
    }


    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|unique:products,name',
                'price' => 'min:0|nullable',
                'sale_price' => 'min:0|nullable',
                'inventory_quantity' => 'min:0|nullable',
                'description' => 'nullable',
                'notes' => 'nullable',
                'category_id' => 'required',
                'vendor_id' => 'required'
            ],
            [
                'name.required' => 'Vui lòng nhập tên'
            ]);

        $product = Product::create($request->all());
        foreach($request->image as $file) {
            $path = $file->store('product_images');
            $product->image()->create(['url' => $path]);
        }

        foreach ($request->tags as $tag_id) {
            $product->tags()->attach(intval($tag_id));
        }
        $product->save();
        return redirect()->back()->with('success', 'Thêm thành công !');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $product = Product::find($id);
        $tags = Tag::all();
        $tag_array = $product->tags->pluck('id')->toArray();
        $categories = Category::all();
        $vendors = User::where('user_type', 3)->get();
        return view('backend.products.edit', compact('product', 'categories', 'vendors', 'tag_array', 'tags'));
    }


    public function update(Request $request, Product $product)
    {
        $this->validate($request,
            [
                'name' => 'required|unique:products,name,'. $product->id .'',
                'price' => 'min:0|nullable',
                'sale_price' => 'min:0|nullable',
                'inventory_quantity' => 'min:0|nullable',
                'description' => 'nullable',
                'notes' => 'nullable',
                'category_id' => 'required',
                'vendor_id' => 'required'
            ],
            [
                'name.required' => 'Vui lòng nhập tên'
            ]);


        $product->update($request->all());

        if ($request->hasFile('image')){ // nếu update ảnh
            $request->validate([
                'image'   =>  'image|mimes:jpg,png,jpeg',
            ]);
            foreach($product->image as $file) {
                Storage::delete($file->url); //xóa ảnh cũ
            }

            Image::where('imageable_type', 'App\Models\Product')->where('imageable_id', $product->id)->delete();
            foreach($request->image as $file) {
                $path = $file->store('product_images');
                $product->image()->create(['url' => $path]);
            }
        }
        foreach ($request->tags as $tag_id) {
            $product->tags()->sync(intval($tag_id));
        }
        $product->save();
        return redirect()->back()->with('success', 'Sửa thành công !');
    }


    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Xóa thành công !');
    }
}
