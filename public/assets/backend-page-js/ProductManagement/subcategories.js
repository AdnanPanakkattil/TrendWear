$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    const subCategoriesTable = $('#SubCategories_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/sub_categories/data',
            type: 'GET',
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'category_name', name: 'category_name', orderable: false, searchable: false },
            { data: 'name_en', name: 'name_en' },
            { data: 'name_ar', name: 'name_ar' },
            { data: 'image_preview', name: 'image_preview', orderable: false, searchable: false, defaultContent: '-' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
    });

    const modalEl = document.getElementById('subCategoryModal');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);

    function clearErrors() {
        $('.error-text').text('');
        $('.form-control, .form-select').removeClass('is-invalid');
    }

    function resetForm() {
        $('#sub_category_form')[0].reset();
        $('#sub_category_id').val('');
        $('#sub_category_image_preview').empty();
        $('#subCategoryModalLabel').text('Add Sub Category');
        clearErrors();
    }

    function showError(message) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: message,
            customClass: {
                confirmButton: 'btn btn-primary',
            },
            buttonsStyling: false,
        });
    }

    $('button[data-bs-target="#subCategoryModal"]').on('click', resetForm);

    $('#subCategoryModal').on('hidden.bs.modal', resetForm);

    $(document).on('click', '.edit-subcategory-btn', function () {
        const subCategoryId = $(this).data('id');

        $.ajax({
            url: '/sub_categories/edit/' + subCategoryId,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (!response.success || !response.data) {
                    return;
                }

                const subCategory = response.data;
                $('#sub_category_id').val(subCategory.id);
                $('#category_id').val(subCategory.category_id);
                $('#name_en').val(subCategory.name_en || '');
                $('#name_ar').val(subCategory.name_ar || '');
                $('#subCategoryModalLabel').text('Edit Sub Category');

                if (subCategory.image_url) {
                    $('#sub_category_image_preview').html(
                        '<img src="' + subCategory.image_url + '" alt="' + (subCategory.name_en || '') + '" class="rounded" style="width: 80px; height: 80px; object-fit: cover;">'
                    );
                } else {
                    $('#sub_category_image_preview').empty();
                }

                clearErrors();
                modal.show();
            },
            error: function () {
                showError('Unable to load sub category details.');
            },
        });
    });

    $('#sub_category_form').on('submit', function (e) {
        e.preventDefault();
        clearErrors();

        const subCategoryId = $('#sub_category_id').val();
        const url = subCategoryId ? '/sub_categories/update/' + subCategoryId : '/sub_categories/store';
        const button = $('#saveSubCategoryButton');

        button.prop('disabled', true);

        $.ajax({
            url: url,
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        customClass: {
                            confirmButton: 'btn btn-primary',
                        },
                        buttonsStyling: false,
                    }).then(function () {
                        modal.hide();
                        subCategoriesTable.ajax.reload(null, false);
                    });
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        $('.' + key + '_error').text(value[0]);
                        $('[name="' + key + '"]').addClass('is-invalid');
                    });
                } else {
                    showError(xhr.responseJSON?.message || 'Something went wrong.');
                }
            },
            complete: function () {
                button.prop('disabled', false);
            },
        });
    });

    $(document).on('click', '.delete-subcategory-btn', function () {
        const subCategoryId = $(this).data('id');
        const subCategoryName = $(this).data('name') || 'this sub category';

        Swal.fire({
            title: 'Are you sure?',
            text: 'Are you sure you want to delete "' + subCategoryName + '"?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete!',
            cancelButtonText: 'Cancel',
            customClass: {
                confirmButton: 'btn btn-danger me-2',
                cancelButton: 'btn btn-secondary',
            },
            buttonsStyling: false,
        }).then(function (result) {
            if (!result.isConfirmed) {
                return;
            }

            $.ajax({
                url: '/sub_categories/delete/' + subCategoryId,
                type: 'POST',
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: response.message,
                            customClass: {
                                confirmButton: 'btn btn-success',
                            },
                            buttonsStyling: false,
                        });
                        subCategoriesTable.ajax.reload(null, false);
                    }
                },
                error: function (xhr) {
                    showError(xhr.responseJSON?.message || 'Failed to delete sub category.');
                },
            });
        });
    });
});
