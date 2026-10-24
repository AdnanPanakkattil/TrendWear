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
            },
            {
                data: 'actions',
                name: 'actions',
                defaultContent: '-'
            }
        ]
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