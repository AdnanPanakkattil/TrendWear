@extends('backend.layouts.backendLayout')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/patient.css') }}">
<link rel="stylesheet" href="{{ asset('assets/page-css/add_item_master.css') }}?v={{ filemtime(public_path('assets/page-css/add_item_master.css')) }}">
@endpush

@section('content')
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
                                        <div class="col-md-4 mb-3 mb-md-0">
                                            <label class="form-label labe" for="category_id">Category</label>
                                            <div class="input-group">
                                                <select class="form-select tw-select" id="category_id" name="category_id" data-search="true" data-placeholder="Select Category">
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

                                        <div class="col-md-4 mb-3 mb-md-0">
                                            <label class="form-label labe" for="sub_category_id">Sub Category</label>
                                            <div class="input-group">
                                                <select class="form-select tw-select" id="sub_category_id" name="sub_category_id" data-search="true" data-placeholder="Select Sub Category">
                                                    <option value="">Select Sub Category</option>
                                                </select>
                                                <button type="button" class="btn btn-primary" id="btn_quick_add_subcategory" title="Add Sub Category" data-bs-toggle="modal" data-bs-target="#quickSubCategoryModal">
                                                    <i class="ti ti-plus"></i>
                                                </button>
                                            </div>
                                            <span class="text-danger sub_category_id_error error-text"></span>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label labe" for="brand_id">Brand</label>
                                            <div class="input-group">
                                                <select class="form-select tw-select" id="brand_id" name="brand_id" data-search="true" data-placeholder="Select Brand">
                                                    <option value="">Select Brand</option>
                                                    @foreach ($brands ?? [] as $brand)
                                                        <option value="{{ $brand->id }}" {{ (old('brand_id', $itemMaster->brand_id ?? '') == $brand->id) ? 'selected' : '' }}>{{ $brand->name_en }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="text-danger brand_id_error error-text"></span>
                                        </div>
                                    </div>

                                    <div class="row mb-6">
                                        <div class="col-md-4">
                                            <label class="form-label labez" for="cost_price">Cost Price</label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                id="cost_price"
                                                class="form-control"
                                                name="cost_price"
                                                value="{{ old('cost_price', $itemMaster->cost_price ?? '') }}"
                                                placeholder="0.00" />
                                            <span class="text-danger cost_price_error error-text"></span>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label labez" for="selling_price">Selling Price</label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                id="selling_price"
                                                class="form-control"
                                                name="selling_price"
                                                value="{{ old('selling_price', $itemMaster->selling_price ?? '') }}"
                                                placeholder="0.00" />
                                            <span class="text-danger selling_price_error error-text"></span>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label labez" for="itemMinRetailPrice">Min Retail Price</label>
                                            <input
                                                type="number"
                                                step="0.01"
                                                id="itemMinRetailPrice"
                                                class="form-control"
                                                name="itemMinRetailPrice"
                                                value="{{ old('itemMinRetailPrice', $itemMaster->min_retail_price ?? '') }}"
                                                placeholder="0.00" />
                                            <span class="text-danger itemMinRetailPrice_error error-text"></span>
                                        </div>
                                    </div>

                                    <div class="row mb-6">
                                        <div class="col-md-3">
                                            <label class="form-label labez" for="itemProfitLevel">Profit Level</label>
                                            <input
                                                type="text"
                                                id="itemProfitLevel"
                                                class="form-control"
                                                name="itemProfitLevel"
                                                value="{{ old('itemProfitLevel', $itemMaster->profit_level ?? '') }}"
                                                placeholder="" />
                                            <span class="text-danger itemProfitLevel_error error-text"></span>
                                        </div>

                                        <div class="col-md-3">
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

                                        <div class="col-md-3">
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

                                        <div class="col-md-3">
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

                                    <div class="row mb-5">
                                        <div class="col-md-3 mb-5">
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

                                        <div class="col-md-3 mb-5">
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

                                        <div class="col-md-3 mb-5">
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

                                        <div class="col-md-3 mb-5">
                                            <label class="form-label labez">Featured Product</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input"
                                                    type="checkbox"
                                                    id="featured_product"
                                                    name="featured_product"
                                                    value="1"
                                                    {{ old('featured_product', $itemMaster->featured_product ?? false) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="featured_product">
                                                    Active / Inactive
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-3" id="offer_date_range_box" style="{{ old('offer_product_status', $itemMaster->offer_product_status ?? false) ? '' : 'display: none;' }}">
                                            <div class="card p-3 border shadow-none bg-light-subtle">
                                                <div class="row g-3">
                                                    <div class="col-md-4">
                                                        <label class="form-label labez" for="offer_price">Offer Price</label>
                                                        <input
                                                            type="number"
                                                            step="0.01"
                                                            class="form-control"
                                                            id="offer_price"
                                                            name="offer_price"
                                                            value="{{ old('offer_price', $itemMaster->offer_price ?? '') }}"
                                                            placeholder="0.00" />
                                                        <span class="text-danger offer_price_error error-text"></span>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="form-label labez" for="value_from_start_date">Offer Start Date</label>
                                                        <div class="input-group">
                                                            <input
                                                                type="text"
                                                                class="form-control start_date"
                                                                id="value_from_start_date"
                                                                name="value_from_start_date"
                                                                value="{{ old('value_from_start_date', isset($itemMaster) && $itemMaster->offer_start_date ? $itemMaster->offer_start_date->format('Y-m-d') : '') }}"
                                                                placeholder="YYYY-MM-DD"
                                                                autocomplete="off" />
                                                            <span class="input-group-text cursor-pointer"><i class="ti ti-calendar"></i></span>
                                                        </div>
                                                        <span class="text-danger value_from_start_date_error error-text"></span>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <label class="form-label labez" for="value_from_end_date">Offer End Date</label>
                                                        <div class="input-group">
                                                            <input
                                                                type="text"
                                                                class="form-control end_date"
                                                                id="value_from_end_date"
                                                                name="value_from_end_date"
                                                                value="{{ old('value_from_end_date', isset($itemMaster) && $itemMaster->offer_end_date ? $itemMaster->offer_end_date->format('Y-m-d') : '') }}"
                                                                placeholder="YYYY-MM-DD"
                                                                autocomplete="off" />
                                                            <span class="input-group-text cursor-pointer"><i class="ti ti-calendar"></i></span>
                                                        </div>
                                                        <span class="text-danger value_from_end_date_error error-text"></span>
                                                    </div>
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
                        <select id="printBarcodeSize" class="form-select tw-select">
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
                        <select id="quick_subcat_category_id" name="category_id" class="form-select tw-select" data-search="true" data-placeholder="Select Category" required>
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
    window.ItemMasterConfig = {
        categories: @json($categories ?? []),
        initialCategoryId: @json(old('category_id', $itemMaster->category_id ?? '')),
        initialSubCategoryId: @json(old('sub_category_id', $itemMaster->sub_category_id ?? '')),
        routes: {
            categoriesStore: @json(route('productmanagement.categories.store')),
            subCategoriesStore: @json(route('productmanagement.sub_categories.store')),
            itemMasterStore: @json(route('productmanagement.item_master.store')),
            itemMasterIndex: @json(route('productmanagement.item_master')),
        }
    };
</script>
<script src="{{ asset('assets/backend-page-js/ProductManagement/add_item_master.js') }}?v={{ filemtime(public_path('assets/backend-page-js/ProductManagement/add_item_master.js')) }}"></script>
@endpush