<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="index.html" class="app-brand-link">
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
    <li class="menu-header small">
      <span class="menu-header-text" data-i18n="Apps & Pages">Menus</span>
    </li>
    <li class="menu-item">
      <a href="" class="menu-link">
        <i class="menu-icon fa-solid fa-table-columns"></i>
        <div data-i18n="Dashboards">Dashboards</div>
      </a>
    </li>

    <li class="menu-item">
    <a href="{{ route('user.index') }}" class="menu-link">
        <i class="menu-icon fa-solid fa-users"></i>
        <div>User Management</div>
    </a>
</li>
  

  </ul>
</aside>