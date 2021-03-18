@extends('backend.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Orders Detail</h3>

                    <div class="card-tools">
                    <a href="{{route('order_details.create')}}">
                    <button class="btn btn-outline-primary">Add New</button>
                    </a>
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
                            <h3 class="card-title">List</h3>

                            <div class="card-tools">
                                <div>

                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->


                        <div class="card-body">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fa fa-text-width"></i>
                                        Customer Infomation
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <dl>
                                        <dt>Name</dt>
                                        <dd>{{$order->name}}</dd>
                                        <dt>Phone</dt>
                                        <dd>{{$order->phone}}</dd>
                                        <dt>Email</dt>
                                        <dd>{{$order->email}}</dd>
                                        <dt>Address</dt>
                                        <dd>{{$order->address}}</dd>
                                    </dl>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <hr>
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable"
                                               role="grid" aria-describedby="example1_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="ID: activate to sort column descending"
                                                    style="width: 10%;">ID
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Image: activate to sort column ascending"
                                                    style="width: 30%;">Image
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Product: activate to sort column ascending"
                                                    style="width: 50%;">Product
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Quantity: activate to sort column ascending"
                                                    style="width: 70%;">Quantity
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($orderDetails as $key => $orderDetail)
                                                <tr>
                                                    <td>{{ $key + 1}}</td>
                                                    <td>
                                                        <img src="{{url('storage/' . \App\Models\Product::find($orderDetail->product_id)->image[0]->url)}}" style="width: 100px; height: 100px;" alt="">
                                                    </td>
                                                    <td>{{\App\Models\Product::find($orderDetail->product_id)->name}}</td>
                                                    <td>{{$orderDetail->quantity}}</td>
                                                </tr>
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