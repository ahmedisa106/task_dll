@extends('dashboard.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{asset('assets/dashboard/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <small>users</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">users</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">
                    <div class="box-header">
                        @permission('create_users')
                        <a href="{{route('dashboard.users.create')}}" class="btn btn-success"> Create New User <i class="fa fa-plus"></i></a>
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
                                <th>email</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $admin)
                                <tr>
                                    <td> {{$loop->iteration}} </td>
                                    <td>
                                        {{$admin->name}}
                                    </td>
                                    <td>{{$admin->email}}</td>
                                    <td>
                                        @permission('update_users')
                                        <a href="{{route('dashboard.users.edit',$admin->id)}}" class="btn btn-primary">Edit</a>
                                        @endpermission

                                        @permission('delete_users')
                                        <form action="{{route('dashboard.users.destroy',$admin->id)}}" method="post">
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
