@extends('dashboard.layouts.master')
@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Create New Admin</h3>
            </div>
            <div class="box-body">
                <!-- Color Picker -->
                <div class="row">
                    <form action="{{route('dashboard.products.store',request('category')->id)}}" method="post">
                        @csrf

                        <input type="hidden" name="category_id" value="{{request('category')->id}}">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>name</label>
                                <input type="text" value="{{old('name')}}" class="form-control" name="name">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" value="{{old('price')}}" class="form-control" name="price">
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
