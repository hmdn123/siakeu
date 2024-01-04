<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SIAKEU</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('template/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('template/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('template/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('template/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('template/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('template/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('template/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('template/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('template/vendor/simple-datatables/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <!-- Template Main CSS File -->
  <link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ url('home') }}" class="logo d-flex align-items-center">
        <img src="{{ asset('template/img/logo.png') }}" alt="">
        <span class="d-none d-lg-block">SIAKEU</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <!-- Authentication Links -->
        @guest
        @if (Route::has('login'))
        <li class="nav-item dropdown pe-3">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @endif

        @if (Route::has('register'))
        <li class="nav-item dropdown pe-3">
          <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @else
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ asset('template/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ Auth::user()->name }}</h6>
              <span>{{ Auth::user()->role }}</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
        @endguest

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('home') }}">
          <i class="bi bi-grid"></i>
          <span>Home</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('transaksi') }}">
          <i class="bi bi-cash-coin"></i>
          <span>Transaksi</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('laporan') }}">
          <i class="bi bi-journal-text"></i>
          <span>Laporan</span>
        </a>
      </li>

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#laporan-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="laporan-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ url('laporan/all') }}">
              <i class="bi bi-circle"></i><span>All</span>
            </a>
          </li>
          <li>
            <a href="{{ url('laporan/pemasukan') }}">
              <i class="bi bi-circle"></i><span>Pemasukan</span>
            </a>
          </li>
          <li>
            <a href="{{ url('laporan/pengeluaran') }}">
              <i class="bi bi-circle"></i><span>Pengeluaran</span>
            </a>
          </li>
        </ul>
      </li>End Laporan Nav -->

      @if ( Auth::user()->role != "Owner" )
      @else
      <li class="nav-item">
        <a class="nav-link">
          <i class="bi bi-gear"></i>
          <span>Setting</span>
        </a>
        <ul class="nav-content">
          <li>
            <a href="{{ url('setting') }}">
              <i class="bi bi-circle"></i><span>Account</span>
            </a>
          </li>
          <li>
            <a href="{{ url('jenis') }}">
              <i class="bi bi-circle"></i><span>Jenis Transaksi</span>
            </a>
          </li>
        </ul>
      </li>
      @endif

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    @yield('content')
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>AEY Creative</span></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('template/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('template/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('template/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('template/vendor/quill/quill.min.js') }}"></script>
  <script src="{{ asset('template/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('template/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('template/vendor/php-email-form/validate.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('template/js/main.js') }}"></script>

  @yield('js')
</body>

</html>