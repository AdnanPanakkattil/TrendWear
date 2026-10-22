$(document).ready(function () {
    $("#User_management_menu").addClass("active");

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $('#Users_table').DataTable({
        processing: true,
        serverSide: true,

        ajax: {
            url: '/superadmin/data',
            type: 'GET'
        },

        columns: [
            { data: 'id', name: 'id' },
            { data: 'name_en', name: 'name_en' },
            { data: 'username', name: 'username' },
            { data: 'email', name: 'email' },
            { data: 'mobile_no', name: 'mobile_no' },
            { data: 'role', name: 'role' },
            {
                data: 'joined_date',
                name: 'joined_date',
                defaultContent: '-'
            }
        ]
    });

});