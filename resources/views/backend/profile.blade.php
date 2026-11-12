@extends('backend.layouts.backendLayout')
@section('title', 'My Profile - Trend Wear')

@push('styles')
<style>
  /* My Profile Page Styles */
  .profile-page-header {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 1.25rem;
  }

  .profile-breadcrumb-pill {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    background: #ffffff;
    border: 1px solid #e9ecf4;
    border-radius: 10px;
    padding: 0.48rem 0.95rem;
    font-size: 0.82rem;
    font-weight: 500;
    color: #5e6278;
    box-shadow: 0 2px 6px rgba(15, 23, 42, 0.03);
  }

  .profile-breadcrumb-pill a {
    color: #5e6278;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
  }

  .profile-breadcrumb-pill a:hover {
    color: var(--tw-primary);
  }

  .profile-breadcrumb-pill .current-page {
    color: var(--tw-primary);
    font-weight: 600;
  }

  /* Navigation Tabs */
  .profile-nav-tabs {
    display: flex;
    flex-wrap: wrap;
    gap: 0.65rem;
    margin-bottom: 1.25rem;
    border-bottom: 0;
  }

  .profile-nav-tabs .nav-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.6rem 1.15rem;
    border-radius: 10px;
    background: #ffffff;
    border: 1px solid #e9ecf4;
    color: #3f4254;
    font-size: 0.86rem;
    font-weight: 500;
    box-shadow: 0 2px 6px rgba(15, 23, 42, 0.03);
    transition: all 0.2s ease;
  }

  .profile-nav-tabs .nav-link:hover {
    border-color: rgba(var(--tw-primary-rgb), 0.4);
    color: var(--tw-primary);
    background: #ffffff;
  }

  .profile-nav-tabs .nav-link.active {
    background: linear-gradient(135deg, var(--tw-primary) 0%, var(--tw-primary-dark) 100%);
    border-color: transparent;
    color: #ffffff;
    box-shadow: 0 6px 16px rgba(var(--tw-primary-rgb), 0.28);
  }

  /* Cards */
  .profile-card {
    background: #ffffff;
    border: 1px solid #eaedf5;
    border-radius: 14px;
    box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
    overflow: hidden;
  }

  .profile-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.85rem;
    padding: 1.2rem 1.4rem 0.9rem;
  }

  .profile-card-title-wrap {
    display: flex;
    align-items: center;
    gap: 0.85rem;
  }

  .profile-icon-badge {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(var(--tw-primary-rgb), 0.12);
    color: var(--tw-primary);
    font-size: 1.15rem;
    flex-shrink: 0;
  }

  .profile-card-body {
    padding: 0.5rem 1.4rem 1.4rem;
  }

  /* Avatar Upload */
  .profile-avatar-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding-top: 0.4rem;
  }

  .profile-avatar-ring {
    position: relative;
    width: 136px;
    height: 136px;
    border-radius: 50%;
    padding: 4px;
    border: 2px solid #eaedf5;
    background: #ffffff;
    box-shadow: 0 6px 18px rgba(15, 23, 42, 0.08);
  }

  .profile-avatar-ring img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    display: block;
  }

  .profile-avatar-camera-btn {
    position: absolute;
    right: 4px;
    bottom: 4px;
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: var(--tw-primary);
    color: #ffffff;
    border: 2px solid #ffffff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(var(--tw-primary-rgb), 0.35);
    transition: transform 0.15s ease, background-color 0.15s ease;
  }

  .profile-avatar-camera-btn:hover {
    transform: scale(1.06);
    background: var(--tw-primary-dark);
    color: #ffffff;
  }

  .btn-change-photo {
    margin-top: 0.95rem;
    border-radius: 10px;
    border: 1px solid #e1e5f0;
    background: #f9fafc;
    color: #3f4254;
    font-size: 0.82rem;
    font-weight: 500;
    padding: 0.45rem 0.95rem;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    transition: all 0.15s ease;
  }

  .btn-change-photo:hover {
    border-color: var(--tw-primary);
    color: var(--tw-primary);
    background: rgba(var(--tw-primary-rgb), 0.05);
  }

  /* Form Controls */
  .profile-form-label {
    font-size: 0.82rem;
    font-weight: 600;
    color: #2b2f42;
    margin-bottom: 0.4rem;
  }

  .profile-input-group {
    border: 1px solid #e1e5f0;
    border-radius: 10px;
    background: #ffffff;
    overflow: hidden;
    transition: border-color 0.15s ease, box-shadow 0.15s ease;
  }

  .profile-input-group:focus-within {
    border-color: var(--tw-primary);
    box-shadow: 0 0 0 3px rgba(var(--tw-primary-rgb), 0.12);
  }

  .profile-input-group .input-group-text {
    background: transparent;
    border: 0;
    color: #5e6278;
    padding-left: 0.85rem;
    padding-right: 0.5rem;
  }

  .profile-input-group .form-control,
  .profile-input-group .form-select {
    border: 0;
    box-shadow: none !important;
    padding-left: 0.25rem;
    font-size: 0.88rem;
    color: #1e293b;
    background: transparent;
  }

  .profile-textarea {
    border: 1px solid #e1e5f0;
    border-radius: 10px;
    font-size: 0.88rem;
    color: #1e293b;
    padding: 0.75rem 0.95rem;
    resize: vertical;
  }

  .profile-textarea:focus {
    border-color: var(--tw-primary);
    box-shadow: 0 0 0 3px rgba(var(--tw-primary-rgb), 0.12);
  }

  /* Custom Switches */
  .profile-switch-lg .form-check-input {
    width: 2.75rem;
    height: 1.45rem;
    cursor: pointer;
    border-color: #d6dbe8;
  }

  .profile-switch-lg .form-check-input:checked {
    background-color: var(--tw-primary);
    border-color: var(--tw-primary);
  }

  .profile-switch-lg.switch-success .form-check-input:checked {
    background-color: #10b981;
    border-color: #10b981;
  }

  /* Shop Overview Hero Card */
  .shop-overview-card {
    position: relative;
    border-radius: 14px;
    background: linear-gradient(135deg, var(--tw-primary) 0%, var(--tw-primary-dark) 100%);
    color: #ffffff;
    padding: 1.35rem;
    overflow: hidden;
    box-shadow: 0 10px 24px rgba(var(--tw-primary-rgb), 0.26);
  }

  .shop-overview-card::before {
    content: "";
    position: absolute;
    top: -40px;
    right: -40px;
    width: 170px;
    height: 170px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    pointer-events: none;
  }

  .shop-overview-card::after {
    content: "";
    position: absolute;
    bottom: -55px;
    left: -30px;
    width: 140px;
    height: 140px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.07);
    pointer-events: none;
  }

  .shop-overview-logo {
    width: 82px;
    height: 82px;
    border-radius: 50%;
    background: #ffffff;
    color: var(--tw-primary);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 6px 16px rgba(15, 23, 42, 0.18);
    text-align: center;
    padding: 0.4rem;
  }

  .shop-overview-logo-title {
    font-size: 0.7rem;
    font-weight: 700;
    color: #1e293b;
    line-height: 1.1;
    margin-top: 2px;
  }

  .shop-overview-logo-sub {
    font-size: 0.5rem;
    color: #64748b;
    letter-spacing: 0.3px;
  }

  .shop-status-pill {
    background: #10b981;
    color: #ffffff;
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.25rem 0.7rem;
    border-radius: 999px;
  }

  .btn-view-shop {
    background: #ffffff;
    color: #1e293b;
    font-size: 0.8rem;
    font-weight: 600;
    border-radius: 999px;
    padding: 0.4rem 1rem;
    border: 0;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    text-decoration: none;
    box-shadow: 0 4px 10px rgba(15, 23, 42, 0.12);
    transition: transform 0.15s ease;
  }

  .btn-view-shop:hover {
    transform: translateY(-1px);
    color: var(--tw-primary);
  }

  .shop-overview-stats {
    margin-top: 1.25rem;
    padding-top: 1rem;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    text-align: center;
  }

  .shop-overview-stat-item:not(:last-child) {
    border-right: 1px solid rgba(255, 255, 255, 0.2);
  }

  /* Account Security Card */
  .security-item-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.85rem;
    padding: 0.9rem 0;
  }

  .security-item-row:not(:last-child) {
    border-bottom: 1px solid #f0f2f8;
  }

  .security-icon-box {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.15rem;
    flex-shrink: 0;
  }

  .badge-secure-pill {
    background: #dcfce7;
    color: #15803d;
    font-size: 0.74rem;
    font-weight: 600;
    padding: 0.25rem 0.7rem;
    border-radius: 999px;
  }

  /* Bottom Action Bar */
  .profile-action-bar {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 0.75rem;
    margin-top: 1.35rem;
  }

  .btn-profile-reset {
    background: #ffffff;
    border: 1px solid #dce1ee;
    color: #3f4254;
    border-radius: 10px;
    padding: 0.58rem 1.2rem;
    font-size: 0.86rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
  }

  .btn-profile-reset:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
  }

  .btn-profile-save {
    background: linear-gradient(135deg, var(--tw-primary) 0%, var(--tw-primary-dark) 100%);
    border: 0;
    color: #ffffff;
    border-radius: 10px;
    padding: 0.6rem 1.4rem;
    font-size: 0.86rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 6px 16px rgba(var(--tw-primary-rgb), 0.28);
  }

  .btn-profile-save:hover {
    color: #ffffff;
    opacity: 0.95;
  }

  /* Dark Mode Support */
  html.dark-style .profile-breadcrumb-pill,
  html.dark-style .profile-nav-tabs .nav-link:not(.active),
  html.dark-style .profile-card,
  html.dark-style .btn-profile-reset {
    background: #2f3349;
    border-color: #434968;
    color: #cfd3ec;
  }

  html.dark-style .profile-form-label,
  html.dark-style .profile-card-header h5 {
    color: #e4e6f4;
  }

  html.dark-style .profile-input-group,
  html.dark-style .profile-textarea,
  html.dark-style .btn-change-photo {
    background: #25293c;
    border-color: #434968;
    color: #e4e6f4;
  }

  html.dark-style .profile-input-group .form-control,
  html.dark-style .profile-input-group .form-select {
    color: #e4e6f4;
  }

  html.dark-style .security-item-row:not(:last-child) {
    border-bottom-color: #434968;
  }
</style>
@endpush

@section('content')
@php
  $displayName = $user?->name ?? ($user?->username ?? 'John Doe');
  $displayEmail = $user?->email ?? 'john@example.com';
  $displayPhone = $user?->mobile_no ?? '+91 98765 43210';
@endphp

<!-- Page Header -->
<div class="profile-page-header">
  <div>
    <h4 class="fw-bold mb-1" style="font-size: 1.45rem;">My Profile</h4>
    <p class="text-muted mb-0" style="font-size: 0.88rem;">Manage your shop and account information</p>
  </div>

  <div class="profile-breadcrumb-pill">
    <a href="{{ route('backend.dashboard') }}">
      <i class="ti ti-home ti-sm"></i>
      <span>Dashboard</span>
    </a>
    <i class="ti ti-chevron-right ti-xs text-muted"></i>
    <span class="current-page">My Profile</span>
  </div>
</div>

<!-- Profile Navigation Tabs -->
<ul class="nav profile-nav-tabs" id="profileTabs" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="tab-profile-info" data-bs-toggle="pill" data-bs-target="#pane-profile-info" type="button" role="tab" aria-controls="pane-profile-info" aria-selected="true">
      <i class="ti ti-user ti-sm"></i>
      <span>Profile Info</span>
    </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="tab-shop-details" data-bs-toggle="pill" data-bs-target="#pane-shop-details" type="button" role="tab" aria-controls="pane-shop-details" aria-selected="false">
      <i class="ti ti-building-store ti-sm"></i>
      <span>Shop Details</span>
    </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="tab-change-password" data-bs-toggle="pill" data-bs-target="#pane-change-password" type="button" role="tab" aria-controls="pane-change-password" aria-selected="false">
      <i class="ti ti-lock ti-sm"></i>
      <span>Change Password</span>
    </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="tab-notifications" data-bs-toggle="pill" data-bs-target="#pane-notifications" type="button" role="tab" aria-controls="pane-notifications" aria-selected="false">
      <i class="ti ti-bell ti-sm"></i>
      <span>Notifications</span>
    </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="tab-appearance" data-bs-toggle="pill" data-bs-target="#pane-appearance" type="button" role="tab" aria-controls="pane-appearance" aria-selected="false">
      <i class="ti ti-palette ti-sm"></i>
      <span>Appearance</span>
    </button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="tab-activity-log" data-bs-toggle="pill" data-bs-target="#pane-activity-log" type="button" role="tab" aria-controls="pane-activity-log" aria-selected="false">
      <i class="ti ti-history ti-sm"></i>
      <span>Activity Log</span>
    </button>
  </li>
</ul>

<!-- Tab Content -->
<div class="tab-content p-0" id="profileTabsContent">
  <!-- ========================================== -->
  <!-- TAB 1: PROFILE INFO                        -->
  <!-- ========================================== -->
  <div class="tab-pane fade show active" id="pane-profile-info" role="tabpanel" aria-labelledby="tab-profile-info">
    <form id="myProfileForm" onsubmit="return false;">
      <div class="row g-4">
        <!-- Left Column -->
        <div class="col-lg-8">
          <!-- Profile Information Card -->
          <div class="profile-card mb-4">
            <div class="profile-card-header">
              <div class="profile-card-title-wrap">
                <div class="profile-icon-badge">
                  <i class="ti ti-user-edit"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold" style="font-size: 1.02rem;">Profile Information</h5>
                  <small class="text-muted">Update your personal details</small>
                </div>
              </div>
            </div>

            <div class="profile-card-body">
              <div class="row g-4 align-items-start">
                <!-- Avatar Column -->
                <div class="col-md-4 col-xl-3">
                  <div class="profile-avatar-box">
                    <div class="profile-avatar-ring">
                      <img id="profileAvatarPreview" src="{{ asset('assets/img/avatars/1.png') }}" alt="{{ $displayName }}">
                      <label for="profilePhotoInput" class="profile-avatar-camera-btn" title="Upload Photo">
                        <i class="ti ti-camera ti-sm"></i>
                      </label>
                      <input type="file" id="profilePhotoInput" class="d-none" accept="image/png, image/jpeg">
                    </div>
                    <label for="profilePhotoInput" class="btn-change-photo" style="cursor: pointer;">
                      <i class="ti ti-upload ti-xs"></i>
                      <span>Change Photo</span>
                    </label>
                    <small class="text-muted mt-2" style="font-size: 0.72rem;">JPG, PNG (Max 2MB)</small>
                  </div>
                </div>

                <!-- Form Fields Column -->
                <div class="col-md-8 col-xl-9">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label for="fullName" class="profile-form-label">Full Name <span class="text-danger">*</span></label>
                      <div class="input-group profile-input-group">
                        <span class="input-group-text"><i class="ti ti-user ti-sm"></i></span>
                        <input type="text" class="form-control" id="fullName" value="{{ $displayName }}" placeholder="Enter full name">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <label for="emailAddress" class="profile-form-label">Email Address <span class="text-danger">*</span></label>
                      <div class="input-group profile-input-group">
                        <span class="input-group-text"><i class="ti ti-mail ti-sm"></i></span>
                        <input type="email" class="form-control" id="emailAddress" value="{{ $displayEmail }}" placeholder="Enter email address">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <label for="phoneNumber" class="profile-form-label">Phone Number <span class="text-danger">*</span></label>
                      <div class="input-group profile-input-group">
                        <span class="input-group-text"><i class="ti ti-phone ti-sm"></i></span>
                        <input type="text" class="form-control" id="phoneNumber" value="{{ $displayPhone }}" placeholder="+91 98765 43210">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <label for="shopName" class="profile-form-label">Shop Name <span class="text-danger">*</span></label>
                      <div class="input-group profile-input-group">
                        <span class="input-group-text"><i class="ti ti-building-store ti-sm"></i></span>
                        <input type="text" class="form-control" id="shopName" value="Trend Wear Store" placeholder="Enter shop name">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <label for="shopSlug" class="profile-form-label">Shop Slug <span class="text-danger">*</span></label>
                      <div class="input-group profile-input-group">
                        <span class="input-group-text"><i class="ti ti-link ti-sm"></i></span>
                        <input type="text" class="form-control" id="shopSlug" value="trend-wear" placeholder="trend-wear">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <label for="shopCategory" class="profile-form-label">Shop Category <span class="text-danger">*</span></label>
                      <div class="input-group profile-input-group">
                        <span class="input-group-text"><i class="ti ti-shirt ti-sm"></i></span>
                        <select class="form-select" id="shopCategory">
                          <option value="fashion" selected>Fashion &amp; Clothing</option>
                          <option value="footwear">Footwear &amp; Accessories</option>
                          <option value="luxury">Luxury Apparel</option>
                          <option value="kids">Kids &amp; Youth Wear</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="shopBio" class="profile-form-label">Bio / About Your Shop</label>
                      <textarea class="form-control profile-textarea" id="shopBio" rows="3" maxlength="200" placeholder="Write something about your shop...">Premium fashion brand for men, women and kids.</textarea>
                      <div class="d-flex justify-content-end mt-1">
                        <small class="text-muted" id="bioCharCount">48 / 200</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Shop Settings Card -->
          <div class="profile-card">
            <div class="profile-card-header">
              <div class="profile-card-title-wrap">
                <div class="profile-icon-badge">
                  <i class="ti ti-settings"></i>
                </div>
                <div>
                  <h5 class="mb-0 fw-bold" style="font-size: 1.02rem;">Shop Settings</h5>
                  <small class="text-muted">Configure your shop preferences</small>
                </div>
              </div>
            </div>

            <div class="profile-card-body">
              <div class="row g-3 align-items-center">
                <div class="col-md-3 col-sm-6">
                  <label class="profile-form-label d-block">Shop Status</label>
                  <div class="form-check form-switch profile-switch-lg switch-success d-flex align-items-center gap-2 ps-0">
                    <input class="form-check-input ms-0" type="checkbox" id="shopStatusSwitch" checked>
                    <label class="form-check-label fw-semibold" for="shopStatusSwitch" id="shopStatusLabel">Active</label>
                  </div>
                  <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">Your shop is visible to customers</small>
                </div>

                <div class="col-md-3 col-sm-6">
                  <label class="profile-form-label d-block">Receive Orders</label>
                  <div class="form-check form-switch profile-switch-lg d-flex align-items-center gap-2 ps-0">
                    <input class="form-check-input ms-0" type="checkbox" id="receiveOrdersSwitch" checked>
                    <label class="form-check-label fw-semibold" for="receiveOrdersSwitch" id="receiveOrdersLabel">Enabled</label>
                  </div>
                  <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">Start receiving orders</small>
                </div>

                <div class="col-md-3 col-sm-6">
                  <label class="profile-form-label d-block">Allow COD</label>
                  <div class="form-check form-switch profile-switch-lg d-flex align-items-center gap-2 ps-0">
                    <input class="form-check-input ms-0" type="checkbox" id="allowCodSwitch" checked>
                    <label class="form-check-label fw-semibold" for="allowCodSwitch" id="allowCodLabel">Enabled</label>
                  </div>
                  <small class="text-muted d-block mt-1" style="font-size: 0.74rem;">Cash on Delivery</small>
                </div>

                <div class="col-md-3 col-sm-6">
                  <label for="storeCurrency" class="profile-form-label">Store Currency</label>
                  <div class="input-group profile-input-group">
                    <select class="form-select ps-3" id="storeCurrency">
                      <option value="INR" selected>₹ INR</option>
                      <option value="USD">$ USD</option>
                      <option value="EUR">€ EUR</option>
                      <option value="AED">د.إ AED</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
          <!-- My Shop Overview Card -->
          <div class="shop-overview-card mb-4">
            <div class="d-flex align-items-center justify-content-between mb-3 position-relative" style="z-index: 1;">
              <div class="d-flex align-items-center gap-2">
                <i class="ti ti-building-store ti-md"></i>
                <span class="fw-semibold" style="font-size: 0.95rem;">My Shop Overview</span>
              </div>
              <span class="shop-status-pill">Active</span>
            </div>

            <div class="d-flex align-items-center gap-3 position-relative" style="z-index: 1;">
              <div class="shop-overview-logo">
                <i class="ti ti-hanger" style="font-size: 1.7rem;"></i>
                <div class="shop-overview-logo-title">Trend Wear</div>
                <div class="shop-overview-logo-sub">FASHION STORE</div>
              </div>
              <div>
                <h5 class="text-white fw-bold mb-0" style="font-size: 1.05rem;" id="overviewShopName">Trend Wear Store</h5>
                <div class="text-white text-opacity-75 mb-2" style="font-size: 0.82rem;" id="overviewShopSlug">trend-wear</div>
                <a href="{{ route('index') }}" target="_blank" class="btn-view-shop">
                  <span>View Shop</span>
                  <i class="ti ti-arrow-right ti-xs"></i>
                </a>
              </div>
            </div>

            <div class="shop-overview-stats position-relative" style="z-index: 1;">
              <div class="shop-overview-stat-item">
                <i class="ti ti-box mb-1 d-block" style="font-size: 1.15rem; opacity: 0.9;"></i>
                <div class="fw-bold" style="font-size: 1.05rem;">124</div>
                <div class="text-white text-opacity-75" style="font-size: 0.72rem;">Products</div>
              </div>
              <div class="shop-overview-stat-item">
                <i class="ti ti-shopping-cart mb-1 d-block" style="font-size: 1.15rem; opacity: 0.9;"></i>
                <div class="fw-bold" style="font-size: 1.05rem;">1.8K</div>
                <div class="text-white text-opacity-75" style="font-size: 0.72rem;">Orders</div>
              </div>
              <div class="shop-overview-stat-item">
                <i class="ti ti-users mb-1 d-block" style="font-size: 1.15rem; opacity: 0.9;"></i>
                <div class="fw-bold" style="font-size: 1.05rem;">2.5K</div>
                <div class="text-white text-opacity-75" style="font-size: 0.72rem;">Customers</div>
              </div>
            </div>
          </div>

          <!-- Account Security Card -->
          <div class="profile-card">
            <div class="profile-card-header">
              <div class="profile-card-title-wrap">
                <div class="profile-icon-badge">
                  <i class="ti ti-shield-check"></i>
                </div>
                <h5 class="mb-0 fw-bold" style="font-size: 1.02rem;">Account Security</h5>
              </div>
              <span class="badge-secure-pill">Secure</span>
            </div>

            <div class="profile-card-body pt-1">
              <div class="security-item-row">
                <div class="d-flex align-items-center gap-3">
                  <div class="security-icon-box" style="background: #f1f4f9; color: #5e6278;">
                    <i class="ti ti-lock"></i>
                  </div>
                  <div>
                    <div class="fw-semibold" style="font-size: 0.88rem;">Password</div>
                    <small class="text-muted" style="font-size: 0.75rem;">Last changed: 3 months ago</small>
                  </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" id="quickChangePasswordBtn">Change</button>
              </div>

              <div class="security-item-row">
                <div class="d-flex align-items-center gap-3">
                  <div class="security-icon-box" style="background: #dcfce7; color: #16a34a;">
                    <i class="ti ti-shield-lock"></i>
                  </div>
                  <div>
                    <div class="fw-semibold" style="font-size: 0.88rem;">Two-Factor Authentication</div>
                    <small class="text-muted" style="font-size: 0.75rem;">Add an extra layer of security</small>
                  </div>
                </div>
                <div class="form-check form-switch profile-switch-lg m-0">
                  <input class="form-check-input" type="checkbox" id="twoFactorSwitch" checked>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Bottom Action Buttons -->
      <div class="profile-action-bar">
        <button type="reset" class="btn btn-profile-reset" id="resetProfileBtn">
          <i class="ti ti-refresh ti-sm"></i>
          <span>Reset</span>
        </button>
        <button type="submit" class="btn btn-profile-save" id="saveProfileBtn">
          <i class="ti ti-device-floppy ti-sm"></i>
          <span>Save Changes</span>
          <i class="ti ti-arrow-right ti-xs"></i>
        </button>
      </div>
    </form>
  </div>

  <!-- ========================================== -->
  <!-- TAB 2: SHOP DETAILS                        -->
  <!-- ========================================== -->
  <div class="tab-pane fade" id="pane-shop-details" role="tabpanel" aria-labelledby="tab-shop-details">
    <div class="profile-card">
      <div class="profile-card-header">
        <div class="profile-card-title-wrap">
          <div class="profile-icon-badge"><i class="ti ti-building-store"></i></div>
          <div>
            <h5 class="mb-0 fw-bold" style="font-size: 1.02rem;">Shop Details</h5>
            <small class="text-muted">Business address, GST/Tax info, and contact links</small>
          </div>
        </div>
      </div>
      <div class="profile-card-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="profile-form-label">Support Email</label>
            <div class="input-group profile-input-group">
              <span class="input-group-text"><i class="ti ti-mail ti-sm"></i></span>
              <input type="email" class="form-control" value="support@trendwear.com">
            </div>
          </div>
          <div class="col-md-6">
            <label class="profile-form-label">Business Phone</label>
            <div class="input-group profile-input-group">
              <span class="input-group-text"><i class="ti ti-phone ti-sm"></i></span>
              <input type="text" class="form-control" value="+91 98765 43210">
            </div>
          </div>
          <div class="col-12">
            <label class="profile-form-label">Store Address</label>
            <textarea class="form-control profile-textarea" rows="2">MG Road, Kochi, Kerala 682016, India</textarea>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ========================================== -->
  <!-- TAB 3: CHANGE PASSWORD                     -->
  <!-- ========================================== -->
  <div class="tab-pane fade" id="pane-change-password" role="tabpanel" aria-labelledby="tab-change-password">
    <div class="profile-card">
      <div class="profile-card-header">
        <div class="profile-card-title-wrap">
          <div class="profile-icon-badge"><i class="ti ti-lock"></i></div>
          <div>
            <h5 class="mb-0 fw-bold" style="font-size: 1.02rem;">Change Password</h5>
            <small class="text-muted">Ensure your account is using a strong password</small>
          </div>
        </div>
      </div>
      <div class="profile-card-body">
        <div class="row g-3" style="max-width: 560px;">
          <div class="col-12">
            <label class="profile-form-label">Current Password</label>
            <div class="input-group profile-input-group">
              <span class="input-group-text"><i class="ti ti-key ti-sm"></i></span>
              <input type="password" class="form-control" placeholder="••••••••">
            </div>
          </div>
          <div class="col-12">
            <label class="profile-form-label">New Password</label>
            <div class="input-group profile-input-group">
              <span class="input-group-text"><i class="ti ti-lock ti-sm"></i></span>
              <input type="password" class="form-control" placeholder="••••••••">
            </div>
          </div>
          <div class="col-12">
            <label class="profile-form-label">Confirm New Password</label>
            <div class="input-group profile-input-group">
              <span class="input-group-text"><i class="ti ti-lock-check ti-sm"></i></span>
              <input type="password" class="form-control" placeholder="••••••••">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ========================================== -->
  <!-- TAB 4: NOTIFICATIONS                       -->
  <!-- ========================================== -->
  <div class="tab-pane fade" id="pane-notifications" role="tabpanel" aria-labelledby="tab-notifications">
    <div class="profile-card">
      <div class="profile-card-header">
        <div class="profile-card-title-wrap">
          <div class="profile-icon-badge"><i class="ti ti-bell"></i></div>
          <div>
            <h5 class="mb-0 fw-bold" style="font-size: 1.02rem;">Notification Preferences</h5>
            <small class="text-muted">Choose how you want to be notified</small>
          </div>
        </div>
      </div>
      <div class="profile-card-body">
        <div class="security-item-row">
          <div>
            <div class="fw-semibold">New Order Alerts</div>
            <small class="text-muted">Receive instant notifications when customers place orders</small>
          </div>
          <div class="form-check form-switch profile-switch-lg m-0">
            <input class="form-check-input" type="checkbox" checked>
          </div>
        </div>
        <div class="security-item-row">
          <div>
            <div class="fw-semibold">Low Stock Warnings</div>
            <small class="text-muted">Get alerted when product inventory drops below threshold</small>
          </div>
          <div class="form-check form-switch profile-switch-lg m-0">
            <input class="form-check-input" type="checkbox" checked>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ========================================== -->
  <!-- TAB 5: APPEARANCE                          -->
  <!-- ========================================== -->
  <div class="tab-pane fade" id="pane-appearance" role="tabpanel" aria-labelledby="tab-appearance">
    <div class="profile-card">
      <div class="profile-card-header">
        <div class="profile-card-title-wrap">
          <div class="profile-icon-badge"><i class="ti ti-palette"></i></div>
          <div>
            <h5 class="mb-0 fw-bold" style="font-size: 1.02rem;">Appearance</h5>
            <small class="text-muted">Customize your dashboard theme using the topbar customizer</small>
          </div>
        </div>
      </div>
      <div class="profile-card-body">
        <p class="text-muted mb-0">You can switch light/dark mode and primary accent colors anytime from the theme customizer in the top navigation bar.</p>
      </div>
    </div>
  </div>

  <!-- ========================================== -->
  <!-- TAB 6: ACTIVITY LOG                        -->
  <!-- ========================================== -->
  <div class="tab-pane fade" id="pane-activity-log" role="tabpanel" aria-labelledby="tab-activity-log">
    <div class="profile-card">
      <div class="profile-card-header">
        <div class="profile-card-title-wrap">
          <div class="profile-icon-badge"><i class="ti ti-history"></i></div>
          <div>
            <h5 class="mb-0 fw-bold" style="font-size: 1.02rem;">Recent Activity Log</h5>
            <small class="text-muted">Latest sign-ins and account updates</small>
          </div>
        </div>
      </div>
      <div class="profile-card-body">
        <div class="security-item-row">
          <div>
            <div class="fw-semibold">Logged into Admin Dashboard</div>
            <small class="text-muted">Today at {{ now()->format('h:i A') }}</small>
          </div>
          <span class="badge bg-label-success">Verified</span>
        </div>
        <div class="security-item-row">
          <div>
            <div class="fw-semibold">Updated Theme Color</div>
            <small class="text-muted">Yesterday</small>
          </div>
          <span class="badge bg-label-primary">Settings</span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const bioInput = document.getElementById('shopBio');
    const bioCount = document.getElementById('bioCharCount');
    const photoInput = document.getElementById('profilePhotoInput');
    const avatarPreview = document.getElementById('profileAvatarPreview');
    const quickPasswordBtn = document.getElementById('quickChangePasswordBtn');
    const shopNameInput = document.getElementById('shopName');
    const shopSlugInput = document.getElementById('shopSlug');
    const overviewShopName = document.getElementById('overviewShopName');
    const overviewShopSlug = document.getElementById('overviewShopSlug');

    function updateBioCounter() {
      if (!bioInput || !bioCount) return;
      bioCount.textContent = `${bioInput.value.length} / 200`;
    }

    updateBioCounter();
    bioInput?.addEventListener('input', updateBioCounter);

    shopNameInput?.addEventListener('input', function () {
      if (overviewShopName) {
        overviewShopName.textContent = this.value || 'Trend Wear Store';
      }
    });

    shopSlugInput?.addEventListener('input', function () {
      if (overviewShopSlug) {
        overviewShopSlug.textContent = this.value || 'trend-wear';
      }
    });

    photoInput?.addEventListener('change', function (e) {
      const file = e.target.files?.[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = function (ev) {
        if (avatarPreview && ev.target?.result) {
          avatarPreview.src = ev.target.result;
        }
      };
      reader.readAsDataURL(file);
    });

    quickPasswordBtn?.addEventListener('click', function () {
      const passwordTabBtn = document.getElementById('tab-change-password');
      if (passwordTabBtn && window.bootstrap?.Tab) {
        new bootstrap.Tab(passwordTabBtn).show();
      }
    });

    const toggleBindings = [
      { id: 'shopStatusSwitch', labelId: 'shopStatusLabel', on: 'Active', off: 'Inactive' },
      { id: 'receiveOrdersSwitch', labelId: 'receiveOrdersLabel', on: 'Enabled', off: 'Paused' },
      { id: 'allowCodSwitch', labelId: 'allowCodLabel', on: 'Enabled', off: 'Disabled' }
    ];

    toggleBindings.forEach(function (item) {
      const el = document.getElementById(item.id);
      const label = document.getElementById(item.labelId);
      el?.addEventListener('change', function () {
        if (label) {
          label.textContent = this.checked ? item.on : item.off;
        }
      });
    });

    document.getElementById('saveProfileBtn')?.addEventListener('click', function () {
      if (window.Swal) {
        Swal.fire({
          icon: 'success',
          title: 'Saved!',
          text: 'Profile UI preview updated.',
          timer: 1800,
          showConfirmButton: false
        });
      }
    });
  });
</script>
@endpush

