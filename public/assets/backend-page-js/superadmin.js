$(document).ready(function () {

    $('#saveButton').on('click', function () {

        $.ajax({
            url: '/superadmin/store',
            type: 'POST',
            data: $('#superadmin_form').serialize(),

            success: function (response) {
                console.log(response);
            },

            error: function (xhr) {
                console.log(xhr.status);
                console.log(xhr.responseText);
            }
        });
    });

});