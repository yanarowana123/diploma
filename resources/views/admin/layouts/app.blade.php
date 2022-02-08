<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/css/adminlte.min.css')}}">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
    </div>



    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="{{asset('img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{route('admin.article.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Articles
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.tree_pollen.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Tree pollen
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.grass_pollen.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Grass pollen
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.ragweed.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Ragweed pollen
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.dust.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Dust and Danger
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.mold.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Mold
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.1.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>


<!-- jQuery -->
<script src="{{asset('/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/ckeditor/adapters/jquery.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('/jquery/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/js/adminlte.js')}}"></script>
<script src="{{asset('/tinymce/tinymce.min.js')}}"></script>
@stack('scripts')
</body>
</html>
