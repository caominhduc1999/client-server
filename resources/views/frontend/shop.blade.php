@extends('frontend.master')
@section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shop</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">

                <x-sidebar></x-sidebar>

                <div class="col-md-8">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    @foreach($products as $product)
                        <div class="col-md-4 col-sm-6">
                        <div class="single-shop-product">
                            <div class="product-upper">
                                @foreach($product->image as $key => $image)
                                    @if($key == 0)
                                        <img src="{{url('storage/' . $image->url)}}" alt="" style="height: 200px; width: 100%">
                                    @endif
                                @endforeach
                            </div>
                            <h2><a href="{{route('single_product', $product->id)}}">{{$product->name}}</a></h2>
                            <div class="product-carousel-price">
                                <ins>${{number_format($product->sale_price, 2)}}</ins> <del>${{number_format($product->price, 2)}}</del>
                            </div>

                            <div class="product-option-shop">
                                <form action="{{route('cart.add')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="productId" value="{{$product->id}}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" style="width: 100%">
                                        Add to cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="product-pagination text-center">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection