@extends('backend.layouts.backendLayout')
@section('content')

<div class="mt-5">
    <div class="col-12">

        <div class="divhead d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="mb-0">Sub Categories</h5>
            </div>
            <div id="add_new_master_div">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#subCategoryModal" aria-controls="subCategoryModal">
                    <i class="ti ti-plus me-1"></i>
                    Add Sub Category
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-datatable table-responsive pt-3">
                <table class="dt-advanced-search table item-master-table" id="SubCategories_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Sub Category Name EN</th>
                            <th>Sub Category Name AR</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Sub Category Name EN</th>
                            <th>Sub Category Name AR</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="subCategoryModal" tabindex="-1" aria-labelledby="subCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="subCategoryModalLabel" class="modal-title">Add Sub Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="sub_category_form" class="pt-0" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="sub_category_id" name="id">

            <div class="mb-3">
                <label class="form-label" for="category_id">Category</label>
                <select id="category_id" name="category_id" class="form-select">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name_en }}</option>
                    @endforeach
                </select>
                <span class="text-danger error-text category_id_error"></span>
            </div>

            <div class="mb-3">
                <label class="form-label" for="name_en">Name English</label>
                <input type="text" id="name_en" name="name_en" class="form-control" placeholder="Name English">
                <span class="text-danger error-text name_en_error"></span>
            </div>

            <div class="mb-3">
                <label class="form-label" for="name_ar">Name Arabic</label>
                <input type="text" id="name_ar" name="name_ar" class="form-control" placeholder="Name Arabic">
                <span class="text-danger error-text name_ar_error"></span>
            </div>

            <div class="mb-3">
                <label class="form-label" for="image">Image</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                <span class="text-danger error-text image_error"></span>
                <div id="sub_category_image_preview" class="mt-3"></div>
            </div>

                    <button type="submit" id="saveSubCategoryButton" class="btn btn-primary me-2">Save</button>
                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('assets/backend-page-js/ProductManagement/subcategories.js') }}"></script>
@endpush
