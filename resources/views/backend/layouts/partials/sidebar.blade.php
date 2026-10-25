<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ route('backend.dashboard') }}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="{{ asset('assets/img/logo-img/logo2.png') }}" alt="TrendWear Logo"
          style="height: 52px; width: auto; object-fit: contain; vertical-align: middle;">
      </span>
      <span class="app-brand-text demo menu-text fw-bold" style="vertical-align: middle;">Trend wear</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto sidebar-toggle-btn d-none d-xl-flex">
      <svg class="menu-toggle-custom-svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 6h9M3 12h9M3 18h9M18 7l-4 5 4 5" />
      </svg>
    </a>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="ti ti-x ti-md align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- SECTION: Dashboard -->
    <li class="menu-header small">
      <span class="menu-header-text">Dashboard</span>
    </li>

    <!-- Dashboard -->
    <li class="menu-item {{ request()->routeIs('backend.dashboard') ? 'active' : '' }}" id="menu_dashboard">
      <a href="{{ route('backend.dashboard') }}" class="menu-link">
        <i class="menu-icon ti ti-smart-home"></i>
        <div data-i18n="Dashboard">Dashboard</div>
      </a>
      <div class="menu-floating-tooltip">Dashboard</div>
    </li>

    <!-- SECTION: Modules -->
    <li class="menu-header small">
      <span class="menu-header-text">Modules</span>
    </li>

    <li class="menu-item {{ request()->routeIs('user.*', 'superadmin.*', 'admin.*', 'staff.*', 'inventorymanager.*', 'customer.*', 'backend.superadmin', 'backend.admin', 'backend.staff', 'backend.inventorymanager', 'backend.customer') ? 'active open' : '' }}" id="menu_user_management">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon ti ti-users"></i>
        <div>User Management</div>
      </a>
      <div class="menu-floating-tooltip">User Management</div>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('user.index') ? 'active' : '' }}" id="menu_user_sub">
          <a href="{{ route('user.index') }}" class="menu-link">
            <div data-i18n="Users">All Users</div>
          </a>
        </li>
      </ul>
    </li>

    <li class="menu-item {{ request()->routeIs('productmanagement.*', 'category.*', 'item_master*') ? 'active open' : '' }}" id="menu_product_management">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon ti ti-box"></i>
        <div>Product Management</div>
      </a>
      <div class="menu-floating-tooltip">Product Management</div>

      <ul class="menu-sub">

        <li class="menu-item {{ request()->routeIs('productmanagement.item_master', 'item_master*') ? 'active' : '' }}" id="menu_item_master_sub">
          <a href="{{ route('productmanagement.item_master') }}" class="menu-link">
            <div data-i18n="Item Master">Item Master</div>
          </a>
        </li>

        <li class="menu-item {{ request()->routeIs('productmanagement.categories', 'categories*') ? 'active' : '' }}" id="menu_category_sub">
          <a href="{{ route('productmanagement.categories') }}" class="menu-link">
            <div data-i18n="Categories">Categories</div>
          </a>
        </li>

        <li class="menu-item {{ request()->routeIs('productmanagement.sub_categories', 'sub_categories*') ? 'active' : '' }}" id="menu_category_sub">
          <a href="{{ route('productmanagement.sub_categories') }}" class="menu-link">
            <div data-i18n="Sub Categories">Sub Categories</div>
          </a>
        </li>

        <li class="menu-item {{ request()->routeIs('productmanagement.brands', 'brands*') ? 'active' : '' }}" id="menu_category_sub">
          <a href="{{ route('productmanagement.brands') }}" class="menu-link">
            <div data-i18n="Brand">Brand</div>
          </a>
        </li>

      </ul>

    </li>

  </ul>
</aside>