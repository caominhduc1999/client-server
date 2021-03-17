<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('index')}}" target="_blank" class="brand-link">


        <span class="brand-text font-weight-light">Go to Home Page <i class="fa fa-arrow-circle-o-right"></i></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="info">
                <a href="{{route('profile.get')}}" class="d-block">Hello {{\Auth::user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @if(\Illuminate\Support\Facades\Auth::user()->user_type == 1)
                <li class="nav-item">
                    <a href="/admin" class="nav-link">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('categories.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-list"></i>
                        <p>
                            Categories
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('comments.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-comment"></i>
                        <p>
                            Comments
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{route('imports.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-truck"></i>
                        <p>
                            Imports
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('import_details.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-book"></i>
                        <p>
                            Import Detail
                        </p>
                    </a>
                </li>
                @if(\Illuminate\Support\Facades\Auth::user()->user_type == 1)
                <li class="nav-item">
                    <a href="{{route('orders.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-shopping-cart"></i>
                        <p>
                            Orders
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('payment_methods.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-paypal"></i>
                        <p>
                            Payment Methods
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{route('products.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-server"></i>
                        <p>
                            Products
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('tags.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-tags"></i>
                        <p>
                            Tags
                        </p>
                    </a>
                </li>
                @if(\Illuminate\Support\Facades\Auth::user()->user_type == 1)
                <li class="nav-item">
                    <a href="{{route('coupons.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-diamond"></i>
                        <p>
                            Coupons
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('users.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview menu-open">
                    <a class="nav-link">
                        <i class="nav-icon fa fa-cc-discover"></i>
                        <p>
                            Analytics
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: block;">
                        <li class="nav-item">
                            <a href="{{route('analytics_by_day')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>By Day</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('analytics_by_month')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>By Month</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('analytics_loyal_customer')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Loyal Customer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('analytics_imports')}}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Imports</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>