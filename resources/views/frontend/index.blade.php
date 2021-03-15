@extends('frontend.master')
@section('content')
    <div class="slider-area">
        <!-- Slider -->
        <div class="block-slider block-slider4">
            <ul class="" id="bxslider-home4">
                <li>
                    <img src="assets/frontend/img/h4-slide.png" alt="Slide" style="height: 500px;">

                </li>
                <li><img src="assets/frontend/img/h4-slide2.png" alt="Slide" style="height: 500px;">

                </li>
                <li><img src="assets/frontend/img/h4-slide3.png" alt="Slide" style="height: 500px;">

                </li>
                <li><img src="assets/frontend/img/h4-slide4.png" alt="Slide" style="height: 500px;">

                </li>
            </ul>
        </div>
        <!-- ./Slider -->
    </div> <!-- End slider area -->

    <div class="promo-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo1">
                        <i class="fa fa-refresh"></i>
                        <p>30 Days return</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo2">
                        <i class="fa fa-truck"></i>
                        <p>Free shipping</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo3">
                        <i class="fa fa-lock"></i>
                        <p>Secure payments</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo promo4">
                        <i class="fa fa-gift"></i>
                        <p>New products</p>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End promo area -->

    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Latest Products</h2>
                        <div class="product-carousel">
                            @foreach($latestProducts as $product)
                                <div class="single-product">
                                <div class="product-f-image">
                                        @foreach($product->image as $key => $image)
                                            @if($key == 0)
                                                <img src="{{url('storage/' . $image->url)}}" alt="" style="width: 300px; height: 200px">
                                            @endif
                                        @endforeach
                                    <div class="product-hover">
                                        <a href="{{route('single_product', $product->id)}}" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                    </div>
                                </div>

                                <h2><a href="{{route('single_product', $product->id)}}">{{$product->name}}</a></h2>

                                <div class="product-carousel-price">
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
            </div>
        </div>
    </div> <!-- End main content area -->

    <div class="brands-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-wrapper">
                        <div class="brand-list">
                            <img src="assets/frontend/img/brand1.png" alt="">
                            <img src="assets/frontend/img/brand2.png" alt="">
                            <img src="assets/frontend/img/brand3.png" alt="">
                            <img src="assets/frontend/img/brand4.png" alt="">
                            <img src="assets/frontend/img/brand5.png" alt="">
                            <img src="assets/frontend/img/brand6.png" alt="">
                            <img src="assets/frontend/img/brand1.png" alt="">
                            <img src="assets/frontend/img/brand2.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End brands area -->

    <div class="product-widget-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Top Sellers</h2>
                        <a href="" class="wid-view-more">View All</a>
                        @foreach($topSellerProducts as $product)
                            <div class="single-wid-product">
                                <a href="{{route('single_product', $product->product_id)}}">
                                    @foreach(\App\Models\Product::find($product->product_id)->image as $key => $image)
                                        @if($key == 0)
                                            <img src="{{url('storage/' . $image->url)}}" alt="" style="width: 200px; height: 200px">
                                        @endif
                                    @endforeach
                                </a>
                                <h2><a href="{{route('single_product', $product->product_id)}}">{{$product->name}}</a> ({{$product->total}} sold)</h2>
                                <div class="product-wid-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product-wid-price">
                                    @if(\App\Models\Product::find($product->product_id)->sale_price)
                                        <ins>${{number_format(\App\Models\Product::find($product->product_id)->sale_price, 2)}}</ins> <del>${{number_format(\App\Models\Product::find($product->product_id)->price, 2)}}</del>
                                    @else
                                        <ins>${{number_format(\App\Models\Product::find($product->product_id)->price, 2)}}</ins>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Hot Product</h2>
                        <a href="#" class="wid-view-more">View All</a>
                        @foreach($hotProducts as $product)
                            <div class="single-wid-product">
                                <a href="{{route('single_product', $product->id)}}">
                                    @foreach($product->image as $key => $image)
                                        @if($key == 0)
                                            <img src="{{url('storage/' . $image->url)}}" alt="" style="width: 200px; height: 200px">
                                        @endif
                                    @endforeach
                                </a>
                                <h2><a href="{{route('single_product', $product->id)}}">{{$product->name}}</a></h2>
                                <div class="product-wid-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product-wid-price">
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
                <div class="col-md-4">
                    <div class="single-product-widget">
                        <h2 class="product-wid-title">Feature Product</h2>
                        <a href="#" class="wid-view-more">View All</a>
                        @foreach($featureProducts as $product)
                            <div class="single-wid-product">
                                <a href="{{route('single_product', $product->id)}}">
                                    @foreach($product->image as $key => $image)
                                        @if($key == 0)
                                            <img src="{{url('storage/' . $image->url)}}" alt="" style="width: 200px; height: 200px">
                                        @endif
                                    @endforeach
                                </a>
                                <h2><a href="{{route('single_product', $product->id)}}">{{$product->name}}</a></h2>
                                <div class="product-wid-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product-wid-price">
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
        </div>
    </div> <!-- End product widget area -->
@endsection