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
            { data: 'name_ar', name: 'name_ar', defaultContent: '-' },
            { data: 'image_preview', name: 'image_preview', orderable: false, searchable: false, defaultContent: '-' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
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
