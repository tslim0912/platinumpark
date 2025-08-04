@extends('admin.layouts.app')
@section("content")


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">New Post</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.banner.index')}}">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('admin.posts.index')}}">Posts</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('admin.posts.show', ['post'=>$post->id]) }}">Post</a></li>
            <li class="breadcrumb-item active">Create</li>
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
                        {!! Form::open([ "class" => "form-horizontal", "url"=>route('admin.post.store', ['post'=>$post->id]), "enctype" =>"multipart/form-data"]) !!}
                        @csrf
                            <div class="row">
                                <input type="hidden" name="post_id" value= "{{ $post->id }}">

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="title" class="moto-widget-contact_form-label">Title<span class="red">*</span></label>

                                        <textarea id="title" name="title" class="form-control" required>{{ old('title') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="file" class="moto-widget-contact_form-label">Upload Thumbnail - <i>Recommend size 1920x1180(px)</i><span class="red">*</span></label>
                                        <input type="file" name="image_desktop" class="form-control" accept="image/*"> 
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="description" class="moto-widget-contact_form-label">Description<span class="red">*</span></label>
                                        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="start_date" class="moto-widget-contact_form-label"> Start Date Time <span class="red">*</span></label>
                                        <input type="text" id="start_date" name="start_date" required="" class="form-control" value="{{ old('start_date') }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="end_date" class="moto-widget-contact_form-label"> End Date Time <span class="red">*</span></label>
                                        <input type="text" id="end_date" name="end_date" required="" class="form-control" value="{{ old('end_date') }}">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="checkbox" id="qr_code" name="qr_code"  class="" value="{{ old('qr_code') }}">
                                        <label for="qr_code" class="moto-widget-contact_form-label">Generate QR Code</label>
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
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        // CKEDITOR.replace( 'title');
        CKEDITOR.replace( 'description');
    });
</script>
@endsection