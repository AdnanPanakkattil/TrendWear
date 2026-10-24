@extends('backend.layouts.backendLayout')
@section('content')

<div class="col-md-12" style="zoom: 85% !important">
    <div class="card h-100" style="overflow: hidden;">
        <div class="card-header d-flex justify-content-between">
            <h6 class="card-title mb-0">Categories</h6>
            <small class="text-muted">Product Management</small>
        </div>

        <div class="card-body">
            <div class="col-12 divhead p-0 d-flex justify-content-between align-items-center mb-3">
                <h6 class="card-title mb-0">Category List</h6>

                <button type="button"
                    class="btn btn-primary me-5 mb-4"
                    data-bs-toggle="modal"
                    data-bs-target="#categoryModal"
                    id="addCategoryBtn">
                    <i class="ti ti-plus me-1"></i>
                    Add Category
                </button>
            </div>

            <div class="card-datatable table-responsive">
                <table class="dt-advanced-search table service-common-table" id="Categories_table">
                    <thead>
                        <tr>
                            <th>Category ID</th>
                            <th>Name English</th>
                            <th>Name Arabic</th>
                            <th>Value</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Category ID</th>
                            <th>Name English</th>
                            <th>Name Arabic</th>
                            <th>Value</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add / Edit Category Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">
                    <i class="ti ti-tags me-2 text-primary"></i>
                    <span id="categoryModalTitle">Add Category</span>
                </h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="categoryForm" action="{{ isset($category) ? route('category.update', $category->id) : '/categories' }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="_method" id="categoryMethod" value="{{ isset($category) ? 'PUT' : '' }}">
                    <input type="hidden" name="id" id="categoryId" value="{{ isset($category) ? $category->id : '' }}">

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Category Name English</label>
                            <input type="text" name="name_en" id="name_en" class="form-control name_en" value="{{ isset($category) ? $category->name_en : '' }}" placeholder="Category Name English" />
                            <span class="text-danger error-text name_en_error"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Category Name Arabic</label>
                            <input type="text" name="name_ar" id="name_ar" class="form-control name_ar" value="{{ isset($category) ? $category->name_ar : '' }}" placeholder="Category Name Arabic" />
                            <span class="text-danger error-text name_ar_error"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Value</label>
                            <input type="text" name="value" id="value" class="form-control value" value="{{ isset($category) ? $category->value : '' }}" placeholder="Value" />
                            <span class="text-danger error-text value_error"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" id="image" class="form-control image" />
                            <span class="text-danger error-text image_error"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="saveCategoryBtn">Save</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('assets/backend-page-js/category.js') }}"></script>
@endpush