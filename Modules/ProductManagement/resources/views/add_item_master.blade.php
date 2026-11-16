@extends('backend.layouts.backendLayout')

@push('styles')
<link rel="stylesheet" href="{{ asset('page-css/patient.css') }}">
<link rel="stylesheet" href="{{ asset('page-css/billing.css') }}">
@endpush

@section('content')
<style>
    #single-input-box,
    #multiple-input-box {
        display: none;
    }

    #loader-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.3);
        z-index: 9990;
    }

    #loader-center {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
    }

    .repeater-item {
        position: relative;
    }

    .dropzone {
        max-height: 320px !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
    }

    .item-image-card {
        border: 1px solid #eceef1;
        border-radius: 14px;
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
        overflow: hidden;
        background: #ffffff;
    }

    .item-image-card__header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding-bottom: 14px;
        margin-bottom: 14px;
        border-bottom: 1px solid #f1f3f5;
    }

    .item-image-card__title-wrap {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .item-image-card__icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(var(--tw-primary-rgb), 0.12);
        color: var(--tw-primary);
        font-size: 1.15rem;
        flex-shrink: 0;
    }

    .item-image-card__subtitle {
        font-size: 0.78rem;
        color: #8592a3;
        margin: 2px 0 0;
    }

    .item-image-card__badge {
        font-size: 0.72rem;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 999px;
        background: rgba(var(--tw-primary-rgb), 0.12);
        color: var(--tw-primary);
        white-space: nowrap;
    }

    .item-image-card__badge--secondary {
        background: rgba(105, 108, 255, 0.1);
        color: #696cff;
    }

    .item-dropzone.dropzone {
        border: 2px dashed #d4dae3 !important;
        border-radius: 12px !important;
        background: linear-gradient(180deg, #fafbfd 0%, #f5f7fa 100%) !important;
        padding: 28px 18px !important;
        min-height: 205px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        cursor: pointer;
        transition: border-color 0.2s ease, background-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
    }

    .item-dropzone.dropzone:hover,
    .item-dropzone.dropzone.dz-drag-hover {
        border-color: var(--tw-primary) !important;
        background: linear-gradient(180deg, rgba(var(--tw-primary-rgb), 0.04) 0%, rgba(var(--tw-primary-rgb), 0.08) 100%) !important;
        box-shadow: 0 6px 20px rgba(var(--tw-primary-rgb), 0.12);
    }

    .item-dropzone .dz-message {
        margin: 0 !important;
        width: 100%;
    }

    .item-dropzone__icon-circle {
        width: 54px;
        height: 54px;
        margin: 0 auto 12px;
        border-radius: 50%;
        background: #ffffff;
        border: 1px solid #e7eaf0;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.06);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--tw-primary);
        font-size: 1.5rem;
        transition: transform 0.2s ease;
    }

    .item-dropzone.dropzone:hover .item-dropzone__icon-circle {
        transform: translateY(-2px);
    }

    .item-dropzone__title {
        font-size: 0.95rem;
        font-weight: 600;
        color: #384551;
        margin-bottom: 4px;
    }

    .item-dropzone__hint {
        font-size: 0.78rem;
        color: #8592a3;
        margin-bottom: 12px;
    }

    .item-dropzone__divider {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 140px;
        margin: 0 auto 12px;
        font-size: 0.75rem;
        color: #a1acb8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .item-dropzone__divider::before,
    .item-dropzone__divider::after {
        content: "";
        flex: 1;
        height: 1px;
        background: #e1e5eb;
    }

    .item-dropzone__browse-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.82rem;
    }

    .item-preview-box.dropzone {
        border: 1px solid #e7eaf0 !important;
        border-radius: 12px !important;
        background: #f9fafc !important;
        padding: 12px !important;
        min-height: 110px;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .item-preview-box .dz-preview {
        margin: 0 !important;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #e7eaf0;
        background: #ffffff;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.05);
    }

    .other-unit-row {
        display: flex;
        align-items: flex-end;
        flex-wrap: nowrap;
        gap: 12px;
        width: 100%;
    }

    .other-unit-field {
        min-width: 0;
    }

    /* Other Unit */
    .other-unit-select {
        flex: 3;
    }

    /* Multiple */
    .multiple-field {
        flex: 0.8;
    }

    /* Cost / Selling / Offer */
    .price-field {
        flex: 1.7;
    }

    /* Plus + Delete buttons */
    .other-unit-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex: 0 0 auto;
        margin-bottom: 0;
    }

    .other-unit-actions .btn {
        height: 38px;
        white-space: nowrap;
    }

    .other-unit-actions .btn-icon {
        width: 38px;
        padding: 0;
    }

    .other-unit-field .error-text {
        display: block;
        white-space: nowrap;
    }

    @media (max-width: 992px) {

        .other-unit-row {
            overflow-x: auto;
            padding-bottom: 5px;
        }

        .other-unit-select {
            flex: 0 0 250px;
        }

        .multiple-field {
            flex: 0 0 80px;
        }

        .price-field {
            flex: 0 0 140px;
        }

        .other-unit-actions {
            flex: 0 0 auto;
        }
    }
</style>
<div id="loader-overlay">
    <div id="loader-center">
        <div class="sk-chase sk-primary">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>
    </div>
</div>
<form id="item_master" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="item_master_id" name="id" value="{{ $itemMaster->id ?? '' }}">
    <input type="file" id="master_image" name="master_image" class="d-none" accept="image/*">
    <input type="file" id="sub_images" name="sub_images[]" class="d-none" accept="image/*" multiple>

    <div class="mt-5">
        <div class="">
            <div class="app-ecommerce">
                <div class=" " style="zoom: 85%;">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="card mb-6">
                                <div class="card invoice-preview-card p-sm-12 p-6">
                                    <div class="d-flex align-items-center justify-content-between mt-8 mb-8">
                                        <div class="d-flex align-items-center flex-column">
                                            <h4 class="m-0 primarycol">{{ isset($itemMaster) ? 'Edit Item Master' : 'Item Master' }}</h4>
                                        </div>
                                        <div class="d-flex align-items-center">

                                           
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-2" id="saveItemMasterButton">
                                                <i class="ti ti-box me-2"></i> {{ isset($itemMaster) ? 'Update' : 'Save' }}
                                            </button>
                                            <button type="button" class="btn btn-label-primary waves-effect waves-light me-2" id="item_master_settings_btn">
                                                <i class="ti ti-settings me-2"></i> Settings
                                            </button>

                                            <a id="backToItemMasterView" href="{{ route('productmanagement.item_master') }}" class="btn btn-label-secondary waves-effect waves-light me-2">
                                                <i class="ti ti-arrow-left icon-directional me-2"></i> Back
                                            </a>
                                        </div>
                                    </div>

                                    <hr class="mt-0 mb-6 custom-line">

                                    <div class="d-flex flex-wrap flex-column flex-sm-row justify-content-between text-heading">
                                        <!-- SKU -->
                                        <div class="col-md-5 pe-0 ps-0 ps-md-2">
                                            <dl class="row mb-0 align-items-center">
                                                <dt class="col-sm-2 mb-2 d-flex align-items-center justify-content-end text-end">
                                                    <span class="h5 mb-0 text-nowrap">
                                                        SKU
                                                    </span>
                                                </dt>

                                                <dd class="col-sm-7 mb-0 ps-1">
                                                    <input type="text"
                                                        name="sku"
                                                        id="sku"
                                                        class="form-control"
                                                        placeholder=""
                                                        value="{{ old('sku', $itemMaster->sku ?? '') }}">

                                                    <small id="skuError" class="text-danger d-none">
                                                        SKU Required
                                                    </small>
                                                </dd>
                                            </dl>
                                        </div>

                                        <div class="col-md-5 pe-0 ps-0 ps-md-2">
                                            <dl class="row mb-0">
                                                <dt class="col-sm-5 mb-2 d-md-flex align-items-center justify-content-end text-end">
                                                    <span class="h5 text-capitalize mb-0 text-nowrap">
                                                        Item Code
                                                    </span>
                                                </dt>
                                                <dd class="col-sm-7">
                                                    <div class="input-group input-group-merge">
                                                        <input type="text" class="form-control" id="itemcodeId" name="itemcodeId" value="{{ old('itemcodeId', $itemMaster->item_code ?? '') }}">
                                                    </div>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>

                
                                    <div class="row mb-4 align-items-end">
                                        <div class="col-md-4 mb-0 d-none" id="item_ref_code_wrap">
                                            <label class="form-label labez" for="item_ref_code">Item Reference Code</label>
                                            <input type="text" class="form-control" id="item_ref_code" name="item_ref_code" value="{{ old('item_ref_code', $itemMaster->item_ref_code ?? '') }}">
                                        </div>
               

                                        <div class="col-12 mt-1">
                                            <span class="text-danger item_ref_code_error error-text"></span>
                                        </div>
                                    </div>
                                    <div class="alert alert-secondary d-none mb-6" id="item_ref_details" role="status"></div>

                                    <div class="row mb-6">
                                        <div class="col">
                                            <label class="form-label labe" for="itemName_en">Title (English)</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="itemName_en"
                                                placeholder=""
                                                name="itemName_en"
                                                value="{{ old('itemName_en', $itemMaster->name_en ?? '') }}"
                                                aria-label="Product title" />
                                            <span class="text-danger itemName_en_error error-text"></span>
                                        </div>
                                        <div class="col">
                                            <label class="form-label labe" for="itemName_ar">Title (Arabic)</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="itemName_ar"
                                                placeholder=""
                                                name="itemName_ar"
                                                value="{{ old('itemName_ar', $itemMaster->name_ar ?? '') }}"
                                                aria-label="Product title" />
                                            <span class="text-danger itemName_ar_error error-text"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <label class="form-label labe" for="category_id">Category</label>
                                            <div class="input-group">
                                                <select class="form-select" id="category_id" name="category_id">
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories ?? [] as $category)
                                                        <option value="{{ $category->id }}" {{ (old('category_id', $itemMaster->category_id ?? '') == $category->id) ? 'selected' : '' }}>{{ $category->name_en }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-primary" id="btn_quick_add_category" title="Add Category" data-bs-toggle="modal" data-bs-target="#quickCategoryModal">
                                                    <i class="ti ti-plus"></i>
                                                </button>
                                            </div>
                                            <span class="text-danger category_id_error error-text"></span>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label labe" for="sub_category_id">Sub Category</label>
                                            <div class="input-group">
                                                <select class="form-select" id="sub_category_id" name="sub_category_id">
                                                    <option value="">Select Sub Category</option>
                                                </select>
                                                <button type="button" class="btn btn-primary" id="btn_quick_add_subcategory" title="Add Sub Category" data-bs-toggle="modal" data-bs-target="#quickSubCategoryModal">
                                                    <i class="ti ti-plus"></i>
                                                </button>
                                            </div>
                                            <span class="text-danger sub_category_id_error error-text"></span>
                                        </div>
                                    </div>

                                    <div class="row mb-6">
                                        <div class="col">
                                            <label class="form-label labez" for="itemMinRetailPrice">Min Retail Price</label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                id="itemMinRetailPrice"
                                                class="form-control"
                                                name="itemMinRetailPrice"
                                                value="{{ old('itemMinRetailPrice', $itemMaster->min_retail_price ?? '') }}"
                                                placeholder="" />
                                            <span class="text-danger itemMinRetailPrice_error error-text"></span>

                                        </div>
                                        <div class="col">
                                            <label class="form-label labez" for="itemProfitLevel"> Profit Level</label>
                                            <input
                                                type="text"
                                                id="itemProfitLevel"
                                                class="form-control"
                                                name="itemProfitLevel"
                                                value="{{ old('itemProfitLevel', $itemMaster->profit_level ?? '') }}"
                                                placeholder="" />
                                            <span class="text-danger itemProfitLevel_error error-text"></span>
                                        </div>
                                        <div class="col">
                                            <label class="form-label labe" for="itemMinimunQty">Minimum Qty</label>
                                            <input
                                                type="number"
                                                id="itemMinimunQty"
                                                class="form-control"
                                                name="itemMinimunQty"
                                                value="{{ old('itemMinimunQty', $itemMaster->min_qty ?? '') }}"
                                                placeholder="" />
                                            <span class="text-danger itemMinimunQty_error error-text"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <div class="col">
                                            <label class="form-label labe" for="itemReorderQty">Reorder Qty</label>
                                            <input
                                                type="number"
                                                id="itemReorderQty"
                                                class="form-control"
                                                name="itemReorderQty"
                                                value="{{ old('itemReorderQty', $itemMaster->reorder_qty ?? '') }}"
                                                placeholder="" />
                                            <span class="text-danger itemReorderQty_error error-text"></span>
                                        </div>
                                        <div class="col">
                                            <label class="form-label labez" for="itemMaximunQty">Maximum Qty</label>
                                            <input
                                                type="number"
                                                id="itemMaximunQty"
                                                class="form-control"
                                                name="itemMaximunQty"
                                                value="{{ old('itemMaximunQty', $itemMaster->max_qty ?? '') }}"
                                                placeholder="" />
                                            <span class="text-danger itemMaximunQty_error error-text"></span>
                                        </div>

                                    </div>
                                    <div class="row mb-6">

                                        <div class="col">
                                            <label class="form-label labez ecommerce-required-label" for="itemDescription">Description (English)</label>
                                            <input
                                                type="text"
                                                id="itemDescription"
                                                class="form-control"
                                                name="itemDescription"
                                                value="{{ old('itemDescription', $itemMaster->description_en ?? '') }}"
                                                placeholder="" />
                                            <span class="text-danger itemDescription_error error-text"></span>
                                        </div>

                                        <div class="col">
                                            <label class="form-label labez ecommerce-required-label" for="itemDescriptionAr">Description (Arabic)</label>
                                            <input
                                                type="text"
                                                id="itemDescriptionAr"
                                                class="form-control"
                                                name="itemDescriptionAr"
                                                value="{{ old('itemDescriptionAr', $itemMaster->description_ar ?? '') }}"
                                                placeholder="" />
                                            <span class="text-danger itemDescriptionAr_error error-text"></span>
                                        </div>

                                        <div class="col">
                                            <label class="form-label labez" for="itemNote">Note</label>
                                            <input
                                                type="text"
                                                id="itemNote"
                                                class="form-control"
                                                name="itemNote"
                                                value="{{ old('itemNote', $itemMaster->note ?? '') }}"
                                                placeholder="" />
                                            <span class="text-danger itemNote_error error-text"></span>
                                        </div>

                                    </div>

                                    <div class="row mb-6">

                                        <div class="col">
                                            <label class="form-label labez" for="itemTests">Tests</label>
                                            <input
                                                type="text"
                                                id="itemTests"
                                                class="form-control"
                                                name="itemTests"
                                                value="{{ old('itemTests', $itemMaster->tests ?? '') }}"
                                                placeholder="" />
                                            <span class="text-danger itemTests_error error-text"></span>
                                        </div>

                                        <div class="col">
                                            <label class="form-label labez" for="itemSample">sample</label>
                                            <input
                                                type="text"
                                                id="itemSample"
                                                class="form-control"
                                                name="itemSample"
                                                value="{{ old('itemSample', $itemMaster->sample ?? '') }}"
                                                placeholder="" />
                                            <span class="text-danger itemSample_error error-text"></span>
                                        </div>

                                        <div class="col">
                                            <label class="form-label labez" for="itemResults">Results</label>
                                            <input
                                                type="text"
                                                id="itemResults"
                                                class="form-control"
                                                name="itemResults"
                                                value="{{ old('itemResults', $itemMaster->results ?? '') }}"
                                                placeholder="" />
                                            <span class="text-danger itemResults_error error-text"></span>
                                        </div>

                                    </div>



                                    <div class="row mb-5">
                                        <div class="col-md-4 mb-5">
                                            <label class="form-label labez"> E-Commerce Status</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input"
                                                    type="checkbox"
                                                    id="ecommerce_status"
                                                    name="ecommerce_status"
                                                    value="1"
                                                    {{ old('ecommerce_status', $itemMaster->ecommerce_status ?? true) ? 'checked' : '' }}>

                                                <label class="form-check-label" for="ecommerce_status">
                                                    Active / Inactive
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-5">
                                            <label class="form-label labez">Offer Product</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input"
                                                    type="checkbox"
                                                    id="offer_product_status"
                                                    name="offer_product_status"
                                                    value="1"
                                                    {{ old('offer_product_status', $itemMaster->offer_product_status ?? false) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="offer_product_status">
                                                    Active / Inactive
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-4 mb-5">
                                            <label class="form-label labez">Best Selling Status</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input"
                                                    type="checkbox"
                                                    id="best_selling_status"
                                                    name="best_selling_status"
                                                    value="1"
                                                    {{ old('best_selling_status', $itemMaster->best_selling_status ?? false) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="best_selling_status">
                                                    Active / Inactive
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-3" id="offer_date_range_box" style="{{ old('offer_product_status', $itemMaster->offer_product_status ?? false) ? '' : 'display: none;' }}">
                                            <div class="row">

                                                <div class="col-md-3">
                                                    <label class="form-label labez">Offer Start Date</label>
                                                    <input
                                                        type="text"
                                                        class="form-control start_date"
                                                        name="value_from_start_date"
                                                        value="{{ old('value_from_start_date', isset($itemMaster) && $itemMaster->offer_start_date ? $itemMaster->offer_start_date->format('Y-m-d') : '') }}"
                                                        placeholder="Start Date"
                                                        autocomplete="off" />
                                                    <span class="text-danger value_from_start_date_error error-text"></span>
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label labez">Offer End Date</label>
                                                    <input
                                                        type="text"
                                                        class="form-control end_date"
                                                        name="value_from_end_date"
                                                        value="{{ old('value_from_end_date', isset($itemMaster) && $itemMaster->offer_end_date ? $itemMaster->offer_end_date->format('Y-m-d') : '') }}"
                                                        placeholder="End Date"
                                                        autocomplete="off" />
                                                    <span class="text-danger value_from_end_date_error error-text"></span>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="col-12 col-lg-4">
                            <div class="card item-image-card mb-6">
                                <div class="card-body">
                                    <div class="item-image-card__header">
                                        <div class="item-image-card__title-wrap">
                                            <span class="item-image-card__icon">
                                                <i class="ti ti-photo"></i>
                                            </span>
                                            <div>
                                                <h5 class="mb-0 card-title primarycol labez">Master Image</h5>
                                                <p class="item-image-card__subtitle">Main product cover thumbnail</p>
                                            </div>
                                        </div>
                                        <span class="item-image-card__badge">Cover</span>
                                    </div>

                                    <div class="card-body p-0">
                                        <div id="item_master_image_upload_form" class="dropzone item-dropzone needsclick dz-clickable">
                                            <div class="dz-message needsclick">
                                                <div class="item-dropzone__icon-circle">
                                                    <i class="ti ti-cloud-upload"></i>
                                                </div>
                                                <p class="item-dropzone__title needsclick">Drop files here or click to upload</p>
                                                <p class="item-dropzone__hint">JPG, PNG, WEBP up to 2MB</p>
                                                <div class="item-dropzone__divider">or</div>
                                                <span class="note needsclick btn btn-sm btn-label-primary waves-effect item-dropzone__browse-btn"
                                                    id="btnBrowse">
                                                    <i class="ti ti-upload ti-xs"></i> Browse Image
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body pt-0" id="lab_item_preview_wrapper" style="{{ (isset($itemMaster) && $itemMaster->masterImage) ? '' : 'display:none;' }}">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h6 class="mb-0 primarycol labez">Uploaded Master Image</h6>
                                    </div>
                                    <div id="lab_item_preview_container" class="item-preview-box p-2">
                                        @if(isset($itemMaster) && $itemMaster->masterImage)
                                            <div class="position-relative d-inline-block">
                                                <img src="{{ $itemMaster->masterImage->url }}" class="rounded border" style="width: 100px; height: 100px; object-fit: cover;">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="card item-image-card mb-6">
                                <div class="card-body">
                                    <div class="item-image-card__header">
                                        <div class="item-image-card__title-wrap">
                                            <span class="item-image-card__icon">
                                                <i class="ti ti-photos"></i>
                                            </span>
                                            <div>
                                                <h5 class="mb-0 card-title primarycol labez">Sub Images</h5>
                                                <p class="item-image-card__subtitle">Additional product gallery angles</p>
                                            </div>
                                        </div>
                                        <span class="item-image-card__badge item-image-card__badge--secondary">Gallery</span>
                                    </div>

                                    <div class="card-body p-0">
                                        <div id="item_sub_image_upload_form" class="dropzone item-dropzone needsclick dz-clickable">
                                            <div class="dz-message needsclick">
                                                <div class="item-dropzone__icon-circle">
                                                    <i class="ti ti-photo-plus"></i>
                                                </div>
                                                <p class="item-dropzone__title needsclick">Drop files here or click to upload</p>
                                                <p class="item-dropzone__hint">Upload multiple images (JPG, PNG, WEBP)</p>
                                                <div class="item-dropzone__divider">or</div>
                                                <span class="note needsclick btn btn-sm btn-label-primary waves-effect item-dropzone__browse-btn"
                                                    id="btnBrowseSub">
                                                    <i class="ti ti-upload ti-xs"></i> Browse Image
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body pt-0" id="sub_item_preview_wrapper" style="{{ (isset($itemMaster) && $itemMaster->subImages->count()) ? '' : 'display:none;' }}">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h6 class="mb-0 primarycol labez">Uploaded Sub Images</h6>
                                    </div>
                                    <div id="sub_item_preview_container" class="item-preview-box p-2 d-flex flex-wrap gap-2">
                                        @if(isset($itemMaster))
                                            @foreach($itemMaster->subImages as $subImg)
                                                <div class="position-relative existing-sub-media" data-media-id="{{ $subImg->id }}">
                                                    <img src="{{ $subImg->url }}" class="rounded border" style="width: 75px; height: 75px; object-fit: cover;">
                                                    <button type="button" class="btn btn-danger btn-xs position-absolute top-0 end-0 p-1 rounded-circle remove-sub-media-btn" data-media-id="{{ $subImg->id }}" style="transform: translate(25%, -25%);" title="Remove image">
                                                        <i class="ti ti-x ti-xs"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="content-backdrop fade"></div>

<div class="modal fade" id="itemMasterSettingsModal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Item Master Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="service_common_group_form" action="">
                    <input type="hidden" id="common_group_id">
                    <input type="hidden" id="type" name="type" class="type">
                    <div class="row g-4 d-flex" style="justify-content: center;">

                        <div class="col-12  d-flex" style="flex-direction: column; align-items: center;">

                            <label for="selectpickerLiveSearch" class="form-label labez mb-5">Disable or Enable</label>
                            <div class="" style="display: flex; gap: 50px">

                                <div class="d-flex gap-7 mb-2">
                                    <div class="form-check form-switch me-n2">
                                        <input type="checkbox" class="form-check-input" id="otherUnitFlag" name="otherUnitFlag" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>

            </div>

            <div class="modal-footer" id="service_common_group_form_footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="file-view-modal" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center" id="file-view-modal-content">
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="printBarcodeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Print Barcode</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-6">
                        <label class="form-label labez" for="printBarcodeCopies">Copies</label>
                        <input type="number" id="printBarcodeCopies" class="form-control" min="1" max="500" value="1">
                    </div>
                    <div class="col-6">
                        <label class="form-label labez" for="printBarcodeSize">Label Size</label>
                        <select id="printBarcodeSize" class="form-select">
                            <option value="38x25">38 x 25 mm</option>
                            <option value="50x25">50 x 25 mm</option>
                            <option value="50x30">50 x 30 mm</option>
                            <option value="60x30" selected>60 x 30 mm</option>
                            <option value="60x40">60 x 40 mm</option>
                            <option value="100x50">100 x 50 mm</option>
                            <option value="custom">Custom</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label labez" for="printBarcodeWidth">Width (mm)</label>
                        <div class="input-group">
                            <input type="number" id="printBarcodeWidth" class="form-control print-barcode-dim" min="20" max="200" step="1" value="60">
                            <span class="input-group-text">mm</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="form-label labez" for="printBarcodeHeight">Height (mm)</label>
                        <div class="input-group">
                            <input type="number" id="printBarcodeHeight" class="form-control print-barcode-dim" min="10" max="200" step="1" value="30">
                            <span class="input-group-text">mm</span>
                        </div>
                    </div>
                    <div class="col-12 d-flex flex-wrap gap-4">
                        <div class="form-check">
                            <input class="form-check-input print-barcode-opt" type="checkbox" id="printBarcodeShowName" checked>
                            <label class="form-check-label" for="printBarcodeShowName">Show Name</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input print-barcode-opt" type="checkbox" id="printBarcodeShowPrice" checked>
                            <label class="form-check-label" for="printBarcodeShowPrice">Show Price</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input print-barcode-opt" type="checkbox" id="printBarcodeShowCode">
                            <label class="form-check-label" for="printBarcodeShowCode">Show Code</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label labez">Preview</label>
                        <div id="printBarcodePreview" class="border rounded p-3 d-flex justify-content-center bg-white"
                            data-invalid="Invalid barcode value."
                            data-price-label="Price"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="printBarcodeConfirmBtn">
                    <i class="ti ti-printer ti-xs me-1"></i>Print
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="quickCategoryModal" tabindex="-1" aria-labelledby="quickCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="quickCategoryModalLabel" class="modal-title">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="quick_category_form" class="pt-0" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label labe" for="quick_cat_name_en">Name English</label>
                        <input type="text" id="quick_cat_name_en" name="name_en" class="form-control" placeholder="Name English" required>
                        <span class="text-danger error-text quick_cat_name_en_error"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label labe" for="quick_cat_name_ar">Name Arabic</label>
                        <input type="text" id="quick_cat_name_ar" name="name_ar" class="form-control" placeholder="Name Arabic" required>
                        <span class="text-danger error-text quick_cat_name_ar_error"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label labez" for="quick_cat_image">Image</label>
                        <input type="file" id="quick_cat_image" name="image" class="form-control" accept="image/*">
                        <span class="text-danger error-text quick_cat_image_error"></span>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="saveQuickCategoryBtn" class="btn btn-primary">
                            <i class="ti ti-check me-1"></i> Save Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="quickSubCategoryModal" tabindex="-1" aria-labelledby="quickSubCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="quickSubCategoryModalLabel" class="modal-title">Add Sub Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="quick_sub_category_form" class="pt-0" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label labe" for="quick_subcat_category_id">Category</label>
                        <select id="quick_subcat_category_id" name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach ($categories ?? [] as $category)
                                <option value="{{ $category->id }}">{{ $category->name_en }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text quick_subcat_category_id_error"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label labe" for="quick_subcat_name_en">Name English</label>
                        <input type="text" id="quick_subcat_name_en" name="name_en" class="form-control" placeholder="Name English" required>
                        <span class="text-danger error-text quick_subcat_name_en_error"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label labe" for="quick_subcat_name_ar">Name Arabic</label>
                        <input type="text" id="quick_subcat_name_ar" name="name_ar" class="form-control" placeholder="Name Arabic" required>
                        <span class="text-danger error-text quick_subcat_name_ar_error"></span>
                    </div>

                    <div class="mb-3">
                        <label class="form-label labez" for="quick_subcat_image">Image</label>
                        <input type="file" id="quick_subcat_image" name="image" class="form-control" accept="image/*">
                        <span class="text-danger error-text quick_subcat_image_error"></span>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" id="saveQuickSubCategoryBtn" class="btn btn-primary">
                            <i class="ti ti-check me-1"></i> Save Sub Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    let categoriesData = @json($categories ?? []);
    const initialCatId = "{{ old('category_id', $itemMaster->category_id ?? '') }}";
    const initialSubCatId = "{{ old('sub_category_id', $itemMaster->sub_category_id ?? '') }}";

    function renderCategoryOptions(selectedId) {
        let catOptions = '<option value="">Select Category</option>';
        let modalOptions = '<option value="">Select Category</option>';

        categoriesData.forEach(function (cat) {
            const isCatSelected = selectedId && String(cat.id) === String(selectedId);
            const selAttr = isCatSelected ? ' selected' : '';
            catOptions += `<option value="${cat.id}"${selAttr}>${cat.name_en}</option>`;
            modalOptions += `<option value="${cat.id}"${selAttr}>${cat.name_en}</option>`;
        });

        $('#category_id').html(catOptions);
        $('#quick_subcat_category_id').html(modalOptions);
    }

    function updateSubCategories(categoryId, selectedSubId) {
        const $subSelect = $('#sub_category_id');
        $subSelect.html('<option value="">Select Sub Category</option>');

        if (!categoryId) {
            return;
        }

        const category = categoriesData.find(c => String(c.id) === String(categoryId));
        if (category && Array.isArray(category.sub_categories) && category.sub_categories.length > 0) {
            category.sub_categories.forEach(function (sub) {
                const isSubSelected = selectedSubId && String(sub.id) === String(selectedSubId);
                $subSelect.append(`<option value="${sub.id}"${isSubSelected ? ' selected' : ''}>${sub.name_en}</option>`);
            });
        } else {
            $.ajax({
                url: '/sub_categories/by-category/' + categoryId,
                type: 'GET',
                dataType: 'json',
                success: function (res) {
                    if (res.success && Array.isArray(res.data)) {
                        if (category) {
                            category.sub_categories = res.data;
                        }
                        res.data.forEach(function (sub) {
                            const isSubSelected = selectedSubId && String(sub.id) === String(selectedSubId);
                            $subSelect.append(`<option value="${sub.id}"${isSubSelected ? ' selected' : ''}>${sub.name_en}</option>`);
                        });
                    }
                }
            });
        }
    }

    if (initialCatId) {
        updateSubCategories(initialCatId, initialSubCatId);
    }

    $('#category_id').on('change', function () {
        const catId = $(this).val();
        updateSubCategories(catId);
    });

    // Offer product status toggle
    $('#offer_product_status').on('change', function () {
        if ($(this).is(':checked')) {
            $('#offer_date_range_box').slideDown();
        } else {
            $('#offer_date_range_box').slideUp();
        }
    });

    // Master Image Upload & Preview
    $('#btnBrowse, #item_master_image_upload_form').on('click', function (e) {
        if ($(e.target).is('#master_image')) return;
        $('#master_image').trigger('click');
    });

    $('#master_image').on('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#lab_item_preview_container').html(`
                    <div class="position-relative d-inline-block">
                        <img src="${e.target.result}" class="rounded border" style="width: 100px; height: 100px; object-fit: cover;">
                        <button type="button" class="btn btn-danger btn-xs position-absolute top-0 end-0 p-1 rounded-circle" id="clear_master_image" style="transform: translate(25%, -25%);" title="Clear image">
                            <i class="ti ti-x ti-xs"></i>
                        </button>
                    </div>
                `);
                $('#lab_item_preview_wrapper').slideDown();
            };
            reader.readAsDataURL(file);
        }
    });

    $(document).on('click', '#clear_master_image', function () {
        $('#master_image').val('');
        $('#lab_item_preview_container').empty();
        $('#lab_item_preview_wrapper').slideUp();
    });

    // Sub Images Upload & Preview
    $('#btnBrowseSub, #item_sub_image_upload_form').on('click', function (e) {
        if ($(e.target).is('#sub_images')) return;
        $('#sub_images').trigger('click');
    });

    $('#sub_images').on('change', function () {
        const files = this.files;
        if (files && files.length > 0) {
            $('#sub_item_preview_wrapper').slideDown();
            Array.from(files).forEach(function (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#sub_item_preview_container').append(`
                        <div class="position-relative new-sub-preview">
                            <img src="${e.target.result}" class="rounded border" style="width: 75px; height: 75px; object-fit: cover;">
                        </div>
                    `);
                };
                reader.readAsDataURL(file);
            });
        }
    });

    // Delete existing sub media
    $(document).on('click', '.remove-sub-media-btn', function () {
        const $card = $(this).closest('.existing-sub-media');
        const mediaId = $(this).data('media-id');
        const itemId = $('#item_master_id').val();

        if (!itemId || !mediaId) return;

        Swal.fire({
            title: 'Delete Image?',
            text: 'Are you sure you want to remove this gallery image?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete',
            customClass: {
                confirmButton: 'btn btn-primary me-2',
                cancelButton: 'btn btn-label-secondary',
            },
            buttonsStyling: false,
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/item_master/${itemId}/media/delete/${mediaId}`,
                    type: 'POST',
                    dataType: 'json',
                    success: function (res) {
                        if (res.success) {
                            $card.fadeOut(300, function () {
                                $(this).remove();
                            });
                        }
                    }
                });
            }
        });
    });

    // Quick Add Category
    $('#quickCategoryModal').on('show.bs.modal', function () {
        $('#quick_category_form')[0].reset();
        $('#quick_category_form .error-text').text('');
        $('#quick_category_form .form-control').removeClass('is-invalid');
    });

    $('#quickSubCategoryModal').on('show.bs.modal', function () {
        $('#quick_sub_category_form')[0].reset();
        $('#quick_sub_category_form .error-text').text('');
        $('#quick_sub_category_form .form-control, #quick_sub_category_form .form-select').removeClass('is-invalid');
        const currentCat = $('#category_id').val();
        if (currentCat) {
            $('#quick_subcat_category_id').val(currentCat);
        }
    });

    $('#quick_category_form').on('submit', function (e) {
        e.preventDefault();
        const $btn = $('#saveQuickCategoryBtn');
        const originalHtml = $btn.html();
        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Saving...');
        $('#quick_category_form .error-text').text('');
        $('#quick_category_form .form-control').removeClass('is-invalid');

        const formData = new FormData(this);

        $.ajax({
            url: '{{ route("productmanagement.categories.store") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $btn.prop('disabled', false).html(originalHtml);
                if (response.success) {
                    const newCatId = response.id || response.data?.id;
                    const newCategory = {
                        id: newCatId,
                        name_en: response.data?.name_en || $('#quick_cat_name_en').val(),
                        name_ar: response.data?.name_ar || $('#quick_cat_name_ar').val(),
                        sub_categories: []
                    };
                    categoriesData.push(newCategory);
                    renderCategoryOptions(newCategory.id);
                    $('#category_id').val(newCategory.id).trigger('change');

                    const modalEl = document.getElementById('quickCategoryModal');
                    const modal = bootstrap.Modal.getInstance(modalEl);
                    if (modal) {
                        modal.hide();
                    }

                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message || 'Category created successfully.',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    }
                }
            },
            error: function (xhr) {
                $btn.prop('disabled', false).html(originalHtml);
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors || {};
                    if (errors.name_en) {
                        $('#quick_cat_name_en').addClass('is-invalid');
                        $('.quick_cat_name_en_error').text(errors.name_en[0]);
                    }
                    if (errors.name_ar) {
                        $('#quick_cat_name_ar').addClass('is-invalid');
                        $('.quick_cat_name_ar_error').text(errors.name_ar[0]);
                    }
                    if (errors.image) {
                        $('#quick_cat_image').addClass('is-invalid');
                        $('.quick_cat_image_error').text(errors.image[0]);
                    }
                } else {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to create category. Please try again.',
                        });
                    }
                }
            }
        });
    });

    $('#quick_sub_category_form').on('submit', function (e) {
        e.preventDefault();
        const $btn = $('#saveQuickSubCategoryBtn');
        const originalHtml = $btn.html();
        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Saving...');
        $('#quick_sub_category_form .error-text').text('');
        $('#quick_sub_category_form .form-control, #quick_sub_category_form .form-select').removeClass('is-invalid');

        const formData = new FormData(this);
        const selectedCatId = $('#quick_subcat_category_id').val();
        const subNameEn = $('#quick_subcat_name_en').val();
        const subNameAr = $('#quick_subcat_name_ar').val();

        $.ajax({
            url: '{{ route("productmanagement.sub_categories.store") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $btn.prop('disabled', false).html(originalHtml);
                if (response.success) {
                    const newSubId = response.id || response.data?.id;
                    const newSub = {
                        id: newSubId,
                        category_id: selectedCatId,
                        name_en: response.data?.name_en || subNameEn,
                        name_ar: response.data?.name_ar || subNameAr,
                    };

                    let catObj = categoriesData.find(c => String(c.id) === String(selectedCatId));
                    if (catObj) {
                        if (!Array.isArray(catObj.sub_categories)) {
                            catObj.sub_categories = [];
                        }
                        catObj.sub_categories.push(newSub);
                    }

                    $('#category_id').val(selectedCatId);
                    updateSubCategories(selectedCatId, newSubId);

                    const modalEl = document.getElementById('quickSubCategoryModal');
                    const modal = bootstrap.Modal.getInstance(modalEl);
                    if (modal) {
                        modal.hide();
                    }

                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message || 'Sub category created successfully.',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    }
                }
            },
            error: function (xhr) {
                $btn.prop('disabled', false).html(originalHtml);
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors || {};
                    if (errors.category_id) {
                        $('#quick_subcat_category_id').addClass('is-invalid');
                        $('.quick_subcat_category_id_error').text(errors.category_id[0]);
                    }
                    if (errors.name_en) {
                        $('#quick_subcat_name_en').addClass('is-invalid');
                        $('.quick_subcat_name_en_error').text(errors.name_en[0]);
                    }
                    if (errors.name_ar) {
                        $('#quick_subcat_name_ar').addClass('is-invalid');
                        $('.quick_subcat_name_ar_error').text(errors.name_ar[0]);
                    }
                    if (errors.image) {
                        $('#quick_subcat_image').addClass('is-invalid');
                        $('.quick_subcat_image_error').text(errors.image[0]);
                    }
                } else {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to create sub category. Please try again.',
                        });
                    }
                }
            }
        });
    });

    // ==========================================
    // Main Form Submit (Create & Update)
    // ==========================================
    $('#item_master').on('submit', function (e) {
        e.preventDefault();

        const $btn = $('#saveItemMasterButton');
        const originalHtml = $btn.html();
        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Saving...');

        $('.error-text').text('');
        $('.form-control, .form-select').removeClass('is-invalid');
        $('#skuError').addClass('d-none');

        const itemId = $('#item_master_id').val();
        const submitUrl = itemId
            ? ('/item_master/update/' + itemId)
            : '{{ route("productmanagement.item_master.store") }}';

        const formData = new FormData(this);

        $.ajax({
            url: submitUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $btn.prop('disabled', false).html(originalHtml);
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message || 'Item Master saved successfully.',
                        timer: 1500,
                        showConfirmButton: false,
                    }).then(function () {
                        window.location.href = response.redirect || '{{ route("productmanagement.item_master") }}';
                    });
                }
            },
            error: function (xhr) {
                $btn.prop('disabled', false).html(originalHtml);

                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors || {};

                    const fieldMapping = {
                        'sku': '#sku',
                        'itemcodeId': '#itemcodeId',
                        'item_code': '#itemcodeId',
                        'item_ref_code': '#item_ref_code',
                        'itemName_en': '#itemName_en',
                        'name_en': '#itemName_en',
                        'itemName_ar': '#itemName_ar',
                        'name_ar': '#itemName_ar',
                        'category_id': '#category_id',
                        'sub_category_id': '#sub_category_id',
                        'itemMinRetailPrice': '#itemMinRetailPrice',
                        'min_retail_price': '#itemMinRetailPrice',
                        'itemProfitLevel': '#itemProfitLevel',
                        'profit_level': '#itemProfitLevel',
                        'itemMinimunQty': '#itemMinimunQty',
                        'itenMinimunQty': '#itemMinimunQty',
                        'min_qty': '#itemMinimunQty',
                        'itemReorderQty': '#itemReorderQty',
                        'reorder_qty': '#itemReorderQty',
                        'itemMaximunQty': '#itemMaximunQty',
                        'max_qty': '#itemMaximunQty',
                        'itemDescription': '#itemDescription',
                        'description_en': '#itemDescription',
                        'itemDescriptionAr': '#itemDescriptionAr',
                        'description_ar': '#itemDescriptionAr',
                        'itemNote': '#itemNote',
                        'note': '#itemNote',
                        'itemTests': '#itemTests',
                        'tests': '#itemTests',
                        'itemSample': '#itemSample',
                        'sample': '#itemSample',
                        'itemResults': '#itemResults',
                        'results': '#itemResults',
                        'value_from_start_date': '.start_date',
                        'offer_start_date': '.start_date',
                        'value_from_end_date': '.end_date',
                        'offer_end_date': '.end_date',
                    };

                    for (const [key, msg] of Object.entries(errors)) {
                        const selector = fieldMapping[key];
                        if (selector) {
                            $(selector).addClass('is-invalid');
                            $('.' + key + '_error').text(msg[0]);
                        }
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        text: 'Please check the required fields and errors in the form.',
                        customClass: {
                            confirmButton: 'btn btn-primary',
                        },
                        buttonsStyling: false,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong while saving the item. Please try again.',
                        customClass: {
                            confirmButton: 'btn btn-primary',
                        },
                        buttonsStyling: false,
                    });
                }
            }
        });
    });
});
</script>
@endpush