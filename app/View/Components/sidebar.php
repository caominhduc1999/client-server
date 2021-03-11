<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\Component;

class sidebar extends Component
{
    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $hotProducts = Product::where('is_hot', 1)->get();
        return view('components.sidebar', ['categories' => Category::all(), 'hotProducts' => $hotProducts]);
    }
}
