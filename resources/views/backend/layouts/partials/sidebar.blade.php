<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ route('backend.dashboard') }}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="{{ asset('assets/img/logo-img/logo2.png') }}" alt="TrendWear Logo"
          style="height: 52px; width: auto; object-fit: contain; vertical-align: middle;">
      </span>
      <span class="app-brand-text demo menu-text fw-bold" style="vertical-align: middle;">Trend wear</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
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
    </li>

    <!-- SECTION: Modules -->
    <li class="menu-header small">
      <span class="menu-header-text">Modules</span>
    </li>

    <li class="menu-item {{ request()->routeIs('user.*') ? 'active open' : '' }}" id="menu_user_management">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon ti ti-users"></i>
        <div>User Management</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('user.*') ? 'active' : '' }}" id="menu_user_sub">
          <a href="{{ route('user.index') }}" class="menu-link">
            <div data-i18n="User">User</div>
          </a>
        </li>
      </ul>
    </li>

    <li class="menu-item {{ request()->routeIs('category.*') ? 'active open' : '' }}" id="menu_product_management">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon ti ti-box"></i>
        <div>Product Management</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->routeIs('category.*') ? 'active' : '' }}" id="menu_category_sub">
          <a href="{{ route('category.index') }}" class="menu-link">
            <div data-i18n="Categories">Categories</div>
          </a>
        </li>
      </ul>
    </li>

  </ul>
</aside>