$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    const itemMasterTable = $('#item_master_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/item_master/data',
            type: 'GET',
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'image_preview', name: 'image_preview', orderable: false, searchable: false },
            { data: 'sku_code', name: 'sku' },
            { data: 'name_en', name: 'name_en' },
            { data: 'category_name', name: 'category.name_en', defaultContent: '-' },
            { data: 'sub_category_name', name: 'subCategory.name_en', defaultContent: '-' },
            { data: 'formatted_price', name: 'min_retail_price' },
            { data: 'status_badge', name: 'ecommerce_status' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        order: [[0, 'desc']],
    });

    $(document).on('click', '.delete-itemmaster-btn', function () {
        const itemId = $(this).data('id');
        const itemName = $(this).data('name') || 'this item';

        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to delete "' + itemName + '"?',
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
