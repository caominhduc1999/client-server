@extends('frontend.master')
@section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Order History</h2>
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

                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Name</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Sub Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr class="cart_item" style="background-color: darkgrey">
                                            <td class="product-thumbnail">
                                                Order number : {{$order->id}}
                                                <br>
                                                ({{$order->payment_method_id == 1 ? 'COD' : 'Stripe'}} - {{$order->payment_status == 0 ? 'Unpaid' : 'Paid'}})
                                            </td>
                                            <td class="product-price">
                                                Order Status: {{$order->getStatusName()}}
                                            </td>
                                            <td class="product-price">
                                                Discount: {{$order->coupon_id != 0 ? $order->coupon->code : 'No applied'}}
                                                <br>
                                                Total: ${{number_format($order->total, 2)}}
                                            </td>
                                            <td class="product-name">
                                                <form action="{{route('re_order')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="reorder_products"
                                                       value="{{ $order->order_details()->get(['product_id', 'quantity']) }}">
                                                <button class="btn btn-primary">Re-Order</button>
                                                </form>
                                            </td>


                                        </tr>
                                        @foreach($order->order_details as $orderItem)
                                            <tr class="cart_item">
                                                <td class="product-thumbnail">
                                                    <a href="{{route('single_product', $orderItem->product->id)}}">
                                                        @foreach($orderItem->product->image as $key => $image)
                                                            @if($key == 0)
                                                                <img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="{{'storage/'.$image->url}}">
                                                            @endif
                                                        @endforeach
                                                    </a>
                                                </td>
                                                <td class="product-name">
                                                    <a href="{{route('single_product', $orderItem->product->id)}}">{{$orderItem->name}}</a>
                                                </td>

                                                <td class="product-price">
                                                    <span class="amount">{{$orderItem->quantity}}</span>
                                                </td>
                                                <td class="product-price">
                                                    <span class="amount">??{{number_format($orderItem->price * $orderItem->quantity, 2)}}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <br>
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