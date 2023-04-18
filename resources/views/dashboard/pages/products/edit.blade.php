@extends('dashboard.layouts.master')
@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Edit Product</h3>
            </div>
            <div class="box-body">
                <!-- Color Picker -->
                <div class="row">
                    <form action="{{route('dashboard.products.update',[$category->id,$product->id])}}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <input type="hidden" name="category_id" value="{{$category->id}}">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>name</label>
                                <input type="text" value="{{old('name',$product->name)}}" class="form-control" name="name">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" value="{{old('price',$product->price)}}" class="form-control" name="price">
                                @error('price')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>

                    </form>
                </div>


            </div>
            <!-- /.box-body -->
        </div>
    </section>

@endsection
