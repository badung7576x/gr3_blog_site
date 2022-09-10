<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

  <title>@yield('title')</title>

  <meta name="description" content="{{ config('setting.app_name') }}">
  <meta name="author" content="badung7576x">
  <meta name="robots" content="noindex, nofollow">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Icons -->
  <link rel="shortcut icon" href="{{ asset('media/favicons/icon.jpg') }}">
  <link rel="icon" sizes="128x128" type="image/png" href="{{ asset('media/favicons/icon.jpg') }}">
  <link rel="apple-touch-icon" sizes="128x128" href="{{ asset('media/favicons/icon.jpg') }}">

  <!-- Fonts and Styles -->
  @yield('css_before')
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
  <link rel="stylesheet" id="css-main" href="{{ mix('/css/oneui.css') }}">
  <link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
  @yield('css_after')

  <!-- Scripts -->
  <script>
    window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
  </script>
</head>

<body>
  <div id="page-container" class="sidebar-dark side-scroll page-header-fixed page-header-dark main-content-boxed">

    <!-- Sidebar -->
    <!--
        Sidebar Mini Mode - Display Helper classes

        Adding 'smini-hide' class to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
        Adding 'smini-show' class to an element will make it visible (opacity: 1) when the sidebar is in mini mode
            If you would like to disable the transition animation, make sure to also add the 'no-transition' class to your element

        Adding 'smini-hidden' to an element will hide it when the sidebar is in mini mode
        Adding 'smini-visible' to an element will show it (display: inline-block) only when the sidebar is in mini mode
        Adding 'smini-visible-block' to an element will show it (display: block) only when the sidebar is in mini mode
    -->
    <nav id="sidebar" aria-label="Main Navigation">
      <!-- Side Header -->
      <div class="content-header bg-white-5">
        <!-- Logo -->
        <a class="fw-semibold text-dual" href="index.html">
          <span class="smini-visible">
            <i class="fa fa-circle-notch text-primary"></i>
          </span>
          <span class="smini-hide fs-5 tracking-wider">
            Blog<span class="fw-normal"></span>
          </span>
        </a>
        <!-- END Logo -->

        <!-- Extra -->
        <div>
          <!-- Options -->
          <div class="dropdown d-inline-block ms-1">
            <button type="button" class="btn btn-sm btn-alt-secondary" id="sidebar-themes-dropdown"
              data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="far fa-user"></i> Đặng Bá Dũng
            </button>
            <div class="dropdown-menu dropdown-menu-end fs-sm smini-hide border-0"
              aria-labelledby="sidebar-themes-dropdown">
              <!-- Color Themes -->
              <!-- Layout API, functionality initialized in Template._uiHandleTheme() -->
              <a class="dropdown-item d-flex align-items-center justify-content-between fw-medium" data-toggle="theme"
                data-theme="default" href="#">
                <span>Danh sách bài viết</span>
                <i class="fa fa-circle text-default"></i>
              </a>
              <!-- END Color Themes -->
            </div>
          </div>
          <!-- END Options -->

          <!-- Close Sidebar, Visible only on mobile screens -->
          <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
          <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close"
            href="javascript:void(0)">
            <i class="fa fa-fw fa-times"></i>
          </a>
          <!-- END Close Sidebar -->
        </div>
        <!-- END Extra -->
      </div>
      <!-- END Side Header -->

      <!-- Sidebar Scrolling -->
      <div class="js-sidebar-scroll">
        <!-- Side Navigation -->
        @auth
        <div class="content-side">
          <ul class="nav-main">
            <li class="nav-main-item">
              <a class="nav-main-link active" href="gs_landing.html">
                <i class="nav-main-link-icon si si-home"></i>
                <span class="nav-main-link-name">Trang chủ</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{ route('article.list') }}">
                <i class="nav-main-link-icon si si-rocket"></i>
                <span class="nav-main-link-name">Quản lý bài viết</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link" href="{{ route('article.create') }}">
                <i class="nav-main-link-icon si si-plus"></i>
                <span class="nav-main-link-name">Tạo bài viết mới</span>
              </a>
            </li>
          </ul>
        </div>
        @endauth
        <!-- END Side Navigation -->
      </div>
      <!-- END Sidebar Scrolling -->
    </nav>
    <!-- END Sidebar -->

    <!-- Header -->
    <header id="page-header">
      <!-- Header Content -->
      <div class="content-header">
        <!-- Left Section -->
        <div class="d-flex align-items-center">
          <!-- Logo -->
          <a class="fw-semibold fs-5 tracking-wider text-dual me-3" href="index.html">
            Blog
          </a>
          <!-- END Logo -->
        </div>
        <!-- END Left Section -->

        <!-- Right Section -->
        <div class="d-flex align-items-center">
          <!-- Menu -->
          @auth
          <div class="d-none d-lg-block">
            <ul class="nav-main nav-main-horizontal nav-main-hover">
              <li class="nav-main-item">
                <a class="nav-main-link active" href="gs_landing.html">
                  <i class="nav-main-link-icon si si-home"></i>
                  <span class="nav-main-link-name">Trang chủ</span>
                </a>
              </li>
              <li class="nav-main-item">
                <a class="nav-main-link" href="{{ route('article.list') }}">
                  <i class="nav-main-link-icon si si-list"></i>
                  <span class="nav-main-link-name">Quản lý bài viết</span>
                </a>
              </li>
              <li class="nav-main-item">
                <a class="nav-main-link" href="{{ route('article.create') }}">
                  <i class="nav-main-link-icon si si-plus"></i>
                  <span class="nav-main-link-name">Tạo bài viết mới</span>
                </a>
              </li>
              <li class="nav-main-heading">{{ auth()->user()->fullname }}</li>
              <li class="nav-main-item">
                <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                  aria-expanded="false" href="#">
                  {{ auth()->user()->fullname }}
                </a>
                <ul class="nav-main-submenu nav-main-submenu-right">
                  <li class="nav-main-item">
                    <a class="nav-main-link" data-toggle="theme" data-theme="default" href="#"
                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="nav-main-link-icon fa fa-sign-out-alt text-default"></i>
                      <span class="nav-main-link-name">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          @endauth
          @if(!auth()->check())
          <div class="d-none d-lg-block">
            <ul class="nav-main nav-main-horizontal nav-main-hover">
              <li class="nav-main-item">
                <a class="nav-main-link active" href="{{ route('admin.login') }}">
                  <i class="nav-main-link-icon fa fa-sign-in-alt"></i>
                  <span class="nav-main-link-name">Đăng nhập</span>
                </a>
              </li>
            </ul>
          </div>
          @endauth
          <!-- END Menu -->

          <!-- Toggle Sidebar -->
          <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
          <button type="button" class="btn btn-sm btn-alt-secondary d-lg-none ms-1" data-toggle="layout"
            data-action="sidebar_toggle">
            <i class="fa fa-fw fa-bars"></i>
          </button>
          <!-- END Toggle Sidebar -->
        </div>
        <!-- END Right Section -->
      </div>
      <!-- END Header Content -->

      <!-- Header Search -->
      <div id="page-header-search" class="overlay-header bg-body-extra-light">
        <div class="content-header">
          <form class="w-100" method="POST">
            <div class="input-group input-group-sm">
              <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
              <button type="button" class="btn btn-alt-danger" data-toggle="layout" data-action="header_search_off">
                <i class="fa fa-fw fa-times-circle"></i>
              </button>
              <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input"
                name="page-header-search-input">
            </div>
          </form>
        </div>
      </div>
      <!-- END Header Search -->

      <!-- Header Loader -->
      <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
      <div id="page-header-loader" class="overlay-header bg-primary-lighter">
        <div class="content-header">
          <div class="w-100 text-center">
            <i class="fa fa-fw fa-circle-notch fa-spin text-primary"></i>
          </div>
        </div>
      </div>
      <!-- END Header Loader -->
    </header>
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
      @yield('content')
    </main>
    <!-- END Main Container -->

    <footer id="page-footer" class="bg-body-extra-light">
      <div class="content py-4">
        <!-- Footer Navigation -->
        <div class="row items-push fs-sm border-bottom pt-4">
          <div class="col-6 col-md-4">
            <h3>Category</h3>
            <ul class="list list-simple-mini">
              <li>
                <a class="fw-semibold" href="javascript:void(0)">
                  <i class="fa fa-fw fa-link text-primary-lighter me-1"></i> Link #1
                </a>
              </li>
              <li>
                <a class="fw-semibold" href="javascript:void(0)">
                  <i class="fa fa-fw fa-link text-primary-lighter me-1"></i> Link #2
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <h3>Category</h3>
            <ul class="list list-simple-mini">
              <li>
                <a class="fw-semibold" href="javascript:void(0)">
                  <i class="fa fa-fw fa-link text-primary-lighter me-1"></i> Link #1
                </a>
              </li>
              <li>
                <a class="fw-semibold" href="javascript:void(0)">
                  <i class="fa fa-fw fa-link text-primary-lighter me-1"></i> Link #2
                </a>
              </li>
            </ul>
          </div>
          <div class="col-6 col-md-4">
            {{-- <h3>Company</h3>
            <div class="fs-sm push">
              1080 Sunshine Valley, Suite 2563<br>
              San Francisco, CA 85214<br>
              <abbr title="Phone">P:</abbr> (123) 456-7890
            </div> --}}
            <h3>Subscribe to our news</h3>
            <form>
              <div class="input-group">
                <input type="email" class="form-control form-control-alt" id="dm-gs-subscribe-email"
                  name="dm-gs-subscribe-email" placeholder="Your email..">
                <button type="submit" class="btn btn-alt-primary">Subscribe</button>
              </div>
            </form>
          </div>
        </div>
        <!-- END Footer Navigation -->

        <!-- Footer Copyright -->
        <div class="row fs-sm pt-4">
          <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-end">
            Crafted with <i class="fa fa-heart text-danger"></i> by <a class="fw-semibold"
              href="https://1.envato.market/ydb" target="_blank">pixelcave</a>
          </div>
          <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
            <a class="fw-semibold" href="https://1.envato.market/AVD6j" target="_blank">OneUI 5.0</a> &copy; <span
              data-toggle="year-copy"></span>
          </div>
        </div>
        <!-- END Footer Copyright -->
      </div>
    </footer>
  </div>
  <!-- END Page Container -->
  <script src="{{ mix('js/oneui.app.js') }}"></script>
  <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
  <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script>
    let toast = Swal.mixin({
      buttonsStyling: false,
      target: '#page-container',
      customClass: {
        confirmButton: 'btn btn-success m-1',
        cancelButton: 'btn btn-danger m-1',
        input: 'form-control'
      }
    });
    @if (session()->has('message'))
      let type = "{{ session()->get('type') }}";
      let message = "{{ session()->get('message') }}";
      showNotify(type, message);
    @endif

    function showNotify(type, message) {
      toast.fire('Thông Báo', message, type);
    }
  </script>
  @yield('js_after')
</body>

</html>