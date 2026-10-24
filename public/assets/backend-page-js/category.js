$(document).ready(function () {
    $("#Product_management_menu").addClass("active");

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var categoryTable = null;

    if ($('#Categories_table').length) {
        categoryTable = $('#Categories_table').DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: '/categories/data',
                type: 'GET'
            },

            columns: [
                { data: 'id', name: 'id' },
                { data: 'name_en', name: 'name_en' },
                { data: 'name_ar', name: 'name_ar' },
                { data: 'value', name: 'value', defaultContent: '-' },
                {
                    data: 'image',
                    name: 'image',
                    defaultContent: '-',
                    render: function (data, type, row) {
                        if (type === 'display' && data) {
                            var imageSrc = (data.indexOf('http') === 0) ? data : '/storage/' + data;
                            return '<img src="' + imageSrc + '" alt="' + row.name_en + '" style="height: 45px; width: auto; object-fit: contain;" />';
                        }
                        return data || '-';
                    }
                },
                { data: 'created_at', name: 'created_at', defaultContent: '-' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        return '<div class="d-flex gap-2">'
                            + '<button type="button" class="btn btn-sm btn-primary editCategoryBtn" data-id="' + row.id + '">'
                            + '<i class="ti ti-pencil"></i>'
                            + '</button>'
                            + '<button type="button" class="btn btn-sm btn-danger deleteCategoryBtn" data-id="' + row.id + '">'
                            + '<i class="ti ti-trash"></i>'
                            + '</button>'
                            + '</div>';
                    }
                }
            ],

            order: [[0, 'asc']],
        });
    }

    var categoryModalEl = document.getElementById('categoryModal');

    function showCategoryModal() {
        if (categoryModalEl) {
            var modal = bootstrap.Modal.getOrCreateInstance(categoryModalEl);
            modal.show();
        }
    }

    function resetCategoryForm() {
        $('#categoryForm').trigger('reset');
        $('#categoryId').val('');
        $('#categoryMethod').val('');
        $('#categoryForm').attr('action', '/categories');
        $('#categoryModalTitle').text('Add Category');
        $('#saveCategoryBtn').data('method', 'POST');
        $('#saveCategoryBtn').data('url', '/categories');
    }

    // Add Category button (modal open) ============================

    $(document).on('click', '#addCategoryBtn', function () {
        resetCategoryForm();
        showCategoryModal();
    });

    // Save Category / Edit Category (modal + create / edit pages) =========

    $(document).on('click', '#saveCategoryBtn', function () {
        var id = $('#categoryId').val();
        var method = id ? 'PUT' : 'POST';
        var url = id ? '/categories/' + id : '/categories';

        var formData = new FormData($('#categoryForm')[0]);

        $.ajax({
            url: url,
            type: method,
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);

                if (categoryModalEl) {
                    resetCategoryForm();
                    bootstrap.Modal.getOrCreateInstance(categoryModalEl).hide();
                    if (categoryTable) {
                        categoryTable.ajax.reload();
                    }
                } else {
                    window.location.href = '/categories';
                }
            },
            error: function (xhr) {
                console.log(xhr.status);
                console.log(xhr.responseText);
            }
        });
    });

    // Edit Category button (modal open) ============================

    $(document).on('click', '.editCategoryBtn', function () {
        if (!categoryTable) {
            return;
        }

        var row = categoryTable.row($(this).closest('tr'));
        var data = row.data();

        if (!data) {
            return;
        }

        $('#categoryId').val(data.id);
        $('#name_en').val(data.name_en);
        $('#name_ar').val(data.name_ar);
        $('#value').val(data.value);
        $('#categoryMethod').val('PUT');
        $('#categoryForm').attr('action', '/categories/' + data.id);
        $('#categoryModalTitle').text('Edit Category');

        showCategoryModal();
    });

    // Delete Category button =======================================

    $(document).on('click', '.deleteCategoryBtn', function () {
        var id = $(this).data('id');

        Swal.fire({
            title: 'Delete Category',
            text: 'Are you sure you want to delete this category?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff5622',
            confirmButtonText: 'Delete',
            cancelButtonText: 'Cancel',
        }).then(function (result) {
            if (!result.isConfirmed) {
                return;
            }

            $.ajax({
                url: '/categories/' + id,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    console.log(response);
                    if (categoryTable) {
                        categoryTable.ajax.reload();
                    }
                },
                error: function (xhr) {
                    console.log(xhr.status);
                    console.log(xhr.responseText);
                }
            });
        });
    });
});
