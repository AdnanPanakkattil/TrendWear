$(document).ready(function () {

    // Initialize Flatpickr for Joined Date (disable past dates up to yesterday, start from today)
    const joinedDatePicker = document.querySelector('#joined_date') || document.querySelector('.joined_date');
    if (joinedDatePicker && typeof flatpickr !== 'undefined') {
        flatpickr(joinedDatePicker, {
            monthSelectorType: 'static',
            dateFormat: 'Y-m-d',
            minDate: 'today'
        });
    }

    // store db ============================================

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

    //======================================================
});

