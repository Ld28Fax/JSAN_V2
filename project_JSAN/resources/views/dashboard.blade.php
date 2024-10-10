<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JSAN</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('extern/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('extern/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('extern/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{'dashboard'}}" class="nav-link">Acceuil</a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('contact') }}" class="nav-link">Contact</a>
      </li> --}}
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <span class="nav-link  btn-default text-blue">{{ Auth::user()->Cour_appel }}</span>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <span class="nav-link btn-default text-blue">{{ Auth::user()->TPI }}</span>
      </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

        </div>
    </li>

    <!-- Full screen -->

    <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
    <i class="fas fa-expand-arrows-alt"></i>
        </a>
    </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 fixed">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
     <div style="margin-left: 20%">
      <img src="Justice_logo.png" alt=" Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">CO-JSAN</span>
     </div>
      
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      
      <div class="d-flex" style="margin-left: 10%" >
        <div class="info text-center">
          <div>
            <div class="card-body">
              <div class="text-center">
                <a href="{{ route('profile.edit') }}"><img src="extern/dist/img/user.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8; width:40%"></a>
              </div>

              <a href="{{ route('profile.edit') }}"><h3 class="profile-username text-center">{{ Auth::user()->name }}</h3></a>

              <p class="text-muted text-center">{{ Auth::user()->TPI }}</p>

              <ul class="list-group mb-3">
                <li class="list-group-item">
                  <b>{{ Auth::user()->Cour_appel }}</b>
                </li>
              </ul> 
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <x-dropdown-link :href="route('logout')"
                onclick="event.preventDefault();
                this.closest('form').submit();" class="btn btn-success btn-block text-white">
                <i class="zmdi zmdi-power"></i>
                {{ __('Déconnecter') }}
              </x-dropdown-link>
            </form>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('dashboard')}}" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Acceuil
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('demandeurs.index')}}" class="nav-link">
              <i class="nav-icon fas fa-user-plus"></i>
              <p>
                Demandeur
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('demandeurs.liste')}}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Listes demandeurs
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('Audience') }}" class="nav-link">
              <i class="nav-icon fas fa-balance-scale"></i>
              <p>
                Audience
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('demandeurs.exportation')}}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Exportation demandeurs
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('calendrier') }}" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Etat
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('contact') }}" class="nav-link">
              <i class="nav-icon fas fa-phone"></i>
              <p>Contact</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="wrapper">
    <div class="content-wrapper">
            @yield('content')
    </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024 <a href="{{ route('dashboard')}}">CO-JSAN</a>.</strong>
    All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->
</body>
</html>
