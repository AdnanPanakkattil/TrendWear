$(document).ready(function () {
    $("#User_management_menu").addClass("active");

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    const userTable = $('#Users_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/users/data',
            type: 'GET'
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name_en', name: 'name_en' },
            { data: 'username', name: 'username' },
            { data: 'email', name: 'email' },
            { data: 'mobile_no', name: 'mobile_no', defaultContent: '-' },
            {
                data: 'role',
                name: 'role',
                render: function (data) {
                    const badgeClasses = {
                        super_admin: 'bg-label-warning',
                        admin: 'bg-label-danger',
                        staff: 'bg-label-info',
                        inventory_manager: 'bg-label-secondary',
                        customer: 'bg-label-primary'
                    };

                    const roles = {
                        super_admin: 'Super Admin',
                        admin: 'Admin',
                        staff: 'Staff',
                        inventory_manager: 'Inventory Manager',
                        customer: 'Customer'
                    };

                    const badgeClass = badgeClasses[data] || 'bg-label-secondary';
                    const roleLabel = roles[data] || data;

                    return '<span class="badge ' + badgeClass + '">' + roleLabel + '</span>';
                }
            },
            {
                data: 'active',
                name: 'active',
                render: function (data) {
                    const isActive = Number(data) === 1;

                    return '<span class="badge ' + (isActive ? 'bg-label-success' : 'bg-label-secondary') + '">' + (isActive ? 'Active' : 'Inactive') + '</span>';
                }
            },
            {
                data: 'joined_date',
                name: 'joined_date',
                defaultContent: '-'
            },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false,
                defaultContent: '-'
            }
        ]
    });

    // Delete user handler with SweetAlert2 (Soft delete with is_delete = 1)
    $(document).on('click', '.delete-user-btn', function () {
        const userId = $(this).data('id');
        const userName = $(this).data('name') || 'this user';

        Swal.fire({
            title: 'Are you sure?',
            text: 'Are you sure you want to delete "' + userName + '"?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete!',
            cancelButtonText: 'Cancel',
            customClass: {
                confirmButton: 'btn btn-danger me-2',
                cancelButton: 'btn btn-secondary'
            },
            buttonsStyling: false
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/users/delete/' + userId,
                    type: 'POST',
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.message,
                                customClass: {
                                    confirmButton: 'btn btn-success'
                                },
                                buttonsStyling: false
                            });
                            userTable.ajax.reload(null, false);
                        }
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: xhr.responseJSON?.message || 'Failed to delete user.',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                    }
                });
            }
        });
    });

    // --------------------------------------------------------------------
    // Bills Daily Overview Sparkline Wave Chart
    // --------------------------------------------------------------------
    const billsOverviewChartEl = document.querySelector('#billsDailyOverviewChart') || document.querySelector('#subscriberGained');
    if (billsOverviewChartEl && typeof ApexCharts !== 'undefined') {
        const chartColor = '#ff5622b2';
        const billsOverviewChartConfig = {
            chart: {
                height: 90,
                type: 'area',
                toolbar: {
                    show: false
                },
                sparkline: {
                    enabled: true
                },
                parentHeightOffset: 0
            },
            markers: {
                colors: 'transparent',
                strokeColors: 'transparent'
            },
            grid: {
                show: false,
                padding: {
                    left: 0,
                    right: 0,
                    bottom: 0,
                    top: 0
                }
            },
            colors: [chartColor],
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    shadeIntensity: 0.8,
                    opacityFrom: 0.45,
                    opacityTo: 0.05,
                    stops: [0, 85, 100]
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 2.5,
                curve: 'smooth'
            },
            series: [
                {
                    name: 'Bills',
                    data: [200, 60, 300, 140, 230, 120, 400]
                }
            ],
            xaxis: {
                show: false,
                lines: {
                    show: false
                },
                labels: {
                    show: false
                },
                stroke: {
                    width: 0
                },
                axisBorder: {
                    show: false
                },
                crosshairs: {
                    show: false
                },
                tooltip: {
                    enabled: false
                }
            },
            yaxis: {
                stroke: {
                    width: 0
                },
                show: false
            },
            states: {
                hover: {
                    filter: {
                        type: 'none'
                    }
                },
                active: {
                    filter: {
                        type: 'none'
                    }
                }
            },
            tooltip: {
                enabled: false
            }
        };

        const billsOverviewChart = new ApexCharts(billsOverviewChartEl, billsOverviewChartConfig);
        billsOverviewChart.render();
    }

});