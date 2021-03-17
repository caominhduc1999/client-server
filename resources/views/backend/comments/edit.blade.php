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
                    <h3 class="card-title">Comment</h3>


                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                <div class="card-body">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Comment</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Reviewer</label>
                                    <p>{{\App\Models\User::find($comment->user_id)->name}}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product</label>
                                    <p>{{ ($comment->commentable_type)::find($comment->commentable_id)->name }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Comment</label>
                                    <p>{{ $comment->body }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Time</label>
                                    <p>{{ $comment->created_at }}</p>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <a href="{{ url()->previous() }}"><button type="button" class="btn btn-primary">Back</button></a>
                            </div>

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