<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title d-flex align-items-center">
            <i class="ti ti-user-plus me-2 text-primary"></i>
            <span>Add User</span>
        </h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 p-4 h-100">

        <form class="add-new-user pt-0" id="addNewUserForm" onsubmit="return false">

            <div class="row mt-3">
                <div class="d-grid gap-2 col-10 col-lg-8 mx-auto">
                    <button class="btn btn-primary btn-lg redirect-button d-flex align-items-center justify-content-center py-2"
                        data-role="super_admin"
                        data-url="{{ route('backend.superadmin') }}"
                        type="button">
                        <i class="ti ti-shield-lock me-2 fs-5"></i>
                        <span>Super Admin</span>
                    </button>
                </div>
            </div>

            <div class="row mt-3">
                <div class="d-grid gap-2 col-10 col-lg-8 mx-auto">
                    <button class="btn btn-primary btn-lg redirect-button d-flex align-items-center justify-content-center py-2"
                        data-role="admin"
                        data-url="{{ route('backend.admin') }}"
                        type="button">
                        <i class="ti ti-user-shield me-2 fs-5"></i>
                        <span>Admin</span>
                    </button>
                </div>
            </div>

            <div class="row mt-3">
                <div class="d-grid gap-2 col-10 col-lg-8 mx-auto">
                    <button class="btn btn-primary btn-lg redirect-button d-flex align-items-center justify-content-center py-2"
                        data-role="staff"
                        data-url="{{ route('backend.staff') }}"
                        type="button">
                        <i class="ti ti-id-badge-2 me-2 fs-5"></i>
                        <span>Staff</span>
                    </button>
                </div>
            </div>

            <div class="row mt-3">
                <div class="d-grid gap-2 col-10 col-lg-8 mx-auto">
                    <button class="btn btn-primary btn-lg redirect-button d-flex align-items-center justify-content-center py-2"
                        data-role="inventory_manager"
                        data-url="{{ route('backend.inventorymanager') }}"
                        type="button">
                        <i class="ti ti-building-warehouse me-2 fs-5"></i>
                        <span>Inventory Manager</span>
                    </button>
                </div>
            </div>

            <div class="row mt-3">
                <div class="d-grid gap-2 col-10 col-lg-8 mx-auto">
                    <button class="btn btn-primary btn-lg redirect-button d-flex align-items-center justify-content-center py-2"
                        data-role="customer"
                        data-url="{{ route('user.create', ['role' => 'customer']) }}"
                        type="button">
                        <i class="ti ti-users me-2 fs-5"></i>
                        <span>Customer</span>
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
