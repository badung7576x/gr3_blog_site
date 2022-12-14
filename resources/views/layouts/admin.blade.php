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
  <link rel="stylesheet" href="{{ asset('js/plugins/sweetalert2/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/buttons.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" id="css-main" href="{{ mix('/css/oneui.css') }}">
  <style>
    #sidebar .content-header,
    #side-overlay .content-header {
      padding-left: 0.85rem !important;
    }

    .noselect {
      -webkit-touch-callout: none;
      /* iOS Safari */
      -webkit-user-select: none;
      /* Safari */
      -khtml-user-select: none;
      /* Konqueror HTML */
      -moz-user-select: none;
      /* Old versions of Firefox */
      -ms-user-select: none;
      /* Internet Explorer/Edge */
      user-select: none;
      /* Non-prefixed version, currently supported by Chrome, Edge, Opera and Firefox */
    }
  </style>
  @yield('css_after')

  <!-- Scripts -->
  <script>
    window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
  </script>
</head>

<body>
  <div id="page-container" class="sidebar-o side-scroll page-header-fixed">
    <nav id="sidebar" aria-label="Main Navigation">
      <!-- Side Header -->
      <div class="content-header">
        <!-- Logo -->
        <div class="d-flex align-items-center justify-content-between">
          <span class="me-3 smini-visible">
            <img src="{{ asset('media/favicons/icon.jpg') }}" width="32" height="32"></img>
          </span>
          <a class="font-semibold text-dual fs-5 smini-hidden" href="javascript:void(0)">Blog CMS</a>
        </div>
        <!-- END Logo -->
        <!-- Extra -->
        <div>
          <!-- Close Sidebar, Visible only on mobile screens -->
          <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
          <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
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
        <div class="content-side">
          <ul class="nav-main">
            {{-- @can('is_admin') --}}
              <li class="nav-main-item">
                <a class="nav-main-link {{ request()->routeIs('admin.teacher*') ? 'active' : '' }}" href="{{ route('admin.dashboard.index') }}">
                  <i class="nav-main-link-icon fa fa-users"></i>
                  <span class="nav-main-link-name">Trang ch???</span>
                </a>
              </li>
            {{-- @endcan
            @can('is_teacher')
              <li class="nav-main-item">
                <a class="nav-main-link {{ request()->routeIs('admin.exam-set*') ? 'active' : '' }}" href="{{ route('admin.exam-set.index') }}">
                  <i class="nav-main-link-icon fa fa-layer-group"></i>
                  <span class="nav-main-link-name">Danh s??ch ????? thi</span>
                </a>
              </li>
            @endcan --}}
          </ul>
        </div>
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
          <!-- Toggle Sidebar -->
          <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
          <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
            <i class="fa fa-fw fa-bars"></i>
          </button>
          <!-- END Toggle Sidebar -->

          <!-- Toggle Mini Sidebar -->
          <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
          <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
            <i class="fa fa-fw fa-list-ul"></i>
          </button>
          <!-- END Toggle Mini Sidebar -->
        </div>
        <!-- END Left Section -->

        <!-- Right Section -->
        <div class="d-flex align-items-center">

          <div class="dropdown d-inline-block ms-2">
            <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-fw fa-bell"></i>
              <span class="text-danger">1</span>
            </button>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 border-0 fs-sm" aria-labelledby="page-header-notifications-dropdown" style="">
              <div class="p-2 bg-body-light border-bottom text-center rounded-top">
                <h5 class="dropdown-header text-uppercase">Th??ng b??o</h5>
              </div>
              <ul class="nav-items mb-0">
                <li>
                  <a class="text-dark d-flex py-2" href="javascript:void(0)">
                    <div class="flex-shrink-0 me-2 ms-3">
                      <i class="fa fa-fw fa-plus-circle text-success"></i>
                    </div>
                    <div class="flex-grow-1 pe-2">
                      <div class="fw-semibold">Gi??o vi??n Ho??ng Thanh T??m v???a th??m m???t c??u h???i m???i. <span class="badge bg-danger">m???i</span></div>
                      <span class="fw-medium text-muted">15 min ago</span>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="text-dark d-flex py-2" href="javascript:void(0)">
                    <div class="flex-shrink-0 me-2 ms-3">
                      <i class="fa fa-fw fa-check-circle text-primary"></i>
                    </div>
                    <div class="flex-grow-1 pe-2">
                      <div class="fw-semibold">Gi??o vi??n L?? Ho??ng M???nh ???? ????nh gi?? c??u h???i ???????c ph??n c??ng.</div>
                      <span class="fw-medium text-muted">22 min ago</span>
                    </div>
                  </a>
                </li>
                <li>
                  <a class="text-dark d-flex py-2" href="javascript:void(0)">
                    <div class="flex-shrink-0 me-2 ms-3">
                      <i class="fa fa-fw fa-times-circle text-danger"></i>
                    </div>
                    <div class="flex-grow-1 pe-2">
                      <div class="fw-semibold">Gi??o vi??n L?? Ho??ng M???nh ???? t??? ch???i ph?? duy???t c??u h???i.</div>
                      <span class="fw-medium text-muted">26 min ago</span>
                    </div>
                  </a>
                </li>
              </ul>
            </div>
          </div>

          <!-- User Dropdown -->
          <div class="dropdown d-inline-block ms-2">
            @php $avatar = auth()->user()->avatar != '' ? auth()->user()->avatar : asset('images/default_avatar.png') @endphp
            <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              <img class="rounded-circle" src="{{ $avatar }}" style="width: 21px;">
              <span class="d-none d-sm-inline-block ms-2">{{ auth()->user()->fullname }}</span>
              <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ms-1 mt-1"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 border-0" aria-labelledby="page-header-user-dropdown">
              <div class="p-3 text-center bg-body-light border-bottom rounded-top">
                <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ $avatar }}" alt="">
                <p class="mt-2 mb-0 fw-medium">{{ auth()->user()->fullname }}</p>
                <p class="mb-0 text-muted fs-sm fw-medium"> {{ auth()->user()->title }} </p>
              </div>
              <div class="p-2">
                <a class="dropdown-item d-flex align-items-center justify-content-between" href="#">
                  <span class="fs-sm fw-medium"><i class="fa fa-fw fa-address-card me-1 opacity-50"></i>Th??ng tin t??i kho???n</span>
                </a>
              </div>
              <div role="separator" class="dropdown-divider m-0"></div>
              <div class="p-2">
                <a class="dropdown-item d-flex align-items-center justify-content-between" href="#"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <span class="fs-sm fw-medium"><i class="fa fa-fw fa-sign-out-alt me-1 opacity-50"></i>????ng xu???t</span>
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </div>
          </div>

          
          <!-- END User Dropdown -->
        </div>
        <!-- END Right Section -->
      </div>
      <!-- END Header Content -->
    </header>
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
      @yield('content')
    </main>
    <!-- END Main Container -->
    <!-- Footer -->
    <footer id="page-footer" class="bg-body-light">
      <div class="content py-2">
        <div class="row fs-sm">
          <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-end">
            ???????c ph??t tri???n b???i <a class="fw-semibold" href="#" target="_blank">?????ng B?? D??ng - 20176731</a>
          </div>
          <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
            <a class="fw-semibold" href="javascript:void(0)"><strong>{{ config('setting.app_name') }}</strong></a> &copy; <span data-toggle="year-copy"></span>
          </div>
        </div>
      </div>
    </footer>
  </div>


  <script src="{{ mix('js/oneui.app.js') }}"></script>
  <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
  <script src="{{ asset('js/plugins/es6-promise/es6-promise.auto.min.js') }}"></script>
  <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/plugins/datatables-bs5/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ asset('js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('js/custom/custom_datatables.js') }}"></script>
  <script src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
  <script>
    @if (session()->has('message'))
      let type = "{{ session()->get('type') }}";
      let message = "{{ session()->get('message') }}";
      if (type == 'error') type = "danger";
      showNotify(type, message);
    @endif

    function showNotify(type, message) {
      initNotify(message, type);
    }

    function initNotify(message = "No message", type = "info", icon = "") {
      $.notify({
        icon: icon,
        message: message,
      }, {
        element: 'body',
        type: type,
        placement: {
          from: 'top',
          align: 'right'
        },
        allow_dismiss: true,
        newest_on_top: true,
        showProgressbar: false,
        offset: 20,
        spacing: 10,
        z_index: 1033,
        delay: 6000,
        timer: 1000,
        animate: {
          enter: 'animated fadeIn',
          exit: 'animated fadeOutDown'
        },
        template: `<div data-notify="container" class="col-11 col-sm-4 alert alert-{0} alert-dismissible" role="alert">
          <p class="mb-0">
            <span data-notify="icon"></span>
            <span data-notify="title">{1}</span>
            <span data-notify="message">{2}</span>
          </p>
          <div class="progress" data-notify="progressbar">
            <div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
          </div>
          <a href="{3}" target="{4}" data-notify="url"></a>
          <a class="p-2 m-1 text-dark" href="javascript:void(0)" aria-label="Close" data-notify="dismiss">
            <i class="fa fa-times"></i>
          </a>
        </div>`
      });
    }

    const toast = Swal.mixin({
      buttonsStyling: false,
      target: '#page-container',
      customClass: {
        confirmButton: 'btn btn-success m-1',
        cancelButton: 'btn btn-danger m-1',
        input: 'form-control'
      }
    });
  </script>
  @yield('js_after')
</body>

</html>
