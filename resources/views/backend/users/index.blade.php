@extends('backend.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users</h3>

                    <div class="card-tools">
                        <a href="{{route('users.create')}}">
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

                        <!-- /.card-body -->
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
                                                    colspan="1" aria-label="Email: activate to sort column ascending"
                                                    style="width: 20%;">Email
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Phone: activate to sort column ascending"
                                                    style="width: 20%;">Phone
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Type: activate to sort column ascending"
                                                    style="width: 20%;">Type
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Action: activate to sort column ascending"
                                                    style="width: 20%;">Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($users as $key => $user)
                                                <tr role="row">
                                                    <td>{{$key + 1}}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{$user->phone}}</td>
                                                    <td>{{$user->getUserType()}}</td>
                                                    <td style="display: flex">
                                                        <a href="{{route('users.edit', $user->id)}}">
                                                            <button class="btn btn-outline-warning">Edit</button>
                                                        </a>
                                                        <form action="{{ route('users.destroy',  $user->id) }}"
                                                              method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button class="btn btn-outline-danger"
                                                                    onclick="return confirm('X??c nh???n x??a ?')">Delete
                                                            </button>
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