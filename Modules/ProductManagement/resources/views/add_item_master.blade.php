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
                                            <h4 class="m-0 primarycol">Item Master</h4>
                                        </div>
                                        <div class="d-flex align-items-center">

                                           
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-2" id="saveItemMasterButton">
                                                <i class="ti ti-box me-2"></i> Save
                                            </button>
                                            <button type="button" class="btn btn-label-primary waves-effect waves-light me-2" id="item_master_settings_btn">
                                                <i class="ti ti-settings me-2"></i> Settings
                                            </button>

                                            <a id="backToItemMasterView" class="btn btn-label-secondary waves-effect waves-light me-2">
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
                                                        <input type="text" class="form-control" id="itemcodeId" name="itemcodeId">
                                                    </div>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>

                
                                    <div class="row mb-4 align-items-end">
                                        <div class="col-md-4 mb-0 d-none" id="item_ref_code_wrap">
                                            <label class="form-label labez" for="item_ref_code">Item Reference Code</label>
                                            <input type="text" class="form-control" id="item_ref_code" name="item_ref_code" readonly>
                                        </div>
               

                                        <div class="col-12 mt-1">
                                            <span class="text-danger item_ref_code_error error-text"></span>
                                        </div>
                                    </div>
                                    <div class="alert alert-secondary d-none mb-6" id="item_ref_details" role="status"></div>

                                    <div class="row mb-6">
                                        <div class="col">
                                            <label class="form-label labe" for="ecommerce-product-name">Title (English)</label>
                                            <input
                                                type="text"
                                                class="form-control "
                                                id="itemName_en"
                                                placeholder=""
                                                name="itemName_en"
                                                aria-label="Product title" />
                                            <span class="text-danger itemName_en_error error-text"></span>
                                        </div>
                                        <div class="col">
                                            <label class="form-label labe" for="ecommerce-product-name">Title (Arabic)</label>
                                            <input
                                                type="text"
                                                class="form-control "
                                                id="itemName_ar"
                                                placeholder=""
                                                name="itemName_ar"
                                                aria-label="Product title" />
                                            <span class="text-danger itemName_ar_error error-text"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <div class="col">
                                            <label class="form-label labez" for="ecommerce-product-sku">Min Retail Price</label>
                                            <input
                                                type="text"
                                                id="itemMinRetailPrice"
                                                class="form-control "
                                                name="itemMinRetailPrice"
                                                placeholder="" />
                                            <span class="text-danger itemMinRetailPrice_error error-text"></span>

                                        </div>
                                        <div class="col">
                                            <label class="form-label labez" for="ecommerce-product-barcode"> Profit Level</label>
                                            <input
                                                type="text"
                                                id="itemProfitLevel"
                                                class="form-control "
                                                name="itemProfitLevel"
                                                placeholder="" />
                                            <span class="text-danger itemProfitLevel_error error-text"></span>
                                        </div>
                                        <div class="col">
                                            <label class="form-label labe" for="ecommerce-product-sku">Minimum Qty</label>
                                            <input
                                                type="text"
                                                id="itemMinimunQty"
                                                class="form-control "
                                                name="itenMinimunQty"
                                                placeholder="" />
                                            <span class="text-danger itemMinimunQty_error error-text"></span>
                                        </div>
                                    </div>
                                    <div class="row mb-6">
                                        <div class="col">
                                            <label class="form-label labe" for="ecommerce-product-sku">Reorder Qty</label>
                                            <input
                                                type="text"
                                                id="itemReorderQty"
                                                class="form-control "
                                                name="itemReorderQty"
                                                placeholder="" />
                                            <span class="text-danger itemReorderQty_error error-text"></span>
                                        </div>
                                        <div class="col">
                                            <label class="form-label labez" for="ecommerce-product-sku">Maximum Qty</label>
                                            <input
                                                type="text"
                                                id="itemMaximunQty"
                                                class="form-control "
                                                name="itemMaximunQty"
                                                placeholder="" />
                                            <span class="text-danger itemMaximunQty_error error-text"></span>
                                        </div>

                                    </div>
                                    <div class="row mb-6">

                                        <div class="col">
                                            <label class="form-label labez ecommerce-required-label" for="ecommerce-product-sku">Description (English)</label>
                                            <input
                                                type="text"
                                                id="itemDescription"
                                                class="form-control "
                                                name="itemDescription"
                                                placeholder="" />
                                            <span class="text-danger itemDescription_error error-text"></span>
                                        </div>

                                        <div class="col">
                                            <label class="form-label labez ecommerce-required-label" for="ecommerce-product-sku">Description (Arabic)</label>
                                            <input
                                                type="text"
                                                id="itemDescriptionAr"
                                                class="form-control "
                                                name="itemDescriptionAr"
                                                placeholder="" />
                                            <span class="text-danger itemDescription_error error-text"></span>
                                        </div>

                                        <div class="col">
                                            <label class="form-label labez" for="ecommerce-product-sku">Note</label>
                                            <input
                                                type="text"
                                                id="itemNote"
                                                class="form-control "
                                                name="itemNote"
                                                placeholder="" />
                                            <span class="text-danger itemNote_error error-text"></span>
                                        </div>

                                    </div>

                                    <div class="row mb-6">

                                        <div class="col">
                                            <label class="form-label labez" for="ecommerce-product-sku">Tests</label>
                                            <input
                                                type="text"
                                                id="itemTests"
                                                class="form-control "
                                                name="itemTests"
                                                placeholder="" />
                                            <span class="text-danger itemTests_error error-text"></span>
                                        </div>

                                        <div class="col">
                                            <label class="form-label labez" for="ecommerce-product-sku">sample</label>
                                            <input
                                                type="text"
                                                id="itemSample"
                                                class="form-control "
                                                name="itemSample"
                                                placeholder="" />
                                            <span class="text-danger itemSample_error error-text"></span>
                                        </div>

                                        <div class="col">
                                            <label class="form-label labez" for="ecommerce-product-sku">Results</label>
                                            <input
                                                type="text"
                                                id="itemResults"
                                                class="form-control "
                                                name="itemResults"
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
                                                    {{ old('ecommerce_status', $item->ecommerce_status ?? false) ? 'checked' : '' }}>

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
                                                    {{ old('offer_product_status', $item->offer_product_status ?? false) ? 'checked' : '' }}>
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
                                                    {{ old('best_selling_status', $item->best_selling_status ?? false) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="best_selling_status">
                                                    Active / Inactive
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-3" id="offer_date_range_box" style="display: none;">
                                            <div class="row">

                                                <div class="col-md-3">
                                                    <label class="form-label labez">Offer Start Date</label>
                                                    <input
                                                        type="text"
                                                        class="form-control start_date"
                                                        name="value_from_start_date"
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
                                        <div id="item_master_image_upload_form" method="POST" class="dropzone item-dropzone needsclick dz-clickable"
                                            enctype="multipart/form-data">
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

                                <div class="card-body pt-0" id="lab_item_preview_wrapper" style="display:none;">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h6 class="mb-0 primarycol labez">Uploaded Master Image</h6>
                                    </div>
                                    <div id="lab_item_preview_container" class="dropzone item-preview-box needsclick dz-clickable"></div>
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
                                        <div id="item_sub_image_upload_form" method="POST" class="dropzone item-dropzone needsclick dz-clickable"
                                            enctype="multipart/form-data">
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

                                <div class="card-body pt-0" id="sub_item_preview_wrapper" style="display:none;">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h6 class="mb-0 primarycol labez">Uploaded Sub Images</h6>
                                    </div>
                                    <div id="sub_item_preview_container" class="dropzone item-preview-box needsclick dz-clickable"></div>
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

@endsection