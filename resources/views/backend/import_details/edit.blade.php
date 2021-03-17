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
                    <h3 class="card-title">Edit Import Detail</h3>


                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                <div class="card-body">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Import Detail</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="{{ route('import_details.edit', $importDetail->id) }}">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Import</label>
                                    <select class="form-control" name="import_id" id="">
                                        <option value="">Select Import</option>
                                        @foreach($imports as $import)
                                            <option value="{{$import->id}}" @if($importDetail->import_id == $import->id) selected @endif>{{$import->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('import_id'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('import_id') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Product</label>
                                    <select class="form-control" name="product_id" id="">
                                        <option value="">Select Product</option>
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}" @if($importDetail->product_id == $product->id) selected @endif>{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('product_id'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('product_id') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Quantity</label>
                                    <input type="number" min="0" name="quantity" class="form-control" id="exampleInputEmail1" value="{{$importDetail->quantity}}">
                                    @if ($errors->has('quantity'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('quantity') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Notes</label>
                                        <textarea name="notes" id="" cols="30" rows="10">{!! $importDetail->notes !!}</textarea>
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