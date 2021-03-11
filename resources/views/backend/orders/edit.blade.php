@extends('backend.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Order</h3>


                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                <div class="card-body">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Order</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="{{ route('orders.update', $order->id) }}"  enctype="multipart/form-data">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">User</label>
                                    <select class="form-control" name="user_id" id="">
                                        <option value="">Select User</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" @if($order->user_id = $user->id) selected @endif>{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('user_id'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('user_id') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Total</label>
                                    <input type="number" name="total" class="form-control" id="exampleInputEmail1" placeholder="Enter price" value="{{$order->total}}">
                                    @if ($errors->has('total'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('total') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone</label>
                                    <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Enter phone" value="{{$order->phone}}">
                                    @if ($errors->has('phone'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('phone') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="{{$order->email}}">
                                    @if ($errors->has('email'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address</label>
                                    <textarea name="address" id="" cols="30" rows="10">{!! $order->address !!}</textarea>
                                    @if ($errors->has('address'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('address') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Notes</label>
                                    <textarea name="notes" id="" cols="30" rows="10">{!! $order->notes !!}</textarea>
                                    @if ($errors->has('notes'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('notes') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Status</label>
                                    <select class="form-control" name="status" id="">
                                        <option value="">Select Status</option>
                                        <option value="0" @if($order->status == 0) selected @endif>Pending</option>
                                        <option value="1" @if($order->status == 1) selected @endif>Confirming</option>
                                        <option value="2" @if($order->status == 2) selected @endif>Preparing</option>
                                        <option value="3" @if($order->status == 3) selected @endif>Shipping</option>
                                        <option value="4" @if($order->status == 4) selected @endif>Done</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('status') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Payment Method</label>
                                    <select class="form-control" name="payment_method_id" id="">
                                        <option value="">Select Payment Method</option>
                                        @foreach($paymentMethods as $paymentMethod)
                                            <option value="{{$paymentMethod->id}}" @if($order->payment_method_id = $paymentMethod->id) selected @endif>{{$paymentMethod->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('payment_method_id'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('payment_method_id') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection