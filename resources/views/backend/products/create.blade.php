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
                    <h3 class="card-title">Add Product</h3>


                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif
                <div class="card-body">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" value="{{old('name')}}">
                                    @if ($errors->has('name'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category</label>
                                    <select class="form-control" name="category_id" id="">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"  @if(old('category_id') == $category->id) selected @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('category_id') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Vendor</label>
                                    <select class="form-control" name="vendor_id" id="">
                                        <option value="">Select Vendor</option>
                                        @foreach($vendors as $vendor)
                                            <option value="{{$vendor->id}}" @if(old('vendor_id') == $vendor->id) selected @endif>{{$vendor->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('vendor_id'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('vendor_id') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Price</label>
                                    <input type="number" name="price" class="form-control" id="exampleInputEmail1" placeholder="Enter price" value="{{old('price')}}">
                                    @if ($errors->has('price'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('price') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sale Price</label>
                                    <input type="number" name="sale_price" class="form-control" id="exampleInputEmail1" placeholder="Enter sale price" value="{{old('sale_price')}}">
                                    @if ($errors->has('sale_price'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('sale_price') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Image</label>
                                    <input type="file" multiple name="image[]" class="form-control" id="exampleInputEmail1" >
                                    @if ($errors->has('image'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('image') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Inventory Quantity</label>
                                    <input type="number" name="inventory_quantity" class="form-control" id="exampleInputEmail1" placeholder="Enter Inventory Quantity" value="{{old('inventory_quantity')}}">
                                    @if ($errors->has('inventory_quantity'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('inventory_quantity') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <textarea name="description" id="" cols="30" rows="10"></textarea>
                                    @if ($errors->has('description'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('description') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Notes</label>
                                    <textarea name="notes" id="" cols="30" rows="10"></textarea>
                                    @if ($errors->has('notes'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('notes') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hot</label>
                                    <select class="form-control" name="is_hot" id="">
                                        <option value="0" @if(old('is_hot') == 0) selected @endif>Deactive</option>
                                        <option value="1" @if(old('is_hot') == 1) selected @endif>Active</option>
                                    </select>
                                    @if ($errors->has('is_hot'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('is_hot') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Feature</label>
                                    <select class="form-control" name="is_feature" id="">
                                        <option value="0" @if(old('is_hot') == 0) selected @endif>Deactive</option>
                                        <option value="1" @if(old('is_hot') == 1) selected @endif>Active</option>
                                    </select>
                                    @if ($errors->has('is_feature'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('is_feature') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tag</label>
                                    <br>
                                    @foreach($tags as $tag)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="tags[]" value="{{$tag->id}}">
                                            <label class="form-check-label">{{$tag->name}}</label>
                                        </div>
                                    @endforeach
                                    @if ($errors->has('tag'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('tag') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
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
@section('scripts')

@endsection