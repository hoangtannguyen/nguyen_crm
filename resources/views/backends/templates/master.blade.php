<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Admin | @yield('title')</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="{{ asset('vendors/fontawesome-free/css/all.css') }}">
      <link rel="stylesheet" href="{{ asset('vendors/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
      <link rel="stylesheet" href="{{ asset('vendors/icheck-bootstrap/icheck-bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{ asset('plus/css/plus.css')}}">
      <link rel="stylesheet" href="{{ asset('plus/css/modal.css')}}">
      <link rel="stylesheet" href="{{ asset('plus/css/dropzone.css')}}">
      <link rel="stylesheet" href="{{ asset('plus/css/popup_gallery.css')}}">
      <link rel="stylesheet" href="{{ asset('plus/css/validate.css')}}">
      <link rel="stylesheet" href="{{ asset('vendors/select2/css/select2.min.css')}}">
      <link rel="stylesheet" href="{{ asset('vendors/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
      <link rel="stylesheet" href="{{ asset('vendors/daterangepicker/daterangepicker.css')}}">
      <link rel="stylesheet" href="{{ asset('backends/css/adminlte.min.css')}}">
      <link rel="stylesheet" href="{{ asset('vendors/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
      <link rel="stylesheet" href="{{ asset('vendors/summernote/summernote-bs4.css')}}">
      <link rel="stylesheet" href="{{ asset('backends/css/main.css')}}">  
      <link rel="stylesheet" href="{{ asset('backends/css/style.css')}}">
      <script src="{{ asset('vendors/jquery/jquery.min.js')}}"></script>
      <script src="{{ asset('vendors/jquery-ui/jquery-ui.min.js')}}"></script>
   </head>

   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
         <header>
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
               <ul class="navbar-nav">
                  <li class="nav-item">
                     <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                  </li>
                  <li class="nav-item d-none d-sm-inline-block">
                     <a href="#" class="nav-link">Dashboard</a>
                  </li>
               </ul>
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                     <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                           <i class="fas fa-sign-out-alt nav-icon"></i>{{ __('Sign Out') }}
                        </a>
                     </form>
                   </li>
                  {{-- <li><a href="{{ route('logout') }}" title="{{ __('Sign Out') }}"><i class="fas fa-sign-out-alt"></i>.{{ __('Sign Out') }}</a></li> --}}
               </ul>
            </nav>
         </header>

         @include('backends.templates.sidebar')

         <main>@yield('content')</main>

         <footer class="main-footer">
            <strong>Copyright &copy; 2020-2030 iCar </strong>All rights reserved.<div class="float-right d-sm-inline-block"><b>Version</b> 1.0.0
         </footer>

         <aside class="control-sidebar control-sidebar-dark">
         </aside>
      </div>      
      <script src="{{ asset('vendors/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{ asset('vendors/chart.js/Chart.min.js')}}"></script>
      <script src="{{ asset('vendors/moment/moment.min.js')}}"></script>
      <script src="{{ asset('vendors/daterangepicker/daterangepicker.js')}}"></script>
      <script src="{{ asset('vendors/select2/js/select2.full.min.js')}}"></script>
      <script src="{{ asset('vendors/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
      <script src="{{ asset('vendors/summernote/summernote-bs4.min.js')}}"></script>
      <script src="{{ asset('vendors/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
      <script src="{{ asset('backends/js/adminlte.js')}}"></script>
      <script src="{{ asset('plus/js/validator.js')}}"></script>
      <script src="{{ asset('backends/js/modal.js')}}"></script>
      <script src="{{ asset('plus/js/form_validate.js')}}"></script>
      <script src="{{ asset('plus/js/dropzone.js')}}"></script>
      <script src="{{ asset('plus/js/popup_media.js')}}"></script>
      <script src="{{ asset('plus/js/calander.js')}}"></script>
      <script src="{{ asset('backends/js/main.js')}}"></script>
      <script src="{{ asset('backends/js/pluss.js')}}"></script>
   </body>

</html>