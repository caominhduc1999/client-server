@extends('frontend.master')
@section('content')
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shopping Cart</h2>
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
                        <div class="woocommerce">

                            @if (session()->has('success'))
                                <div class="alert alert-success text-center">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <p>{{ session()->get('success') }}</p>
                                </div>
                            @endif


                            <form enctype="multipart/form-data" action="{{route('profile.post')}}" class="checkout" method="post" name="checkout">
                                @csrf
                                <div id="customer_details" class="col2-set">
                                    <div class="">
                                        <div class="woocommerce-billing-fields ml-5">

                                            <h1 style="text-align: center">Profile</h1>
                                            <br>
                                            <br>
                                            <br>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                        <label class="" for="billing_first_name">Name <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <input type="text" value="{{\Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->name : ''}}" placeholder="" id="billing_first_name" name="name" class="input-text " required>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                                        <label class="" for="billing_last_name">Phone <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <input type="text" value="{{\Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->phone : ''}}" placeholder="" id="billing_last_name" name="phone" class="input-text " required>
                                                    </p>
                                                    <div class="clear"></div>
                                                </div>
                                                <div class="col-md-12">
                                                    <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                                        <label class="" for="billing_last_name">Email <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <input style="width: 100%" type="email" value="{{\Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->email : ''}}" placeholder="" id="billing_last_name" name="email" class="input-text " required>
                                                    </p>
                                                    <div class="clear"></div>
                                                </div>
                                                <div class="col-md-12">
                                                    <p id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
                                                        <label class="" for="billing_address_1">Address <abbr title="required" class="required">*</abbr>
                                                        </label>
                                                        <input type="text" value="{{\Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->address : ''}}" placeholder="Street address" id="billing_address_1" name="address" class="input-text " required>
                                                    </p>
                                                </div>
                                                <div class="form-row place-order">
                                                    <input type="submit" data-value="Place order" value="Update" id="place_order" class="button alt">
                                                </div>

                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection