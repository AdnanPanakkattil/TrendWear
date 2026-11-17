<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ route('backend.dashboard') }}" class="app-brand-link">
      <span class="app-brand-logo demo">
        <svg class="tw-brand-logo-svg" viewBox="0 0 568 372" fill="currentColor" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="TrendWear Logo"
          style="height: 26px; width: auto; color: var(--tw-primary); vertical-align: middle; transition: color 0.15s ease;">
          <path d="M2 0 L287 0 L302 10 L309 24 L326 68 L145 70 L172 103 L179 117 L180 327 L177 371 L118 328 L111 315 L111 70 L39 69 L31 66 L24 59 L3 12 Z" />
          <path d="M503 98 L566 98 L567 102 L463 360 L452 366 L418 366 L407 360 L349 244 L298 355 L284 366 L271 363 L263 352 L200 191 L201 133 L237 131 L247 139 L284 234 L328 139 L340 131 L360 134 L370 145 L426 258 L481 117 L489 106 Z" />
        </svg>
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

        <li class="menu-item {{ request()->routeIs('productmanagement.brands', 'brands*') ? 'active' : '' }}" id="menu_brand_sub">
          <a href="{{ route('productmanagement.brands') }}" class="menu-link">
            <div data-i18n="Brand">Brand</div>
          </a>
        </li>

        <li class="menu-item {{ request()->routeIs('productmanagement.sizes*', 'sizes*') ? 'active' : '' }}" id="menu_size_management_sub">
          <a href="{{ route('productmanagement.sizes') }}" class="menu-link">
            <div data-i18n="Size Management">Size Management</div>
          </a>
        </li>

        <li class="menu-item {{ request()->routeIs('productmanagement.colors*', 'colors*') ? 'active' : '' }}" id="menu_color_management_sub">
          <a href="{{ route('productmanagement.colors') }}" class="menu-link">
            <div data-i18n="Color Management">Color Management</div>
          </a>
        </li>

      </ul>

    </li>

  </ul>
</aside>