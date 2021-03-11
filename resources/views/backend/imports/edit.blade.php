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
                    <h3 class="card-title">Edit Import</h3>


                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                <div class="card-body">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Import</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="{{ route('imports.update', $import->id) }}">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="{{$import->name}}">
                                    @if ($errors->has('name'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Vendor</label>
                                    <select class="form-control" name="vendor_id" id="">
                                        <option value="">Select Vendor</option>
                                        @foreach($vendors as $vendor)
                                            <option value="{{$vendor->id}}" @if($import->vendor_id == $vendor->id) selected @endif >{{$vendor->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('vendor_id'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('vendor_id') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Import Date</label>
                                    <input type="date" name="import_date" class="form-control" id="exampleInputEmail1" value="{{$import->import_date}}">
                                    @if ($errors->has('import_date'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('import_date') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Notes</label>
                                        <textarea name="notes" id="" cols="30" rows="10">{!! $import->notes !!}</textarea>
                                        @if ($errors->has('notes'))
                                            <div class="alert alert-danger">
                                                {{ $errors->first('notes') }}
                                            </div>
                                        @endif
                                    </div>
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