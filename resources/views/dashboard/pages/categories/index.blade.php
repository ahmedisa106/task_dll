@extends('dashboard.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{asset('assets/dashboard/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <small>Categories</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Categories</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">
                    <div class="box-header">
                        @permission('create_categories')
                        <a href="{{route('dashboard.categories.create')}}" class="btn btn-success"> Create New Category <i class="fa fa-plus"></i></a>
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
                                @permission('read_products')
                                <th>Products</th>
                                @endpermission

                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td>
                                        {{$category->name}}
                                    </td>
                                    @permission('read_products')
                                    <td>
                                        <a href="{{route('dashboard.products.index',[$category->id])}}" class="btn btn-primary">Products ({{$category->products_count}})</a>
                                    </td>
                                    @endpermission

                                    <td>
                                        @permission('update_categories')
                                        <a href="{{route('dashboard.categories.edit',$category->id)}}" class="btn btn-primary">Edit</a>
                                        @endpermission
                                        @permission('delete_categories')
                                        <form action="{{route('dashboard.categories.destroy',$category->id)}}" method="post">
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
