@extends('dashboard.layouts.master')
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets/dashboard')}}/bower_components/select2/dist/css/select2.min.css">
@endpush
@section('content')
    <section class="content">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Create New Admin</h3>
            </div>
            <div class="box-body">
                <!-- Color Picker -->
                <div class="row">
                    <form action="{{route('dashboard.admins.store')}}" method="post">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>name</label>
                                <input type="text" value="{{old('name')}}" class="form-control" name="name">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" value="{{old('email')}}" class="form-control" name="email">
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
                                <label>Categories</label>
                                <select name="categories[]" class="select2 form-control" multiple>
                                    @foreach($categories as $cat)
                                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                                @error('categories')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Permissions</label>
                                <select name="permissions[]" class="select2 form-control" multiple>
                                    @foreach($permissions as $permission)
                                        <option value="{{$permission->id}}">{{$permission->display_name}}</option>
                                    @endforeach
                                </select>
                                @error('permissions')
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

@push('js')
    <!-- Select2 -->
    <script src="{{asset('assets/dashboard')}}/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script>
        $('.select2').select2()
    </script>
@endpush
