@extends('backend.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Customer Order History</h3>
                    <div class="form-group">

                    </div>
                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                <div class="card-body">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Customer Order History</h3>
                            Spend Total:

                                <h2>${{number_format($orders->sum('total'),2)}}</h2>

                        </div>
                        <!-- /.card-header -->


                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-light dataTable"
                                               role="grid" aria-describedby="example1_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Name: activate to sort column ascending"
                                                    style="width: 30%;">Product
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Email: activate to sort column ascending"
                                                    style="width: 20%;">Name
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Phone: activate to sort column ascending"
                                                    style="width: 20%;">Quantity
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Total Price: activate to sort column ascending"
                                                    style="width: 30%;">SubTotal
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($orders as $order)
                                                <tr>
                                                    <td>Order number: {{$order->id}}</td>
                                                    <td> </td>
                                                    <td> </td>

                                                </tr>
                                                @foreach($order->order_details as $orderItem)
                                                    <tr>
                                                        <td>
                                                            @foreach($orderItem->product->image as $key => $image)
                                                                @if($key == 0)
                                                                    <img width="50" height="50" alt="poster_1_up" class="shop_thumbnail" src="{{'storage/'.$image->url}}">
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>{{$orderItem->name}}</td>
                                                        <td>{{$orderItem->quantity}}</td>
                                                        <td>£{{number_format($orderItem->price, 2)}}</td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection