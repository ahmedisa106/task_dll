@extends('dashboard.layouts.master')
@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Edit User</h3>
            </div>
            <div class="box-body">
                <!-- Color Picker -->
                <div class="row">
                    <form action="{{route('dashboard.users.update',$user->id)}}" method="post">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>name</label>
                                <input type="text" value="{{old('name',$user->name)}}" class="form-control" name="name">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" value="{{old('email',$user->email)}}" class="form-control" name="email">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                                @error('password')
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
