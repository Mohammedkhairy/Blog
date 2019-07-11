<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body  class="hold-transition skin-blue sidebar-collapse">
  <div class="wrapper" id="app">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="بحث" aria-label="Search">
          </div>
        </form>

        <li class="nav-item d-none d-sm-inline-block">
                  <router-link to="/home"    class="btn btn-primary border-left ">الصفحه الرئيسيه</router-link>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
                  <router-link to="/example" class="btn btn-primary border-left ">الصفحه الرئيسيه</router-link>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
                  <router-link to="/example1" class="btn btn-primary border-left ">الصفحه الرئيسيه</router-link>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
                  <router-link to="/example2" class="btn btn-primary border-left ">الصفحه الرئيسيه</router-link>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
                  <router-link to="/example3" class="btn btn-primary border-left ">الصفحه الرئيسيه</router-link>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
                  <router-link to="/example4" class="btn btn-primary border-left ">الصفحه الرئيسيه</router-link>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
                  <router-link to="/example" class="btn btn-primary border-left ">الصفحه الرئيسيه</router-link>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
                  <router-link to="/example" class="btn btn-primary border-left ">الصفحه الرئيسيه</router-link>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
                  <router-link to="/example" class="btn btn-primary border-left ">الصفحه الرئيسيه</router-link>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
                  <router-link to="/example" class="btn btn-primary border-left ">الصفحه الرئيسيه</router-link>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ route('logout') }}" class="btn btn-primary border-left " onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">تسجيل الخروج</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->
    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <main class="py-4">
        @yield('content')
        <router-view></router-view>
      </main>

    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2019 <a href="https://know-me.000webhostapp.com">Mohamed Khairy</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

</body>

</html>