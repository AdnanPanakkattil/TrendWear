@extends('backend.layouts.backendLayout')
@section('content')

<div class="mt-4">
    <div class="col-12">

        <div class="divhead d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1 font-weight-bold">Item Master</h4>
                <p class="text-muted small mb-0">Manage catalog products, pricing, stock, and clothing attributes.</p>
            </div>
            <div id="add_new_master_div">
                <a href="{{ route('productmanagement.add_item_master') }}" class="btn btn-primary">
                    <i class="fa fa-plus me-1"></i> Add Item Master
                </a>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-datatable table-responsive p-3">
                <table class="dt-advanced-search table table-hover item-master-table" id="item_master_table">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>SKU / Code</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Min Retail Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>SKU / Code</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Min Retail Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('assets/backend-page-js/ProductManagement/itemmaster.js') }}"></script>
@endpush