$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    const brandsTable = $('#Brands_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/brands/data',
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

    const modalEl = document.getElementById('brandModal');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);

    function clearErrors() {
        $('.error-text').text('');
        $('.form-control, .form-select').removeClass('is-invalid');
    }

    function resetForm() {
        $('#brand_form')[0].reset();
        $('#brand_id').val('');
        $('#brand_image_preview').empty();
        $('#brandModalLabel').text('Add Brand');
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

    $('button[data-bs-target="#brandModal"]').on('click', resetForm);

    $('#brandModal').on('hidden.bs.modal', resetForm);

    $(document).on('click', '.edit-brand-btn', function () {
        const brandId = $(this).data('id');

        $.ajax({
            url: '/brands/edit/' + brandId,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (!response.success || !response.data) {
                    return;
                }

                const brand = response.data;
                $('#brand_id').val(brand.id);
                $('#name_en').val(brand.name_en || '');
                $('#name_ar').val(brand.name_ar || '');
                $('#brandModalLabel').text('Edit Brand');

                if (brand.image_url) {
                    $('#brand_image_preview').html(
                        '<img src="' + brand.image_url + '" alt="' + (brand.name_en || '') + '" class="rounded" style="width: 80px; height: 80px; object-fit: cover;">'
                    );
                } else {
                    $('#brand_image_preview').empty();
                }

                clearErrors();
                modal.show();
            },
            error: function () {
                showError('Unable to load brand details.');
            },
        });
    });

    $('#brand_form').on('submit', function (e) {
        e.preventDefault();
        clearErrors();

        const brandId = $('#brand_id').val();
        const url = brandId ? '/brands/update/' + brandId : '/brands/store';
        const button = $('#saveBrandButton');

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
                        brandsTable.ajax.reload(null, false);
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

    $(document).on('click', '.delete-brand-btn', function () {
        const brandId = $(this).data('id');
        const brandName = $(this).data('name') || 'this brand';

        Swal.fire({
            title: 'Are you sure?',
            text: 'Are you sure you want to delete "' + brandName + '"?',
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
                url: '/brands/delete/' + brandId,
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
                        brandsTable.ajax.reload(null, false);
                    }
                },
                error: function (xhr) {
                    showError(xhr.responseJSON?.message || 'Failed to delete brand.');
                },
            });
        });
    });
});
