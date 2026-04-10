/*=========================================================================================
    File Name: booking-schedule.js
    Author: Sanz
==========================================================================================*/
$(document).ready(function () {

    var isRtl;
    isRtl = $('html').attr('data-textdirection') === 'rtl';

    //  Rendering badge in status column
    var customBadgeHTML = function (params) {
        if (params.value === "Completed") {
            return '<div class="badge-pill bg-rgba-success status-set-text width-100 status_btn" data-id="' + params.value + '" ><span class="text-success font-weight-bold" > ' + params.value + '</span></div>'
        } else if (params.value === "Pending") {
            return '<div class="badge-pill bg-rgba-warning status-set-text width-100 status_btn" data-id="' + params.value + '" ><span class="text-warning font-weight-bold" > ' + params.value + '</span></div>'
        }
    }

    //  Rendering avatar in user-name column
    var customUserAvatarHTML = function (params) {
        return '<a href=' + "user-view" + '>' + params.value['userName'] + '</a>';
    }

    //  Rendering avatar in client-name column
    var customClientAvatarHTML = function (params) {
        var img = params.value['clientImg'] || (window.location.origin + '/images/default-img/user.png');
        return '<a href=' + "client-view" + '><span class="avatar"><img src="' + img + '" height="32" width="32" alt=" "></span>' + params.value['clientName'] + '</a>';
    }

    // ag-grid
    /*** COLUMN DEFINE ***/

    var columnDefs = [{
        headerName: 'Order Id',
        field: 'order-id',
        width: 175,
        filter: true,
        checkboxSelection: true,
        headerCheckboxSelectionFilteredOnly: true,
        headerCheckboxSelection: true
    },
    {
        headerName: 'Service Name',
        field: 'service-name',
        filter: true,
        width: 200
    },
    {
        headerName: 'Service Provider',
        field: 'service-provider',
        filter: true,
        width: 200,
        cellRenderer: customClientAvatarHTML
    },
    {
        headerName: 'User',
        field: 'user-name',
        filter: true,
        width: 200,
        cellRenderer: customUserAvatarHTML
    },
    {
        headerName: 'Service Address',
        field: 'service-address',
        filter: true,
        width: 200,
    },
    {
        headerName: 'Time-Slot',
        field: 'service-timeslot',
        filter: true,
        width: 200,
    },
    {
        headerName: 'Amount',
        field: 'service-amount',
        filter: true,
        width: 150
    },
    {
        headerName: 'Payment Status',
        field: 'payment-status',
        filter: true,
        width: 175,
        cellRenderer: customBadgeHTML,
        cellStyle: {
            "text-align": "center"
        }
    },
    {
        headerName: 'Service Status',
        field: 'service-status',
        filter: true,
        width: 175,
        cellRenderer: customBadgeHTML,
        cellStyle: {
            "text-align": "center"
        }
    }
    ];

    /*** GRID OPTIONS ***/
    var gridOptions = {
        defaultColDef: {
            sortable: true,
            resizable: true,
            suppressColumnVirtualisation: true
        },
        enableRtl: isRtl,
        columnDefs: columnDefs,
        rowSelection: "multiple",
        floatingFilter: true,
        filter: true,
        pagination: true,
        paginationPageSize: 20,
        pivotPanelShow: "always",
        colResizeDefault: "shift",
        animateRows: true,
        domLayout: "autoHeight",
        autoSizeAllColumns: true,
        overlayNoRowsTemplate:
            '<span class="pt-5">No Data To Show</span>'
    };
    if (document.getElementById("myGrid-bookschdl")) {
        /*** DEFINED TABLE VARIABLE ***/
        var gridTable = document.getElementById("myGrid-bookschdl");

        function getTableData(data = "all") {
            agGrid
                .simpleHttpRequest({
                    url: "/admin/booking-schedule-show/" + data,
                })
                .then(function (data) {
                    console.log(data);
                    gridOptions.api.setRowData(data);
                });
        }

        getTableData();

        /*** FILTER TABLE ***/
        function updateSearchQuery(val) {
            gridOptions.api.setQuickFilter(val);
        }

        $(".ag-grid-filter").on("keyup", function () {
            updateSearchQuery($(this).val());
        });

        /*** CHANGE DATA PER PAGE ***/
        function changePageSize(value) {
            gridOptions.api.paginationSetPageSize(Number(value));
        }

        $(".sort-dropdown .dropdown-item").on("click", function () {
            var $this = $(this);
            changePageSize($this.text());
            $(".filter-btn").text("1 - " + $this.text() + " of 50");
        });

        /*** INIT TABLE ***/
        new agGrid.Grid(gridTable, gridOptions);
    }

    $(document).on('click', "#search_btn", function () {
        var text = $("#search-text").val();
        if (text !== "") {
            $(this).attr('type', 'button');
            getTableData("search?text=" + text);
        }
    });
});
