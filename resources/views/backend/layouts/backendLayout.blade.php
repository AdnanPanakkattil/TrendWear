<!doctype html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets/').'/'}}"
  data-template="vertical-menu-template"
  data-style="light">

<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Dashboard - Trend Wear</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico')}}" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
    rel="stylesheet" />

  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css')}}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css')}}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css')}}" />

  <!-- Core CSS -->

  <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css')}}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css')}}" class="template-customizer-theme-css" />

  <link rel="stylesheet" href="{{ asset('assets/css/demo.css')}}" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css')}}" />

  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css')}}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />

  <!-- Page CSS -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-advance.css')}}" />

  <!-- Helpers -->
  <script src="{{ asset('assets/vendor/js/helpers.js')}}"></script>
  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

  <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
  <script src="{{ asset('assets/vendor/js/template-customizer.js')}}"></script>

  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="{{ asset('assets/js/config.js')}}"></script>


  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />


</head>
<style>
  /* Reduce left and right content gaps */
  .custom-content {
    width: 100%;
    max-width: 100%;
    padding-left: 12px !important;
    padding-right: 12px !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
  }

  /* Reduce spacing around the content */
  .content-wrapper .container-p-y {
    padding-top: 1rem !important;
    padding-bottom: 1rem !important;
  }

  /* ==========================================================
     Modern Minimalist Sidebar UI (Matches Reference Screenshot)
     ========================================================== */
  #layout-menu.bg-menu-theme {
    background-color: #ffffff !important;
    border-right: 1px solid #edf0f5 !important;
    box-shadow: none !important;
  }

  /* Section Headers: QUICK ACCESS, ALL MODULES */
  .bg-menu-theme .menu-header {
    padding: 1.4rem 1.4rem 0.5rem 1.4rem !important;
    margin-top: 0.35rem;
    margin-bottom: 0.15rem;
  }
  .bg-menu-theme .menu-header::before {
    display: none !important; /* Hide default horizontal dividing line */
  }
  .bg-menu-theme .menu-header .menu-header-text {
    font-size: 0.74rem !important;
    font-weight: 700 !important;
    letter-spacing: 0.08em !important;
    color: #94a3b8 !important;
    text-transform: uppercase !important;
    font-family: inherit;
  }

  /* Sidebar Menu Item Links */
  .bg-menu-theme.menu-vertical .menu-item .menu-link {
    display: flex !important;
    align-items: center !important;
    padding: 0.64rem 1.25rem !important;
    margin: 2px 10px !important;
    border-radius: 8px !important;
    color: #374151 !important;
    font-size: 0.94rem !important;
    font-weight: 500 !important;
    line-height: 1.45 !important;
    transition: all 0.15s ease-in-out !important;
  }

  /* Menu Item Text */
  .bg-menu-theme.menu-vertical .menu-item .menu-link div:not(.badge) {
    color: #374151 !important;
    font-weight: 500 !important;
    font-size: 0.94rem !important;
  }

  /* Outline Icons matching reference */
  .bg-menu-theme.menu-vertical .menu-item .menu-link .menu-icon {
    font-size: 1.34rem !important;
    width: 1.5rem !important;
    height: 1.5rem !important;
    min-width: 1.5rem !important;
    color: #374151 !important;
    margin-right: 0.95rem !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    stroke-width: 1.6px;
    transition: color 0.15s ease-in-out !important;
  }

  /* Hover State */
  .bg-menu-theme.menu-vertical .menu-item:not(.active) .menu-link:hover {
    background-color: #f8fafc !important;
  }
  .bg-menu-theme.menu-vertical .menu-item:not(.active) .menu-link:hover,
  .bg-menu-theme.menu-vertical .menu-item:not(.active) .menu-link:hover div,
  .bg-menu-theme.menu-vertical .menu-item:not(.active) .menu-link:hover .menu-icon {
    color: #0f172a !important;
  }

  /* Dropdown Chevron Arrow (>) styled crisp and sleek */
  .bg-menu-theme.menu-vertical .menu-item .menu-toggle::after {
    border-color: #64748b !important;
    border-width: 1.8px 1.8px 0 0 !important;
    width: 0.44rem !important;
    height: 0.44rem !important;
    right: 1.25rem !important;
    transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
  }
  .bg-menu-theme.menu-vertical .menu-item:not(.active) .menu-link:hover.menu-toggle::after {
    border-color: #0f172a !important;
  }
  .bg-menu-theme.menu-vertical .menu-item.open > .menu-toggle::after {
    transform: translateY(-50%) rotate(135deg) !important;
  }

  /* Submenu items */
  .bg-menu-theme.menu-vertical .menu-sub {
    padding: 0.2rem 0 !important;
  }
  .bg-menu-theme.menu-vertical .menu-sub .menu-item .menu-link {
    padding-left: 3.45rem !important;
    font-size: 0.88rem !important;
    color: #4b5563 !important;
    border-radius: 6px !important;
    margin: 2px 10px !important;
  }
  .bg-menu-theme.menu-vertical .menu-sub .menu-item .menu-link div {
    color: #4b5563 !important;
    font-size: 0.88rem !important;
    font-weight: 450 !important;
  }
  .bg-menu-theme.menu-vertical .menu-sub .menu-item:not(.active) .menu-link:hover {
    background-color: #f8fafc !important;
  }
  .bg-menu-theme.menu-vertical .menu-sub .menu-item:not(.active) .menu-link:hover div {
    color: #0f172a !important;
  }

  /* Active sidebar menu styling (Orange brand accent) */
  .bg-menu-theme.menu-vertical .menu-item.active > .menu-link:not(.menu-toggle) {
    background: linear-gradient(270deg, #ff7849 0%, #ff5722 100%) !important;
    box-shadow: 0px 2px 8px 0px rgba(255, 87, 34, 0.45) !important;
    color: #ffffff !important;
  }
  .bg-menu-theme.menu-vertical .menu-item.active > .menu-link:not(.menu-toggle) .menu-icon,
  .bg-menu-theme.menu-vertical .menu-item.active > .menu-link:not(.menu-toggle) div {
    color: #ffffff !important;
  }
</style>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <!-- / Menu -->

      @include('backend.layouts.partials.sidebar')
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->


        @include('backend.layouts.partials.topbar')
        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-fluid flex-grow-1 container-p-y custom-content">
            @yield('content')
          </div>
          <!-- / Content -->



          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
  </div>
  <!-- / Layout wrapper -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->

  <script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
  <script src="{{ asset('assets/vendor/libs/popper/popper.js')}}"></script>
  <script src="{{ asset('assets/vendor/js/bootstrap.js')}}"></script>
  <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js')}}"></script>
  <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
  <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
  <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>

  <!-- Main JS -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  <!-- Page JS -->
  <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
  <script src="{{ asset('assets/js/extended-ui-sweetalert2.js')}}"></script>

  @stack('scripts')
</body>

</html>