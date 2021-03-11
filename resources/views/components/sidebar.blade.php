<div>
    <div class="col-md-4">
        <div class="single-sidebar">
            <h2 class="sidebar-title">Search Products</h2>
            <form action="{{route('search')}}" method="get">
                <input type="text" placeholder="Search products..." name="search">
                <input type="submit" value="Search">
            </form>
        </div>

        <div class="single-sidebar">
            <h2 class="sidebar-title">Categories</h2>
            <ul>
                @foreach($categories as $category)
                    <li><a href="{{route('shop', $category->id)}}">{{$category->name}}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="single-sidebar">
            <h2 class="sidebar-title">Hot Products</h2>
            @foreach($hotProducts as $product)
                <div class="thubmnail-recent">
                @foreach($product->image as $key => $image)
                    @if($key == 0)
                        <img class="recent-thumb" src="{{url('storage/' . $image->url)}}" alt="">
                    @endif
                @endforeach
                <h2><a href="{{route('single_product', $product->id)}}">{{$product->name}}</a></h2>
                <div class="product-sidebar-price">
                    @if($product->sale_price)
                        <ins>${{number_format($product->sale_price, 2)}}</ins> <del>${{number_format($product->price, 2)}}</del>
                    @else
                        <ins>${{number_format($product->price, 2)}}</ins>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>