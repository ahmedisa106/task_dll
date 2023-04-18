@extends('dashboard.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{asset('assets/dashboard/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <small>Products</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Products</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">
                    <div class="box-header">
                        @permission('create_products')
                        <a href="{{route('dashboard.products.create',request()->category)}}" class="btn btn-success"> Create New Product <i class="fa fa-plus"></i></a>

                        @endpermission
                        @if($session = session('success'))
                            <div class="text-center alert alert-success text-capitalize" style="margin-top: 10px">
                                {{$session  }}
                            </div>
                        @endif

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>

                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td>
                                        {{$product->name}}
                                    </td>
                                    <td>
                                        {{number_format($product->price,2,',')}}
                                    </td>
                                    <td>
                                        {{@$product->category->name?:""}}
                                    </td>

                                    <td>

                                        @permission('update_products')
                                        <a href="{{route('dashboard.products.edit',[request()->category,$product->id])}}" class="btn btn-primary">Edit</a>
                                        @endpermission
                                        @permission('delete_products')
                                        <form action="{{route('dashboard.products.destroy',[request()->category,$product->id])}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button onclick="return confirm('are you sure !')" type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                        @endpermission

                                    </td>

                                </tr>
                            @endforeach


                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
@push('js')
    <script src="{{asset('assets/dashboard/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/dashboard/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

    <script>
        $('#example1').DataTable();
    </script>
@endpush
