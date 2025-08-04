@extends('admin.layouts.app')
@section("content")


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Posts</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.banner.index')}}">Home</a></li>
            <li class="breadcrumb-item active">Posts</li>
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
            <div class="col-lg-12">
                @if(Session::has('success'))
                <div class="alert alert-success">{!! Session::get('success') !!}</div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table id="banner-table" class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $key => $value)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ ucfirst($value->title) }}</td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('admin.posts.show', ['post'=>$value->id]) }}"><i class="fas fa-eye"></i> View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
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

        $('.dataTable').DataTable({
            responsive: true,
            // dom: 'Bfrtip',
            // buttons: [
            //    'copy', 'excel'
            // ],
        });

        $(document).on('click', '.delete-btn', function (event) {
            event.preventDefault();

            bootbox.hideAll();

            var url = $(this).data("href");

            bootbox.confirm("Confirm delete this banner?", function(result){
                if(result){

                $.ajax({
                    method: "DELETE",
                    url: url,
                    data: { _token: "{{ csrf_token() }}" },
                })
                .done(function( data ) {

                    if(data.success){
                        window.location.href = "{!! route('admin.banner.index') !!}";
                    }else{
                    bootbox.alert(data.message);
                    }

                });

                }
            });
        });
    })
</script>
@endsection