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
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css')}}" />

  @stack('styles')
  <link rel="stylesheet" href="{{ asset('assets/css/trendwear-admin.css') }}?v={{ filemtime(public_path('assets/css/trendwear-admin.css')) }}" />
  @php
    $userThemePalette = \App\Models\User::resolveThemePalette(auth()->user()?->theme_color);
  @endphp
  <style id="tw-user-theme-vars">
    :root,
    html:not(.dark-style),
    [data-style="light"] {
      --tw-primary: {{ $userThemePalette['primary'] }};
      --tw-primary-dark: {{ $userThemePalette['primary_dark'] }};
      --tw-primary-rgb: {{ $userThemePalette['primary_rgb'] }};
      --tw-primary-light: rgba({{ $userThemePalette['primary_rgb'] }}, 0.12);
      --bs-primary: {{ $userThemePalette['primary'] }};
      --bs-primary-rgb: {{ $userThemePalette['primary_rgb'] }};
    }
    html.dark-style,
    [data-style="dark"] {
      --tw-primary: {{ $userThemePalette['primary'] }};
      --tw-primary-dark: {{ $userThemePalette['primary_dark'] }};
      --tw-primary-rgb: {{ $userThemePalette['primary_rgb'] }};
      --tw-primary-light: rgba({{ $userThemePalette['primary_rgb'] }}, 0.15) !important;
      --bs-primary: {{ $userThemePalette['primary'] }};
      --bs-primary-rgb: {{ $userThemePalette['primary_rgb'] }};
    }
  </style>
</head>

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
  <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>

  <script>
    // Global TrendWear Selectbox (.tw-select) auto-initializer
    window.initTwSelect = function (context) {
      if (typeof $.fn.select2 === 'undefined') return;
      var $ctx = context ? $(context) : $(document);
      $ctx.find('select.tw-select, select.tw-select-box, .dataTables_length select').each(function () {
        var $el = $(this);
        if ($el.hasClass('select2-hidden-accessible')) return;

        var hasSearch = $el.data('search') === true || $el.data('search') === 'true';
        var placeholder = $el.data('placeholder') || '';
        var isInputGroup = $el.parent().hasClass('input-group');

        if (!$el.parent().hasClass('tw-select-wrapper')) {
          var wrapperClass = isInputGroup
            ? 'position-relative tw-select-wrapper tw-input-group-select flex-grow-1'
            : 'position-relative tw-select-wrapper d-inline-block';
          $el.wrap('<div class="' + wrapperClass + '"></div>');
        }

        var $modal = $el.closest('.modal');
        var select2Config = {
          minimumResultsForSearch: hasSearch ? 0 : Infinity,
          dropdownParent: $modal.length ? $modal : $el.closest('.tw-select-wrapper'),
          width: '100%'
        };

        if (placeholder) {
          select2Config.placeholder = placeholder;
          select2Config.allowClear = $el.data('allow-clear') === true;
        }

        $el.select2(select2Config);
      });
    };

    $(document).ready(function () {
      window.initTwSelect();
    });

    // Auto-apply to any DataTables length dropdown whenever a DataTable initializes
    $(document).on('init.dt', function (e, settings) {
      if (window.initTwSelect) {
        var api = new $.fn.dataTable.Api(settings);
        window.initTwSelect($(api.table().container()));
      }
    });
  </script>

  <script>
    window.TrendWearThemeConfig = {
      defaultColor: @json(\App\Models\User::DEFAULT_THEME_COLOR),
      currentColor: @json($userThemePalette['primary']),
      presets: @json(\App\Models\User::THEME_COLOR_PRESETS),
      saveUrl: @json(route('backend.theme-color.update'))
    };
  </script>
  <script src="{{ asset('assets/js/theme-color-customizer.js') }}?v={{ filemtime(public_path('assets/js/theme-color-customizer.js')) }}"></script>

  @stack('scripts')
</body>

</html>