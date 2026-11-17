@extends('backend.layouts.backendLayout')
@section('content')

<div class="mt-5">
    <div class="col-12">

        <div class="divhead d-flex justify-content-end align-items-center mb-4">
            <div id="add_new_master_div">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#colorModal" aria-controls="colorModal">
                    <i class="ti ti-plus me-1"></i>
                    Add Color
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-datatable table-responsive pt-3">
                <table class="dt-advanced-search table item-master-table" id="colors_table">
                    <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Color Name (English)</th>
                            <th>Color Name (Arabic)</th>
                            <th>Color Code</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>SL NO</th>
                            <th>Color Name (English)</th>
                            <th>Color Name (Arabic)</th>
                            <th>Color Code</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="colorModal" tabindex="-1" aria-labelledby="colorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="colorModalLabel" class="modal-title">Add Color</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="color_form" class="pt-0">
                    @csrf
                    <input type="hidden" id="color_id" name="id">

                    <div class="mb-3">
                        <label class="form-label" for="color_name_en">Color Name (English) <span class="text-danger">*</span></label>
                        <input type="text" id="color_name_en" name="name_en" class="form-control" placeholder="e.g. Navy Blue, Crimson Red, Black" required>
                        <span class="text-danger error-text name_en_error"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="color_name_ar">Color Name (Arabic) <span class="text-danger">*</span></label>
                        <input type="text" id="color_name_ar" name="name_ar" class="form-control" dir="rtl" placeholder="مثال: أزرق داكن، أحمر قرمزي، أسود" required>
                        <span class="text-danger error-text name_ar_error"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="color_code">Color Code & Picker <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="color" class="form-control form-control-color p-1" id="color_picker" value="#3b82f6" title="Choose color" style="max-width: 48px; height: 38px; cursor: pointer;">
                            <input type="text" id="color_code" name="color_code" class="form-control font-monospace" placeholder="#3b82f6" value="#3b82f6" required maxlength="50">
                        </div>
                        <span class="text-danger error-text color_code_error"></span>
                        <div class="form-text">Choose a color using the color picker or enter a valid hex code (e.g. #FF5733).</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">Status</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="color_status" name="status" value="1" checked>
                            <label class="form-check-label" for="color_status" id="color_status_label">Active</label>
                        </div>
                        <span class="text-danger error-text status_error"></span>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="saveColorButton" class="btn btn-primary">Save Color</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    window.ColorManagementRoutes = {
        index: @json(route('productmanagement.colors')),
        store: @json(route('productmanagement.colors.store')),
        edit: @json(url('/colors/edit')),
        delete: @json(url('/colors/delete')),
    };
</script>
<script src="{{ asset('assets/backend-page-js/ProductManagement/colors.js') }}?v={{ time() }}"></script>
@endpush
