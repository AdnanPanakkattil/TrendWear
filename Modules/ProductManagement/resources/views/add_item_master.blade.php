@extends('backend.layouts.backendLayout')

@section('content')

<style>
    /* ==========================================================================
       TrendWear Add Item Master - Ultra Premium Executive UI
       ========================================================================== */
    .item-master-page {
        --tw-primary: #ff5722;
        --tw-primary-hover: #e64a19;
        --tw-primary-subtle: rgba(255, 87, 34, 0.08);
        --tw-primary-border: rgba(255, 87, 34, 0.25);
        --tw-card-border: #e9ecef;
        --tw-card-bg: #ffffff;
        --tw-text-title: #1e293b;
        --tw-text-body: #475569;
        --tw-text-muted: #94a3b8;
        --card-radius: 14px;
        font-family: inherit;
        color: var(--tw-text-body);
    }

    /* Page Header */
    .item-master-page .page-header {
        margin-bottom: 1.75rem;
    }

    .item-master-page .page-header h4 {
        font-weight: 700;
        letter-spacing: -0.025em;
        color: var(--tw-text-title);
    }

    /* Premium Modern Card */
    .item-master-page .card {
        border-radius: var(--card-radius);
        border: 1px solid var(--tw-card-border);
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.04), 0 1px 2px -1px rgba(0, 0, 0, 0.03);
        margin-bottom: 1.5rem;
        background: var(--tw-card-bg);
        transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
    }

    .item-master-page .card:hover {
        box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.06);
    }

    .item-master-page .card-header {
        background: #ffffff;
        padding: 1.15rem 1.4rem;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .item-master-page .card-body {
        padding: 1.4rem;
    }

    .item-master-page .card-title-wrap {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .item-master-page .card-icon-badge {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: var(--tw-primary-subtle);
        color: var(--tw-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        flex-shrink: 0;
    }

    .item-master-page .card-title {
        font-size: 0.96rem;
        font-weight: 700;
        margin: 0;
        color: var(--tw-text-title);
    }

    .item-master-page .card-subtitle {
        font-size: 0.77rem;
        color: var(--tw-text-muted);
        margin: 2px 0 0 0;
    }

    /* Form Labels & Badges */
    .item-master-page .form-label {
        font-size: 0.82rem;
        font-weight: 600;
        color: #334155;
        margin-bottom: 0.45rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .item-master-page .required-star {
        color: #ef4444;
        font-weight: 700;
        margin-left: 2px;
    }

    .item-master-page .badge-mandatory {
        font-size: 0.67rem;
        font-weight: 600;
        color: #dc2626;
        background: #fee2e2;
        padding: 2px 7px;
        border-radius: 4px;
        letter-spacing: 0.02em;
    }

    .item-master-page .badge-recommended {
        font-size: 0.67rem;
        font-weight: 600;
        color: #0284c7;
        background: #e0f2fe;
        padding: 2px 7px;
        border-radius: 4px;
    }

    .item-master-page .badge-optional {
        font-size: 0.67rem;
        font-weight: 500;
        color: #64748b;
        background: #f1f5f9;
        padding: 2px 7px;
        border-radius: 4px;
    }

    /* Modern Form Inputs */
    .item-master-page .form-control,
    .item-master-page .form-select {
        border-radius: 9px;
        border: 1px solid #cbd5e1;
        padding: 0.62rem 0.9rem;
        font-size: 0.875rem;
        color: #1e293b;
        background-color: #ffffff;
        transition: all 0.15s ease-in-out;
    }

    .item-master-page .form-control:focus,
    .item-master-page .form-select:focus {
        border-color: var(--tw-primary);
        box-shadow: 0 0 0 3px var(--tw-primary-subtle);
        outline: none;
    }

    .item-master-page .input-group-text {
        border-radius: 9px;
        background-color: #f8fafc;
        border: 1px solid #cbd5e1;
        color: #64748b;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .item-master-page .form-hint {
        font-size: 0.74rem;
        color: var(--tw-text-muted);
        margin-top: 0.35rem;
        display: block;
    }

    /* Pricing & Stock Grid Cards */
    .item-master-page .metric-input-card {
        background: #fafbfc;
        border: 1px solid #e2e8f0;
        border-radius: 11px;
        padding: 0.9rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.2s ease;
    }

    .item-master-page .metric-input-card:focus-within {
        background: #ffffff;
        border-color: var(--tw-primary);
        box-shadow: 0 2px 10px rgba(255, 87, 34, 0.08);
    }

    .item-master-page .metric-input-card.highlight {
        background: #fff8f5;
        border-color: #ffccbc;
    }

    /* Financial Analytics Strip */
    .item-master-page .profit-analytics-strip {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
        gap: 1rem;
        align-items: center;
    }

    .item-master-page .profit-item-title {
        font-size: 0.7rem;
        text-transform: uppercase;
        font-weight: 700;
        color: #64748b;
        letter-spacing: 0.05em;
        margin-bottom: 2px;
    }

    .item-master-page .profit-item-value {
        font-size: 1.15rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.2;
    }

    /* Size Selector Pills */
    .item-master-page .size-selector-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 0.6rem;
    }

    .item-master-page .size-pill-label {
        position: relative;
        cursor: pointer;
        user-select: none;
        margin: 0;
    }

    .item-master-page .size-pill-label input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .item-master-page .size-pill-box {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        min-width: 48px;
        height: 40px;
        padding: 0 14px;
        border: 1.5px solid #e2e8f0;
        border-radius: 9px;
        background: #ffffff;
        font-size: 0.85rem;
        font-weight: 600;
        color: #334155;
        transition: all 0.2s ease;
    }

    .item-master-page .size-pill-box:hover {
        border-color: #cbd5e1;
        background: #f8fafc;
        transform: translateY(-1px);
    }

    .item-master-page .size-pill-label input:checked + .size-pill-box {
        background: var(--tw-primary);
        border-color: var(--tw-primary);
        color: #ffffff;
        box-shadow: 0 3px 10px rgba(255, 87, 34, 0.35);
        transform: translateY(-1px);
    }

    /* Color Swatch Badges */
    .item-master-page .color-swatch-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 0.65rem;
    }

    .item-master-page .color-swatch-label {
        position: relative;
        cursor: pointer;
        user-select: none;
        margin: 0;
    }

    .item-master-page .color-swatch-label input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .item-master-page .color-swatch-box {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        border: 1.5px solid #e2e8f0;
        border-radius: 30px;
        background: #ffffff;
        font-size: 0.82rem;
        font-weight: 500;
        color: #334155;
        transition: all 0.2s ease;
    }

    .item-master-page .color-swatch-box:hover {
        border-color: #cbd5e1;
        background: #f8fafc;
    }

    .item-master-page .color-circle {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        display: inline-block;
        border: 1px solid rgba(0, 0, 0, 0.15);
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    }

    .item-master-page .color-swatch-label input:checked + .color-swatch-box {
        background: #fff7ed;
        border-color: var(--tw-primary);
        color: var(--tw-primary);
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(255, 87, 34, 0.2);
    }

    /* Media Upload Dropzone */
    .item-master-page .dropzone-container {
        border: 2px dashed #cbd5e1;
        background: #f8fafc;
        border-radius: 12px;
        padding: 1.6rem 1.2rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
    }

    .item-master-page .dropzone-container:hover {
        border-color: var(--tw-primary);
        background: #fff8f5;
        transform: translateY(-1px);
    }

    .item-master-page .dropzone-icon-circle {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: #ffffff;
        color: var(--tw-primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
        margin-bottom: 0.6rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease;
    }

    .item-master-page .dropzone-container:hover .dropzone-icon-circle {
        transform: scale(1.08);
        background: #ffede6;
    }

    .item-master-page .dropzone-title {
        font-size: 0.88rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.2rem;
    }

    .item-master-page .dropzone-desc {
        font-size: 0.74rem;
        color: var(--tw-text-muted);
        margin-bottom: 0;
    }

    .item-master-page .image-preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
        gap: 0.75rem;
        margin-top: 1rem;
    }

    .item-master-page .image-preview-card {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        aspect-ratio: 1;
    }

    .item-master-page .image-preview-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .item-master-page .image-preview-badge {
        position: absolute;
        top: 5px;
        left: 5px;
        background: rgba(15, 23, 42, 0.75);
        color: #ffffff;
        font-size: 0.64rem;
        padding: 2px 6px;
        border-radius: 4px;
        font-weight: 600;
        backdrop-filter: blur(4px);
    }

    /* Switch Pill Cards (Sidebar) */
    .item-master-page .switch-pill-card {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 11px;
        padding: 0.85rem 1rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 0.85rem;
        transition: all 0.2s ease;
    }

    .item-master-page .switch-pill-card:hover {
        background-color: #ffffff;
        border-color: #cbd5e1;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .item-master-page .switch-label-group h6 {
        margin: 0;
        font-size: 0.86rem;
        font-weight: 600;
        color: #1e293b;
    }

    .item-master-page .switch-label-group p {
        margin: 2px 0 0 0;
        font-size: 0.73rem;
        color: #64748b;
    }

    .item-master-page .form-check-input {
        width: 2.6rem;
        height: 1.35rem;
        cursor: pointer;
    }

    .item-master-page .form-check-input:checked {
        background-color: var(--tw-primary);
        border-color: var(--tw-primary);
    }

    /* Live Storefront Preview Card (In Sidebar) */
    .item-master-page .storefront-preview-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
    }

    .item-master-page .storefront-preview-img-wrap {
        width: 100%;
        height: 180px;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .item-master-page .storefront-preview-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-master-page .storefront-preview-badges {
        position: absolute;
        top: 8px;
        left: 8px;
        display: flex;
        flex-direction: column;
        gap: 4px;
        z-index: 2;
    }

    .item-master-page .storefront-preview-body {
        padding: 1rem;
    }

    /* Sticky Bottom Action Bar */
    .item-master-page .sticky-action-bar {
        position: sticky;
        bottom: 14px;
        background: rgba(255, 255, 255, 0.94);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(0, 0, 0, 0.08);
        border-radius: 14px;
        padding: 0.9rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.09);
        z-index: 100;
        margin-top: 1.75rem;
    }

    .item-master-page .btn-primary {
        background-color: var(--tw-primary);
        border-color: var(--tw-primary);
        font-weight: 600;
        border-radius: 9px;
        padding: 0.6rem 1.4rem;
        box-shadow: 0 2px 8px rgba(255, 87, 34, 0.25);
        transition: all 0.2s ease;
    }

    .item-master-page .btn-primary:hover {
        background-color: var(--tw-primary-hover);
        border-color: var(--tw-primary-hover);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(255, 87, 34, 0.35);
    }

    .item-master-page .btn-outline-secondary {
        border-radius: 9px;
        font-weight: 600;
        padding: 0.6rem 1.25rem;
        border-color: #cbd5e1;
        color: #475569;
    }

    .item-master-page .btn-outline-secondary:hover {
        background-color: #f1f5f9;
        border-color: #94a3b8;
        color: #1e293b;
    }

    @media (max-width: 991.98px) {
        .item-master-page .sticky-action-bar {
            bottom: 0;
            border-radius: 0;
            margin-left: -12px;
            margin-right: -12px;
            padding: 0.75rem 1rem;
        }
    }
</style>

<div class="item-master-page container-fluid px-0">

    {{-- TOP PAGE HEADER --}}
    <div class="page-header d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div>
            <div class="d-flex align-items-center gap-2 mb-1">
                <a href="{{ route('productmanagement.item_master') }}" class="btn btn-sm btn-icon btn-outline-secondary rounded-circle" title="Back to Item Master" style="width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="fa fa-arrow-left"></i>
                </a>
                <h4 class="mb-0">Add Item Master</h4>
                <span class="badge bg-label-primary ms-1" style="font-size: 0.72rem; padding: 4px 8px;">Product Master</span>
            </div>
            <p class="text-muted small mb-0 ms-1">
                Configure essential product details, pricing, apparel attributes, and visual assets.
            </p>
        </div>

        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('productmanagement.item_master') }}" class="btn btn-outline-secondary btn-sm px-3">
                <i class="fa fa-xmark me-1"></i> Discard
            </a>
            <button type="button" class="btn btn-primary btn-sm px-4" onclick="document.getElementById('productCreateForm').requestSubmit()">
                <i class="fa fa-check me-1"></i> Save Product
            </button>
        </div>
    </div>


    {{-- MAIN FORM START --}}
    <form id="productCreateForm" action="" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">

            {{-- =========================================================================
                 LEFT COLUMN: PRIMARY PRODUCT INFORMATION (8 COLS)
                 ========================================================================= --}}
            <div class="col-lg-8">

                {{-- 1. BASIC INFORMATION (Product Name, SKU, Description) --}}
                <div class="card">
                    <div class="card-header">
                        <div class="card-title-wrap">
                            <div class="card-icon-badge">
                                <i class="fa fa-tag"></i>
                            </div>
                            <div>
                                <h6 class="card-title">Basic Information</h6>
                                <p class="card-subtitle">Official product title, unique SKU identifier, and description</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row g-3">

                            {{-- Field 1: Product Name (Required) --}}
                            <div class="col-md-8">
                                <label class="form-label" for="name">
                                    <span>Product Name <span class="required-star">*</span></span>
                                    <span class="badge-mandatory">Mandatory</span>
                                </label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       class="form-control"
                                       placeholder="e.g. Classic Slim Fit Oxford Cotton Shirt"
                                       required>
                                <span class="form-hint">Displayed prominently as the primary headline in the catalog.</span>
                            </div>

                            {{-- Field 2: SKU / Product Code (Required) --}}
                            <div class="col-md-4">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label m-0" for="sku">
                                        <span>SKU / Product Code <span class="required-star">*</span></span>
                                    </label>
                                    <button type="button" id="generateSkuBtn" class="btn btn-link p-0 text-primary text-decoration-none" style="font-size: 0.72rem; font-weight: 600;">
                                        <i class="fa fa-wand-magic-sparkles me-1"></i> Auto
                                    </button>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-barcode"></i></span>
                                    <input type="text"
                                           id="sku"
                                           name="sku"
                                           class="form-control text-uppercase"
                                           placeholder="TW-SHIRT-001"
                                           required>
                                </div>
                                <span class="form-hint">Unique Stock Keeping Unit.</span>
                            </div>

                            {{-- Field 6: Description (Recommended) --}}
                            <div class="col-12">
                                <label class="form-label" for="description">
                                    <span>Description</span>
                                    <span class="badge-recommended">Recommended</span>
                                </label>
                                <textarea name="description"
                                          id="description"
                                          class="form-control"
                                          rows="4"
                                          placeholder="Provide rich details about craftsmanship, styling recommendations, fabric weave, and care..."></textarea>
                                <span class="form-hint">Detailed product narrative visible on product detail pages.</span>
                            </div>

                        </div>
                    </div>
                </div>


                {{-- 2. PRICING & INVENTORY (Symmetrical 4-Card Metric Grid) --}}
                <div class="card">
                    <div class="card-header">
                        <div class="card-title-wrap">
                            <div class="card-icon-badge">
                                <i class="fa fa-coins"></i>
                            </div>
                            <div>
                                <h6 class="card-title">Pricing & Stock Inventory</h6>
                                <p class="card-subtitle">Retail pricing, customer offer rates, cost calculation, and warehouse count</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row g-3">

                            {{-- Field 8: Selling Price (Required) --}}
                            <div class="col-md-3 col-sm-6">
                                <div class="metric-input-card highlight">
                                    <label class="form-label" for="selling_price">
                                        <span>Selling Price <span class="required-star">*</span></span>
                                        <span class="badge-mandatory">Required</span>
                                    </label>
                                    <div class="input-group mt-1">
                                        <span class="input-group-text fw-bold text-dark">₹</span>
                                        <input type="number"
                                               name="selling_price"
                                               id="selling_price"
                                               class="form-control fw-bold"
                                               min="0"
                                               step="0.01"
                                               placeholder="1499.00"
                                               required>
                                    </div>
                                    <span class="form-hint">Standard retail selling price.</span>
                                </div>
                            </div>

                            {{-- Field 9: Offer Price (Optional) --}}
                            <div class="col-md-3 col-sm-6">
                                <div class="metric-input-card">
                                    <label class="form-label" for="offer_price">
                                        <span>Offer Price</span>
                                        <span class="badge-optional">Optional</span>
                                    </label>
                                    <div class="input-group mt-1">
                                        <span class="input-group-text text-danger fw-bold">₹</span>
                                        <input type="number"
                                               name="offer_price"
                                               id="offer_price"
                                               class="form-control text-danger fw-bold"
                                               min="0"
                                               step="0.01"
                                               placeholder="999.00">
                                    </div>
                                    <span class="form-hint">Discounted checkout price.</span>
                                </div>
                            </div>

                            {{-- Field 10: Cost Price (Optional - Admin Profit) --}}
                            <div class="col-md-3 col-sm-6">
                                <div class="metric-input-card">
                                    <label class="form-label" for="cost_price">
                                        <span>Cost Price</span>
                                        <span class="badge-optional">Admin Only</span>
                                    </label>
                                    <div class="input-group mt-1">
                                        <span class="input-group-text">₹</span>
                                        <input type="number"
                                               name="cost_price"
                                               id="cost_price"
                                               class="form-control"
                                               min="0"
                                               step="0.01"
                                               placeholder="600.00">
                                    </div>
                                    <span class="form-hint">For profit margin calculation.</span>
                                </div>
                            </div>

                            {{-- Field 11: Stock Quantity (Inventory) --}}
                            <div class="col-md-3 col-sm-6">
                                <div class="metric-input-card">
                                    <label class="form-label" for="stock_quantity">
                                        <span>Stock Quantity</span>
                                        <span class="badge-optional">Inventory</span>
                                    </label>
                                    <div class="input-group mt-1">
                                        <span class="input-group-text"><i class="fa fa-boxes-stacked"></i></span>
                                        <input type="number"
                                               name="stock_quantity"
                                               id="stock_quantity"
                                               class="form-control fw-bold"
                                               min="0"
                                               placeholder="100">
                                    </div>
                                    <span class="form-hint">Units currently in stock.</span>
                                </div>
                            </div>

                            {{-- Financial Analytics & Discount Strip --}}
                            <div class="col-12 mt-3">
                                <div class="profit-analytics-strip">
                                    <div>
                                        <div class="profit-item-title">Estimated Gross Profit</div>
                                        <div id="calculatedProfit" class="profit-item-value text-muted">₹0.00</div>
                                    </div>
                                    <div>
                                        <div class="profit-item-title">Profit Margin</div>
                                        <div id="calculatedMargin" class="profit-item-value text-muted">0%</div>
                                    </div>
                                    <div>
                                        <div class="profit-item-title">Customer Savings</div>
                                        <div id="calculatedDiscount" class="profit-item-value text-muted">No Offer</div>
                                    </div>
                                    <div>
                                        <div class="profit-item-title">Stock Valuation</div>
                                        <div id="calculatedStockValue" class="profit-item-value text-muted">₹0.00</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                {{-- 3. CLOTHING SPECIFICATIONS (Size, Color, Material / Fabric) --}}
                <div class="card">
                    <div class="card-header">
                        <div class="card-title-wrap">
                            <div class="card-icon-badge">
                                <i class="fa fa-shirt"></i>
                            </div>
                            <div>
                                <h6 class="card-title">Clothing Specifications</h6>
                                <p class="card-subtitle">Select available apparel sizes, color swatches, and fabric composition</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row g-4">

                            {{-- Field 12: Size (Apparel Required) --}}
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <label class="form-label m-0">
                                        <span>Available Sizes <span class="text-primary fw-normal">(Clothing Required)</span></span>
                                    </label>
                                    <span class="badge-recommended">Apparel Required</span>
                                </div>

                                <div class="size-selector-grid">
                                    @php
                                        $standardSizes = ['XS', 'S', 'M', 'L', 'XL', '2XL', '3XL', 'Free Size'];
                                    @endphp
                                    @foreach($standardSizes as $size)
                                        <label class="size-pill-label">
                                            <input type="checkbox" name="sizes[]" value="{{ $size }}" {{ in_array($size, ['M', 'L']) ? 'checked' : '' }}>
                                            <span class="size-pill-box">
                                                <i class="fa fa-check d-none" style="font-size: 0.7rem;"></i>
                                                {{ $size }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>

                                <div class="input-group input-group-sm mt-2" style="max-width: 480px;">
                                    <span class="input-group-text"><i class="fa fa-plus me-1"></i> Custom</span>
                                    <input type="text"
                                           name="custom_sizes"
                                           id="custom_sizes"
                                           class="form-control"
                                           placeholder="Additional sizes (e.g. 28, 30, 32, 34, 36)">
                                </div>
                                <span class="form-hint">Click on size pills to toggle availability on product pages.</span>
                            </div>

                            {{-- Field 13: Color (Apparel Required) --}}
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <label class="form-label m-0">
                                        <span>Available Colors <span class="text-primary fw-normal">(Clothing Required)</span></span>
                                    </label>
                                    <span class="badge-recommended">Apparel Required</span>
                                </div>

                                <div class="color-swatch-grid">
                                    @php
                                        $standardColors = [
                                            ['name' => 'Black', 'hex' => '#111827'],
                                            ['name' => 'White', 'hex' => '#ffffff'],
                                            ['name' => 'Navy', 'hex' => '#1e3a8a'],
                                            ['name' => 'Royal Blue', 'hex' => '#2563eb'],
                                            ['name' => 'Red', 'hex' => '#dc2626'],
                                            ['name' => 'Grey', 'hex' => '#6b7280'],
                                            ['name' => 'Olive', 'hex' => '#556b2f'],
                                            ['name' => 'Beige', 'hex' => '#f5f5dc'],
                                            ['name' => 'Maroon', 'hex' => '#800000'],
                                            ['name' => 'Yellow', 'hex' => '#eab308'],
                                        ];
                                    @endphp
                                    @foreach($standardColors as $c)
                                        <label class="color-swatch-label">
                                            <input type="checkbox" name="colors[]" value="{{ $c['name'] }}" {{ in_array($c['name'], ['Black', 'Navy']) ? 'checked' : '' }}>
                                            <span class="color-swatch-box">
                                                <span class="color-circle" style="background-color: {{ $c['hex'] }};"></span>
                                                {{ $c['name'] }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>

                                <div class="input-group input-group-sm mt-2" style="max-width: 480px;">
                                    <span class="input-group-text"><i class="fa fa-palette me-1"></i> Custom</span>
                                    <input type="text"
                                           name="custom_colors"
                                           id="custom_colors"
                                           class="form-control"
                                           placeholder="Additional colors (e.g. Lavender, Sage Green, Coral)">
                                </div>
                                <span class="form-hint">Click on color swatches to enable color variations for this clothing item.</span>
                            </div>

                            {{-- Field 14: Material / Fabric (Optional) --}}
                            <div class="col-md-6">
                                <label class="form-label" for="material">
                                    <span>Material / Fabric</span>
                                    <span class="badge-optional">Optional</span>
                                </label>
                                <select name="material" id="material" class="form-select">
                                    <option value="">Select Material / Fabric</option>
                                    <option value="100% Pure Cotton" selected>100% Pure Cotton</option>
                                    <option value="Denim">Denim</option>
                                    <option value="Pure Linen">Pure Linen</option>
                                    <option value="Polyester">Polyester</option>
                                    <option value="Silk">Silk</option>
                                    <option value="Wool">Wool</option>
                                    <option value="Cotton-Poly Blend">Cotton-Poly Blend</option>
                                    <option value="Rayon">Rayon</option>
                                    <option value="Spandex / Stretch">Spandex / Stretch</option>
                                    <option value="Other">Other</option>
                                </select>
                                <span class="form-hint">Dominant garment fabric composition.</span>
                            </div>

                        </div>
                    </div>
                </div>


                {{-- 4. PRODUCT IMAGES (Required) --}}
                <div class="card">
                    <div class="card-header">
                        <div class="card-title-wrap">
                            <div class="card-icon-badge">
                                <i class="fa fa-images"></i>
                            </div>
                            <div>
                                <h6 class="card-title">Product Images</h6>
                                <p class="card-subtitle">Main showcase image and multi-angle frontend gallery</p>
                            </div>
                        </div>
                        <span class="badge bg-label-primary" style="font-size: 0.7rem;">Required</span>
                    </div>

                    <div class="card-body">
                        <div class="row g-4">

                            {{-- Field 7a: Main Product Image (Required) --}}
                            <div class="col-md-6">
                                <label class="form-label" for="cover_image">
                                    <span>Main Product Image <span class="required-star">*</span></span>
                                    <span class="badge-mandatory">Primary Photo</span>
                                </label>

                                <label for="cover_image" class="dropzone-container d-block" id="coverDropzone">
                                    <div class="dropzone-icon-circle">
                                        <i class="fa fa-cloud-arrow-up"></i>
                                    </div>
                                    <div class="dropzone-title">Upload Main Image</div>
                                    <p class="dropzone-desc">JPG, PNG, WEBP (Square 1:1 Recommended)</p>
                                </label>

                                <input type="file"
                                       name="cover_image"
                                       id="cover_image"
                                       class="d-none"
                                       accept="image/*"
                                       required>

                                <div id="coverPreview" class="image-preview-grid"></div>
                            </div>

                            {{-- Field 7b: Additional Images (Optional / Gallery) --}}
                            <div class="col-md-6">
                                <label class="form-label" for="gallery_images">
                                    <span>Additional Images</span>
                                    <span class="badge-optional">Gallery Photos</span>
                                </label>

                                <label for="gallery_images" class="dropzone-container d-block" id="galleryDropzone">
                                    <div class="dropzone-icon-circle">
                                        <i class="fa fa-photo-film"></i>
                                    </div>
                                    <div class="dropzone-title">Upload Gallery Photos</div>
                                    <p class="dropzone-desc">Back view, fabric zoom, and model styling shots</p>
                                </label>

                                <input type="file"
                                       name="gallery_images[]"
                                       id="gallery_images"
                                       class="d-none"
                                       accept="image/*"
                                       multiple>

                                <div id="galleryPreview" class="image-preview-grid"></div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>


            {{-- =========================================================================
                 RIGHT COLUMN: SIDEBAR (STATUS, TAXONOMY & LIVE PREVIEW) (4 COLS)
                 ========================================================================= --}}
            <div class="col-lg-4">

                {{-- CARD 1: STATUS & VISIBILITY FLAGS --}}
                <div class="card">
                    <div class="card-header">
                        <div class="card-title-wrap">
                            <div class="card-icon-badge">
                                <i class="fa fa-toggle-on"></i>
                            </div>
                            <div>
                                <h6 class="card-title">Status & Visibility</h6>
                                <p class="card-subtitle">Storefront publication and tags</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        {{-- Field 15: Status (Required - Active / Inactive) --}}
                        <div class="switch-pill-card">
                            <div class="switch-label-group">
                                <h6>Product Status <span class="required-star">*</span></h6>
                                <p id="statusLabelText" class="text-success fw-semibold">Active (Visible in Store)</p>
                            </div>
                            <div class="form-check form-switch m-0">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="status"
                                       id="status"
                                       value="1"
                                       checked>
                            </div>
                        </div>

                        {{-- Field 16: Featured Product (Optional) --}}
                        <div class="switch-pill-card">
                            <div class="switch-label-group">
                                <h6><i class="fa fa-star text-warning me-1"></i> Featured Product</h6>
                                <p>Pin to homepage featured shelf</p>
                            </div>
                            <div class="form-check form-switch m-0">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="is_featured"
                                       id="is_featured"
                                       value="1">
                            </div>
                        </div>

                        {{-- Field 17: New Arrival (Optional) --}}
                        <div class="switch-pill-card">
                            <div class="switch-label-group">
                                <h6><i class="fa fa-sparkles text-info me-1"></i> New Arrival Tag</h6>
                                <p>Display highlighted NEW badge</p>
                            </div>
                            <div class="form-check form-switch m-0">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="is_new_arrival"
                                       id="is_new_arrival"
                                       value="1"
                                       checked>
                            </div>
                        </div>

                        <hr class="my-3 opacity-25">

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check me-1"></i> Save Product
                            </button>
                            <a href="{{ route('productmanagement.item_master') }}" class="btn btn-outline-secondary">
                                <i class="fa fa-arrow-left me-1"></i> Discard & Return
                            </a>
                        </div>

                    </div>
                </div>


                {{-- CARD 2: CATEGORY & CLASSIFICATION (Category, Subcategory, Brand) --}}
                <div class="card">
                    <div class="card-header">
                        <div class="card-title-wrap">
                            <div class="card-icon-badge">
                                <i class="fa fa-layer-group"></i>
                            </div>
                            <div>
                                <h6 class="card-title">Classification</h6>
                                <p class="card-subtitle">Taxonomy hierarchy & brand association</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="d-flex flex-column gap-3">

                            {{-- Field 3: Category (Required) --}}
                            <div>
                                <label class="form-label" for="category_id">
                                    <span>Category <span class="required-star">*</span></span>
                                    <span class="badge-mandatory">Mandatory</span>
                                </label>
                                <select name="category_id" id="category_id" class="form-select" required>
                                    <option value="">Select Category</option>
                                    <option value="Men" selected>Men</option>
                                    <option value="Women">Women</option>
                                    <option value="Kids">Kids</option>
                                </select>
                                <span class="form-hint">E.g. Men, Women, Kids.</span>
                            </div>

                            {{-- Field 4: Subcategory (Recommended) --}}
                            <div>
                                <label class="form-label" for="subcategory_id">
                                    <span>Subcategory</span>
                                    <span class="badge-recommended">Recommended</span>
                                </label>
                                <select name="subcategory_id" id="subcategory_id" class="form-select">
                                    <option value="">Select Subcategory</option>
                                    <option value="T-Shirts" selected>T-Shirts</option>
                                    <option value="Jeans">Jeans</option>
                                    <option value="Dresses">Dresses</option>
                                    <option value="Shirts">Shirts</option>
                                    <option value="Trousers">Trousers</option>
                                    <option value="Jackets">Jackets</option>
                                    <option value="Hoodies">Hoodies</option>
                                </select>
                                <span class="form-hint">E.g. T-Shirts, Jeans, Dresses.</span>
                            </div>

                            {{-- Field 5: Brand (Optional) --}}
                            <div>
                                <label class="form-label" for="brand_id">
                                    <span>Brand</span>
                                    <span class="badge-optional">Optional</span>
                                </label>
                                <select name="brand_id" id="brand_id" class="form-select">
                                    <option value="">Select Brand</option>
                                    <option value="TrendWear" selected>TrendWear</option>
                                    <option value="Zara">Zara</option>
                                    <option value="H&M">H&M</option>
                                    <option value="Levi's">Levi's</option>
                                </select>
                                <span class="form-hint">Brand label or manufacturer.</span>
                            </div>

                        </div>
                    </div>
                </div>


                {{-- CARD 3: LIVE STOREFRONT PRODUCT CARD PREVIEW --}}
                <div class="card">
                    <div class="card-header py-3">
                        <div class="card-title-wrap">
                            <div class="card-icon-badge" style="background: rgba(2, 132, 199, 0.1); color: #0284c7;">
                                <i class="fa fa-eye"></i>
                            </div>
                            <div>
                                <h6 class="card-title" style="font-size: 0.88rem;">Storefront Live Preview</h6>
                                <p class="card-subtitle">How shoppers see this on TrendWear</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-3">
                        <div class="storefront-preview-card">
                            <div class="storefront-preview-img-wrap" id="previewImgWrap">
                                <div class="storefront-preview-badges">
                                    <span id="previewNewBadge" class="badge bg-dark text-white fw-bold" style="font-size: 0.65rem; padding: 4px 8px;">NEW</span>
                                    <span id="previewFeaturedBadge" class="badge bg-warning text-dark fw-bold d-none" style="font-size: 0.65rem; padding: 4px 8px;"><i class="fa fa-star me-1"></i>FEATURED</span>
                                </div>
                                <img id="livePreviewImg" src="" alt="Product Preview" style="display: none;">
                                <div id="previewPlaceholder" class="text-center text-muted">
                                    <i class="fa fa-image fs-1 mb-1 opacity-50"></i>
                                    <p class="small mb-0">Product Image Preview</p>
                                </div>
                            </div>
                            <div class="storefront-preview-body">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span id="previewBrand" class="text-uppercase text-muted fw-bold" style="font-size: 0.68rem; letter-spacing: 0.05em;">TrendWear</span>
                                    <span id="previewCategory" class="badge bg-label-secondary" style="font-size: 0.68rem;">Men &bull; T-Shirts</span>
                                </div>
                                <h6 id="previewTitle" class="fw-bold mb-2 text-truncate" style="font-size: 0.92rem; color: #1e293b;">Classic Slim Fit Oxford Cotton Shirt</h6>
                                <div class="d-flex align-items-baseline gap-2">
                                    <span id="previewOfferPrice" class="fw-bold text-danger" style="font-size: 1.1rem;">₹999</span>
                                    <span id="previewSellingPrice" class="text-muted text-decoration-line-through small">₹1,499</span>
                                    <span id="previewDiscountBadge" class="badge bg-label-danger" style="font-size: 0.68rem;">33% OFF</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-2 pt-2 border-top">
                                    <span id="previewStockStatus" class="small text-success fw-semibold"><i class="fa fa-circle-check me-1"></i>In Stock (100)</span>
                                    <span id="previewMaterial" class="small text-muted">Cotton</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        {{-- STICKY BOTTOM ACTION BAR --}}
        <div class="sticky-action-bar">
            <div class="d-flex align-items-center gap-2">
                <i class="fa fa-circle-check text-success fs-5 d-none d-sm-inline"></i>
                <div>
                    <strong class="d-block text-dark" style="font-size: 0.88rem;">Ready to save this item?</strong>
                    <span class="text-muted small">All 17 fields are validated and formatted for optimal catalog performance.</span>
                </div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('productmanagement.item_master') }}" class="btn btn-outline-secondary btn-sm px-3">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary btn-sm px-4">
                    <i class="fa fa-check me-1"></i> Save Product
                </button>
            </div>
        </div>

    </form>

</div>


{{-- JAVASCRIPT LOGIC --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | FORM INPUT REFERENCES
    |--------------------------------------------------------------------------
    */
    const nameInput = document.getElementById('name');
    const skuInput = document.getElementById('sku');
    const generateSkuBtn = document.getElementById('generateSkuBtn');
    const sellingPriceInput = document.getElementById('selling_price');
    const offerPriceInput = document.getElementById('offer_price');
    const costPriceInput = document.getElementById('cost_price');
    const stockQuantityInput = document.getElementById('stock_quantity');
    const categorySelect = document.getElementById('category_id');
    const subcategorySelect = document.getElementById('subcategory_id');
    const brandSelect = document.getElementById('brand_id');
    const materialSelect = document.getElementById('material');
    const statusCheckbox = document.getElementById('status');
    const statusLabelText = document.getElementById('statusLabelText');
    const featuredCheckbox = document.getElementById('is_featured');
    const newArrivalCheckbox = document.getElementById('is_new_arrival');

    // Financial Analytics Elements
    const profitEl = document.getElementById('calculatedProfit');
    const marginEl = document.getElementById('calculatedMargin');
    const discountEl = document.getElementById('calculatedDiscount');
    const stockValueEl = document.getElementById('calculatedStockValue');

    // Preview Elements
    const livePreviewImg = document.getElementById('livePreviewImg');
    const previewPlaceholder = document.getElementById('previewPlaceholder');
    const previewTitle = document.getElementById('previewTitle');
    const previewBrand = document.getElementById('previewBrand');
    const previewCategory = document.getElementById('previewCategory');
    const previewOfferPrice = document.getElementById('previewOfferPrice');
    const previewSellingPrice = document.getElementById('previewSellingPrice');
    const previewDiscountBadge = document.getElementById('previewDiscountBadge');
    const previewStockStatus = document.getElementById('previewStockStatus');
    const previewMaterial = document.getElementById('previewMaterial');
    const previewNewBadge = document.getElementById('previewNewBadge');
    const previewFeaturedBadge = document.getElementById('previewFeaturedBadge');


    /*
    |--------------------------------------------------------------------------
    | FINANCIAL CALCULATIONS & LIVE PREVIEW UPDATES
    |--------------------------------------------------------------------------
    */
    function updateCalculationsAndPreview() {
        const sell = parseFloat(sellingPriceInput.value) || 0;
        const offer = parseFloat(offerPriceInput.value) || 0;
        const cost = parseFloat(costPriceInput.value) || 0;
        const stock = parseInt(stockQuantityInput.value) || 0;

        // 1. Profit & Margin calculation (Effective price = Offer if valid, else Sell)
        const effectivePrice = (offer > 0 && offer < sell) ? offer : sell;
        if (effectivePrice > 0 && cost > 0) {
            const profit = effectivePrice - cost;
            const margin = (profit / effectivePrice) * 100;
            profitEl.textContent = '₹' + profit.toFixed(2);
            marginEl.textContent = margin.toFixed(1) + '%';

            if (profit < 0) {
                profitEl.className = 'profit-item-value text-danger';
                marginEl.className = 'profit-item-value text-danger';
            } else {
                profitEl.className = 'profit-item-value text-success';
                marginEl.className = 'profit-item-value text-success';
            }
        } else if (effectivePrice > 0) {
            profitEl.textContent = '₹' + effectivePrice.toFixed(2);
            marginEl.textContent = '100%';
            profitEl.className = 'profit-item-value text-primary';
            marginEl.className = 'profit-item-value text-primary';
        } else {
            profitEl.textContent = '₹0.00';
            marginEl.textContent = '0%';
            profitEl.className = 'profit-item-value text-muted';
            marginEl.className = 'profit-item-value text-muted';
        }

        // 2. Customer Savings / Discount calculation
        if (sell > 0 && offer > 0 && offer < sell) {
            const savings = sell - offer;
            const discountPct = Math.round((savings / sell) * 100);
            discountEl.textContent = `${discountPct}% (₹${savings.toFixed(0)} off)`;
            discountEl.className = 'profit-item-value text-danger';

            previewOfferPrice.textContent = '₹' + offer.toFixed(0);
            previewOfferPrice.style.display = 'inline';
            previewSellingPrice.textContent = '₹' + sell.toFixed(0);
            previewSellingPrice.style.display = 'inline';
            previewDiscountBadge.textContent = discountPct + '% OFF';
            previewDiscountBadge.style.display = 'inline';
        } else if (sell > 0) {
            discountEl.textContent = 'Regular Price';
            discountEl.className = 'profit-item-value text-muted';

            previewOfferPrice.textContent = '₹' + sell.toFixed(0);
            previewOfferPrice.className = 'fw-bold text-dark';
            previewSellingPrice.style.display = 'none';
            previewDiscountBadge.style.display = 'none';
        } else {
            discountEl.textContent = 'No Price Set';
            discountEl.className = 'profit-item-value text-muted';
            previewOfferPrice.textContent = '₹0';
            previewSellingPrice.style.display = 'none';
            previewDiscountBadge.style.display = 'none';
        }

        // 3. Stock Valuation calculation
        if (cost > 0 && stock > 0) {
            stockValueEl.textContent = '₹' + (cost * stock).toLocaleString();
            stockValueEl.className = 'profit-item-value text-dark';
        } else if (sell > 0 && stock > 0) {
            stockValueEl.textContent = '₹' + (sell * stock).toLocaleString();
            stockValueEl.className = 'profit-item-value text-dark';
        } else {
            stockValueEl.textContent = '₹0.00';
            stockValueEl.className = 'profit-item-value text-muted';
        }

        // 4. Update preview titles & details
        previewTitle.textContent = nameInput.value.trim() || 'Product Name Preview';
        previewBrand.textContent = brandSelect.value || 'TrendWear';

        const catText = categorySelect.value || 'Clothing';
        const subCatText = subcategorySelect.value || '';
        previewCategory.textContent = subCatText ? `${catText} • ${subCatText}` : catText;

        previewMaterial.textContent = materialSelect.value || 'Standard';

        // 5. Stock status badge
        if (stock > 0) {
            previewStockStatus.innerHTML = `<i class="fa fa-circle-check me-1"></i>In Stock (${stock})`;
            previewStockStatus.className = 'small text-success fw-semibold';
        } else if (stockQuantityInput.value !== '') {
            previewStockStatus.innerHTML = `<i class="fa fa-circle-xmark me-1"></i>Out of Stock`;
            previewStockStatus.className = 'small text-danger fw-semibold';
        } else {
            previewStockStatus.innerHTML = `<i class="fa fa-cubes me-1"></i>Available`;
            previewStockStatus.className = 'small text-muted';
        }

        // 6. Badges preview
        previewNewBadge.classList.toggle('d-none', !newArrivalCheckbox.checked);
        previewFeaturedBadge.classList.toggle('d-none', !featuredCheckbox.checked);
    }

    [nameInput, sellingPriceInput, offerPriceInput, costPriceInput, stockQuantityInput, categorySelect, subcategorySelect, brandSelect, materialSelect].forEach(function (el) {
        el.addEventListener('input', updateCalculationsAndPreview);
        el.addEventListener('change', updateCalculationsAndPreview);
    });

    featuredCheckbox.addEventListener('change', updateCalculationsAndPreview);
    newArrivalCheckbox.addEventListener('change', updateCalculationsAndPreview);
    updateCalculationsAndPreview();


    /*
    |--------------------------------------------------------------------------
    | AUTO SKU GENERATOR
    |--------------------------------------------------------------------------
    */
    generateSkuBtn.addEventListener('click', function () {
        const cat = (categorySelect.value || 'TW').substring(0, 3).toUpperCase();
        const sub = (subcategorySelect.value || 'PROD').substring(0, 3).toUpperCase();
        const randomNum = Math.floor(100 + Math.random() * 900);
        skuInput.value = `TW-${cat}-${sub}-${randomNum}`;
        skuInput.dispatchEvent(new Event('input'));
    });


    /*
    |--------------------------------------------------------------------------
    | STATUS TOGGLE LABEL
    |--------------------------------------------------------------------------
    */
    function updateStatusLabel() {
        if (statusCheckbox.checked) {
            statusLabelText.textContent = 'Active (Visible in Store)';
            statusLabelText.className = 'text-success fw-semibold m-0 small';
        } else {
            statusLabelText.textContent = 'Inactive (Hidden from Store)';
            statusLabelText.className = 'text-muted fw-semibold m-0 small';
        }
    }

    statusCheckbox.addEventListener('change', updateStatusLabel);
    updateStatusLabel();


    /*
    |--------------------------------------------------------------------------
    | IMAGE UPLOAD & PREVIEWS WITH REMOVE SUPPORT
    |--------------------------------------------------------------------------
    */
    const coverImageInput = document.getElementById('cover_image');
    const coverPreview = document.getElementById('coverPreview');

    coverImageInput.addEventListener('change', function () {
        coverPreview.innerHTML = '';
        const file = this.files[0];
        if (file) {
            const objectUrl = URL.createObjectURL(file);

            // Preview in form card
            const card = document.createElement('div');
            card.className = 'image-preview-card';

            const img = document.createElement('img');
            img.src = objectUrl;

            const badge = document.createElement('span');
            badge.className = 'image-preview-badge';
            badge.textContent = 'Cover';

            card.appendChild(img);
            card.appendChild(badge);
            coverPreview.appendChild(card);

            // Live Storefront Card Preview
            livePreviewImg.src = objectUrl;
            livePreviewImg.style.display = 'block';
            previewPlaceholder.style.display = 'none';
        } else {
            livePreviewImg.style.display = 'none';
            previewPlaceholder.style.display = 'block';
        }
    });

    const galleryInput = document.getElementById('gallery_images');
    const galleryPreview = document.getElementById('galleryPreview');

    galleryInput.addEventListener('change', function () {
        galleryPreview.innerHTML = '';
        Array.from(this.files).forEach(function (file, idx) {
            const card = document.createElement('div');
            card.className = 'image-preview-card';

            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.onload = function () {
                URL.revokeObjectURL(img.src);
            };

            const badge = document.createElement('span');
            badge.className = 'image-preview-badge';
            badge.textContent = '#' + (idx + 1);

            card.appendChild(img);
            card.appendChild(badge);
            galleryPreview.appendChild(card);
        });
    });


    /*
    |--------------------------------------------------------------------------
    | FORM VALIDATION
    |--------------------------------------------------------------------------
    */
    const form = document.getElementById('productCreateForm');

    offerPriceInput.addEventListener('input', function () {
        const selling = parseFloat(sellingPriceInput.value);
        const offer = parseFloat(offerPriceInput.value);

        if (!isNaN(selling) && !isNaN(offer) && offer > selling) {
            offerPriceInput.setCustomValidity('Offer price cannot be greater than selling price.');
        } else {
            offerPriceInput.setCustomValidity('');
        }
    });

    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            form.reportValidity();
            return false;
        }

        const selling = parseFloat(sellingPriceInput.value);
        const offer = parseFloat(offerPriceInput.value);

        if (offerPriceInput.value !== '' && offer > selling) {
            event.preventDefault();
            alert('Offer price cannot be greater than selling price.');
            offerPriceInput.focus();
            return false;
        }
    });

});
</script>

@endsection