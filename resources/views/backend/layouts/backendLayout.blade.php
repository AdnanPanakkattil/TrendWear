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

  @stack('styles')
</head>
<style>
  /* SweetAlert2 button fix: Ensure hidden buttons remain hidden */
  div.swal2-container .swal2-actions button[style*="display: none"],
  div.swal2-container .swal2-actions button.swal2-hide-btn {
    display: none !important;
  }

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
    padding: 0.64rem 1.85rem 0.64rem 1.15rem !important;
    margin: 2px 8px !important;
    border-radius: 8px !important;
    color: #374151 !important;
    font-size: 0.92rem !important;
    font-weight: 500 !important;
    line-height: 1.45 !important;
    transition: all 0.15s ease-in-out !important;
  }

  /* Menu Item Text */
  .bg-menu-theme.menu-vertical .menu-item .menu-link div:not(.badge) {
    color: #374151 !important;
    font-weight: 500 !important;
    font-size: 0.92rem !important;
  }

  /* Outline Icons matching reference */
  .bg-menu-theme.menu-vertical .menu-item .menu-link .menu-icon {
    font-size: 1.3rem !important;
    width: 1.4rem !important;
    height: 1.4rem !important;
    min-width: 1.4rem !important;
    color: #374151 !important;
    margin-right: 0.75rem !important;
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

  /* Dropdown Chevron Arrow matching reference images (Closed: >, Open: —) */
  .bg-menu-theme.menu-vertical .menu-item .menu-toggle::after {
    content: "" !important;
    position: absolute !important;
    right: 1.25rem !important;
    top: 50% !important;
    width: 0.42rem !important;
    height: 0.42rem !important;
    border: solid #94a3b8 !important;
    border-width: 0 1.8px 1.8px 0 !important;
    transform: translateY(-50%) rotate(-45deg) !important;
    transition: transform 0.22s cubic-bezier(0.4, 0, 0.2, 1), border-color 0.2s ease, width 0.15s ease, height 0.15s ease, background-color 0.15s ease !important;
    font-size: 0 !important;
    font-family: inherit !important;
    display: inline-block !important;
  }
  .bg-menu-theme.menu-vertical .menu-item:not(.active) .menu-link:hover.menu-toggle::after {
    border-color: #ff5722 !important;
  }

  /* Parent menu-toggle links never get solid orange gradient */
  .bg-menu-theme.menu-vertical .menu-item > .menu-link.menu-toggle {
    background: transparent !important;
    box-shadow: none !important;
  }
  .bg-menu-theme.menu-vertical .menu-item:not(.open) > .menu-link.menu-toggle:hover {
    background-color: #f8fafc !important;
  }

  /* Open state: Horizontal minus indicator (—) & soft tinted background */
  .bg-menu-theme.menu-vertical .menu-item.open > .menu-toggle {
    background-color: rgba(255, 87, 34, 0.08) !important;
    box-shadow: none !important;
  }
  .bg-menu-theme.menu-vertical .menu-item.open > .menu-toggle::after {
    width: 10px !important;
    height: 1.8px !important;
    background-color: #ff5722 !important;
    border: none !important;
    transform: translateY(-50%) !important;
    border-radius: 1px !important;
  }
  .bg-menu-theme.menu-vertical .menu-item.open > .menu-toggle div {
    color: #ff5722 !important;
    font-weight: 600 !important;
  }
  .bg-menu-theme.menu-vertical .menu-item.open > .menu-toggle .menu-icon {
    color: #ff5722 !important;
  }

  /* Submenu container */
  .bg-menu-theme.menu-vertical .menu-sub {
    position: relative !important;
    padding: 0.35rem 0 0.45rem 0 !important;
    margin: 0 !important;
    background: transparent !important;
  }

  /* Submenu items */
  .bg-menu-theme.menu-vertical .menu-sub .menu-item {
    position: relative !important;
    margin: 2px 8px !important;
  }

  /* Continuous vertical tree guide line connecting each node to the next (no excess tail) */
  .bg-menu-theme.menu-vertical .menu-sub .menu-item:not(:last-child)::after {
    content: "" !important;
    position: absolute !important;
    left: 1.85rem !important;
    top: 50% !important;
    height: 100% !important;
    width: 1.5px !important;
    background-color: #e2e8f0 !important;
    transform: translateX(-50%) !important;
    z-index: 1 !important;
    pointer-events: none !important;
  }

  /* Submenu item links */
  .bg-menu-theme.menu-vertical .menu-sub .menu-item .menu-link {
    position: relative !important;
    display: flex !important;
    align-items: center !important;
    padding: 0.46rem 1rem 0.46rem 2.85rem !important;
    font-size: 0.88rem !important;
    color: #64748b !important;
    border-radius: 6px !important;
    margin: 0 !important;
    background: transparent !important;
    box-shadow: none !important;
    transition: all 0.15s ease-in-out !important;
  }

  /* Submenu circular node bullets (hollow ring by default) */
  .bg-menu-theme.menu-vertical .menu-sub .menu-item .menu-link::before {
    content: "" !important;
    position: absolute !important;
    left: 1.85rem !important;
    top: 50% !important;
    transform: translate(-50%, -50%) !important;
    width: 8px !important;
    height: 8px !important;
    border-radius: 50% !important;
    background-color: #ffffff !important;
    border: 1.6px solid #cbd5e1 !important;
    box-sizing: border-box !important;
    z-index: 2 !important;
    transition: all 0.2s ease-in-out !important;
  }

  .bg-menu-theme.menu-vertical .menu-sub .menu-item .menu-link div {
    color: #64748b !important;
    font-size: 0.88rem !important;
    font-weight: 500 !important;
    transition: color 0.15s ease-in-out !important;
  }

  /* Submenu hover */
  .bg-menu-theme.menu-vertical .menu-sub .menu-item:not(.active) .menu-link:hover {
    background-color: transparent !important;
  }
  .bg-menu-theme.menu-vertical .menu-sub .menu-item:not(.active) .menu-link:hover::before {
    border-color: #ff5722 !important;
    background-color: #ffffff !important;
    transform: translate(-50%, -50%) scale(1.15) !important;
  }
  .bg-menu-theme.menu-vertical .menu-sub .menu-item:not(.active) .menu-link:hover div {
    color: #ff5722 !important;
  }

  /* Submenu active item */
  .bg-menu-theme.menu-vertical .menu-sub .menu-item.active > .menu-link {
    background: transparent !important;
    box-shadow: none !important;
  }
  .bg-menu-theme.menu-vertical .menu-sub .menu-item.active > .menu-link::before {
    width: 8.5px !important;
    height: 8.5px !important;
    background-color: #ff5722 !important;
    border: 2px solid #ffffff !important;
    box-shadow: 0 0 0 1.5px #ff5722 !important;
    transform: translate(-50%, -50%) !important;
  }
  .bg-menu-theme.menu-vertical .menu-sub .menu-item.active > .menu-link div {
    color: #ff5722 !important;
    font-weight: 600 !important;
  }

  /* Top-level active menu item styling (Leaf items like Dashboard only) */
  .bg-menu-theme.menu-vertical .menu-inner > .menu-item.active > .menu-link:not(.menu-toggle) {
    background: linear-gradient(270deg, #ff7849 0%, #ff5722 100%) !important;
    box-shadow: 0px 2px 8px 0px rgba(255, 87, 34, 0.45) !important;
    color: #ffffff !important;
  }
  .bg-menu-theme.menu-vertical .menu-inner > .menu-item.active > .menu-link:not(.menu-toggle) .menu-icon,
  .bg-menu-theme.menu-vertical .menu-inner > .menu-item.active > .menu-link:not(.menu-toggle) div {
    color: #ffffff !important;
  }

  /* Hide floating tooltip in normal (expanded) state */
  .menu-floating-tooltip {
    display: none !important;
  }

  /* Submenu icons in expanded state */
  .bg-menu-theme.menu-vertical .menu-sub .menu-item .menu-link .menu-icon {
    font-size: 1.15rem !important;
    margin-right: 0.5rem !important;
  }
  .bg-menu-theme.menu-vertical .menu-sub .menu-item .menu-link:has(.menu-icon)::before {
    display: none !important;
  }
  .bg-menu-theme.menu-vertical .menu-sub .menu-item .menu-link:has(.menu-icon) {
    padding-left: 2.2rem !important;
  }

  /* Menu Toggle SVG Icon Styling (Matching Reference Images 1 & 2) */
  .menu-toggle-custom-svg {
    stroke: #64748b !important;
  }
  .sidebar-toggle-btn,
  .sidebar-toggle-btn:hover,
  .sidebar-toggle-btn:focus,
  .navbar-toggle-desktop a,
  .navbar-toggle-desktop a:hover,
  .navbar-toggle-desktop a:focus {
    background: transparent !important;
    background-color: transparent !important;
    box-shadow: none !important;
  }
  .sidebar-toggle-btn .menu-toggle-custom-svg,
  .sidebar-toggle-btn:hover .menu-toggle-custom-svg,
  .navbar-toggle-desktop .menu-toggle-custom-svg,
  .navbar-toggle-desktop:hover .menu-toggle-custom-svg {
    stroke: #64748b !important;
  }

  /* =========================================================================
     COLLAPSED SIDEBAR HOVER TOOLTIP & FLOATING SUBMENU (Matching Reference)
     ========================================================================= */
  @media (min-width: 1200px) {
    /* Toggle Button Placement:
       - Open: show in sidebar (Image 1 style)
       - Closed: show in navbar (Image 2 style) */
    html:not(.layout-menu-collapsed) .sidebar-toggle-btn {
      display: flex !important;
    }
    html:not(.layout-menu-collapsed) .navbar-toggle-desktop {
      display: none !important;
    }
    html.layout-menu-collapsed .sidebar-toggle-btn {
      display: none !important;
    }
    html.layout-menu-collapsed .navbar-toggle-desktop {
      display: flex !important;
    }
    html.layout-menu-collapsed .app-brand {
      justify-content: center !important;
      padding: 0 !important;
    }
    html.layout-menu-collapsed .app-brand-link {
      margin: 0 auto !important;
    }

    /* Allow floating tooltips and popups to overflow the collapsed sidebar */
    html.layout-menu-collapsed #layout-menu,
    html.layout-menu-collapsed #layout-menu .menu-inner {
      overflow: visible !important;
    }

    /* Lock collapsed sidebar width strictly to 4.375rem */
    html.layout-menu-collapsed:not(.layout-menu-expanded) .layout-menu,
    html.layout-menu-collapsed:not(.layout-menu-expanded) .layout-menu.menu-vertical,
    html.layout-menu-collapsed:not(.layout-menu-expanded) .layout-menu .menu-vertical {
      width: 4.375rem !important;
      overflow: visible !important;
    }

    /* Hide root-level text, headers, and app-brand text in collapsed state */
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item > .menu-link > div,
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-header,
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-block,
    html.layout-menu-collapsed:not(.layout-menu-expanded) .app-brand-text,
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item > .menu-toggle::after {
      opacity: 0 !important;
      visibility: hidden !important;
      width: 0 !important;
      display: none !important;
    }

    /* Hover highlight around root item icon in collapsed sidebar */
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item {
      position: relative !important;
    }
    /* Hover bridge on menu-item to bridge gap to floating popup card */
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item:has(.menu-sub)::after,
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item:has(.menu-toggle)::after {
      content: "" !important;
      position: absolute !important;
      top: -10px !important;
      right: -30px !important;
      width: 40px !important;
      bottom: -10px !important;
      background: transparent !important;
      z-index: 1050 !important;
    }
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item:hover > .menu-link {
      background: #ffede7 !important;
      border-radius: 12px !important;
    }
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item:hover > .menu-link .menu-icon {
      color: #ff5722 !important;
    }

    /* Dark Tooltip Badge */
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item:hover > .menu-floating-tooltip {
      display: inline-flex !important;
      align-items: center;
      position: absolute !important;
      left: calc(100% + 12px) !important;
      top: 50% !important;
      transform: translateY(-50%) !important;
      background: #202938 !important;
      opacity: 1 !important;
      color: #ffffff !important;
      font-size: 0.78rem !important;
      font-weight: 500 !important;
      padding: 6px 14px !important;
      border-radius: 6px !important;
      white-space: nowrap !important;
      z-index: 1105 !important;
      box-shadow: 0 4px 14px rgba(15, 23, 42, 0.28) !important;
      pointer-events: none !important;
      animation: menuPopupFade 0.15s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    /* Left-pointing arrow on dark tooltip */
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item .menu-floating-tooltip::before {
      content: "";
      position: absolute;
      right: 100%;
      top: 50%;
      transform: translateY(-50%);
      border-width: 5px 6px 5px 0;
      border-style: solid;
      border-color: transparent #202938 transparent transparent;
    }

    /* When menu-item has a submenu, position tooltip at the top */
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item:has(.menu-sub):hover > .menu-floating-tooltip,
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item:hover > .menu-link.menu-toggle + .menu-floating-tooltip {
      top: 0px !important;
      transform: none !important;
    }
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item:has(.menu-sub) .menu-floating-tooltip::before,
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item .menu-link.menu-toggle + .menu-floating-tooltip::before {
      top: 14px !important;
    }

    /* Floating Submenu Popup Card */
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item > .menu-sub {
      display: none !important;
      position: absolute !important;
      left: calc(100% + 12px) !important;
      top: 32px !important;
      min-width: 195px !important;
      background: #ffffff !important;
      border-radius: 12px !important;
      box-shadow: 0 10px 30px -4px rgba(0, 0, 0, 0.14), 0 4px 10px -2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(0, 0, 0, 0.05) !important;
      padding: 8px !important;
      margin: 0 !important;
      z-index: 1100 !important;
      list-style: none !important;
    }
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item > .menu-sub::before {
      display: none !important;
    }

    /* Invisible hover bridge between icon and floating card */
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item > .menu-sub::after {
      content: "" !important;
      position: absolute !important;
      top: -45px !important;
      left: -35px !important;
      bottom: -20px !important;
      width: 45px !important;
      background: transparent !important;
      z-index: 1050 !important;
    }

    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item:hover > .menu-sub {
      display: block !important;
      animation: menuPopupFade 0.18s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    /* Submenu links inside floating card */
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item > .menu-sub .menu-item {
      margin: 0 0 2px 0 !important;
      width: 100% !important;
      position: static !important;
    }
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item > .menu-sub .menu-item::before,
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item > .menu-sub .menu-item::after {
      display: none !important;
    }
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item > .menu-sub .menu-item .menu-link {
      display: flex !important;
      align-items: center !important;
      padding: 9px 14px !important;
      border-radius: 8px !important;
      font-size: 0.88rem !important;
      color: #334155 !important;
      margin: 0 !important;
      text-decoration: none !important;
      background: transparent !important;
      box-shadow: none !important;
      transition: all 0.15s ease !important;
    }
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item > .menu-sub .menu-item .menu-link::before,
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item > .menu-sub .menu-item .menu-link::after {
      display: none !important;
    }
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item > .menu-sub .menu-item .menu-link div {
      opacity: 1 !important;
      visibility: visible !important;
      width: auto !important;
      display: block !important;
      font-weight: 500 !important;
      color: inherit !important;
    }
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item > .menu-sub .menu-item .menu-link .menu-icon {
      font-size: 1.15rem !important;
      margin-right: 10px !important;
      color: inherit !important;
      display: inline-block !important;
    }

    /* Submenu item hover inside floating card */
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item > .menu-sub .menu-item:not(.active) .menu-link:hover {
      background-color: #f8fafc !important;
      color: #ff5722 !important;
    }
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item > .menu-sub .menu-item:not(.active) .menu-link:hover div,
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item > .menu-sub .menu-item:not(.active) .menu-link:hover .menu-icon {
      color: #ff5722 !important;
    }

    /* Submenu active item inside floating card */
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item > .menu-sub .menu-item.active .menu-link {
      background-color: #fff1ee !important;
      color: #ff5722 !important;
    }
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item > .menu-sub .menu-item.active .menu-link div,
    html.layout-menu-collapsed:not(.layout-menu-expanded) .menu-inner > .menu-item > .menu-sub .menu-item.active .menu-link .menu-icon {
      color: #ff5722 !important;
      font-weight: 600 !important;
    }

    @keyframes menuPopupFade {
      from {
        opacity: 0;
        transform: translateX(-5px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }
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
  <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>

  @stack('scripts')
</body>

</html>