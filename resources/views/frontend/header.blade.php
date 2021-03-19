<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="user-menu">
                    <ul>
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <li><a href="{{route('wish_list')}}"><i class="fa fa-heart"></i> Wishlist</a></li>
                        @endif
                        <li><a href="{{route('cart')}}"><i class="fa fa-shopping-cart"></i> My Cart</a></li>
                        <li><a href="{{route('checkout')}}"><i class="fa fa-check-circle"></i> Checkout</a></li>
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <li><a href="{{route('profile.client.get')}}"><i class="fa fa-user"></i> {{\Auth::user()->name}}</a></li>
                            <li><a href="{{route('logout')}}"><i class="fa fa-sign-out"></i> Logout</a></li>
                        @else
                            <li><a href="{{route('login')}}"><i class="fa fa-user"></i> Login</a></li>
                            <li><a href="{{route('register')}}"><i class="fa fa-user"></i> Register</a></li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End header area -->

<div class="site-branding-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="logo">
                    <h1><a href=".."><img src="assets/frontend/img/logo.png"></a></h1>
                </div>
            </div>

            <div class="col-sm-6">

                <div class="shopping-item">
                    <a href="{{route('cart')}}">Cart -
                        <span class="cart-amunt">${{\Cart::session(\Auth::check() ? \Auth::id() : session()->getid())->getTotal()}}</span>
                        <i class="fa fa-shopping-cart"></i>
                        <span class="product-count">{{\Cart::session(\Auth::check() ? \Auth::id() : session()->getid())->getContent()->count()}}</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div> <!-- End site branding area -->

<div class="mainmenu-area">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{route('index')}}">Home</a></li>
                    <li><a href="{{route('shop')}}">Shop page</a></li>
                    <li><a href="{{route('cart')}}">Cart</a></li>
                    <li><a href="{{route('checkout')}}">Checkout</a></li>
                    <li><a href="{{route('order_history')}}">Order History</a></li>
                    <li><a href="{{route('wish_list')}}">Wish List</a></li>
                </ul>
            </div>
        </div>
    </div>
</div> <!-- End mainmenu area -->