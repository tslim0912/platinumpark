@extends('admin.layouts.app')
@section("content")


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Edit Admin</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('admin.banner.index')}}">Home</a></li>
                <li class="breadcrumb-item active">Admin</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @if ($errors->any())
            
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                <div class="col-lg-12">
                    
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form role="form" method="POST" action="{{ route('admin.admin.update',['admin' => Auth::user()->id]) }}" enctype="multipart/form-data">
                            @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email" class="moto-widget-contact_form-label">Email <span class="red">*</span></label>
                                            <input type="text" name="email" required="" class="form-control" value="{{ old('email', $admin->email) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name" class="moto-widget-contact_form-label">Name <span class="red">*</span></label>
                                            <input type="text" name="name" required="" class="form-control" value="{{ old('name', $admin->name)  }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name" class="moto-widget-contact_form-label">Password <span class="red">*</span></label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" name="password">
                                                <span class="input-group-addon show-password-btn" style="cursor: pointer;background: #007bff; color: #fff; display: flex; align-items: center; padding: 10px;"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name" class="moto-widget-contact_form-label">Confirm Password <span class="red">*</span></label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" name="password_confirmation">
                                                <span class="input-group-addon show-confirm-password-btn" style="cursor: pointer;background: #007bff; color: #fff; display: flex; align-items: center; padding: 10px;"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="col-lg-12" style="margin-top: 25px">
                                        <div class="form-group">
                                            <a class="btn btn-secondary" href="{{ route('admin.banner.index') }}">Back</a>
                                            <button type="submit" class="btn btn-success create-user_btn">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $('.show-password-btn').click(function (){
            var password = $('input[name="password"]');
            var type = password.attr('type')
            $(this).html('<i class="fa fa-eye" aria-hidden="true"></i>')
            if (type == 'password') {
                password.attr('type', 'text');
                $(this).html('<i class="fa fa-eye-slash" aria-hidden="true"></i>')
            } else {
                password.attr('type', 'password');
                $(this).html('<i class="fa fa-eye" aria-hidden="true"></i>')
            }
        });
        $('.show-confirm-password-btn').click(function (){
            var password = $('input[name="password_confirmation"]');
            var type = password.attr('type')
            $(this).html('<i class="fa fa-eye" aria-hidden="true"></i>')
            if (type == 'password') {
                password.attr('type', 'text');
                $(this).html('<i class="fa fa-eye-slash" aria-hidden="true"></i>')
            } else {
                password.attr('type', 'password');
                $(this).html('<i class="fa fa-eye" aria-hidden="true"></i>')
            }
        });
    </script>
@endsection
