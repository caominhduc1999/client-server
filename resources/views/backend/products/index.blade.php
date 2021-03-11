@extends('backend.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Products</h3>

                    <div class="card-tools">
                        <a href="{{route('products.create')}}">
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
                                                    style="width: 70%;">Name
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Price: activate to sort column ascending"
                                                    style="width: 70%;">Price
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Inventory Quantity: activate to sort column ascending"
                                                    style="width: 70%;">Inventory Quantity
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Category: activate to sort column ascending"
                                                    style="width: 70%;">Category
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Vendor: activate to sort column ascending"
                                                    style="width: 70%;">Vendor
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Action: activate to sort column ascending"
                                                    style="width: 20%;">Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($products as $key => $product)
                                                <tr>
                                                    <td>{{$key + 1}}</td>
                                                    <td>{{$product->name}}</td>
                                                    <td>{{number_format($product->price)}}</td>
                                                    <td>{{$product->inventory_quantity}}</td>
                                                    <td>{{$product->category->name}}</td>
                                                    <td>{{$product->vendor->name}}</td>
                                                    <td style="display: flex">
                                                        <a href="{{route('products.edit', $product->id)}}"><button class="btn btn-outline-warning">Edit</button></a>
                                                        <form action="{{ route('products.destroy',  $product->id) }}" method="POST">
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