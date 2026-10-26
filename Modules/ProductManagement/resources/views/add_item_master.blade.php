@extends('backend.layouts.backendLayout')

@section('content')

<style>
    :root {
        --tw-primary: #ff5a1f;
        --tw-primary-light: #fff0e9;
        --tw-border: #e5e7eb;
        --tw-text: #374151;
        --tw-muted: #8a8fa3;
    }

    .product-create-wrapper {
        padding: 20px;
        background: #f8f9fc;
    }

    .product-create-wrapper .card {
        border: 1px solid var(--tw-border);
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        margin-bottom: 20px;
    }

    .product-create-wrapper .card-header {
        background: #fff;
        padding: 18px 22px;
        border-bottom: 1px solid var(--tw-border);
        border-radius: 12px 12px 0 0;
    }

    .product-create-wrapper .card-body {
        padding: 22px;
    }

    .product-create-wrapper .section-title {
        font-size: 15px;
        font-weight: 700;
        color: #252a34;
        margin-bottom: 0;
    }

    .product-create-wrapper .section-subtitle {
        font-size: 12px;
        color: var(--tw-muted);
        margin-top: 5px;
    }

    .product-create-wrapper label {
        font-size: 13px;
        font-weight: 600;
        color: var(--tw-text);
        margin-bottom: 7px;
    }

    .product-create-wrapper .form-control,
    .product-create-wrapper .form-select {
        min-height: 42px;
        border: 1px solid #e2e5ec;
        border-radius: 7px;
        font-size: 13px;
        color: #374151;
    }

    .product-create-wrapper .form-control:focus,
    .product-create-wrapper .form-select:focus {
        border-color: var(--tw-primary);
        box-shadow: 0 0 0 3px rgba(255, 90, 31, 0.08);
    }

    .product-create-wrapper textarea.form-control {
        min-height: 100px;
    }

    .product-create-wrapper .required {
        color: #e53935;
    }

    .product-create-wrapper .form-check-input:checked {
        background-color: var(--tw-primary);
        border-color: var(--tw-primary);
    }

    .product-create-wrapper .btn-primary {
        background: var(--tw-primary);
        border-color: var(--tw-primary);
    }

    .product-create-wrapper .btn-primary:hover {
        background: #e94c13;
        border-color: #e94c13;
    }

    .product-create-wrapper .btn-outline-primary {
        color: var(--tw-primary);
        border-color: var(--tw-primary);
    }

    .product-create-wrapper .btn-outline-primary:hover {
        background: var(--tw-primary);
        color: #fff;
    }

    .product-create-wrapper .image-upload-box {
        border: 2px dashed #d7dce5;
        border-radius: 10px;
        padding: 25px;
        text-align: center;
        background: #fafbfc;
        cursor: pointer;
        transition: 0.2s;
    }

    .product-create-wrapper .image-upload-box:hover {
        border-color: var(--tw-primary);
        background: var(--tw-primary-light);
    }

    .product-create-wrapper .image-upload-box i {
        font-size: 30px;
        color: var(--tw-primary);
        margin-bottom: 10px;
    }

    .product-create-wrapper .image-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
    }

    .product-create-wrapper .image-preview img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid var(--tw-border);
    }

    .product-create-wrapper .variant-table th {
        font-size: 12px;
        font-weight: 700;
        background: #f8f9fc;
        color: #555;
        white-space: nowrap;
    }

    .product-create-wrapper .variant-table td {
        vertical-align: middle;
    }

    .product-create-wrapper .variant-table input,
    .product-create-wrapper .variant-table select {
        min-width: 90px;
        font-size: 12px;
    }

    .product-create-wrapper .status-box {
        background: #fafbfc;
        border: 1px solid var(--tw-border);
        border-radius: 8px;
        padding: 15px;
        height: 100%;
    }

    .product-create-wrapper .status-box .form-check {
        margin-bottom: 12px;
    }

    .product-create-wrapper .status-box .form-check:last-child {
        margin-bottom: 0;
    }

    .product-create-wrapper .sticky-footer {
        position: sticky;
        bottom: 0;
        background: #fff;
        padding: 15px 20px;
        border: 1px solid var(--tw-border);
        border-radius: 10px;
        z-index: 10;
        box-shadow: 0 -3px 12px rgba(0, 0, 0, 0.04);
    }

    @media (max-width: 768px) {
        .product-create-wrapper {
            padding: 10px;
        }

        .product-create-wrapper .card-body {
            padding: 15px;
        }
    }
</style>


<div class="product-create-wrapper">

    {{-- PAGE HEADER --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>
            <h4 class="fw-bold mb-1">Create Product</h4>

            <p class="text-muted mb-0" style="font-size: 13px;">
                Add a new product to your TrendWear store
            </p>
        </div>

        <a href="{{ url()->previous() }}"
           class="btn btn-outline-secondary btn-sm">

            <i class="fa fa-arrow-left me-1"></i>
            Back

        </a>

    </div>


    {{-- FORM START --}}
    <form id="productCreateForm"
          action=""
          method="POST"
          enctype="multipart/form-data">

        @csrf


        {{-- BASIC INFORMATION --}}
        <div class="card">

            <div class="card-body">

                <div class="row g-3">

                    {{-- PRODUCT NAME --}}
                    <div class="col-md-6">

                        <label>
                            Product Name (English)
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="name_en"
                               class="form-control"
                               placeholder="Example: Classic Cotton Shirt"
                               required>

                    </div>


                    {{-- ARABIC NAME --}}
                    <div class="col-md-6">

                        <label>
                            Product Name (Arabic)
                        </label>

                        <input type="text"
                               name="name_ar"
                               class="form-control"
                               dir="rtl"
                               placeholder="اسم المنتج">

                    </div>


                    {{-- SKU --}}
                    <div class="col-md-4">

                        <label>
                            SKU
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="sku"
                               class="form-control"
                               placeholder="TW-MEN-001"
                               required>

                    </div>


                    {{-- BARCODE --}}
                    <div class="col-md-4">

                        <label>
                            Barcode
                        </label>

                        <input type="text"
                               name="barcode"
                               class="form-control"
                               placeholder="Enter barcode">

                    </div>


                    {{-- PRODUCT TYPE --}}
                    <div class="col-md-4">

                        <label>
                            Product Type
                            <span class="required">*</span>
                        </label>

                        <select name="product_type"
                                id="product_type"
                                class="form-select"
                                required>

                            <option value="">Select Product Type</option>

                            <option value="simple">Simple Product</option>

                            <option value="variable">Variable Product</option>

                        </select>

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="col-md-12">

                        <label>
                            Product Description
                            <span class="required">*</span>
                        </label>

                        <textarea name="description"
                                  class="form-control"
                                  placeholder="Describe the product, material, design and features..."
                                  required></textarea>

                    </div>


                    {{-- SHORT DESCRIPTION --}}
                    <div class="col-md-12">

                        <label>
                            Short Description
                        </label>

                        <textarea name="short_description"
                                  class="form-control"
                                  rows="2"
                                  placeholder="Short description displayed on product cards"></textarea>

                    </div>

                </div>

            </div>

        </div>



        {{-- CATEGORY INFORMATION --}}
        <div class="card">

            <div class="card-header">

                <h6 class="section-title">
                    <i class="fa fa-layer-group me-2 text-primary"></i>
                    Category & Classification
                </h6>

                <p class="section-subtitle">
                    Organize your product into the correct category.
                </p>

            </div>

            <div class="card-body">

                <div class="row g-3">

                    {{-- CATEGORY --}}
                    <div class="col-md-4">

                        <label>
                            Category
                            <span class="required">*</span>
                        </label>

                        <select name="category_id"
                                id="category_id"
                                class="form-select"
                                required>

                            <option value="">Select Category</option>

                            <option value="1">Men</option>

                            <option value="2">Women</option>

                            <option value="3">Kids</option>

                            <option value="4">Accessories</option>

                        </select>

                    </div>


                    {{-- SUB CATEGORY --}}
                    <div class="col-md-4">

                        <label>
                            Sub Category
                            <span class="required">*</span>
                        </label>

                        <select name="subcategory_id"
                                id="subcategory_id"
                                class="form-select"
                                required>

                            <option value="">Select Sub Category</option>

                            <option value="1">T-Shirts</option>

                            <option value="2">Shirts</option>

                            <option value="3">Jeans</option>

                            <option value="4">Dresses</option>

                            <option value="5">Hoodies</option>

                            <option value="6">Jackets</option>

                            <option value="7">Shoes</option>

                        </select>

                    </div>


                    {{-- BRAND --}}
                    <div class="col-md-4">

                        <label>
                            Brand
                            <span class="required">*</span>
                        </label>

                        <select name="brand_id"
                                id="brand_id"
                                class="form-select"
                                required>

                            <option value="">Select Brand</option>

                            <option value="1">TrendWear</option>

                        </select>

                    </div>


                    {{-- GENDER --}}
                    <div class="col-md-4">

                        <label>
                            Gender
                            <span class="required">*</span>
                        </label>

                        <select name="gender"
                                class="form-select"
                                required>

                            <option value="">Select Gender</option>

                            <option value="men">Men</option>

                            <option value="women">Women</option>

                            <option value="kids">Kids</option>

                            <option value="unisex">Unisex</option>

                        </select>

                    </div>


                    {{-- AGE GROUP --}}
                    <div class="col-md-4">

                        <label>
                            Age Group
                        </label>

                        <select name="age_group"
                                class="form-select">

                            <option value="">Select Age Group</option>

                            <option value="baby">Baby</option>

                            <option value="kids">Kids</option>

                            <option value="teen">Teen</option>

                            <option value="adult">Adult</option>

                        </select>

                    </div>


                    {{-- COLLECTION --}}
                    <div class="col-md-4">

                        <label>
                            Collection
                        </label>

                        <select name="collection"
                                class="form-select">

                            <option value="">Select Collection</option>

                            <option value="new_arrivals">New Arrivals</option>

                            <option value="summer">Summer Collection</option>

                            <option value="winter">Winter Collection</option>

                            <option value="casual">Casual Collection</option>

                            <option value="formal">Formal Collection</option>

                        </select>

                    </div>

                </div>

            </div>

        </div>



        {{-- CLOTHING DETAILS --}}
        <div class="card">

            <div class="card-header">

                <h6 class="section-title">
                    <i class="fa fa-shirt me-2 text-primary"></i>
                    Clothing Details
                </h6>

                <p class="section-subtitle">
                    Add product specifications for your customers.
                </p>

            </div>

            <div class="card-body">

                <div class="row g-3">

                    {{-- FABRIC --}}
                    <div class="col-md-4">

                        <label>
                            Fabric / Material
                        </label>

                        <select name="fabric"
                                class="form-select">

                            <option value="">Select Fabric</option>

                            <option value="cotton">Cotton</option>

                            <option value="polyester">Polyester</option>

                            <option value="linen">Linen</option>

                            <option value="denim">Denim</option>

                            <option value="silk">Silk</option>

                            <option value="wool">Wool</option>

                            <option value="blended">Blended</option>

                            <option value="other">Other</option>

                        </select>

                    </div>


                    {{-- FIT TYPE --}}
                    <div class="col-md-4">

                        <label>
                            Fit Type
                        </label>

                        <select name="fit_type"
                                class="form-select">

                            <option value="">Select Fit</option>

                            <option value="slim">Slim Fit</option>

                            <option value="regular">Regular Fit</option>

                            <option value="relaxed">Relaxed Fit</option>

                            <option value="oversized">Oversized</option>

                        </select>

                    </div>


                    {{-- PATTERN --}}
                    <div class="col-md-4">

                        <label>
                            Pattern
                        </label>

                        <select name="pattern"
                                class="form-select">

                            <option value="">Select Pattern</option>

                            <option value="solid">Solid</option>

                            <option value="printed">Printed</option>

                            <option value="striped">Striped</option>

                            <option value="checked">Checked</option>

                            <option value="floral">Floral</option>

                            <option value="graphic">Graphic</option>

                        </select>

                    </div>


                    {{-- SLEEVE --}}
                    <div class="col-md-4">

                        <label>
                            Sleeve Type
                        </label>

                        <select name="sleeve_type"
                                class="form-select">

                            <option value="">Select Sleeve</option>

                            <option value="full">Full Sleeve</option>

                            <option value="half">Half Sleeve</option>

                            <option value="short">Short Sleeve</option>

                            <option value="sleeveless">Sleeveless</option>

                        </select>

                    </div>


                    {{-- NECK TYPE --}}
                    <div class="col-md-4">

                        <label>
                            Neck Type
                        </label>

                        <select name="neck_type"
                                class="form-select">

                            <option value="">Select Neck Type</option>

                            <option value="round">Round Neck</option>

                            <option value="v_neck">V Neck</option>

                            <option value="collar">Collar</option>

                            <option value="hooded">Hooded</option>

                        </select>

                    </div>


                    {{-- CARE INSTRUCTIONS --}}
                    <div class="col-md-4">

                        <label>
                            Care Instructions
                        </label>

                        <select name="care_instructions"
                                class="form-select">

                            <option value="">Select Care Instructions</option>

                            <option value="machine_wash">Machine Wash</option>

                            <option value="hand_wash">Hand Wash</option>

                            <option value="dry_clean">Dry Clean</option>

                            <option value="do_not_bleach">Do Not Bleach</option>

                        </select>

                    </div>


                    {{-- PRODUCT WEIGHT --}}
                    <div class="col-md-4">

                        <label>
                            Product Weight (g)
                        </label>

                        <input type="number"
                               name="weight"
                               class="form-control"
                               min="0"
                               placeholder="250">

                    </div>


                    {{-- COUNTRY --}}
                    <div class="col-md-4">

                        <label>
                            Country of Origin
                        </label>

                        <input type="text"
                               name="country_of_origin"
                               class="form-control"
                               placeholder="India">

                    </div>


                    {{-- WASH CARE --}}
                    <div class="col-md-4">

                        <label>
                            Wash Care
                        </label>

                        <input type="text"
                               name="wash_care"
                               class="form-control"
                               placeholder="Wash with similar colors">

                    </div>

                </div>

            </div>

        </div>



        {{-- PRICING --}}
        <div class="card">

            <div class="card-header">

                <h6 class="section-title">
                    <i class="fa fa-indian-rupee-sign me-2 text-primary"></i>
                    Pricing & Inventory
                </h6>

                <p class="section-subtitle">
                    Manage product price, discounts and available stock.
                </p>

            </div>

            <div class="card-body">

                <div class="row g-3">

                    {{-- COST PRICE --}}
                    <div class="col-md-3">

                        <label>
                            Cost Price
                        </label>

                        <input type="number"
                               name="cost_price"
                               id="cost_price"
                               class="form-control"
                               min="0"
                               step="0.01"
                               placeholder="0.00">

                    </div>


                    {{-- SELLING PRICE --}}
                    <div class="col-md-3">

                        <label>
                            Selling Price
                            <span class="required">*</span>
                        </label>

                        <input type="number"
                               name="selling_price"
                               id="selling_price"
                               class="form-control"
                               min="0"
                               step="0.01"
                               placeholder="1499.00"
                               required>

                    </div>


                    {{-- OFFER PRICE --}}
                    <div class="col-md-3">

                        <label>
                            Offer Price
                        </label>

                        <input type="number"
                               name="offer_price"
                               id="offer_price"
                               class="form-control"
                               min="0"
                               step="0.01"
                               placeholder="999.00">

                    </div>


                    {{-- TAX --}}
                    <div class="col-md-3">

                        <label>
                            Tax (%)
                        </label>

                        <input type="number"
                               name="tax"
                               class="form-control"
                               min="0"
                               max="100"
                               step="0.01"
                               placeholder="5">

                    </div>


                    {{-- STOCK --}}
                    <div class="col-md-4">

                        <label>
                            Stock Quantity
                            <span class="required">*</span>
                        </label>

                        <input type="number"
                               name="stock_quantity"
                               id="stock_quantity"
                               class="form-control"
                               min="0"
                               placeholder="100"
                               required>

                    </div>


                    {{-- LOW STOCK --}}
                    <div class="col-md-4">

                        <label>
                            Low Stock Alert
                        </label>

                        <input type="number"
                               name="low_stock_alert"
                               class="form-control"
                               min="0"
                               placeholder="5">

                    </div>


                    {{-- STOCK STATUS --}}
                    <div class="col-md-4">

                        <label>
                            Stock Status
                        </label>

                        <select name="stock_status"
                                class="form-select">

                            <option value="in_stock">In Stock</option>

                            <option value="out_of_stock">Out of Stock</option>

                            <option value="backorder">Allow Backorders</option>

                        </select>

                    </div>


                    {{-- OFFER ENABLE --}}
                    <div class="col-md-12">

                        <div class="form-check form-switch">

                            <input class="form-check-input"
                                   type="checkbox"
                                   name="offer_status"
                                   id="offer_status"
                                   value="1">

                            <label class="form-check-label"
                                   for="offer_status">

                                Enable Product Offer

                            </label>

                        </div>

                    </div>


                    {{-- OFFER DATES --}}
                    <div class="col-md-6 offer-fields">

                        <label>
                            Offer Start Date
                        </label>

                        <input type="datetime-local"
                               name="offer_start_date"
                               class="form-control">

                    </div>


                    <div class="col-md-6 offer-fields">

                        <label>
                            Offer End Date
                        </label>

                        <input type="datetime-local"
                               name="offer_end_date"
                               class="form-control">

                    </div>

                </div>

            </div>

        </div>



        {{-- VARIANTS --}}
        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">

                <div>

                    <h6 class="section-title">
                        <i class="fa fa-sliders me-2 text-primary"></i>
                        Product Variants
                    </h6>

                    <p class="section-subtitle">
                        Add different sizes, colors, SKUs and stock quantities.
                    </p>

                </div>

                <button type="button"
                        class="btn btn-outline-primary btn-sm"
                        id="addVariantBtn">

                    <i class="fa fa-plus me-1"></i>
                    Add Variant

                </button>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered variant-table">

                        <thead>

                            <tr>

                                <th>Size</th>

                                <th>Color</th>

                                <th>SKU</th>

                                <th>Price</th>

                                <th>Stock</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody id="variantTableBody">

                            <tr>

                                <td>

                                    <select name="variants[0][size]"
                                            class="form-select">

                                        <option value="">Size</option>

                                        <option value="XS">XS</option>

                                        <option value="S">S</option>

                                        <option value="M">M</option>

                                        <option value="L">L</option>

                                        <option value="XL">XL</option>

                                        <option value="XXL">XXL</option>

                                        <option value="3XL">3XL</option>

                                        <option value="Free Size">Free Size</option>

                                    </select>

                                </td>

                                <td>

                                    <input type="text"
                                           name="variants[0][color]"
                                           class="form-control"
                                           placeholder="Black">

                                </td>

                                <td>

                                    <input type="text"
                                           name="variants[0][sku]"
                                           class="form-control"
                                           placeholder="TW-001-M-BLK">

                                </td>

                                <td>

                                    <input type="number"
                                           name="variants[0][price]"
                                           class="form-control"
                                           min="0"
                                           step="0.01"
                                           placeholder="1499">

                                </td>

                                <td>

                                    <input type="number"
                                           name="variants[0][stock]"
                                           class="form-control"
                                           min="0"
                                           placeholder="20">

                                </td>

                                <td>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-danger removeVariantBtn">

                                        <i class="fa fa-trash"></i>

                                    </button>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

                <small class="text-muted">

                    Example: Black / M / TW-001-M-BLK / ₹1499 / 20 pieces

                </small>

            </div>

        </div>



        {{-- PRODUCT IMAGES --}}
        <div class="card">

            <div class="card-header">

                <h6 class="section-title">
                    <i class="fa fa-images me-2 text-primary"></i>
                    Product Images
                </h6>

                <p class="section-subtitle">
                    Upload the main product image and additional gallery images.
                </p>

            </div>

            <div class="card-body">

                <div class="row g-4">

                    {{-- COVER IMAGE --}}
                    <div class="col-md-6">

                        <label>
                            Main Product Image
                            <span class="required">*</span>
                        </label>

                        <label for="cover_image"
                               class="image-upload-box w-100">

                            <i class="fa fa-cloud-arrow-up d-block"></i>

                            <strong>Upload Main Image</strong>

                            <p class="text-muted small mb-0 mt-2">

                                JPG, PNG or WEBP

                            </p>

                            <p class="text-muted small mb-0">

                                Recommended ratio: 1:1

                            </p>

                        </label>

                        <input type="file"
                               name="cover_image"
                               id="cover_image"
                               class="form-control d-none"
                               accept="image/jpeg,image/png,image/webp"
                               required>

                        <div id="coverPreview"
                             class="image-preview"></div>

                    </div>


                    {{-- GALLERY --}}
                    <div class="col-md-6">

                        <label>
                            Product Gallery
                        </label>

                        <label for="gallery_images"
                               class="image-upload-box w-100">

                            <i class="fa fa-images d-block"></i>

                            <strong>Upload Gallery Images</strong>

                            <p class="text-muted small mb-0 mt-2">

                                Select multiple images

                            </p>

                        </label>

                        <input type="file"
                               name="gallery_images[]"
                               id="gallery_images"
                               class="form-control d-none"
                               accept="image/jpeg,image/png,image/webp"
                               multiple>

                        <div id="galleryPreview"
                             class="image-preview"></div>

                    </div>

                </div>

            </div>

        </div>



        {{-- PRODUCT STATUS --}}
        <div class="card">

            <div class="card-header">

                <h6 class="section-title">
                    <i class="fa fa-toggle-on me-2 text-primary"></i>
                    Product Status & Visibility
                </h6>

                <p class="section-subtitle">
                    Control how your product appears on the website.
                </p>

            </div>

            <div class="card-body">

                <div class="row g-3">

                    {{-- PRODUCT STATUS --}}
                    <div class="col-md-4">

                        <div class="status-box">

                            <h6 class="fw-bold mb-3">
                                Product Status
                            </h6>

                            <div class="form-check form-switch">

                                <input class="form-check-input"
                                       type="checkbox"
                                       name="status"
                                       id="status"
                                       value="1"
                                       checked>

                                <label class="form-check-label"
                                       for="status">

                                    Active Product

                                </label>

                            </div>

                            <small class="text-muted">

                                Enable to make the product active.

                            </small>

                        </div>

                    </div>


                    {{-- ECOMMERCE --}}
                    <div class="col-md-4">

                        <div class="status-box">

                            <h6 class="fw-bold mb-3">
                                E-commerce Visibility
                            </h6>

                            <div class="form-check form-switch">

                                <input class="form-check-input"
                                       type="checkbox"
                                       name="ecommerce_status"
                                       id="ecommerce_status"
                                       value="1"
                                       checked>

                                <label class="form-check-label"
                                       for="ecommerce_status">

                                    Show on Website

                                </label>

                            </div>

                            <small class="text-muted">

                                Enable to display this product on the storefront.

                            </small>

                        </div>

                    </div>


                    {{-- FEATURED --}}
                    <div class="col-md-4">

                        <div class="status-box">

                            <h6 class="fw-bold mb-3">
                                Product Highlights
                            </h6>

                            <div class="form-check form-switch">

                                <input class="form-check-input"
                                       type="checkbox"
                                       name="featured_status"
                                       id="featured_status"
                                       value="1">

                                <label class="form-check-label"
                                       for="featured_status">

                                    Featured Product

                                </label>

                            </div>


                            <div class="form-check form-switch">

                                <input class="form-check-input"
                                       type="checkbox"
                                       name="new_arrival_status"
                                       id="new_arrival_status"
                                       value="1">

                                <label class="form-check-label"
                                       for="new_arrival_status">

                                    New Arrival

                                </label>

                            </div>


                            <div class="form-check form-switch">

                                <input class="form-check-input"
                                       type="checkbox"
                                       name="best_selling_status"
                                       id="best_selling_status"
                                       value="1">

                                <label class="form-check-label"
                                       for="best_selling_status">

                                    Best Seller

                                </label>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- SEO --}}
        <div class="card">

            <div class="card-header">

                <h6 class="section-title">
                    <i class="fa fa-search me-2 text-primary"></i>
                    SEO Information
                </h6>

                <p class="section-subtitle">
                    Improve product visibility on search engines.
                </p>

            </div>

            <div class="card-body">

                <div class="row g-3">

                    {{-- SEO TITLE --}}
                    <div class="col-md-12">

                        <label>
                            Meta Title
                        </label>

                        <input type="text"
                               name="meta_title"
                               class="form-control"
                               placeholder="Classic Cotton Shirt | TrendWear">

                    </div>


                    {{-- SEO DESCRIPTION --}}
                    <div class="col-md-12">

                        <label>
                            Meta Description
                        </label>

                        <textarea name="meta_description"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Write a short SEO description for this product"></textarea>

                    </div>


                    {{-- SEO KEYWORDS --}}
                    <div class="col-md-12">

                        <label>
                            Meta Keywords
                        </label>

                        <input type="text"
                               name="meta_keywords"
                               class="form-control"
                               placeholder="cotton shirt, men shirt, trendwear">

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>



{{-- JAVASCRIPT --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | PRODUCT VARIANTS
    |--------------------------------------------------------------------------
    */

    let variantIndex = 1;

    const variantTableBody = document.getElementById('variantTableBody');

    const addVariantBtn = document.getElementById('addVariantBtn');


    addVariantBtn.addEventListener('click', function () {

        const row = document.createElement('tr');

        row.innerHTML = `
            <td>
                <select name="variants[${variantIndex}][size]"
                        class="form-select">

                    <option value="">Size</option>
                    <option value="XS">XS</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                    <option value="3XL">3XL</option>
                    <option value="Free Size">Free Size</option>

                </select>
            </td>

            <td>
                <input type="text"
                       name="variants[${variantIndex}][color]"
                       class="form-control"
                       placeholder="Black">
            </td>

            <td>
                <input type="text"
                       name="variants[${variantIndex}][sku]"
                       class="form-control"
                       placeholder="TW-001-M-BLK">
            </td>

            <td>
                <input type="number"
                       name="variants[${variantIndex}][price]"
                       class="form-control"
                       min="0"
                       step="0.01"
                       placeholder="1499">
            </td>

            <td>
                <input type="number"
                       name="variants[${variantIndex}][stock]"
                       class="form-control"
                       min="0"
                       placeholder="20">
            </td>

            <td>
                <button type="button"
                        class="btn btn-sm btn-outline-danger removeVariantBtn">

                    <i class="fa fa-trash"></i>

                </button>
            </td>
        `;

        variantTableBody.appendChild(row);

        variantIndex++;

    });


    /*
    |--------------------------------------------------------------------------
    | REMOVE VARIANT
    |--------------------------------------------------------------------------
    */

    variantTableBody.addEventListener('click', function (event) {

        const removeButton = event.target.closest('.removeVariantBtn');

        if (removeButton) {

            const row = removeButton.closest('tr');

            row.remove();

        }

    });



    /*
    |--------------------------------------------------------------------------
    | COVER IMAGE PREVIEW
    |--------------------------------------------------------------------------
    */

    const coverImageInput = document.getElementById('cover_image');

    const coverPreview = document.getElementById('coverPreview');


    coverImageInput.addEventListener('change', function () {

        coverPreview.innerHTML = '';

        const file = this.files[0];

        if (file) {

            const image = document.createElement('img');

            image.src = URL.createObjectURL(file);

            image.onload = function () {

                URL.revokeObjectURL(image.src);

            };

            coverPreview.appendChild(image);

        }

    });



    /*
    |--------------------------------------------------------------------------
    | GALLERY IMAGE PREVIEW
    |--------------------------------------------------------------------------
    */

    const galleryInput = document.getElementById('gallery_images');

    const galleryPreview = document.getElementById('galleryPreview');


    galleryInput.addEventListener('change', function () {

        galleryPreview.innerHTML = '';

        Array.from(this.files).forEach(function (file) {

            const image = document.createElement('img');

            image.src = URL.createObjectURL(file);

            image.onload = function () {

                URL.revokeObjectURL(image.src);

            };

            galleryPreview.appendChild(image);

        });

    });



    /*
    |--------------------------------------------------------------------------
    | OFFER FIELDS
    |--------------------------------------------------------------------------
    */

    const offerStatus = document.getElementById('offer_status');

    const offerFields = document.querySelectorAll('.offer-fields');


    function toggleOfferFields() {

        offerFields.forEach(function (field) {

            field.style.display = offerStatus.checked ? 'block' : 'none';

        });

    }


    offerStatus.addEventListener('change', toggleOfferFields);

    toggleOfferFields();



    /*
    |--------------------------------------------------------------------------
    | PRODUCT TYPE
    |--------------------------------------------------------------------------
    */

    const productType = document.getElementById('product_type');

    const variantSection = document.getElementById('variantTableBody')
        .closest('.card');


    function toggleVariants() {

        if (productType.value === 'variable') {

            variantSection.style.display = 'block';

        } else {

            variantSection.style.display = 'none';

        }

    }


    productType.addEventListener('change', toggleVariants);

    toggleVariants();



    /*
    |--------------------------------------------------------------------------
    | OFFER PRICE VALIDATION
    |--------------------------------------------------------------------------
    */

    const sellingPrice = document.getElementById('selling_price');

    const offerPrice = document.getElementById('offer_price');


    offerPrice.addEventListener('input', function () {

        const selling = parseFloat(sellingPrice.value);

        const offer = parseFloat(offerPrice.value);


        if (!isNaN(selling) && !isNaN(offer) && offer > selling) {

            offerPrice.setCustomValidity(
                'Offer price must be less than or equal to selling price.'
            );

        } else {

            offerPrice.setCustomValidity('');

        }

    });


    sellingPrice.addEventListener('input', function () {

        offerPrice.dispatchEvent(new Event('input'));

    });



    /*
    |--------------------------------------------------------------------------
    | FORM VALIDATION
    |--------------------------------------------------------------------------
    */

    const form = document.getElementById('productCreateForm');


    form.addEventListener('submit', function (event) {

        if (!form.checkValidity()) {

            event.preventDefault();

            form.reportValidity();

            return false;

        }

        const selling = parseFloat(sellingPrice.value);

        const offer = parseFloat(offerPrice.value);


        if (offerPrice.value !== '' && offer > selling) {

            event.preventDefault();

            alert('Offer price cannot be greater than selling price.');

            offerPrice.focus();

            return false;

        }

    });

});

</script>

@endsection