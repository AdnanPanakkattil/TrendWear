@extends('backend.layouts.backendLayout')
@section('content')

<div class="mt-5">
    <div class="col-12">

        <div class="divhead d-flex justify-content-end align-items-center mb-4">
            <div id="add_new_master_div">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#sizeModal" aria-controls="sizeModal">
                    <i class="ti ti-plus me-1"></i>
                    Add Size
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-datatable table-responsive pt-3">
                <table class="dt-advanced-search table item-master-table" id="sizes_table">
                    <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Size Name</th>
                            <th>Size Code</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>SL NO</th>
                            <th>Size Name</th>
                            <th>Size Code</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="sizeModal" tabindex="-1" aria-labelledby="sizeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="sizeModalLabel" class="modal-title">Add Size</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="size_form" class="pt-0">
                    @csrf
                    <input type="hidden" id="size_id" name="id">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="size_name">Size Name <span class="text-danger">*</span></label>
                            <input type="text" id="size_name" name="name" class="form-control" placeholder="e.g. Medium, Large, 32" required>
                            <span class="text-danger error-text name_error"></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="size_code">Size Code <span class="text-danger">*</span></label>
                            <input type="text" id="size_code" name="code" class="form-control" placeholder="e.g. M, L, XL, 32" required>
                            <span class="text-danger error-text code_error"></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="size_category_id">Category</label>
                            <select class="form-select tw-select" id="size_category_id" name="category_id" data-search="true" data-placeholder="Select Category">
                                <option value="">Select Category</option>
                                @foreach ($categories ?? [] as $category)
                                    <option value="{{ $category->id }}">{{ $category->name_en }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text category_id_error"></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label d-block">Status</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="size_status" name="status" value="1" checked>
                                <label class="form-check-label" for="size_status" id="size_status_label">Active</label>
                            </div>
                            <span class="text-danger error-text status_error"></span>
                        </div>
                    </div>

                    <div class="border rounded p-3 mt-2 mb-4 bg-light-subtle">
                        <h6 class="mb-3 text-secondary d-flex align-items-center">
                            <i class="ti ti-ruler-measure me-2 fs-5"></i>
                            Measurements <span class="text-muted ms-1 small fw-normal">(Optional)</span>
                        </h6>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="chest_inch">Chest (Inch)</label>
                                <input type="number" step="0.01" min="0" id="chest_inch" name="chest_inch" class="form-control" placeholder="e.g. 38.00">
                                <span class="text-danger error-text chest_inch_error"></span>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="waist_inch">Waist (Inch)</label>
                                <input type="number" step="0.01" min="0" id="waist_inch" name="waist_inch" class="form-control" placeholder="e.g. 32.00">
                                <span class="text-danger error-text waist_inch_error"></span>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label" for="shoulder_inch">Shoulder (Inch)</label>
                                <input type="number" step="0.01" min="0" id="shoulder_inch" name="shoulder_inch" class="form-control" placeholder="e.g. 17.50">
                                <span class="text-danger error-text shoulder_inch_error"></span>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="length_inch">Length (Inch)</label>
                                <input type="number" step="0.01" min="0" id="length_inch" name="length_inch" class="form-control" placeholder="e.g. 28.00">
                                <span class="text-danger error-text length_inch_error"></span>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="sleeve_length_inch">Sleeve Length (Inch)</label>
                                <input type="number" step="0.01" min="0" id="sleeve_length_inch" name="sleeve_length_inch" class="form-control" placeholder="e.g. 25.00">
                                <span class="text-danger error-text sleeve_length_inch_error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="saveSizeButton" class="btn btn-primary">Save Size</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    window.SizeManagementRoutes = {
        index: @json(route('productmanagement.sizes')),
        store: @json(route('productmanagement.sizes.store')),
        edit: @json(url('/sizes/edit')),
        delete: @json(url('/sizes/delete')),
    };
</script>
<script src="{{ asset('assets/backend-page-js/ProductManagement/sizes.js') }}?v={{ time() }}"></script>
@endpush
