<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>OSEP</title>

    <!-- Scripts -->
    @include('partials.js-header')
    <!-- Fonts -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}"  type='image/x-icon'>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @include('partials.css-header')
</head>
<body>
    <div class="wrapper">
      <div id="app">
        <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
          </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
          <a href="{{ route('login') }}" class="brand-link text-center">
            <span class="brand-text login-logo">
             <h3><b style="color:white;"> <img src="images/pcaarrd.png" height="30px" style="margin-bottom:6px!important;"> OSEP</b></h3>
            </span>
          </a>
          <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <img src="{{ asset('storage/images/adminlte-sample/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->username }} ({{ Session::get("user_division") }})</a>
              </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                  <a href="{{ route('home') }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
                    </p>
                  </a>
                </li>
                <li class="nav-item has-treeview menu-open">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-sticky-note"></i>
                    <p>
                      Proposals
                    </p>
                    <i class="fas fa-angle-left right"></i>
                  </a>
                  <ul class="nav nav-treeview">
                    @if(Auth::check())
                      @if (Auth::user()->privilege == 1 || Auth::user()->privilege == 2)
                        <li class="nav-item pl-3">
                          <a href="{{ route('proposals') }}" class="nav-link">
                            <i class="fas fa-table nav-icon"></i>
                            <p>All</p>
                          </a>
                        </li>
                      @elseif(Auth::user()->privilege == 3)
                        <li class="nav-item pl-3">
                          <a href="{{ route('proposals') }}" class="nav-link">
                            <i class="fas fa-table nav-icon"></i>
                            <span>All proposals forwarded to {{ Session::get("user_division") }}</span>
                          </a>
                        </li>
                      @endif
                    @endif
                    @if(Auth::check() && (Auth::user()->privilege == 1 || Auth::user()->privilege == 2))
                    <li class="nav-item pl-3">
                      <a href="{{ route('from_dpmis_proposals') }}" class="nav-link">
                        <i class="fas fa-plus-square nav-icon"></i>
                        <p>From DPMIS</p>
                      </a>
                    </li>
                    <li class="nav-item pl-3">
                      <a href="{{ route('received_proposals') }}" class="nav-link">
                        <i class="fab fa-get-pocket nav-icon"></i>
                        <span>Received by OED-RD/ARMSS</span>
                      </a>
                    </li>
                    @endif
                    <li class="nav-item pl-3">
                      <a href="{{ route('for_evaluation_proposals') }}" class="nav-link">
                        <i class="fab fa-readme nav-icon"></i>
                        <p>For Evaluation</p>
                      </a>
                    </li>
                    @if(Auth::check() && (Auth::user()->privilege == 1 || Auth::user()->privilege == 2 || Auth::user()->privilege == 3))
                    <li class="nav-item pl-3">
                      <a href="{{ route('forward_comments_to_dpmis_proposals') }}" class="nav-link">
                        <i class="fas fa-paper-plane nav-icon"></i>
                        <span>Forward proposal comments to DPMIS</span>
                      </a>
                    </li>
                    <li class="nav-item pl-3">
                      <a href="{{ route('consolidated_comments_forwarded_to_dpmis_proposals') }}" class="nav-link">
                        <i class="fas fa-code-branch nav-icon"></i>
                        <span>Consolidated comments forwarded to DPMIS</span>
                      </a>
                    </li>
                    <li class="nav-item pl-3">
                      <a href="{{ route('approved_proposals') }}" class="nav-link">
                        <i class="fas fa-check nav-icon"></i>
                        <span>Approved Proposals/Sent to Palihan</span>
                      </a>
                    </li>
                    @endif
                  </ul>
                </li>
                @if(Auth::check() && (Auth::user()->privilege == 1 || Auth::user()->privilege == 2))
                <li class="nav-item">
                  <a href="{{ route('administration') }}" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                      Administration
                    </p>
                  </a>
                </li>
                @endif
                <li class="nav-item">
                  <a href="http://shorturl.at/fuwP9" class="nav-link">
                    <i class="nav-icon fas fa-bug"></i>
                    <p>
                      Report Bug
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('update_password') }}" class="nav-link">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>
                      Update Password
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('user.logout') }}" class="nav-link">
                    <i class="nav-icon fas fa-door-open"></i>
                    <p>
                      Logout
                    </p>
                  </a>
                </li>
              </ul>
            </nav>
            <!-- /.sidebar-menu -->
          </div>
        </aside>
        <div class="content-wrapper">
          @yield('content')
        </div>
      </div>
    </div>
</body>
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
</script>
@yield('script')
</html>
