@extends('backend.layouts.backendLayout')
@section('content')

<div class="col-md-12" style="zoom: 85% !important">
    <div class="card h-100">
        <div class="card-header d-flex justify-content-between">
            <h6 class="card-title mb-0">bills daily overview</h6>
            <small class="text-muted">today</small>
        </div>
        <div class="card-body d-flex align-items-end pb-0">
            <div class="w-100">
                <div class="row gy-3">
                    <div class="row">

                        <div class="col">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded bg-label-success  me-4 p-2">
                                    <i class="ti ti-checks ti-lg"></i>
                                </div>
                                <div class="card-info">

                                    <h5 class="mb-0" id="total_paid">0</h5>
                                    <h6> total paid </h6>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded bg-label-warning me-4 p-2">
                                    <i class="ti ti-clock-hour-4 ti-lg"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0" id="total_pending">0</h5>
                                    <h6> total pending </h6>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded bg-label-danger me-4 p-2">
                                    <i class="ti ti-circle-x ti-lg"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0" id="total_cancelled">0</h5>
                                    <h6> total cancelled </h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div id="subscriberGained"></div>
    </div>
</div>

<div class="mt-5">
    <div class="row" style="margin-left: 5px;margin-right: 5px;">

        <div class="card" style="zoom: 80%;">
            <div class="card-body">
                <div class="col-12 divhead p-0 d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="mb-0">Users List</h4>
                    </div>

                    <button type="button"
                        class="btn btn-primary"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasAddUser"
                        aria-controls="offcanvasAddUser">

                        <i class="ti ti-user-plus me-1"></i>
                        Add User
                    </button>
                </div>
                <!-- <div class="mb-2">
                    <button class="btn btn-primary me-5 mb-4 " type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        filter<i class="menu-icon tf-icons ti ti-filter me-0 ms-2"></i>
                    </button>
                    <div>
                        <form class="dt_adv_search" method="GET">
                            <div class="row">
                                <div class="col-12">
                                    <div class="collapse" id="collapseExample">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row g-3 align-items-end">

                                                    <div class="col">
                                                        <label for="selectpickerLiveSearch" class="form-label labez">{{ __('billing::report.financial_category') }}</label>
                                                        <select id="financialCategory" class="selectpicker w-100" data-live-search="true" data-style="btn-default">
                                                            <option value="">{{ __('billing::report.all') }}</option>
                                                            <option value="cash">{{ __('billing::report.opt_cash') }}</option>
                                                            <option value="insurance">{{ __('billing::report.opt_insurance') }}</option>
                                                            <option value="company">{{ __('billing::report.opt_company') }}</option>
                                                        </select>
                                                        <span class="text-danger error-text financialCategory_error"></span>
                                                    </div>

                                                    <div class="col">
                                                        <label class="form-label  labez">{{ __('billing::pending.provider') }}</label>
                                                        <div class="position-relative provider-select-wrapper" style="width: 100%;">
                                                            <select id="provider" class="select2 form-select w-100 provider-select" data-placeholder="{{ __('billing::report.select_atleast_one') }}">
                                                                <option></option>
                                                            </select>
                                                            <span id="clearprovider" style="position:absolute; right:37px; top:50%; transform:translateY(-50%); cursor:pointer;">×</span>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <label for="filterStatus" class="form-label labez">
                                                            {{ __('billing::report.status') }}
                                                        </label>
                                                        <select id="filterStatus"
                                                            class="selectpicker w-100"
                                                            data-style="btn-default"
                                                            data-title="{{ __('billing::report.select_status') }}"
                                                            data-live-search="true">
                                                            <option value=""> {{ __('billing::report.select_all') }}</option>
                                                            <option value="paid">{{ __('billing::report.status_paid') }}</option>
                                                            <option value="pending">{{ __('billing::report.status_pending') }}</option>
                                                            <option value="cancelled">{{ __('billing::report.status_cancelled') }}</option>
                                                            <option value="refund">{{ __('billing::report.status_refund') }}</option>
                                                            <option value="approved">{{ __('billing::report.status_approved') }}</option>
                                                            <option value="checked_in">{{ __('billing::report.status_checked_in') }}</option>
                                                            <option value="transfer">{{ __('billing::report.status_transfer') }}</option>
                                                            <option value="completed">{{ __('billing::report.status_completed') }}</option>
                                                            <option value="processing">{{ __('billing::report.status_processing') }}</option>
                                                            <option value="rejected">{{ __('billing::report.status_rejected') }}</option>
                                                            <option value="refunded">{{ __('billing::report.status_refunded') }}</option>
                                                            <option value="absent">{{ __('billing::report.status_absent') }}</option>
                                                            <option value="insurance_approval_request">{{ __('billing::report.status_insurance_approval_request') }}</option>
                                                            <option value="insurance_rejected">{{ __('billing::report.status_insurance_rejected') }}</option>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        <label class="form-label labez">{{ __('billing::report.from_date_to_end_date') }}</label>
                                                        <input type="text"
                                                            class="form-control dt-date flatpickr-range w-100"
                                                            placeholder="{{ __('billing::report.from_date_to_end_date') }}"
                                                            name="dt_date" />
                                                        <input id="startDate" type="hidden" name="value_from_start_date">
                                                        <input id="endDate" type="hidden" name="value_from_end_date">
                                                        <span class="text-danger error-text date_error"></span>
                                                    </div>
                                                </div>

                                                <div class="row g-3 mt-4">
                                                    <div class="col">
                                                        <label class="form-label labez">{{ __('billing::report.bill_type') }}</label>
                                                        <select id="billtype" class="selectpicker w-100" data-live-search="true" data-style="btn-default">
                                                            <option value="">{{ __('billing::report.all') }}</option>
                                                            <option value="out_patient">{{ __('billing::report.opt_outpatient') }}</option>
                                                            <option value="in_patient">{{ __('billing::report.opt_inpatient') }}</option>
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        <label for="clientId" class="form-label labez">{{ __('billing::report.patient') }}</label>
                                                        <select id="clientId" name="clientId" class="select2 form-select form-select-lg clientId" data-allow-clear="true">
                                                            <option value="All">{{ __('billing::report.all') }}</option>
                                                        </select>
                                                        <span class="text-danger error-text clientId_error"></span>
                                                    </div>

                                                    <div class="col">
                                                        <label class="form-label labez">{{ __('billing::report.nationality') }}</label>
                                                        <select
                                                            id="nationality"
                                                            name="nationality"
                                                            class="selectpicker w-100"
                                                            data-live-search="true"
                                                            data-style="btn-default">
                                                            <option value="">{{ __('billing::report.all') }}</option>
                                                            <option value="sn">{{ __('billing::report.opt_saudiNational') }}</option>
                                                            <option value="nsn">{{ __('billing::report.opt_nonSaudiNational') }}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> -->
            </div>
            <div class="card-datatable table-responsive">
                <table class="dt-advanced-search table service-common-table" id="xray_table">
                    <thead>
                        <tr>

                            <th> User Id </th>
                            <th> Name English </th>
                            <th> Name Arabic </th>
                            <th> Email </th>
                            <th> Mobile </th>
                            <th> Gender </th>
                            <th> Role </th>
                            <th> status </th>
                            <th> Actions </th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>

                            <th> User Id </th>
                            <th> Name English </th>
                            <th> Name Arabic </th>
                            <th> Email </th>
                            <th> Mobile </th>
                            <th> Gender </th>
                            <th> Role </th>
                            <th> status </th>
                            <th> Actions </th>

                        </tr>
                    </tfoot>
                </table>
            </div>
            @include('user::partials.add-user-offcanvas')
        </div>
    </div>
</div>

<footer class="footer bg-light footz" id="bulk_select" style="display: none;">
    <div class="container-fluid d-flex flex-md-row flex-column justify-content-between align-items-md-center gap-1 container-p-x py-4">
        <div class="allitemz">
            <div class="itemz">
                <h4 class="m-0" id="selected_count">10</h4>
            </div>
            <h5 class="coustom-fontz">footer itemsSelected</h5>
        </div>

        <div class="d-flex flex-column flex-sm-row">
            <a href="" class="footer-link me-6 footzicon"><i class="fa-solid fa-copy menu-icon"></i> footer duplicate </a>
            <a href="" class="footer-link me-6 footzicon"><i class="fa-solid fa-file-export menu-icon"></i> footer export </a>
            <a href="" class="footer-link me-6 footzicon"><i class="fa-solid fa-box-archive menu-icon"></i> footer archive </a>
            <a href="#" class="footer-link me-6 footzicon" id="delete_selected"><i class="fa-solid fa-trash-can menu-icon"></i> footer delete </a>
            <a href="" class="footer-link me-6 footzicon"><i class="fa-solid fa-arrow-turn-down menu-icon"></i> footer convert </a>
            <a href="" class="footer-link me-6 footzicon"><i class="fa-solid fa-arrow-right-from-bracket menu-icon"></i> footer moveTo </a>
        </div>
    </div>
</footer>
</div>

@endsection
@push('scripts')
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.redirect-button', function() {
            var url = $(this).data('url');
            if (url) {
                window.location.href = url;
            }
        });
    });
</script>
@endpush