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

        <div>
            <h4 class="mb-5">Users List</h4>
        </div>

        <div class="card" style="zoom: 80%;">
            <div class="card-body">
                <div class="col-12 divhead p-0 d-flex justify-content-between align-items-center mb-3">

                    <button class="btn btn-primary me-5 mb-4 " type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        filter<i class="menu-icon tf-icons ti ti-filter me-0 ms-2"></i>
                    </button>

                    <button type="button"
                        class="btn btn-primary"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasAddUser"
                        aria-controls="offcanvasAddUser">

                        <i class="ti ti-user-plus me-1"></i>
                        Add User
                    </button>

                </div>
                <div class="mb-2">

                    <div>
                        <form class="dt_adv_search" method="GET">
                            <div class="row">
                                <div class="col-12">
                                    <div class="collapse" id="collapseExample">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row g-3 align-items-end">

                                                    filter

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-datatable table-responsive">
                <table class="dt-advanced-search table service-common-table" id="Users_table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name English</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Role</th>
                            <th>Joined Date</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>User ID</th>
                            <th>Name English</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Role</th>
                            <th>Joined Date</th>
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

<script src="{{ asset('assets/backend-page-js/user.js') }}"></script>
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