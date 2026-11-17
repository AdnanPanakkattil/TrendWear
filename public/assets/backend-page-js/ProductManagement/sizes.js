$(document).ready(function () {
    'use strict';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    const routes = window.SizeManagementRoutes || {
        index: '/sizes',
        store: '/sizes/store',
        edit: '/sizes/edit',
        delete: '/sizes/delete',
    };

    // Initialize tw-select custom styling if available
    if (window.initTwSelect) {
        window.initTwSelect(document);
    }

    const sizesTable = $('#sizes_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: routes.index || '/sizes',
            type: 'GET',
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'code', name: 'code' },
            { data: 'category_name', name: 'category.name_en', defaultContent: '-' },
            { data: 'status_badge', name: 'status', orderable: false, searchable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        order: [[0, 'desc']],
    });

    const modalEl = document.getElementById('sizeModal');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);

    function clearErrors() {
        $('.error-text').text('');
        $('.form-control, .form-select').removeClass('is-invalid');
    }

    function resetForm() {
        $('#size_form')[0].reset();
        $('#size_id').val('');
        $('#size_status').prop('checked', true);
        $('#size_status_label').text('Active');
        $('#size_category_id').val('').trigger('change');
        $('#sizeModalLabel').text('Add Size');
        $('#saveSizeButton').text('Save Size');
        clearErrors();
    }

    // Toggle switch label update on change
    $('#size_status').on('change', function () {
        if ($(this).is(':checked')) {
            $('#size_status_label').text('Active');
        } else {
            $('#size_status_label').text('Inactive');
        }
    });

    $('button[data-bs-target="#sizeModal"]').on('click', resetForm);
    $('#sizeModal').on('hidden.bs.modal', resetForm);

    // Edit Size Handler
    $(document).on('click', '.edit-size-btn', function () {
        const sizeId = $(this).data('id');
        const url = (routes.edit ? routes.edit : '/sizes/edit') + '/' + sizeId;

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (!response.success || !response.data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: 'Unable to load size details.',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        showCancelButton: false,
                        customClass: {
                            confirmButton: 'btn btn-danger',
                        },
                        buttonsStyling: false,
                    });
                    return;
                }

                const data = response.data;
                resetForm();

                $('#size_id').val(data.id);
                $('#size_name').val(data.name || '');
                $('#size_code').val(data.code || '');

                if (data.category_id) {
                    $('#size_category_id').val(data.category_id).trigger('change');
                } else {
                    $('#size_category_id').val('').trigger('change');
                }

                const isActive = Number(data.status) === 1;
                $('#size_status').prop('checked', isActive);
                $('#size_status_label').text(isActive ? 'Active' : 'Inactive');

                $('#chest_inch').val(data.chest_inch !== null ? data.chest_inch : '');
                $('#waist_inch').val(data.waist_inch !== null ? data.waist_inch : '');
                $('#shoulder_inch').val(data.shoulder_inch !== null ? data.shoulder_inch : '');
                $('#length_inch').val(data.length_inch !== null ? data.length_inch : '');
                $('#sleeve_length_inch').val(data.sleeve_length_inch !== null ? data.sleeve_length_inch : '');

                $('#sizeModalLabel').text('Edit Size');
                $('#saveSizeButton').text('Update Size');

                clearErrors();
                modal.show();
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed',
                    text: 'Unable to load size details. Please try again.',
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    showCancelButton: false,
                    customClass: {
                        confirmButton: 'btn btn-danger',
                    },
                    buttonsStyling: false,
                });
            },
        });
    });

    // Form Submit (Save / Update)
    $('#size_form').on('submit', function (e) {
        e.preventDefault();
        clearErrors();

        const submitUrl = routes.store || '/sizes/store';

        const button = $('#saveSizeButton');
        const originalHtml = button.html();
        button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Saving...');

        const formData = new FormData(this);
        // Ensure status checkbox value is explicitly sent
        if (!$('#size_status').is(':checked')) {
            formData.set('status', '0');
        } else {
            formData.set('status', '1');
        }

        $.ajax({
            url: submitUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                button.prop('disabled', false).html(originalHtml);

                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message || 'Size saved successfully.',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        showCancelButton: false,
                        customClass: {
                            confirmButton: 'btn btn-success',
                        },
                        buttonsStyling: false,
                    }).then(function () {
                        modal.hide();
                        sizesTable.ajax.reload(null, false);
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: response.message || 'Failed to save size.',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        showCancelButton: false,
                        customClass: {
                            confirmButton: 'btn btn-danger',
                        },
                        buttonsStyling: false,
                    });
                }
            },
            error: function (xhr) {
                button.prop('disabled', false).html(originalHtml);

                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors || {};
                    let firstErrorMessage = 'Please check the required fields.';

                    $.each(errors, function (key, value) {
                        $('.' + key + '_error').text(value[0]);
                        $('[name="' + key + '"]').addClass('is-invalid');
                        if (firstErrorMessage === 'Please check the required fields.') {
                            firstErrorMessage = value[0];
                        }
                    });

                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: firstErrorMessage,
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        showCancelButton: false,
                        customClass: {
                            confirmButton: 'btn btn-danger',
                        },
                        buttonsStyling: false,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: xhr.responseJSON?.message || 'Something went wrong while saving size.',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        showCancelButton: false,
                        customClass: {
                            confirmButton: 'btn btn-danger',
                        },
                        buttonsStyling: false,
                    });
                }
            },
        });
    });

    // Delete Size Handler
    $(document).on('click', '.delete-size-btn', function () {
        const sizeId = $(this).data('id');
        const sizeName = $(this).data('name') || 'this size';
        const deleteUrl = (routes.delete ? routes.delete : '/sizes/delete') + '/' + sizeId;

        Swal.fire({
            title: 'Are you sure?',
            text: 'Are you sure you want to delete "' + sizeName + '"?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete',
            cancelButtonText: 'Cancel',
            customClass: {
                confirmButton: 'btn btn-primary me-2',
                cancelButton: 'btn btn-label-secondary',
            },
            buttonsStyling: false,
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: deleteUrl,
                    type: 'POST',
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message || 'Size deleted successfully.',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                showCancelButton: false,
                                customClass: {
                                    confirmButton: 'btn btn-success',
                                },
                                buttonsStyling: false,
                            }).then(function () {
                                sizesTable.ajax.reload(null, false);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed',
                                text: response.message || 'Failed to delete size.',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                showCancelButton: false,
                                customClass: {
                                    confirmButton: 'btn btn-danger',
                                },
                                buttonsStyling: false,
                            });
                        }
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: xhr.responseJSON?.message || 'Failed to delete size. Please try again.',
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                            showCancelButton: false,
                            customClass: {
                                confirmButton: 'btn btn-danger',
                            },
                            buttonsStyling: false,
                        });
                    },
                });
            }
        });
    });
});
