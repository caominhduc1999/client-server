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
                    <div class="product-content-right">


                        <div class="row">
                            <div class="col-sm-6">
                                <div class="product-images" >
                                    <div class="product-main-img">
                                        @foreach($product->image as $key => $image)
                                            @if($key == 0)
                                                <img id="focus" src="{{url('storage/' . $image->url)}}" alt="">
                                            @endif
                                        @endforeach

                                    </div>


                                    <div class="product-gallery gallery" >
                                            <div class="thumbnails" >
                                        @foreach($product->image as $image)
                                                <img src="{{url('storage/' . $image->url)}}" alt="">
                                        @endforeach
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <style>
                                gallery {
                                    margin: 5px;
                                    border: 1px solid #ccc;
                                    float: left;
                                    width: 180px;
                                }

                                .gallery img:hover {
                                    border: 1px solid #777;

                                }


                                .gallery img {
                                    width: 25%;
                                    height: 80px;
                                }

                                .focus {
                                    position: fixed;
                                    text-align: center;
                                    vertical-align: center;
                                    margin-left: 50px;
                                    margin-top: 100px;
                                    border: 4px solid white;
                                }
                            </style>
                            <script>
                                window.onload = function () {
                                    var imgs = document.getElementsByTagName('img');
                                    for(var i=0 ; i<imgs.length ; i++){
                                        var img = imgs[i];
                                        img.onclick = function () {
                                            newSrc = this.src;
                                            focus = document.getElementById('focus');
                                            focus.src = newSrc;
                                        }
                                    }
                                }
                            </script>


                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h2 class="product-name">{{$product->name}}</h2>
                                    <div class="product-inner-price">
                                        @if($product->sale_price)
                                            <ins>${{number_format($product->sale_price, 2)}}</ins> <del>${{number_format($product->price, 2)}}</del>
                                        @else
                                            <ins>${{number_format($product->price, 2)}}</ins>
                                        @endif
                                    </div>
                                    <div class="product-inner-price">
                                        Remain Quantity: {{$product->inventory_quantity}}
                                    </div>
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{session('success')}}
                                        </div>
                                    @endif
                                    @if($product->inventory_quantity != 0)
                                    <form action="{{route('cart.add')}}" method="post" class="cart" style="display: grid">
                                        @csrf
                                        <input type="hidden" name="productId" value="{{$product->id}}">
                                        <div class="quantity">
                                            <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                        </div>
                                        <br>
                                        <div>
                                            <button class="add_to_cart_button" type="submit">Add to cart</button>
                                        </div>
                                    </form>
                                        @if ($errors->has('quantity'))
                                            <div class="alert alert-danger">
                                                {{ $errors->first('quantity') }}
                                            </div>
                                        @endif

                                    @else
                                        <button class="add_to_cart_button" type="button">Out of Stock</button>
                                        <hr>
                                    @endif
                                    <form action="{{route('add_wish_list', $product->id)}}" method="get" class="cart">
                                        @csrf
                                        <button style="background-color: hotpink" class="add_to_cart_button" type="submit">Add to Wish List</button>
                                    </form>
                                    <div class="product-inner-category">
                                        <p>Category: <a href="{{route('shop', $product->category->id)}}">{{$product->category->name}}</a>.
                                            Tags:
                                            @foreach($product->tags as $tag)
                                                <a href="">{{$tag->name}}</a>,
                                            @endforeach
                                        </p>
                                    </div>

                                    <div role="tabpanel">
                                        <ul class="product-tab" role="tablist">
                                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                <h2>Product Description</h2>
                                                <p>{!! $product->description !!}</p>
                                                </div>
                                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                                <h2>Reviews</h2>
                                                @foreach($product->comment as $comment)
                                                    <b>By {{\App\Models\User::find($comment->user_id)->name}} ({{$comment->created_at->diffForHumans()}})</b>
                                                    <p>{!! $comment->body !!}</p>
                                                    <hr>
                                                @endforeach
                                                @if(\Illuminate\Support\Facades\Auth::check())
                                                <div class="submit-review">
                                                    <form action="{{route('product_review', $product->id)}}" method="post">
                                                        @csrf
                                                        <p><label for="review">Your review</label>
                                                            <textarea name="review" id="" cols="30" rows="10"></textarea>
                                                        </p>
                                                        <p><input type="submit" value="Submit"></p>
                                                    </form>
                                                </div>
                                                @else
                                                    <div class="submit-review">
                                                        <a href="{{route('login')}}"><button class="add_to_cart_button" type="button">Login to write Review</button></a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="related-products-wrapper">
                            <h2 class="related-products-title">Related Products</h2>
                            <div class="related-products-carousel">
                                @foreach($relateProducts as $key => $product)
                                    <div class="single-product">
                                    <div class="product-f-image">
                                        @foreach($product->image as $key => $image)
                                            @if($key == 0)
                                                <img src="{{url('storage/' . $image->url)}}" alt="" style="height: 200px">
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
        </div>
    </div>
@endsection