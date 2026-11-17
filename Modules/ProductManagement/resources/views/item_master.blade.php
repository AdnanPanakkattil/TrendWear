@extends('backend.layouts.backendLayout')
@section('content')

<div class="mt-5">
    <div class="col-12">

        <div class="divhead d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="mb-0">Item Master</h5>
            </div>
            <div id="add_new_master_div">
                <a href="{{ route('productmanagement.add_item_master') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i>
                    Add Item Master
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-datatable table-responsive pt-3">
                <table class="dt-advanced-search table item-master-table" id="ItemMaster_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Item Name EN</th>
                            <th>Cost Price</th>
                            <th>Selling Price</th>
                            <th>Offer Price</th>
                            <th class="text-center">Featured</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Item Name EN</th>
                            <th>Cost Price</th>
                            <th>Selling Price</th>
                            <th>Offer Price</th>
                            <th class="text-center">Featured</th>
                            <th>Image</th>
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
<script src="{{ asset('assets/backend-page-js/ProductManagement/itemmaster.js') }}?v={{ filemtime(public_path('assets/backend-page-js/ProductManagement/itemmaster.js')) }}"></script>
@endpush
