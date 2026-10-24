<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ route('backend.dashboard') }}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="{{ asset('assets/img/logo-img/logo2.png') }}" alt="TrendWear Logo"
          style="height: 70px; width: auto; object-fit: contain; vertical-align: middle;">
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
    <!-- Apps & Pages -->
    <li class="menu-item" id="dashboard_menu">
      <a href="{{ route('backend.dashboard') }}" class="menu-link">
        <i class="menu-icon fa-solid fa-table-columns"></i>
        <div data-i18n="Dashboards">Dashboards</div>
      </a>
    </li>

    <li class="menu-item" id="User_management_menu">
      <a href="{{ route('user.index') }}" class="menu-link">
        <i class="menu-icon fa-solid fa-users"></i>
        <div>User Management</div>
      </a>
    </li>

    <li class="menu-item menu-dropdown" id="Product_management_menu">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon fa-solid fa-box"></i>
        <div>Product Management</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item" id="Category_management_menu">
          <a href="{{ route('category.index') }}" class="menu-link">
            <i class="menu-icon fa-solid fa-tags"></i>
            <div>Categories</div>
          </a>
        </li>
      </ul>
    </li>


  </ul>
</aside>