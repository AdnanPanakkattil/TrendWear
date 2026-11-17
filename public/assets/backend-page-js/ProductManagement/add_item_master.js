$(document).ready(function () {
    'use strict';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    const config = window.ItemMasterConfig || {};
    let categoriesData = Array.isArray(config.categories) ? config.categories : [];
    const initialCatId = config.initialCategoryId ? String(config.initialCategoryId) : '';
    const initialSubCatId = config.initialSubCategoryId ? String(config.initialSubCategoryId) : '';
    const routes = config.routes || {};

    // Initialize TrendWear Selectbox styling (.tw-select)
    if (window.initTwSelect) {
        window.initTwSelect(document);
    }

    // Flatpickr calendar datepicker for offer dates
    if (typeof flatpickr !== 'undefined') {
        const startPicker = $('#value_from_start_date').flatpickr({
            dateFormat: 'Y-m-d',
            allowInput: true,
            monthSelectorType: 'static',
        });
        const endPicker = $('#value_from_end_date').flatpickr({
            dateFormat: 'Y-m-d',
            allowInput: true,
            monthSelectorType: 'static',
        });

        $('#value_from_start_date').next('.input-group-text').on('click', function () {
            if (startPicker) startPicker.open();
        });
        $('#value_from_end_date').next('.input-group-text').on('click', function () {
            if (endPicker) endPicker.open();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Category & Sub-Category Dynamic Rendering
    |--------------------------------------------------------------------------
    */
    function renderCategoryOptions(selectedId) {
        let catOptions = '<option value="">Select Category</option>';
        let modalOptions = '<option value="">Select Category</option>';

        categoriesData.forEach(function (cat) {
            const isCatSelected = selectedId && String(cat.id) === String(selectedId);
            const selAttr = isCatSelected ? ' selected' : '';
            catOptions += `<option value="${cat.id}"${selAttr}>${cat.name_en}</option>`;
            modalOptions += `<option value="${cat.id}"${selAttr}>${cat.name_en}</option>`;
        });

        $('#category_id').html(catOptions).trigger('change');
        $('#quick_subcat_category_id').html(modalOptions).trigger('change');
    }

    function updateSubCategories(categoryId, selectedSubId) {
        const $subSelect = $('#sub_category_id');
        $subSelect.html('<option value="">Select Sub Category</option>');

        if (!categoryId) {
            $subSelect.trigger('change');
            return;
        }

        const category = categoriesData.find(c => String(c.id) === String(categoryId));
        if (category && Array.isArray(category.sub_categories) && category.sub_categories.length > 0) {
            category.sub_categories.forEach(function (sub) {
                const isSubSelected = selectedSubId && String(sub.id) === String(selectedSubId);
                $subSelect.append(`<option value="${sub.id}"${isSubSelected ? ' selected' : ''}>${sub.name_en}</option>`);
            });
            $subSelect.trigger('change');
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
                    $subSelect.trigger('change');
                },
                error: function () {
                    $subSelect.trigger('change');
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

    /*
    |--------------------------------------------------------------------------
    | Offer Product Toggle
    |--------------------------------------------------------------------------
    */
    $('#offer_product_status').on('change', function () {
        if ($(this).is(':checked')) {
            $('#offer_date_range_box').slideDown();
        } else {
            $('#offer_date_range_box').slideUp();
        }
    });

    /*
    |--------------------------------------------------------------------------
    | Master Image Upload & Preview
    |--------------------------------------------------------------------------
    */
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

    /*
    |--------------------------------------------------------------------------
    | Sub Images Upload & Preview
    |--------------------------------------------------------------------------
    */
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

    /*
    |--------------------------------------------------------------------------
    | Quick Add Category Modal
    |--------------------------------------------------------------------------
    */
    $('#quickCategoryModal').on('show.bs.modal', function () {
        $('#quick_category_form')[0].reset();
        $('#quick_category_form .error-text').text('');
        $('#quick_category_form .form-control').removeClass('is-invalid');
    });

    $('#quick_category_form').on('submit', function (e) {
        e.preventDefault();
        const $btn = $('#saveQuickCategoryBtn');
        const originalHtml = $btn.html();
        $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Saving...');
        $('#quick_category_form .error-text').text('');
        $('#quick_category_form .form-control').removeClass('is-invalid');

        const formData = new FormData(this);
        const url = routes.categoriesStore || '/categories/store';

        $.ajax({
            url: url,
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

    /*
    |--------------------------------------------------------------------------
    | Quick Add Sub Category Modal
    |--------------------------------------------------------------------------
    */
    $('#quickSubCategoryModal').on('show.bs.modal', function () {
        $('#quick_sub_category_form')[0].reset();
        $('#quick_sub_category_form .error-text').text('');
        $('#quick_sub_category_form .form-control, #quick_sub_category_form .form-select').removeClass('is-invalid');
        const currentCat = $('#category_id').val();
        if (currentCat) {
            $('#quick_subcat_category_id').val(currentCat).trigger('change');
        }
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
        const url = routes.subCategoriesStore || '/sub_categories/store';

        $.ajax({
            url: url,
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

                    $('#category_id').val(selectedCatId).trigger('change');
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

    /*
    |--------------------------------------------------------------------------
    | Main Form Submit (Create & Update)
    |--------------------------------------------------------------------------
    */
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
            : (routes.itemMasterStore || '/item_master/store');

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
                        window.location.href = response.redirect || routes.itemMasterIndex || '/item_master';
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
                        'cost_price': '#cost_price',
                        'selling_price': '#selling_price',
                        'offer_price': '#offer_price',
                        'featured_product': '#featured_product',
                        'value_from_start_date': '#value_from_start_date',
                        'offer_start_date': '#value_from_start_date',
                        'value_from_end_date': '#value_from_end_date',
                        'offer_end_date': '#value_from_end_date',
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
