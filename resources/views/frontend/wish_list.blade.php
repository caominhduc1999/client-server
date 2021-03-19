@extends('frontend.master')
@section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Wish List</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Page title area -->

    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">

                <x-sidebar></x-sidebar>

                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{session('success')}}
                                </div>
                            @endif
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                <tr>
                                    <th class="product-name"> </th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Name</th>
                                    <th class="product-quantity">Price</th>
                                    <th class="product-subtotal">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($favorites as $favorite)
                                        <tr class="cart_item">
                                            <td class="product-remove">
                                                <a title="Remove this item" class="remove" href="{{route('remove_wish_list', $favorite->id)}}">×</a>
                                            </td>
                                            <td class="product-thumbnail">
                                                <a href="{{route('single_product', $favorite->product->id)}}">
                                                    @foreach($favorite->product->image as $key => $image)
                                                        @if($key == 0)
                                                            <img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="{{'storage/'.$image->url}}">
                                                        @endif
                                                    @endforeach
                                                </a>
                                            </td>
                                            <td class="product-name">
                                                <a href="{{route('single_product', $favorite->product->id)}}">{{$favorite->product->name}}</a>
                                            </td>

                                            <td class="product-price">
                                                <span class="amount">${{number_format($favorite->product->sale_price ? $favorite->product->sale_price : $favorite->product->price, 2)}}</span>
                                            </td>
                                            <td class="product-price">
                                                <form action="{{route('cart.add')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="quantity" value="1">
                                                    <input type="hidden" name="productId" value="{{$favorite->product->id}}">
                                                    <button class="btn btn-primary">Add To Cart</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection