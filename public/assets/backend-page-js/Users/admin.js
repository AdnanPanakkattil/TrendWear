$(document).ready(function () {
    // Active menu
    $("#User_management_menu, #menu_user_management").addClass("active");

    // CSRF Setup
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // Joined Date Picker
    const joinedDatePicker = document.querySelector('#joined_date') || document.querySelector('.joined_date');
    if (joinedDatePicker && typeof flatpickr !== 'undefined') {
        flatpickr(joinedDatePicker, {
            monthSelectorType: 'static',
            dateFormat: 'Y-m-d',
        });
    }

    // Edit function: Fetches user details via AJAX and sets values in form inputs
    function editUser(userId) {
        if (!userId) return;

        $.ajax({
            url: '/users/get/' + userId,
            type: 'GET',
            dataType: 'json',
            success: function (res) {
                if (res.success && res.data) {
                    const u = res.data;
                    $('#user_id').val(u.id);
                    $('#name_en').val(u.name_en || '');
                    $('#name_ar').val(u.name_ar || '');
                    $('#username').val(u.username || '');
                    $('#mobile_no').val(u.mobile_no || '');
                    $('#email').val(u.email || '');
                    $('#joined_date').val(u.joined_date || '');

                    // Change UI text for edit mode
                    $('#admin_title').text('Edit Admin');
                    $('#saveButton').text('Update');
                    $('.text-password-hint').text('(Leave blank to keep current)');
                    $('#password').attr('placeholder', 'Leave blank to keep current');
                }
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Unable to load user details.',
                    showConfirmButton: true,
                    showCancelButton: false,
                    showDenyButton: false,
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false,
                    willOpen: function (popup) {
                        $(popup).find('.swal2-cancel, .swal2-deny').remove();
                    }
                });
            }
        });
    }

    // Auto-detect edit mode: from #user_id, query param ?id=, or URL segment /edit/{id}
    let editId = $('#user_id').val();
    if (!editId) {
        const urlParams = new URLSearchParams(window.location.search);
        editId = urlParams.get('id');
        if (!editId) {
            const pathParts = window.location.pathname.split('/').filter(Boolean);
            const editIdx = pathParts.indexOf('edit');
            if (editIdx !== -1 && pathParts[editIdx + 1]) {
                editId = pathParts[editIdx + 1];
            }
        }
    }

    if (editId) {
        editUser(editId);
    }

    // Clear validation errors
    function clearErrors() {
        $('.error-text').text('');
        $('.form-control').removeClass('is-invalid');
    }

    // Save or Update Admin
    $('#saveButton').on('click', function (e) {
        e.preventDefault();
        clearErrors();

        const button = $(this);
        const userId = $('#user_id').val();
        const url = userId ? '/admin/update/' + userId : '/admin/store';

        button.prop('disabled', true);

        $.ajax({
            url: url,
            type: 'POST',
            data: $('#admin_form').serialize(),
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: true,
                        showCancelButton: false,
                        showDenyButton: false,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false,
                        willOpen: function (popup) {
                            $(popup).find('.swal2-cancel, .swal2-deny').remove();
                        }
                    }).then(() => {
                        window.location.href = '/users';
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
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'Something went wrong.',
                        showConfirmButton: true,
                        showCancelButton: false,
                        showDenyButton: false,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false,
                        willOpen: function (popup) {
                            $(popup).find('.swal2-cancel, .swal2-deny').remove();
                        }
                    });
                }
            },
            complete: function () {
                button.prop('disabled', false);
            }
        });
    });
});
