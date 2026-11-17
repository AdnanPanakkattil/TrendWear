$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    const itemMasterTable = $('#ItemMaster_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/item_master/data',
            type: 'GET',
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'category_name', name: 'category_name', orderable: false, searchable: false },
            { data: 'sub_category_name', name: 'sub_category_name', orderable: false, searchable: false },
            { data: 'name_en', name: 'name_en' },
            { data: 'cost_price_formatted', name: 'cost_price', defaultContent: '-' },
            { data: 'selling_price_formatted', name: 'selling_price', defaultContent: '-' },
            { data: 'offer_price_formatted', name: 'offer_price', defaultContent: '-' },
            { data: 'featured_switch', name: 'featured_product', className: 'text-center', orderable: false, searchable: false },
            { data: 'image_preview', name: 'image_preview', orderable: false, searchable: false, defaultContent: '-' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
    });

    $(document).on('change', '.featured-toggle-btn', function () {
        const itemId = $(this).data('id');
        const isFeatured = $(this).is(':checked') ? 1 : 0;
        const $checkbox = $(this);

        $.ajax({
            url: '/item_master/toggle-featured/' + itemId,
            type: 'POST',
            data: {
                featured_product: isFeatured,
            },
            dataType: 'json',
            success: function (response) {
                if (response.success && typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: isFeatured ? 'Featured Product Active' : 'Featured Product Inactive',
                        text: response.message || (isFeatured ? 'Item is now marked as a Featured Product.' : 'Item has been removed from Featured Products.'),
                        timer: 1500,
                        showConfirmButton: false,
                        customClass: {
                            confirmButton: 'btn btn-primary',
                        },
                        buttonsStyling: false,
                    });
                }
            },
            error: function () {
                $checkbox.prop('checked', !isFeatured);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to update featured status. Please try again.',
                    customClass: {
                        confirmButton: 'btn btn-primary',
                    },
                    buttonsStyling: false,
                });
            },
        });
    });

    $(document).on('click', '.delete-itemmaster-btn', function () {
        const itemId = $(this).data('id');
        const itemName = $(this).data('name') || 'this item';

        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover "' + itemName + '"!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            customClass: {
                confirmButton: 'btn btn-primary me-2',
                cancelButton: 'btn btn-label-secondary',
            },
            buttonsStyling: false,
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/item_master/delete/' + itemId,
                    type: 'POST',
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            itemMasterTable.ajax.reload(null, false);
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.message || 'Item Master deleted successfully.',
                                customClass: {
                                    confirmButton: 'btn btn-primary',
                                },
                                buttonsStyling: false,
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to delete item.',
                            customClass: {
                                confirmButton: 'btn btn-primary',
                            },
                            buttonsStyling: false,
                        });
                    },
                });
            }
        });
    });
});
