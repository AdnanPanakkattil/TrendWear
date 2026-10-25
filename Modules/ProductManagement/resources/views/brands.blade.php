@extends('backend.layouts.backendLayout')
@section('content')

<div class="mt-5">
    <div class="col-12">

        <div class="divhead d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="mb-0"> Brand </h5>
            </div>
            <div id="add_new_master_div">
                <a href="" class="btn btn-primary">
                    Add Brand
                </a>
            </div>
        </div>

        <div class="card">
            <br>

            <div class="card-datatable table-responsive">
                <table class="dt-advanced-search table item-master-table"
                    id="lab_items_table">

                    <thead>
                        <tr>
                            <th>slNo</th>
                            <th>id</th>
                            <th>Brand Nma En</th>
                            <th>Brand Nma Ar</th>
                            <th>actions</th>
                        </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th>slNo</th>
                            <th>id</th>
                            <th>Brand Nma En</th>
                            <th>Brand Nma Ar</th>
                            <th>actions</th>
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