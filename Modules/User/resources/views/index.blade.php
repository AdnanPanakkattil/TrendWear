@extends('backend.layouts.backendLayout')
@section('content')

<style>
.edit-user-btn, .edit-user-btn i {
    color: #2b76ff !important;
}
.edit-user-btn:hover {
    background-color: rgba(43, 118, 255, 0.12) !important;
}
.delete-user-btn, .delete-user-btn i {
    color: #ea5455 !important;
}
.delete-user-btn:hover {
    background-color: rgba(234, 84, 85, 0.12) !important;
}
</style>

<div class="col-md-12" style="zoom: 85% !important">
    <div class="card h-100" style="overflow: hidden;">
        <div class="card-header d-flex justify-content-between">
            <h6 class="card-title mb-0">daily overview</h6>
            <small class="text-muted">today</small>
        </div>
        <div class="card-body d-flex align-items-end pb-0">
            <div class="w-100">
                <div class="row gy-3">
                    <div class="row">

                        <div class="col">
                            <div class="d-flex align-items-center role-filter-trigger" data-role="" style="cursor: pointer;" title="Show All Users">
                                <div class="badge rounded bg-label-success me-4 p-3">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0" id="stat_total_users">{{ $counts['total'] ?? 0 }}</h5>
                                    <h6> All Users </h6>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="d-flex align-items-center role-filter-trigger" data-role="super_admin" style="cursor: pointer;" title="Filter Super Admins">
                                <div class="badge rounded bg-label-warning me-4 p-3">
                                    <i class="fa-solid fa-user-shield fa-lg"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0" id="stat_super_admins">{{ $counts['super_admin'] ?? 0 }}</h5>
                                    <h6> All Super Admins </h6>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="d-flex align-items-center role-filter-trigger" data-role="admin" style="cursor: pointer;" title="Filter Admins">
                                <div class="badge rounded bg-label-danger me-4 p-3">
                                    <i class="fa-solid fa-user-tie fa-lg"></i>
                                </div>

                                <div class="card-info">
                                    <h5 class="mb-0" id="stat_admins">{{ $counts['admin'] ?? 0 }}</h5>
                                    <h6> All Admins </h6>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="d-flex align-items-center role-filter-trigger" data-role="staff" style="cursor: pointer;" title="Filter Staff">
                                <div class="badge rounded bg-label-info me-4 p-3">
                                    <i class="fa-solid fa-user-gear fa-lg"></i>
                                </div>

                                <div class="card-info">
                                    <h5 class="mb-0" id="stat_staff">{{ $counts['staff'] ?? 0 }}</h5>
                                    <h6> All Staff </h6>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="d-flex align-items-center role-filter-trigger" data-role="customer" style="cursor: pointer;" title="Filter Customers">
                                <div class="badge rounded bg-label-primary me-4 p-3">
                                    <i class="fa-solid fa-user fa-lg"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0" id="stat_customers">{{ $counts['customer'] ?? 0 }}</h5>
                                    <h6> All Customers </h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div id="billsDailyOverviewChart"></div>
    </div>
</div>

<div class="mt-5">
    <div class="row" style="margin-left: 5px;margin-right: 5px;">

        <div>
            <h4 class="mb-5">Users List</h4>
        </div>

        <div class="card" style="zoom: 80%;">
            <div class="card-body pb-0">
                <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
                    <div class="d-flex flex-wrap align-items-end gap-3 flex-grow-1">
                        <div style="min-width: 220px; max-width: 280px;" class="flex-grow-1">
                            <label class="form-label fw-semibold mb-1" for="filter_role">
                                <i class="ti ti-shield me-1"></i>Role
                            </label>
                            <select id="filter_role" class="form-select tw-select">
                                <option value="">All Roles</option>
                                <option value="super_admin">Super Admin</option>
                                <option value="admin">Admin</option>
                                <option value="staff">Staff</option>
                                <option value="inventory_manager">Inventory Manager</option>
                                <option value="customer">Customer</option>
                            </select>
                        </div>

                        <div style="min-width: 200px; max-width: 260px;" class="flex-grow-1">
                            <label class="form-label fw-semibold mb-1" for="filter_status">
                                <i class="ti ti-activity me-1"></i>Status
                            </label>
                            <select id="filter_status" class="form-select tw-select">
                                <option value="">All Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <button type="button"
                            class="btn btn-primary"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasAddUser"
                            aria-controls="offcanvasAddUser">
                            <i class="ti ti-user-plus me-1"></i>
                            Add User
                        </button>
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
                            <th>Status</th>
                            <th>Joined Date</th>
                            <th>Action</th>
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
                            <th>Status</th>
                            <th>Joined Date</th>
                            <th>Action</th>
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
<script src="{{ asset('assets/backend-page-js/Users/user.js') }}"></script>
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