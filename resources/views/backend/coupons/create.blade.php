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
                    <h3 class="card-title">Add Coupon</h3>


                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                <div class="card-body">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Coupon</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="{{ route('coupons.store') }}">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Code</label>
                                    <input type="text" name="code" class="form-control" id="exampleInputEmail1" placeholder="Enter code" value="{{old('code')}}">
                                    @if ($errors->has('code'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('code') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Discount(%)</label>
                                    <input type="text" name="discount" class="form-control" id="exampleInputEmail1" placeholder="Enter code" value="{{old('discount')}}">
                                    @if ($errors->has('discount'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('discount') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Start Date</label>
                                    <input type="date" name="start_date" class="form-control" id="exampleInputEmail1" placeholder="Enter code" value="{{old('start_date')}}">
                                    @if ($errors->has('start_date'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('start_date') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">End Date</label>
                                    <input type="date" name="end_date" class="form-control" id="exampleInputEmail1" placeholder="Enter code" value="{{old('end_date')}}">
                                    @if ($errors->has('end_date'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('end_date') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Status</label>
                                    <select class="form-control" name="status" id="">
                                        <option value="">Select Status</option>
                                        <option value="0" @if(old('status') == 0) selected @endif>Deactive</option>
                                        <option value="1" @if(old('status') == 1) selected @endif>Active</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('status') }}
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