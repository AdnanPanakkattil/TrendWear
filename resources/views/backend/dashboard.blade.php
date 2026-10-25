@extends('backend.layouts.backendLayout')
@section('title', 'eCommerce Dashboard')

@section('content')
<div class="row g-3">
  <!-- ========================================== -->
  <!-- FULL WIDTH HEADER: GREETING & DATE PICKER -->
  <!-- ========================================== -->
  <div class="col-12">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-1">
      <div>
        <h4 class="fw-bold mb-1 text-dark" style="font-size: 1.3rem;">Good Morning, Anna!</h4>
        <p class="text-muted mb-0" style="font-size: 0.85rem;">Here's what's happening with your store today.</p>
      </div>
      <div class="d-flex align-items-center">
        <!-- Date Picker Box -->
        <div class="date-picker-box">
          <input type="text" id="dashboardDatePicker" class="form-control form-control-sm border-0 bg-transparent p-0 shadow-none" style="width: 185px; font-size: 0.82rem; cursor: pointer;" value="01 Jan, 2026 to 31 Jan, 2026" readonly>
          <div class="rounded p-1 ms-2 d-flex align-items-center justify-content-center text-white" style="width: 26px; height: 26px; background-color: var(--tw-primary) !important;">
            <i class="ti ti-calendar ti-xs"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ========================================== -->
  <!-- MAIN / LEFT DASHBOARD COLUMN (col-xxl-9 col-lg-8) -->
  <!-- ========================================== -->
  <div class="col-xxl-9 col-lg-8 col-12">
    <!-- Row of 4 Summary Metric Cards -->
    <div class="row g-3 mb-3">
      <!-- 1. TOTAL EARNINGS -->
      <div class="col-xl-3 col-sm-6">
        <div class="metric-card">
          <div>
            <div class="d-flex align-items-center justify-content-between">
              <span class="metric-title">TOTAL EARNINGS</span>
              <span class="metric-badge success">
                <i class="ti ti-arrow-up-right ti-xs"></i> +16.24 %
              </span>
            </div>
            <div class="metric-value">$559.25k</div>
          </div>
          <div class="d-flex align-items-center justify-content-between mt-2">
            <a href="javascript:void(0);" class="metric-link">View net earnings</a>
            <div class="metric-icon-box" style="background-color: #daf5e6; color: #0ab39c;">
              <i class="ti ti-currency-dollar"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- 2. ORDERS -->
      <div class="col-xl-3 col-sm-6">
        <div class="metric-card">
          <div>
            <div class="d-flex align-items-center justify-content-between">
              <span class="metric-title">ORDERS</span>
              <span class="metric-badge danger">
                <i class="ti ti-arrow-down-right ti-xs"></i> -3.57 %
              </span>
            </div>
            <div class="metric-value">36,894</div>
          </div>
          <div class="d-flex align-items-center justify-content-between mt-2">
            <a href="javascript:void(0);" class="metric-link">View all orders</a>
            <div class="metric-icon-box" style="background-color: #dbeafe; color: #299cdb;">
              <i class="ti ti-shopping-bag"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- 3. CUSTOMERS -->
      <div class="col-xl-3 col-sm-6">
        <div class="metric-card">
          <div>
            <div class="d-flex align-items-center justify-content-between">
              <span class="metric-title">CUSTOMERS</span>
              <span class="metric-badge success">
                <i class="ti ti-arrow-up-right ti-xs"></i> +29.08 %
              </span>
            </div>
            <div class="metric-value">183.35M</div>
          </div>
          <div class="d-flex align-items-center justify-content-between mt-2">
            <a href="javascript:void(0);" class="metric-link">See details</a>
            <div class="metric-icon-box" style="background-color: #fef3c7; color: #f59e0b;">
              <i class="ti ti-user"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- 4. MY BALANCE -->
      <div class="col-xl-3 col-sm-6">
        <div class="metric-card">
          <div>
            <div class="d-flex align-items-center justify-content-between">
              <span class="metric-title">MY BALANCE</span>
              <span class="metric-badge neutral">+0.00 %</span>
            </div>
            <div class="metric-value">$165.89k</div>
          </div>
          <div class="d-flex align-items-center justify-content-between mt-2">
            <a href="javascript:void(0);" class="metric-link">Withdraw money</a>
            <div class="metric-icon-box" style="background-color: var(--tw-primary-light); color: var(--tw-primary);">
              <i class="ti ti-credit-card"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Row: Revenue & Sales by Locations -->
    <div class="row g-3 mb-3 align-items-stretch">
      <!-- Revenue Card (approx col-xl-8) -->
      <div class="col-xl-8 col-12">
        <div class="tw-card h-100">
          <div class="tw-card-header">
            <h5 class="tw-card-title">Revenue</h5>
            <div class="btn-group btn-group-pill" role="group">
              <button type="button" class="btn btn-soft-secondary active">ALL</button>
              <button type="button" class="btn btn-soft-secondary">1M</button>
              <button type="button" class="btn btn-soft-secondary">6M</button>
              <button type="button" class="btn btn-soft-secondary">1Y</button>
            </div>
          </div>
          <div class="tw-card-body">
            <!-- Summary row -->
            <div class="row revenue-summary-row g-0">
              <div class="col-3 revenue-summary-item">
                <div class="revenue-summary-val">7,585</div>
                <div class="revenue-summary-lbl">Orders</div>
              </div>
              <div class="col-3 revenue-summary-item">
                <div class="revenue-summary-val">$22.89k</div>
                <div class="revenue-summary-lbl">Earnings</div>
              </div>
              <div class="col-3 revenue-summary-item">
                <div class="revenue-summary-val">367</div>
                <div class="revenue-summary-lbl">Refunds</div>
              </div>
              <div class="col-3 revenue-summary-item">
                <div class="revenue-summary-val" style="color: #0ab39c;">18.92%</div>
                <div class="revenue-summary-lbl">Conversation Ratio</div>
              </div>
            </div>

            <!-- Revenue ApexChart -->
            <div id="revenueApexChart" style="min-height: 290px;"></div>
          </div>
        </div>
      </div>

      <!-- Sales by Locations Card (approx col-xl-4) -->
      <div class="col-xl-4 col-12">
        <div class="tw-card h-100">
          <div class="tw-card-header">
            <h5 class="tw-card-title">Sales by Locations</h5>
            <button type="button" class="btn btn-soft-primary">Export Report</button>
          </div>
          <div class="tw-card-body d-flex flex-column justify-content-between">
            <!-- Vector World Map SVG -->
            <div class="world-map-svg-container my-1">
              <svg viewBox="0 0 800 420" style="width: 100%; height: 100%;" stroke-width="0.8">
                <!-- Continents -->
                <path d="M90,70 Q130,50 170,55 Q210,40 230,70 Q250,90 270,75 Q290,110 260,150 Q230,190 200,210 Q160,225 140,180 Q100,160 85,120 Q80,90 90,70 Z" />
                <path d="M310,35 Q350,25 380,45 Q375,85 345,100 Q305,85 310,35 Z" />
                <path d="M220,230 Q265,240 285,280 Q275,340 250,385 Q220,360 210,310 Q205,260 220,230 Z" />
                <path d="M400,85 Q465,65 490,95 Q485,140 450,155 Q405,150 400,85 Z" />
                <path d="M410,165 Q475,165 495,215 Q485,300 445,340 Q405,310 385,245 Q395,185 410,165 Z" />
                <path d="M495,65 Q600,45 720,70 Q750,135 700,175 Q640,205 570,195 Q515,155 495,65 Z" />
                <path d="M640,275 Q700,265 730,305 Q720,355 670,365 Q625,335 640,275 Z" />

                <!-- Location Pins -->
                <!-- Canada -->
                <circle cx="165" cy="115" r="4.5" fill="#ff5722" />
                <circle cx="165" cy="115" r="9" fill="#ff5722" opacity="0.25" />
                <text x="178" y="119" font-size="11" font-weight="600">Canada</text>

                <!-- Greenland -->
                <circle cx="340" cy="65" r="4.5" fill="#ff8a65" />
                <circle cx="340" cy="65" r="9" fill="#ff8a65" opacity="0.25" />
                <text x="353" y="69" font-size="11" font-weight="600">Greenland</text>

                <!-- Russia -->
                <circle cx="610" cy="95" r="4.5" fill="#e64a19" />
                <circle cx="610" cy="95" r="9" fill="#e64a19" opacity="0.25" />
                <text x="623" y="99" font-size="11" font-weight="600">Russia</text>

                <!-- Palestine -->
                <circle cx="475" cy="155" r="4.5" fill="#0ab39c" />
                <circle cx="475" cy="155" r="9" fill="#0ab39c" opacity="0.25" />
                <text x="488" y="159" font-size="11" font-weight="600">Palestine</text>
              </svg>
            </div>

            <!-- Country Progress Bars -->
            <div class="mt-2">
              <div class="mb-3">
                <div class="d-flex justify-content-between mb-1" style="font-size: 0.81rem; font-weight: 500;">
                  <span>Canada</span>
                  <span class="fw-bold">75%</span>
                </div>
                <div class="progress" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 75%; background-color: var(--tw-primary);" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="mb-3">
                <div class="d-flex justify-content-between mb-1" style="font-size: 0.81rem; font-weight: 500;">
                  <span>Greenland</span>
                  <span class="fw-bold">47%</span>
                </div>
                <div class="progress" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 47%; background-color: #ff8a65;" aria-valuenow="47" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="mb-1">
                <div class="d-flex justify-content-between mb-1" style="font-size: 0.81rem; font-weight: 500;">
                  <span>Russia</span>
                  <span class="fw-bold">82%</span>
                </div>
                <div class="progress" style="height: 5px;">
                  <div class="progress-bar" role="progressbar" style="width: 82%; background-color: #e64a19;" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Row: Best Selling Products & Top Sellers -->
    <div class="row g-3 mb-3 align-items-stretch">
      <!-- Best Selling Products (col-xl-6) -->
      <div class="col-xl-6 col-12">
        <div class="tw-card h-100">
          <div class="tw-card-header">
            <h5 class="tw-card-title">Best Selling Products</h5>
            <div class="dropdown">
              <button class="btn btn-soft-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                SORT BY: <span class="fw-semibold">Today</span>
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="javascript:void(0);">Today</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Yesterday</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Last 7 Days</a></li>
              </ul>
            </div>
          </div>
          <div class="tw-card-body p-0">
            <div class="table-responsive">
              <table class="table tw-table align-middle">
                <tbody>
                  <!-- 1 -->
                  <tr>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <div class="prod-thumb" style="background: var(--tw-primary-light);">
                          <i class="ti ti-shirt text-danger fs-5"></i>
                        </div>
                        <div>
                          <div class="fw-semibold text-dark">Branded T-Shirts</div>
                          <div class="text-muted" style="font-size: 0.72rem;">24 Apr 2021</div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Price</div>
                      <div class="fw-bold text-dark">$29.00</div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Orders</div>
                      <div class="fw-bold text-dark">62</div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Stock</div>
                      <div class="fw-semibold text-dark">510</div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Amount</div>
                      <div class="fw-bold text-dark">$1,798</div>
                    </td>
                  </tr>

                  <!-- 2 -->
                  <tr>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <div class="prod-thumb" style="background: #edf2f7;">
                          <i class="ti ti-armchair text-secondary fs-5"></i>
                        </div>
                        <div>
                          <div class="fw-semibold text-dark">Bentwood Chair</div>
                          <div class="text-muted" style="font-size: 0.72rem;">19 Mar 2021</div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Price</div>
                      <div class="fw-bold text-dark">$85.20</div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Orders</div>
                      <div class="fw-bold text-dark">35</div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Stock</div>
                      <span class="badge-soft-danger">Out of stock</span>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Amount</div>
                      <div class="fw-bold text-dark">$2982</div>
                    </td>
                  </tr>

                  <!-- 3 -->
                  <tr>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <div class="prod-thumb" style="background: #eef2ff;">
                          <i class="ti ti-cup text-primary fs-5"></i>
                        </div>
                        <div>
                          <div class="fw-semibold text-dark">Borosil Paper Cup</div>
                          <div class="text-muted" style="font-size: 0.72rem;">01 Mar 2021</div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Price</div>
                      <div class="fw-bold text-dark">$14.00</div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Orders</div>
                      <div class="fw-bold text-dark">80</div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Stock</div>
                      <div class="fw-semibold text-dark">749</div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Amount</div>
                      <div class="fw-bold text-dark">$1120</div>
                    </td>
                  </tr>

                  <!-- 4 -->
                  <tr>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <div class="prod-thumb" style="background: #f1f5f9;">
                          <i class="ti ti-sofa text-dark fs-5"></i>
                        </div>
                        <div>
                          <div class="fw-semibold text-dark">One Seater Sofa</div>
                          <div class="text-muted" style="font-size: 0.72rem;">11 Feb 2021</div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Price</div>
                      <div class="fw-bold text-dark">$127.50</div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Orders</div>
                      <div class="fw-bold text-dark">56</div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Stock</div>
                      <span class="badge-soft-danger">Out of stock</span>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Amount</div>
                      <div class="fw-bold text-dark">$7140</div>
                    </td>
                  </tr>

                  <!-- 5 -->
                  <tr>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <div class="prod-thumb" style="background: #e6fffa;">
                          <i class="ti ti-shield text-success fs-5"></i>
                        </div>
                        <div>
                          <div class="fw-semibold text-dark">Stillbird Helmet</div>
                          <div class="text-muted" style="font-size: 0.72rem;">17 Jan 2021</div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Price</div>
                      <div class="fw-bold text-dark">$54</div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Orders</div>
                      <div class="fw-bold text-dark">74</div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Stock</div>
                      <div class="fw-semibold text-dark">805</div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Amount</div>
                      <div class="fw-bold text-dark">$3996</div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Table pagination footer -->
            <div class="d-flex align-items-center justify-content-between p-3 border-top" style="font-size: 0.8rem; border-color: var(--tw-border-color) !important;">
              <span class="text-muted">Showing 5 of 25 Results</span>
              <ul class="pagination pagination-sm mb-0">
                <li class="page-item"><a class="page-link" href="javascript:void(0);">&lt;</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
                <li class="page-item active"><a class="page-link" href="javascript:void(0);">2</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0);">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- Top Sellers (col-xl-6) -->
      <div class="col-xl-6 col-12">
        <div class="tw-card h-100">
          <div class="tw-card-header">
            <h5 class="tw-card-title">Top Sellers</h5>
            <div class="dropdown">
              <button class="btn btn-soft-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                Report
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="javascript:void(0);">Download Report</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Export Data</a></li>
              </ul>
            </div>
          </div>
          <div class="tw-card-body p-0">
            <div class="table-responsive">
              <table class="table tw-table align-middle">
                <tbody>
                  <!-- 1 -->
                  <tr>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <div class="prod-thumb" style="background: var(--tw-primary); color: #fff;">
                          <i class="ti ti-polygon fs-5"></i>
                        </div>
                        <div>
                          <div class="fw-semibold text-dark">iTest Factory</div>
                          <div class="text-muted" style="font-size: 0.72rem;">Oliver Tyler</div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="fw-medium text-dark" style="font-size: 0.78rem;">Bags and Wallets</div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Stock</div>
                      <div class="fw-semibold text-dark">8547</div>
                    </td>
                    <td>
                      <div class="fw-bold text-dark">$541200</div>
                    </td>
                    <td>
                      <span class="text-success fw-semibold" style="font-size: 0.78rem;">32% <i class="ti ti-chart-bar fs-6"></i></span>
                    </td>
                  </tr>

                  <!-- 2 -->
                  <tr>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <div class="prod-thumb" style="background: #299cdb; color: #fff;">
                          <i class="ti ti-device-watch fs-5"></i>
                        </div>
                        <div>
                          <div class="fw-semibold text-dark">Digitech Galaxy</div>
                          <div class="text-muted" style="font-size: 0.72rem;">John Roberts</div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="fw-medium text-dark" style="font-size: 0.78rem;">Watches</div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Stock</div>
                      <div class="fw-semibold text-dark">895</div>
                    </td>
                    <td>
                      <div class="fw-bold text-dark">$75030</div>
                    </td>
                    <td>
                      <span class="text-success fw-semibold" style="font-size: 0.78rem;">79% <i class="ti ti-chart-bar fs-6"></i></span>
                    </td>
                  </tr>

                  <!-- 3 -->
                  <tr>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <div class="prod-thumb" style="background: #f7b84b; color: #fff;">
                          <i class="ti ti-leaf fs-5"></i>
                        </div>
                        <div>
                          <div class="fw-semibold text-dark">Nesta Technologies</div>
                          <div class="text-muted" style="font-size: 0.72rem;">Harley Fuller</div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="fw-medium text-dark" style="font-size: 0.78rem;">Bike Accessories</div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Stock</div>
                      <div class="fw-semibold text-dark">3470</div>
                    </td>
                    <td>
                      <div class="fw-bold text-dark">$45600</div>
                    </td>
                    <td>
                      <span class="text-success fw-semibold" style="font-size: 0.78rem;">90% <i class="ti ti-chart-bar fs-6"></i></span>
                    </td>
                  </tr>

                  <!-- 4 -->
                  <tr>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <div class="prod-thumb" style="background: #0ab39c; color: #fff;">
                          <i class="ti ti-hanger fs-5"></i>
                        </div>
                        <div>
                          <div class="fw-semibold text-dark">Zoetic Fashion</div>
                          <div class="text-muted" style="font-size: 0.72rem;">James Bowen</div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="fw-medium text-dark" style="font-size: 0.78rem;">Clothes</div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Stock</div>
                      <div class="fw-semibold text-dark">5488</div>
                    </td>
                    <td>
                      <div class="fw-bold text-dark">$29456</div>
                    </td>
                    <td>
                      <span class="text-success fw-semibold" style="font-size: 0.78rem;">40% <i class="ti ti-chart-bar fs-6"></i></span>
                    </td>
                  </tr>

                  <!-- 5 -->
                  <tr>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <div class="prod-thumb" style="background: #f06548; color: #fff;">
                          <i class="ti ti-swirl fs-5"></i>
                        </div>
                        <div>
                          <div class="fw-semibold text-dark">Meta4Systems</div>
                          <div class="text-muted" style="font-size: 0.72rem;">Zoe Dennis</div>
                        </div>
                      </div>
                    </td>
                    <td>
                      <div class="fw-medium text-dark" style="font-size: 0.78rem;">Furniture</div>
                    </td>
                    <td>
                      <div class="text-muted" style="font-size: 0.72rem;">Stock</div>
                      <div class="fw-semibold text-dark">4100</div>
                    </td>
                    <td>
                      <div class="fw-bold text-dark">$11260</div>
                    </td>
                    <td>
                      <span class="text-success fw-semibold" style="font-size: 0.78rem;">57% <i class="ti ti-chart-bar fs-6"></i></span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Table pagination footer -->
            <div class="d-flex align-items-center justify-content-between p-3 border-top" style="font-size: 0.8rem; border-color: var(--tw-border-color) !important;">
              <span class="text-muted">Showing 5 of 25 Results</span>
              <ul class="pagination pagination-sm mb-0">
                <li class="page-item"><a class="page-link" href="javascript:void(0);">&lt;</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
                <li class="page-item active"><a class="page-link" href="javascript:void(0);">2</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                <li class="page-item"><a class="page-link" href="javascript:void(0);">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Row: Store Visits by Source & Recent Orders -->
    <div class="row g-3 align-items-stretch">
      <!-- Store Visits by Source (col-xl-4) -->
      <div class="col-xl-4 col-12">
        <div class="tw-card h-100">
          <div class="tw-card-header">
            <h5 class="tw-card-title">Store Visits by Source</h5>
            <div class="dropdown">
              <button class="btn btn-soft-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                Report
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="javascript:void(0);">Download CSV</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Print</a></li>
              </ul>
            </div>
          </div>
          <div class="tw-card-body d-flex flex-column align-items-center justify-content-center">
            <div id="visitsDonutChart" style="width: 100%; min-height: 290px;"></div>
          </div>
        </div>
      </div>

      <!-- Recent Orders (col-xl-8) -->
      <div class="col-xl-8 col-12">
        <div class="tw-card h-100">
          <div class="tw-card-header">
            <h5 class="tw-card-title">Recent Orders</h5>
            <button type="button" class="btn btn-soft-primary" style="font-size: 0.78rem;">
              <i class="ti ti-file-text me-1"></i> Generate Report
            </button>
          </div>
          <div class="tw-card-body p-0">
            <div class="table-responsive">
              <table class="table tw-table align-middle">
                <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Vendor</th>
                    <th>Status</th>
                    <th>Rating</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Order 1 -->
                  <tr>
                    <td>
                      <a href="javascript:void(0);" class="fw-semibold" style="color: var(--tw-primary);">#VZ2112</a>
                    </td>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Alex Smith" class="rounded-circle" style="width: 26px; height: 26px; object-fit: cover;">
                        <span class="fw-medium text-dark">Alex Smith</span>
                      </div>
                    </td>
                    <td>Clothes</td>
                    <td class="fw-bold text-success">$109.00</td>
                    <td>Zoetic Fashion</td>
                    <td><span class="badge-soft-success">Paid</span></td>
                    <td>
                      <span class="text-dark fw-semibold">5.0</span>
                      <span class="text-muted" style="font-size: 0.72rem;">(61 votes)</span>
                    </td>
                  </tr>

                  <!-- Order 2 -->
                  <tr>
                    <td>
                      <a href="javascript:void(0);" class="fw-semibold" style="color: var(--tw-primary);">#VZ2111</a>
                    </td>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <img src="{{ asset('assets/img/avatars/2.png') }}" alt="Jansh Brown" class="rounded-circle" style="width: 26px; height: 26px; object-fit: cover;">
                        <span class="fw-medium text-dark">Jansh Brown</span>
                      </div>
                    </td>
                    <td>Kitchen Storage</td>
                    <td class="fw-bold text-success">$149.00</td>
                    <td>Micro Design</td>
                    <td><span class="badge-soft-warning">Pending</span></td>
                    <td>
                      <span class="text-dark fw-semibold">4.5</span>
                      <span class="text-muted" style="font-size: 0.72rem;">(61 votes)</span>
                    </td>
                  </tr>

                  <!-- Order 3 -->
                  <tr>
                    <td>
                      <a href="javascript:void(0);" class="fw-semibold" style="color: var(--tw-primary);">#VZ2109</a>
                    </td>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <img src="{{ asset('assets/img/avatars/3.png') }}" alt="Ayaan Bowen" class="rounded-circle" style="width: 26px; height: 26px; object-fit: cover;">
                        <span class="fw-medium text-dark">Ayaan Bowen</span>
                      </div>
                    </td>
                    <td>Bike Accessories</td>
                    <td class="fw-bold text-success">$215.00</td>
                    <td>Nesta Technologies</td>
                    <td><span class="badge-soft-success">Paid</span></td>
                    <td>
                      <span class="text-dark fw-semibold">4.9</span>
                      <span class="text-muted" style="font-size: 0.72rem;">(89 votes)</span>
                    </td>
                  </tr>

                  <!-- Order 4 -->
                  <tr>
                    <td>
                      <a href="javascript:void(0);" class="fw-semibold" style="color: var(--tw-primary);">#VZ2108</a>
                    </td>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <img src="{{ asset('assets/img/avatars/4.png') }}" alt="Prezy Mark" class="rounded-circle" style="width: 26px; height: 26px; object-fit: cover;">
                        <span class="fw-medium text-dark">Prezy Mark</span>
                      </div>
                    </td>
                    <td>Furniture</td>
                    <td class="fw-bold text-success">$199.00</td>
                    <td>Syntyce Solutions</td>
                    <td><span class="badge-soft-danger">Unpaid</span></td>
                    <td>
                      <span class="text-dark fw-semibold">4.3</span>
                      <span class="text-muted" style="font-size: 0.72rem;">(47 votes)</span>
                    </td>
                  </tr>

                  <!-- Order 5 -->
                  <tr>
                    <td>
                      <a href="javascript:void(0);" class="fw-semibold" style="color: var(--tw-primary);">#VZ2107</a>
                    </td>
                    <td>
                      <div class="d-flex align-items-center gap-2">
                        <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Vihan Hudda" class="rounded-circle" style="width: 26px; height: 26px; object-fit: cover;">
                        <span class="fw-medium text-dark">Vihan Hudda</span>
                      </div>
                    </td>
                    <td>Bags and Wallets</td>
                    <td class="fw-bold text-success">$330.00</td>
                    <td>iTest Factory</td>
                    <td><span class="badge-soft-success">Paid</span></td>
                    <td>
                      <span class="text-dark fw-semibold">4.7</span>
                      <span class="text-muted" style="font-size: 0.72rem;">(161 votes)</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ========================================== -->
  <!-- RIGHT SIDEBAR COLUMN (col-xxl-3 col-lg-4) -->
  <!-- ========================================== -->
  <div class="col-xxl-3 col-lg-4 col-12">
    <!-- RECENT ACTIVITY Card -->
    <div class="tw-card">
      <div class="tw-card-header">
        <h5 class="tw-card-title text-uppercase" style="font-size: 0.78rem; letter-spacing: 0.05em; color: var(--tw-text-muted);">RECENT ACTIVITY</h5>
      </div>
      <div class="tw-card-body">
        <!-- Activity 1 -->
        <div class="activity-feed-item">
          <div class="activity-icon-badge bg-soft-success" style="color: #0ab39c;">
            <i class="ti ti-shopping-cart"></i>
          </div>
          <div>
            <div class="fw-bold text-dark" style="font-size: 0.82rem;">Purchase by James Price</div>
            <div class="text-muted" style="font-size: 0.75rem;">Product noise evolve smartwatch</div>
            <div class="text-muted mt-1" style="font-size: 0.7rem;">02:14 PM Today</div>
          </div>
        </div>

        <!-- Activity 2 -->
        <div class="activity-feed-item">
          <div class="activity-icon-badge" style="background-color: var(--tw-primary-light); color: var(--tw-primary);">
            <i class="ti ti-tag"></i>
          </div>
          <div>
            <div class="fw-bold text-dark" style="font-size: 0.82rem;">Added new style collection</div>
            <div class="text-muted" style="font-size: 0.75rem;">By Nesta Technologies</div>
            <div class="d-flex gap-2 my-2">
              <div class="prod-thumb metric-icon-box bg-soft-danger" style="width: 32px; height: 32px;">
                <i class="ti ti-shirt text-danger" style="font-size: 0.85rem;"></i>
              </div>
              <div class="prod-thumb metric-icon-box bg-soft-info" style="width: 32px; height: 32px;">
                <i class="ti ti-armchair text-info" style="font-size: 0.85rem;"></i>
              </div>
              <div class="prod-thumb metric-icon-box bg-soft-warning" style="width: 32px; height: 32px;">
                <i class="ti ti-backpack text-warning" style="font-size: 0.85rem;"></i>
              </div>
            </div>
            <div class="text-muted" style="font-size: 0.7rem;">9:47 PM Yesterday</div>
          </div>
        </div>

        <!-- Activity 3 -->
        <div class="activity-feed-item">
          <img src="{{ asset('assets/img/avatars/6.png') }}" alt="Natasha" class="rounded-circle" style="width: 34px; height: 34px; object-fit: cover; flex-shrink: 0; z-index: 1;">
          <div>
            <div class="fw-bold text-dark" style="font-size: 0.82rem;">Natasha Carey have liked the products</div>
            <div class="text-muted" style="font-size: 0.75rem;">Allow users to like products in your WooCommerce store.</div>
            <div class="text-muted mt-1" style="font-size: 0.7rem;">25 Dec, 2021</div>
          </div>
        </div>
      </div>
    </div>

    <!-- TOP 10 CATEGORIES Card -->
    <div class="tw-card">
      <div class="tw-card-header">
        <h5 class="tw-card-title text-uppercase" style="font-size: 0.78rem; letter-spacing: 0.05em; color: var(--tw-text-muted);">TOP 10 CATEGORIES</h5>
      </div>
      <div class="tw-card-body">
        <div class="top-cat-item"><span>1. Mobile &amp; Accessories</span><span class="count">(10,294)</span></div>
        <div class="top-cat-item"><span>2. Desktop</span><span class="count">(6,256)</span></div>
        <div class="top-cat-item"><span>3. Electronics</span><span class="count">(3,479)</span></div>
        <div class="top-cat-item"><span>4. Home &amp; Furniture</span><span class="count">(2,275)</span></div>
        <div class="top-cat-item"><span>5. Grocery</span><span class="count">(1,950)</span></div>
        <div class="top-cat-item"><span>6. Fashion</span><span class="count">(1,582)</span></div>
        <div class="top-cat-item"><span>7. Appliances</span><span class="count">(1,037)</span></div>
        <div class="top-cat-item"><span>8. Beauty, Toys &amp; More</span><span class="count">(924)</span></div>
        <div class="top-cat-item"><span>9. Food &amp; Drinks</span><span class="count">(701)</span></div>
        <div class="top-cat-item"><span>10. Toys &amp; Games</span><span class="count">(239)</span></div>

        <div class="text-center mt-3 pt-2 border-top">
          <a href="javascript:void(0);" class="text-decoration-underline fw-semibold" style="font-size: 0.82rem; color: var(--tw-primary);">View all Categories <i class="ti ti-arrow-right ti-xs"></i></a>
        </div>
      </div>
    </div>

    <!-- PRODUCTS REVIEWS Card -->
    <div class="tw-card">
      <div class="tw-card-header">
        <h5 class="tw-card-title text-uppercase" style="font-size: 0.78rem; letter-spacing: 0.05em; color: var(--tw-text-muted);">PRODUCTS REVIEWS</h5>
      </div>
      <div class="tw-card-body">
        <!-- Review 1 -->
        <div class="p-2 rounded bg-light mb-2">
          <div class="d-flex align-items-center gap-2 mb-1">
            <div class="prod-thumb" style="width: 28px; height: 28px; background: var(--tw-primary-light); color: var(--tw-primary);">
              <i class="ti ti-cube" style="font-size: 0.85rem;"></i>
            </div>
            <div style="font-size: 0.78rem;" class="fst-italic text-dark">"Very beautiful product and Very helpful.."</div>
          </div>
          <div class="d-flex align-items-center justify-content-between mt-1">
            <div>
              <i class="ti ti-star-filled star-gold"></i>
              <i class="ti ti-star-filled star-gold"></i>
              <i class="ti ti-star-filled star-gold"></i>
              <i class="ti ti-star-filled star-gold"></i>
              <i class="ti ti-star-filled star-gold"></i>
            </div>
            <span class="text-muted" style="font-size: 0.72rem;">- by Zoetic Fashion</span>
          </div>
        </div>

        <!-- Review 2 -->
        <div class="p-2 rounded bg-light  mb-2">
          <div class="d-flex align-items-center gap-2 mb-1">
            <img src="{{ asset('assets/img/avatars/7.png') }}" alt="Nancy" class="rounded-circle" style="width: 28px; height: 28px; object-fit: cover;">
            <div style="font-size: 0.78rem;" class="fst-italic text-dark">"The product is very beautiful. I like it. "</div>
          </div>
          <div class="d-flex align-items-center justify-content-between mt-1">
            <div>
              <i class="ti ti-star-filled star-gold"></i>
              <i class="ti ti-star-filled star-gold"></i>
              <i class="ti ti-star-filled star-gold"></i>
              <i class="ti ti-star-filled star-gold"></i>
              <i class="ti ti-star-filled star-gold"></i>
            </div>
            <span class="text-muted" style="font-size: 0.72rem;">- by Nancy Martino</span>
          </div>
        </div>
        <!-- Review 2 -->
        <div class="p-2 rounded bg-light  mb-2">
          <div class="d-flex align-items-center gap-2 mb-1">
            <img src="{{ asset('assets/img/avatars/7.png') }}" alt="Nancy" class="rounded-circle" style="width: 28px; height: 28px; object-fit: cover;">
            <div style="font-size: 0.78rem;" class="fst-italic text-dark">"The product is very beautiful. I like it. "</div>
          </div>
          <div class="d-flex align-items-center justify-content-between mt-1">
            <div>
              <i class="ti ti-star-filled star-gold"></i>
              <i class="ti ti-star-filled star-gold"></i>
              <i class="ti ti-star-filled star-gold"></i>
              <i class="ti ti-star-filled star-gold"></i>
              <i class="ti ti-star-filled star-gold"></i>
            </div>
            <span class="text-muted" style="font-size: 0.72rem;">- by Nancy Martino</span>
          </div>
        </div>
        <!-- Review 2 -->
        <div class="p-2 rounded bg-light  mb-2">
          <div class="d-flex align-items-center gap-2 mb-1">
            <img src="{{ asset('assets/img/avatars/7.png') }}" alt="Nancy" class="rounded-circle" style="width: 28px; height: 28px; object-fit: cover;">
            <div style="font-size: 0.78rem;" class="fst-italic text-dark">"The product is very beautiful. I like it. "</div>
          </div>
          <div class="d-flex align-items-center justify-content-between mt-1">
            <div>
              <i class="ti ti-star-filled star-gold"></i>
              <i class="ti ti-star-filled star-gold"></i>
              <i class="ti ti-star-filled star-gold"></i>
              <i class="ti ti-star-filled star-gold"></i>
              <i class="ti ti-star-filled star-gold"></i>
            </div>
            <span class="text-muted" style="font-size: 0.72rem;">- by Nancy Martino</span>
          </div>
        </div>

      </div>
    </div>

    <!-- CUSTOMER REVIEWS Card -->
    <div class="tw-card">
      <div class="tw-card-header">
        <h5 class="tw-card-title text-uppercase" style="font-size: 0.78rem; letter-spacing: 0.05em; color: var(--tw-text-muted);">CUSTOMER REVIEWS</h5>
      </div>
      <div class="tw-card-body">
        <div class="text-center pb-2 mb-3 border-bottom">
          <div class="mb-1">
            <i class="ti ti-star-filled star-gold fs-5"></i>
            <i class="ti ti-star-filled star-gold fs-5"></i>
            <i class="ti ti-star-filled star-gold fs-5"></i>
            <i class="ti ti-star-filled star-gold fs-5"></i>
            <i class="ti ti-star-half-filled star-gold fs-5"></i>
            <span class="ms-1 fw-bold fs-6 text-dark">4.5 out of 5</span>
          </div>
          <div class="text-muted" style="font-size: 0.78rem;">Total 5.50k reviews</div>
        </div>

        <!-- 5 Star -->
        <div class="rating-bar-row">
          <span style="width: 45px;">5 star</span>
          <div class="rating-progress-track">
            <div class="rating-progress-fill" style="width: 75%; background-color: var(--tw-primary);"></div>
          </div>
          <span class="text-muted" style="width: 35px; text-align: right;">2758</span>
        </div>

        <!-- 4 Star -->
        <div class="rating-bar-row">
          <span style="width: 45px;">4 star</span>
          <div class="rating-progress-track">
            <div class="rating-progress-fill" style="width: 45%; background-color: #ff8a65;"></div>
          </div>
          <span class="text-muted" style="width: 35px; text-align: right;">1063</span>
        </div>

        <!-- 3 Star -->
        <div class="rating-bar-row">
          <span style="width: 45px;">3 star</span>
          <div class="rating-progress-track">
            <div class="rating-progress-fill" style="width: 40%; background-color: #f7b84b;"></div>
          </div>
          <span class="text-muted" style="width: 35px; text-align: right;">997</span>
        </div>

        <!-- 2 Star -->
        <div class="rating-bar-row">
          <span style="width: 45px;">2 star</span>
          <div class="rating-progress-track">
            <div class="rating-progress-fill" style="width: 15%; background-color: #0ab39c;"></div>
          </div>
          <span class="text-muted" style="width: 35px; text-align: right;">227</span>
        </div>

        <!-- 1 Star -->
        <div class="rating-bar-row">
          <span style="width: 45px;">1 star</span>
          <div class="rating-progress-track">
            <div class="rating-progress-fill" style="width: 25%; background-color: #f06548;"></div>
          </div>
          <span class="text-muted" style="width: 35px; text-align: right;">408</span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var isDark = document.documentElement.classList.contains('dark-style') || document.documentElement.getAttribute('data-style') === 'dark';

    // 1. Initialize Flatpickr for Date Range Picker
    if (typeof flatpickr !== 'undefined') {
      flatpickr('#dashboardDatePicker', {
        mode: 'range',
        dateFormat: 'd M, Y',
        defaultDate: ['2026-01-01', '2026-01-31']
      });
    }

    // 2. Revenue ApexChart (Harmonized with Light & Dark Modes)
    var revenueChart, donutChart;
    if (typeof ApexCharts !== 'undefined') {
      var revenueOptions = {
        series: [
          {
            name: 'Orders',
            type: 'line',
            data: [34, 65, 46, 68, 49, 61, 42, 44, 78, 52, 63, 67]
          },
          {
            name: 'Earnings',
            type: 'column',
            data: [89, 98, 68, 108, 77, 84, 51, 28, 92, 42, 88, 36]
          },
          {
            name: 'Refunds',
            type: 'line',
            data: [8, 12, 7, 17, 21, 11, 5, 9, 7, 29, 13, 35]
          }
        ],
        chart: {
          height: 310,
          type: 'line',
          stacked: false,
          toolbar: { show: false },
          fontFamily: 'inherit',
          foreColor: isDark ? '#8285a0' : '#878a99'
        },
        stroke: {
          width: [2.5, 0, 2.5],
          curve: 'smooth',
          dashArray: [0, 0, 6]
        },
        plotOptions: {
          bar: {
            columnWidth: '35%',
            borderRadius: 3
          }
        },
        fill: {
          opacity: [1, 0.88, 1],
          gradient: {
            inverseColors: false,
            shade: 'light',
            type: "vertical",
            opacityFrom: 0.85,
            opacityTo: 0.55,
            stops: [0, 100, 100, 100]
          }
        },
        colors: ['#ff5722', '#0ab39c', '#f06548'],
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        markers: {
          size: [0, 0, 0]
        },
        xaxis: {
          type: 'category',
          axisBorder: { show: false },
          axisTicks: { show: false }
        },
        yaxis: {
          labels: {
            formatter: function (y) {
              return typeof y !== "undefined" ? y.toFixed(0) : y;
            }
          }
        },
        tooltip: {
          theme: isDark ? 'dark' : 'light',
          shared: true,
          intersect: false,
          y: {
            formatter: function (y) {
              if (typeof y !== "undefined") {
                return y.toFixed(0);
              }
              return y;
            }
          }
        },
        grid: {
          borderColor: isDark ? '#3b405d' : '#f1f1f1',
          padding: {
            bottom: 0
          }
        },
        legend: {
          position: 'bottom',
          horizontalAlign: 'center',
          offsetY: 8,
          labels: {
            colors: isDark ? '#b2b1cb' : '#495057'
          },
          markers: {
            radius: 12
          }
        }
      };

      revenueChart = new ApexCharts(document.querySelector("#revenueApexChart"), revenueOptions);
      revenueChart.render();

      // 3. Store Visits by Source Donut Chart
      var donutOptions = {
        series: [25.6, 32.0, 23.8, 9.9, 8.7],
        labels: ['Direct', 'Social', 'Email', 'Other', 'Referrals'],
        chart: {
          type: 'donut',
          height: 290,
          fontFamily: 'inherit',
          foreColor: isDark ? '#8285a0' : '#878a99'
        },
        colors: ['#ff5722', '#0ab39c', '#f7b84b', '#f06548', '#299cdb'],
        dataLabels: {
          enabled: false
        },
        plotOptions: {
          pie: {
            donut: {
              size: '68%',
              labels: {
                show: false
              }
            }
          }
        },
        legend: {
          position: 'bottom',
          horizontalAlign: 'center',
          offsetY: 6,
          labels: {
            colors: isDark ? '#b2b1cb' : '#495057'
          },
          itemMargin: {
            horizontal: 8,
            vertical: 4
          }
        },
        stroke: {
          width: 2,
          colors: isDark ? ['#2f3349'] : ['#ffffff']
        },
        tooltip: {
          theme: isDark ? 'dark' : 'light'
        }
      };

      donutChart = new ApexCharts(document.querySelector("#visitsDonutChart"), donutOptions);
      donutChart.render();
    }

    // 4. Real-time Theme Mode Observer (Switch between White Mode and Dark Mode smoothly)
    function updateChartsTheme(dark) {
      if (revenueChart) {
        revenueChart.updateOptions({
          chart: { foreColor: dark ? '#8285a0' : '#878a99' },
          grid: { borderColor: dark ? '#3b405d' : '#f1f1f1' },
          tooltip: { theme: dark ? 'dark' : 'light' },
          legend: { labels: { colors: dark ? '#b2b1cb' : '#495057' } }
        });
      }
      if (donutChart) {
        donutChart.updateOptions({
          chart: { foreColor: dark ? '#8285a0' : '#878a99' },
          stroke: { colors: dark ? ['#2f3349'] : ['#ffffff'] },
          tooltip: { theme: dark ? 'dark' : 'light' },
          legend: { labels: { colors: dark ? '#b2b1cb' : '#495057' } }
        });
      }
    }

    var observer = new MutationObserver(function (mutations) {
      mutations.forEach(function (mutation) {
        if (mutation.attributeName === 'class' || mutation.attributeName === 'data-style') {
          var darkNow = document.documentElement.classList.contains('dark-style') || document.documentElement.getAttribute('data-style') === 'dark';
          updateChartsTheme(darkNow);
        }
      });
    });

    observer.observe(document.documentElement, {
      attributes: true,
      attributeFilter: ['class', 'data-style']
    });
  });
</script>
@endpush
