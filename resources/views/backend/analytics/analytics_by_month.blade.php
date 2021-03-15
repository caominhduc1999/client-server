@extends('backend.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Analytics By Day</h3>
                    <div class="form-group">
                        <form action="{{route('analytics_by_month')}}" method="get">
                            <div class="row">
                                <br>
                                <div class="col-md-10">
                                    <select class="form-control" name="month" id="">
                                        <option value="">Select Month</option>
                                        @for($i =1; $i <= 12; $i++)
                                            <option value="{{$i}}">{{date("F", mktime(0, 0, 0, $i, 10))}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
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
                            <h3 class="card-title">Income in {{date("F", mktime(0, 0, 0, $month, 10))}} <h2><b>${{number_format($products->sum('total_price'), 2)}}</b></h2></h3>

                            <div class="card-tools">
                                <div>

                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->


                        <div class="card-body">
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
                                                    colspan="1" aria-label="Name: activate to sort column ascending"
                                                    style="width: 30%;">Name
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Price: activate to sort column ascending"
                                                    style="width: 20%;">Price
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Total Quantity: activate to sort column ascending"
                                                    style="width: 20%;">Total Quantity
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Total Price: activate to sort column ascending"
                                                    style="width: 30%;">Total Price
                                                </th>


                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($products as $key => $product)
                                                <tr>
                                                    <td>{{$key + 1}}</td>
                                                    <td><a href="{{route('products.edit', $product->product_id)}}" target="_blank">{{$product->name}}</a></td>
                                                    <td>${{number_format($product->price, 2)}}</td>
                                                    <td>{{$product->total_quantity}}</td>
                                                    <td>${{number_format($product->total_price, 2)}}</td>
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