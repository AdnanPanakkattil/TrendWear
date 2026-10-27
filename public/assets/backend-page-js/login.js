$(document).ready(function () {
    $('form').on('submit', function (event) {
        event.preventDefault();

        // Clear existing errors
        $('#username_error').text('');
        $('#password_error').text('');
        $('#login_error').addClass('d-none').text('');

        showLoader();

        var form = $(this);
        var actionUrl = form.attr('action') || '/login';
        var formMethod = form.attr('method') || 'POST';

        $.ajax({
            url: actionUrl,
            method: formMethod,
            data: form.serialize(),
            dataType: 'json',
            success: function (response) {
                hideLoader();
                if (response.status === 'success' && response.redirect) {
                    window.location.href = response.redirect;
                } else if (response.errors) {
                    for (var key in response.errors) {
                        if (key === 'password') {
                            $('#' + key).closest('.textbox-1').find('.text-danger').text(response.errors[key][0]);
                        } else {
                            $('#' + key).next('.text-danger').text(response.errors[key][0]);
                        }
                    }
                }
            },
            error: function (xhr) {
                hideLoader();
                var data = xhr.responseJSON || {};
                var errors = data.errors || null;

                if (xhr.status === 401) {
                    $('#password').closest('.textbox-1').find('.text-danger')
                        .text(data.message || 'Invalid Credentials, Please try again.');
                }
                else if (xhr.status === 429) {
                    $('#email_or_username').next('.text-danger')
                        .text(data.message || 'Too many attempts. Please wait a minute and try again.');
                }
                else if (xhr.status === 403) {
                    var errorMsg = (errors && errors.error_msg && errors.error_msg.length > 0)
                        ? errors.error_msg[0]
                        : (data.message || 'Your account is deactivated. Please contact administrator.');
                    $('#email_or_username').next('.text-danger').text(errorMsg);
                }
                else if (xhr.status === 422) {
                    if (errors) {
                        for (var key in errors) {
                            if (key === 'password') {
                                $('#' + key).closest('.textbox-1')
                                    .find('.text-danger')
                                    .text(errors[key][0]);
                            } else {
                                $('#' + key).next('.text-danger').text(errors[key][0]);
                            }
                        }
                    }
                }
                else {
                    $('#login_error').removeClass('d-none').text(data.message || 'An error occurred. Please try again.');
                }
            }
        });
    });

    setTimeout(function () {
        $('.alert').fadeOut('slow');
    }, 5000);
});
