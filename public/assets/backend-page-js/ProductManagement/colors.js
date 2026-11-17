$(document).ready(function () {
    'use strict';

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    const routes = window.ColorManagementRoutes || {
        index: '/colors',
        store: '/colors/store',
        edit: '/colors/edit',
        delete: '/colors/delete',
    };

    const colorsTable = $('#colors_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: routes.index || '/colors',
            type: 'GET',
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name_en', name: 'name_en' },
            { data: 'name_ar', name: 'name_ar' },
            { data: 'color_preview', name: 'color_code', orderable: false },
            { data: 'status_badge', name: 'status', orderable: false, searchable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false },
        ],
        order: [[0, 'desc']],
    });

    const modalEl = document.getElementById('colorModal');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);

    function syncColor(hex) {
        if (!hex) return;
        let cleanHex = hex.trim();
        if (!cleanHex.startsWith('#') && (cleanHex.length === 3 || cleanHex.length === 6)) {
            cleanHex = '#' + cleanHex;
        }

        const validHexRegex = /^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/;
        if (validHexRegex.test(cleanHex)) {
            // Expand 3-digit hex to 6-digit for HTML5 color input
            let fullHex = cleanHex;
            if (cleanHex.length === 4) {
                fullHex = '#' + cleanHex[1] + cleanHex[1] + cleanHex[2] + cleanHex[2] + cleanHex[3] + cleanHex[3];
            }
            $('#color_picker').val(fullHex);
            $('#color_preview_box').css('background-color', fullHex);
        }
    }

    // Color picker input change
    $('#color_picker').on('input change', function () {
        const hex = $(this).val();
        $('#color_code').val(hex);
        $('#color_preview_box').css('background-color', hex);
    });

    // Color code text input change
    $('#color_code').on('input', function () {
        syncColor($(this).val());
    });

    function clearErrors() {
        $('.error-text').text('');
        $('.form-control, .form-select').removeClass('is-invalid');
    }

    function resetForm() {
        $('#color_form')[0].reset();
        $('#color_id').val('');
        $('#color_picker').val('#3b82f6');
        $('#color_code').val('#3b82f6');
        $('#color_preview_box').css('background-color', '#3b82f6');
        $('#color_status').prop('checked', true);
        $('#color_status_label').text('Active');
        $('#colorModalLabel').text('Add Color');
        $('#saveColorButton').text('Save Color');
        clearErrors();
    }

    // Toggle switch label update on change
    $('#color_status').on('change', function () {
        if ($(this).is(':checked')) {
            $('#color_status_label').text('Active');
        } else {
            $('#color_status_label').text('Inactive');
        }
    });

    $('button[data-bs-target="#colorModal"]').on('click', resetForm);
    $('#colorModal').on('hidden.bs.modal', resetForm);

    // Edit Color Handler
    $(document).on('click', '.edit-color-btn', function () {
        const colorId = $(this).data('id');
        const url = (routes.edit ? routes.edit : '/colors/edit') + '/' + colorId;

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (!response.success || !response.data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: 'Unable to load color details.',
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

                $('#color_id').val(data.id);
                $('#color_name_en').val(data.name_en || '');
                $('#color_name_ar').val(data.name_ar || '');
                $('#color_code').val(data.color_code || '#3b82f6');
                syncColor(data.color_code || '#3b82f6');

                const isActive = Number(data.status) === 1;
                $('#color_status').prop('checked', isActive);
                $('#color_status_label').text(isActive ? 'Active' : 'Inactive');

                $('#colorModalLabel').text('Edit Color');
                $('#saveColorButton').text('Update Color');

                clearErrors();
                modal.show();
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed',
                    text: 'Unable to load color details. Please try again.',
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
    $('#color_form').on('submit', function (e) {
        e.preventDefault();
        clearErrors();

        const submitUrl = routes.store || '/colors/store';

        const button = $('#saveColorButton');
        const originalHtml = button.html();
        button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Saving...');

        const formData = new FormData(this);
        // Ensure status checkbox value is explicitly sent
        if (!$('#color_status').is(':checked')) {
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
                        text: response.message || 'Color saved successfully.',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        showCancelButton: false,
                        customClass: {
                            confirmButton: 'btn btn-success',
                        },
                        buttonsStyling: false,
                    }).then(function () {
                        modal.hide();
                        colorsTable.ajax.reload(null, false);
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: response.message || 'Failed to save color.',
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
                        text: xhr.responseJSON?.message || 'Something went wrong while saving color.',
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

    // Delete Color Handler
    $(document).on('click', '.delete-color-btn', function () {
        const colorId = $(this).data('id');
        const colorName = $(this).data('name') || 'this color';
        const deleteUrl = (routes.delete ? routes.delete : '/colors/delete') + '/' + colorId;

        Swal.fire({
            title: 'Are you sure?',
            text: 'Are you sure you want to delete "' + colorName + '"?',
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
                                text: response.message || 'Color deleted successfully.',
                                showConfirmButton: true,
                                confirmButtonText: 'OK',
                                showCancelButton: false,
                                customClass: {
                                    confirmButton: 'btn btn-success',
                                },
                                buttonsStyling: false,
                            }).then(function () {
                                colorsTable.ajax.reload(null, false);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed',
                                text: response.message || 'Failed to delete color.',
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
                            text: xhr.responseJSON?.message || 'Failed to delete color. Please try again.',
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
