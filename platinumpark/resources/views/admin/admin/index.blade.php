@extends('admin.master')
@section("content")

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admins</h1>
          </div>
          <div class="col-sm-6">          
            <ol class="breadcrumb float-sm-right">
<!--               <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @if(Session::has('success'))
                <div class="alert alert-success">{!! Session::get('success') !!}</div>
                @endif
            <div class="card">
              {{-- <div class="card-header"> --}}
                {{-- <a href="{{ route('admin.courses.create') }}" type="button" class="btn btn-info">
                    <i class="fas fa-plus-circle"></i>&nbsp;Add
                </a> --}}
              {{-- </div> --}}
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover display" style="width:100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  
                  @foreach($admins as $key => $value)           
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$value->email}}</td>  
                    <td>{{$value->name}}</td>  
                    <td>
                      @if(Auth::user()->id != 14)
                        <a class="btn btn-warning edit-service-button" href="{{ route('admin.admins.edit', ['admin'=>$value->id]) }}"><i class="far fa-edit"></i> Edit</a>
                      @endif
                        
                    </td>
                  </tr>
                  @endforeach
                </body>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection

  @section('script')
  <script type="text/javascript">
     
  </script>
  @endsection