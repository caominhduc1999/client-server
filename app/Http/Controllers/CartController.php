<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addItem(Request $request)
    {
        $userId = Auth::check() ? Auth::id() : session()->getid();
        $product = Product::find($request->productId);

        $this->validate($request, [
           'quantity' => 'required|lte:'.$product->inventory_quantity
        ]);

        \Cart::session($userId)->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->sale_price ? $product->sale_price : $product->price,
            'quantity' => $request->quantity ? $request->quantity : 1,
            'attributes' => array(),
            'associatedModel' => $product->image
        ));

        return redirect()->back()->with('success', 'Added !');
    }

    public function increaseQuantityByOne($id)
    {
        $userId = Auth::check() ? Auth::id() : session()->getid();
        \Cart::session($userId)->update($id,[
            'quantity' => 1
        ]);
        return redirect()->back();
    }

    public function decreaseQuantityByOne($id)
    {
        $userId = Auth::check() ? Auth::id() : session()->getid();
        if (\Cart::session($userId)->get($id)->quantity == 1) {
            \Cart::session($userId)->remove($id);
        } else {
            \Cart::session($userId)->update($id,[
                'quantity' => -1
            ]);
        }

        return redirect()->back();
    }

    public function deleteItem($id)
    {
        $userId = Auth::check() ? Auth::id() : session()->getid();
        \Cart::session($userId)->remove($id);
        return redirect()->back()->with('success', 'Removed !');
    }
}
