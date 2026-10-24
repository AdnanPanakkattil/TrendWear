
$(document).ready(function () {

    // Active menu
    $("#User_management_menu").addClass("active");

    // CSRF Setup
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // Joined Date Picker
    const joinedDatePicker = document.querySelector('#joined_date');

    if (joinedDatePicker && typeof flatpickr !== 'undefined') {

        flatpickr(joinedDatePicker, {
            monthSelectorType: 'static',
            dateFormat: 'Y-m-d',
            maxDate: 'today'
        });

    }

    // Clear validation errors
    function clearErrors() {

        $('.error-text').text('');

        $('.form-control').removeClass('is-invalid');

    }

    // Admin Store
    $('#saveButton').on('click', function (e) {

        e.preventDefault();

        clearErrors();

        const button = $(this);

        button.prop('disabled', true);

        $.ajax({

            url: '/admin/store',

            type: 'POST',

            data: $('#admin_form').serialize(),

            success: function (response) {

                if (response.success) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        confirmButtonText: 'OK'
                    }).then(() => {

                        window.location.href = '/superadmin';

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
                        text: xhr.responseJSON?.message ||
                            'Something went wrong.'
                    });

                }

            },

            complete: function () {

                button.prop('disabled', false);

            }

        });

    });

});
