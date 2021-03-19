@extends('backend.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Orders</h3>

                    {{--<div class="card-tools">--}}
                        {{--<a href="{{route('orders.create')}}">--}}
                            {{--<button class="btn btn-outline-primary">Add New</button>--}}
                        {{--</a>--}}
                    {{--</div>--}}
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
                                                    style="width: 5%;">ID
                                                </th>

                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Total: activate to sort column ascending"
                                                    style="width: 10%;">Total
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Phone: activate to sort column ascending"
                                                    style="width: 20%;">Name
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Payment Method: activate to sort column ascending"
                                                    style="width: 10%;">Payment Method
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Status: activate to sort column ascending"
                                                    style="width: 10%;">Status
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Payment Status: activate to sort column ascending"
                                                    style="width: 5%;">Payment Status
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Action: activate to sort column ascending"
                                                    style="width: 20%;">Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($orders as $key => $order)
                                                <tr>
                                                    <td>{{$key + 1}}</td>
                                                    <td>${{number_format($order->total, 2)}}</td>
                                                    <td>{{$order->name}}</td>
                                                    <td>{{$order->payment_method->name}}</td>
                                                    <td>{{$order->getStatusName()}}</td>
                                                    <td>{{$order->payment_status == 0 ? 'Unpaid' : 'Paid'}}</td>
                                                    <td style="display: flex">
                                                        <a href="{{route('orders.show', $order->id)}}"><button class="btn btn-outline-primary">Show</button></a>
                                                        <a href="{{route('orders.edit', $order->id)}}"><button class="btn btn-outline-warning">Edit</button></a>
                                                        <form action="{{ route('orders.destroy',  $order->id) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button class="btn btn-outline-danger" onclick="return confirm('Xác nhận xóa ?')">Delete</button>
                                                        </form>
                                                    </td>
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