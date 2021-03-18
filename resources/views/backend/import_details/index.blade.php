@extends('backend.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Import Details</h3>

                    <div class="card-tools">
                        <a href="{{route('import_details.create')}}">
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
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Import</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Import Price</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($importDetails as $key => $importDetail)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$importDetail->import->name}}</td>
                                        <td>{{$importDetail->product->name}}</td>
                                        <td>{{$importDetail->quantity}}</td>
                                        <td>${{number_format($importDetail->import_price, 2)}}</td>
                                        <td style="display: flex">
                                            <a href="{{route('import_details.edit', $importDetail->id)}}"><button class="btn btn-outline-warning">Edit</button></a>
                                            <form action="{{ route('import_details.destroy',  $importDetail->id) }}" method="POST">
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
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection