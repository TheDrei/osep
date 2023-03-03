<!doctype html>
<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}"  type='image/x-icon'>
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
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @include('partials.css-header')
</head>
<body class="hold-transition login-page" style="background-image: url('images/login-osep.jpg'); background-repeat: no-repeat; background-size: cover;">
  <form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="login-box">
      <div class="login-logo" style="height:50px;">
        <a href=" {{ route('login') }}"><h1><b style="color:white;"> <img src="images/pcaarrd.png" height="33px" style="margin-bottom:6px!important;"> OSEP</b></h1></a>
      </div>
      <!-- /.login-logo -->
      <div class="card" style="border-radius:5%;">
        <div class="card-body login-card-body" style="border-radius:5%;">
          <p class="login-box-msg">Sign in to start your session</p>
          <div class="input-group mb-3">
            <input id="username" type="username" class="form-control" placeholder="Username" name="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input id="password" type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <div class="col-4">
              <button style="background-color:#1e88c3;" id="sign_in" href="#" type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</body>
<br/>
<br/>
<br/>
<br/>
<br/>
</html>
