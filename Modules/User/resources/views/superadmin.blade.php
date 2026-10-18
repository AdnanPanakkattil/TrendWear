@extends('backend.layouts.backendLayout')
@section('content')
<link rel="stylesheet" href="{{ asset('page-css/patient.css') }}">
<div class="content-wrapper">
    <form id="superadmin_form" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div id="account-details" class="card content dstepper-block active" style="zoom: 90%;">
            <div class="card-body">

                <div class="content-header d-flex justify-content-between align-items-center mb-4">
                    <h6 class="mb-0 fontzs m-0">Super Admin</h6>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-secondary" onclick="history.back()">cancel Btn</button>
                        <button type="button" id="saveButton" class="btn btn-success">save Btn</button>
                    </div>
                </div>

                <div class="row g-6 gap">
                    <div class="col-sm-3">
                        <label class="form-label labe" for="name_en"> Name English </label>
                        <input type="text" id="name_en" name="name_en" class="form-control name_en" placeholder="Name English"/>
                        <span class="text-danger error-text name_en_error"></span>
                    </div>

                    <div class="col-sm-3">
                        <label class="form-label labe" for="name_ar">Name Arabic</label>
                        <input type="text" id="name_ar" name="name_ar" class="form-control name_ar" placeholder="Name Arabic"/>
                        <span class="text-danger error-text name_ar_error"></span>
                    </div>

                    <div class="col-sm-3">
                        <label class="form-label labe" for="username"> Username </label>
                        <input type="text" id="username" name="username" class="form-control username" placeholder="Username"/>
                        <span class="text-danger error-text username_error"></span>
                    </div>

                    <div class="col-sm-3">
                        <label class="form-label labe" for="password">
                            Password
                        </label>
                        <input type="text" id="password" name="password" class="form-control password"
                            placeholder="Password"
                            autocomplete="new-password"/>
                        <span class="text-danger error-text password_error"></span>
                    </div>

                    <div class="col-sm-3">
                        <label class="form-label labez" for="mobile_no">Mobile No</label>
                        <input type="tel" id="mobile_no" name="mobile_no" class="form-control mobile_no" placeholder=" Mobile No" />
                        <span class="text-danger error-text mobile_no_error"></span>
                    </div>

                    <div class="col-sm-3">
                        <label for="email" class="form-label labez"> Email Address</label>
                        <input type="email" name="email" class="form-control email" id="email" placeholder=" Email Address" />
                        <span class="text-danger error-text email_error"></span>
                    </div>

                    <div class="col-sm-3">
                        <label for="joined_date" class="form-label labez"> Joined Date</label>
                        <input type="text" id="joined_date" name="joined_date"
                            class="form-control dob-picker joined_date"
                            placeholder="YYYY-MM-DD"
                            value="">
                        <span class="text-danger error-text joined_date_error"></span>
                    </div>
                </div>

            </div>

        </div>
    </form>
</div>

@endsection
@push('scripts')
<script src="{{ asset('assets/backend-page-js/superadmin.js') }}"></script>
@endpush