@extends('backend.layouts.backendLayout')
@section('content')
<link rel="stylesheet" href="{{ asset('page-css/patient.css') }}">
<div class="content-wrapper">

    <form id="inventorymanager_form" action="" method="POST">
        @csrf
        <input type="hidden" id="user_id" name="id" value="{{ $id ?? '' }}">
        <div id="account-details" class="card content dstepper-block active" style="zoom: 90%;">
            <div class="card-body">

                <div class="content-header d-flex justify-content-between align-items-center mb-4">
                    <h6 class="mb-0 fontzs m-0" id="inventorymanager_title">Inventory Manager</h6>
                    <div class="d-flex gap-2">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        <button type="button" id="saveButton" class="btn btn-success">
                            Save
                        </button>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-sm-3">
                        <label class="form-label" for="name_en">
                            Name English
                        </label>
                        <input type="text" id="name_en" name="name_en" class="f Form-control" placeholder="Name English">
                        <span class="text-danger error-text name_en_error"></span>
                    </div>

                    <div class="col-sm-3">
                        <label class="form-label" for="name_ar">
                            Name Arabic
                        </label>
                        <input type="text" id="name_ar" name="name_ar" class="form-control" placeholder="Name Arabic">
                        <span class="text-danger error-text name_ar_error"></span>
                    </div>

                    <div class="col-sm-3">
                        <label class="form-label" for="username">
                            Username
                        </label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                        <span class="text-danger error-text username_error"></span>
                    </div>

                    <div class="col-sm-3">
                        <label class="form-label" for="password">
                            Password <small class="text-muted text-password-hint"></small>
                        </label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" autocomplete="new-password">
                        <span class="text-danger error-text password_error"></span>
                    </div>

                    <div class="col-sm-3">
                        <label class="form-label" for="mobile_no">
                            Mobile No
                        </label>
                        <input type="tel" id="mobile_no" name="mobile_no" class="form-control" placeholder="Mobile No">
                        <span class="text-danger error-text mobile_no_error"></span>
                    </div>

                    <div class="col-sm-3">
                        <label class="form-label" for="email">
                            Email Address
                        </label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email Address">
                        <span class="text-danger error-text email_error"></span>
                    </div>

                    <div class="col-sm-3">
                        <label class="form-label" for="joined_date">
                            Joined Date
                        </label>
                        <input type="text" id="joined_date" name="joined_date" class="form-control joined_date" placeholder="YYYY-MM-DD" autocomplete="off">
                        <span class="text-danger error-text joined_date_error"></span>
                    </div>

                    <div class="col-sm-3">
                        <label class="form-label" for="active_toggle">
                            Status
                        </label>
                        <div class="form-check form-switch mt-2">
                            <input type="hidden" name="active" value="0">
                            <input class="form-check-input status-toggle" type="checkbox" role="switch" id="active_toggle" name="active" value="1" checked>
                            <label class="form-check-label" for="active_toggle" id="active_toggle_label">Active</label>
                        </div>
                        <span class="text-danger error-text active_error"></span>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>

@endsection
@push('styles')
<style>
    .status-toggle:checked {
        background-color: #ff5722 !important;
        border-color: #ff5722 !important;
    }

    .status-toggle:focus {
        border-color: #ff5722 !important;
        box-shadow: 0 0 0 0.2rem rgba(255, 87, 34, 0.25) !important;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('assets/backend-page-js/Users/inventorymanager.js') }}"></script>
@endpush