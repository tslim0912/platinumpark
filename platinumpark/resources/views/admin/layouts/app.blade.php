<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="token" content="{{ csrf_token() }}" />
  <title>Admin Panel</title>

  

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ url('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('assets/dist/css/adminlte.min.css') }}">

  <!-- Bootstrap Core CSS -->
  {{-- <link href="{!! asset('css/bootstrap.min.css') !!}" rel="stylesheet"> --}}
  {{-- <link href="{!! asset('css/bootstrap.customize.css') !!}" rel="stylesheet"> --}}

  <!-- Jquery Dropzone -->
  <link href="{!! asset('css/dropzone.css') !!}" rel="stylesheet">

  <!-- Datetimepicker-->
  {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">--}}
  <link href="{!! asset('assets/css/jquery.datetimepicker.min.css') !!}" rel="stylesheet" />

  <!-- DataTables -->
  <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css" rel="stylesheet" />
  <link href="{{ asset('assets/build/css/intlTelInput.css') }}" rel="stylesheet" type="text/css">

   <!-- Jquery Fancybox -->
   <link href="{!! asset('css/jquery.fancybox.css') !!}" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="{!! asset('css/sb-admin-2.css') !!}" rel="stylesheet">

  <!-- Croppie -->
  <link rel="stylesheet" href="{{asset('css/croppie.css')}}">

  <!-- Jquery Dropzone -->
  {{-- <link href="{!! asset('css/dropzone.css') !!}" rel="stylesheet"> --}}
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  {{-- <link rel="stylesheet" href="https://cdn.rawgit.com/enyo/dropzone/master/dist/dropzone.css"> --}}

  <!-- Custom CSS -->
  <link href="{!! asset('assets/web/css/admin.css') !!}" rel="stylesheet">


</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.banner.index') }}" class="brand-link">
      <img src="{{ url('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        
        <div class="info">
          <a href="{{ route('admin.admin.edit', ['admin' => Auth::user()->id]) }}" class="d-block">{{ ucfirst(Auth::user()->name) }}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="{{ route('admin.banner.index')}}" class="nav-link  {{ request()->is('banner') ? 'active' : '' }} {{ request()->is('banner/*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-image"></i>
              <p>
                Banner
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('admin.posts.index')}}" class="nav-link  {{ request()->is('posts') ? 'active' : '' }} {{ request()->is('posts/*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-calendar-week"></i>
              <p>
                Posts
              </p>
            </a>
          </li>
          
          
          <li class="nav-item">
            <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
              <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  @yield('content')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer 
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0
    </div>
  </footer>-->
</div>
<!-- ./wrapper -->


<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ url('assets/plugins/jquery/jquery.min.js') }}"></script>

<!-- Datetimepicker -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg==" crossorigin="anonymous"></script> --}}
<script src="{{ url('assets/js/jquery.datetimepicker.full.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


<!-- AdminLTE -->
<script src="{{ url('assets/dist/js/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ url('assets/plugins/chart.js/Chart.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ url('assets/dist/js/demo.js') }}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ url('assets/dist/js/pages/dashboard3.js') }}"></script> --}}

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('assets/build/js/intlTelInput-jquery.min.js')}}"></script>
<script src="{{ asset('assets/build/js/utils.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.all.min.js"></script>

<!-- Jquery Validate -->
<script src="{!! asset('js/jquery.validate.min.js') !!}"></script>

<!-- Jquery Fancybox -->
<script src="{!! asset('js/jquery.fancybox.js') !!}"></script>

 <!-- Bootbox JavaScript -->
 <script src="{!! asset('js/bootbox.min.js') !!}"></script>

<!-- Jquery Dropzone -->
<script src="{!! asset('js/dropzone.js') !!}"></script>

<script src="{!! asset('plugin/ckeditor/ckeditor.js') !!}" type="text/javascript"></script>

{{-- <script src="https://cdn.rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script> --}}

<!-- Croppie -->
<script src="{{url('js/croppie.js')}}"></script>

@if (session()->has('success'))
<script type="text/javascript">
    $(function () {
        Swal.fire({
            icon: 'success',
            title: "Success!",
            text: "{!! session()->get('success') !!}",
        })
    });
</script>
@endif

@if (session()->has('error'))
<script type="text/javascript">
    $(function () {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: "{!! session()->get('error') !!}",
        })
    });
</script>
@endif

@if (session()->has('warning'))
<script type="text/javascript">
    $(function () {
        Swal.fire({
            icon: 'warning',
            // title: 'Oops...',
            text: "{!! session()->get('warning') !!}",
        })
    });
</script>
@endif

<script>

  $( document ).ready(function() {
    $('#start_date').datetimepicker({
        dateFormat: 'yy-mm-dd',
    });
    $('#end_date').datetimepicker({
        dateFormat: 'yy-mm-dd',
    });

  });

</script>

@yield('script')
</body>
</html>
