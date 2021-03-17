@extends('backend.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Comments</h3>

                    <div class="card-tools">

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
                                                    style="width: 5%;">ID
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Product: activate to sort column ascending"
                                                    style="width: 20%;">Product
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Name: activate to sort column ascending"
                                                    style="width: 40%;">Body
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Reviewer: activate to sort column ascending"
                                                    style="width: 20%;">Reviewer
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Reviewer: activate to sort column ascending"
                                                    style="width: 20%;">Time
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Action: activate to sort column ascending"
                                                    style="width: 20%;">Action
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($comments as $key => $comment)
                                                <tr role="row">
                                                    <td>{{$key + 1}}</td>
                                                    <td>{{ ($comment->commentable_type)::find($comment->commentable_id)->name }}</td>
                                                    <td>{{\Illuminate\Support\Str::limit($comment->body, 50)}}</td>
                                                    <td>{{\App\Models\User::find($comment->user_id)->name}}</td>
                                                    <td>{{$comment->created_at}}</td>
                                                    <td style="display: flex">
                                                        <a href="{{route('comments.show', $comment->id)}}">
                                                            <button class="btn btn-outline-primary">Show</button>
                                                        </a>
                                                        <form action="{{ route('comments.destroy',  $comment->id) }}"
                                                              method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button class="btn btn-outline-danger"
                                                                    onclick="return confirm('Xác nhận xóa ?')">Delete
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