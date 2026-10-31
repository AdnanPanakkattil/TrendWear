$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    const categoriesTable = $('#Categories_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/categories/data',
            type: 'GET',
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name_en', name: 'name_en' },
            { data: 'name_ar', name: 'name_ar' },
            { data: 'image_preview', name: 'image_preview', orderable: false, searchable: false, defaultContent: '-' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
    });

    const modalEl = document.getElementById('categoryModal');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);

    function clearErrors() {
        $('.error-text').text('');
        $('.form-control, .form-select').removeClass('is-invalid');
    }

    function resetForm() {
        $('#category_form')[0].reset();
        $('#category_id').val('');
        $('#category_image_preview').empty();
        $('#categoryModalLabel').text('Add Category');
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

    $('button[data-bs-target="#categoryModal"]').on('click', resetForm);

    $('#categoryModal').on('hidden.bs.modal', resetForm);

    $(document).on('click', '.edit-category-btn', function () {
        const categoryId = $(this).data('id');

        $.ajax({
            url: '/categories/edit/' + categoryId,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (!response.success || !response.data) {
                    return;
                }

                const category = response.data;
                $('#category_id').val(category.id);
                $('#name_en').val(category.name_en || '');
                $('#name_ar').val(category.name_ar || '');
                $('#categoryModalLabel').text('Edit Category');

                if (category.image_url) {
                    $('#category_image_preview').html(
                        '<img src="' + category.image_url + '" alt="' + (category.name_en || '') + '" class="rounded" style="width: 80px; height: 80px; object-fit: cover;">'
                    );
                } else {
                    $('#category_image_preview').empty();
                }

                clearErrors();
                modal.show();
            },
            error: function () {
                showError('Unable to load category details.');
            },
        });
    });

    $('#category_form').on('submit', function (e) {
        e.preventDefault();
        clearErrors();

        const categoryId = $('#category_id').val();
        const url = categoryId ? '/categories/update/' + categoryId : '/categories/store';
        const button = $('#saveCategoryButton');

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
                        categoriesTable.ajax.reload(null, false);
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

    $(document).on('click', '.delete-category-btn', function () {
        const categoryId = $(this).data('id');
        const categoryName = $(this).data('name') || 'this category';

        Swal.fire({
            title: 'Are you sure?',
            text: 'Are you sure you want to delete "' + categoryName + '"?',
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
                url: '/categories/delete/' + categoryId,
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
                        categoriesTable.ajax.reload(null, false);
                    }
                },
                error: function (xhr) {
                    showError(xhr.responseJSON?.message || 'Failed to delete category.');
                },
            });
        });
    });
});
