@extends('frontend.master')
@section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Cart</h2>
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
                                        <th class="product-remove">&nbsp;</th>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Sub Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cartItems as $item)
                                        <tr class="cart_item">
                                        <td class="product-remove">
                                            <a title="Remove this item" class="remove" href="{{route('cart.delete', $item->id)}}">×</a>
                                        </td>

                                        <td class="product-thumbnail">
                                            <a href="">
                                                @foreach($item->associatedModel as $key => $image)
                                                    @if($key == 0)
                                                        <img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="{{'storage/'.$image->url}}">
                                                    @endif
                                                @endforeach
                                            </a>
                                        </td>

                                        <td class="product-name">
                                            <a href="{{route('single_product', $item->id)}}">{{$item->name}}</a>
                                        </td>

                                        <td class="product-price">
                                            <span class="amount">£{{number_format($item->price, 2)}}</span>
                                        </td>

                                        <td class="product-quantity">
                                            <div class="quantity buttons_added" style="width: 120px">
                                                <a href="{{route('cart.decrease_by_one', $item->id)}}"><input type="button" class="minus" value="-"></a>
                                                <input disabled type="number" size="4" class="input-text qty text" title="Qty" value="{{$item->quantity}}" min="0" step="1">
                                                <a href="{{route('cart.increase_by_one', $item->id)}}"><input type="button" class="plus" value="+"></a>
                                            </div>
                                        </td>

                                        <td class="product-subtotal">
                                            <span class="amount">£{{number_format($item->price * $item->quantity, 2)}}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class="actions" colspan="6">
                                            <div class="coupon">
                                                <form action="{{route('apply_coupon')}}" method="post">
                                                    @csrf
                                                    <label for="coupon_code">Coupon:</label>
                                                    <input type="text" placeholder="Coupon code" value="{{session()->has('coupon') ? session()->get('coupon')->code : ''}}" id="coupon_code" class="input-text" name="coupon_code">
                                                    <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">
                                                </form>
                                                <br>
                                                @if(session('notify_success'))
                                                    <div class="alert alert-success">
                                                        {{session('notify_success')}}
                                                    </div>
                                                @endif
                                                @if(session('notify_failed'))
                                                    <div class="alert alert-danger">
                                                        {{session('notify_failed')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            <div class="cart-collaterals">

                                <div class="cart_totals ">
                                    <h2>Cart Totals</h2>

                                    <table cellspacing="0">
                                        <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td><span class="amount">£{{number_format($subTotal, 2)}}</span></td>
                                        </tr>

                                        <tr class="shipping">
                                            <th>Discount</th>
                                            <td>{{session()->has('coupon') ? session()->get('coupon')->discount : 0}}%</td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span class="amount">£{{number_format($subTotal * (100 - (session()->has('coupon') ? session()->get('coupon')->discount : 0)) / 100, 2)}}</span></strong> </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <div>
                                        <a href="{{route('checkout')}}"><button class="btn btn-lg btn-primary">Checkout</button></a>
                                    </div>
                                </div>
                            </div>
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